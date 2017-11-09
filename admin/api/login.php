<?php
ob_start();
$sess_name = session_name();
if (session_start()) {
	setcookie($sess_name, session_id(), null, '/', null, null, true);
}
 
date_default_timezone_set('Asia/Kolkata');
  //include '_crud.php';
 include('../data/config.php');
 //$request = json_decode(file_get_contents('php://input'));
  $uName = $_POST['txtUsername'];
  $uPass = $_POST['txtPassword'];
  
  $db = new PDO($dsn, $username, $password);
  $statement = $db->prepare("SELECT * FROM w_folks WHERE wf_um ='".$uName."' and wf_up ='".$uPass."'");
  $statement->execute();
  $count = $statement->rowCount();
  $rows = $statement->fetch(PDO::FETCH_NUM); 

	if($count==1)
	{
		$_SESSION['wf_id'] = $rows[0];
		$_SESSION['wf_name'] = $rows[1];
         $logindt=  date("Y-m-d H:i:s");
         $sql = "UPDATE w_folks SET
            wf_last_login=:wf_last_login
            WHERE wf_id = :wf_id";
    
    $stmt = $db->prepare($sql);
                                 
    $stmt->bindParam(':wf_last_login', $logindt);  
    $stmt->bindParam(':wf_id', $rows[0]);  
      
    $stmt->execute(); 
        
        
		header('Location: ../index.php');			
	}
else
{
    header('Location: ../index.php');
}
	
?>
