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

          $images =  explode(",", urldecode($_POST['cgl_images']));
          for ($k = 0; $k < count($images); $k++) {

              $sql = "INSERT INTO client_galleries (cl_id,cgl_images,
                                        cgl_active, cgl_created_by, cgl_created_dt) VALUES
                (:cl_id,:cgl_images,:cgl_active, :cgl_created_by, :cgl_created_dt)";

              $stmt = $dbh->prepare($sql);

              $stmt->bindParam(':cl_id', $_POST['cl_id']);


              $stmt->bindParam(':cgl_images', $images[$k]);


              //print_r($stmt); exit;
              $stmt->bindParam(':cgl_active', $active);
              $stmt->bindParam(':cgl_created_by', $_SESSION['wf_id']);
              $stmt->bindParam(':cgl_created_dt', $dt);
              $stmt->execute();

          }
              echo json_encode('Information saved successfully!');
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