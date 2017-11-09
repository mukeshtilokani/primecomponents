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
		  $image = $_POST['psubc_imageName'];
          $sql = "UPDATE p_subcategories SET
		        psubc_image = :psubc_image,
		  		pc_id = :pc_id,
		  		psubc_title = :psubc_title,
				psubc_alias = :psubc_alias,
				psubc_desc = :psubc_desc
				WHERE psubc_id = :psubc_id";
				
		$stmt = $dbh->prepare($sql);
		  $stmt->bindParam(':psubc_image',  $image);
 
	    $stmt->bindParam(':psubc_title', $_POST['psubc_title']);      
		$stmt->bindParam(':psubc_alias', $_POST['psubc_alias']);
		$stmt->bindParam(':psubc_desc', $_POST['psubc_desc']);
		// use PARAM_STR although a number 
		 
		 
		$stmt->bindParam(':pc_id', $_POST['pc_id']); 
		 
		$stmt->bindParam(':psubc_id', $_POST['psubc_id']); 
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