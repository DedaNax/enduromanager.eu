<?php
	
	function proceedReslts($subf,$opt,$class){
		switch ($subf){
			case "pl":
				printResult($opt,$class);
				break;
			case "point":
				printPoints($opt,$class);
				break;
			case "pre":
				printPre($opt,$class);
				break;
			case "all":
				printResult($opt,"");
				break;
			case "champ":
				printchamp(1);
				break;
			case "champ2":
				printchamp(2);
				break;
			case "menu":
				printRelultMenu();
				break;
			case "enduromenu":
				printEnduroResultMenu();
				break;
			case "enduroday":
				printresult1();
				break;
			case "endurorace":
				printresult2();
				break;
			case "clubTeams":
				clubTeams();
				break;
			case "constrTeams":
				constrTeams();
				break;
			case "enduroAbs":
				enduroAbs();
				break;
			case "publishDayResult":
				storeEnduroDay();
				break;
			case "publishDayResultSave":
				storeEnduroDaySave();
				break;
			case "endurodaysaved":
				enduroDaySaved();
				break;
			
			default:
				printMenu();
		}
	
	}
	
	function printMenu(){
		echo "<a style=\"font-size:20px;text-weight:bold\" href=\"?rm_func=reslt&rm_subf=menu \">Piedzīvojumu Enduro rezultāti</a>";
		echo "<br><a style=\"font-size:20px;text-weight:bold\" href=\"?rm_func=reslt&rm_subf=enduromenu\">Enduro rezultāti</a>";
	}
	
	function printRelultMenu(){
		
	//	printAactualRaceMenu();
		
		$rm =new raceManager;
		$cm = new champManager;
		
		
		$cmps  = $cm->getChamps("","","",1);
		$cmp = $cmps[0];
		
		echo "Čempionāts: ";
			echo "<select onchange=\"window.location = this.options[this.selectedIndex].value;\">";
				for($i=0;$i<count($cmps);$i++){
					echo "<option value=\"?rm_func=reslt&rm_subf=menu&cmp=",$cmps[$i]->getID(),"\"";
						if($_SESSION['params']['cmp']==$cmps[$i]->getID()){
							$cmp = $cmps[$i];
							echo " selected ";
						} elseif(!$_SESSION['params']['cmp'] && $cmps[$i]->getYear() == date("Y")) {
							$cmp = $cmps[$i];
							echo " selected ";
						}
					echo ">",$cmps[$i]->getName(),"</option>";
				}
			echo "</select>";
		echo "<hr>";
		
		echo "<a href=\"index.php?rm_func=reslt&rm_subf=champ&cha=",$cmp->getID(),"\">Sezonas kopvērtējums pa klasēm</a><br>";
		echo "<a href=\"?rm_func=reslt&rm_subf=champ2&cha=",$cmp->getID(),"\">Sezonas absolūtais kopvērtējums</a><hr>";
		
		$r = $rm->getRace("",$cmp->getID(),"","","","",0);
		
		$i =0;
		while ($r[$i]){
			
			
			$c= $cm->getActulaRaceClass($r[$i]->getID());
			$j =0;
			echo "<b><font color= \"blue\">",$r[$i]->getName(),"</font></b>";
			while($c[$j]){
				echo "<p>",$c[$j]->getName()," klases <a href=\"index.php?rm_func=reslt&rm_subf=pl&opt=",$r[$i]->getId(),"&class=",$c[$j]->getId(),"\">","vietas</a>";
				echo " | <a href=\"index.php?rm_func=reslt&rm_subf=point&opt=",$r[$i]->getId(),"&class=",$c[$j]->getId(),"\">","spliti</a> ";
				echo " | <a href=\"index.php?rm_func=reslt&rm_subf=pre&opt=",$r[$i]->getId(),"&class=",$c[$j]->getId(),"\">","provizoriskie rezultāti</a> ";
				//| <a href=\"result.php?mode=count&race=",$r[$i]->getId(),"&class=",$c[$j]->getId(),"\">provizoriskās vietas</a> | <a href=\"result.php?mode=split&race=",$r[$i]->getId(),"&class=",$c[$j]->getId(),"\">provizoriskie spliti</a></p>";
				$j++;
			}
			echo "<br><p>"," <a href=\"index.php?rm_func=reslt&rm_subf=all&opt=",$r[$i]->getId(),"\">","Posma absolūtais vērtējums</a>";
			echo "<br><p>"," <a href=\"index.php?rm_func=reslt&rm_subf=pl&opt=",$r[$i]->getId(),"&class=17,18\">","Moto un Kvadro kovertējums</a>";
			//echo "<p>"," <a href=\"result.php?mode=sejas\">","Klubu komandu kopvērtējums</a>";
			$i++;
			
			if ($i<>0){echo "<hr>";}
		}
	}
	
