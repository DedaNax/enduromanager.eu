<?php
	function printEnduroResultMenu(){
		$rm =new raceManager;
		$cm = new champManager;
		$em = new EnduroManager;
		
		
		$cmps  = $cm->getChamps("","","",$_SESSION['params']['type']);
		$cmp = $cmps[0];
		
		echo "Čempionāts: ";
			echo "<select onchange=\"window.location = this.options[this.selectedIndex].value;\">";
				for($i=0;$i<count($cmps);$i++){
					echo "<option value=\"?rm_func=reslt&rm_subf=enduromenu&cmp=",$cmps[$i]->getID(),"\"";
						if($_SESSION['params']['cmp']==$cmps[$i]->getID()){
							$cmp = $cmps[$i];
							echo " selected ";
						}
					echo ">",$cmps[$i]->year," - ",$cmps[$i]->getName(),"</option>";
				}
			echo "</select>";
		echo "<hr>";
				
		$r = $rm->getRace("",$cmp->getID(),"","","","","");
		
		$i =0;
		while ($r[$i]){
			echo "<b><font style= \"color: blue;font-size: 17px;\">",$r[$i]->getName(),"</font></b><br>";
			
			if (strpos($cmp->getName(), 'Country') == false){
				$days = $em->getERD($r[$i]->getID());				
				
				for($j=0;$j<count($days);$j++){					
					$publishID = 0;
					$info = "";
					$day = $days[$j]->ERD_ID;
					$sql = 
					   "SELECT b.`PublishId` , b.`Info` , b.`PublisherName` 
						FROM (
							SELECT MAX(  `PublishId` ) AS PublishId
							FROM  `enduro_results` 
							WHERE  `RaceDayID` = $day
						)a
							INNER JOIN  `enduro_results` b ON a.`PublishId` = b.`PublishId` 
						LIMIT 0 , 1";
					
					$dayRes = queryDB($sql);
					while($rslt = mysql_fetch_array($dayRes, MYSQL_ASSOC)){
						$publishID =$rslt[PublishId];
						$info =$rslt[Info];
					}
					if ($publishID) echo "<a style=\"font-weight: bold;\" href=\"?rm_func=reslt&rm_subf=endurodaysaved&publishID=$publishID\">";
						echo DateTimeString($days[$j]->START_DATE);						
						if ($publishID) echo " ",$info;						
					if ($publishID) echo "</a>";
					
					if ($publishID) {
						echo "<a href=\"?rm_func=reslt&rm_subf=endurodaysaved&publishID=$publishID&no_gui=1\" target=\"_blank\">";
							echo "<font style=\"font-size:15px\">^</font>";
						echo "</a>";
					}
					
					if($j<count($days)-1){
						if (strpos($cmp->getName(), 'Sprint') == false){
							echo " | ";
						}					
					}
				}				
				echo "<br>";
				if (strpos($cmp->getName(), 'Sprint') == false){
					echo "<a href=\"?rm_func=reslt&rm_subf=endurorace&r=",$r[$i]->getID(),"\">";
						echo "sacensības gala rezultāti";
					echo "</a>";
					echo "<a target=\"_blank\" href=\"?rm_func=reslt&rm_subf=endurorace&no_gui=1&r=",$r[$i]->getID(),"\">";
						echo "<font style=\"font-size:15px\">^</font>";
					echo "</a>";			
					echo "| <a href=\"?rm_func=reslt&rm_subf=enduroAbs&r=",$r[$i]->getID(),"\">";
						echo "Absolūtais vertējums";
					echo "</a>";
					echo "<a target=\"_blank\" href=\"?rm_func=reslt&rm_subf=enduroAbs&no_gui=1&r=",$r[$i]->getID(),"\">";
						echo "<font style=\"font-size:15px\">^</font>";
					echo "</a>";
					echo "<br>";
				}
				 echo "<a href=\"?rm_func=reslt&rm_subf=clubTeams&r=",$r[$i]->getID(),"\">";
					 echo "Klubu komandas";
				 echo "</a>";
				 
				 echo "<a target=\"_blank\" href=\"?rm_func=reslt&rm_subf=clubTeams&no_gui=1&r=",$r[$i]->getID(),"\">";
					 echo "<font style=\"font-size:15px\">^</font>";
				 echo "</a>";
				if (strpos($cmp->getName(), 'Sprint') == false){
					echo " | ";
					echo "<a href=\"?rm_func=reslt&rm_subf=constrTeams&r=",$r[$i]->getID(),"\">";
						echo "Ražotāju komandas";
					echo "</a>";
					echo "<a target=\"_blank\" href=\"?rm_func=reslt&rm_subf=constrTeams&no_gui=1&r=",$r[$i]->getID(),"\">";
						echo "<font style=\"font-size:15px\">^</font>";
					echo "</a>";
				}
				echo "<br>";
			}
			if ($r[$i]->exresLink){
				echo '<a target="_blank" href="',$r[$i]->exresLink,'"> Sacensības rezultāti</a>';				
			}
			$i++;			
			if ($i<>0){echo "<hr>";}
		}
	}	
	
	function printresult1(){
		$rm =new raceManager;
		$cm = new champManager;
		$em = new EnduroManager;
		
		$day=$_SESSION['params']['day'];
		$erd = $em->getERD1($day);
		$r = $rm->getRace($erd[0]->RACE_ID,"","","","","","","");
		
		
		echo "<a href=\"?rm_func=reslt&rm_subf=enduromenu\"><b>Rezultāti</b></a>";
		echo " -> <b>",$r[0]->getName(),"</b>";
		echo " -> <b>",substr($erd[0]->START_DATE,0,10),"</b>";
		
		echo "<hr>";
		
		$sql = "
			update `enduro_day_racer`
				set `points` = 0
			where `erd_id` = ".$_SESSION['params']['day'];
		queryDB($sql);
		
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
	
	while($row = mysql_fetch_array($r, MYSQL_ASSOC)){
		
		$DQ = 0;		
		$DQ2 = 0;	
		$DQ3 = 0;
	
		if($row[CLASS_ID] != $class_id) {
			$pl1=0;
			$pl2=1;		
			$pt = 20;			
			$tmp = -1;
			$cl = $em->getERCD("",$_SESSION['params']['day'],$row[CLASS_ID] );
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
							
							echo "<td>",$et[$i]->NAME, $j+1;
						}						
					}
					echo "<td>Laiks kopā";
					echo "<td>Ieskaites punkti";
			$class_id = $row[CLASS_ID];	
		}
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
			echo "<td><b>",$row[pf_rm_sport_nr],"</b>";
			echo "<td>",$row[pf_rm_f_name];
			echo " ",$row[pf_rm_l_name];
			echo "<td>",$row[club_name];
			echo "<td>",$valsts[$row[pf_rm_country]];
			echo "<td ",$row[DQ_LK0K] ? "style=\"background-color:pink\"" : "",">",substr($row[lk0k],0,2) != "00" ? $row[lk0k] : substr($row[lk0k],3,20);
			echo "<td ",$row[DQ_LK] ? "style=\"background-color:pink\"" : "",">",substr($row[lk],0,2) != "00" ? $row[lk] : substr($row[lk],3,20);

			if($row[DQ_LK0K] || $row[DQ_LK] || $row[DQ_IZS]){
				$DQ = 1;				
			}
			
			if($row[DQ_DQ]){$DQ3 = 1;}
			
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
							} else {
								echo "<td style=\"background-color:pink\">&nbsp";
								$DQ2 = 1;
							}
						}
					} else {
						echo "<td style=\"background-color:pink\">&nbsp";
						$DQ2 = 1;
					}	
				}						
			}
			$secparts =  $row[secparts] % 100 ;
			
			
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
			echo "<td align=\"center\">",($DQ || $DQ2 || $DQ3) ? "&nbsp" : $pt;			
			if(!$DQ && !$DQ2 && !$DQ3){
				$sql = "
					update `enduro_day_racer`
						set 
							`points` = $pt,
							`sec100` = ".$row["sec100"]."
					where `edr_id` = ".$row[edr_id];
				queryDB($sql);
			}
			$rc = $row[user_id];
		}		
	}
	echo "</table>";
	
}

	function printresult2(){
		$rm =new raceManager;
		$cm = new champManager;
		$em = new EnduroManager;
		
		$rc = $rm->getRace($_SESSION['params']['r'],"","","","","","","");
				
		echo "<a href=\"?rm_func=reslt&rm_subf=enduromenu\"><b>Rezultāti</b></a>";
		echo " -> <b>",$rc[0]->getName(),"</b>";		
		
		echo "<hr>";
		
		$days = $em->getERD($rc[0]->getID());
		
		
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
			SELECT * , club.name as club_name,sum(edr.`points`) as resl
			FROM `enduro_day_racer` edr				
				inner join `enduro_application` ea on (ea.`era_id` = edr.`ea_id`)
					inner join `d_class` cl on (cl.`classid` = ea.`class_id`)
					inner join `phpbb_profile_fields_data` u on (u.`user_id` = ea.`racer_id`)
					left join `c_club` club on (club.`ID` = u.`pf_rm_club`)
					left join (
						SELECT `racer_id`,`points`
						FROM `enduro_day_racer` edr	
							inner join `enduro_race_day` erd on (
								erd.`erd_id` = edr.`erd_id` and 
								erd.`start_date` = (select max(`start_date`) from `enduro_race_day` where `race_id` = ".$_SESSION['params']['r'].")
							)			
							inner join `enduro_application` ea on (ea.`era_id` = edr.`ea_id`)
						where ea.`race_id` = ".$_SESSION['params']['r']."
					) maxpts on (maxpts.`racer_id` = ea.`racer_id`)
			group by ea.`racer_id`,ea.`race_id`
			having ea.`race_id` = ".$_SESSION['params']['r']."
			order by cl.`weight` asc,resl desc ,maxpts.`points` desc
		";
		//echo $sql;
		$r = queryDB($sql);
		$i=0;
		while($row = mysql_fetch_array($r, MYSQL_ASSOC)){
			if($row[CLASS_ID] != $class_id) {			
				$i=1;
				echo "</table>";
				echo "<br><b style=\"font-size:16px\">",$row[Name],"</b><br>";
				echo "<table border =\"1\">";
					echo "<tr style=\"font-weight:bold\">";
						echo "<td>Num";
						echo "<td width=\"150\">Sportists";
						echo "<td width=\"150\">Klubs";
						echo "<td width=\"100\">Valsts";
						
						for($j=0;$j<count($days);$j++){
							echo "<td>",substr($days[$j]->START_DATE,0,10);
						}						
						
						echo "<td>Ieskaites punkti";
						echo "<td>Vieta";
				$class_id = $row[CLASS_ID];	
			}
			if($rc!=$row[user_id]){
				
				echo "<tr>";
				echo "<td><b>",$row[pf_rm_sport_nr],"</b>";
				echo "<td>",$row[pf_rm_f_name];
				echo " ",$row[pf_rm_l_name];
				echo "<td>",$row[club_name];
				echo "<td>",$valsts[$row[pf_rm_country]];
				
				for($j=0;$j<count($days);$j++){
					$sql = "
						select `points` 
						from `enduro_day_racer`
						where 
							`erd_id` = ".$days[$j]->ERD_ID." and
							`ea_id` in (select `era_id` from `enduro_application` where `racer_id` = ".$row[RACER_ID].")
					";
					//echo $sql;
					$r1 = queryDB($sql);
					$row1 = mysql_fetch_array($r1, MYSQL_ASSOC);
					
					echo "<td>",$row1[points];
				}
				
				echo "<td style=\"font-weight:bold\" >", $row[resl];
				echo "<td>",$i++;
				$rc = $row[user_id];
			}
		}
		echo "</table>";
	}
	
	function enduroAbs(){
		$rm =new raceManager;
		$cm = new champManager;
		$em = new EnduroManager;
		
		$r = $rm->getRace($_SESSION['params']['r'],"","","","","","","");
		
		echo "<a href=\"?rm_func=reslt&rm_subf=enduromenu\"><b>Rezultāti</b></a>";
		echo " -> <b>",$r[0]->getName(),"</b>";
		echo "<h1 align=\"center\" style=\"font-size:20px\">Absolūtais vērtējums</h1><hr>";
		
		$sql = "
			SELECT 
				c.`name` as clasname, 
				edr.erd_id as ERD_ID, 
				club.`name` as _club, 
				moto.`lang_value` as _moto,
				pd.`pf_rm_sport_nr`,
				pd.`pf_rm_f_name`,
				pd.`pf_rm_l_name`,
				edr.`points`,
				edr.`sec100`,
				sec_to_time((edr.`sec100` div 100)) as tim,
				sec_to_time((res.`pts` div 100)) as tim2,
				res.`pts`,
				res.`pts2`,
				ea.`era_id`
			FROM `enduro_application` ea
				inner join `phpbb_profile_fields_data` pd on (pd.`user_id` = ea.`racer_id`)
					left join `c_club` club on (club.`ID` = pd.`pf_rm_club`)
					inner join `phpbb_profile_fields_lang` moto on (moto.`option_id`+1 = pd.`pf_rm_moto_name` and moto.field_id = ".KL_MOTO." )
				inner join `d_class` c on (ea.`class_id` = c.`classid`)
				inner join `enduro_day_racer` edr on ea.`era_id` = edr.`ea_id`
				inner join (
					SELECT ea1.`era_id` as ea_id, sum(edr1.`sec100`) as pts,sum(if(edr1.`sec100` < 100,9999999,edr1.`sec100`)) as pts2
					FROM `enduro_application` ea1
						inner join `d_class` c1 on (ea1.`class_id` = c1.`classid`)
						inner join `enduro_day_racer` edr1 on ea1.`era_id` = edr1.`ea_id`
					GROUP BY ea1.`era_id`
				)res on (res.`ea_id` = ea.`era_id`)
			WHERE ea.`race_id` = ".$r[0]->ID." and ea.`class_id` in (".ENDURO_ABS_CLASES.")
			ORDER BY res.pts2 asc, c.`weight` asc,ea.`era_id` asc, edr.`erd_id` asc;";
			//echo $sql;
		$r = queryDB($sql);
		$eaid = 0;
		if($r){
			echo "<table border=\"1\" style=\"border-collapse:collapse\">";
				echo "<tr style=\"font-weight:bold\">";
					echo "<td width=\"20px\">Nr";
					echo "<td width=\"150px\">Vārds Uzvārds";
					echo "<td width=\"50px\">Klase";
					echo "<td width=\"180px\">Klubs";
					echo "<td width=\"80px\">Tehnika";
					echo "<td width=\"50px\">1. diena";
					echo "<td width=\"50px\">2. diena";
					echo "<td width=\"50px\">Kopā";
					echo "<td width=\"50px\" align=\"center\">Vieta";
		}
		$vieta = 1;
		while($row = mysql_fetch_array($r, MYSQL_ASSOC)){
			if($eaid <> $row["era_id"]){
				echo "<tr>";
					echo "<td>",$row["pf_rm_sport_nr"];
					echo "<td>",$row["pf_rm_f_name"]," ",$row["pf_rm_l_name"];
					echo "<td>",$row["clasname"];
					echo "<td>",$row["_club"];
					echo "<td>",$row["_moto"];
					echo "<td align=\"center\" ";
						if($row["sec100"]==0){
							echo "style=\"background-color:pink\"";
						}
					echo ">",substr($row["tim"],0,2) == "00" ? substr($row["tim"],3,20): $row["tim"],"<b>.</b>",( $row["sec100"] % 100) <10 ? "0".( $row["sec100"] % 100) : ( $row["sec100"] % 100);
				$eaid = $row["era_id"];
			} else {
					echo "<td align=\"center\"";
						if($row["sec100"]==0){
							echo "style=\"background-color:pink\"";
						}
					echo ">",substr($row["tim"],0,2) == "00" ? substr($row["tim"],3,20): $row["tim"],"<b>.</b>",( $row["sec100"] % 100) <10 ? "0".( $row["sec100"] % 100) : ( $row["sec100"] % 100);
					echo "<td align=\"center\">",substr($row["tim2"],0,2) == "00" ? substr($row["tim2"],3,20): $row["tim2"],"<b>.</b>",( $row["pts"] % 100) <10 ? "0".( $row["pts"] % 100) : ( $row["pts"] % 100);
					echo "<td align=\"center\">";
					switch($vieta){
						case 1:
							echo "<b style=\"font-size:15px\">I</b>";
							break;
						case 2:
							echo "<b style=\"font-size:15px\">II</b>";
							break;
						case 3:
							echo "<b style=\"font-size:15px\">III</b>";
							break;
						default:
							echo $vieta;
							break;
					}
					$vieta++;
			}
		}
		if($r){echo "</table>";}
		
	}
	
	function constrTeams(){	
		$rm =new raceManager;
		$cm = new champManager;
		$em = new EnduroManager;
		
		$sql = "
			update `enduro_day_racer`
				set 
					`abs_points` = 0,
					`abs_place` = 0
			where `erd_id` in (select `erd_id` from `enduro_race_day` where `race_id` = ".$_SESSION['params']['r'].")" ;
			
		queryDB($sql);
		
		$sql = "
			SELECT 				
				c.`name` as clasname,				
				edr.`edr_id`,
				edr.`erd_id`,
				edr.`sec100` as tim,				
				sec_to_time((edr.`sec100` div 100)) as sec,
				edr.`DQ` as DQ,
				edr.`IZS` as IZS,
				edr.`ABS_PoINTS`	
				
			FROM `enduro_application` ea
			 
					left join `enduro_day_racer` edr on ea.`era_id` = edr.`ea_id`
					
				 
				inner join `d_class` c on (ea.`class_id` = c.`classid`)				
			WHERE 
				ea.`race_id` = ".$_SESSION['params']['r']." 
				and ea.`class_id` in (".ENDURO_ABS_CLASES.")
			ORDER BY edr.`erd_id`,(edr.`sec100` + edr.`IZS` * 9999999 +  edr.`DQ` * 9999999)
			
			" ;
			
		$r = queryDB($sql);
		$places = mysql_num_rows($r) / 2;
		$p = 1;
		$erd = 0;
		while($row = mysql_fetch_array($r, MYSQL_ASSOC)){
			if ($erd!=$row['erd_id']){
				$p=1;
				$erd = $row['erd_id'];
			};
			$abspts = $places - $p;
			if ($row['DQ'] == 1 || $row['IZS'] == 1){$abspts = 0;}
			
			$sql = "
				update `enduro_day_racer`
				set 
					`abs_points` = $abspts,
					`abs_place` = $p
				where `edr_id` = ".$row['edr_id'];
			queryDB($sql);
			$p++;
		}
				
		$race = $rm->getRace($_SESSION['params']['r'],"","","","","","","");
		
		echo "<a href=\"?rm_func=reslt&rm_subf=enduromenu\"><b>Rezultāti</b></a>";
		echo " -> <b>",$race[0]->getName(),"</b>";
		echo "<h1 align=\"center\" style=\"font-size:20px\">Ražotāju komandas</h1><hr>";
		
		$sql = "			
			SELECT 				
				c.`name` as clasname,				
				fl.`lang_value` as motoname,
				fd.`pf_rm_l_name`,
				fd.`pf_rm_f_name`,
				fd.`pf_rm_sport_nr`,
				
				edr1.`ABS_PLACE` as place1,
				edr1.`DQ` as DQ1,
				edr1.`IZS` as IZS1,
				edr1.`ABS_PoINTS` as points1,
				
				edr2.`ABS_PLACE` as place2,	
				edr2.`DQ` as DQ2,
				edr2.`IZS` as IZS2,
				edr2.`ABS_PoINTS` as points2,
				
				edr1.`ABS_PoINTS` + edr2.`ABS_PoINTS` summ	
			FROM `enduro_application` ea
				inner join (
					select erd.`erd_id`
					from `enduro_race_day` erd
					where erd.`race_id` = ".$_SESSION['params']['r']."
					order by `start_date` asc
					limit 1
				) erd1 
					left join `enduro_day_racer` edr1 on edr1.`erd_id` = erd1.`erd_id` and ea.`era_id` = edr1.`ea_id`
					left join `enduro_day_racer` edr2 on ea.`era_id` = edr2.`ea_id` and edr1.`edr_id` <> edr2.`edr_id`
				 
				inner join `d_class` c on (ea.`class_id` = c.`classid`)			

				inner join `phpbb_profile_fields_data` fd on (ea.`racer_id` = fd.`user_id`)
				left join `phpbb_profile_fields_lang` fl on (fl.`option_id`+1 = fd.`pf_rm_moto_name` and `field_id` = ".KL_MOTO.")
			WHERE 
				ea.`race_id` = ".$_SESSION['params']['r']." 
				and ea.`class_id` in (".ENDURO_ABS_CLASES.")
			ORDER BY edr1.`ABS_PoINTS` + edr2.`ABS_PoINTS` desc
		";
		
		$r = queryDB($sql);
		echo "<table border =\"1\" style=\"border-collapse: collapse\">";
			echo "<tr style=\"font-weight:bold\">";
				echo"<td>NR<TD>Sportists<Td>Tehnika<td>1. diena vieta<td>1. diena punkti<td>2. diena vieta<td>2.diena punkti<td>Punkti kopā";
			while($row = mysql_fetch_array($r, MYSQL_ASSOC)){
				echo "<tr>";
					echo "<td>",$row['pf_rm_sport_nr'];
					echo "<td>",$row['pf_rm_f_name']," ",$row['pf_rm_l_name'] ;
					echo "<td>",$row['motoname'];
					echo "<td>",$row['place1'];
					echo "<td>",$row['points1'];
					if ($row['DQ1']){echo " - DQ";}
					if ($row['IZS1']){echo " - Izstājies";}
					echo "<td>",$row['place2'];
					echo "<td>",$row['points2'];
					if ($row['DQ2']){echo " - DQ";}
					if ($row['IZS2']){echo " - Izstājies";}
					echo "<td>",$row['summ'];
			}
		echo "</table>";
		
		echo "<hr>";
		
		echo "";
		$sql = "		
			set @mrank :=0, @curr1 :=0;	";
		queryDB($sql);
		$sql = "					

			select 

				fl.`lang_value`,

				sum(y.`pts`) as pts,
				sum(y.`day1`) as day1,
				sum(y.`day2`) as day2
			FROM `enduro_application` ea
				inner join `phpbb_profile_fields_data` fd on (ea.`racer_id` = fd.`user_id`)
					left join `phpbb_profile_fields_lang` fl on (fl.`option_id`+1 = fd.`pf_rm_moto_name` and fl.`field_id` = ".KL_MOTO.")
				
				inner join 
					(	
					

						select 
							x.`pts`,
							x.`day1`,
							x.`day2`,
							x.`option_id` ,
							x.`mrankk`,
							x.`lang_value`,
							x.`era_id`
						from (
						
							select 
								z.`option_id`,
								z.`pts`,
								z.`day1`,
								z.`day2`,
								z.`lang_value`,
								z.`era_id`,
								@mrank := IF(@curr1 = z.`option_id`, @mrank +1, 1) AS mrankk,
								@curr1:= z.`option_id`  
							from (
								select 					
									
									fl1.`option_id`,
									edr1.`ABS_POINTS` + edr2.`ABS_POINTS` as pts,
									edr2.`ABS_POINTS` as day2,
									edr1.`ABS_POINTS` as day1,
									fl1.`lang_value`,
									ea1.`era_id`
								from `enduro_application` ea1
									inner join `phpbb_profile_fields_data` fd1 on (ea1.`racer_id` = fd1.`user_id`)
									left join `phpbb_profile_fields_lang` fl1 on (fl1.`option_id`+1 = fd1.`pf_rm_moto_name` and fl1.`field_id` = 32)
									inner join (
										select erd.`erd_id`
										from `enduro_race_day` erd
										where erd.`race_id` = ".$_SESSION['params']['r']." 
										order by `start_date` asc
										limit 1
									) erd1 
										left join `enduro_day_racer` edr1 on edr1.`erd_id` = erd1.`erd_id` and ea1.`era_id` = edr1.`ea_id`
										left join `enduro_day_racer` edr2 on ea1.`era_id` = edr2.`ea_id` and edr1.`edr_id` <> edr2.`edr_id`
								where ea1.`race_id` = ".$_SESSION['params']['r']." 
								order by fd1.`pf_rm_moto_name` asc,edr1.`ABS_POINTS` + edr2.`ABS_POINTS` desc
							) z 			
							
						) x where x.mrankk <= 3
					) y on y.`era_id` = ea.`era_id`
				
			WHERE 
				ea.`race_id` = ".$_SESSION['params']['r']." 
				and ea.`class_id` in (".ENDURO_ABS_CLASES.")
			GROUP BY 
				fl.`lang_value`
			ORDER BY sum(y.`pts`) desc
		";
		//echo $sql;
		$r = queryDB($sql);
		echo "<table border =\"1\" style=\"border-collapse: collapse\">";
			echo "<tr style=\"font-weight:bold\">";
				echo"<td>Tehnika<TD>1. diena<td>2. diena<td>Punkti kopā";
			
			while($row = mysql_fetch_array($r, MYSQL_ASSOC)){
				echo "<tr>";
					echo "<td>",$row['lang_value'];
					echo "<td>",$row['day1'];
					echo "<td>",$row['day2'];
					echo "<td>",$row['pts'];
			}
	
		echo "</table>";
	}

	function clubTeams(){
		$topRacers = 3;
		$rm =new raceManager;		
		$race = $rm->getRace($_SESSION['params']['r'],"","","","","","","");
		
		echo "<a href=\"?rm_func=reslt&rm_subf=enduromenu\"><b>Rezultāti</b></a>";
		echo " -> <b>",$race[0]->getName(),"</b>";
		echo "<h1 align=\"center\" style=\"font-size:20px\">Klubu komandas</h1><hr>";
	
		$sql="
			SELECT 
				CASE 
					WHEN ea.`class_id` IN ( 11, 27, 13, 64, 67, 80, 79 ) THEN edr.`POINTS` * 0.5
					WHEN ea.`class_id` IN ( 12, 28 ) THEN edr.`POINTS` * 0.35
					ELSE edr.`POINTS` * 1 
				END AS PTS, 
				ea.`ERA_ID` , 
				ea.`CLASS_ID` , 
				ea.`racer_id`,
				ea.`team_c`,
				pd.`pf_rm_f_name` , 
				pd.`pf_rm_l_name`, 
				pd.`pf_rm_sport_nr`, 
				cl.`name` AS cl_name,
				et.`name` AS team_name, 
				et.`ET_ID`,
				eday.`START_DATE`,
				eday.`ERD_ID`
			FROM  `enduro_day_racer` edr
				INNER JOIN  `enduro_application` ea ON ( edr.`ea_id` = ea.`era_id` AND ea.`team_c` > 0 ) 
					INNER JOIN  `enduro_team` et ON (et.`ET_ID` = ea.`team_c`)	
					INNER JOIN  `phpbb_profile_fields_data` pd ON ( pd.`user_id` = ea.`racer_id`) 
					INNER JOIN  `d_class` cl ON ( cl.`classid` = ea.`CLASS_ID` ) 
				INNER JOIN `enduro_race_day` eday ON (eday.`ERD_ID` = edr.`ERD_ID`)
			WHERE ea.`race_id` = ".$race[0]->ID."
			ORDER BY
				ea.`team_c`,
				eday.`START_DATE` ASC,
				PTS DESC";
		$r = queryDB($sql);
		
		$days = array();
		$racers = array();
		$results = array();		
		$pRow = null;
		$rcrCntr = 0;
		while($row = mysql_fetch_array($r, MYSQL_ASSOC)){
			if( $row[ERD_ID] != $pRow[ERD_ID] || $row[team_c] != $pRow[team_c] ){
				$rcrCntr = 0;
			}
			
			$days[$row[ERD_ID]] = $row[START_DATE];
			
			$results[$row[team_c]][name] = $row[team_name];
			$results[$row[team_c]][$row[ERD_ID]];
			
			$racers[$row[racer_id]][name] = $row[pf_rm_f_name] . " " . $row[pf_rm_l_name];
			$racers[$row[racer_id]][nr] = $row[pf_rm_sport_nr];
			$racers[$row[racer_id]][cl_name] = $row[cl_name];
			
			$results[$row[team_c]][racers][$row[racer_id]][$row[ERD_ID]][pts] = $row[PTS];
			$incl = 1;
			if($rcrCntr >= $topRacers || $row[PTS] == 0){
				$incl = 0;				
			}
			$results[$row[team_c]][racers][$row[racer_id]][$row[ERD_ID]][incl] = $incl;
			
			$results[$row[team_c]][race_total] += $row[PTS] * $incl;
			$results[$row[team_c]][$row[ERD_ID]][day_total] += $row[PTS] * $incl;	
			
			$pRow = $row;
			$rcrCntr++;
		}
		
		$results = array_sort($results, 'race_total', SORT_DESC);
		
		foreach($results as $tkey => $tvalue)
		{
			echo '<p><table style ="width: ',260+count($days)*50,'px;" border="1">';
				echo '<tr><td colspan="',3+count($days),'" style="    text-align: center;font-size: 16px;font-weight: bold;">',$tvalue[name];
				echo '<tr style="font-weight: bold;"><td style="width:150px">Sportists<td style="width:30px">NR<td style="width:80px">Klase';
				foreach($days as $dkey => $dvalue){
					echo '<td style="width:50px">',DateString($dvalue);
				}
				
				foreach($tvalue[racers] as $rkey => $rvalue){
					echo '<tr><td>',$racers[$rkey][name],'<td>',$racers[$rkey][nr],'<td>',$racers[$rkey][cl_name];
					foreach($days as $dkey => $dvalue){
						echo '<td ';
						if ($rvalue[$dkey][incl]){
							echo 'style="background-color:#FFFF99;text-align:center;"';
						} else {
							echo 'style="text-align:center;"';
						}
						echo '>',$rvalue[$dkey][pts]+0;
					}
				};
				
				if (count($days) > 1){
					echo '<tr><td colspan = "3" style="text-align:right">Kopā dienā';
					foreach($days as $dkey => $dvalue){
						echo '<td style="text-align:center;font-weight: bold;">',$tvalue[$dkey][day_total];
					};
				}
				
				echo '<tr><td colspan = "3" style="text-align:right">Kopā<td colspan = "',count($days),'" style="text-align:center;font-weight: bold;">',$tvalue[race_total];
				
			echo "</table></p>";
		}		
		echo "<hr>";
	}	
?>