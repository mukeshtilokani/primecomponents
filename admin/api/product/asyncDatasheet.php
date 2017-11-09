<?php
ob_start();
session_start();
require_once '../../data/config.php';
if(isset($_SESSION['wf_id']) && strlen($_SESSION['wf_id']) > 0) // login check
{
	header('Content-Type: application/json');
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$type = $_GET['type']; 
		if ($type == 'save') {
			$files = $_FILES['p_catalog_file'];
			// Save the uploaded files
			
			//for ($index = 0; $index < count($files['name']); $index++) {
				$file = $files['tmp_name'];
				if (is_uploaded_file($file)) {
					move_uploaded_file($file, UPLOAD_PATH_PRODUCT_PDF. $files['name']);
				}
		  //  }
			
		} else if ($type == 'remove') {
			$fileNames = $_POST['fileNames'];
			// Delete uploaded files
			/*
			for ($index = 0; $index < count($fileNames); $index++) {
				unlink('./' . $fileNames[$index]);
			}
			*/
		}
	
		// Return an empty string to signify success
		
		//echo '';
		
		echo json_encode($files['name']);
	
		exit;
	}
}
else
{
	header('Location: ../index.php?mo=&errmsg=1');
}
?>