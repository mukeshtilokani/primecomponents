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
		$active = "N";
		$dt = date('Y-m-d H:i:s');
		/*** echo a message saying we have connected ***/
		/*** INSERT data ***/
          $sql2 = "DELETE FROM products_images WHERE p_id =  :p_id and pi_id= :pi_id";
				  $stmt2 = $dbh->prepare($sql2);
				  $stmt2->bindParam(':p_id', $_POST['p_id']);
				  $stmt2->bindParam(':pi_id', $_POST['pi_id']);
				  $stmt2->execute(); 
		
        echo json_encode('Information deleted successfully!');
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