<?php
ob_start();
$sess_name = session_name();
if (session_start()) {
	setcookie($sess_name, session_id(), null, '/', null, null, true);
}
if(isset($_SESSION['wf_id']) && strlen($_SESSION['wf_id']) > 0) // login check
{
	require_once '../../data/config.php';
	header('Content-Type: application/json');

	  $request = json_decode(file_get_contents('php://input'));
	  try {
		$dbh = new PDO($dsn, $username, $password);
				
		 $sql = "UPDATE p_category SET pc_order = :pc_order WHERE pc_id = :pc_id"; 
                         
        $stmt = $dbh->prepare($sql);
                                   
        $stmt->bindParam(':pc_order', $_POST['pc_order']); 
        $stmt->bindParam(':pc_id', $_POST['pc_id']); 
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
	require_once '../../login.php';
}

?>