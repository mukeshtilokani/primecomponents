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
				
		 $sql = "UPDATE products SET p_order = :p_order WHERE p_id = :p_id";
                         
        $stmt = $dbh->prepare($sql);
                                   
        $stmt->bindParam(':p_order', $_POST['p_order']); 
        $stmt->bindParam(':p_id', $_POST['p_id']); 
        $stmt->execute(); 
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