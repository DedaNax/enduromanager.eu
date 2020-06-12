<?php

function enduro_rudite(){
	echo printheader();
	
	$em = new EnduroManager;
	$rm = new raceManager;
	$cm = new champManager;
	
	$day = $_GET['day'];
	$erd = $em->getERD1($day);
	$opt = $erd[0]->RACE_ID;
	$race = $rm->getRace($opt,"","","","","","");
	$champ = $cm->getChamps($race[0]->getCH_ID(),"","","");
	
	echo "<h2 align=\"center\">";
		echo $champ[0]->getName(),", "; 
		echo $race[0]->getName(), ", ";
		echo substr($erd[0]->START_DATE,0,10);//$race[0]->getDate();
		echo "<br> STARTA LAIKI (KUSTĪBAS GRAFIKS)";
	echo "</h2>";
	
	$slot = $race[0]->slots;
	$cl = $em->getERCD($opt,$day,"");
	
	echo "<table  align=\"center\" border = \"0\">";				
		for($i=0;$i<count($cl);$i++){
			$cnt = $em->getEnduroDayRacerCNT($day,$cl[$i]->CLASS_ID);
			if ($cnt > 0){
				if(!$cl[$i]->SEPARATOR && $i!=0){
					echo "<tr>";
						echo "<td colspan=\"2\"><hr>";
				}
				echo "<tr>";
					echo "<td >";
						echo $cl[$i]->NAME;			
					echo "<td>";								
						echo "<table width=\"",$slot*130,"px\" border=\"1\" style=\"border-collapse: collapse;\">";
							echo "<tr>";
								echo str_repeat("<td width=\"30px\">NR<td width=\"50px\">LK0<td width=\"50px\">Laiks",$slot);
									for($j=0;$j<$cnt/$slot;$j++){
										echo "<tr>";
											for($x=0;$x<$slot;$x++){
											$rcr = $em->getEnduroDayFreeRacerList1($day,$cl[$i]->CLASS_ID,$j+1,$x+1);
												if($rcr[0]){
													echo "<td width=\"30px\">
														<font style=\"font-size:14px;font-weight:bold;\"", $rcr[0]->getNr() ? ">".$rcr[0]->getNr()."</font>" : " color=\"red\">NAV</font>";
														
														$lk0 = "`lk0`";
														if ($_GET['mode'] == 2 ){
															$lk0 = "sec_to_time(time_to_sec(`lk0`) - 300) as lk0";
														}
														
														$sql = "select $lk0 from `enduro_day_racer` 
																where `erd_id` = $day and `pair` = ". ($j+1) ."
																and `ea_id` in (select `era_id` from `enduro_application` where `class_id` = ".$cl[$i]->CLASS_ID.")";
														
														
														$r = queryDB($sql);
														$row = mysql_fetch_array($r, MYSQL_ASSOC);
														echo "<td>",substr($row["lk0"],0,5);
														echo "<td>&nbsp";
												} else {
													echo "<td>&nbsp</td>";
													echo "<td>&nbsp</td>";
													echo "<td>&nbsp</td>";
												}
											}											
										}
								
						echo "</table>";		
						
			}
			
			
		}
	echo "</table>";
	echo printfooter();
	
}

