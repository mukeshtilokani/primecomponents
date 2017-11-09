<?php
ob_start();
session_start();
header( 'Content-Type: text/html; charset=utf-8' ); 
 require("PHPExcel.php");

$link = mysql_pconnect("localhost", "root", "") or die("Unable To Connect To Database Server");
mysql_select_db("sms-kg") or die("Unable To Connect To Shah And Gandhi");
  
function add_contacts($gr_lname, $gr_fname, $gr_mname, $gr_mothername, $cst_id, $sub_cst, $gr_gender, $gr_dob, $gr_birthplace, $gr_adm_dt, $gr_no, $std_id, $div_id, $gr_rollno, $gr_left_dt, $gr_left_reason, $gr_lc_no) {
	
	 $qfire = mysql_query("SET NAMES utf8");
			$sql = "INSERT INTO general_register(gr_lname,
										gr_fname,
										gr_mname,
										gr_father_name,
										gr_mother_name,
										cst_id,
										sub_cst,
										gr_gender,
										gr_dob,
										gr_birthplace,
										gr_adm_dt,
										gr_no,
										std_id,
										div_id,
										gr_rollno,
										gr_left_dt,
										gr_left_reason,
										gr_lc_no,
										gr_active,
										gr_created_by,
										gr_created_dt)				
				VALUES ('".$gr_lname."','".$gr_fname."','".$gr_mname."','".$gr_mname."','".$gr_mothername."','".$cst_id."','".$sub_cst."','".$gr_gender."','".$gr_dob."','".$gr_birthplace."','".$gr_adm_dt."','".$gr_no."','".$std_id."','".$div_id."','".$gr_rollno."','".$gr_left_dt."','".$gr_left_reason."','".$gr_lc_no."','Y','1','".date('Y-m-d H:i:s') ."')";
			//echo $sql."\n";
			$qfire = mysql_query($sql);
//	VALUES ('".ucfirst($name)."','".$email."','','','','".$_POST['selGroup']."', now() ,'YES')";
	
	// here you write your query and store it into database
	//echo "add contact";
	/* $dsn = "mysql:dbname=sms-kg;host=localhost";
$username = "root";
$password="";
try {
		$dbh = new PDO($dsn, $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
		
		$active = "Y";
		$created = "1";
        $dt = date('Y-m-d H:i:s');
		$gr_adm_dt = date('Y-m-d H:i:s');
		$gr_dob = date('Y-m-d H:i:s');
		$gr_left_dt = date('Y-m-d H:i:s');
		
		if(strlen($gr_adm_dt) > 0)
		{
			$gr_adm_dt = date("Y-m-d",strtotime($gr_adm_dt));
		}
		if(strlen($gr_dob) > 0)
		{
			$gr_dob = date("Y-m-d",strtotime($gr_dob));		
		}
		if(strlen($gr_left_dt) > 0)
		{
			$gr_left_dt = date("Y-m-d",strtotime($gr_left_dt));
		}
		
		 $sql = "INSERT INTO general_register (gr_lname,
				gr_fname,
				gr_mname,
				gr_father_name,
				gr_mother_name,
				cst_id,
				sub_cst,
				gr_gender,
				gr_dob,
				gr_birthplace,
				gr_adm_dt,
				gr_no,
				std_id,
				div_id,
				gr_rollno,
				gr_left_dt,
				gr_left_reason,
				gr_lc_no,
				gr_active,
				gr_created_by,
				gr_created_dt) VALUES (:gr_lname,
				:gr_fname,
				:gr_mname,
				:gr_father_name,
				:gr_mother_name,
				:cst_id,
				:sub_cst,
				:gr_gender,
				:gr_dob,
				:gr_birthplace,
				:gr_adm_dt,
				:gr_no,
				:std_id,
				:div_id,
				:gr_rollno,
				:gr_left_dt,
				:gr_left_reason,
				:gr_lc_no,
				:gr_active,
				:gr_created_by,
				:gr_created_dt)";

                                              

        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':gr_lname', $gr_lname); 
		$stmt->bindParam(':gr_fname', $gr_fname); 
		$stmt->bindParam(':gr_mname', $gr_mname);
		 
			$stmt->bindParam(':gr_father_name', $gr_mname);  
			$stmt->bindParam(':gr_mother_name', $gr_mother_name);  
			$stmt->bindParam(':cst_id', $cst_id);  
			$stmt->bindParam(':sub_cst', $sub_cst);  
			$stmt->bindParam(':gr_gender', $gr_gender);  
			$stmt->bindParam(':gr_dob', $gr_dob);  
			$stmt->bindParam(':gr_birthplace', $gr_birthplace);  
			$stmt->bindParam(':gr_adm_dt', $gr_adm_dt);  
			$stmt->bindParam(':gr_no', $gr_no);  
			$stmt->bindParam(':std_id', $std_id);   
			$stmt->bindParam(':div_id', $div_id);   
			$stmt->bindParam(':gr_rollno', $gr_rollno);  
			$stmt->bindParam(':gr_left_dt', $gr_left_dt);   
			$stmt->bindParam(':gr_left_reason', $gr_left_reason);    
			$stmt->bindParam(':gr_lc_no', $gr_lc_no);
	
			// use PARAM_STR although a number
			$stmt->bindParam(':gr_active', $active);
			$stmt->bindParam(':gr_created_by', $created);
			$stmt->bindParam(':gr_created_dt', $dt); 
        
        $stmt->execute();  
			} catch(PDOException $e)
    {
    echo $e->getMessage();
    }*/
	 
}