function printPre($r,$c){
	
	$rm = new raceManager;	
	$cm = new champManager;
	
	echo "<center>";
		echo "<h1>";
			echo "!!! PROVIZORISKIE rezultāti !!!";
		echo "</h1>";
	echo "</center>";
	echo "<b>";
		if(!r){
			$cmp = $cm->getChamps($_SESSION['params']['cmp'],"","");
		} else {
			$race = $rm->getRace($r,"","","","","","");
			$cmp = $cm->getChamps($race[0]->getCH_ID(),"","","");
		}
		echo $cmp[0]->getName();
		if($r){
			echo " -> ",$race[0]->getName();
		}
		if($c){
			$class = $cm->getClass($c,"");
			echo " -> ",$class[0]->getName();
		}
	echo "</b>";
	
	echo "<hr>";
	
	echo "<table width=\"100%\" border = \"1\">";
	echo "<tr style=\"font-weight:bold;\"><td>Komanda<td>Braucēji<td>Provizoriskie punkti<td>SU punkti<td>Parkāpumu sodi<td>Kavējuma sodi<td>Rezultāts<td>Vieta";
	$i=0;
	$rt=sort2(getReslt($r,$c));
	
	while($rt[$i]){
		echo "<tr>";
		echo "<td>",$rt[$i][1];
		echo "<td>",$rt[$i][2];
		echo "<td>",$rt[$i][8];
		echo "<td>",$rt[$i][9];
		echo "<td>",$rt[$i][4];
		echo "<td>",$rt[$i][3];
		echo "<td>",$rt[$i][8] + $rt[$i][9]-$rt[$i][3]-$rt[$i][4];
		
		echo "<td>",$i+1;
		$i++;
	}
	echo "</table>";
	
}

