<?php


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

	//global $bb3auth;
	$bb3auth = new BB3Auth();
	$sec = new Security;
	
	$_SESSION['params'] = $params;

	$_SESSION['user_id'] = $bb3auth->user->data["user_id"];
	$_SESSION['ses_id'] = $bb3auth->user->data["session_id"];


	
		
	$side = '';	
	if ($bb3auth->check('u_rm_use')){
		if ($sec->testUserGroup($_SESSION['user_id'],"Sportisti")){
			$side[] = Array('href' => '/rm/?rm_func=racer&rm_subf=myprofile', 'title' => 'Mani dati');
			$side[] = Array('', 'title' => '<hr>');	
			
			if($bb3auth->check('u_rm_team_profile')){
				$side[] = Array('href' => '/rm/?rm_func=racer&rm_subf=myteam', 'title' => 'Mana PE komanda');
				//$side[] = Array('href' => '/rm/?rm_func=racer&rm_subf=mycteam', 'title' => 'Mana kluba komanda');							
			}
			
			if($bb3auth->check('u_rm_race_apl')){
				$side[] = Array('href' => '/rm/?rm_func=racer&rm_subf=raceAppl', 'title' => 'Pieteikties PE sacensībām');
				//if($bb3auth->check('u_rm_team_profile')){
				//	$side[] = Array('href' => '/rm/?rm_func=racer&rm_subf=raceCTAppl', 'title' => 'Pieteikt kluba komandu sacensībām');
				//}
			}
			
			if ($bb3auth->check('u_rm_race_data_imp')){
				$side[] = Array('href' => '/rm/?rm_func=teamrace&rm_subf=imginp', 'title' => 'Ievadīt PE sacensību datus');				
			}
			
			if($bb3auth->check('u_rm_race_apl')){
				$side[] = Array('', 'title' => '<hr>');	
				$side[] = Array('href' => '/rm/?rm_func=enduro&rm_subf=apply', 'title' => 'Pieteikties Enduro sacensībām');	
				$em = $sec->getCustomField($_SESSION['user_id'],"pf_rm_enduro_manager");
				if( isset($em) && $em == 0){
					$side[] = Array('href' => '/rm/?rm_func=enduro&rm_subf=clubapply', 'title' => 'Pieteikt Klubu');				
				}				
			}
			$side[] = Array('', 'title' => '<hr>');	
		}
		
		if($bb3auth->check('u_rm_champ_admin')){
			$side[] = Array('href' => '/rm/?rm_func=champ&rm_subf=champlist&type=1', 'title' => 'Čepmionātu administrēšana');
			$side[] = Array('', 'title' => '<hr>');	
		}
		
		if ($bb3auth->check('u_rm_klasif')){
			if ($sec->testUserGroup($_SESSION['user_id'],MPS_ADMINS)){
				$side[] = Array('href' => '/rm/?rm_func=champ&rm_subf=classlist&type=1', 'title' => 'PE klašu klasifikatros');
				$side[] = Array('href' => '/rm/?rm_func=champ&rm_subf=tasklist', 'title' => 'PE uzdevumu veidu klasifikators');
				$side[] = Array('', 'title' => '<hr>');	
			}		
			if ($sec->testUserGroup($_SESSION['user_id'],ENDURO_ADMINS)){
				$side[] = Array('href' => '/rm/?rm_func=champ&rm_subf=classlist&type=3', 'title' => 'Enduro klašu klasifikators');
				$side[] = Array('', 'title' => '<hr>');
			}
		}
		
		if($bb3auth->check('u_rm_race_admin')){
			$side[] = Array('href' => '/rm/?rm_func=race&rm_subf=racelist&type=1', 'title' => 'sacensības');
			if (
				($sec->testUserGroup($_SESSION['user_id'],"RM_ENDURO_ORG")) ||
				($sec->testUserGroup($_SESSION['user_id'],ENDURO_ADMINS))
			){
				$side[] = Array('href' => '/rm/?rm_func=race&rm_subf=racelist&type=3', 'title' => 'Enduro sacensības');
			}
			
			$side[] = Array('href' => '/rm/?rm_func=mail', 'title' => 'e-pastu sūtīšana');			
			$side[] = Array('', 'title' => '<hr>');	
			if (
					($sec->testUserGroup($_SESSION['user_id'],"RM_MPS_Orgi")) ||
					($sec->testUserGroup($_SESSION['user_id'],MPS_ADMINS))
			){
				$side[] = Array('href' => '/rm/?rm_func=racer&rm_subf=raceapplist', 'title' => 'Pieteikumi PE sacensībām');
				$side[] = Array('', 'title' => '<hr>');	
			}
			if (
					($sec->testUserGroup($_SESSION['user_id'],"RM_ENDURO_ORG")) ||
					($sec->testUserGroup($_SESSION['user_id'],ENDURO_ADMINS))
			){
				$side[] = Array('href' => '/rm/?rm_func=enduro&rm_subf=reg', 'title' => 'Enduro registracija');
				$side[] = Array('href' => '/rm/?rm_func=enduro&rm_subf=start', 'title' => 'Enduro Starts');
				$side[] = Array('href' => '/rm/?rm_func=enduro&rm_subf=teams', 'title' => 'Komandas');
				$side[] = Array('href' => '/rm/?rm_func=enduro&rm_subf=laiks', 'title' => 'Enduro Laiku ievade');
				//$side[] = Array('href' => '/rm/?rm_func=enduro&rm_subf=reg', 'title' => 'Enduro registracija');
				$side[] = Array('', 'title' => '<hr>');	
			}
			
		}
			
		if($bb3auth->check('u_rm_race_crew')){
			$side[] = Array('href' => '/rm/?rm_func=racer&rm_subf=viewlist', 'title' => 'Sportistu dati');

			if (
					($sec->testUserGroup($_SESSION['user_id'],"RM_MPS_Orgi")) ||
					($sec->testUserGroup($_SESSION['user_id'],"RM_MPS_Tiesneši"))
				){
				
				$side[] = Array('href' => '/rm/?rm_func=teamrace&rm_subf=chpaccept', 'title' => 'Punktu akceptēšana');
				$side[] = Array('href' => '/rm/?rm_func=teamrace&rm_subf=trvert', 'title' => 'Komandu vērtēšana');
				$side[] = Array('href' => '/rm/?rm_func=teamrace&rm_subf=prot', 'title' => 'Protokoli');
				//$side[] = Array('href' => '/rm/?rm_mode=print&rm_func=rcs', 'title' => 'Reģistrētie sportisti');
			}
			
			$side[] = Array('', 'title' => '<hr>');	
		}
	} else {
		if($_SESSION['params']['no_gui']){
			//return;
		}
	}

	$side[] = Array('href' => '/rm/?rm_func=print&rm_subf=trdata', 'title' => 'Pieteiktās PE komandas');

	$side[] = Array('href' => '/rm/?rm_func=reslt&rm_subf=menu', 'title' => 'Piedzīvojumu Enduro rezultāti');
	$side[] = Array('href' => '/rm/?rm_func=print&rm_subf=enduroapllist', 'title' => 'Enduro pieteikumi');
	$side[] = Array('href' => '/rm/?rm_func=print&rm_subf=enduroapllist&no_gui=1', 'title' => 'Enduro pieteikumi izdruka');
	$side[] = Array('href' => '/rm/?rm_func=reslt&rm_subf=enduromenu', 'title' => 'Enduro rezultāti');
	
	

	$header = "apPasaule Race Manager 2";
	if(TEST_ENV){$header= $header." TESTA VIDE";}

	//print_r($_SESSION);
	$hd =  $ap->headers( Array(166 => $side) );
	
	if (!$_SESSION['params']['no_gui']) {
		$hd =  $ap->headers( Array(166 => $side) );
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
		case "appl";
			registerNewUser($subf);
			break;
			case "lake";
			doLake($subf);
			break;
		default:
			printHowTo();
			break;
	}
}

function checkPerm($f,$s){
	$perm = array(
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
				0 => "Sportisti"
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
				"all" => true
			),
			"endurorace" => array(
				"all" => true
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
			"raceAppl1" => array(				
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