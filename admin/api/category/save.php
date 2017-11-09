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

	  $request = json_decode(file_get_contents('php://input'));
	  try {
		$dbh = new PDO($dsn, $username, $password);
		$active = "Y";
		$dt = date('Y-m-d H:i:s');
		
		
		 //check for duplicates

        $sql1 = $dbh->prepare("SELECT * FROM p_categories WHERE pc_active='Y' AND lower(pc_title)='". strtolower(trim($_POST['pc_title']))."' ORDER BY pc_title ASC");

        $sql1->execute();

        $result1 = $sql1->fetchAll();

         //end check

        

if(count($result1)> 0)        

{

    

    echo json_encode('Duplicate Entry!');

}

else

{

//    function saveImage($base64img){
//        define('UPLOAD_DIR', '../../../images/cat/');
//
//        if (strpos($base64img,'data:image/png;base64') !== false) {
//            $img = str_replace('data:image/png;base64,', '', $base64img);
//        }
//        else if (strpos($base64img,'data:image/jpeg;base64') !== false){
//            $img = str_replace('data:image/jpeg;base64,', '', $base64img);
//        }
//        $img = str_replace('data:image/png;base64,', '', $base64img);
//        $img = str_replace(' ', '+', $img);
//        $data = base64_decode($img);
//
//        if (strpos($base64img,'data:image/png;base64') !== false) {
//            $imageUidName = uniqid() . '.png';
//        }
//        else if (strpos($base64img,'data:image/jpeg;base64') !== false){
//            $imageUidName = uniqid() . '.jpg';
//        }
//
//        $file = UPLOAD_DIR . $imageUidName;
//       file_put_contents($file, $data);
//        return $imageUidName;
//    }
//    $imgNameSave =  saveImage($_POST['pc_imagePath']);




		/*** echo a message saying we have connected ***/
		/*** INSERT data ***/
		$sql = "INSERT INTO p_categories(pc_title,
				pc_image,
				pc_alias,
				pc_desc,
				pc_active,
				pc_created_by,
				pc_created_dt) VALUES (
				:pc_title,
				:pc_image,
				:pc_alias,
				:pc_desc,
				:pc_active,
				:pc_created_by,
				:pc_created_dt)";
				
	 	
											  
		$stmt = $dbh->prepare($sql);
							 	  
		$stmt->bindParam(':pc_image', $_POST['pc_imageName']);
		//$stmt->bindParam(':pc_icon', $_POST['pc_iconName']);
		$stmt->bindParam(':pc_title', $_POST['pc_title']);      
		$stmt->bindParam(':pc_alias', $_POST['pc_alias']);
		$stmt->bindParam(':pc_desc', $_POST['pc_desc']);
		// use PARAM_STR although a number 
		$stmt->bindParam(':pc_active', $active);  
		$stmt->bindParam(':pc_created_by', $_SESSION['wf_id']);  
		$stmt->bindParam(':pc_created_dt', $dt);     
		//print_r($stmt); exit;							  
		$stmt->execute(); 
		//$newId = $dbh->lastInsertId();
		//$request = $newId;
        
 		echo json_encode('Information saved successfully!');
	
		/*** close the database connection ***/
}
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