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

          $sql1 = $dbh->prepare("SELECT * FROM products WHERE p_active='Y' AND lower(p_title)='". strtolower(trim($_POST['p_title']))."' ORDER BY p_title ASC");

          $sql1->execute();

          $result1 = $sql1->fetchAll();

          //end check



          if(count($result1)> 0)

          {



              echo json_encode('Duplicate Entry!');

          }

          else {


              $sql = "INSERT INTO products (p_pc_id,psubc_id, p_title, p_alias, p_image, p_catalog_file, p_upcoming, p_intro, p_description,
                                        p_active, p_created_by, p_created_dt) VALUES
                (:p_pc_id,:psubc_id, :p_title, :p_alias, :p_image, :p_catalog_file, :p_upcoming, :p_intro, :p_description, :p_active,
                 :p_created_by, :p_created_dt)";

              $stmt = $dbh->prepare($sql);

              $stmt->bindParam(':p_pc_id', $_POST['p_pc_id']);
              $stmt->bindParam(':psubc_id', $_POST['psubc_id']);

              $stmt->bindParam(':p_title', $_POST['p_title']);
              $stmt->bindParam(':p_alias', $_POST['p_alias']);

              $stmt->bindParam(':p_image', $_POST['p_imageName']);
              $stmt->bindParam(':p_catalog_file', $_POST['p_catalogName']);
              $stmt->bindParam(':p_intro', $_POST['p_intro']);
              $stmt->bindParam(':p_description', $_POST['p_desc']);
              $stmt->bindParam(':p_upcoming', $_POST['p_upcoming']);

              //print_r($stmt); exit;
              $stmt->bindParam(':p_active', $active);
              $stmt->bindParam(':p_created_by', $_SESSION['wf_id']);
              $stmt->bindParam(':p_created_dt', $dt);
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