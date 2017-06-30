<?php
error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors','On');

include "../rm/engine/conf.php";

include "./AP.php";
$ap = new AP;

include "../rm/engine/emailconf.php";
include "../rm/engine/print.php";
include "../rm/engine/util.php";
include "../rm/engine/a_security.php";
include "../rm/engine/c_racer.php";
include "../rm/engine/d_champ.php";
include "../rm/engine/d_race.php";
include "../rm/engine/e_teamrace.php";
include "../rm/engine/f_champpts.php";

include "../rm/engine/result.php";
include "../rm/engine/mailing.php";
include "../rm/engine/enduro.php";
include "../rm/engine/enduro_print.php";
include "../rm/engine/enduro_result.php";
include "../rm/engine/applicant.php";
include "../rm/engine/lake.php";

include "./GUI.php";
include "./engine/em_security.php";
include "./engine/licence.php";
include "./engine/enduro_store_result.php";

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