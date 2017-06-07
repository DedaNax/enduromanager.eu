<?php


// error_reporting(E_ALL ^ E_NOTICE);

// include "auth.php";

require_once "class_admin.php";

require_once "BB3Auth.php";
$bb3auth = new BB3Auth;
$bb3auth->login();


session_start();



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





$myFile = "admin.htm";
$fh = fopen($myFile, 'r');
$template = fread($fh, filesize($myFile));
fclose($fh);


if($adm->isAdmin)
{
	// nododam vertibas;

	$adm->setID($_GET['id']);	
	$adm->admin($_REQUEST['admin']);

	$template = str_replace("<top>", $adm->adminTopCategories($adm->showTopCategories()), $template);
	$template = str_replace("<side>", $adm->adminSideCategories($adm->showSideCategories()), $template);

	$template = str_replace("<logo>", $bb3auth->link(), $template);
	$template = str_replace("<logout>", $bb3auth->logout(), $template);

	$template = str_replace("<body>", $adm->adminBody(), $template);
	$template = str_replace('<script type="text/javascript"></script>', js(), $template);
	
	$template = str_replace('="/apPasaule/', '="' . BASE_URL, $template);
}




$k=1;

foreach($valodas as $value)
{
	if($value == $_SESSION['lang'])
	{
		$slang .= "<a href='?lang=$value' style='font-family: arial; font-size: 12px; color: red;'><b>". 
		//mb_strtoupper($value, "utf-8") ."</a>";
		strtoupper($value) ."</a>";
	} else {
		//$slang .= "<a href='?lang=$value' style='font-family: arial; font-size: 10px; color: gray;'> ". mb_strtoupper($value, "utf-8") ." </a>";
		$slang .= "<a href='?lang=$value' style='font-family: arial; font-size: 10px; color: gray;'> ". strtoupper($value) ." </a>";
	}

	if(count($valodas) > $k)
	{
		$slang .= " <span style='color: #CEDBD5;'>|</span> ";
	}

	$k++;
}

$template = str_replace("<lang>", $slang, $template);




echo $template;



?>