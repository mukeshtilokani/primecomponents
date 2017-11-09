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
			$active = "N";
			$dt = date('Y-m-d H:i:s');
			/*** echo a message saying we have connected ***/
			/*** INSERT data ***/





			$sql = "UPDATE pdf_galleries SET
		  		pdfgl_active = :pdfgl_active,
		  		pdfgl_modified_dt = :pdfgl_modified_dt,
		  		pdfgl_modified_by = :pdfgl_modified_by
				WHERE pdfgl_id = :pdfgl_id";

			$stmt = $dbh->prepare($sql);

			$stmt->bindParam(':pdfgl_active', $active);
			$stmt->bindParam(':pdfgl_modified_dt', $dt);
			$stmt->bindParam(':pdfgl_modified_by', $_SESSION['wf_id']);
			// use PARAM_STR although a number
			$stmt->bindParam(':pdfgl_id', $_POST['pdfgl_id']);
			//print_r($stmt); exit;
			$stmt->execute();

			$sql1 = $dbh->prepare("SELECT * FROM pdf_galleries WHERE
                                pdfgl_active='N' AND pdfgl_id='".$_POST['pdfgl_id']."'");
			$sql1->execute();
			$rows1 = $sql1->fetchAll();
			for($i=0;$i < count($rows1); $i++) {
				$pdf = $rows1[$i]['pdfgl_files'];
				$path = UPLOAD_PATH_PDF_GALLERY;
				unlink($path . $pdf);
			}
			//$newId = $dbh->lastInsertId();
			//$request = $newId;



			echo json_encode('Information deleted successfully!');
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
		header('Location: ../index.php?mo=&errmsg=1');
	}
?>