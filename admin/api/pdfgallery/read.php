<?php
ob_start();
$sess_name = session_name();
if (session_start()) {
    setcookie($sess_name, session_id(), null, '/', null, null, true);
}
if(isset($_SESSION['wf_id']) && strlen($_SESSION['wf_id']) > 0) // login check
{

    require_once '../../data/config.php';

    header('Content-Type: application/json');





    try {

        $dbh = new PDO($dsn, $username, $password);

        /*** echo a message saying we have connected ***/
        //echo 'Connected to database<br />';

        /*** The SQL SELECT statement ***/

        $sql = $dbh->prepare("SELECT * FROM pdf_galleries pdfgl LEFT JOIN
							  p_categories pc on pdfgl.pc_id = pc.pc_id
							  WHERE pc.pc_active='Y' and  pdfgl.pdfgl_active ='Y'");
        $sql->execute();
        $result = $sql->fetchAll();
        $data = $result;


        $data = array(
            'data' =>$result
        );

        echo json_encode($data);

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
    require_once '../../login.php';
}


?>