function printResult($r,$c){
	$savereslt = 1 ;
	
	$rm = new raceManager;
	$cm = new champManager;
	$cp1 = new ptsManager;
	
	$colname = "Sezonas iegūtie punkti";
	echo "<center>";
		echo "<h1>";
			if($_SESSION['params']['rm_subf']=="pl"){
				echo " Vietas ";
				$colname="Kopvērtējuma punkti savā klasē";
			} else {
				$cp1->delresult2($r);
				echo "Posma absolūtais vērtējums";
				$colname ="Absolūtā kopvērtējuma punkti";
			}
		echo "</h1>";
	echo "</center>";
	echo "<b>";
		if(!$r){
			$cmp = $cm->getChamps($_SESSION['params']['cmp'],"","");
		} else {
			$race = $rm->getRace($r,"","","","","","");			
			$cmp = $cm->getChamps($race[0]->getCH_ID(),"","","");
		}
		echo $cmp[0]->getName();
		if($r){
			echo " -> ",$race[0]->getName();
		}
		if($c){
			echo " -> ";
			$cls = explode(",",$c);
			if(count($cls)>1){$savereslt = 0;}
			for ($i=0;$i<count($cls);$i++){			
				$class = $cm->getClass($cls[$i],"");
				echo $class[0]->getName(),$i<count($cls)-1 ? ", ": "";
				
			}		
		}
	echo "</b>";
	
	echo "<hr>";
	echo "<table><tr><td style=\"background:red;\" width=\"20\">&nbsp<td>- Nav ievadīti punkti<td style=\"background:gold;\" width=\"20\">&nbsp<td >Nav veikta vertēšana<td style=\"background:darkorange;\" width=\"20\">&nbsp<td >Nav pabeigta vertēšana</table>";
	echo "<table width=\"100%\" border = \"1\">";
	echo "<tr style=\"font-weight:bold;\"><td>Komanda<td>Braucēji<td>Provizoriskie punkti<td>SU punkti<td>Neieskaitītie punkti<td>Nieieskaitītās atbildes<td>Kavējumu sodi<td>Parkāpumu sodi<td>Laiks trasē<td>Rezultāts
		<td>$colname<td>Vieta";
	//echo "|",$r," ",$c,"|";	
	
	$i=0;
	$pts = 20;
	$pt=0;
	$place=0;
		
	$rt=getReslt($r,$c);
	
	while($rt[$i]){
		echo "<tr ";
		
		if($rt[$i][12]==1){
			echo "style=\"background:red;\"";
		} elseif($rt[$i][12]==2){
			echo "style=\"background:gold;\"";
		} elseif($rt[$i][12]==3){
			echo "style=\"background:darkorange;\"";
		}
		
		echo ">";
		echo "<td>",$rt[$i][1];//," - ",$rt[$i][12];
		echo "<td>",$rt[$i][2];
		echo "<td>",$rt[$i][8];
		echo "<td>",$rt[$i][9];
		echo "<td>";if($rt[$i][12]<>0){echo "0";} else {echo $rt[$i][10];} ;
		echo "<td>",$rt[$i][11];
		echo "<td>",$rt[$i][3];
		echo "<td>",$rt[$i][4];
		echo "<td>",$rt[$i][16];
		echo "<td>",$rt[$i][7];
		echo "<td>";
			if($_SESSION['params']['rm_subf']=="pl"){
				echo $rt[$i][13];
				
			}else {			
				//if (($rt[$i][7]<>$rt[$i-1][7]) or ($rt[$i][7] == 0) ){
					$place = $i+1;
				//}
				//if (($rt[$i][8]) == 0 or $i >=15) {
				if ( $i >=15) {
					echo 0;
				} else {
					$epts=0;
					if($place == 1){
						$epts=$pts;
					} elseif ($place < 6){
						$epts = $pts - ($place -1)* 2 -1;
					} elseif ($place >=6){
						$epts = $pts - $place  -4;
					}
					if($savereslt){
						$cp1->saveresult2($rt[$i][15],$epts,$r);
					}
					echo $epts;
				}
			}
		echo "<td>",$i+1;
		$i++;
	}
	echo "</table>";
	echo "<table><tr><td style=\"background:red;\" width=\"20\">&nbsp<td>- Nav ievadīti punkti<td style=\"background:gold;\" width=\"20\">&nbsp<td >Nav veikta vertēšana<td style=\"background:darkorange;\" width=\"20\">&nbsp<td >Nav pabeigta vertēšana</table>";
}