function enduro_start(){
	echo printheader();
	
	$em = new EnduroManager;
	$rm = new raceManager;
	$cm = new champManager;
	
	$day = $_GET['day'];
	$erd = $em->getERD1($day);	
	$opt = $erd[0]->RACE_ID;
	$race = $rm->getRace($opt,"","","","","","");
	$champ = $cm->getChamps($race[0]->getCH_ID(),"","","");	
	$stages = $em->getES($race[0]->getID());
	
	$slot = $race[0]->slots;
	
	echo "<h2 align=\"center\">";
		echo $champ[0]->getName(),", "; 
		echo $race[0]->getName(), ", ";
		echo substr($erd[0]->START_DATE,0,10);
		echo "<br> STARTA LAIKI (KUSTĪBAS GRAFIKS)";
	echo "</h2>";
	
	$cl = $em->getERCD($opt,$day,"");	
	echo "<table  align=\"center\" border = \"0\" >";
				
		for($i=0;$i<count($cl);$i++){
			$cnt = $em->getEnduroDayRacerCNT($day,$cl[$i]->CLASS_ID);
			if ($cnt > 0){
				if(!$cl[$i]->SEPARATOR && $i!=0){					
					echo "<tr>";
						echo "<td colspan=\"2\"><hr>";
				}
				echo "<tr>";
					echo "<td width=\"50\">";
						echo $cl[$i]->NAME;			
					echo "<td>";								
						echo "<table border=\"1\" style=\"border-collapse: collapse;\">";														
							echo "<tr align=\"center\">";
								$tstr="";
								$m=0;
								for($k=0;$k<$cl[$i]->ENDURO_LAPS;$k++){
									for($n=0;$n<count($stages);$n++){
										$stage = $em->getRCDS("",$cl[$i]->CLASS_ID,$stages[$n]->ES_ID,$cl[$i]->ERCD_ID);
											$tstr = "$tstr<td width=\"40\">";
												$tstr.= substr($stage[0]->OFFSET_TIME,0,5);
												$ofs = explode(":",$stage[0]->OFFSET_TIME);
												$m+=$ofs[1];
												$m+=$ofs[0]*60;
									}
								}
								if($cl[$i]->FIN_OFFSET){
									$ofs = explode(":",$cl[$i]->FIN_OFFSET);
									$m+=$ofs[1];
									$m+=$ofs[0]*60;
								}
								
								echo "<td width=\"",($slot * 30)+40,"\" colspan=\"",$slot+1,"\" align=\"center\">";
								$h= (int) floor($m/60);
								$m = $m-$h*60;
								
									echo ($h < 10 ? "0".$h : $h).":".($m < 10 ? "0".$m : $m),"$tstr";
								if($cl[$i]->FIN_OFFSET){
									echo "<td width=\"40\">";
										echo substr($cl[$i]->FIN_OFFSET,0,5);
								}
								
								echo "<tr align=\"center\">";
								echo "<td width=\"",$slot * 30,"\" colspan=\"$slot\" align=\"center\"><b>NR</b><td width=\"40\"><b>LK0</b>";
								for($j=0;$j<$cl[$i]->ENDURO_LAPS * count($stages);$j++){
									echo "<td width=\"40\"><b>LK",$j+1,"</b>";
								}
								if($cl[$i]->FIN_OFFSET){
									echo "<td width=\"40\"><b>PF</b>";
								}							
							for($j=0;$j<$cnt/$slot;$j++){
								echo "<tr align=\"center\">";
									
									for($x=0;$x<$slot;$x++){
										$rcr = $em->getEnduroDayFreeRacerList1($day,$cl[$i]->CLASS_ID,$j+1,$x+1);
										if($rcr[0]){
											echo "<td width=\"30\" align=\"center\">";
											echo "<font style=\"font-size:14px;font-weight:bold;\"", $rcr[0]->getNr() ? ">".$rcr[0]->getNr()."</font>" : " color=\"red\">NAV</font> ";
										} else {
											echo "<td width=\"30\" align=\"center\">";
											echo "&nbsp";													
										}
									}
									
									echo "<td width=\"40\" align=\"center\">";
										$sql = "select `lk0` from `enduro_day_racer` 
												where `erd_id` = $day and `pair` = ". ($j+1) ."
												and `ea_id` in (select `era_id` from `enduro_application` where `class_id` = ".$cl[$i]->CLASS_ID.")";
										
										
										$r = queryDB($sql);
										$row = mysql_fetch_array($r, MYSQL_ASSOC);
										echo substr($row["lk0"],0,5);
										
										$time = explode(":",$row["lk0"]);
										
										for($k=0;$k<$cl[$i]->ENDURO_LAPS;$k++){
											for($n=0;$n<count($stages);$n++){
												$stage = $em->getRCDS("",$cl[$i]->CLASS_ID,$stages[$n]->ES_ID,$cl[$i]->ERCD_ID);
												
												$ofs = explode(":",$stage[0]->OFFSET_TIME);
												
												$time[0] += $ofs[0];
												$time[1] += $ofs[1];
												$time[0] += $time[1] >= 60 ? 1 : 0;														
												$time[1] = $time[1] >= 60 ? $time[1] - 60 : $time[1];
												
												
												echo "<td width=\"40\">",$time[0]<10 ? "0".$time[0]: $time[0],":", $time[1]<10 ? "0".$time[1]: $time[1];
											}													
										}
										if($cl[$i]->FIN_OFFSET){
											$ofs = explode(":",$cl[$i]->FIN_OFFSET);
											
											$time[0] += $ofs[0];
											$time[1] += $ofs[1];
											$time[0] += $time[1] >= 60 ? 1 : 0;														
											$time[1] = $time[1] >= 60 ? $time[1] - 60 : $time[1];
											
											
											echo "<td width=\"40\">",$time[0]<10 ? "0".$time[0]: $time[0],":", $time[1]<10 ? "0".$time[1]: $time[1];
										}
							}
						echo "</table>";		
			}
		}
	echo "</table>";
	echo printfooter();
}

