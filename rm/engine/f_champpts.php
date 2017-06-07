<?php

class ptsManager{ 

	public function getresult($c,$r){
		$sql = "SELECT pts.pts, r.race_id, t.teamid, tr.classid,tr.trid
				FROM  `f_champ_pts` pts
					INNER JOIN e_teamrace tr ON ( tr.trid = pts.tr_id ) 
					INNER JOIN c_team t ON ( tr.teamid = t.teamid ) 
					INNER JOIN d_race r ON ( r.race_id = tr.raceid )
				WHERE r.race_id = $r and tr.classid = $c";
				
				return  queryDB($sql);		
	}
	
	public function getresult2($r){
		$sql = "SELECT pts.pts, r.race_id, t.teamid, tr.classid,tr.trid
				FROM  `f_abs_champ_pts` pts
					INNER JOIN e_teamrace tr ON ( tr.trid = pts.tr_id ) 
					INNER JOIN c_team t ON ( tr.teamid = t.teamid ) 
					INNER JOIN d_race r ON ( r.race_id = tr.raceid )
				WHERE r.race_id = $r ";
				
				return  queryDB($sql);		
	}
	
	public function getreslt($tid,$cid,$rid){
		$sql = "SELECT * 
				FROM `f_champ_pts` pts
				INNER JOIN e_teamrace tr ON ( pts.tr_id = tr.trid ) 
				WHERE tr.classid =$cid AND raceid =$rid AND teamid =$tid";
				
		return queryDB($sql);
	}
	
	public function delresult($r){
		$sql="delete from  `f_champ_pts` where `RACE_ID` = $r";
		//echo $sql;
		queryDB($sql);
	}
	public function delresult2($r){
		$sql="delete from  `f_abs_champ_pts` where `RACE_ID` = $r";
		//echo $sql;
		queryDB($sql);
	}
	public function saveresult($tr,$pts,$r){
		$sql="INSERT INTO `f_champ_pts` (`RACE_ID`,`TR_ID`,`PTS`) VALUES ($r,$tr,$pts)";
		//echo $sql;
		queryDB($sql);
	}
	public function saveresult2($tr,$pts,$r){
		$sql="INSERT INTO `f_abs_champ_pts` (`RACE_ID`,`TR_ID`,`PTS`) VALUES ($r,$tr,$pts)";
		//echo $sql;
		queryDB($sql);
	}
}

function proceedChampPTS($subf,$opt){ 
	switch ($subf){
		case "ptslist":
			printResults1($opt,"");
			break;
		case "savepts":
			delResults($opt);
			saveResults($opt);
			editRace("openrace",$opt);
			break;
	}
	
}

function delResults($opt){
	$pm = new ptsManager;
	$pm->delresult($opt);
	
}

function saveResults($opt){

	$cm = new champManager;
	$pm = new ptsManager;
		
	$cl = $cm->getActulaRaceClass($opt);
	
	
	for($j=0;$j<count($cl);$j++){		
		//$rt=sort11(getReslt1($opt,$cl[$j]->getId()));
		$rt=getReslt22($opt,$cl[$j]->getId());
		
		$i=0;
		$pts = 20;
		$sp =0;
		while($rt[$i]){
					
						
			//if (($rt[$i][7]<>$rt[$i-1][7]) or ($rt[$i][7] == 0) ){
				$place = $i+1;
			//} 
			
			
			//if (($rt[$i][8]) == 0 or $i >=15) {
			if ($i >=15) {
			} else {
				$epts=0;
				if($place == 1){
					$epts=$pts;
				} elseif ($place < 6){
					$epts = $pts - ($place -1)* 2 -1;
				} elseif ($place >=6){
					$epts = $pts - $place  -4;
				}
				$pm->saveresult($rt[$i][-1],$epts,$opt);
			}
			
			$i++;
		}
	
	}
}

function printResults1($r,$c){
	$cm = new champManager;
		
	$cl = $cm->getActulaRaceClass($r);
	
	
	for($j=0;$j<count($cl);$j++){
		echo "<h2>",$cl[$j]->getName()," klase</h2>";
		echo "<table width=\"100%\" border = \"1\">";
		echo "<tr style=\"font-weight:bold;\"><td width=\"300\">Komanda<td width=\"300\">Braucēji<td>Rezultāts<td>Laiks trasē<td>Vieta<td>Izcīnītie punkti";
		//$rt=sort11(getReslt1($r,$cl[$j]->getId()));
		$rt=getReslt22($r,$cl[$j]->getId());
		
		$i=0;
		$pts = 20;
		$pt=0;
		$place=0;
		while($rt[$i]){
			echo "<tr>";
			echo "<td>",$rt[$i][1];
			echo "<td>",$rt[$i][2];
			echo "<td>",$rt[$i][7];
			echo "<td>",$rt[$i][16];
			//if (($rt[$i][7]<>$rt[$i-1][7]) or ($rt[$i][7] == 0) ){
				$place = $i+1;
			//} 
			echo "<td>",$place,"<td>";			
			
			//if (($rt[$i][8]) == 0 or $i >=15) {
			if ($i >=15) {
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
				echo $epts;
			}
			
			$i++;
		}
		echo "</table>";
	}
	
	
	echo "<form action=\"index.php\" method=\"post\">";
		echo "<input type=\"hidden\" name = \"rm_func\" value=\"champpts\"> ";
		echo "<input type=\"hidden\" name = \"opt\" value=\"$r\">";
		echo "<input type=\"hidden\" name = \"rm_subf\" value=\"savepts\">";	
		echo "<center><input type=\"submit\" value=\"Saglabāt\" ></center>";	
	echo "</form>";

	
}

