<?php
ob_start();
session_start();
header( 'Content-Type: text/html; charset=utf-8' ); 
 require("PHPExcel.php");
$link = mysql_pconnect("localhost", "root", "123") or die("Unable To Connect To Database Server");mysql_select_db("db_primec") or die("Unable To Connect To Database Server");

function add_contacts($p_pc_id,$psubc_id, $p_title, $p_alias, $p_pitch, $p_current, $p_voltage, $p_h1, $p_image, $p_catalog_file, $p_upcoming, $p_intro, $p_description, $ai_id) {
	
			$p_title=stringURLSafe($p_title);
			$sql = "INSERT INTO product(p_pc_id,psubc_id, p_title, p_alias, p_pitch, p_current, p_voltage, p_h1, p_image, p_catalog_file, p_upcoming, p_intro, p_description, ai_id,p_active, p_created_by, p_created_dt)				
				VALUES ( '".$p_pc_id."','".$psubc_id."','". strtoupper(addslashes($p_title))."','".$p_alias."','".$p_pitch."','".$p_current."','".$p_voltage."','".$p_h1."','".$p_image."','".$p_catalog_file."','".$p_upcoming."','".$p_intro."','".$p_description."','".$ai_id."','Y','1','".date('Y-m-d H:i:s') ."')";
			//echo $sql."\n";
			$qfire = mysql_query($sql);
}

function stringURLSafe($string)
{
    // remove any '-' from the string since they will be used as concatenaters
    $str = str_replace('-', ' ', $string);
    // Trim white spaces at beginning and end of alias and make lowercase
    $str = trim(strtolower($str));
    // Remove any duplicate whitespace, and ensure all characters are alphanumeric
    $str = preg_replace('/(\s|[^A-Za-z0-9\-])+/', '-', $str);
    // Trim dashes at beginning and end of alias
    $str = trim($str, '-');
    return $str;
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
			$p_pc_id= '';
			$psubc_id = '';
			$p_title = '';
			$p_alias = '';
			$p_pitch = '';
			$p_current = '';
			$p_voltage = '';
			$p_h1 = '';
			$p_image = '';
			$p_catalog_file = '';
			$p_upcoming = '';
			$p_intro = '';
			$p_description = '';
			$ai_id = '';
			$cellIterator = $row->getCellIterator();
			//$cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set		
			foreach ($cellIterator as $key => $cell) {
				if (is_null($cell)) continue;			
				switch($key) {
					case 0:
						$p_pc_id = $cell->getCalculatedValue();
						break;
					case 1:
						$psubc_id = $cell->getCalculatedValue();
						break;
					case 2:
						$p_title = $cell->getCalculatedValue(); 
						break;
					case 3:
						$p_alias = $cell->getCalculatedValue();
						break;
					case 4:
						$p_pitch = $cell->getCalculatedValue();
						break;
					case 5:
						$p_current = $cell->getCalculatedValue();
						break;
					case 6:
						$p_voltage = $cell->getCalculatedValue();
						break;
					case 7:
						$p_h1 = $cell->getCalculatedValue();
						break;
					case 8:
						$p_image = $cell->getCalculatedValue();
						break;
					case 9:
						$p_catalog_file = $cell->getCalculatedValue();
						break;
					case 10:
						$p_upcoming = $cell->getCalculatedValue();
						break;
					case 11:
						$p_intro = $cell->getCalculatedValue();
						break;
					case 12:
						$p_description = $cell->getCalculatedValue();
						break;
					case 13:
						$ai_id = $cell->getCalculatedValue();
						break;
					default:
						break;
				}

			}	
			if(!$p_title) continue;
			$res = add_contacts($p_pc_id,$psubc_id, $p_title, $p_alias, $p_pitch, $p_current, $p_voltage, $p_h1, $p_image, $p_catalog_file, $p_upcoming, $p_intro, $p_description, $ai_id);
			
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