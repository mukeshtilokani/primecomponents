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


//              $sql = "INSERT INTO photo_galleries (pc_id,pgl_title, pgl_alias,
//                                        pgl_active, pgl_created_by, pgl_created_dt) VALUES
//                (:pc_id,:pgl_title, :pgl_alias, :pgl_active, :pgl_created_by, :pgl_created_dt)";
//
//              $stmt = $dbh->prepare($sql);
//
//              $stmt->bindParam(':pc_id', $_POST['pc_id']);
//              $stmt->bindParam(':pgl_title', $_POST['pgl_title']);
//
//
//              $stmt->bindParam(':pgl_alias', $_POST['pgl_alias']);
//
//             // $stmt->bindParam(':pgl_images', $_POST['pgl_images']);
//
//
//              //print_r($stmt); exit;
//              $stmt->bindParam(':pgl_active', $active);
//              $stmt->bindParam(':pgl_created_by', $_SESSION['wf_id']);
//              $stmt->bindParam(':pgl_created_dt', $dt);
//              $stmt->execute();
//

          $newId = $_POST['pc_id'];

                $images =  explode(",", urldecode($_POST['pgl_images']));
                for ($k = 0; $k < count($images); $k++) {

                    $sql1 = "INSERT INTO photo_gallery_images (pc_id, pgli_image) VALUES
                            (:pc_id,:pgli_image)";

                    $stmt1 = $dbh->prepare($sql1);

                    $stmt1->bindParam(':pc_id', $newId);
                    $stmt1->bindParam(':pgli_image', $images[$k]);
                    $stmt1->execute();
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