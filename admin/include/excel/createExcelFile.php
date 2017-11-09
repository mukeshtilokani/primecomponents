<?php
include("../../config.php");
// require the PHPExcel file

require 'PHPExcel.php';
	$cgp_id = $_REQUEST["cgp_id"];
// simple query

	if($cgp_id!="")
	{
		$where = " WHERE spc_user_group_id='".$cgp_id."'";	
	}
	else
	{
		$where="";	
	}
										

$query = "SELECT spc_name,spc_email,spc_company_name,spc_designation,spc_phone FROM sprech_contacts  $where ORDER BY spc_name";
$headings = array('Name', 'Email', 'Company', 'Designation', 'Phone');

if ($result = mysql_query($query) or die(mysql_error())) {
    // Create a new PHPExcel object
    $objPHPExcel = new PHPExcel();
    $objPHPExcel->getActiveSheet()->setTitle('List of Users');

    $rowNumber = 1;
    $col = 'A';
    foreach($headings as $heading) {
       $objPHPExcel->getActiveSheet()->setCellValue($col.$rowNumber,$heading);
       $col++;
    }

    // Loop through the result set
    $rowNumber = 2;
    while ($row = mysql_fetch_row($result)) {
       $col = 'A';
       foreach($row as $cell) {
          $objPHPExcel->getActiveSheet()->setCellValue($col.$rowNumber,$cell);
          $col++;
       }
       $rowNumber++;
    }

    // Freeze pane so that the heading line will not scroll
    $objPHPExcel->getActiveSheet()->freezePane('A2');

    // Save as an Excel BIFF (xls) file
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

   header('Content-Type: application/vnd.ms-excel');
   header('Content-Disposition: attachment;filename="contactList.xlsx"');
   header('Cache-Control: max-age=0');

   $objWriter->save('php://output');
   exit();
}
echo 'a problem has occurred... no data retrieved from the database';