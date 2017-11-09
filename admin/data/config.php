<?php
$dsn = "mysql:dbname=cpprime_dbx;host=localhost";
$username = "cpprime_usr";
$password="Client$987321654";
$dbConnectError = "Unable To Connect To Database Server";
define("SITEURLFRONT","http://primecomponents.net/");
define("SITEURL","http://primecomponents.net/admin/");

define("UPLOAD_PATH_CATEGORY", $_SERVER['DOCUMENT_ROOT'].'/images/cat/' );
define("UPLOAD_PATH_SUBCATEGORY", $_SERVER['DOCUMENT_ROOT'].'/images/subcat/' );
define("UPLOAD_PATH_PHOTO_GALLERY", $_SERVER['DOCUMENT_ROOT'].'/images/photogallery/' );
define("UPLOAD_PATH_PRODUCT", $_SERVER['DOCUMENT_ROOT'].'/images/products/' );
define("UPLOAD_PATH_PRODUCT_PDF", $_SERVER['DOCUMENT_ROOT'].'/images/pdf/' );
define("UPLOAD_PATH_UPCOMING", $_SERVER['DOCUMENT_ROOT'].'/images/upcoming/' );
define("UPLOAD_PATH_CLIENT", $_SERVER['DOCUMENT_ROOT'].'/images/clients/' );
define("UPLOAD_PATH_CLIENT_PHOTOS", $_SERVER['DOCUMENT_ROOT'].'/images/clientphotos/' );
define("UPLOAD_PATH_APPLICATION", $_SERVER['DOCUMENT_ROOT'].'/images/applications/' );
define("UPLOAD_PATH_PDF_GALLERY", $_SERVER['DOCUMENT_ROOT'].'/images/pdfgallery/' );
define("UPLOAD_PATH_HOME_BANNERS", $_SERVER['DOCUMENT_ROOT'].'/images/homebanners/' );
define("UPLOAD_PATH_APPRAISALS", $_SERVER['DOCUMENT_ROOT'].'/images/appraisals/' );

?>