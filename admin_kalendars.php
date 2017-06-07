<?php 

session_start();

// error_reporting(E_ALL ^ E_NOTICE);

//include "auth.php";

require_once "class_admin.php";

require_once "BB3Auth.php";
$bb3auth = new BB3Auth;
$bb3auth->login();




global $valodas;
$valodas = array("lv");

if(!$_SESSION['lang']) 
{ 
	$_SESSION['lang'] = "lv";
}

if(isset($_GET['lang']))
{
	if(in_array($_GET['lang'], $valodas))
	{
		$_SESSION['lang'] = $_GET['lang'];
	}	
}



	$adm = new admin("items");
	$adm->isAdmin = true;

	$cal = new Kalendars($adm);
	$cal->update();

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title> Admin </title>
	
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		
	<script type="text/javascript" src="js/jquery-1.3.2.js"></script>
	<script type="text/javascript" src="js/ui/ui.core.js"></script>
	<script type="text/javascript" src="js/ui/ui.tabs.js"></script>
	<script type="text/javascript" src="js/ui/ui.datepicker.js"></script>
	<script type="text/javascript" src="js/ajax.js"></script>
	
	<link type="text/css" rel="stylesheet" href="css/custom-theme/jquery-ui-1.7.2.custom.css" >
	
	<script type="text/javascript">

	$(document).ready(function(){

		$('#container-1').tabs();
		$('input.date').datepicker({ firstDay: 1, dateFormat: 'yy-mm-dd'});
		 
	});
	
	</script>
	
	
	<style type="text/css">
		body, table {
			font-size: 11px;
			margin: 0;
			padding: 0;
		}
		
		.ui-tabs-panel {
			padding: 10px 0 0 0 !important;
		}
	</style>
	
	
</head>

<body>

<form action="" method="post">

<?php 

	echo $cal->admin($_GET['id']);

?>

</form>

</body>
</html>