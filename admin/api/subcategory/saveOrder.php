<?php
ob_start();
$sess_name = session_name();
if (session_start()) {
	setcookie($sess_name, session_id(), null, '/', null, null, true);
}
if(isset($_SESSION['wf_id']) && strlen($_SESSION['wf_id']) > 0) // login check
{
	header('Content-Type: application/json');

	  $request = json_decode(file_get_contents('php://input'));
	  try {
		$dbh = new PDO($dsn, $username, $password);
				
		 $sql = "UPDATE p_subcategory SET psubc_order = :psubc_order WHERE psubc_id = :psubc_id"; 
                         
        $stmt = $dbh->prepare($sql);
                                   
        $stmt->bindParam(':psubc_order', $_POST['psubc_order']); 
        $stmt->bindParam(':psubc_id', $_POST['psubc_id']); 
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