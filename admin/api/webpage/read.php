<?PHP

  require_once '../../data/config.php';

  header('Content-Type: application/json');





try {

    $dbh = new PDO($dsn, $username, $password);

    /*** echo a message saying we have connected ***/

    //echo 'Connected to database<br />';



    /*** The SQL SELECT statement ***/

    $sql = $dbh->prepare("SELECT  *  FROM webpages WHERE wp_active='Y' ORDER BY wp_title ASC");

    $sql->execute();

	$results = $sql->fetchAll();
  //  $resultNew = array();

   // for($i=0; $i< count($results); $i++)
  //  {
   //     $resultNew[$i]['wp_id'] = html_entity_decode($results[$i]['wp_id']);
   //     $resultNew[$i]['edit1'] = html_entity_decode($results[$i]['edit1']);
 //       $resultNew[$i]['delete1'] = html_entity_decode($results[$i]['delete1']);
   //     $resultNew[$i]['wp_title'] = html_entity_decode($results[$i]['wp_title']);
 //       $resultNew[$i]['wp_description'] = html_entity_decode($results[$i]['wp_description']);
 //   }



    $data = array(
        'data' =>$results
    );

    //$data = $result;

	echo json_encode($data);

    /*** close the database connection ***/

    $dbh = null;

}

catch(PDOException $e)

    {

    echo $e->getMessage();

    }

 

?>

