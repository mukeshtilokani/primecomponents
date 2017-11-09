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





try {

    $dbh = new PDO($dsn, $username, $password);
 
		/*** echo a message saying we have connected ***/
		//echo 'Connected to database<br />';
	
		/*** The SQL SELECT statement ***/  
        
        $sql = $dbh->prepare("SELECT * FROM p_subcategories psc LEFT JOIN
							  p_categories pc on psc.pc_id = pc.pc_id
							  WHERE psc.pc_id= :pc_id AND psc.psubc_active ='Y'");
        $sql->bindParam(':pc_id', $_POST['pc_id']);
        $sql->execute();         
        $result = $sql->fetchAll(); 
        $data = $result;
        echo json_encode($data);
                         
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
	require_once '../../login.php';
}
 

?>
