<?php
ob_start();
$sess_name = session_name();
if (session_start()) {
    setcookie($sess_name, session_id(), null, '/', null, null, true);
}
if (isset($_SESSION['wf_id']) && strlen($_SESSION['wf_id']) > 0) // login check
{
    require_once '../../data/config.php';
    header('Content-Type: application/json');

    $request = json_decode(file_get_contents('php://input'));
    try {
        $dbh = new PDO($dsn, $username, $password);
        $active = "Y";
        $dt = date('Y-m-d H:i:s');


        //check for duplicates

        $sql1 = $dbh->prepare("SELECT * FROM applications WHERE app_active='Y' AND lower(app_title)='" . strtolower(trim($_POST['app_title'])) . "' ORDER BY app_title ASC");

        $sql1->execute();

        $result1 = $sql1->fetchAll();

        //end check


        if (count($result1) > 0) {


            echo json_encode('Duplicate Entry!');

        } else {


            /*** echo a message saying we have connected ***/
            /*** INSERT data ***/
            $sql = "INSERT INTO applications (app_title,pc_id,
				app_alias,
				app_desc,
				app_active,
				app_created_by,
				app_created_dt) VALUES (
				:app_title, :pc_id,
				:app_alias,
				:app_desc,
				:app_active,
				:app_created_by,
				:app_created_dt)";

            $stmt = $dbh->prepare($sql);


            $stmt->bindParam(':pc_id', $_POST['pc_id']);
            $stmt->bindParam(':app_title', $_POST['app_title']);
            $stmt->bindParam(':app_alias', $_POST['app_alias']);
            $stmt->bindParam(':app_desc', $_POST['app_desc']);
            // use PARAM_STR although a number
            $stmt->bindParam(':app_active', $active);
            $stmt->bindParam(':app_created_by', $_SESSION['wf_id']);
            $stmt->bindParam(':app_created_dt', $dt);
            //print_r($stmt); exit;
            $stmt->execute();
            //$newId = $dbh->lastInsertId();
            //$request = $newId;

            $newId = $dbh->lastInsertId();

            $images = explode(",", urldecode($_POST['app_images']));
            for ($k = 0; $k < count($images); $k++) {

                $sql1 = "INSERT INTO applications_images (app_id, appi_image) VALUES
									(:app_id,:appi_image)";

                $stmt1 = $dbh->prepare($sql1);

                $stmt1->bindParam(':app_id', $newId);
                $stmt1->bindParam(':appi_image', $images[$k]);
                $stmt1->execute();
            }


            echo json_encode('Information saved successfully!');

            /*** close the database connection ***/
        }
        $dbh = null;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
} else {
    require_once '../../login.php';
}
?>