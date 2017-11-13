<?php
ob_start();
$sess_name = session_name();
if (session_start()) {
	setcookie($sess_name, session_id(), null, '/', null, null, true);
}
if(isset($_SESSION['wf_id']) && strlen($_SESSION['wf_id']) > 0) // login check
{
	require_once '../../data/config.php';
	header('Content-Type: application/json');

	  $request = json_decode(file_get_contents('php://input'));
	  try {
		$dbh = new PDO($dsn, $username, $password);
		$active = "Y";
		$dt = date('Y-m-d H:i:s');
		
		
		 //check for duplicates

        $sql1 = $dbh->prepare("SELECT * FROM p_subcategories psc LEFT JOIN
							  p_categories pc on psc.pc_id = pc.pc_id
							  WHERE pc.pc_active='Y' and  psc.psubc_active ='Y'
							   AND lower(psc.psubc_title)='". strtolower(trim($_POST['psubc_title']))."' ORDER BY psc.psubc_title ASC");

        $sql1->execute();

        $result1 = $sql1->fetchAll();

         //end check

        

if(count($result1)> 0)        

{

    

    echo json_encode('Duplicate Entry!');

}

else

{

		$psubcOrder = 0;
		
		/*** echo a message saying we have connected ***/
		/*** INSERT data ***/
		$sql = "INSERT INTO p_subcategories (psubc_title,
				psubc_image,
				pc_id,
				psubc_alias,
				psubc_desc,
				psubc_order,
				psubc_active) VALUES (
				:psubc_title,
				:psubc_image,
				:pc_id,
				:psubc_alias,
				:psubc_desc,
				:psubc_order,
				:psubc_active)";
				
	 	
											  
		$stmt = $dbh->prepare($sql);

	$stmt->bindParam(':psubc_image', $_POST['psubc_imageName']);
		$stmt->bindParam(':psubc_title', $_POST['psubc_title']);      
		$stmt->bindParam(':pc_id', $_POST['pc_id']);      
		$stmt->bindParam(':psubc_alias', $_POST['psubc_alias']);
		$stmt->bindParam(':psubc_desc', $_POST['psubc_desc']);
		$stmt->bindParam(':psubc_order', $psubcOrder);
		// use PARAM_STR although a number 
		$stmt->bindParam(':psubc_active', $active);   
		//print_r($stmt); exit;							  
		$stmt->execute(); 
		//$newId = $dbh->lastInsertId();
		//$request = $newId;
        
 		echo json_encode('Information saved successfully!');
	
		/*** close the database connection ***/
}
		$dbh = null;
		}
	catch(PDOException $e)
		{
		echo $e->getMessage();
		}
}
else
{
	require_once '../../login.php';
}
?>