<?PHP

  require_once '../../data/config.php';

  header('Content-Type: application/json');





try {

    $dbh = new PDO($dsn, $username, $password);

    /*** echo a message saying we have connected ***/

    //echo 'Connected to database<br />';



    /*** The SQL SELECT statement ***/

    $sql = $dbh->prepare("SELECT * FROM clients
                                WHERE
                                cl_active='Y' ");

        $sql->execute();
        $result = $sql->fetchAll(); 
        $data = $result;
    $data = [
        'data' =>$result
    ];
    echo json_encode($data);

    /*** close the database connection ***/

    $dbh = null;

}

catch(PDOException $e)

    {

    echo $e->getMessage();

    }

 

?>

