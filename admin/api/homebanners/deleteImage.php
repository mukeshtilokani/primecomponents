<?php
ob_start();
session_start();
require_once '../../data/config.php';
  header('Content-Type: application/json');
try {
    $dbh = new PDO($dsn, $username, $password);


    /*** The SQL SELECT statement ***/

    $image = $_POST['imgName'];

    $path = UPLOAD_PATH_HOME_BANNERS;

    unlink($path . $image);


    $sql = "DELETE FROM home_banners WHERE hi_id =  :hi_id ";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':hi_id', $_POST['hi_id']);
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

