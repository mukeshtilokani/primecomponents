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
        $image = $_POST['pc_imageName'];
          $sql = "UPDATE p_categories SET
		        pc_image = :pc_image,
		  		pc_title = :pc_title,
				pc_alias = :pc_alias,
				pc_desc = :pc_desc,
				pc_modified_by = :pc_modified_by,
				pc_modified_dt = :pc_modified_dt
				WHERE pc_id = :pc_id";
				
		$stmt = $dbh->prepare($sql);
        $stmt->bindParam(':pc_image',  $image);
	    $stmt->bindParam(':pc_title', $_POST['pc_title']);      
		$stmt->bindParam(':pc_alias', $_POST['pc_alias']);
		$stmt->bindParam(':pc_desc', $_POST['pc_desc']);
		// use PARAM_STR although a number 
		$stmt->bindParam(':pc_modified_by', $_SESSION['wf_id']);  
		$stmt->bindParam(':pc_modified_dt', $dt);
		 
		$stmt->bindParam(':pc_id', $_POST['pc_id']); 
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