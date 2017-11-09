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
        
          $sql = "UPDATE news SET
		  		nws_title = :nws_title,
				nws_alias = :nws_alias,
				nws_description = :nws_description
				WHERE nws_id = :nws_id";
				
		$stmt = $dbh->prepare($sql);
 
	    $stmt->bindParam(':nws_title', $_POST['nws_title']);
		$stmt->bindParam(':nws_alias', $_POST['nws_alias']);
		$stmt->bindParam(':nws_description', $_POST['nws_description']);
		// use PARAM_STR although a number
		 
		$stmt->bindParam(':nws_id', $_POST['nws_id']);
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