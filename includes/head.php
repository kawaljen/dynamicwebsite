<?php 
include("tools/connectbd.php");
include("tools/functions.php");


?>
<!DOCTYPE html>
<html lang="fr">
<head>
<title><?php if(isset($titrepage)){ echo $titrepage;} else {echo 'page';}?></title>
	<link rel="stylesheet" href="css/style.css" type="text/css"/>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="js/slider.js" async></script>
</head>
