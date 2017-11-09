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

        $sql1 = $dbh->prepare("SELECT * FROM news WHERE nws_active='Y' AND lower(nws_title)='". strtolower(trim($_POST['nws_title']))."' ORDER BY nws_title ASC");

        $sql1->execute();

        $result1 = $sql1->fetchAll();

         //end check



if(count($result1)> 0)

{



    echo json_encode('Duplicate Entry!');

}

else

{
		
		/*** echo a message saying we have connected ***/
		/*** INSERT data ***/
		$sql = "INSERT INTO news (nws_title,
				nws_alias,
				nws_description,
				nws_active) VALUES (
				:nws_title,
				:nws_alias,
				:nws_description,
				:nws_active)";
				
	 	
											  
		$stmt = $dbh->prepare($sql);
							 	  
		 
		$stmt->bindParam(':nws_title', $_POST['nws_title']);
		$stmt->bindParam(':nws_alias', $_POST['nws_alias']);
		$stmt->bindParam(':nws_description', $_POST['nws_description']);
		// use PARAM_STR although a number 
		$stmt->bindParam(':nws_active', $active);
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