function import_contacts_from_xls($path) {

	$total = 0;
	if(!file_exists($path)) return false;

	$pathinfo = pathinfo($path);
	$file_extension= isset($pathinfo['extension'])?$pathinfo['extension']:'';

	 $file_extension = strtolower($file_extension);

	$excel_reader_type = '';

	if($file_extension == 'xls')
	  $excel_reader_type = 'Excel5';
	else if($file_extension == 'xlsx')
	  $excel_reader_type = 'Excel2007';

	if(!$excel_reader_type) return false;

	$objReader = PHPExcel_IOFactory::createReader($excel_reader_type);
	$objPHPExcel = $objReader->load($path);

	foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {

		foreach ($worksheet->getRowIterator() as $row) {

			// Reset the variables
			
			$gr_lname = '';
			$gr_fname = '';
			$gr_mname = '';
			$gr_mothername = '';
			$cst_id = '';
			$sub_cst = '';
			$gr_gender = '';
			$gr_dob = '';
			$gr_birthplace = '';
			$gr_adm_dt = '';
			$gr_no = '';
			$std_id = '';
			$div_id = '';
			$gr_rollno = '';
			$gr_left_dt = '';
			$gr_left_reason = '';
			$gr_lc_no = '';
			

			

			$cellIterator = $row->getCellIterator();
			//$cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set		

			foreach ($cellIterator as $key => $cell) {

				if (is_null($cell)) continue;								

				switch($key) {
					case 0:
						$gr_lname = $cell->getCalculatedValue();
						break;
					case 1:
						$gr_fname = $cell->getCalculatedValue();
						break;
					case 2:
						$gr_mname = $cell->getCalculatedValue();
						break;
					case 3:
						$gr_mothername = $cell->getCalculatedValue();
						break;
					case 4:
						$cst_id = $cell->getCalculatedValue();
						break;
					case 5:
						$sub_cst = $cell->getCalculatedValue();
						break;
					case 6:
						$gr_gender = $cell->getCalculatedValue();
						break;
					case 7:
						$gr_dob = $cell->getCalculatedValue();
						break;
					case 8:
						$gr_birthplace = $cell->getCalculatedValue();
						break;
					case 9:
						$gr_adm_dt = $cell->getCalculatedValue();
						break;
					case 10:
						$gr_no = $cell->getCalculatedValue();
						break;
					case 11:
						$std_id = $cell->getCalculatedValue();
						break;
					case 12:
						$div_id = $cell->getCalculatedValue();
						break;
					case 13:
						$gr_rollno = $cell->getCalculatedValue();
						break;
					case 14:
						$gr_left_dt = $cell->getCalculatedValue();
						break;
					case 15:
						$gr_left_reason = $cell->getCalculatedValue();
						break;
					case 16:
						$gr_lc_no = $cell->getCalculatedValue();
						break;
					default:
						break;
				}
			}			

			if(!$gr_fname) continue;

			$res = add_contacts($gr_lname, $gr_fname, $gr_mname, $gr_mothername, $cst_id, $sub_cst, $gr_gender, $gr_dob, $gr_birthplace, $gr_adm_dt, $gr_no, $std_id, $div_id, $gr_rollno, $gr_left_dt, $gr_left_reason, $gr_lc_no);
			if(!$res) continue;
			$total++;

		}
	}

	return $total;
}// end function
?>
<?php
// upload File first
$file_name="";
 if ($_FILES["file"]["name"]!="")
 {
	 //set_time_limit(120);
	 $random_digit=rand(0000,9999);
	 $file_name = $random_digit.$_FILES["file"]["name"];
	  move_uploaded_file($_FILES["file"]["tmp_name"],"uploadExcelfiles/" .$file_name );
 }


$file_name = "uploadExcelfiles/".$file_name;// Write full path

$total = import_contacts_from_xls($file_name);


if($total !== false) {
	$total .' Contact(s) has been added successfully.';
	//header("Location:../../index.php?mo=contacts&msg=1");
}
else {
	//echo 'Not able to process this file.';
	//header("Location:../../index.php?mo=addContacts&msg=2");
}
?>