function enduro_kartina(){
	echo printheader();	
	
	$em = new EnduroManager;
	$rm = new raceManager;
	$cm = new champManager;
	
	$day = $_GET['day'];
	$erd = $em->getERD1($day);	
	$opt = $erd[0]->RACE_ID;
	$race = $rm->getRace($opt,"","","","","","");
	$champ = $cm->getChamps($race[0]->getCH_ID(),"","","");
	
	$slot = $race[0]->slots;
	
	$x = 0;
	$y = 0;
	$cl = $em->getERCD($opt,$day,"");
	
	for($i=0;$i<count($cl);$i++){
		$cnt = $em->getEnduroDayRacerCNT($day,$cl[$i]->CLASS_ID);			
			//echo "||| $cnt ||||";
		for($j=0;$j<$cnt/$slot;$j++){
			for ($l=0;$l<$slot;$l++){
				$rcr = $em->getEnduroDayFreeRacerList1($day,$cl[$i]->CLASS_ID,$j+1,$l+1);
				//print_r($rcr);
				for($k=0;$k<count($rcr);$k++){
					
					if($y==0){
						echo "<table border=\"1\" style=\"border:0 solid #000000; border-collapse:collapse;\" cellpadding=\"10\">";
					}
					if($x==0){
						echo "<tr style=\"\">";
					}
					
					echo "<td  width=\"390px\" align=\"center\" valign=\"middle\" ";
						if ($y==0 && $x==0){
							echo " style=\"border-bottom: 1px dashed #000000;border-right: 1px dashed #000000;border-top: 0px solid #000000;border-left: 0px solid #000000\"";
						} elseif ($y==1 && $x==1){
							echo " style=\"border-bottom: 1px dashed #000000;border-top: 0px dashed #000000;border-right: 1px dashed #000000\"";							
						} elseif ($y==2 && $x==2){
							echo " style=\"border-bottom: 1px dashed #000000;border-top: 0px solid #000000;border-right: 0px solid #000000\"";							
						} elseif ($y==3 && $x==0){
							echo " style=\"border-right: 1px dashed #000000;border-bottom: 0px solid #000000;border-left: 0px dashed #000000;border-top: 1px dashed #000000;\"";
						} elseif ($y==4 && $x==1){
							echo " style=\"border-right: 1px dashed #000000;border-bottom: 0px solid #000000;border-left: 1px dashed #000000;border-top: 1px dashed #000000;\"";
						} elseif ($y==5 && $x==2){
							echo " style=\"border-right: 0px solid #000000;border-bottom: 0px solid #000000\"";
						}
					echo ">";
					
					echo "<table border = \"1\" style=\"border-collapse:collapse\" width=\"370px\" >";
						
						echo "<tr height=\"15px\" align=\"center\" valign=\"middle\"><td colspan=\"2\" style=\"border: 0px solid #000000;\"> KONTROLES KARTE<td>",substr($erd[0]->START_DATE,0,10);
						echo "<tr height=\"15px\" align=\"center\"  valign=\"middle\">";
							echo "<td colspan=\"3\">","<b style=\"font-size:15px\">",$race[0]->getName(),"</b>"," <b style=\"border: 0px solid #000000;\"></b>";
						echo "<tr height=\"15px\" align=\"center\"  valign=\"middle\">";
							echo "<td>Numurs";
							echo "<td>Vārds Uzvārds";
							echo "<td>Klase";
						echo "<tr height=\"15px\" align=\"center\">";
							echo "<td> <b style=\"font-size:20px\">",$rcr[$k]->getNr(),"</b>";
							echo "<td>",$rcr[$k]->getFName()," ",$rcr[$k]->getLName();
							echo "<td><b>",$cl[$i]->NAME,"</b>";;
						
							
						echo "<tr height=\"20px\" align=\"L\"><td>LK.NR<td>Tiesn. atz (h)<td>Soda punkti";
						
						echo "<tr height=\"20px\" align=\"center\"><td>LK0<td>";
							$sql = "select `lk0` from `enduro_day_racer` 
									where `erd_id` = $day and
									      `ea_id` in (select `era_id` from `enduro_application` where `racer_id` = ".$rcr[$k]->getUserID()." and `race_id` = ".$race[0]->getID().")";
							$r = queryDB($sql);
							$row = mysql_fetch_array($r, MYSQL_ASSOC);
							echo substr($row["lk0"],0,5);
							echo "<td>";
						
						
						echo "<tr height=\"20px\" align=\"center\"><td >LK1<td ><td >";
						echo "<tr height=\"20px\" align=\"center\"><td>LK2<td><td>";
						echo "<tr height=\"20px\" align=\"center\"><td>LK3<td><td>";
						echo "<tr height=\"20px\" align=\"center\"><td>LK4<td><td>";
						echo "<tr height=\"20px\" align=\"center\"><td>LK5<td><td>";
						echo "<tr height=\"20px\" align=\"center\"><td>LK6<td><td>";
						echo "<tr height=\"20px\" align=\"center\"><td>LK7<td><td>";
						echo "<tr height=\"20px\" align=\"center\"><td>LK8<td><td>";
						echo "<tr height=\"20px\" align=\"center\"><td>LK9<td><td>";
						echo "<tr height=\"20px\" align=\"center\"><td>PF<td><td>";
					echo "</table>";
					$x++;
					$y++;
					
			
					if($x >= 3){
						//echo "<tr style=\"border-right:dashed;\">";
						$x=0;
					};
					if($y >= 6){
						echo "</table><br>";
						$y=0;
					}
				}
			}
		}
	}
	echo printfooter();
}
?>