function getReslt22($r,$c){
	$cp1 = new ptsManager;
	$trm= new TRManager;
	$rm = new raceManager;
	$rcr = new RacerManager;
	
	$tr = $rcr->getResults($r,$c,0,$_SESSION['params']['cmp']);
	//print_r($tr);
	$i = 0;
	
	while ($tr[$i]){
		$tm = $rcr->getTeam($tr[$i][TeamID],"","","");
		$n = $tm[0]->getID();
		$tra = $rt[$n];
		if(!$tra){
			$index[count($index)+1] = $n;
		}		
		if ( $tm  ){
			/*$su=0;
			$pen1=0;
			
			$sulist = $trm->getTRSU("",$tr[$i][TRID],"");
			
			for($ind=0;$ind<sizeof($sulist);$ind++){
				$su+=$sulist[$ind]->getPts();
			}
			
			$finlist= $trm->getTRSF("","",$tr[$i]->getTRID());
			for($ind=0;$ind<sizeof($finlist);$ind++){
				$et = $rm->getSF($finlist[$ind]->getSF(),"");
				
				if($et){
					$s = strtotime($et[0]->getFin());					
					$f = strtotime($finlist[$ind]->getFin());
					
					if ((($s-$f)* -1) > 0 ){$pen1+=floor((($s-$f)* -1)/60);}
				}
			}*/
			
			$tra[-1] = $tr[$i][TRID];
			$tra[0]=$tm[0]->getName();
			$tra[1]=$tm[0]->getName();
			
			$rcrs = Array();			
			$trr= $rcr->getTRRacer($tr[$i][TRID]);
			for($k=0;$k<count($trr);$k++){
				$item=$rcr->getRacer($trr[$k]->getTRRID(),"","");
				array_push($rcrs,$item[0]);
			}
			$p = $rcrs[0];
			$p1 = $rcrs[1];		
		
			
			$tra[2] = $p->getFname()." ".$p->getLname()."<br>".$p1->getFname()." ".$p1->getLname();
						
			//if ($pen1<0){$pen1=0;}
			$tra[3] = $tr[$i][sfpen];//+=$pen1;			
			
			/*$kp= $trm->getTRKP("",$tr[$i]->getTRID(),"","","",1);
			$j=0;
			$point=0;
			$pen=0;
			$prov=0;			
			$niok=0;
			$naok=0;
			while($kp[$j]){
				
				$cp = $rm->getChPoint($kp[$j]->getCpId(),"","","");
				if ( strtoupper(substr($cp[0]->getName(),0,2))=="SU"){$j++;continue;}
				$prov+=$cp[0]->getCost();
				
				switch($kp[$j]->getIok()){
						case 1:
							$point+=$cp[0]->getCost();	
							switch ($kp[$j]->getAok()){
								case 1:
									break;
								case 0:								
								case 2:
									$pen++;		
									$naok++;
							}
							break;
						case 0:							
						case 2:
							$niok+=$cp[0]->getCost();
				}			
				
				
				$pen+=$kp[$j]->getPen();
				$j++;
			}
			
			$pen+=0;//$tr[$i]->getPen();
			if ($point <0){$point =0;}
			*/
			$tra[5]+=$point;
			$tra[6]+=$pen;
			
			/*$sodi = $trm->getTRPen("",$tr[$i]->getTRID());
			$sods=0;
			for($ind=0;$ind<sizeof($sodi);$ind++){
				$sods+=$sodi[$ind]->getPen();
			}*/
			
			$tra[4] = $tr[$i][pen];//+= $sods;
			$tra[7] = $tr[$i][total_pts];//+=$point-$pen-$pen1+$su-$sods;
			$tra[8] = $tr[$i][pts_sum];//+=$prov;
			$tra[9] = $tr[$i][SU_pts];//+=$su;
			$tra[10]= $tr[$i][NIOK_pts];//=$niok;
			$tra[11]= $tr[$i][NAOK_pts];//=$naok;
			$tra[12]=0;
			if(!$_SESSION['params']['cmp']){
				if($trm->TRHasQuest($tr[$i][TRID]) > 0){$tra[12]=3;}
				if($tr[$i][Closed] != 1){$tra[12]=2;}
				if($tr[$i][Completed] != 1){$tra[12]=1;}
			}
			
			if ($_SESSION['params']['rm_subf']=="pl"){
				$qreslt = $cp1->getreslt($tr[$i][TeamID],$tr[$i][ClassID],$tr[$i][RaceID]);
				$row=mysql_fetch_array($qreslt, MYSQL_ASSOC);
				
				$tra[13] += $row ? $row['PTS'] : 0;
			} else {
				$tra[13] = "x";
			}
			
			$tra[14] = $r;
			$tra[15] = $tr[$i][TRID];
			$tra[16] = $tr[$i][fintime];
			
			$rt[$n]=$tra;
		}
		$i++;
	}
	
	for($i=1;$i<=count($index);$i++){
		$reslt[$i-1] = $rt[$index[$i]];
	}
	
	return $reslt;	
}

