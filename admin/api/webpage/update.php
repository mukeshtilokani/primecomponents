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

		/*** echo a message saying we have connected ***/
		/*** INSERT data ***/
		 $sql = "UPDATE webpages SET
		  
		  		wp_title = :wp_title,
				wp_alias = :wp_alias,
				wp_intro = :wp_intro,
				wp_description = :wp_description, 
				wp_modified_by = :wp_modified_by,
				wp_modified_dt = :wp_modified_dt
				WHERE wp_id = :wp_id";
											  
		$stmt = $dbh->prepare($sql);
		$stmt->bindParam(':wp_id', $_POST['wp_id']);					 	  
		$stmt->bindParam(':wp_title', $_POST['wp_title']);      
		$stmt->bindParam(':wp_alias', $_POST['wp_alias']);
		$stmt->bindParam(':wp_intro', $_POST['wp_intro']);
		$stmt->bindParam(':wp_description', $_POST['wp_description']);
		// use PARAM_STR although a number   
		$stmt->bindParam(':wp_modified_by', $_SESSION['wf_id']);  
		$stmt->bindParam(':wp_modified_dt', $dt);     
		//print_r($stmt); exit;							  
		$stmt->execute(); 
		//$newId = $dbh->lastInsertId();
		//$request = $newId;
        
 		echo json_encode('Information updated successfully!');
	
		/*** close the database connection ***/

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