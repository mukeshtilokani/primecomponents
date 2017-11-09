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




			$images =  explode(",", urldecode($_POST['a_images']));
			for ($k = 0; $k < count($images); $k++) {

				$sql1 = "INSERT INTO appraisals (a_image) VALUES
                            (:a_image)";

				$stmt1 = $dbh->prepare($sql1);
				$stmt1->bindParam(':a_image', $images[$k]);
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