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

          $sql1 = $dbh->prepare("SELECT * FROM pdf_galleries WHERE pdfgl_active='Y' AND lower(pdfgl_title)='". strtolower(trim($_POST['pdfgl_title']))."' ORDER BY pdfgl_title ASC");

          $sql1->execute();

          $result1 = $sql1->fetchAll();

          //end check



          if(count($result1)> 0)

          {



              echo json_encode('Duplicate Entry!');

          }

          else {

              $images =  explode(",", urldecode($_POST['pdfgl_files']));
              for ($k = 0; $k < count($images); $k++) {

              $sql = "INSERT INTO pdf_galleries (pc_id, pdfgl_files,
                                        pdfgl_active, pdfgl_created_by, pdfgl_created_dt) VALUES
                (:pc_id, :pdfgl_files,:pdfgl_active, :pdfgl_created_by, :pdfgl_created_dt)";

              $stmt = $dbh->prepare($sql);

              $stmt->bindParam(':pc_id', $_POST['pc_id']);

              $stmt->bindParam(':pdfgl_files', $images[$k]);


              //print_r($stmt); exit;
              $stmt->bindParam(':pdfgl_active', $active);
              $stmt->bindParam(':pdfgl_created_by', $_SESSION['wf_id']);
              $stmt->bindParam(':pdfgl_created_dt', $dt);
              $stmt->execute();
              }

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