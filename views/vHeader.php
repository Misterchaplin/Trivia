<?php 
require_once 'technics/Gui.php';
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<?php 
if(substr($_SERVER['REQUEST_URI'],8,8) == "CDomaine"){	?>
	
<!-- <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/themes/ui-lightness/jquery-ui.css">
	<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.0/themes/ui-lightness/jquery-ui.css"> -->	
	<link rel="stylesheet" href="<?php echo $GLOBALS["siteUrl"]?>css/1814ui-lightnessjquery-ui.css">
	<link rel="stylesheet" href="<?php echo $GLOBALS["siteUrl"]?>css/19ui-lightnessjquery-ui.css">
	<link rel="stylesheet" href="<?php echo $GLOBALS["siteUrl"]?>css/demo.css">
	<link rel="stylesheet" href="<?php echo $GLOBALS["siteUrl"]?>css/bootstrap.css">
	<link rel="stylesheet" href="<?php echo $GLOBALS["siteUrl"]?>css/bootstrap-responsive.css">
	<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.0/jquery-ui.min.js"></script>-->
	<script src="<?php echo $GLOBALS["siteUrl"]?>js/1.8.0jquery.min.js"></script>
	<script src="<?php echo $GLOBALS["siteUrl"]?>js/1.9.0jquery-ui.min.js"></script>
	<script src="<?php echo $GLOBALS["siteUrl"]?>js/roulette.js"></script>
	
<?php
}
elseif(substr($_SERVER['REQUEST_URI'],8,9) == "CQuestion"){	?>
	<link rel="stylesheet" href="<?php echo $GLOBALS["siteUrl"]?>css/smoothnessjquery-ui.css">
	<script type="text/javascript" src="<?php echo $GLOBALS["siteUrl"]?>js/jquery-2.0.3.js"></script>
	<script type="text/javascript" src="<?php echo $GLOBALS["siteUrl"]?>js/progressBar.js"></script>
	
<?php
}
else{
	?>
	<script type="text/javascript" src="<?php echo $GLOBALS["siteUrl"]?>js/jquery-2.0.3.js"></script>
	<?php
}
	?>
<script src="<?php echo $GLOBALS["siteUrl"]?>js/demo.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS["siteUrl"]?>js/1.11.1jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS["siteUrl"]?>js/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS["siteUrl"]?>js/1.11.1jquery-ui.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS["siteUrl"]?>css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS["siteUrl"]?>css/smoothnessjquery-ui.css">

  
<title></title>
</head>
<body>
