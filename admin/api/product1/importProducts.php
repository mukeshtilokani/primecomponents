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

			$upcoming = 'N';
			$dt = date('Y-m-d H:i:s');

				for ($k = 0; $k < count($rows1); $k++) {

					$sql = "UPDATE products SET
					        p_alias = :p_alias,
					        p_catalog_file = :p_catalog_file,
					        p_description = :p_desc,
					        p_technical = :p_technical,
					        p_intro = :p_intro,
					        p_upcoming = :p_upcoming,
							p_modified_by = :p_modified_by,
							p_modified_dt = :p_modified_dt
							WHERE p_id = :p_id";

					$stmt = $dbh->prepare( $sql );


					$stmt->bindParam( ':p_alias', $rows1[$k]['p_alias'] );
					$stmt->bindParam( ':p_catalogName', $_POST['p_catalog_file'] );
					$stmt->bindParam( ':p_desc', $_POST['p_desc'] );
					$stmt->bindParam( ':p_intro', $_POST['p_intro'] );
					$stmt->bindParam( ':p_technical', $_POST['p_technical'] );

					$stmt->bindParam( ':p_upcoming', $upcoming );
					// use PARAM_STR although a number
					$stmt->bindParam( ':p_modified_by', $_SESSION['wf_id'] );
					$stmt->bindParam( ':p_modified_dt', $dt );

					$stmt->bindParam( ':p_id', $_POST['p_id'] );
					//print_r($stmt); exit;
					$stmt->execute();




				 
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