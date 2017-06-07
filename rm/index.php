<?php



error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors','On');

include "engine/conf.php";

include "AP.php";
$ap = new AP;

include "engine/emailconf.php";
include "engine/print.php";
include "engine/util.php";
include "engine/a_security.php";
include "engine/c_racer.php";
include "engine/d_champ.php";
include "engine/d_race.php";
include "engine/e_teamrace.php";
include "engine/f_champpts.php";
include "engine/GUI.php";
include "engine/result.php";
include "engine/mailing.php";
include "engine/enduro.php";
include "engine/enduro_print.php";
include "engine/enduro_result.php";
include "engine/applicant.php";
include "engine/lake.php";
include "../wwwenduromanagereu/lang/lat.php";


$connection = mysql_connect(RM_DB_ADDRESS,RM_DB_USER,RM_DB_PASS);
mysql_select_db(RM_DB_NAME, $connection);



$rm_mode = isset($_GET['rm_mode']) ? $_GET['rm_mode'] : $_POST['rm_mode'];
$func = isset($_GET['print_func']) ? $_GET['print_func'] : $_POST['print_func'];
$print_mode = isset($_GET['print_mode']) ? $_GET['print_mode'] : $_POST['print_mode'];

switch ($rm_mode){
	case "":		
		printGUI();		
		break;
	case "print":			
		rmPrint($func,$print_mode);		
		break;
}

echo mysql_error($connection);
mysql_close ($connection);

?>