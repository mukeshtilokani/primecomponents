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
				
		 $sql = "UPDATE news SET nws_order = :nws_order WHERE nws_id = :nws_id";
                         
        $stmt = $dbh->prepare($sql);
                                   
        $stmt->bindParam(':nws_order', $_POST['nws_order']);
        $stmt->bindParam(':nws_id', $_POST['nws_id']);
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