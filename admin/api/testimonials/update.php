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
        
		
          $sql = "UPDATE testimonials SET 
		  		t_title = :t_title,
		  		t_alias = :t_alias,
				t_co_name = :t_co_name,
				t_designation = :t_designation,
				t_city = :t_city,
				t_desc = :t_desc,
				t_modified_by = :t_modified_by,
				t_modified_dt = :t_modified_dt
				WHERE t_id = :t_id";
				
		$stmt = $dbh->prepare($sql);
 
	    $stmt->bindParam(':t_title', $_POST['t_title']);      
		$stmt->bindParam(':t_alias', $_POST['t_alias']);
		$stmt->bindParam(':t_co_name', $_POST['t_co_name']);
		$stmt->bindParam(':t_designation', $_POST['t_designation']);
		$stmt->bindParam(':t_city', $_POST['t_city']);
		$stmt->bindParam(':t_desc', $_POST['t_desc']);
		// use PARAM_STR although a number 
		 
		 
		$stmt->bindParam(':t_modified_by', $_SESSION['wf_id']); 
		$stmt->bindParam(':t_modified_dt', $dt ); 
		 
		$stmt->bindParam(':t_id', $_POST['t_id']); 
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