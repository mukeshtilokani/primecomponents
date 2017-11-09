<?PHP

  require_once '../../data/config.php';

  header('Content-Type: application/json');





try {

    $dbh = new PDO($dsn, $username, $password);

    /*** echo a message saying we have connected ***/

    //echo 'Connected to database<br />';



    /*** The SQL SELECT statement ***/

    $sql = $dbh->prepare("SELECT * FROM product p LEFT JOIN 
                                p_category c ON p.p_pc_id = c.pc_id WHERE
                                p.p_active='Y' ");
								
	/*$sql = $dbh->prepare("SELECT * FROM product p LEFT JOIN 
                                p_category c ON p.p_pc_id = c.pc_id WHERE
                                p.p_active='Y' ORDER BY p_order ASC");*/ 

        $sql->execute();
        $result = $sql->fetchAll(); 
        $data = $result;
    
    echo json_encode($data);

    /*** close the database connection ***/

    $dbh = null;

}

catch(PDOException $e)

    {

    echo $e->getMessage();

    }

 

?>

