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
		//check for duplicates

          //check for duplicates

          $sql1 = $dbh->prepare("SELECT * FROM clients WHERE p_active='Y' AND lower(cl_title)='". strtolower(trim($_POST['cl_title']))."' ORDER BY cl_title ASC");

          $sql1->execute();

          $result1 = $sql1->fetchAll();

          //end check



          if(count($result1)> 0)

          {



              echo json_encode('Duplicate Entry!');

          }

          else {


              $sql = "INSERT INTO clients ( cl_title, cl_alias, cl_image,
                                        cl_active, cl_created_by, cl_created_dt) VALUES
                (:cl_title, :cl_alias, :cl_image, :cl_active, :cl_created_by, :cl_created_dt)";

              $stmt = $dbh->prepare($sql);

              $stmt->bindParam(':cl_title', $_POST['cl_title']);
              $stmt->bindParam(':cl_alias', $_POST['cl_alias']);

              $stmt->bindParam(':cl_image', $_POST['cl_image']);

              //print_r($stmt); exit;
              $stmt->bindParam(':cl_active', $active);
              $stmt->bindParam(':cl_created_by', $_SESSION['wf_id']);
              $stmt->bindParam(':cl_created_dt', $dt);
              $stmt->execute();


              echo json_encode('Information saved successfully!');
              $dbh = null;
          }
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