function printPoints($r,$c){
	$trm= new TRManager;
	$rm = new raceManager;
	$rcr = new RacerManager;
	$cm = new champManager;
	
	echo "<center>";
		echo "<h1>";
			echo "Spliti";
		echo "</h1>";
	echo "</center>";
	echo "<b>";
		if(!r){
			$cmp = $cm->getChamps($_SESSION['params']['cmp'],"","");
		} else {
			$race = $rm->getRace($r,"","","","","","");
			$cmp = $cm->getChamps($race[0]->getCH_ID(),"","","");
		}
		echo $cmp[0]->getName();
		if($r){
			echo " -> ",$race[0]->getName();
		}
		if($c){
			$class = $cm->getClass($c,"");
			echo " -> ",$class[0]->getName();
		}
	echo "</b>";
	
	echo "<hr>";
	
	echo "<table><tr><td style=\"background:crimson;\" width=\"20\">&nbsp<td>- Nav ievadīti punkti<td style=\"background:gold;\" width=\"20\">&nbsp<td >Nav ieskaitīti punkti<td style=\"background:aquamarine;\" width=\"20\">&nbsp<td >KP ir ieskatīts, atbilde nav ieskaitīta<td style=\"background:seagreen;\" width=\"20\">&nbsp<td >Punkti un atbilde ir ieskatīti<td style=\"background:darkorange;\" width=\"20\">&nbsp<td >Bilde ir apšaubāma</table>";
	echo "<table  border=\"1\">";
	echo "<tr><td width=\"20\">&nbsp";

	$tr = $rcr->getACCTeamRace($r,$c,0,"");
	
	$i = 0;	
	while ($tr[$i]){
		$t = $rcr->getTeam($tr[$i]->getTeamID(),"","","");
		if($t){
		echo "<td >",$t[0]->getName();
		} else {echo "<td >ERR";}
		$i++;
	}
	
	$cp = $rm->getChPoint("",$r,"","");
	$i = 0;	
	while ($cp[$i]){
		if((strtoupper(substr($cp[$i]->getName(),0,2))=="SU")){$i++;continue;}
		
		$cpd = $rm->getChpDet("",$c,$cp[$i]->getId());
		if($cpd){
			echo "<tr align=\"center\" style=\"font-weight:bold\"><td>",$cp[$i]->getName(),$cp[$i]->getCost();
			$j=0;
			while($tr[$j]){
				$kp = $trm->getTRKP("",$tr[$j]->getTRID(),"","",$cp[$i]->getId(),1);
				$val=0;
				if ($kp){
					
					switch($kp[0]->getIok()){
						case 1:
							$val=$cp[$i]->getCost();
							$color="seagreen";
							switch ($kp[0]->getAok()){
								case 1:
									break;
								case 0:								
								case 2:
									$val--;
									$color="aquamarine";
							}
							break;
						case 0:
							$color="gold";
							break;
						case 2:
							$color="darkorange";
							break;
					}			
					
					
					echo "<td bgcolor=\"$color\">",$val;
					
				} else {
					echo "<td bgcolor=\"crimson\">&nbsp";
				}
				$total[$j]+=$val;
				$j++;
			}
		}
		$i++;
	}
	$i = 0;	echo "<tr><td>Kopa:";
	while (isset($total[$i])){		
		echo "<td>",$total[$i];
		$i++;
	}
	echo "</table>";
	echo "<table><tr><td style=\"background:crimson;\" width=\"20\">&nbsp<td>- Nav ievadīti punkti<td style=\"background:gold;\" width=\"20\">&nbsp<td >Nav ieskaitīti punkti<td style=\"background:aquamarine;\" width=\"20\">&nbsp<td >KP ir ieskatīts, atbilde nav ieskaitīta<td style=\"background:seagreen;\" width=\"20\">&nbsp<td >Punkti un atbilde ir ieskatīti<td style=\"background:darkorange;\" width=\"20\">&nbsp<td >Bilde ir apšaubāma</table>";
}

function sort_champ($pts){

	$race_count = 3; //Gonku skaits kopvērtējumā
	
	$t_keys = array_keys($pts);
	for ($i=0;$i<count($t_keys);$i++){
		$r_keys = array_keys($pts[$t_keys[$i]]);
		
		//orderējam gonkas pēc iegūtiem punktiem
		for($j=count($r_keys)-1;$j>=0;$j--){
			for($k=1;$k<=$j;$k++){
				if($pts[$t_keys[$i]][$r_keys[$k-1]]['pts'] < $pts[$t_keys[$i]][$r_keys[$k]]['pts']){
					$tmp = $r_keys[$k-1];
					$r_keys[$k-1] = $r_keys[$k];
					$r_keys[$k]=$tmp;
				}			
			}		
		}
		
		//saskaitam kopā punktus
		$tmpa = array();
		$sum=0;
		for($j=0;$j<count($r_keys);$j++){
			$tmpa[$r_keys[$j]] = $pts[$t_keys[$i]][$r_keys[$j]];
			if ($j<$race_count){			
				$tmpa[$r_keys[$j]]['x']=1;
				$sum+=$tmpa[$r_keys[$j]]['pts'];
			}
		}	
		$tmpa[-1]=$sum;
		$pts[$t_keys[$i]] = $tmpa;
	}
	
	//orderējam komandas pēc iegūtiem punktiem sezonā
	for($j=count($t_keys)-1;$j>=0;$j--){
		for($k=1;$k<=$j;$k++){
			$shift = false;
			if($pts[$t_keys[$k-1]][-1] < $pts[$t_keys[$k]][-1]){
				$shift = true;
			} elseif($pts[$t_keys[$k-1]][-1] == $pts[$t_keys[$k]][-1]){
							
				if ($pts[$t_keys[$k-1]][0]['pts'] < $pts[$t_keys[$k]][0]['pts']){
					$shift = true;
				}
					
			}
				
			if ($shift){
				$tmp = $t_keys[$k-1];
				$t_keys[$k-1] = $t_keys[$k];
				$t_keys[$k]=$tmp;
			}
		}		
	}
	
	$tmpa = array();
	for($j=0;$j<count($t_keys);$j++){
		$tmpa[$t_keys[$j]] = $pts[$t_keys[$j]];
	}		
	
	return $tmpa;
}
function sort1($arr){
	for($i=count($arr)-1;$i>=0;$i--){
		for($j=1;$j<=$i;$j++){
			if($arr[$j-1][7]<$arr[$j][7]){
				$tmp = $arr[$j-1];
				$arr[$j-1] = $arr[$j];
				$arr[$j]=$tmp;
			}			
		}		
	}
	return $arr;
}

