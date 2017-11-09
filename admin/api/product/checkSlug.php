<?PHP

	require_once '../../data/config.php';

	header('Content-Type: application/json');
	try {

		$dbh = new PDO($dsn, $username, $password);

		/*** echo a message saying we have connected ***/

		//echo 'Connected to database<br />';


		$slug =$_POST['p_alias'];
		/*** The SQL SELECT statement ***/

		$sql = $dbh->prepare("SELECT p_alias FROM products
                                WHERE
                                p_active='Y' and p_alias=:p_alias ");


 		$sql->bindParam(':p_alias', $slug);

		$sql->execute();
		$result = $sql->fetchAll();

		if( count($result) > 0)
		{
			$rand = rand();
			echo $slug."-".$rand;

		}

		/*** close the database connection ***/

		$dbh = null;

	}

	catch(PDOException $e)

	{

		echo $e->getMessage();

	}



?>

