<?php

function checkSel($f,$s){
if (
	$_SESSION['params']['rm_func'] == $f &&
	$_SESSION['params']['rm_subf'] == $s
   )
   {return 1;} 
   return 0;
}

function printGUI(){
	$maintenceWarn = 0;
	$maintence = 0;
	
	$ap = new AP;

	
	$i = 0;
	$keys = array_keys($_GET);
	while(isset($keys[$i])){
		$params[$keys[$i]] = $_GET[$keys[$i]];
		$i++;
	}
	$i = 0;
	$keys = array_keys($_POST);
	while(isset($keys[$i])){
		$params[$keys[$i]] = $_POST[$keys[$i]];
		$i++;
	}
	
	$bb3auth = new BB3Auth();
	$sec = new Security;
	
	$params['lang'] = isset($params['lang']) ? $params['lang'] : (($_SESSION['params']['lang'] != $params['lang'] && isset($params['lang'])) ? $params['lang'] : $_SESSION['params']['lang'] );
	$params['menuitem'] = isset($params['menuitem']) ? $params['menuitem'] : $_SESSION['params']['menuitem'];
	$params['type'] = isset($params['type']) ? $params['type'] : $_SESSION['params']['type'];
		
	$_SESSION['params'] = $params;
	
	$_SESSION['user_id'] = $bb3auth->user->data["user_id"];
	$_SESSION['ses_id'] = $bb3auth->user->data["session_id"];

	switch($params['lang']){
		case "lv":
			include "./lang/lat.php";
			break;
		case "en":
			include "./lang/eng.php";
			break;
		default:
			include "./lang/lat.php";
	}
	
	$side = '';	
	$sport = $sec->testUserGroup($_SESSION['user_id'],"Sportisti");
	$endadmin = $sec->testUserGroup($_SESSION['user_id'],ENDURO_ADMINS);
	
	if ($sport){
		$side[] = Array('href' => '?rm_func=racer&rm_subf=myprofile&menuitem=mydata', 'title' => MY_DATA, 'level' => 0,'sel'=> checkSel(racer,myprofile));
	}
	// ENDURO
	$side[] = Array('href' => ' ?menuitem=enduro&rm_func=enduro&rm_subf=apply', 'title' => MENU_ENDURO, 'level' => 0);
	if($params['menuitem'] == "enduro"){
		$i=0;
		if ($sport){
			$side[] = Array('href' => '?rm_func=enduro&rm_subf=apply', 'title' => MENU_APPL, 'level' => 1,'sel'=> (checkSel(enduro,apply)||checkSel(enduro,addapplication)||checkSel(enduro,delapl)) );
			$em = $sec->getCustomField($_SESSION['user_id'],"pf_rm_enduro_manager");
			if( isset($em) && $em == 0){
				$side[] = Array('href' => ' ?rm_func=enduro&rm_subf=clubapply', 'title' => ENDURO_CLUB_APPL,'level' => 1,'sel'=> checkSel(enduro,clubapply));				
			}
			$i=1;
		}
		if (
			($sec->testUserGroup($_SESSION['user_id'],"RM_ENDURO_ORG"))
		){
			if($i!=0){$side[] = Array('level' => 1);}
			$side[] = Array('href' => ' ?rm_func=race&rm_subf=racelist&type=3', 'title' => MENU_E_RACE,'level' => 1,'sel'=> checkSel(race,racelist));
			$i=1;
		}
		if (
			($sec->testUserGroup($_SESSION['user_id'],ENDURO_ADMINS))
		){
			if($i!=0){$side[] = Array('level' => 1);}
			$side[] = Array('href' => ' ?rm_func=champ&rm_subf=champlist&type=3', 'title' => MENU_CHAMP, 'level' => 1,'sel'=> checkSel(champ,champlist));		
			$side[] = Array('href' => ' ?rm_func=champ&rm_subf=classlist&type=3', 'title' => ENDURO_CLASS, 'level' => 1,'sel'=> checkSel(champ,classlist));
			$i=1;
		}
		if (
				($sec->testUserGroup($_SESSION['user_id'],"RM_ENDURO_ORG")) ||
				($sec->testUserGroup($_SESSION['user_id'],ENDURO_ADMINS))
		){
			if($i!=0){$side[] = Array('level' => 1);}
			$side[] = Array('href' => ' ?rm_func=enduro&rm_subf=reg', 'title' => MENU_E_REG,'level' => 1,'sel'=> checkSel(enduro,reg));
			$side[] = Array('href' => ' ?rm_func=enduro&rm_subf=start', 'title' => MENU_E_START,'level' => 1,'sel'=> checkSel(enduro,start));
			$side[] = Array('href' => ' ?rm_func=enduro&rm_subf=teams', 'title' => MENU_E_TEAM,'level' => 1,'sel'=> checkSel(enduro,teams));
			$side[] = Array('href' => ' ?rm_func=enduro&rm_subf=laiks', 'title' => MENU_E_TIME,'level' => 1,'sel'=> checkSel(enduro,laiks));
			$i=1;
		} 
		if($i!=0){$side[] = Array('level' => 1);}
		$side[] = Array('href' => ' ?rm_func=print&rm_subf=enduroapllist&type=3', 'title' => MENU_ENDURO_APLS,'level' => 1,'sel'=> checkSel('print',enduroapllist));
		$side[] = Array('href' => ' ?rm_func=print&rm_subf=enduroapllist&no_gui=1&type=3', 'title' => MENU_ENDURO_APLS_PRINT,'level' => 1,'target' => '_blank');
		$side[] = Array('href' => ' ?rm_func=reslt&rm_subf=enduromenu&type=3', 'title' => MENU_ENDURO_RESULT,'level' => 1,'sel'=> checkSel(reslt,enduromenu));
		
		
	}
	
	$side[] = Array('href' => ' ?menuitem=pe&rm_func=racer&rm_subf=raceAppl', 'title' => MENU_PE, 'level' => 0);
	if($params['menuitem'] == "pe"){
		$i=0;
		if ($sport){
			if($i!=0){$side[] = Array('level' => 1);}
			$i=1;
			$side[] = Array('href' => '?rm_func=racer&rm_subf=raceAppl', 'title' => MENU_APPL, 'level' => 1,'sel'=> checkSel(racer,raceAppl));
			$side[] = Array('href' => '?rm_func=racer&rm_subf=myteam', 'title' => MENU_PE_TEAM, 'level' => 1,'sel'=> checkSel(racer,myteam));
			$side[] = Array('href' => '?rm_func=teamrace&rm_subf=imginp', 'title' => MENU_PE_INPUT, 'level' => 1,'sel'=> checkSel(teamrace,imginp));
		}
		if (
			($sec->testUserGroup($_SESSION['user_id'],"RM_ENDURO_ORG"))
		){
			if($i!=0){$side[] = Array('level' => 1);}
			$i=1;
			$side[] = Array('href' => '?rm_func=race&rm_subf=racelist&type=1', 'title' => MENU_E_RACE,'level' => 1,'sel'=> checkSel(race,racelist));
		}
		if (
			($sec->testUserGroup($_SESSION['user_id'],ENDURO_ADMINS))
		){
			if($i!=0){$side[] = Array('level' => 1);}
			$i=1;
			$side[] = Array('href' => '?rm_func=champ&rm_subf=champlist&type=1', 'title' => MENU_CHAMP, 'level' => 1,'sel'=> checkSel(champ,champlist));		
			$side[] = Array('href' => '?rm_func=champ&rm_subf=classlist&type=1', 'title' => ENDURO_CLASS, 'level' => 1,'sel'=> checkSel(champ,classlist));
		}
		if($i!=0){$side[] = Array('level' => 1);}
		$side[] = Array('href' => '?rm_func=print&rm_subf=trdata', 'title' => MENU_ENDURO_APLS,'level' => 1,'sel'=> checkSel('print',trdata));
		$side[] = Array('href' => '?rm_func=print&rm_subf=trdata&no_gui=1', 'title' => MENU_ENDURO_APLS_PRINT,'level' => 1,'target' => '_blank');
		$side[] = Array('href' => '?rm_func=reslt&rm_subf=menu', 'title' => MENU_ENDURO_RESULT,'level' => 1,'sel'=> checkSel(reslt,menu));
	}
	
	//RACER DATA
	if (
		($sec->testUserGroup($_SESSION['user_id'],ENDURO_ADMINS) ||
		 $sec->testUserGroup($_SESSION['user_id'],"RM_ENDURO_ORG"))
	){	
		$side[] = Array('href' => ' ?menuitem=racerdata&rm_func=racer&rm_subf=viewlist', 'title' => MENU_RACER_DATA, 'level' => 0);
		if($params['menuitem'] == "racerdata"){
			$side[] = Array('href' => '?rm_func=lic&rm_subf=list', 'title' => MENU_LICENCE, 'level' => 1,'sel'=> checkSel(lic,'list'));			
			$side[] = Array('href' => '?rm_func=racer&rm_subf=viewlist', 'title' => MENU_RACERS, 'level' => 1,'sel'=> checkSel(racer,viewlist));	
			$side[] = Array('href' => '?rm_func=racer&rm_subf=clublist', 'title' => MENU_CLUB_LIST, 'level' => 1,'sel'=> checkSel(racer,clublist));	
		}		
	}
		
	$header = TITLE;
	
	$hd =  $ap->headers( Array(0 => $side),$bb3auth->user );
	
	if (!$_SESSION['params']['no_gui']) {
		$hd =  $ap->headers( Array(0 => $side),$bb3auth->user );
		echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
			<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"lv\" lang=\"lv\">
				<head>
					<script src=\"script.js\"></script>
					
					<script type=\"text/javascript\" src=\"./highslide/highslide-with-html.js\"></script>
					<link rel=\"stylesheet\" type=\"text/css\" href=\"./highslide/highslide.css\" />

					<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
					<link rel=\"stylesheet\" type=\"text/css\" href=\"style.css\" />
					<title>$header</title>	

					<script type=\"text/javascript\">
						hs.graphicsDir = './highslide/graphics/';
						hs.outlineType = 'rounded-white';
						hs.showCredits = false;
						hs.wrapperClassName = 'draggable-header';
					</script>
					
		";
		echo str_replace("<body",($_SESSION['params']['anh'] ? "<body onload=\"location.href = location.href+'#".$_SESSION['params']['anh']."';\"": "<body"),$hd);
		//echo $hd;
	} elseif (!$_SESSION['params']['script_gui']) {
		echo printheader();
	}

	$subf = $_SESSION['params']['rm_subf'];
	$opt = $_SESSION['params']['opt'];
	$func = $_SESSION['params']['rm_func'];

	if($_SESSION['params']['chr']) {
		$_SESSION['selrace'] = $_SESSION['params']['chr'];
		if ($_SESSION['params']['rm_subf'] == "copyracers"){$_SESSION['params']['rm_subf'] = "start";}
	}
	
	if ($maintenceWarn){
		echo "<table width=\"100%\" style=\"background-color:#FFCCFF\"><tr><td align=\"center\">";
			echo "<b style=\"font-size:20px;color:orange\">Uzmanību! Pēc 15 min sistēma nebūs pieejama uz 1 stundu!</b>";
		echo "</table>";
	}
	if(!$maintence){
		if ($bb3auth->check('u_rm_use') || $func=="reslt" || $func=="print" || $func="appl"){
			//printAactualRaceMenu();
			printMain(); 
		} else {			
			printHowTo();
		}
	} else {
		echo "<table width=\"100%\" style=\"background-color:#FFCCFF\"><tr><td align=\"center\">";
			echo "<b style=\"font-size:20px;color:orange\">Uzmanību! Sistēma nebūs pieejama līdz 13:20!</b>";
		echo "</table>";
		
	}
		
	if (!$_SESSION['params']['no_gui']) {
		echo $ap->footer();
	} elseif (!$_SESSION['params']['script_gui']) {
		echo printfooter();
	}
}

