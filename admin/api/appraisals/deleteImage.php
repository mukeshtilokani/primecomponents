<?php
	ob_start();
	session_start();
	require_once '../../data/config.php';
	header('Content-Type: application/json');
	try {
		$dbh = new PDO($dsn, $username, $password);


		/*** The SQL SELECT statement ***/

		$image = $_POST['imgName'];
		$pathThumb = UPLOAD_PATH_APPRAISALS."thumb/";
		$path = UPLOAD_PATH_APPRAISALS;

		if (file_exists($pathThumb . $image)) {
			unlink( $pathThumb . $image );
		}
		if (file_exists($path . $image)) {
			unlink( $path . $image );
		}


		$sql = "DELETE FROM appraisals WHERE a_id =  :a_id ";
		$stmt = $dbh->prepare($sql);
		$stmt->bindParam(':a_id', $_POST['a_id']);
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