function sort2($arr){
	for($i=count($arr)-1;$i>=0;$i--){
		for($j=1;$j<=$i;$j++){
			if($arr[$j-1][8] + $arr[$j-1][9] -$arr[$j-1][3]-$arr[$j-1][4] < $arr[$j][8] + $arr[$j][9]-$arr[$j][3]-$arr[$j][4]){
				$tmp = $arr[$j-1];
				$arr[$j-1] = $arr[$j];
				$arr[$j]=$tmp;
			}			
		}		
	}
	return $arr;
}

function getReslt($r,$c){
	$cp1 = new ptsManager;
	$trm= new TRManager;
	$rm = new raceManager;
	$rcr = new RacerManager;
	
	$tr = $rcr->getResults($r,$c,0,$_SESSION['params']['cmp']);
	//print_r($tr);
	$i = 0;
	
	while ($tr[$i]){
		$tm = $rcr->getTeam($tr[$i]['TeamID'],"","","");
		$n = $tm[0]->getID();
		$tra = $rt[$n];
		if(!$tra){
			$index[count($index)+1] = $n;
		}		
		if ( $tm  ){
			
			$tra[0]=$tm[0]->getName();
			$tra[1]=$tm[0]->getName();
			
			$rcrs = Array();			
			$trr= $rcr->getTRRacer($tr[$i]['TRID']);
			for($k=0;$k<count($trr);$k++){
				$item=$rcr->getRacer($trr[$k]->getTRRID(),"","");
				array_push($rcrs,$item[0]);
			}
			$p = $rcrs[0];
			$p1 = $rcrs[1];		
		
			
			$tra[2] = $p->getFname()." ".$p->getLname()."<br>".$p1->getFname()." ".$p1->getLname();

			$tra[3] = $tr[$i]['sfpen'];
			$tra[5]+=$point;
			$tra[6]+=$pen;
			
			$tra[4] = $tr[$i]['pen'];//+= $sods;
			$tra[7] = $tr[$i]['total_pts'];//+=$point-$pen-$pen1+$su-$sods;
			$tra[8] = $tr[$i]['pts_sum'];//+=$prov;
			$tra[9] = $tr[$i]['SU_pts'];//+=$su;
			$tra[10]= $tr[$i]['NIOK_pts'];//=$niok;
			$tra[11]= $tr[$i]['NAOK_pts'];//=$naok;
			$tra[12]=0;
			if(!$_SESSION['params']['cmp']){
				if($trm->TRHasQuest($tr[$i]['TRID']) > 0){$tra[12]=3;}
				if($tr[$i]['Closed'] != 1){$tra[12]=2;}
				if($tr[$i]['Completed'] != 1){$tra[12]=1;}
			}
			
			if ($_SESSION['params']['rm_subf']=="pl"){
				$qreslt = $cp1->getreslt($tr[$i]['TeamID'],$tr[$i]['ClassID'],$tr[$i]['RaceID']);
				$row=mysql_fetch_array($qreslt, MYSQL_ASSOC);
				
				$tra[13] += $row ? $row['PTS'] : 0;
			} else {
				$tra[13] = "x";
			}
			
			$tra[14] = $r;
			$tra[15] = $tr[$i]['TRID'];
			$tra[16] = $tr[$i]['fintime'];
			
			$rt[$n]=$tra;
		}
		$i++;
	}
	
	for($i=1;$i<=count($index);$i++){
		$reslt[$i-1] = $rt[$index[$i]];
	}
	
	return $reslt;	
}

