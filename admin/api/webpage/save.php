<?php 
ob_start();
session_start();
require_once '../../data/config.php';
if(isset($_SESSION['wf_id']) && strlen($_SESSION['wf_id']) > 0) // login check
{
	header('Content-Type: application/json');

	  $request = json_decode(file_get_contents('php://input'));
	  try {
		$dbh = new PDO($dsn, $username, $password);
		$active = "Y";
		$dt = date('Y-m-d H:i:s');
		
		
		 //check for duplicates

        $sql1 = $dbh->prepare("SELECT * FROM webpages WHERE wp_active='Y' AND lower(wp_title)='". strtolower(trim($_POST['wp_title']))."' ORDER BY wp_title ASC");

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
		$sql = "INSERT INTO webpages(wp_title,
				wp_alias,
				wp_intro,
				wp_description,
				wp_active,
				wp_created_by,
				wp_created_dt) VALUES (
				:wp_title,
				:wp_alias,
				:wp_intro,
				:wp_description,
				:wp_active,
				:wp_created_by,
				:wp_created_dt)";
				
	 	
											  
		$stmt = $dbh->prepare($sql);
							 	  
		$stmt->bindParam(':wp_title', $_POST['wp_title']);      
		$stmt->bindParam(':wp_alias', $_POST['wp_alias']);
		$stmt->bindParam(':wp_intro', $_POST['wp_intro']);
		$stmt->bindParam(':wp_description', $_POST['wp_description']);
		// use PARAM_STR although a number 
		$stmt->bindParam(':wp_active', $active);  
		$stmt->bindParam(':wp_created_by', $_SESSION['wf_id']);  
		$stmt->bindParam(':wp_created_dt', $dt);     
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
	header('Location: ../index.php?mo=&errmsg=1');
}
?>