function printAactualRaceMenu($t){
	$rm = new raceManager;
	$r = $rm->getRace("","","",1,$t,"",0);
	
	if(count($r) > 0 && !isset($_SESSION['selrace'])){
		$_SESSION['selrace'] = $r[0]->getID();
	}
	
	echo SELCT_RACE_TITLE;
	echo "<select name =\"race\" onchange=\"goToSelectURL('selrace');\" id = \"selrace\">";
		echo "<option value=\"index.php?rm_subf=",$_SESSION['params']['rm_subf'],
									  "&rm_func=",$_SESSION['params']['rm_func'],
									  "&opt=",$_SESSION['params']['opt'],"&chr=",-1," \" ";
			if($_SESSION['selrace'] == -1){echo " selected ";}
		echo ">",SELCT_RACE_EMPTY,"</option>";
		
		for ($i=0;$i<count($r);$i++){		
			echo "<option value=\"index.php?rm_subf=",$_SESSION['params']['rm_subf'],
										  "&rm_func=",$_SESSION['params']['rm_func'],
										  "&opt=",$_SESSION['params']['opt'],"&chr=",$r[$i]->getID()," \" ";
				if($_SESSION['selrace'] == $r[$i]->getID()){echo " selected ";}
			echo ">";
				switch($r[$i]->getType()){
					case 1:
						$type = "Rally";
						break;
					case 2:
						$type = "Ezeri";
						break;
					case 3:
						$type = "Enduro";
						break;
				}
				echo "<b>$type</b>   - ",$r[$i]->getName()," (",$r[$i]->getDate(),")";
			echo "</option>";
		}
	echo "</select>";
		
	
	
	echo "<hr>";
	
}

