<?PHP

  require_once '../../data/config.php';

  header('Content-Type: application/json');





try {

    $dbh = new PDO($dsn, $username, $password);

    /*** echo a message saying we have connected ***/

    //echo 'Connected to database<br />';



    /*** The SQL SELECT statement ***/

    $sql = $dbh->prepare("SELECT * FROM products p LEFT JOIN
                                p_categories c ON p.p_pc_id = c.pc_id
                                LEFT JOIN
                                p_subcategories s ON p.psubc_id = s.psubc_id
                                WHERE
                                p.p_active='Y'  ORDER BY c.pc_order ASC");
								
	/*$sql = $dbh->prepare("SELECT * FROM product p LEFT JOIN 
                                p_category c ON p.p_pc_id = c.pc_id WHERE
                                p.p_active='Y' ORDER BY p_order ASC");*/
// 		$sql->bindParam(':pc_id', $_POST['pc_id']);

        $sql->execute();
        $result = $sql->fetchAll(); 
        $data = $result;
    	$data = array("data" =>$result);
    	echo json_encode($data);

    /*** close the database connection ***/

    $dbh = null;

}

catch(PDOException $e)

    {

    echo $e->getMessage();

    }

 

?>

