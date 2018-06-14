<?php

	function rmPrint($func,$mode){
		switch($func){
			case "kartina":
				enduro_kartina();
				break;
			case "enduro_start":
				enduro_start();
				break;
			case "rudite":
				enduro_rudite();
				break;
			case "tr":
				$tr = isset($_GET['tr']) ? $_GET['tr'] : $_POST['tr'];
				printAnketa($tr);
				break;		
			case "trdata":
				echo printTRData();
				break;
			case "enduroapl":
				printEnduroApl($_GET['apl']);
				break;
			case "enduroapllist";
				echo enduroapllist();
				break;
			default:
				echo "$func $mode Kļūda!";
		}


	}

	function enduroapllist(){
		printAactualRaceMenu($_SESSION['params']['type']);
		
		$rm = new raceManager;
		$r1 = $rm->getRace("","","","",$_SESSION['params']['type'],1,0);
		
		if(count($r1) < 1){
			echo "<center><h1 style=\"color:red;\">Nav izvēlētās sacensības!</h1></center>";
			return;
		}
		
		$clubs = array();
		$sql = "
			select * 
			from `phpbb_profile_fields_lang` 
			where `field_id` = ".KL_CLUB;
		$r = queryDB($sql);
		while($row = mysql_fetch_array($r, MYSQL_ASSOC)){
			$clubs[$row[option_id]] = $row[lang_value];
		}
		
		$valsts = array();
		$sql = "
			select * 
			from `phpbb_profile_fields_lang` 
			where `field_id` = ".KL_COUNT;
		$r = queryDB($sql);
		while($row = mysql_fetch_array($r, MYSQL_ASSOC)){
			$valsts[$row[option_id]] = $row[lang_value];
		}
		
		
		
		$sql = "SELECT * ,data.`pf_rm_sport_nr`  as NR_X, club.`name` as club_name
				FROM `enduro_application` ea
				  inner join `phpbb_profile_fields_data` data on (data.`user_id` = ea.`racer_id`)
				  inner join `d_class` cl on (cl.`classid` = ea.`class_id`)
				  left join `c_club` club on (club.`ID` = data.`pf_rm_club`)
				where `race_id` = ".$r1[0]->getID()."
				order by cl.`weight` asc, NR asc";
		//$sql = "SELECT * ,cast(data.`pf_rm_sport_nr` as decimal(5,2)) as NR
		//echo $sql;
		$r = queryDB($sql);
		$moto = getMoto();
		$class_id=-1;
		while($row = mysql_fetch_array($r, MYSQL_ASSOC)){
			if($row[CLASS_ID] != $class_id) {			
				echo "</table>";
				echo "<br><b style=\"font-size:16px\">",$row[Name],"</b><br>";
				echo "<table border =\"1\">";
					echo "<tr style=\"font-weight:bold\">";
						echo "<td width=\"30px\">Num";
						echo "<td width=\"150px\">Sportists";
						echo "<td width=\"150px\">Tehnikas marka";
						echo "<td width=\"150px\">Klubs";
						echo "<td width=\"100px\">Valsts";						
				$class_id = $row[CLASS_ID];	
			}
			if($rc!=$row[user_id]){
				//print_r($row);
				echo "<tr>";
				echo "<td><b>",$row[pf_rm_sport_nr],"</b>";
				echo "<td>",$row[pf_rm_f_name];
				echo " ",$row[pf_rm_l_name];
				//echo "<td>",$moto[$row[pf_rm_moto_name]-1];
				echo "<td>",str_replace ( "^" , " " , $row[TEHN]);
				echo "<td>",$row[club_name];
				echo "<td>",$valsts[$row[pf_rm_country]];
				
				
				$rc = $row[user_id];
			}
		}
		echo "</table>";
	}
	
	function printEnduroApl($apl){
		$em = new EnduroManager;
		$rm = new raceManager;
		$rcm = new RacerManager;
		$cm = new champManager;
		
		$apl= $em->getERA($apl,"","","","");
		if ($apl){
			$r = $rm->getRace($apl[0]->RACE_ID,"","","","","","");
			$cmp = $cm->getChamps($r[0]->getCH_ID(),"","","");			
			
			$mod="";
			if (strpos($cmp[0]->getName(), 'Sprint')){$mod="sprint";}
			if (strpos($cmp[0]->getName(), 'Cross')){$mod="cc";}
			
			$handle = fopen("./Files/enduro_anketa_$mod.htm", "r");
			$contents = fread($handle, filesize("./Files/enduro_anketa_$mod.htm"));   	
			fclose($handle);
			
			if ($r){
				$contents = str_replace("{place}",$cmp[0]->getName(). ",<br> ". $r[0]->getName(),$contents);
				$contents = str_replace("{date}",$r[0]->getDate(),$contents);
			}
			$racer = $rcm->getRacer($apl[0]->RACER_ID);
			$m = getMoto();
			//print_r($apl);
			if($racer){
				$contents = str_replace("{start_no}",$racer[0]->getNR(),$contents);
				$contents = str_replace("{lic_no}",$racer[0]->getLNR(),$contents);
				$contents = str_replace("{country}",$racer[0]->getValsts_name(),$contents);
				$contents = str_replace("{name}",$racer[0]->getFname()." ".$racer[0]->getLname(),$contents);
				$contents = str_replace("{byear}",$racer[0]->getBYear_text(),$contents);
				$contents = str_replace("{club}",$racer[0]->getClub_name(),$contents);
				$contents = str_replace("{phone}",$racer[0]->getTel(),$contents);
				
				$teh = explode("^",$apl[0]->TEHN);			
				$contents = str_replace("{moto}",$teh[0],$contents);
				$contents = str_replace("{model}",$teh[1],$contents);
				$contents = str_replace("{cc}",$teh[2],$contents);				
				$contents = str_replace("{tak}",$teh[3],$contents);				
			}
			$cl = $cm->getClass($apl[0]->CLASS_ID,"");
			
			if($cl){		
				$clases = $cm->getClass("",3);	
				for($i=0;$i<count($clases);$i++){					
					$contents = str_replace("{".$clases[$i]->getCode()."}",($cl[0]->getCode() ==  $clases[$i]->getCode() ? "X" : ""),$contents);
				}
			}
		}
		
		echo $contents;
		
	}
	
	function printTRData(){
		printAactualRaceMenu(1);
		
		$rcm = new RacerManager;
		$rm = new raceManager;
		$r = $rm->getRace("","","","","",1,0);
		
		if(count($r) < 1){
			echo "<center><h1 style=\"color:red;\">Nav izvēlētās sacensības!</h1></center>";
			return;
		}
		
		$cm= new champManager;
		$cl = $cm->getActulaRaceClass($r[0]->getID());
		echo "<h1 align=\"center\">sacensībās \"",$r[0]->getName(),"\" piedalās </h1><p align=\"center\">(iesniegts pieteikums un iemaksāta dalības maksa)</p><hr>";
		for ($j = 0;$j < count($cl);$j++){		
			$apls = $rcm->getTeamRace("","",$r[0]->getID(),$cl[$j]->getID());
			
			echo "<h4 align = \"center\">", $cl[$j]->getName()," klase</h4>";
			echo "<table width =\"500\" border = \"1\" align=\"center\"> ";
			echo "<tr class=\"title\" align=\"center\"><td width=\"20\">&nbsp<td width=\"100\">Tehnikas tips<td width=\"380\">Pieteiktās komandas ";
			$i=0;
			$cnt=1;
			while (isset($apls[$i]) ){
				if ($apls[$i]->getACC() == 1){
					echo "<tr >";
					echo "<td align=\"center\">",$cnt;
					$cnt++;
						
					$tm = $rcm->getTeam($apls[$i]->getTeamID(),"",1,"");
					
					$rcrs = Array();			
					$trr= $rcm->getTRRacer($apls[$i]->getTRID());
					for($k=0;$k<count($trr);$k++){
						$item=$rcm->getRacer($trr[$k]->getTRRID(),"","");
						array_push($rcrs,$item[0]);
					}
					
					
					echo "<td align=\"center\">";
					
					
					if ($trr[0]->type == 1){echo " <b style=\"font-color:red\">!</b> ";};
					if ($trr[0]->type == 2){echo " M ";};
					if ($trr[0]->type == 3){echo " V ";};
					if ($trr[0]->type == 4){echo " K ";};
					echo "/";
					if ($trr[1]->type == 1){echo " <b style=\"font-color:red\">!</b> ";};
					if ($trr[1]->type == 2){echo " M ";};
					if ($trr[1]->type == 3){echo " V ";};
					if ($trr[1]->type == 4){echo " K ";};
					
					echo "<td>". $tm [0]->getName() ;
					
					
					
					if($tm[0]->getLeader()){$leader = $tm[0]->getLeader()->getRacerID();}
					
					if($rcrs[0]){
						echo " (",$rcrs[0]->getFname()," ",$rcrs[0]->getLname()," - ",$trr[0]->nr;
						if ($leader){if ($leader == $rcrs[0]->getUserID()){echo " <b>(k)</b> ";}}
					}					
					
					if($rcrs[1]){
						echo "; ",$rcrs[1]->getFname()," ",$rcrs[1]->getLname()," - ",$trr[1]->nr;
						if($leader){if ($leader == $rcrs[1]->getUserID()){echo " <b>(k)</b> ";}}
					}					
					
					echo ") ";
					
				}
				$i++;
			}
			echo "</table>";	
		}	
}	
	
	function printAnketa($tr){
		
		$handle = fopen("./Files/pe_anketa.htm", "r");
		$contents = fread($handle, filesize("./Files/pe_anketa.htm"));   	
		fclose($handle);
		
		$rcm = new RacerManager;
		$cm = new champManager;
		$rm = new raceManager;
		
		$x = $rcm->getTeamRace($tr,"","","");
		$r = $rm->getRace($x[0]->getRID(),"","","","","",0);

		$team = $rcm->getTeam($x[0]->getTeamID(),"","","");
		$rc = $cm->getClass($x[0]->getCID(),"");

		$racer = Array();
		
		$trr= $rcm->getTRRacer($x[0]->getTRID());
		for($i=0;$i<count($trr);$i++){
			$item=$rcm->getRacer($trr[$i]->getTRRID());
			array_push($racer,$item[0]);
		}
		
		
		$contents = str_replace("{place}",$r[0]->getName(). ",<br> ". $r[0]->getName(),$contents);
		$contents = str_replace("{date}",$r[0]->getDate(),$contents);
		$contents = str_replace("{team}",$team[0]->getName(),$contents);		
		$contents = str_replace("{class}",$rc[0]->getName(),$contents);		

		$contents = str_replace("{1lic}",$racer[0]->getLNR(),$contents);		
		$contents = str_replace("{1name}",$racer[0]->getFname()." ".$racer[0]->getLname(),$contents);
		$contents = str_replace("{1byear}",$racer[0]->getBYear_text(),$contents);
		$contents = str_replace("{1club}",$racer[0]->getClub_name(),$contents);
		$contents = str_replace("{1phone}",$racer[0]->getTel(),$contents);
		$contents = str_replace("{1mail}",$racer[0]->getMail(),$contents);
		
		$teh = explode("^",$trr[0]->tehn);
	
		$contents = str_replace("{1moto}",$teh[0],$contents);
		$contents = str_replace("{1model}",$teh[1],$contents);
		$contents = str_replace("{1cc}",$teh[2],$contents);				
		$contents = str_replace("{1tak}",$teh[3],$contents);
			

		$contents = str_replace("{2lic}",$racer[1]->getLNR(),$contents);		
		$contents = str_replace("{2name}",$racer[1]->getFname()." ".$racer[1]->getLname(),$contents);
		$contents = str_replace("{2byear}",$racer[1]->getBYear_text(),$contents);
		$contents = str_replace("{2club}",$racer[1]->getClub_name(),$contents);
		$contents = str_replace("{2phone}",$racer[1]->getTel(),$contents);
		$contents = str_replace("{2mail}",$racer[1]->getMail(),$contents);
		
		$teh = explode("^",$trr[1]->tehn);
	
		$contents = str_replace("{2moto}",$teh[0],$contents);
		$contents = str_replace("{2model}",$teh[1],$contents);
		$contents = str_replace("{2cc}",$teh[2],$contents);				
		$contents = str_replace("{2tak}",$teh[3],$contents);
			
			
			
		
		
		echo $contents;
		
	}


	// function printAnketa1($tr){
		
		// $rcm = new RacerManager;
	// $cm = new champManager;
	// $rm = new raceManager;
	
	
	// $x = $rcm->getTeamRace($tr,"","","");
	// $r = $rm->getRace($x[0]->getRID(),"","","","","",0);
	

	// $team = $rcm->getTeam($x[0]->getTeamID(),"","","");
	// $rc = $cm->getClass($x[0]->getCID(),"");
	// 
	// <html>
		// <head>
			// <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			// <meta http-equiv=\"Content-Language\" content=\"lv\">
			
		// </head>
	// <body>
	// <?php
	// echo "<table width =\"800\" border = \"0\" align = \"center\">";
					
					// echo "<tr><td colspan=\"2\"><b>LAMSF Latvijas Čempionāts </b>";
					

					// echo "<tr><td colspan=\"2\"><b>Moto piedzīvojumu sacensības '",$r[0]->getName(),"' </b>";
					
					// echo "<tr><td colspan=\"2\" align=\"center\"><b>Komandas reģistrācijas anketa </b>";	 
					 // <tr><td colspan ="4">
				// Komandas dalībnieki ar parakstu apstiprina savu piedalīšanos Moto Piedzīvojumu sacensībās, apliecina, ka ir iepazinušies ar sacensību nolikumu un piekrīt sacensību noteikumiem, uzņemas visu risku un atbildību par sev radītājiem materiālajiem zaudējumiem vai veselības bojājumiem, apstiprina, ka ir apdrošinājuši savu dzīvību, apliecina savas CSN zināšanas atbilstoši transporta līdzekļa vadīšanai un apzinās motosporta pasākuma bīstamību.
				
				// <?php
					// echo "<tr><td width=\"50%\"><b>Nosaukums: </b><b style=\"font-size:25\">".$team[0]->getName(),"</b>";
					// echo "<td ><b >Klase:</b> <b style=\"font-size:25\">",$rc[0]->getName(),"</b>";
	
	// echo "</table>";
		
		
		// $rinfo = Array();
		
		// $trr= $rcm->getTRRacer($x[0]->getTRID());
		// for($i=0;$i<count($trr);$i++){
			// $item=$rcm->getRacer($trr[$i]->getTRRID());
			// array_push($rinfo,$item[0]);
		// }
		
	// echo "<table width =\"800\" border = \"1\" align=\"center\">";
		// echo "<tr class=\"title\"><td colspan =\"4\" align=\"center\" > 1. Sportista dati";
		// //if ($lid[0]->getRacerID() == $rinfo[0]->getRID()){echo " <b>(kapteinis)</b>";}
		// echo "<tr><td width=\"100\">Vārds, uzvārds: <td width=\"300\"><b style=\"font-size:25\">",$rinfo[0]->getFname()," ",$rinfo[0]->getLname(),"</b>";
		// echo "<td width=\"100\">Starta NR: <td width=\"300\"><b style=\"font-size:25\">",$trr[0]->nr,"</b>";
			
		// echo "<tr><td width=\"100\">Personas kods: <td width=\"300\">",$rinfo[0]->getPK();
		// //$x = new RacerManager;
		// //$list = $x->getClub($rinfo[0]->getClub());
		// echo "<td width=\"100\">Klubs <td width=\"300\">",$trr[0]->clubName;
		
		// echo "<tr><td width=\"100\">Adrese: <td width=\"300\">",$rinfo[0]->getAddr();
		// echo "<td width=\"100\">Licences NR: <td width=\"300\">",$trr[0]->lic;
		
		// echo "<tr><td width=\"100\">Telefona NR: <td colspan = \"3\">",$rinfo[0]->getTel();
		
		// echo "<tr><td width=\"100\">Dzimums: <td colspan = \"3\">";
				// if ($rinfo[0]->getSex() == 1){echo " Nav datu ";};
				// if ($rinfo[0]->getSex() == 2){echo " Vīrietis ";};
				// if ($rinfo[0]->getSex() == 3){echo " Sieviete ";};
		
		// echo "<tr><td width=\"100\">Apdrosinasana: <td colspan = \"3\">";
			// if ($trr[0]->ins == 1){echo " Ir ";} else {echo "Nav";}
			
		// echo "<tr><td width=\"100\">Tehnikas tips: <td colspan = \"3\">";
			
				// if ($trr[0]->type == 1){echo " Nav ievadīts ";};
				// if ($trr[0]->type == 2){echo " Moto ";};
				// if ($trr[0]->type == 3){echo " Velo ";};
				// if ($trr[0]->type == 4){echo " Kvadro ";};
			
		// echo "<tr><td width=\"100\" >Marka un motora tilpums: <td colspan = \"3\">",str_replace("^", " ",$trr[0]->tehn)," taktis";
		// echo "<tr><td width=\"100\" >Sportista paraksts: <td colspan = \"3\">&nbsp";
	// echo "</table> ";
		
	// echo "<table width =\"800\" border = \"1\" align=\"center\">";
		// echo "<tr class=\"title\"><td colspan =\"4\" align=\"center\" > 2. Sportista dati";
		// //if ($lid[0]->getRacerID() == $rinfo[0]->getRID()){echo " <b>(kapteinis)</b>";}
		// echo "<tr><td width=\"100\">Vārds, uzvārds: <td width=\"300\"><b style=\"font-size:25\">",$rinfo[1]->getFname()," ",$rinfo[1]->getLname(),"</b>";
		// echo "<td width=\"100\">Starta NR: <td width=\"300\"><b style=\"font-size:25\">",$trr[1]->nr,"</b>";
			
		// echo "<tr><td width=\"100\">Personas kods: <td width=\"300\">",$rinfo[1]->getPK();
		// echo "<td width=\"100\">Klubs <td width=\"300\">",$trr[1]->clubName;
		
		// echo "<tr><td width=\"100\">Adrese: <td width=\"300\">",$rinfo[1]->getAddr();
		// echo "<td width=\"100\">Licences NR: <td width=\"300\">",$trr[1]->lic;
		
		// echo "<tr><td width=\"100\">Telefona NR: <td colspan = \"3\">",$rinfo[1]->getTel();
		
		// echo "<tr><td width=\"100\">Dzimums: <td colspan = \"3\">";
				// if ($rinfo[0]->getSex() == 1){echo " Nav datu ";};
				// if ($rinfo[0]->getSex() == 2){echo " Vīrietis ";};
				// if ($rinfo[0]->getSex() == 3){echo " Sieviete ";};
		
		// echo "<tr><td width=\"100\">Apdrosinasana: <td colspan = \"3\">";
			// if ($trr[1]->ins == 1){echo " Ir ";} else {echo "Nav";}
			
		// echo "<tr><td width=\"100\">Tehnikas tips: <td colspan = \"3\">";
			
				// if ($trr[1]->type == 1){echo " Nav ievadīts ";};
				// if ($trr[1]->type == 2){echo " Moto ";};
				// if ($trr[1]->type == 3){echo " Velo ";};
				// if ($trr[1]->type == 4){echo " Kvadro ";};
		
		// //$m = getMoto();
		
		// echo "<tr><td width=\"100\" >Marka un motora tilpums: <td colspan = \"3\">",str_replace("^", " ",$trr[1]->tehn)," taktis";
		// echo "<tr><td width=\"100\" >Sportista paraksts: <td colspan = \"3\">&nbsp";
	// echo "</table> ";
	
	// 
	// <table border ="0" width="800" align="center">
						// <tr><td colspan="4"><b>Aizpilda organizatori:  </b>
// <tr><td colspan="4">Komanda iemaksājusi dalības maksu piedzīvojumu sacensībām '<?php echo $r[0]->getName();'  
// <tr><td colspan="4">Ls apmērā:  
// <tr><td colspan="4">Samaksas veids:    
// <tr><td colspan="4">Maksājumu pieņēma:  
 // <tr><td colspan="4" align = "right">Paraksts:  ..................................   
// <tr><td colspan="4">Datums:  

					
					// </table>
					// </body>
					// </html><?php
// }
	
?>