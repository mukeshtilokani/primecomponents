<?php

$string = "25. Kemrock, Rack. 3D. vie.w, Halol, 2009.jpg";
$lastDot = strrpos($string, ".");
$string = str_replace(".", "", substr($string, 0, $lastDot)) . substr($string, $lastDot);


	$ext = pathinfo($string, PATHINFO_EXTENSION);

	$file = basename($string, ".".$ext); // $file is set to "home"
	echo $file;
?>

