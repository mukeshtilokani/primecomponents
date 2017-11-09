<?php
ob_start();
session_start();
require_once '../../data/config.php';
  header('Content-Type: application/json');
try {
    $dbh = new PDO($dsn, $username, $password);


    /*** The SQL SELECT statement ***/

    $image = $_POST['imgName'];
    $pathThumb = UPLOAD_PATH_PHOTO_GALLERY."thumb/";
    $path = UPLOAD_PATH_PHOTO_GALLERY;

    if (file_exists($pathThumb . $image)) {
        unlink( $pathThumb . $image );
    }
    if (file_exists($path . $image)) {
        unlink( $path . $image );
    }


    $sql = "DELETE FROM photo_gallery_images WHERE pgli_id =  :pgli_id and pc_id= :pc_id";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':pc_id', $_POST['pc_id']);
    $stmt->bindParam(':pgli_id', $_POST['pgli_id']);
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