function getReslt2($r,$c){
	$trm= new trManager;
	$tmm = new teamManager;
	$kpm = new kpManager;
	$rm = new raceManager;
	
	$tr = $trm->getTR2("","",$r,$c);
	
	$i = 0;
$n=0;
	while ($tr[$i]){

		$tm = $tmm->getTeam($tr[$i]->getTid(),"","","","","");

		
		if ( $tm  ){
			$tra[0]=$tm[0]->getLogin();
			$tra[1]=$tm[0]->getName();
			$tmt = $tmm->getTMate("",$tr[$i]->getTid());
			$tra[2] = "";
			
			if($tmt[0]){
				
				$tra[2] = $tmt[0]->getLname()." ".$tmt[0]->getFname();
			} 
			if($tmt[1]){
				$tra[2] = $tra[2].", ".$tmt[1]->getLname()." ".$tmt[1]->getFname();
			} 
			$tra[3]=$tr[$i]->getStart();
			$tra[4]=$tr[$i]->getEnd();
			
			$kp= $kpm->getKP("","",$tr[$i]->getId(),"","","");
			$j=0;
			$point=0;
			$pen=0;
			
			while($kp[$j]){
				$cp = $rm->getChPoint($kp[$j]->getCpId(),"","","");
				///if ($kp[$j]->getIok()==1){				
					$point+=$cp[0]->getCost();				
						//if ($kp[$j]->getAok()==0 and (strtoupper(substr($cp[0]->getName(),0,2))!="SU")){
						//$pen++;					
					//}
				//}
				//$pen+=$kp[$j]->getPen();
				$j++;
			}
			
			$pen+=$tr[$i]->getPen();
			if ($point <0){$point =0;}
			$tra[5]=$point;
			$tra[6]=$pen;
			$tra[7]=$point-$pen;
			
			$rt[$n]=$tra;
			
			$n++;
		}
		$i++;
	}
	return $rt;
}

function printCount($r,$c){

	echo "<table width=\"100%\" border = \"1\">";
	echo "<tr><td>Nr<td>Komanda<td>Braucēji<td>Starta laiks<td>Finiša laiks<td>Punkti<td>Vieta";
	$i=0;
	$rt=sort1(getReslt2($r,$c));
	
	while($rt[$i]){
		echo "<tr><td>",$rt[$i][0];
		echo "<td>",$rt[$i][1];
		echo "<td>",$rt[$i][2];
		echo "<td>",$rt[$i][3];
		echo "<td>",$rt[$i][4];
		echo "<td>",$rt[$i][5];
		//echo "<td>",$rt[$i][6];
		//echo "<td>",$rt[$i][7];
		echo "<td>",$i+1;
		$i++;
	}
	echo "</table>";
}

function printSplit($r,$c){
	$trm= new trManager;
	$tmm = new teamManager;
	$kpm = new kpManager;
	$rm = new raceManager;
	
	echo "<table  border=\"1\">";
	echo "<tr><td width=\"20\">&nbsp";

	$tr = $trm->getTR2("","",$r,$c);
	
	$i = 0;	
	while ($tr[$i]){
		$t = $tmm->getTeam($tr[$i]->getTid(),"","","","","");
		if($t){
		echo "<td >",$t[0]->getLogin();
		} else {echo "<td >ERR";}
		$i++;
	}
	
	$cp = $rm->getChPoint("",$r,"","");
	$i = 0;	
	while ($cp[$i]){
		$cpd = $rm->getChpDet("",$c,$cp[$i]->getId());
		if($cpd){
			echo "<tr><td>",$cp[$i]->getName(),$cp[$i]->getCost();
			$j=0;
			while($tr[$j]){
				$kp = $kpm->getKP("",$cp[$i]->getId(),$tr[$j]->getId(),"","","");
				$val=0;
				if ($kp){
					
					//if ($kp[0]->getIok()==1){
						$val=$cp[$i]->getCost();
						//if(($kp[0]->getAok()==0) and (strtoupper(substr($cp[$i]->getName(),0,2))!="SU")){
						//	$val--;
						//}
					//}
					//$val-=$kp[0]->getPen();
					$color="yellow";
					//if($val>0){$color="green";}
					echo "<td bgcolor=\"$color\">",$val;
					
				} else {
					echo "<td bgcolor=\"red\">&nbsp";
				}
				$total[$j]+=$val;
				$j++;
			}
		}
		$i++;
	}
	$i = 0;	echo "<tr><td>Kopa:";
	
	while (isset($total[$i])){		
		echo "<td>",$total[$i];
		$i++;
	}
	echo "</table>";
}