function printMain() {	
	$opt = $_SESSION['params']['opt'];
	$func = $_SESSION['params']['rm_func'] ? $_SESSION['params']['rm_func'] : "empty";
	$subf = $func != "empty" ? ($_SESSION['params']['rm_subf'] ? $_SESSION['params']['rm_subf'] : "empty") : "empty";
	
	if(!checkPerm($func,$subf)){
		echo prntWarn("Nav tiesību!");
		return;
	}
	
	
	
	switch($func) {		
		case "user": 
			editUser($subf,$opt);
			break;
		case "racer":
			editRacer($subf,$opt);
			break;
		case "champ":
			editChamp($subf,$opt);
			break;
		case "race":
			editRace($subf,$opt);
			break;		
		case "teamrace":	
			editTR($subf,$opt);
			break;		
		case "champpts":
			proceedChampPTS($subf,$opt);
			break;
		case "reslt":
			proceedReslts($subf,$opt,$_SESSION['params']['class']);
			break;
		case "print":			
			rmPrint($subf,"");
			break;
		case "enduro":
			proceedEnduro($subf,$opt);
			break;
		case "mail":
			proceedMailing($subf,$opt);
			break;
		case "appl":
			registerNewUser($subf);
			break;
		case "lake":
			doLake($subf);
			break;
		case "em_user":		
			em_user($subf);
			break;
		case "lic":		
			doLic($subf,$opt);
			break;
		default:
			printDefault();
			break;
	}
}

function printDefault(){
 echo printActRace();
}

