<?php
	ob_start();
	session_start();
	require_once '../../data/config.php';
	header('Content-Type: application/json');
	try {
		$dbh = new PDO($dsn, $username, $password);


		/*** The SQL SELECT statement ***/

		$image = $_POST['imgName'];
		$pathThumb = UPLOAD_PATH_CLIENT_PHOTOS."thumb/";
		$path = UPLOAD_PATH_CLIENT_PHOTOS;
		unlink($pathThumb . $image);
		unlink($path . $image);


		$sql = "DELETE FROM client_galleries WHERE cgl_id =  :cgl_id and cl_id= :cl_id";
		$stmt = $dbh->prepare($sql);
		$stmt->bindParam(':cl_id', $_POST['cl_id']);
		$stmt->bindParam(':cgl_id', $_POST['cgl_id']);
		$stmt->execute();


		echo json_encode('image Deleted !');


		/*** close the database connection ***/

		$dbh = null;

	}

	catch(PDOException $e)

	{

		echo $e->getMessage();

	}



?>

