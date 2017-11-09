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
        
          $sql = "UPDATE products SET p_pc_id = :p_pc_id,
		  		psubc_id = :psubc_id,
				p_title = :p_title,
				p_alias = :p_alias,

		  		p_image = :p_imageName,
		  		p_catalog_file = :p_catalogName,
		  		p_intro = :p_intro,
		  		p_description = :p_description,
		  		p_upcoming = :p_upcoming, 
				p_modified_by = :p_modified_by,
				p_modified_dt = :p_modified_dt				
				WHERE p_id = :p_id";
				
		$stmt = $dbh->prepare($sql);
		$stmt->bindParam(':p_id', $_POST['p_id']);   

		$stmt->bindParam(':p_pc_id', $_POST['p_pc_id']); 	
		$stmt->bindParam(':psubc_id', $_POST['psubc_id']);
		$stmt->bindParam(':p_title', $_POST['p_title']);
		$stmt->bindParam(':p_alias', $_POST['p_alias']);

		// use PARAM_STR although a number 	
		$stmt->bindParam(':p_imageName', $_POST['p_imageName']);
		$stmt->bindParam(':p_catalogName', $_POST['p_catalogName']);
		$stmt->bindParam(':p_intro', $_POST['p_intro']);
		$stmt->bindParam(':p_description', $_POST['p_desc']);
		$stmt->bindParam(':p_upcoming', $_POST['p_upcoming']);
		$stmt->bindParam(':p_modified_by', $_SESSION['wf_id']);  
		$stmt->bindParam(':p_modified_dt', $dt); 
		  
		//print_r($stmt); exit;							  
		$stmt->execute(); 
		 
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