function sort11($arr){
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

function getReslt1($r,$c){
	$trm= new TRManager;
	$rm = new raceManager;
	$rcr = new RacerManager;
	
	$tr = $rcr->getACCTeamRace($r,$c,0,"");
	
	$i = 0;
	$n=0;
	while ($tr[$i]){
		$tm = $rcr->getTeam($tr[$i]->getTeamID(),"","","");
		
		if ( $tm  ){
			$su=0;
			$pen1=0;
			
			$sulist = $trm->getTRSU("",$tr[$i]->getTRID(),"");
			
			for($ind=0;$ind<sizeof($sulist);$ind++){
				$su+=$sulist[$ind]->getPts();
			}
			
			$finlist= $trm->getTRSF("","",$tr[$i]->getTRID());
			for($ind=0;$ind<sizeof($finlist);$ind++){
				$et = $rm->getSF($finlist[$ind]->getSF(),"");
				
				if($et){
					$s = strtotime($et[0]->getFin());					
					$f = strtotime($finlist[$ind]->getFin());
					
					if ((($s-$f)* -1) >0 ){$pen1+=floor((($s-$f)* -1)/60);}
				}
			}
			$tra[-1] = $tr[$i]->getTRID();
			$tra[0]=$tm[0]->getName();
			$tra[1]=$tm[0]->getName();
			
			$rcrs = Array();			
			$trr= $rcr->getTRRacer($tr[$i]->getTRID());
			for($k=0;$k<count($trr);$k++){
				$item=$rcr->getRacer($trr[$k]->getTRRID(),"","");
				array_push($rcrs,$item[0]);
			}
			$p = $rcrs[0];
			$p1 = $rcrs[1];
			
			$tra[2] = $p->getFname()." ".$p->getLname()."<br>".$p1->getFname()." ".$p1->getLname();
						
			if ($pen1<0){$pen1=0;}
			$tra[3]=$pen1;			
			
			$kp= $trm->getTRKP("",$tr[$i]->getTRID(),"","","",1);
			$j=0;
			$point=0;
			$pen=0;
			$prov=0;			
			$niok=0;
			$naok=0;
			while($kp[$j]){
				
				$cp = $rm->getChPoint($kp[$j]->getCpId(),"","","");
				if ( strtoupper(substr($cp[0]->getName(),0,2))=="SU"){$j++;continue;}
				$prov+=$cp[0]->getCost();
				
				switch($kp[$j]->getIok()){
						case 1:
							$point+=$cp[0]->getCost();	
							switch ($kp[$j]->getAok()){
								case 1:
									break;
								case 0:								
								case 2:
									$pen++;		
									$naok++;
							}
							break;
						case 0:							
						case 2:
							$niok+=$cp[0]->getCost();
				}			
				
				
				$pen+=$kp[$j]->getPen();
				$j++;
			}
			
			$pen+=0;//$tr[$i]->getPen();
			if ($point <0){$point =0;}
			$tra[5]=$point;
			$tra[6]=$pen;
			
			$sodi = $trm->getTRPen("",$tr[$i]->getTRID());
			$sods=0;
			for($ind=0;$ind<sizeof($sodi);$ind++){
				$sods+=$sodi[$ind]->getPen();
			}
			
			$tra[4]= $sods;
			$tra[7]=$point-$pen-$pen1+$su-$sods;
			$tra[8]=$prov;
			$tra[9]=$su;
			$tra[10]=$niok;
			$tra[11]=$naok;
			$tra[12]=0;
			if($trm->TRHasQuest($tr[$i]->getTRID()) > 0){$tra[12]=3;}
			if($tr[$i]->getClosed() != 1){$tra[12]=2;}
			if($tr[$i]->getComp() != 1){$tra[12]=1;}
			

			$rt[$n]=$tra;
			
			$n++;
		}
		$i++;
	}
	return $rt;
}

?>