function printchamp($mode){
	
	$cp = new ptsManager;
	$rm = new raceManager;
	$rcm = new RacerManager;
	$chm = new champManager;
	
	if (!$_SESSION['params']['cha']){
		return ;
	}
	echo "<center>";
		echo "<h1>";
		switch ($mode){
			case  1:
				echo "Sezonas kopvērtējums pa klasēm";
				break;
			case 2:
				echo "Sezonas absolūtais kopvērtējums";
				break;
		}
			
		echo "</h1>";
	echo "</center>";
	echo "<b>";		
		$cmp = $chm->getChamps($_SESSION['params']['cha'],"","","");
		echo $cmp[0]->getName();		
	echo "</b>";	
	echo "<hr>";
	
	$champ = $_SESSION['params']['cha'];
	
	$race = $rm->getRace("",$champ,"","",1,"","");
	$cl = $chm->getClass("",1);
	$cl_cnt = $mode == 1 ? count($cl) : 1;
	for ($i=0;$i<$cl_cnt;$i++){
		$pts = array();
		for ($j=0;$j<count($race);$j++){
		
			$reslt = ($mode == 1 ? $cp->getresult($cl[$i]->getID(),$race[$j]->getId()): $cp->getresult2($race[$j]->getId()));
			
			while ($row = mysql_fetch_array($reslt, MYSQL_ASSOC)) {
				$pts[$row['teamid']][$row['race_id']]['pts'] = $row['pts'];
				$pts[$row['teamid']][$row['race_id']]['tr'] = $row['trid'];
				$pts[$row['teamid']][$row['race_id']]['x'] = 0;
			}
		}	
		
		$pts = sort_champ($pts);
		
		if ($mode == 1){
			echo "<h1>",$cl[$i]->getName(),"</h1>";
		}
		echo "<table width=\"100%\" border =\"1\"><tr style=\"font-weight:bold\"><td width=\"300\">Komanda";
			for($k=0;$k<count($race);$k++){
				echo "<td>",$race[$k]->getName();
			}
			echo "<td>Punkti<td>Vieta";	
			$place = 0;
			$keys = array_keys($pts);
			
			for ($k=0;$k<count($keys);$k++){
				$tim = $rcm->getTeam($keys[$k],"","","");
				echo "<tr><td>",$tim[0]->getName();
				
				for($m=0;$m<count($race);$m++){
					if (isset($pts[$keys[$k]][$race[$m]->getId()])){
					
						
						echo "<td><table border = \"1\" width=\"100%\" ";
							if ($pts[$keys[$k]][$race[$m]->getId()]['x']){
								echo " style=\" border-style:solid;border-width:5px;border-color:green\"";
							}
						echo ">";
						
							
							$rcrs = Array();			
							$trr= $rcm->getTRRacer($pts[$keys[$k]][$race[$m]->getId()]['tr']);
							for($z=0;$z<count($trr);$z++){
								$item=$rcm->getRacer($trr[$z]->getTRRID(),"","");
								array_push($rcrs,$item[0]);
							}
							$p = $rcrs[0];
							$p1 = $rcrs[1];
							
							echo "<tr><td>",$p->getFname() ," ",$p->getLname();
							echo "<td rowspan=\"2\" align=\"center\" width = \"50\">",$pts[$keys[$k]][$race[$m]->getId()]['pts'];					
							echo "<tr><td>",$p1->getFname() ," ",$p1->getLname();
							
						echo "</table>";
					} else {
						echo "<td>&nbsp";
					}
				}
				
				echo "<td>",$pts[$keys[$k]][-1];
				echo "<td>",++$place;
				
			}
			
		echo "</table>";
		
		
	}	
}
?>