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
		  $image = $_POST['cl_image'];
		/*** echo a message saying we have connected ***/
		/*** INSERT data ***/

          $sql = "UPDATE clients SET
		        cl_image = :cl_image,
		  		cl_title = :cl_title,
				cl_alias = :cl_alias,
				cl_modified_by = :cl_modified_by,
				cl_modified_dt = :cl_modified_dt
				WHERE cl_id = :cl_id";
				
		$stmt = $dbh->prepare($sql);
        $stmt->bindParam(':cl_image',  $image);
	    $stmt->bindParam(':cl_title', $_POST['cl_title']);      
		$stmt->bindParam(':cl_alias', $_POST['cl_alias']);
		// use PARAM_STR although a number 
		$stmt->bindParam(':cl_modified_by', $_SESSION['wf_id']);  
		$stmt->bindParam(':cl_modified_dt', $dt);
		 
		$stmt->bindParam(':cl_id', $_POST['cl_id']); 
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