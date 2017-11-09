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

        $sql1 = $dbh->prepare("SELECT * FROM testimonials WHERE t_active='Y' AND lower(t_title)='". strtolower(trim($_POST['t_title']))."' ORDER BY t_title ASC");

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
		$sql = "INSERT INTO testimonials (t_title,
				t_alias,
				t_co_name,
				t_designation,
				t_city,
				t_desc,
				t_active, t_created_by, t_created_dt) VALUES (
				:t_title,
				:t_alias,
				:t_co_name,
				:t_designation,
				:t_city,
				:t_desc,
				:t_active, :t_created_by, :t_created_dt)";
				
	 	
											  
		$stmt = $dbh->prepare($sql);
							 	  
		 
		$stmt->bindParam(':t_title', $_POST['t_title']);

		$stmt->bindParam(':t_alias', $_POST['t_alias']);

		$stmt->bindParam(':t_co_name', $_POST['t_co_name']);

		$stmt->bindParam(':t_designation', $_POST['t_designation']);

		$stmt->bindParam(':t_city', $_POST['t_city']);
		
		$stmt->bindParam(':t_desc', $_POST['t_desc']);
		// use PARAM_STR although a number 
		$stmt->bindParam(':t_active', $active);
    $stmt->bindParam(':t_created_by', $_SESSION['wf_id']);
    $stmt->bindParam(':t_created_dt', $dt);
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