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
	
		  
		/*** echo a message saying we have connected ***/
		/*** INSERT data ***/


		  $p_imageNameOld =  $_POST['p_imageNameOld'];
		  $p_imageName =  $_POST['p_imageName'];
		  $p_image=$p_imageNameOld;

		  if( strlen($p_imageName) > 0)
		  {
			  $p_image = $p_imageName;
		  }





		  $sql = "UPDATE products SET

		        p_alias = :p_alias,
		        p_catalog_file = :p_catalogName,
		        p_code = :p_code,
		        p_description = :p_desc,
		        p_technical = :p_technical,
		        p_image = :p_image,

		        p_intro = :p_intro,
		        p_pc_id = :p_pc_id,
		        p_title = :p_title,
		        p_upcoming = :p_upcoming,
		        psubc_id = :psubc_id,

				p_modified_by = :p_modified_by,
				p_modified_dt = :p_modified_dt
				WHERE p_id = :p_id";

		  $stmt = $dbh->prepare($sql);

		  $stmt->bindParam(':p_alias',  $_POST['p_alias']);
		  $stmt->bindParam(':p_catalogName',  $_POST['p_catalogName']);
		  $stmt->bindParam(':p_code',  $_POST['p_code']);
		  $stmt->bindParam(':p_desc',  $_POST['p_desc']);
		  $stmt->bindParam(':p_image',  $p_image);
		  $stmt->bindParam(':p_intro',  $_POST['p_intro']);
		  $stmt->bindParam(':p_technical',  $_POST['p_technical']);
		  $stmt->bindParam(':p_pc_id',  $_POST['p_pc_id']);
		  $stmt->bindParam(':p_title',  $_POST['p_title']);
		  $stmt->bindParam(':p_upcoming',  $_POST['p_upcoming']);
		  $stmt->bindParam(':psubc_id',  $_POST['psubc_id']);


		  // use PARAM_STR although a number
		  $stmt->bindParam(':p_modified_by', $_SESSION['wf_id']);
		  $stmt->bindParam(':p_modified_dt', $dt);

		  $stmt->bindParam(':p_id', $_POST['p_id']);
		  //print_r($stmt); exit;
		  $stmt->execute();


		  if( strlen($p_imageName) > 0)
		  {
			  $pathThumb = UPLOAD_PATH_PRODUCT."thumb/";
			  $pathMedium = UPLOAD_PATH_PRODUCT."medium/";
			  $path = UPLOAD_PATH_PRODUCT;

			  $p_image = $p_imageNameOld;
			  //delete old images
			  $images =  explode(",", urldecode($p_image));
			  for ($k = 0; $k < count($images); $k++) {

				  if (file_exists($pathThumb.$images[$k])) {
					  unlink( $pathThumb.$images[$k] );
				  }
				  if (file_exists($pathMedium.$images[$k])) {
					  unlink( $path.$images[$k] );
				  }
				  if (file_exists($path.$images[$k])) {
					  unlink( $path.$images[$k] );
				  }



				  $sql2 = "DELETE FROM products_images WHERE p_id =  :p_id and pi_image= :pi_image";
				  $stmt2 = $dbh->prepare($sql2);
				  $stmt2->bindParam(':p_id', $_POST['p_id']);
				  $stmt2->bindParam(':pi_image', $images[$k]);
				  $stmt2->execute();
			  }

			  $p_image1 = $p_imageName;
			  $images1 =  explode(",", urldecode($p_image1));
			  for ($m = 0; $m < count($images1); $m++) {

				  $sql1 = "INSERT INTO products_images (p_id, pi_image) VALUES
                            (:p_id,:pi_image)";

				  $stmt1 = $dbh->prepare($sql1);

				  $stmt1->bindParam(':p_id', $_POST['p_id']);
				  $stmt1->bindParam(':pi_image', $images1[$m]);
				  $stmt1->execute();
			  }
		  }


		 
        echo json_encode('Information updated successfully!');
       
 		
	
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