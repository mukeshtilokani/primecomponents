<!DOCTYPE html>
<?php include("data/config.php"); ?>
<html lang="en">
<head>
	<meta charset="utf-8">
	<!--[if IE]>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<![endif]-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<title><?php
			$pageName =  basename($_SERVER['PHP_SELF']);
			if($pageName=="index.php")
			{
				echo "Prime Components - Home";
				$_SESSION['pagealias'] = "home";
			}
			else if($pageName=="about.php")
			{
				echo "Prime Components - About Us";
				$_SESSION['pagealias'] = "about-us";
			}
			else if($pageName=="contact.php")
			{
				echo "Prime Components - Contact Us";
			}
			else
			{
				echo "Prime Components";
			}
			//$pageURL = substr($_SERVER['REQUEST_URI'], strlen(dirname($_SERVER['SCRIPT_NAME'])));
			$pageURL = $_SERVER["REQUEST_URI"];
			$pageAlias = explode("/",$pageURL);

			if($pageAlias[1]=="")
			{
				$pageAlias[1]="home";
			}
		?> </title>

	<!-- Favicons Icon -->


	<!-- Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- CSS Style -->
	<!--<link rel="stylesheet" href="css/animate.css" type="text/css">-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
	<link rel="stylesheet" href="<?=SITEURL?>css/slider.css" type="text/css">
	<link rel="stylesheet" href="<?=SITEURL?>css/owl.carousel.css" type="text/css">
	<link rel="stylesheet" href="<?=SITEURL?>css/owl.theme.css" type="text/css">
	<link rel="stylesheet" href="<?=SITEURL?>css/font-awesome.css" type="text/css">
	<link rel="stylesheet" href="<?=SITEURL?>css/style.css" type="text/css">


	<link rel="stylesheet" href="<?=SITEURL?>css/flexslider.css" type="text/css">
	<link rel="stylesheet" href="<?=SITEURL?>css/fancybox.css" type="text/css">

	<!-- Google Fonts -->
	<link href='https://fonts.googleapis.com/css?family=Lato:400,300,700,900' rel='stylesheet' type='text/css'>

	<script type="text/javascript" src="<?=SITEURL?>js/jquery.min.js"></script>
	<script type="text/javascript" src="<?=SITEURL?>js/bootstrap.min.js"></script>
</head>