function checkPerm($f,$s){
	$perm = array(			
		"lic" => array(
			"cpynr" => array(
				0 => "RM_ADMIN",
				1 => "RM_ENDURO_ADMIN"
			),
			"list" => array(
				0 => "RM_ADMIN",
				1 => "RM_ENDURO_ADMIN"
			),
			"dellic" => array(
				0 => "RM_ADMIN",
				1 => "RM_ENDURO_ADMIN"
			),
			"savelic" => array(
				0 => "RM_ADMIN",
				1 => "RM_ENDURO_ADMIN"
			),		
			"nr" => array(
				0 => "RM_ADMIN",
				1 => "RM_ENDURO_ADMIN"
			),
			"delnr" => array(
				0 => "RM_ADMIN",
				1 => "RM_ENDURO_ADMIN"
			),
			"savenr" => array(
				0 => "RM_ADMIN",
				1 => "RM_ENDURO_ADMIN"
			),
			"getNR" => array(
				0 => "RM_ADMIN",
				1 => "RM_ENDURO_ADMIN"
			)			
		),
		"em_user" => array(
			"login" => array(
				"all" => true
			),
			"logout" => array(
				"all" => true
			)
		),
		"lake" => array(
			"map" => array(
				"all" => true
			)
		),
		"empty" => array(
			"empty" => array(
				"all" => true
			)
		),
		"appl" => array(
			"pe" => array(				
				"all" => true
			),
			"enduro" => array(
				"all" => true
			),
			"ek" => array(
				"all" => true
			),
			"" => array(
				"all" => true
			)
		),
		"mail" => array(
			"empty" => array(
				0 => "RM_ADMIN",
				1 => "RM_ENDURO_ADMIN"
			),
			"massmail" => array(
				0 => "RM_ADMIN",
				1 => "RM_ENDURO_ADMIN"
			),
			"send" => array(
				0 => "RM_ADMIN",
				1 => "RM_ENDURO_ADMIN"
			)
		),
		"enduro" => array(			
			"delteamracer" => array(
				0 => "RM_ADMIN",
				1 => "RM_ENDURO_ADMIN",
				2 => "RM_ENDURO_ORG"
			),
			"saveEteamMember" => array(
				0 => "RM_ADMIN",
				1 => "RM_ENDURO_ADMIN",
				2 => "RM_ENDURO_ORG"
			),
			"getClubRacers" => array(
				0 => "RM_ADMIN",
				1 => "RM_ENDURO_ADMIN",
				2 => "RM_ENDURO_ORG"
			),
			"delteam" => array(
				0 => "RM_ADMIN",
				1 => "RM_ENDURO_ADMIN",
				2 => "RM_ENDURO_ORG"
			),
			"saveEteam" => array(
				0 => "RM_ADMIN",
				1 => "RM_ENDURO_ADMIN",
				2 => "RM_ENDURO_ORG"
			),
			"getClub" => array(
				0 => "RM_ADMIN",
				1 => "RM_ENDURO_ADMIN",
				2 => "RM_ENDURO_ORG"
			),
			"reload_offset" => array(
				0 => "RM_ADMIN",
				1 => "RM_ENDURO_ADMIN",
				2 => "RM_ENDURO_ORG"
			),
			"copyracers" => array(
				0 => "RM_ADMIN",
				1 => "RM_ENDURO_ADMIN",
				2 => "RM_ENDURO_ORG"
			),
			"testIgnore" => array(
				0 => "RM_ADMIN",
				1 => "RM_ENDURO_ADMIN",
				2 => "RM_ENDURO_ORG"
			),
			"savetestignore" => array(
				0 => "RM_ADMIN",
				1 => "RM_ENDURO_ADMIN",
				2 => "RM_ENDURO_ORG"
			),
			"deltestresult" => array(
				0 => "RM_ADMIN",
				1 => "RM_ENDURO_ADMIN",
				2 => "RM_ENDURO_ORG"
			),
			"importresults" => array(
				0 => "RM_ADMIN",
				1 => "RM_ENDURO_ADMIN",
				2 => "RM_ENDURO_ORG"
			),
			"printresult" => array(
				0 => "RM_ADMIN",
				1 => "RM_ENDURO_ADMIN",
				2 => "RM_ENDURO_ORG"
			),
			"savetestres" => array(
				0 => "RM_ADMIN",
				1 => "RM_ENDURO_ADMIN",
				2 => "RM_ENDURO_ORG"
			),
			"testinp" => array(
				0 => "RM_ADMIN",
				1 => "RM_ENDURO_ADMIN",
				2 => "RM_ENDURO_ORG"
			),
			"savelkimp" => array(
				0 => "RM_ADMIN",
				1 => "RM_ENDURO_ADMIN",
				2 => "RM_ENDURO_ORG"
			),
			"lkinp" => array(
				0 => "RM_ADMIN",
				1 => "RM_ENDURO_ADMIN",
				2 => "RM_ENDURO_ORG"
			),
			"laiks" => array(
				0 => "RM_ADMIN",
				1 => "RM_ENDURO_ADMIN",
				2 => "RM_ENDURO_ORG"
			),
			"put_separator" => array(
				0 => "RM_ADMIN",
				1 => "RM_ENDURO_ADMIN",
				2 => "RM_ENDURO_ORG"
			),
			"erd_racer_change" => array(
				0 => "RM_ADMIN",
				1 => "RM_ENDURO_ADMIN",
				2 => "RM_ENDURO_ORG"
			),
			"rcer_offset_change" => array(
				0 => "RM_ADMIN",
				1 => "RM_ENDURO_ADMIN",
				2 => "RM_ENDURO_ORG"
			),
			"erd_offset_change" => array(
				0 => "RM_ADMIN",
				1 => "RM_ENDURO_ADMIN",
				2 => "RM_ENDURO_ORG"
			),
			"moveclass" => array(
				0 => "RM_ADMIN",
				1 => "RM_ENDURO_ADMIN",
				2 => "RM_ENDURO_ORG"
			),
			"pairracer" => array(
				0 => "RM_ADMIN",
				1 => "RM_ENDURO_ADMIN",
				2 => "RM_ENDURO_ORG"
			),
			"start" => array(
				0 => "RM_ADMIN",
				1 => "RM_ENDURO_ADMIN",
				2 => "RM_ENDURO_ORG"
			),
			"addstage" => array(
				0 => "RM_ADMIN",
				1 => "RM_ENDURO_ADMIN",
				2 => "RM_ENDURO_ORG"
			),
			"delstage" => array(
				0 => "RM_ADMIN",
				1 => "RM_ENDURO_ADMIN",
				2 => "RM_ENDURO_ORG"
			),
			"apply" => array(				
				"all" => true
			),
			"clubapply" => array(
				0 => "RM_ADMIN",
				1 => "RM_ENDURO_ADMIN",
				2 => "RM_ENDURO_ORG",
				3 => "Sportisti"
			),
			"addapplication" => array(
				0 => "RM_ADMIN",
				1 => "RM_ENDURO_ADMIN",
				2 => "RM_ENDURO_ORG",
				3 => "Sportisti"
			),
			"delapl" => array(
				0 => "RM_ADMIN",
				1 => "RM_ENDURO_ADMIN",
				2 => "RM_ENDURO_ORG",
				3 => "Sportisti"
			),
			"delapl1" => array(
				0 => "RM_ADMIN",
				1 => "RM_ENDURO_ADMIN",
				2 => "RM_ENDURO_ORG"
			),
			"reg" => array(
				0 => "RM_ADMIN",
				1 => "RM_ENDURO_ADMIN",
				2 => "RM_ENDURO_ORG"
			),
			"accracerday" => array(
				0 => "RM_ADMIN",
				1 => "RM_ENDURO_ADMIN",
				2 => "RM_ENDURO_ORG"
			),
			"denyracerday" => array(
				0 => "RM_ADMIN",
				1 => "RM_ENDURO_ADMIN"
			),
			"apladd" => array(
				0 => "RM_ADMIN",
				1 => "RM_ENDURO_ADMIN",
				2 => "RM_ENDURO_ORG"
			),
			"aplapply" => array(
				0 => "RM_ADMIN",
				1 => "RM_ENDURO_ADMIN",
				2 => "RM_ENDURO_ORG"
			),
			"dayunlock" => array(
				0 => "RM_ADMIN",
				1 => "RM_ENDURO_ADMIN",
				2 => "RM_ENDURO_ORG"
			),
			"daylock" => array(
				0 => "RM_ADMIN",
				1 => "RM_ENDURO_ADMIN",
				2 => "RM_ENDURO_ORG"
			),
			"unpairracer" => array(
				0 => "RM_ADMIN",
				1 => "RM_ENDURO_ADMIN",
				2 => "RM_ENDURO_ORG"
			),
			"teams" => array(
				0 => "RM_ADMIN",
				1 => "RM_ENDURO_ADMIN",
				2 => "RM_ENDURO_ORG"
			),
			"changeTeam" => array(
				0 => "RM_ADMIN",
				1 => "RM_ENDURO_ADMIN",
				2 => "RM_ENDURO_ORG"
			)
		),
		"print" => array(
			"enduro_start" => array(
				0 => "RM_ADMIN",
				1 => "RM_ENDURO_ADMIN",
				2 => "RM_ENDURO_ORG"
			),
			"rudite" => array(
				0 => "RM_ADMIN",
				1 => "RM_ENDURO_ADMIN",
				2 => "RM_ENDURO_ORG"
			),
			"tr" => array(
				0 => "RM_ADMIN",
				1 => "RM_MPS_Orgi",
				2 => "RM_MPS_Tiesneši",
				3 => "RM_MPS_admins"
			),
			"trdata" => array(
				"all" => true
			),
			"enduroapl" => array(
				0 => "RM_ADMIN",
				1 => "RM_ENDURO_ADMIN",
				2 => "RM_ENDURO_ORG",
				3 => "Sportisti"
			),
			"enduroapllist" => array(
				"all" => true				
			)
		),
		"reslt" => array(
			"empty" => array(
				"all" => true
			),
			"clubTeams" => array(
				"all" => true
			),
			"constrTeams" => array(
				"all" => true
			),
			"enduroAbs" => array(
				"all" => true
			),
			"pl" => array(
				"all" => true
			),
			"point" => array(
				"all" => true
			),
			"pre" => array(
				"all" => true
			),
			"all" => array(
				"all" => true
			),
			"champ" => array(
				"all" => true
			),
			"champ2" => array(
				"all" => true
			),
			"menu" => array(
				"all" => true
			),
			"enduromenu" => array(
				"all" => true
			),
			"enduroday" => array(
				0 => "RM_ADMIN",
				1 => "RM_MPS_Orgi",
				2 => "RM_MPS_Tiesneši",
				3 => "RM_MPS_admins"
			),
			"endurorace" => array(
				"all" => true
			),
			"endurodaysaved" => array(
				"all" => true
			),
			"publishDayResult" => array(
				0 => "RM_ADMIN",
				1 => "RM_MPS_Orgi",
				2 => "RM_MPS_Tiesneši",
				3 => "RM_MPS_admins"
			),
			"publishDayResultSave" => array(
				0 => "RM_ADMIN",
				1 => "RM_MPS_Orgi",
				2 => "RM_MPS_Tiesneši",
				3 => "RM_MPS_admins"
			)
		),
		"champpts" => array(
			"ptslist" => array(
				0 => "RM_ADMIN",
				1 => "RM_MPS_Orgi",
				2 => "RM_MPS_Tiesneši",
				3 => "RM_MPS_admins"
			),
			"savepts" => array(
				0 => "RM_ADMIN",
				1 => "RM_MPS_Orgi",
				2 => "RM_MPS_Tiesneši",
				3 => "RM_MPS_admins"
			)
		),
		"teamrace" => array(
			"sendtogal" => array(
				0 => "RM_ADMIN",
				1 => "RM_MPS_Orgi",
				2 => "RM_MPS_Tiesneši",
				3 => "RM_MPS_admins"
			),
			"chpaccept" => array(
				0 => "RM_ADMIN",
				1 => "RM_MPS_Orgi",
				2 => "RM_MPS_Tiesneši",
				3 => "RM_MPS_admins"
			),
			"chpinp" => array(
				0 => "RM_ADMIN",
				1 => "RM_MPS_Orgi",
				2 => "RM_MPS_Tiesneši",
				3 => "RM_MPS_admins"
			),
			"savetrkp" => array(
				0 => "RM_ADMIN",
				1 => "RM_MPS_Orgi",
				2 => "RM_MPS_Tiesneši",
				3 => "RM_MPS_admins",
				4 => "Sportisti"
			),
			"imginp" => array(
				0 => "RM_ADMIN",
				1 => "RM_MPS_Orgi",
				2 => "RM_MPS_Tiesneši",
				3 => "RM_MPS_admins",
				4 => "Sportisti"
			),
			"compltr" => array(
				0 => "RM_ADMIN",
				1 => "RM_MPS_Orgi",
				2 => "RM_MPS_Tiesneši",
				3 => "RM_MPS_admins",
				4 => "Sportisti"
			),
			"openKP" => array(
				0 => "RM_ADMIN",
				1 => "RM_MPS_Orgi",
				2 => "RM_MPS_Tiesneši",
				3 => "RM_MPS_admins",
				4 => "Sportisti"
			),
			"saveKP" => array(
				0 => "RM_ADMIN",
				1 => "RM_MPS_Orgi",
				2 => "RM_MPS_Tiesneši",
				3 => "RM_MPS_admins",
				4 => "Sportisti"
			),
			"trvert" => array(
				0 => "RM_ADMIN",
				1 => "RM_MPS_Orgi",
				2 => "RM_MPS_Tiesneši",
				3 => "RM_MPS_admins"
			),
			"retTR" => array(
				0 => "RM_ADMIN",
				1 => "RM_MPS_Orgi",
				2 => "RM_MPS_Tiesneši",
				3 => "RM_MPS_admins"
			),
			"doverttr" => array(
				0 => "RM_ADMIN",
				1 => "RM_MPS_Orgi",
				2 => "RM_MPS_Tiesneši",
				3 => "RM_MPS_admins"
			),
			"saveverttr" => array(
				0 => "RM_ADMIN",
				1 => "RM_MPS_Orgi",
				2 => "RM_MPS_Tiesneši",
				3 => "RM_MPS_admins"
			),
			"trpen" => array(
				0 => "RM_ADMIN",
				1 => "RM_MPS_Orgi",
				2 => "RM_MPS_Tiesneši",
				3 => "RM_MPS_admins"
			),
			"newtrpen" => array(
				0 => "RM_ADMIN",
				1 => "RM_MPS_Orgi",
				2 => "RM_MPS_Tiesneši",
				3 => "RM_MPS_admins"
			),
			"savetrpen" => array(
				0 => "RM_ADMIN",
				1 => "RM_MPS_Orgi",
				2 => "RM_MPS_Tiesneši",
				3 => "RM_MPS_admins"
			),
			"deltrpen" => array(
				0 => "RM_ADMIN",
				1 => "RM_MPS_Orgi",
				2 => "RM_MPS_Tiesneši",
				3 => "RM_MPS_admins"
			),
			"prot" => array(
				0 => "RM_ADMIN",
				1 => "RM_MPS_Orgi",
				2 => "RM_MPS_Tiesneši",
				3 => "RM_MPS_admins"
			),
			"sfin" => array(
				0 => "RM_ADMIN",
				1 => "RM_MPS_Orgi",
				2 => "RM_MPS_Tiesneši",
				3 => "RM_MPS_admins"
			),
			"sfout" => array(
				0 => "RM_ADMIN",
				1 => "RM_MPS_Orgi",
				2 => "RM_MPS_Tiesneši",
				3 => "RM_MPS_admins"
			),
			"suin" => array(
				0 => "RM_ADMIN",
				1 => "RM_MPS_Orgi",
				2 => "RM_MPS_Tiesneši",
				3 => "RM_MPS_admins"
			),
			"suout" => array(
				0 => "RM_ADMIN",
				1 => "RM_MPS_Orgi",
				2 => "RM_MPS_Tiesneši",
				3 => "RM_MPS_admins"
			),
			"savetrsf" => array(
				0 => "RM_ADMIN",
				1 => "RM_MPS_Orgi",
				2 => "RM_MPS_Tiesneši",
				3 => "RM_MPS_admins"
			),
			"savetrsu" => array(
				0 => "RM_ADMIN",
				1 => "RM_MPS_Orgi",
				2 => "RM_MPS_Tiesneši",
				3 => "RM_MPS_admins"
			)
		),
		"race" => array(
			"allanswer" => array(
				0 => "RM_ADMIN",
				1 => "RM_MPS_Orgi",
				2 => "RM_MPS_Tiesneši",
				3 => "RM_MPS_admins"
			),
			"enduroraceclassdaystage" => array(
				0 => "RM_ADMIN",
				1 => "RM_MPS_Orgi",
				2 => "RM_MPS_Tiesneši",
				3 => "RM_MPS_admins",
				4 => "RM_ENDURO_ADMIN",
				5 => "RM_ENDURO_ORG"
			),
			"save_ercds" => array(
				0 => "RM_ADMIN",
				1 => "RM_MPS_Orgi",
				2 => "RM_MPS_Tiesneši",
				3 => "RM_MPS_admins",
				4 => "RM_ENDURO_ADMIN",
				5 => "RM_ENDURO_ORG"
			),
			"delet" => array(
				0 => "RM_ADMIN",
				1 => "RM_MPS_Orgi",
				2 => "RM_MPS_Tiesneši",
				3 => "RM_MPS_admins",
				4 => "RM_ENDURO_ADMIN",
				5 => "RM_ENDURO_ORG"
			),
			"addendurotask" => array(
				0 => "RM_ADMIN",
				1 => "RM_MPS_Orgi",
				2 => "RM_MPS_Tiesneši",
				3 => "RM_MPS_admins",
				4 => "RM_ENDURO_ADMIN",
				5 => "RM_ENDURO_ORG"
			),
			"addenduroday" => array(
				0 => "RM_ADMIN",
				1 => "RM_MPS_Orgi",
				2 => "RM_MPS_Tiesneši",
				3 => "RM_MPS_admins",
				4 => "RM_ENDURO_ADMIN",
				5 => "RM_ENDURO_ORG"
			),
			"delerd" => array(
				0 => "RM_ADMIN",
				1 => "RM_MPS_Orgi",
				2 => "RM_MPS_Tiesneši",
				3 => "RM_MPS_admins",
				4 => "RM_ENDURO_ADMIN",
				5 => "RM_ENDURO_ORG"
			),
			"delorg" => array(
				0 => "RM_ADMIN",
				1 => "RM_MPS_Orgi",
				2 => "RM_MPS_Tiesneši",
				3 => "RM_MPS_admins"
			),
			"saveorg" => array(
				0 => "RM_ADMIN",
				1 => "RM_MPS_Orgi",
				2 => "RM_MPS_Tiesneši",
				3 => "RM_MPS_admins"
			),
			"addorg" => array(
				0 => "RM_ADMIN",
				1 => "RM_MPS_Orgi",
				2 => "RM_MPS_Tiesneši",
				3 => "RM_MPS_admins"
			),
			"racelist" => array(
				0 => "RM_ADMIN",
				1 => "RM_MPS_Orgi",
				2 => "RM_MPS_Tiesneši",
				3 => "RM_MPS_admins",
				4 => "RM_ENDURO_ADMIN",
				5 => "RM_ENDURO_ORG"
			),
			"newrace" => array(
				0 => "RM_ADMIN",
				1 => "RM_MPS_Orgi",
				2 => "RM_MPS_Tiesneši",
				3 => "RM_MPS_admins",
				4 => "RM_ENDURO_ADMIN",
				5 => "RM_ENDURO_ORG"
			),
			"saverace" => array(
				0 => "RM_ADMIN",
				1 => "RM_MPS_Orgi",
				2 => "RM_MPS_Tiesneši",
				3 => "RM_MPS_admins",
				4 => "RM_ENDURO_ADMIN",
				5 => "RM_ENDURO_ORG"
			),
			"delrace" => array(
				0 => "RM_ADMIN",
				1 => "RM_MPS_Orgi",
				2 => "RM_MPS_Tiesneši",
				3 => "RM_MPS_admins",
				4 => "RM_ENDURO_ADMIN",
				5 => "RM_ENDURO_ORG"
			),
			"actrace" => array(
				0 => "RM_ADMIN",
				1 => "RM_MPS_Orgi",
				2 => "RM_MPS_Tiesneši",
				3 => "RM_MPS_admins",
				4 => "RM_ENDURO_ADMIN",
				5 => "RM_ENDURO_ORG"
			),
			"openrace" => array(
				0 => "RM_ADMIN",
				1 => "RM_MPS_Orgi",
				2 => "RM_MPS_Tiesneši",
				3 => "RM_MPS_admins",
				4 => "RM_ENDURO_ADMIN",
				5 => "RM_ENDURO_ORG"
			),
			"raceclass" => array(
				0 => "RM_ADMIN",
				1 => "RM_MPS_Orgi",
				2 => "RM_MPS_Tiesneši",
				3 => "RM_MPS_admins",
				4 => "RM_ENDURO_ADMIN",
				5 => "RM_ENDURO_ORG"
			),
			"saveraceclass" => array(
				0 => "RM_ADMIN",
				1 => "RM_MPS_Orgi",
				2 => "RM_MPS_Tiesneši",
				3 => "RM_MPS_admins",
				4 => "RM_ENDURO_ADMIN",
				5 => "RM_ENDURO_ORG"
			),
			"files" => array(
				0 => "RM_ADMIN",
				1 => "RM_MPS_Orgi",
				2 => "RM_MPS_Tiesneši",
				3 => "RM_MPS_admins"
			),
			"racept" => array(
				0 => "RM_ADMIN",
				1 => "RM_MPS_Orgi",
				2 => "RM_MPS_Tiesneši",
				3 => "RM_MPS_admins"
			),
			"saveracept" => array(
				0 => "RM_ADMIN",
				1 => "RM_MPS_Orgi",
				2 => "RM_MPS_Tiesneši",
				3 => "RM_MPS_admins"
			),
			"cplist" => array(
				0 => "RM_ADMIN",
				1 => "RM_MPS_Orgi",
				2 => "RM_MPS_Tiesneši",
				3 => "RM_MPS_admins"
			),
			"newcp" => array(
				0 => "RM_ADMIN",
				1 => "RM_MPS_Orgi",
				2 => "RM_MPS_Tiesneši",
				3 => "RM_MPS_admins"
			),
			"savecp" => array(
				0 => "RM_ADMIN",
				1 => "RM_MPS_Orgi",
				2 => "RM_MPS_Tiesneši",
				3 => "RM_MPS_admins"
			),
			"opencp" => array(
				0 => "RM_ADMIN",
				1 => "RM_MPS_Orgi",
				2 => "RM_MPS_Tiesneši",
				3 => "RM_MPS_admins"
			),
			"delcp" => array(
				0 => "RM_ADMIN",
				1 => "RM_MPS_Orgi",
				2 => "RM_MPS_Tiesneši",
				3 => "RM_MPS_admins"
			),
			"wpimp" => array(
				0 => "RM_ADMIN",
				1 => "RM_MPS_Orgi",
				2 => "RM_MPS_Tiesneši",
				3 => "RM_MPS_admins"
			),
			"wpsave" => array(
				0 => "RM_ADMIN",
				1 => "RM_MPS_Orgi",
				2 => "RM_MPS_Tiesneši",
				3 => "RM_MPS_admins"
			),
			"sflist" => array(
				0 => "RM_ADMIN",
				1 => "RM_MPS_Orgi",
				2 => "RM_MPS_Tiesneši",
				3 => "RM_MPS_admins"
			),
			"delsf" => array(
				0 => "RM_ADMIN",
				1 => "RM_MPS_Orgi",
				2 => "RM_MPS_Tiesneši",
				3 => "RM_MPS_admins"
			),
			"opensf" => array(
				0 => "RM_ADMIN",
				1 => "RM_MPS_Orgi",
				2 => "RM_MPS_Tiesneši",
				3 => "RM_MPS_admins"
			),
			"savesf" => array(
				0 => "RM_ADMIN",
				1 => "RM_MPS_Orgi",
				2 => "RM_MPS_Tiesneši",
				3 => "RM_MPS_admins"
			),
			"newsf" => array(
				0 => "RM_ADMIN",
				1 => "RM_MPS_Orgi",
				2 => "RM_MPS_Tiesneši",
				3 => "RM_MPS_admins"
			)
		),
		"champ" => array(
			"savecountry" => array(
				0 => "RM_ADMIN"
			),
			"delcountry" => array(
				0 => "RM_ADMIN"
			),
			"opencountry" => array(
				0 => "RM_ADMIN"
			),
			"newcountry" => array(
				0 => "RM_ADMIN"
			),
			"countlist" => array(
				0 => "RM_ADMIN"
			),
			"champlist" => array(
				0 => "RM_ADMIN"
			),
			"newchamp" => array(
				0 => "RM_ADMIN"
			),
			"savechamp" => array(
				0 => "RM_ADMIN"
			),
			"delchamp" => array(
				0 => "RM_ADMIN"
			),
			"openchamp" => array(
				0 => "RM_ADMIN"
			),
			"classlist" => array(
				0 => "RM_ADMIN",
				1 => "RM_ENDURO_ADMIN"
				
			),
			"newclass" => array(
				0 => "RM_ADMIN",
				1 => "RM_ENDURO_ADMIN"
			),
			"saveclass" => array(
				0 => "RM_ADMIN",
				1 => "RM_ENDURO_ADMIN"
			),
			"delclass" => array(
				0 => "RM_ADMIN",
				1 => "RM_ENDURO_ADMIN"
			),
			"openclass" => array(
				0 => "RM_ADMIN",
				1 => "RM_ENDURO_ADMIN"
			),
			"tasklist" => array(
				0 => "RM_ADMIN"
			),
			"newptask" => array(
				0 => "RM_ADMIN"
			),
			"saveptask" => array(
				0 => "RM_ADMIN"
			),
			"delptask" => array(
				0 => "RM_ADMIN"
			),
			"openptask" => array(
				0 => "RM_ADMIN"
			)
		),
		"racer" => array(		
			"dwn" => array(
				0 => "RM_ADMIN",
				1 => "RM_ENDURO_ADMIN",
				2 => "RM_ENDURO_ORG",
				3 => "RM_MPS_Orgi",
				4 => "RM_MPS_Tiesneši",
				5 => "RM_MPS_admins"
			),
			"up" => array(
				0 => "RM_ADMIN",
				1 => "RM_ENDURO_ADMIN",
				2 => "RM_ENDURO_ORG",
				3 => "RM_MPS_Orgi",
				4 => "RM_MPS_Tiesneši",
				5 => "RM_MPS_admins"
			),
			"prntracerList" => array(
				0 => "RM_ADMIN",
				1 => "RM_ENDURO_ADMIN",
				2 => "RM_ENDURO_ORG"
			),			
			"prntracerList" => array(
				0 => "RM_ADMIN",
				1 => "RM_ENDURO_ADMIN",
				2 => "RM_ENDURO_ORG"
			),
			"prntaddracer" => array(
				0 => "RM_ADMIN",
				1 => "RM_MPS_Orgi",
				2 => "RM_MPS_Tiesneši",
				3 => "RM_MPS_admins"
			),
			"renTeam" => array(
				0 => "RM_ADMIN",
				1 => "RM_MPS_Orgi",
				2 => "RM_MPS_Tiesneši",
				3 => "RM_MPS_admins"
			),
			"makelead" => array(				
				"all" => true
			),
			"myprofile" => array(				
				"all" => true
			),
			"viewprofile" => array(				
				"all" => true
			),
			"savemyprofile" => array(				
				"all" => true
			),
			"myteam" => array(				
				"all" => true
			),
			"newteam" => array(				
				"all" => true
			),
			"saveteam" => array(				
				"all" => true
			),
			"addteamracer" => array(				
				"all" => true
			),
			"newteamracer" => array(				
				"all" => true
			),
			"savenewteamracer" => array(				
				"all" => true
			),
			"saveaddteamracer" => array(				
				"all" => true
			),
			"remRacer" => array(				
				"all" => true
			),
			"raceAppl" => array(				
				"all" => true
			),
			"saveraceAppl" => array(				
				"all" => true
			),
			"raceapplist" => array(				
				0 => "RM_ADMIN",
				1 => "RM_MPS_Orgi",
				2 => "RM_MPS_Tiesneši",
				3 => "RM_MPS_admins"
			),
			"accraceapplist" => array(				
				0 => "RM_ADMIN",
				1 => "RM_MPS_Orgi",
				2 => "RM_MPS_Tiesneši",
				3 => "RM_MPS_admins"
			),
			"UNaccraceapplist" => array(				
				0 => "RM_ADMIN",
				1 => "RM_MPS_Orgi",
				2 => "RM_MPS_Tiesneši",
				3 => "RM_MPS_admins"
			),
			"returnapl" => array(				
				0 => "RM_ADMIN",
				1 => "RM_MPS_Orgi",
				2 => "RM_MPS_Tiesneši",
				3 => "RM_MPS_admins"
			),
			"clublist" => array(				
				"all" => true
			),
			"newclub" => array(				
				"all" => true
			),
			"openclub" => array(				
				"all" => true
			),
			"saveclub" => array(				
				"all" => true
			),
			"delclub" => array(				
				"all" => true
			),
			"viewlist" => array(				
				"all" => true
			),
			"mycteam" => array(				
				"all" => true
			),
			"newcteam" => array(				
				"all" => true
			),
			"savecteam" => array(				
				"all" => true
			),
			"addcteamracer" => array(				
				"all" => true
			),
			"saveaddcteamracer" => array(				
				"all" => true
			),
			"remCRacer" => array(				
				"all" => true
			),
			"raceCTAppl" => array(				
				"all" => true
			),
			"appcteam" => array(				
				"all" => true
			),
			"remappcteam" => array(				
				"all" => true
			),
			"savenewuser" => array(				
				"all" => true
			)
		)
	);
	if($perm[$f][$s]['all']){
		return true;
	}
	$sec = new Security;
	//echo count( $perm[$f][$s]);
	for($i=0;$i<count($perm[$f][$s]);$i++){
		if($sec->testUserGroup($_SESSION['user_id'],$perm[$f][$s][$i])){
			return true;
		}		
	}
	
	return false;
}
?>