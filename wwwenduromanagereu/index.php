<?php
	try {				
		error_reporting(E_ALL ^ E_NOTICE);
		ini_set('display_errors','On');
		ini_set("session.cookie_domain", ".enduromanager.eu");

		session_start();				

		include "./conf.php";
		include "./AP.php";
		include "./GUI.php";
		include "./engine/emailconf.php";
		include "./engine/print.php";
		include "./engine/util.php";
		include "./engine/a_security.php";
		include "./engine/c_racer.php";
		include "./engine/d_champ.php";
		include "./engine/d_race.php";
		include "./engine/e_teamrace.php";
		include "./engine/f_champpts.php";
		include "./engine/result.php";
		include "./engine/mailing.php";
		include "./engine/enduro.php";
		include "./engine/enduro_print.php";
		include "./engine/enduro_result.php";
		include "./engine/applicant.php";
		include "./engine/em_security.php";
		include "./engine/licence.php";
		include "./engine/enduro_store_result.php";

		$GLOBALS["connection"] = mysqli_connect(RM_DB_ADDRESS,RM_DB_USER,RM_DB_PASS,RM_DB_NAME);
		mysqli_set_charset ( $GLOBALS["connection"], "utf8" );

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
	} catch(Exception $e) {
		print_r($e);
	} finally {
		if($GLOBALS["connection"]){
			echo mysqli_error($GLOBALS["connection"]);
			mysqli_close ($GLOBALS["connection"]);
		}		
	}	
?>