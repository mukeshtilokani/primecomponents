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




                $images =  explode(",", urldecode($_POST['hi_images']));
                for ($k = 0; $k < count($images); $k++) {

                    $sql1 = "INSERT INTO home_banners (hi_image) VALUES
                            (:hi_image)";

                    $stmt1 = $dbh->prepare($sql1);
                    $stmt1->bindParam(':hi_image', $images[$k]);
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