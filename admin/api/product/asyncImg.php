<?php
ob_start();
session_start();

	require_once '../../data/config.php';
	require_once '../../include/php_image_magician.php';
	require_once '../../include/functions.php';
if(isset($_SESSION['wf_id']) && strlen($_SESSION['wf_id']) > 0) // login check

{

	header('Content-Type: application/json');

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		$type = $_GET['type']; 

		if ($type == 'save') { 

			$uploadedFile = $_FILES['p_image'];
			$uploadFileTempName = $uploadedFile['tmp_name'];
			$uploadFileOrgName = $uploadedFile['name'];
			$uploadPath = UPLOAD_PATH_PRODUCT;

			$fileNewNameWithExt = uploadImage($uploadFileTempName, $uploadFileOrgName, $uploadPath);


		}


		$filename=$fileNewNameWithExt;

		$folderName = UPLOAD_PATH_PRODUCT;
		$folderNameThumb = UPLOAD_PATH_PRODUCT . 'thumb/' ;
		$folderNameMedium = UPLOAD_PATH_PRODUCT . 'medium/' ;

		$filepath = $folderName . $filename;

		chmod($folderName, 0755);
		chmod($folderNameThumb, 0755);
		chmod($folderNameMedium, 0755);

		/*	Purpose: Open image
     *	Usage:	 resize('filename.type')
     * 	Params:	 filename.type - the filename to open
     */
		$magicianObj = new imageLib($filepath);

		/*	Purpose: Resize image
		 *	Usage:	 resizeImage([width], [height])
		 * 	Params:	 width - the new width to resize to
		 *			 height - the new height to resize to
		 */
		//$magicianObj -> resizeImage(800, 800,'auto', 'true'  );
		$magicianObj -> resizeImage(1200, 800, 'auto');

		//($width, $height, $option=0, $sharpen=false);

		/*	Purpose: Save image
		 *	Usage:	 saveImage('[filename.type]', [quality])
		 * 	Params:	 filename.type - the filename and file type to save as
		  * 			 quality - (optional) 0-100 (100 being the highest (default))
		 *				Only applies to jpg & png only
		 */
		$magicianObj -> saveImage($folderName . $filename, 100);

		$magicianObj = new imageLib($filepath);
//		$magicianObj -> resizeImage(200, 200,'auto', 'true'  );
		$magicianObj -> resizeImage(400, 275, 'auto');
		$magicianObj -> saveImage($folderNameMedium. $filename, 100);

		$magicianObj = new imageLib($filepath);
//		$magicianObj -> resizeImage(200, 200,'auto', 'true'  );
		$magicianObj -> resizeImage(100, 67, 'auto');
		$magicianObj -> saveImage($folderNameThumb . $filename, 100);




		// Return an empty string to signify success

		

		//echo '';

		

		echo json_encode($fileNewNameWithExt);

	

		exit;

	}

}

else

{

	header('Location: ../index.php?mo=&errmsg=1');

}

?>