<?php
	
	function storeEnduroDaySave(){		
		$result = $_SESSION[resutltToStore][$_SESSION['params']['day']];								
		
		$sql = "
			update `enduro_day_racer`
			set `points` = 0
			where `erd_id` = ".$_SESSION['params']['day'];
		queryDB($sql);
			
		$sql = "
			select max(`PublishID`) as PublishID
			from `enduro_results`";
		$r = queryDB($sql);
		$publishID = 0;
		if($row = mysql_fetch_array($r, MYSQL_ASSOC)){
			$publishID = $row[PublishID] + 1;
		}
			
		for($i=0;$i<count($result)-1;$i++){			
			if(!$result[$i][DQ] && !$result[$i][DQ2] && !$result[$i][DQ3]){
				$sql = "
					update `enduro_day_racer`
						set 
							`points` = ".$result[$i][pt].",
							`sec100` = ".$result[$i][sec100]."
					where `edr_id` = ".$result[$i][edr_id]; 
				queryDB($sql);
			}
			
			$sql = 
			"INSERT INTO `enduro_results`(
				`RaceID`, 
				`RaceDayID`, 
				`RaceName`, 
				`RaceDayText`, 
				`RaceDate`, 
				`RaceDayDate`, 
				`ClassID`, 
				`ClassName`, 
				`SportNr`, 
				`FName`, 
				`LName`, 
				`ClubName`, 
				`CountryName`, 
				`DQ_LK0K`, 
				`DQ_LK`, 
				`LK0K`, 
				`LK`, 
				`DQ`, 
				`DQ_DQ`, 
				`DQ3`, 
				`DQ1`, 
				`DQ2`, 
				`Secparts`, 
				`tim`, 
				`pt`, 
				`edr_id`, 
				`sec100`, 
				`user_id`, 
				`Result`, 
				`SecPart`, 
				`tests`,
				`Info`,
				`Type`,
				`PublisherID`,
				`PublisherName`,
				`ChampId`,
				`PublishID`
			) VALUES (
				".$result[-1][RaceID].",
				".$result[-1][RaceDayID].",
				'".$result[-1][RaceName]."',
				'".$result[-1][RaceDayText]."',
				'".$result[-1][RaceDate]."',
				'".($result[-1][RaceDayDate] ? $result[-1][RaceDayDate]: "null")."',
				".$result[$i][ClassID].",
				'".$result[$i][ClassName]."',
				'".$result[$i][SportNr]."',
				'".$result[$i][FName]."',
				'".$result[$i][LName]."',
				'".$result[$i][ClubName]."',
				'".$result[$i][CountryName]."',
				".$result[$i][DQ_LK0K].",
				".$result[$i][DQ_LK].",
				'".$result[$i][LK0K]."',
				'".$result[$i][LK]."',
				".($result[$i][DQ] ? $result[$i][DQ] : "null").",
				".($result[$i][DQ_DQ] ? $result[$i][DQ_DQ] : "null").",
				".($result[$i][DQ3] ? $result[$i][DQ3] : "null").",
				".($result[$i][DQ1] ? $result[$i][DQ1] : "null").",
				".($result[$i][DQ2] ? $result[$i][DQ2] : "null").",
				".$result[$i][Secparts].",
				".($result[$i][tim] ? "'".$result[$i][tim]."'" : "null").",
				".$result[$i][pt].",
				".$result[$i][edr_id].",
				".($result[$i][sec100] ? $result[$i][sec100] : "null").",
				".$result[$i][user_id].",
				'".json_encode($result[$i][Result])."',
				'".json_encode($result[$i][SecPart])."',
				'".json_encode($result[$i][tests])."',
				'".$_SESSION[params][Info]."',
				'".$result[-1][Type]."',
				'".$result[-1][PublisherID]."',
				'".$result[-1][PublisherName]."',
				".$result[-1][ChampId].",
				$publishID
			)";					
			//echo $sql,"<br>";
			queryDB($sql);
		}
		
		echo "<center><h1>".ORG_RACE_DAY_RESULT_PUBLISH_SUCCESS."</h1></center>";
		
	}
	
	
	function enduroDaySaved(){
		$publishID = $_SESSION['params'][publishID];
		
		$sql = 
		   "SELECT `Info`, `PublisherName`,`RaceName`, `RaceDayText`, `TimeStamp`
			FROM  `enduro_results` 
			WHERE  `publishID` = $publishID
			LIMIT 0, 1";
		
		$r = queryDB($sql);
		while($rslt = mysql_fetch_array($r, MYSQL_ASSOC)){
			echo "<b style=\"font-size:18px\">";
				echo $rslt[RaceName]," ",$rslt[RaceDayText];
			echo "</b> ";
			echo $rslt[Info];
			echo "<hr>";
			
			if(!$publishID)break;			
			$sql = "
				SELECT * 
				FROM  `enduro_results` 
				WHERE  `PublishId` = $publishID
				ORDER BY  `ID`";			
			$results = queryDB($sql);			
			$class = null;
			$place = 1;
			
			while($row = mysql_fetch_array($results, MYSQL_ASSOC)){
				
				if($class != $row[ClassID]){
					$place = 1;
					if($class != null){
						echo "</tbody></table>";
					}
					echo "<h2>",$row[ClassName],"</h2>";
					echo "<table border =\"1\" style=\"border-collapse: collapse\"><tbody>";
						echo "<tr style = \"font-weight:bold\"><td>Num<td>Sportists<td>Klubs<td>Valsts<td>TK LK0<td>LK";
							$tests = json_decode($row[tests]);
							for ($j=0;$j<count($tests);$j++){
								echo "<td>",$tests[$j];
							}
						echo "<td>Laiks kopā<td>Ieskaites punkti<td>Vieta";
				}		
				echo "<tr><td><b>",$row[SportNr],"</b><td>",$row[FName]," ",$row[LName],"<td>",$row[ClubName],"<td>",$row[CountryName];
	
				echo "<td ",$row[DQ_LK0K] ? "style=\"background-color:pink\"" : "",">",substr($row[LK0K],0,2) != "00" ? $row[LK0K] : substr($row[LK0K],3,20); 
				echo "<td ",$row[DQ_LK] ? "style=\"background-color:pink\"" : "",">",substr($row[LK],0,2) != "00" ? $row[LK] : substr($row[LK],3,20); 
								
					$resultValues = json_decode($row[Result]);
					$secparts = json_decode($row[SecPart]);
					for ($j=0;$j<count($tests);$j++){												
						
						if ($resultValues[$j] != "00:00:00" && $resultValues[$j] != ""){				
							echo "<td style=\"text-align:right\">";						
							echo $resultValues[$j];
						}else {
							if($row[DQ2]){
								echo "<td style=\"text-align:right;background-color:pink\">&nbsp";								
							} else {
								echo "<td style=\"text-align:right\">";
								echo "00:00";									
							}
						}
					}
					echo "<td style = \"font-weight:bold\">";
					if ($row[DQ3]){
						echo "<i>",DQ,"</i>";
					} elseif ($row[DQ]){
						echo "<i>",RESULT_IZST,"</i>";
					} else {
						echo "<b>",$row[tim],"</b>";
					}
					
					echo "<td style=\"text-align:center\">";
					echo ($row[DQ] || $row[DQ2] || $row[DQ3]) ? "" : $row[pt];
					echo "<td style=\"text-align:center\">",($row[DQ] || $row[DQ2] || $row[DQ3]) ? "" :$place;
				$class = $row[ClassID];
				$place++;
			}
			echo "</tbody></table>";
			echo "<hr><p style=\"font-style: italic\">";
				echo $rslt[RaceName]," ",$rslt[RaceDayText]," ",$rslt[Info], " | ",$rslt[PublisherName]," ",DateTimeString($rslt[TimeStamp]);
			echo "</p><hr>";
			
			break;
		}
	}
	
	function storeEnduroDay(){
		$rm = new raceManager;
		$cm = new champManager;
		$em = new EnduroManager;
		
		$resutltToStore = array();		
		
		$resutltToStore[-1][PublisherID] = $_SESSION[user_id];		
		$sql = "SELECT u.`pf_rm_f_name` as FName, u.`pf_rm_l_name` as LName
				FROM `phpbb_profile_fields_data` u
				WHERE u.`user_id` = ".$_SESSION[user_id];				
		$r = queryDB($sql);
		if($row = mysql_fetch_array($r, MYSQL_ASSOC)){
			$resutltToStore[-1][PublisherName] = $row[FName] ." ".$row[LName];
		} else {
			$resutltToStore[-1][PublisherName] = "";
		}		
				
		$day=$_SESSION['params']['day'];
		$erd = $em->getERD1($day); $resutltToStore[-1][RaceDayID] = $day;
		$r = $rm->getRace($erd[0]->RACE_ID,"","","","","","",""); $resutltToStore[-1][RaceID] = $erd[0]->RACE_ID;
		$resutltToStore[-1][ChampId] = $r[0]->getCH_ID();

		$resutltToStore[-1][Type] = "";
		if($r[0]->getName() == 3){
			$resutltToStore[-1][Type] = "SPRINT";			
		}
			
				
		echo "<a href=\"?rm_func=reslt&rm_subf=enduromenu\"><b>Rezultāti</b></a>";		
		echo " -> <b>",$r[0]->getName(),"</b>"; $resutltToStore[-1][RaceName] = $r[0]->getName();		
		$resutltToStore[-1][RaceDate] = $r[0]->getDate();	
		echo " -> <b>",DateTimeString($erd[0]->START_DATE),"</b>"; $resutltToStore[-1][RaceDayText] = DateTimeString($erd[0]->START_DATE);		
		$resutltToStore[-1][RaceDayDate] = $erd[0]->START_DATE;
		echo "<hr>";
		
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
		
		$sql = "
			update `enduro_day_racer`
				set `points` = 0
			where `erd_id` = ".$_SESSION['params']['day'];
		queryDB($sql);
		
		$sql = "
		select  * ,club.name as club_name,
				b.`summ` + b.`pen` + (b.`secparts` div 100) as reslt, 
				b.`summ2` + b.`pen` + (b.`secparts` / 100) as reslt2,
				sec_to_time(b.`summ` + b.`pen` + (b.`secparts` div 100)) as tim , 
				sec_to_time(b.`summ2` + b.`pen` + (b.`secparts` div 100)) as tim2,
				(b.`summ` + b.`pen`)*100 + b.`secparts` as sec100
		from `enduro_race_class_day` ercd
			inner join (
				SELECT 
				  edr.`edr_id`,
				  edr.`lk` as lk , 
				  edr.`lk0k` as lk0k ,
				  if(time_to_sec(edr.`lk`) >= 3600,1,0) as DQ_LK,
				  if(time_to_sec(edr.`lk0k`) >= 3600,1,0) as DQ_LK0K,	
				  edr.`DQ` as DQ_DQ,
				  edr.`IZS` as DQ_IZS,
				  edr.`erd_id`, 
				  ea.`class_id`, 
				  ea.`racer_id`,
				  a.`summ`,
				  a.`pen`,
				  a.`summ2`,
				  a.`secparts`
				FROM `enduro_day_racer` edr
					inner join `enduro_application` ea on (ea.`era_id` = edr.`ea_id` and edr.`erd_id` = ".$_SESSION['params']['day'].")
					  left join (
						 select ea1.`racer_id`,
								sum(time_to_sec(etr1.`result`)) as summ,
								sum(etr1.`SEC_PARTS`) as secparts,
								sum(time_to_sec(if( etr1.`result` =   '00:00:00', '50:59:59', etr1.`result` ))) as summ2,
								time_to_sec(if(edr1.`lk` > '00:59:59', '50:59:59',edr1.`lk`))  + 
									time_to_sec(if(edr1.`lk0k` > '00:59:59', '50:59:59',edr1.`lk0k`)) +
										if(edr1.`IZS` = 1 or edr1.`DQ` = 1 , time_to_sec('50:59:59'),0)as pen ,
								etr1.`etr_id`
						 FROM `enduro_day_racer` edr1
						 inner join `enduro_application` ea1 on (ea1.`era_id` = edr1.`ea_id`)
						   inner join `enduro_test_result` etr1 on (
								edr1.`edr_id` = etr1.`edr_id` and 
								edr1.`erd_id` = ".$_SESSION['params']['day']." and
								etr1.`ETR_ID` not in (
									select etr2.`etr_id` from `enduro_test_result` etr2
										inner join `enduro_day_racer` edr2 on (edr2.`edr_id` = etr2.`edr_id`)
										inner join `enduro_application` eaX on (eaX.`era_id` = edr2.`ea_id`)
											inner join `enduro_test_ignore` ri on (
												ri.`erd_id` = edr2.`erd_id` and 
												ri.`lap` = etr2.`lap` and 
												ri.`test_id` = etr2.`task` and
												ri.`class_id` = eaX.`class_id`
											)
								)
							) 
						 group by ea1.`racer_id`
					  ) a on (a.`racer_id` = ea.`racer_id`) 
				group by edr.`erd_id`, ea.`class_id`, ea.`racer_id`
			) b on (b.`class_id` = ercd.`class_id` and b.`erd_id` = ercd.`erd_id`)
				inner join `phpbb_profile_fields_data` u on (u.`user_id` = b.`racer_id`)
				left join `c_club` club on (club.`ID` = u.`pf_rm_club`)
				inner join `d_class` cl on (cl.`classid` = b.`class_id`)
		where ercd.`erd_id` = ".$_SESSION['params']['day']."
		order by cl.`weight` asc,cl.`code`, `reslt2` asc, b.`racer_id`";
	//echo $sql;

	$r = queryDB($sql);
	$class_id = -1;
	$rc = -1;
		
	$et = $em->getEt("",$erd[0]->RACE_ID);
	$cl = "";
	$pl1=0;
	$pl2=1;		
	$pt = 20;	
	$pt1 = 20;
	$tmp = -1;
	$index = 0;
	while($row = mysql_fetch_array($r, MYSQL_ASSOC)){		
		$DQ = 0;		
		$DQ2 = 0;	
		$DQ3 = 0;
	
		$resutltToStore[$index][ClassID] = $row[CLASS_ID];
		$resutltToStore[$index][ClassName] = $row[Name];
		
		if(!$tests){$tests = array();}
		if($row[CLASS_ID] != $class_id) {
			$tests = array();
			$pl1=0;
			$pl2=1;		
			$pt = 20;			
			$tmp = -1;
			$cl = $em->getERCD("",$day,$row[CLASS_ID] );
			echo "</table>";
			echo "<br><b style=\"font-size:16px\">",$row[Name],"</b><br>"; 
			echo "<table border =\"1\" style=\"border-collapse: collapse\">";
				echo "<tr style=\"font-weight:bold\">";
					echo "<td>Num";
					echo "<td width=\"150\">Sportists";
					echo "<td width=\"150\">Klubs";
					echo "<td width=\"100\">Valsts";
					echo "<td>TK LK0";
					echo "<td>LK";					
					for($i=0;$i<count($et);$i++){
						for($j=0;$j<$cl[0]->ENDURO_LAPS;$j++){
							$sql = "select * 
									from `enduro_test_ignore` 
									where 
										`erd_id` = ".$_SESSION['params']['day']." 
										and `test_id` = ".$et[$i]->ET_ID." 
										and `class_id` = ".$row[CLASS_ID]."
										and `lap` = ".($j+1);
							$r1 = queryDB($sql);					
							if (mysql_num_rows($r1)!=0){continue;}
							
							echo "<td>",$et[$i]->NAME." ".($j+1);
							array_push($tests, $et[$i]->NAME." ".($j+1));
						}						
					}
					echo "<td>Laiks kopā";
					echo "<td>Ieskaites punkti";
			$class_id = $row[CLASS_ID];	
		}
		$resutltToStore[$index][tests]=$tests;
		if($rc!=$row[user_id]){
			$pl1++;
			if($tmp != $row[reslt2]){
				$pl2=$pl1;	
				$tmp = $row[reslt2];
			}
			
			$epts=0;
			if($pl2 == 1){
				$epts=$pt1;
			} elseif ($pl2 < 6){
				$epts = $pt1 - ($pl2 -1)* 2 -1;
			} elseif ($pl2 >=6){
				$epts = $pt1 - $pl2  -4;
			}
			
			$pt = $epts>0 ? $epts : 0;
			
			echo "<tr>";
			echo "<td><b>",$row[pf_rm_sport_nr],"</b>"; $resutltToStore[$index][SportNr] = $row[pf_rm_sport_nr];
			echo "<td>",$row[pf_rm_f_name]; $resutltToStore[$index][FName] = $row[pf_rm_f_name];
			echo " ",$row[pf_rm_l_name]; $resutltToStore[$index][LName] = $row[pf_rm_l_name];
			echo "<td>",$row[club_name]; $resutltToStore[$index][ClubName] = $row[club_name];
			
			echo "<td>",$valsts[$row[pf_rm_country]]; $resutltToStore[$index][CountryName] = $valsts[$row[pf_rm_country]];
			
			$resutltToStore[$index][DQ_LK0K] = $row[DQ_LK0K];
			$resutltToStore[$index][DQ_LK] = $row[DQ_LK];
			
			$resutltToStore[$index][LK0K] = $row[lk0k];
			$resutltToStore[$index][LK] = $row[lk];
			
			echo "<td ",$row[DQ_LK0K] ? "style=\"background-color:pink\"" : "",">",substr($row[lk0k],0,2) != "00" ? $row[lk0k] : substr($row[lk0k],3,20); 
			echo "<td ",$row[DQ_LK] ? "style=\"background-color:pink\"" : "",">",substr($row[lk],0,2) != "00" ? $row[lk] : substr($row[lk],3,20); 

			$DQ = $row[DQ_LK0K] || $row[DQ_LK] || $row[DQ_IZS]; $resutltToStore[$index][DQ] = $DQ;
			
			$resutltToStore[$index][DQ_DQ] = $row[DQ_DQ];
			if($row[DQ_DQ]){$DQ3 = 1;} $resutltToStore[$index][DQ3] = $DQ3;
			$resutltToStore[$index][Result] = array();
			$resutltToStore[$index][SecPart] = array();
			for($i=0;$i<count($et);$i++){
				for($j=0;$j<$cl[0]->ENDURO_LAPS;$j++){
					
					$sql = "select * 
							from `enduro_test_ignore` 
							where `erd_id` = ".$_SESSION['params']['day']." 
							and `test_id` = ".$et[$i]->ET_ID." 
							and `class_id` = ".$row[CLASS_ID]."
							and `lap` = ".($j+1);
					$r1 = queryDB($sql);					
					if (mysql_num_rows($r1)!=0){continue;}
					
					$sql = "
						select * 
						from `enduro_test_result`
						where 
							`EDR_ID` = ".$row[edr_id]." and 
							`TASK` = ".$et[$i]->ET_ID ." and
							`LAP` = ".($j+1);
					$r1 = queryDB($sql);
					if($row1 = mysql_fetch_array($r1, MYSQL_ASSOC)){
						if ($row1[RESULT] != "00:00:00"){						
							echo "<td align=\"right\">",substr($row1[RESULT],0,2) != "00" ? $row1[RESULT] : substr($row1[RESULT],3,20) ,".",$row1[SEC_PARTS] < 10 ?  0 : "",$row1[SEC_PARTS];
							array_push(
								$resutltToStore[$index][Result],
								(
									(substr($row1[RESULT],0,2) != "00" ? $row1[RESULT] : substr($row1[RESULT],3,20)) .".".
									($row1[SEC_PARTS] < 10 ?  0 : "").$row1[SEC_PARTS]
								)
							)
							;
						}else {
							$sql = "
								select * 
								from `enduro_test_ignore`
								where 
									`ERD_ID` = ".$_SESSION['params']['day']." 
									and `test_id` = ".$et[$i]->ET_ID ." 
									and `class_id` = ".$row[CLASS_ID]."
									and `LAP` = ".($j+1);
							$r1 = queryDB($sql);
							if($row2 = mysql_fetch_array($r1, MYSQL_ASSOC)){
								echo "<td>",$row1[RESULT];
								array_push($resutltToStore[$index][Result],$row1[RESULT]);
							} else {
								echo "<td style=\"background-color:pink\">&nbsp";
								array_push($resutltToStore[$index][Result],"");
								$DQ2 = 1; $resutltToStore[$index][DQ2] = $DQ2;
							}
						}
					} else {
						echo "<td style=\"background-color:pink\">&nbsp";
						$DQ2 = 1; $resutltToStore[$index][DQ2] = $DQ2;						
					}
				}				
			}
			$secparts =  $row[secparts] % 100 ; 
			$resutltToStore[$index][Secparts] = $secparts;
			$resutltToStore[$index][tim] = ($row[tim] ?  (
													(substr($row[tim],0,2) != "00" ? $row[tim] : (
														substr($row[tim],3,20)
													)). "." .( $secparts < 10 ? 0 : "").$secparts													
												) : "");			
			
			echo "<td style=\"font-weight:bold",($DQ || $DQ3) ? ";background-color:pink" : "","\" align=\"right\">",
				$DQ3 ? "<i>DQ</i>" :
				(
					$DQ ? "<i>Izstājies</i>" : (
												$row[tim] ?  (
													(substr($row[tim],0,2) != "00" ? $row[tim] : (
														substr($row[tim],3,20)
													)). "." .( $secparts < 10 ? 0 : "").$secparts													
												) : ""
											)
				);							
			echo "<td align=\"center\">",($DQ || $DQ2 || $DQ3) ? "&nbsp" : $pt;		$resutltToStore[$index][pt]	= ($DQ || $DQ2 || $DQ3) ? 0 : $pt;
			$resutltToStore[$index][edr_id]	= $row[edr_id];
			$resutltToStore[$index][sec100]	= $row[sec100];
			$resutltToStore[$index][user_id] = $row[user_id];

			$rc = $row[user_id];
		}	
		
		$index++;
	}
	echo "</table><hr>";
	
	echo '  <form method="post">		
				<input type="hidden" name = "rm_func" value = "reslt">
				<input type="hidden" name = "rm_subf" value = "publishDayResultSave">
				<input type="hidden" name = "day" value="'.$day.'">
				<input type = "text" name = "Info">
				<input type = "submit" value = "'.ORG_SAVE_RESULT.'">
			</form><hr>
	';
	
	$_SESSION[resutltToStore][$day] = $resutltToStore;
	
}
	?>