<?php
error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors','On');

include "engine/conf.php";
include "engine/util.php";
include "engine/d_race.php";
include "engine/d_champ.php";

$connection = mysql_connect(RM_DB_ADDRESS,RM_DB_USER,RM_DB_PASS);
mysql_select_db(RM_DB_NAME, $connection);

$rm = new raceManager;
$cm = new champManager;

$cl = $cm->getClass($_GET['class'] ? $_GET['class'] : "",1);

if (count($cl) <= 1 ){
	$filename = "WP-".strtoupper(substr($cl[0]->getName(),0,2));
} else {
	if ($_GET['mode']=="gps"){
		$filename = "WP-GPS";
	} else {
		$filename = "WP-VISI";
	}
	
}

header( 'Content-Disposition: attachment; filename="'.$filename.'.wpt"' );

	
if ($_GET["opt"]){
	
	if ($_GET['class']){
		$class = $_GET['class'];
	} else {
		$class = "";
	}
	$list = "";
	if ($_GET['mode']=="gps"){
		$list = $rm->getGPSChPoint($_GET['opt']);
	} else {
		$list = $rm->getChPoint("",$_GET['opt'],"","");
	}
	
	
	
	echo "OziExplorer Waypoint File Version 1.1",chr(13),chr(10);
	echo "WGS 84",chr(13),chr(10);
	echo "Reserved 2",chr(13),chr(10);
	echo "magellan",chr(13),chr(10);
	
	
	$i =0;
	while (isset($list[$i]) ){
		if(($rm->getChpDet("",$_GET['class'],$list[$i]->getID()) and !$list[$i]->getCtD() ) or !isset($_GET['class'])){
			$str = explode(",",$list[$i]->getWP());
			$name = $list[$i]->getWPName();
		
			if ($list[$i]->getName() <> ""){
				$name = $list[$i]->getName()."".$list[$i]->getCost();
			}
		
			$out = ($i+1).",".$name;		
			for ($j=2;$j<24;$j++){			
				if ($j==10){
					$out= $out.",".$list[$i]->getNotes();
				} elseif($j==2){
					$out= $out.",".$list[$i]->getLat();
				} elseif($j==3){
					$out= $out.",".$list[$i]->getLong();
				} elseif($j==5){
					$out= $out.",99";
				} elseif($j==7){
					$out= $out.",3";
				} elseif($j==9){
					$out= $out.",".$list[$i]->getLabBgColor();
				} elseif($j==11){
					$out= $out.",".$list[$i]->getLabDir();
				} elseif($j==17){
					$out= $out.",17";
				} else if ($j==15){
					$out= $out.",7";
				} else{
					$out= $out.",".trim($str[$j]);
				}
			}
		
			$out=$out.chr(13).chr(10);
			print( $out);
		}
		
		$i++;
	}
} 
mysql_close ($connection);
?>
