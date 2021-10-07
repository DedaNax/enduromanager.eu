<?php
class EnduroRaceDay{
	public $ERD_ID;
	public $RACE_ID;
	public $ORIENTATION;
	public $START_DATE;
	public $REG_ACTIVE;
	public $OFFSET_MIN;
	public $MOTOCROSS;
}
class EnduroRaceClassDay{
	public $ERCD_ID;
	public $ERD_ID;
	public $ENDURO_LAPS;
	public $CLASS_ID;
	public $FIN_OFFSET;
	public $ORDER;
	public $NAME;
	public $SEPARATOR;
	public $RACE_ID;
}
class EnduroApplication{
	public $ERA_ID;	
	public $CLASS_ID;
	public $RACER_ID;
	public $RACE_ID;
	public $ACCEPTED;
	public $TEAM_C;
	public $PROD_C;
	public $NR;
	public $INS;
	public $TEHN;
	public $LIC_NR;
	public $LIC_TYPE;
	public $CLASS_NAME;

	public $covid19RacerID;
	public $covid19RacerPhone;
	public $covid19TechnID;
	public $covid19TechnName;
	public $covid19TechnPhone;	
}
class EnduroTask{
	public $ET_ID;
	public $RACE_ID;
	public $NAME;
}
class EnduroDayRacer{
	public $RACER;
	public $CLASS_ID;
	public $CLASS_NAME;
	public $ACCEPTED;	
	public $EA_ID;	
	public $PAIR;
	public $POSITION;
	public $LK0;
	public $LK0K;
	public $DQ;
	public $IZS;
	public $LK;
	public $NR;
}
class EnduroClassDayStage{
	public $RCDS_ID;
	public $ES_ID;
	public $RCD_ID;
	public $OFFSET_TIME;
}
class EnduroStage{
	public $ES_ID;
	public $RACE_ID;
}

class EnduroManager{
	public function insES($r){
		$sql = "insert into `enduro_stage` (`race_id`) values ($r)";
		queryDB($sql);
	}
	public function delES($id){
		$sql = "delete from `enduro_stage` where `es_id` = $id";
		queryDB($sql);
	}
	public function getES($r){
		$sql = "select * from `enduro_stage` where `race_id` = $r order by `ES_ID` asc";
		$q_result = queryDB($sql);
		
		$reslt = array();		
		 while ($row = mysql_fetch_array($q_result, MYSQL_ASSOC)) {
			
			$item = new EnduroStage;
			
			$item->ES_ID = $row["ES_ID"];
			$item->RACE_ID = $row["RACE_ID"];
			
			array_push($reslt,$item);
		}
		return $reslt;
	}
	
	public function insRCDS($s,$rcd,$ofs){		
		$sql = "insert into `enduro_race_class_day_stage` (`ES_ID`,`RCD_ID`,`OFFSET_TIME`) values ($s,$rcd,'$ofs')";
		//echo $sql;
		queryDB($sql);
	}
	public function saveRCDS($id,$time){
		$sql="update `enduro_race_class_day_stage` set `OFFSET_TIME` = '$time' where `RCDS_ID`=$id";
		//echo $sql;
		queryDB($sql);
	}
	public function getRCDS($id,$c,$s,$rcd){
		$sql = "select * from `enduro_race_class_day_stage` ds";
		if($id){
			$sql = "$sql where `RCDS_ID` = $id";
		} else {
			$where = "";
			if($s){$where = "`es_id` = $s";}
			if($c && $rcd){
				$sql = "$sql inner join `enduro_race_class_day` rcd on (rcd.`ERCD_ID` = ds.`RCD_ID`)";
				$where = $where ? "$where and ": $where;
				$where = "$where rcd.`CLASS_ID` = $c and rcd.`ERcD_ID` = $rcd";
			}
		}
		$sql = $where ? "$sql where $where" : $sql;
		//echo $sql;
		$q_result = queryDB($sql);
		
		$reslt = array();		
		 while ($row = mysql_fetch_array($q_result, MYSQL_ASSOC)) {
			
			$item = new EnduroClassDayStage;
			
			$item->RCDS_ID = $row["RCDS_ID"];
			$item->ES_ID = $row["ES_ID"];
			$item->RCD_ID = $row["RCD_ID"];
			$item->OFFSET_TIME = $row["OFFSET_TIME"];
			
			array_push($reslt,$item);
		}
		return $reslt;
	}
	public function delRCDS($s,$rcd){
		$sql = "delete from `enduro_race_class_day_stage`";
		
		$where= $s? " `es_id` = $s ": "";
			
		$where = $rcd ? ($where ? "$where and ": $where) . "`RCD_ID` = $rcd": $where;
		
		$sql = $where ? "$sql where $where" : $sql;
		//echo $sql;
		queryDB($sql);
	}
	
	public function insERD($r,$day){
		$sql = "insert into `enduro_race_day` (RACE_ID,START_DATE) values ($r,".($day?"'$day'":" null ").")";
		//echo $sql;
		queryDB($sql);
	}
	public function saveERD($erd,$day,$or,$m){
		if (!$erd || !$day){
			echo "KĻŪDA!!!";
			return ;
		}
		
		$sql = "
		update 
			`enduro_race_day` 
		set 
			`start_date` = '$day', 
			`orientation` = ".(isset($or) ? $or : " null ").",
			`motocross` = ".(isset($m) ? $m : " null ")."
		where 
			`erd_id` = $erd";
		//echo $sql;
		queryDB($sql);
	}
	public function getERD($r){
		if(!$r){
			echo "NO RACE INPUT!";
			return;
		}
		$sql = "select * from `enduro_race_day` where race_id =  $r order by `erd_id` asc";
		$q_result = queryDB($sql);
		
		$reslt = array();		
		 while ($row = mysql_fetch_array($q_result, MYSQL_ASSOC)) {
			
			$item = new EnduroRaceDay;
			
			$item->ERD_ID = $row["ERD_ID"];
			$item->RACE_ID = $row["RACE_ID"];
			$item->START_DATE = $row["START_DATE"];
			$item->ORIENTATION = $row["ORIENTATION"];
			$item->REG_ACTIVE = $row["REG_ACTIVE"];
			$item->OFFSET_MIN = $row["OFFSET_MIN"];
			$item->MOTOCROSS = $row["MOTOCROSS"];
						
			array_push($reslt,$item);
		}
		return $reslt;
	}
	public function getERD1($d){
		$sql = "select * from `enduro_race_day` where `erd_id` =  $d";
		//echo $sql;
		$q_result = queryDB($sql);
		
		$reslt = array();		
		 while ($row = mysql_fetch_array($q_result, MYSQL_ASSOC)) {
			
			$item = new EnduroRaceDay;
			
			$item->ERD_ID = $row["ERD_ID"];
			$item->RACE_ID = $row["RACE_ID"];
			$item->START_DATE = $row["START_DATE"];
			$item->ORIENTATION = $row["ORIENTATION"];
			$item->REG_ACTIVE = $row["REG_ACTIVE"];
			$item->OFFSET_MIN = $row["OFFSET_MIN"];
			$item->MOTOCROSS = $row["MOTOCROSS"];

			array_push($reslt,$item);
		}
		return $reslt;
	}
	public function delERD($erd){
		$sql = "delete from `enduro_race_class_day` where `erd_id` = $erd";
		if (!queryDB($sql)){return;}
		$sql = "delete from `enduro_race_day` where `erd_id` = $erd";
		queryDB($sql);
	}
	public function lockERD($d,$state){
		$sql = "update `enduro_race_day` set `REG_ACTIVE` = $state where `ERD_ID` = $d";
		queryDB($sql);
	}
	
	
	public function insERCD($erd_id,$laps,$c){
	
		$order = 1;
		$sql = "select max(`start_order`) as mx from `enduro_race_class_day` where `erd_id` = $erd_id";
		$r=queryDB($sql);
		$row = mysql_fetch_array($r, MYSQL_ASSOC);
		if($row['mx']){$order +=$row['mx'];}
		
		$sql = "insert into `enduro_race_class_day` (`erd_id`,`enduro_laps`,`class_id`,`start_order`) values ($erd_id,".($laps?$laps:" 0 ").",$c,$order)";
		//echo $sql;
		queryDB($sql);
	}
	public function saveERCD($ercd,$l,$fin){
		$sql = "update `enduro_race_class_day` set `enduro_laps` = $l ".($fin == -1 ?
				"":",`FIN_OFFSET`=".($fin ? " '".$fin."' " : " null ") )."where `ercd_id` = $ercd";
				//echo $sql;
		queryDB($sql);
	}
	public function delERCD($ercd){
		$sql = "delete from `enduro_race_class_day` where `ercd_id` = $ercd";
		queryDB($sql);
	}
	public function getERCD($r,$erd,$c){
		$sql = "select ercd.*,c.`NAME`".($r ? ", erd.`RACE_ID`":"")." from `enduro_race_class_day` ercd
					inner join `d_class` c on (c.`classid` = ercd.`class_ID`)";
		$where ="";
		if ($erd) {$where = " ercd.`erd_id` = $erd";}
		
		if ($r) {
			$sql = "$sql inner join `enduro_race_day` erd on (erd.`erd_id` = ercd.`erd_id`) ";
			$where = $where ? "$where and ": $where;
			$where = "$where erd.`race_id` = $r";
		}
		
		if ($c) {
			$where = $where ? "$where and ": $where;
			$where = " $where `class_id` = $c";
		}
		
		$sql = $where ? "$sql where $where" : $sql;
		$sql = "$sql order by ercd.`start_order` asc";
		//echo $sql;
		$q_result = queryDB($sql);
		$reslt = array();		
		 while ($row = mysql_fetch_array($q_result, MYSQL_ASSOC)) {
			
			$item = new EnduroRaceClassDay;
			
			$item->ERCD_ID = $row["ERCD_ID"];
			$item->ERD_ID = $row["ERD_ID"];
			$item->ENDURO_LAPS = $row["ENDURO_LAPS"];
			$item->FIN_OFFSET = $row["FIN_OFFSET"];
			$item->CLASS_ID = $row["CLASS_ID"];
			$item->NAME = $row["NAME"];
			$item->ORDER = $row["START_ORDER"];
			$item->SEPARATOR = $row["SEPARATOR"];
			$item->RACE_ID = $row["RACE_ID"] ? $row["RACE_ID"]: "";
			
			array_push($reslt,$item);
		}
		return $reslt;
	}
	
	
	public function insERA($r,$c,$rcr,$t,$i,$nr,$l,$covid19RacerID,$covid19RacerPhone,$covid19TechnID,$covid19TechnName,$covid19TechnPhone){
		$covid19RacerID = $covid19RacerID ? $covid19RacerID : "";
		$covid19RacerPhone = $covid19RacerPhone ? $covid19RacerPhone : "";
		$covid19TechnID = $covid19TechnID ? $covid19TechnID : "";
		$covid19TechnName = $covid19TechnName ? $covid19TechnName : "";
		$covid19TechnPhone = $covid19TechnPhone ? $covid19TechnPhone : "";

		$sql = "insert into `enduro_application` (
					`race_ID`,
					`class_id`,
					`racer_id`,
					`tehn`,
					`ins`,
					`NR`,
					`LIC_NR`,
					`covid19RacerID`,
					`covid19RacerPhone`,
					`covid19TechnID`,
					`covid19TechnName`,
					`covid19TechnPhone`)
				values ($r,$c,$rcr,'$t',$i,'$nr','$l','$covid19RacerID','$covid19RacerPhone','$covid19TechnID','$covid19TechnName','$covid19TechnPhone')";	
				
		queryDB($sql);
		return mysql_insert_id ();
	}
	public function delERA($id){
		$sql = "delete from `enduro_day_racer` where `EA_ID` = $id";
		queryDB($sql);
		$sql = "delete from `enduro_application` where `era_id` = $id";
		queryDB($sql);
	}
	public function getERA($id,$r,$c,$rcr,$ac){
		$sql = "select 
					ea.`ERA_ID`,
					ea.`CLASS_ID`,
					ea.`RACER_ID`,
					ea.`RACE_ID`,
					ea.`ACCEPTED`,
					ea.`TEAM_C`,
					ea.`PROD_C`,
					ea.`NR`,
					ea.`TEHN`,
					ea.`INS`,
					el.`TYPE`,
					ea.`LIC_NR`,
					c.`name` as CLASS_NAME,
					ea.`covid19RacerID`,
					ea.`covid19RacerPhone`,
					ea.`covid19TechnID`,
					ea.`covid19TechnName`,
					ea.`covid19TechnPhone`
				from `enduro_application` ea
					left join `enduro_licence` el on el.`LIC_NR` = ea.`LIC_NR` 
					left join `d_class` c on c.`classid` = ea.`class_id`";
		$where = "";
		if($id) {$where = "`era_id` = $id";}
		if($r){
			$where = "$where ".($where?" and ": "")."`race_id` = $r";
		}
		if($c){
			$where = "$where ".($where?" and ": "")."`class_id` = $c";
		}
		if($rcr){
			$where = "$where ".($where?" and ": "")."ea.`racer_id` = $rcr";
		}
		
		if($ac<>""){
			$where = "$where ".($where?" and ": "")."`accepted` = $ac";
		}
		
		if($where){$sql = "$sql where $where";}
		
		
		
		//echo $sql;
		
		
		
		$q_result = queryDB($sql);
		$reslt = array();		
		 while ($row = mysql_fetch_array($q_result, MYSQL_ASSOC)) {
			
			$item = new EnduroApplication;
			
			$item->ERA_ID = $row["ERA_ID"];
			$item->CLASS_ID = $row["CLASS_ID"];
			$item->RACER_ID = $row["RACER_ID"];
			$item->RACE_ID = $row["RACE_ID"];
			$item->ACCEPTED = $row["ACCEPTED"];
			$item->TEAM_C = $row["TEAM_C"];
			$item->PROD_C = $row["PROD_C"];
			$item->NR = $row["NR"];
			
			$item->TEHN = $row["TEHN"];
			$item->INS = $row["INS"];
			$item->LIC_NR = $row["LIC_NR"];
			$item->LIC_TYPE = $row["TYPE"];
			$item->CLASS_NAME = $row["CLASS_NAME"];

			$item->covid19RacerID = $row["covid19RacerID"];
			$item->covid19RacerPhone = $row["covid19RacerPhone"];
			$item->covid19TechnID = $row["covid19TechnID"];
			$item->covid19TechnName = $row["covid19TechnName"];
			$item->covid19TechnPhone = $row["covid19TechnPhone"];

			array_push($reslt,$item);
		}
		return $reslt;
	}
	
	public function insET($r,$n){
		$sql = "insert into `enduro_task` (`race_id`,`name`) values ($r,'$n');";
		queryDB($sql);
	}
	
	public function saveET($et,$n){
		$sql = "update `enduro_task` set `name` = '$n' where `et_id` = $et;";
		queryDB($sql);
	}
	public function delEt($et){
		$sql = "delete from `enduro_task` where et_id = $et;";
		queryDB($sql);
	}
	public function getEt($id,$r){
		$sql = "select * from `enduro_task`";
		$where ="";
		if ($id){
			$where = " `et_id` = $id";
		}
		if ($r){
			$where = "$where ".($where?" and ": "")."`race_id` = $r";
		}
		
		if($where){$sql = "$sql where $where";}
		$sql = "$sql order by `et_id` asc";
		//echo $sql;
		$q_result = queryDB($sql);
		$reslt = array();		
		 while ($row = mysql_fetch_array($q_result, MYSQL_ASSOC)) {
			
			$item = new EnduroTask;
			
			$item->ET_ID = $row["ET_ID"];
			$item->RACE_ID = $row["RACE_ID"];
			$item->NAME = $row["NAME"];	
			
			array_push($reslt,$item);
		}
		return $reslt;
	}

	public function getLastOrder($d,$r){
	$sql = "select `EDR_ID`,`PAIR` from `enduro_day_racer`
		where `erd_id` = $d and `ea_id` in (select `era_id` from `enduro_application` where `racer_id` = $r)";
		
		//ECHO $sql;
		$q_result = queryDB($sql);
		$reslt = array();	
		$rcr = new RacerManager;
		 while ($row = mysql_fetch_array($q_result, MYSQL_ASSOC)) {
			
			$item = new EnduroDayRacer;
			
			$item->EDR_ID = $row["EDR_ID"];
			$item->PAIR = $row["PAIR"];
			
			array_push($reslt,$item);
		}
		return $reslt;
	}
	public function getEDRByracer($d,$r){
		$sql = "select * from `enduro_day_racer`
				where `erd_id` = $d and `ea_id` in (select `era_id` from `enduro_application` where `racer_id` = $r)";
		//echo $sql;
		$q_result = queryDB($sql);
		$reslt = array();	
		$rcr = new RacerManager;
		 while ($row = mysql_fetch_array($q_result, MYSQL_ASSOC)) {
			
			$item = new EnduroDayRacer;
			
			$item->EDR_ID = $row["EDR_ID"];			
			$item->EA_ID = $row["EA_ID"];
			$item->ERD_ID = $row["ERD_ID"];
			$item->PAIR = $row["PAIR"];
			$item->POSITION = $row["POSITION"];
			$item->LK0 = $row["LK0"];
			$item->LK0K = $row["LK0K"];
			$item->LK = $row["LK"];
			$item->DQ = $row["DQ"];
			$item->IZS = $row["IZS"];
			
			array_push($reslt,$item);
		}
		return $reslt;
	}
	public function insEDR($ea){
		$sql = "insert into `enduro_day_racer` (`EA_ID`,`ERD_ID`) 
				SELECT ea.`era_id`,d.`erd_id` 
				FROM `enduro_application` ea
					inner join `enduro_race_day` d on (d.`race_id` = ea.`race_id`)
				where 
					d.`reg_active` = 1 and
					ea.`era_id` = $ea";
		queryDB($sql);
	}
	public function delEDR($id){
		$sql = "delete from `enduro_day_racer` where `EDR_ID` = $id";
		queryDB($sql);
	}
	public function getEnduroDayRacerList($ed){
		$sql = "SELECT 
					ea.`RACER_ID` ,
					edr.`EDR_ID` as accepted,
					cl.`classid`,
					cl.`name`,
					ea.`ERA_ID`,
					ea.`NR`  as NR
				FROM `enduro_application` ea 
					inner join `d_class` cl on (cl.`classid` = ea.`class_id`)
					left join `enduro_day_racer` edr on (
						edr.`ea_id` = ea.`era_id` and 
						edr.`erd_id` = $ed
					)
						left join `phpbb_profile_fields_data` pd on (pd.`user_id` = ea.`racer_id`)
				WHERE ea.`race_id` = (select `race_id` from `enduro_race_day` where `ERD_ID` = $ed)
				ORDER BY cl.`weight` asc, cl.`code` asc, NR asc, ea.`racer_id`
		";
		//cast(pd.`pf_rm_sport_nr` as decimal(5,2)) as NR
		//echo $sql;
		$q_result = queryDB($sql);
		$reslt = array();	
		$rcr = new RacerManager;
		 while ($row = mysql_fetch_array($q_result, MYSQL_ASSOC)) {
			
			$item = new EnduroDayRacer;
			$rcrs = $rcr->getRacer($row["RACER_ID"]);
			$item->RACER = $rcrs[0];
			$item->ACCEPTED = $row["accepted"];			
			$item->CLASS_ID = $row["classid"];
			$item->CLASS_NAME = $row["name"];
			$item->EA_ID = $row["ERA_ID"];
			$item->NR = $row["NR"];
			
			array_push($reslt,$item);
		}
		return $reslt;
	}
	public function getFreeRacerList($r){
		$rcr = new RacerManager;
		return $rcr->getFreeRacerList($r);
	}
	
	public function getEnduroRacerListByClub($r,$c){
		$sql="	SELECT `user_id`,
						pd.`pf_rm_sport_nr`  as NR
				FROM `phpbb_profile_fields_data` pd
				WHERE 					
					pd.`user_id` in (select `user_id` from `phpbb_user_group` where `group_id` = ".RACER_GROUP_ID.") and
					pd.`pf_rm_club` = $c
				ORDER BY NR
		";
		//cast(pd.`pf_rm_sport_nr` as decimal(5,2)) as NR
		//echo $sql;
		$q_result = queryDB($sql);
		
		$reslt = array();	
		$rcr = new RacerManager;
		 while ($row = mysql_fetch_array($q_result, MYSQL_ASSOC)) {
			
			$rcrs = $rcr->getRacer($row["user_id"]);
			 
			array_push($reslt,$rcrs[0]);
		}
		return $reslt;
	}

	public function getEnduroDayRacerCNT($d,$c){
		$sql = "SELECT *
				FROM `enduro_application` ea 
					inner join `enduro_day_racer` edr on (
						edr.`ea_id` = ea.`era_id` and 
						edr.`erd_id` = $d
					)
				WHERE ea.`race_id` = (select `race_id` from `enduro_race_day` where `ERD_ID` = $d)";
		if($c){$sql = "$sql and ea.`class_id` = $c";}
		
		$q_result = queryDB($sql);
		return mysql_num_rows($q_result);
	}
	public function getEnduroDayFreeRacerList($d,$c){
		$sql = "SELECT 
					ea.`racer_id`,
					ea.`NR`  as NR
				FROM `enduro_application` ea 
					inner join `enduro_day_racer` edr on (
						edr.`ea_id` = ea.`era_id` and 
						edr.`erd_id` = $d and 
						edr.`pair` is null and
						edr.`position` is null 
					)
					left join `phpbb_profile_fields_data` pd on (pd.`user_id` = ea.`racer_id`)
				WHERE ea.`race_id` = (select `race_id` from `enduro_race_day` where `ERD_ID` = $d)";
		//cast(pd.`pf_rm_sport_nr` as decimal(5,2)) as NR
		
		if($c){$sql = "$sql and ea.`class_id` = $c";}
		$sql = "$sql ORDER BY NR asc";
		
		$q_result = queryDB($sql);
		
		$reslt = array();	
		$rcr = new RacerManager;
		 while ($row = mysql_fetch_array($q_result, MYSQL_ASSOC)) {
			
			$rcrs = $rcr->getRacer($row["racer_id"]);
			$rcrs[0]->setNr($row["NR"]);

			array_push($reslt,$rcrs[0]);
		}
		return $reslt;
	}
	public function getEnduroDayFreeRacerList1($d,$c,$p,$pos){
		$sql = "SELECT 
					ea.`racer_id`,
					ea.`NR`  as NR
				FROM `enduro_application` ea 
					inner join `enduro_day_racer` edr on (
						edr.`ea_id` = ea.`era_id` and 
						edr.`erd_id` = $d " .($p && $pos ? "and 
						edr.`pair` = $p and
						edr.`position` = $pos" : ""). "
					)
				WHERE ea.`race_id` = (select `race_id` from `enduro_race_day` where `ERD_ID` = $d)";
		if($c){$sql = "$sql and ea.`class_id` = $c";}
		$sql = "$sql ORDER BY edr.`pair` asc,edr.`position` asc";
		//echo $sql;
		$q_result = queryDB($sql);
		
		$reslt = array();	
		$rcr = new RacerManager;
		 while ($row = mysql_fetch_array($q_result, MYSQL_ASSOC)) {
			
			$rcrs = $rcr->getRacer($row["racer_id"]);			 
			$rcrs[0]->setNr($row["NR"]);

			array_push($reslt,$rcrs[0]);
		}
		return $reslt;
	}
}

function proceedEnduro($subf,$opt){
	$em = new EnduroManager;
	switch($subf){
		case "saveEteamMember":
			echo saveEteamMember($_SESSION["params"]["et"],$_SESSION["params"]["ea"]);
			break;
		case "getClubRacers":
			getClubRacers($opt,$_SESSION["params"]["et"]);
			break;
		case "saveEteam":
			echo saveEteam($opt,$_SESSION["params"]["club"]);
			break;
		case "getClub":
			getClubs($opt);
			break;
		case "delteam":
			delteam($_SESSION["params"]["et"],$opt);
			printTeams($opt);
			break;
		case "delteamracer":
			delteamracer($_SESSION["params"]["ea"]);
			printTeams($opt);
			break;
		case "changeTeam":
			echo changeTeam($_SESSION['params']['id'],$_SESSION['params']['val'],$_SESSION['params']['modex']);
			break;
		case "teams":
			printTeams($opt);
			break;
		case "reload_offset":
			offset_change($_SESSION['params']['day'],"","","");
			printStarts($opt);
			break;
		case "copyracers":
			copyracers();
			printStarts($opt);
			break;
		case "testIgnore":
			echo testignore($_SESSION['params']['d'],$_SESSION['params']['t'],$_SESSION['params']['c'],$_SESSION['params']['v'],$_SESSION['params']['l']);
			break;
		case "savetestignore";
			savetestignore();
			timeInput($opt);
			break;
		case "deltestresult":
			deltestresult();
			timeInput($opt);
			break;
		case "importresults":
			importresults();
			timeInput($opt);
			break;			
		case "printresult":
			printresult1();
			break;
		case "savetestres":
			savetestres();
			timeInput($opt);
			break;
		case "testinp":
			testinp($opt);
			break;
		case "savelkimp":
			savelkimp();
			timeInput($opt);
			break;
		case "lkinp":
			lkinp($opt);
			break;
		case "laiks":
			timeInput($opt);
			break;
		case "put_separator":
			put_separator();
			break;
		case "erd_racer_change":
			echo erd_racer_change();
			break;
		case "rcer_offset_change":
			echo rcer_offset_change();
			break;
		case "erd_offset_change":
			echo offset_change($_SESSION['params']['erd'],$_SESSION['params']['val'],"","");
			break;
		case "moveclass":
			moveClass();
			printStarts($opt);
			break;
		case "pairracer":
			pairRacer();
			printStarts($opt);
			break;
		case "start":
			printStarts($opt);
			break;
		case "addstage":
			$em->insES($opt);
			if ($_SESSION['params']['red_f'] == "race"){
				editRace($_SESSION['params']['red_s'],$opt);
			}			
			break;
		case "delstage":
			$em->delRCDS($_SESSION['params']['id'],"");
			$em->delES($_SESSION['params']['id']);
			if ($_SESSION['params']['red_f'] == "race"){
				editRace($_SESSION['params']['red_s'],$opt);
			} 
			break;
		case "apply":
		    if (!$_SESSION['params']['type'] || !$opt) {
				printActRace();
				break;
			}
			printEnduroApply($opt);			
			break;	
		case "clubapply":
			printEnduroClubApply($opt);
			break;
		case "addapplication":	
			$_SESSION['params']['racer'] = $_SESSION['params']['racer']?$_SESSION['params']['racer']:$_SESSION['user']['user_id'];
			
			if(validateCovid()){

				$em->insERA(
				 	 $_SESSION['params']['raceid']
					,$_SESSION['params']['class']
					,$_SESSION['params']['racer']
					,$_SESSION['params']['teh_Marka']."^".$_SESSION['params']['teh_Model']."^".$_SESSION['params']['teh_V']."^".$_SESSION['params']['teh_T']
					,0
					,$_SESSION['params']['NR']
					,$_SESSION['params']['lic']
					,$_SESSION['params']['covid19RacerID']
					,$_SESSION['params']['covid19RacerPhone']
					,$_SESSION['params']['covid19TechnID']
					,$_SESSION['params']['covid19TechnName']
					,$_SESSION['params']['covid19TechnPhone']);

				switch($_SESSION['params']['f2']){
					case "club":
						printEnduroClubApply($opt);
						break;
					default:
						if ($_SESSION['params']['org']){
							printEnduroReg($opt);
						} else {
							//printEnduroApply($opt);
							enduroapllist();
						}						
				}
			} else {
				printEnduroApply($opt);
			}
					
			break;
		case "delapl":
			$em->delERA($_SESSION['params']['id']);
			switch($_SESSION['params']['f2']){
				case "club":
					printEnduroClubApply($opt);
					break;
				default:
					printEnduroApply($opt);
			}			
			break;
		case "delapl1":
			$em->delERA($_SESSION['params']['id']);
			printEnduroReg($opt);
			break;
		case "reg":
			printEnduroReg($opt);
			break;
		case "accracerday":
			$em->insEDR($_SESSION['params']['ea']);
			printEnduroReg($opt);
			break;
		case "denyracerday":
			$em->delEDR($_SESSION['params']['id']);
			printEnduroReg($opt);
			break;
		case "apladd":
			$em->insERA(
				 $_SESSION['params']['opt']
				,$_SESSION['params']['c']
				,$_SESSION['params']['racer']
				,''
				,1
				,''
				,''
				,$_SESSION['params']['covid19RacerID']
				,$_SESSION['params']['covid19RacerPhone']
				,$_SESSION['params']['covid19TechnID']
				,$_SESSION['params']['covid19TechnName']
				,$_SESSION['params']['covid19TechnPhone']);
			printEnduroReg($opt);
			break;
		case "aplapply":
			$id = $em->insERA(
				 $_SESSION['params']['opt']
				,$_SESSION['params']['c']
				,$_SESSION['params']['racer']
				,''
				,1
				,''
				,''
				,$_SESSION['params']['covid19RacerID']
				,$_SESSION['params']['covid19RacerPhone']
				,$_SESSION['params']['covid19TechnID']
				,$_SESSION['params']['covid19TechnName']
				,$_SESSION['params']['covid19TechnPhone']);
			$em->insEDR($id);			
			printEnduroReg($opt);
			break;
		case "dayunlock":
			$em->lockERD($_SESSION['params']['day'],1);
			printEnduroReg($opt);
			break;
		case "daylock":
			$em->lockERD($_SESSION['params']['day'],0);
			printEnduroReg($opt);
			break;
		case "unpairracer":
			unpair();
			printStarts($opt);
			break;
		case "changeNR":
			printEnduroReg(changeNR());
			break;
		case "motoinp":
			switch($_SESSION['params']['save']){
				case "save":
					motoInputSave();
					motoInput();
					break;
				default:
					motoInput();
			}			
			break;	
		default:
	}
}

function validateCovid(){

	$rm = new raceManager;
	$r = $rm->getRace($_SESSION['params']['opt'],"","","","","","");

	if($r[0]->COVID19){
		if(!$_SESSION['params']['covid19RacerID'] ||
		   !$_SESSION['params']['covid19RacerPhone'] ||
		   !$_SESSION['params']['covid19TechnID'] ||
		   !$_SESSION['params']['covid19TechnName'] ||
		   !$_SESSION['params']['covid19TechnPhone']){

			echo prntWarn(ENDURO_APPLY_NO_COVID_DATA_WARNING);

			return false;
		}
	}

	return true;
}

function motoInputSave() {	
	$names = explode(";",$_SESSION['params']['names']);	
	for ($i=0;$i<count($names);$i++) {				
		$id = str_replace("motocrs","",$names[$i]);			
		$value = $_SESSION['params'][$names[$i]];

		$sql = "delete from `enduro_test_result_moto` where `edr_id` = $id";		
		queryDB($sql);

		$sql = "insert into `enduro_test_result_moto` (`edr_id`,`pts`) values($id,".($value ? $value : 0).")";
				
		queryDB($sql);		
	}	
}

function motoInput() {
	$rcm = new RacerManager;
	$rm = new raceManager;
	$em = new EnduroManager;
	$cm = new champManager;
	
	$names = "";
	$day=$_SESSION['params']['day'];
	$cl = $em->getERCD($opt,$_SESSION['params']['day'],"");
	$r = $rm->getRace($cl[0]->RACE_ID,"","","","","","","");
	$erd = $em->getERD1($day);
	
	echo "<a href=\"?rm_func=enduro&rm_subf=laiks&opt=$opt&day=$day\"><b>Rezultātu ievade</b></a>";
	echo " -> <b>",$r[0]->getName(),"</b>";
	echo " -> <b>",$erd[0]->START_DATE,"</b>";
	echo " -> <b>Visas klases</b>";
	echo " -> <b>Motokrosa punkti</b>";
	
	echo "<hr>";

	echo "<form action =\"index.php\" method=\"post\">";
		if (count($cl)>0){
			for($n=0;$n<count($cl);$n++){
									
				echo "<br><b>",$cl[$n]->NAME,"</b><br>";
				echo "<table border=\"1\">";			
				
					$rcr = $em->getEnduroDayFreeRacerList1($day,$cl[$n]->CLASS_ID,"","");
					for($i=0;$i<count($rcr);$i++){
						echo "<tr><td>",$rcr[$i]->getNr()," ",$rcr[$i]->getFname()," ",$rcr[$i]->getLname();					
							$edr = $em->getEDRByracer($day,$rcr[$i]->getUserID());
							
							$sql = "select *
									from `enduro_test_result_moto`
									where `edr_id` = ".$edr[0]->EDR_ID.";";
							$r = queryDB($sql);
							$row = mysql_fetch_array($r, MYSQL_ASSOC);
							
							$name = "motocrs".$edr[0]->EDR_ID;
							
							echo "<td><input 
										type=\"text\" 
										size=\"11\" 
										maxlength=\"11\" 
										name=\"$name\"
										value=\"", $row['PTS'],"\">";
							
							$names.=$name.";";
						
					}
				echo "</table>";
			}
		}
		
		echo "<input name=\"names\" type=\"hidden\" value=\"$names\">";		
		echo "<input name=\"rm_subf\" type=\"hidden\" value=\"motoinp\">";
		echo "<input name=\"rm_func\" type=\"hidden\" value=\"enduro\">";
		echo "<input name=\"save\" type=\"hidden\" value=\"save\">";
		echo "<input name=\"opt\" type=\"hidden\" value=\"$opt\">";
		echo "<input name=\"day\" type=\"hidden\" value=\"$day\">";
		echo "<hr><center><input type=\"submit\" value=\"Saglabāt\"></center>";
	echo "</form>";
}

function changeNR() {
	$sql = "		
		UPDATE 
			`enduro_application`
		SET 
			`NR` = '".$_SESSION['params']['nr']."'
		WHERE
			`ERA_ID` = ".$_SESSION['params']['ea'];	
	queryDB($sql);

	$sql = '
		SELECT 
			`RACE_ID`
		FROM 
			`enduro_application`
		WHERE
			`ERA_ID` = '.$_SESSION['params']['ea'];	
	$r = queryDB($sql);	
	$cc = mysql_fetch_array($r,MYSQL_ASSOC);

	return $cc["RACE_ID"];
}

function saveEteamMember($et,$ea){
	$sql = "update `enduro_application` set `team_c` = $et where `era_id` = $ea;";
	if(!queryDB($sql)){
		return "NAK";
	}
	return "OK";	
}

function getClubRacers($opt,$et){
	$sql = "select `club_id` from `enduro_team` where `et_id` = $et";
	$r = queryDB($sql);	
	$cc = mysql_fetch_array($r,MYSQL_ASSOC);
	$cc = $cc["club_id"];
	
	$sql = "
		select 
			ea.`ERA_ID`,
			c.`NAME` as CLASS_NAME,				
			pd.`pf_rm_f_name` as F_NAME,
			pd.`pf_rm_l_name` as L_NAME,
			pd.`pf_rm_sport_nr` as NR							
		from `enduro_application` ea
			inner join `d_race` r on (ea.`race_id` = r.`race_id`)
			inner join `d_class` c on (c.`classid` = ea.`class_id`)
			inner join `phpbb_profile_fields_data` pd on (pd.`user_id` = ea.`racer_id`)
		where 
			(ea.`team_c` is null or ea.`team_c` = 0) and
			ea.`race_id` = ".$opt." and
			pd.`pf_rm_club` = $cc;";
			//echo $sql;
	$r = queryDB($sql);
	echo "<table border = \"1\" style=\"border-collapse:collapse\">";
		while($row1 = mysql_fetch_array($r,MYSQL_ASSOC)){
			echo "<tr>";
				echo "<td width=\"17px\">";
				echo "<a onclick=\"addETeamMember(",$row1["ERA_ID"],",$et,$opt)\"
					onmouseover=\"document.body.style.cursor = 'pointer'\"
					onmouseout = \"document.body.style.cursor = 'default'\"
				>";
					echo "<img src=\"./images/BlueAdd_16x16.png\" title=\"Izvēlēties sportistu\" alt=\"+\">";
				echo "</a>";
				echo "<td width=\"25px\">",$row1["NR"];
				echo "<td width=\"150px\">",$row1["F_NAME"]," ",$row1["L_NAME"];
				echo "<td width=\"40px\">",$row1["CLASS_NAME"];
				
				
		}
	echo "</table>";
			
}

function saveEteam($opt,$c){
	$rm = new raceManager;
	$rcr = new racerManager;
	
	
	$cl = $rcr->getClub($c);
	$rc = $rm->getRace($opt,"","","","","","");
	
	$sql = "select count(*) as cnt from `enduro_team` where `club_id` = $c and `champ_id` = ".$rc[0]->getCH_ID().";";
	$r = queryDB($sql);	
	$cnt = mysql_fetch_array($r,MYSQL_ASSOC);
	$cnt = $cnt["cnt"];
	
	$sql = "insert into `enduro_team` (`CHAMP_ID`,`NAME`,`CLUB_ID`) values (".$rc[0]->getCH_ID().",'".$cl[1]->getName().($cnt?" ".($cnt+1):"")."',$c);";	
	if(!queryDB($sql)){
		return "NAK";
	}
	return "OK";
}

function getClubs($opt){
	$rm = new racerManager; 
	$cl = $rm->getClub("");
	echo "<select id=\"club\">";
		for ($i=0;$i<count($cl);$i++){
			echo "<option id=\"club\" value=\"",$cl[$i]->getID(),"\">",$cl[$i]->getName(),"</option>";
		}
	echo "</select> ";
	echo "<img src=\"./images/CHECK_24x24.png\" 
			onmouseover=\"document.body.style.cursor = 'pointer'\"
			onmouseout = \"document.body.style.cursor = 'default'\" 
			onclick=\"addETeam($opt,'club')\" title=\"Apstiprināt\" alt=\"Apstiprināt\">";
}

function delteam($et,$r){

	$sql ="
		select *
		from `enduro_application`
		where `team_c` = $et and `race_id` <> $r;";
	
	$q = queryDB($sql);	
	if(mysql_num_rows($q)){		
		echo prntWarn("Komandu nav iespējams dzēst! Tā ir ieskaitīta citas sacensības vērtējumā.");
		return;
	} 
	$sql = "update `enduro_application` set `team_c` = null where `team_c` = $et and `race_id` = $r;";
	queryDB($sql);
	$sql = "delete from `enduro_team` where `ET_ID` = $et and `et_id` not in (select distinct `team_c` from `enduro_application` where `team_c` is not null);";
	queryDB($sql);	
}

function delteamracer($ea){
	$sql = "update `enduro_application` set `team_c` = NULL where `ERA_ID` = $ea";
	queryDB($sql);
}

function changeTeam($id,$val,$mode){
	$sql="
		UPDATE `enduro_application`
		SET `".($mode=="club" ? "TEAM_C" : "PROD_C")."`= $val
		WHERE `ERA_ID` = $id
	";
	if(!queryDB($sql)){
		return "NAK";
	}
	return "OK";
}

function printTeams($opt){
	$rm = new raceManager;
	$cm = new champManager;
	$em = new EnduroManager;
	$r = $rm->getRace("","","",1,3,"","");
	$cha = 0;
	if (count($r)>1){
		echo "<font style=\"font-size:15px;font-weight:bold\"></font><font style=\"font-size:15px\">sacensības: </font>";
		echo "<select onchange=\"window.location = this.options[this.selectedIndex].value;\">";
			for($i=0;$i<count($r);$i++) {
				$cmp = $cm->getChamps($r[$i]->getCH_ID(),"","","");
				echo "<option value=\"?rm_func=enduro&rm_subf=teams&opt=",$r[$i]->getID(),"\" ";
				if($opt == $r[$i]->getID()) {
					echo " selected ";
					$cha = $r[$i]->getCH_ID();
				}
				echo ">";					
					echo $cmp[0]->getName(),", ", $r[$i]->getName()," - ",$r[$i]->getDate();
				echo "</option>";
			}				
		echo "</select>";
		
		echo "<input type=\"hidden\" name = \"raceid\" value=\"",($opt ? $opt: $r[0]->getID()),"\">";
		$cha = $opt ? $cha : $r[0]->getCH_ID();
		$opt = $opt ? $opt : $r[0]->getID();		
	} elseif(count($r)==1) {
		$cmp = $cm->getChamps($r[0]->getCH_ID(),"","","");
		echo "<font style=\"font-size:15px;font-weight:bold\"></font><font style=\"font-size:15px\">sacensības: </font><font style=\"font-size:18px;color:blue;font-weight:bold\">",
			 $cmp[0]->getName(),", ",$r[0]->getName() ," - ",$r[0]->getDate(),"</font>";
		echo "<input type=\"hidden\" name = \"raceid\" value=\"",$r[0]->getID(),"\">";
		$opt = $r[0]->getID();
		$cha = $r[0]->getCH_ID();
	} else {
		echo prntWarn("Nav izvēlētās sacensības!");
		return;
	}
		
	echo "<br><br>";
	echo "<b style=\"font-size:15px;font-weight:bold\">Klubu komandas</b> ";
	echo "<img src=\"./images/Team_32x32.png\" width=\"16px\" height=\"16px\" title=\"Junā komanda\" alt=\"+\" 
			onclick=\"showAddET('divNew',$opt,this)\"
			onmouseover=\"document.body.style.cursor = 'pointer'\"
			onmouseout = \"document.body.style.cursor = 'default'\"	
		>";
	echo "<div class=\"highslide-maincontent\" id=\"divNew\"></div>";
	echo "<br>";

	$sql="
		SELECT *
		FROM  `enduro_team` et							
		WHERE et.`champ_id` = ".$cha."
		order by `name`";
	$qr = queryDB($sql);
	while($row = mysql_fetch_array($qr,MYSQL_ASSOC)){		
		echo "<br><a onclick=\"confDelGet('Tiešām dzēst?','?rm_func=enduro&rm_subf=delteam&opt=$opt&et=",$row["ET_ID"],"')\"
			onmouseover=\"document.body.style.cursor = 'pointer'\"
			onmouseout = \"document.body.style.cursor = 'default'\"
		>";
			echo "<img src=\"./images/RedCross_16x16.png\" title=\"Dzēst komandu\" alt=\"X\">";
		echo "</a>";

		echo "<img src=\"./images/User_32x32.png\" width=\"16px\" height=\"16px\" title=\"Pielikt sportistu\" alt=\"+\"
			onclick=\"showAddETMemeber('divet',",$row["ET_ID"],",$opt,this)\"
			onmouseover=\"document.body.style.cursor = 'pointer'\"
			onmouseout = \"document.body.style.cursor = 'default'\"	
		>";
			echo "<b>",$row["NAME"],"</b><br>";
		echo "<div class=\"highslide-maincontent\" id=\"divet",$row["ET_ID"],"\"></div>";
		echo "<table border = \"1\" style=\"border-collapse:collapse\">";
		$sql = "
			select 
				ea.`ERA_ID`,
				c.`NAME` as CLASS_NAME,				
				pd.`pf_rm_f_name` as F_NAME,
				pd.`pf_rm_l_name` as L_NAME,
				ea.`NR`
			from `enduro_application` ea
				inner join `d_race` r on (ea.`race_id` = r.`race_id`)
				inner join `d_class` c on (c.`classid` = ea.`class_id`)
				inner join `phpbb_profile_fields_data` pd on (pd.`user_id` = ea.`racer_id`)
			where 
				ea.`team_c` = ".$row["ET_ID"]." and
				ea.`race_id` = ".$opt.";";
		
		$q = queryDB($sql);
		if(mysql_num_rows($q) == 0){
			echo "</table>";
			continue;
		} 		
		while($row1 = mysql_fetch_array($q,MYSQL_ASSOC)){
			echo "<tr>";
				echo "<td width=\"25px\">",$row1["NR"];
				echo "<td width=\"150px\">",$row1["F_NAME"]," ",$row1["L_NAME"];
				echo "<td width=\"40px\">",$row1["CLASS_NAME"];
				echo "<td width=\"17px\">";
				echo "<a onclick=\"confDelGet('Tiešām izņemt?','?rm_func=enduro&rm_subf=delteamracer&opt=$opt&ea=",$row1["ERA_ID"],"')\"
					onmouseover=\"document.body.style.cursor = 'pointer'\"
					onmouseout = \"document.body.style.cursor = 'default'\"
				>";
					echo "<img src=\"./images/RedCross_16x16.png\" title=\"Izņemt sportistu\" alt=\"X\">";
				echo "</a>";
		}		
		
		echo "</table>";
	}
	/*
	//RAZOTAJI
	echo "<h1 style=\"font-size:15px;font-weight:bold\">Ražotāja komandas</h1>";
	$moto = getMoto();
	for($i=1;$i<count($moto);$i++){

		$sql="
			SELECT *,cl.name as class_name 
			FROM  `enduro_application` ea 
				inner join `phpbb_profile_fields_data` u on (u.`user_id` = ea.`racer_id`)
				inner join `d_class` cl on (cl.`classid` = ea.`class_id`)
			WHERE ea.`race_id` = $opt and u.`pf_rm_moto_name` = ".($i+1);		
		$qr = queryDB($sql);
		
		if(mysql_num_rows($qr) == 0){
			continue;
		}
		
		echo "<b>",$moto[$i],"</b>";
		echo "<table border = \"1\" style=\"border-collapse:collapse\">";
			while($row=mysql_fetch_array($qr,MYSQL_BOTH)){
				echo "<tr>";
					echo "<td width=\"17px\">";
						if($row['PROD_C'] == 1){							
							echo "<img src=\"./images/Green_bubble_24x24.png\" alt=\"V\" title=\"Iekļauts\" height=\"16px\" width=\"16px\"
								onmouseover=\"document.body.style.cursor = 'pointer'\"
								onmouseout = \"document.body.style.cursor = 'default'\"
								onclick=\"changeTeamState(this,'prod',",$row['ERA_ID'],");\"
							>";
						} else {
							echo "<img src=\"./images/Red_bubble_24x24.png\" alt=\"X\" title=\"Nav iekļauts\" height=\"16px\" width=\"16px\"
								onmouseover=\"document.body.style.cursor = 'pointer'\"
								onmouseout = \"document.body.style.cursor = 'default'\"
								onclick=\"changeTeamState(this,'prod',",$row['ERA_ID'],");\"
							>";
						}
					echo "<td width=\"25px\">",$row['pf_rm_sport_nr'];
					echo "<td width=\"150\">",$row['pf_rm_f_name'];
					echo " ",$row['pf_rm_l_name'];
					echo "<td width=\"40px\">",$row['class_name'];
			}
		echo "</table>";
	}*/
}	

function copyracers(){		
	
	$sql = "select * 
			from `enduro_race_day` 
			where 
				`race_id` = ".$_SESSION['params']['opt']." and
				`START_DATE` < (select `start_date` from `enduro_race_day` where `erd_id` = ".$_SESSION['params']['day'].")
			order by `start_date` desc
			limit 0,1";
				
	$r = queryDB($sql);
	if($row = mysql_fetch_array($r,MYSQL_ASSOC)){
		
		$sql = "update `enduro_day_racer` 
				set `PAIR` = null, `POSITION` = null, `LK0` = null
				where `erd_id` = ".$_SESSION['params']['day'];
		queryDB($sql);

		$sql = "select * 
				from `enduro_day_racer`
				where `erd_id` = ".$row['ERD_ID'];
		$r = queryDB($sql);
	
		while($row1 = mysql_fetch_array($r,MYSQL_ASSOC)){
			
			$sql = "update  `enduro_day_racer`
					set 
						`PAIR` = ".$row1['PAIR'].",
						`POSITION` = ".$row1['POSITION']."						
					where `ea_id` = ".$row1['EA_ID']." and
						  `erd_id` = ".$_SESSION['params']['day'];	
			queryDB($sql);			
		}	
		
		$sql ="SELECT * 
			   FROM  `enduro_race_class_day`
			   WHERE `ERD_ID` = ".$row['ERD_ID'];			   
		$r = queryDB($sql);	   
		while($row1 = mysql_fetch_array($r,MYSQL_ASSOC)){
			$sql = "
				Update `enduro_race_class_day`
				SET
					`START_ORDER` = ".$row1['START_ORDER'].",
					`SEPARATOR` = ".$row1['SEPARATOR']."
				WHERE 
					`erd_id` = ".$_SESSION['params']['day']." and
					`CLASS_ID` = ".$row1['CLASS_ID'];					
			queryDB($sql);
		}
		offset_change($_SESSION['params']['day'],$row['OFFSET_MIN'],"","");
	}
}

function unpair(){
	$sql = "update  `enduro_day_racer` edr
			set 
				`pair` = null, 
				`position` = null
			where 
				`pair` = ".($_SESSION['params']['pair']+1)." and 
				`position` = ".($_SESSION['params']['slot']+1)." and 
				`erd_id` = ".$_SESSION['params']['day']." and 
				`ea_id`  in (
					select `era_id` 
					from `enduro_application` 
					where `class_id` = ".$_SESSION['params']['class']."
				)";
				
	queryDB($sql);
	
}

function testignore($d,$t,$c,$v,$l){
	if(!$v){
		$sql = "insert into `enduro_test_ignore` (`ERD_ID`,`TEST_ID`,`CLASS_ID`,`LAP`) values ($d,$t,$c,$l);";
	} else {
		$sql = "delete from `enduro_test_ignore` where `ERD_ID` = $d and `TEST_ID` = $t and `CLASS_ID` = $c and `LAP` = $l;";
	}
	
	//echo $sql;
	if(!queryDB($sql)){
		return "NAK";
	}
	return "OK";
}

function savetestignore(){

	//echo $_SESSION['params']['names'];
	//print_r($_SESSION['params']);
	
	$sql ="
		delete from `enduro_test_ignore`
		where `erd_id` = ".$_SESSION['params']['day'].";
	";
	
	queryDB($sql);
	
	$names = explode(";",$_SESSION['params']['names']);
	for($i=0;$i<count($names);$i++){
		if($names[$i]){
			if($_SESSION['params'][$names[$i]]){
				$d = explode("x",$names[$i]);			
				$sql = "
					insert into `enduro_test_ignore` (`erd_id`,`test_id`,`lap`)
						values (".$d[1].",".$d[2].",".$d[3].");";
				queryDB($sql);
			}			
		}
	}	
}

function deltestresult(){
	$sql="delete from `enduro_test_result` where `TASK` = ".$_SESSION['params']['test'];
	queryDB($sql);
}

function importresults(){
	$fname = $_FILES["file"]['tmp_name'];
	if(!$fname){
		echo "<h1 style=\"color:red;font-weight:bold\">Nav pievienots fails!</h1>";
		return;
	}
	
	$handle = fopen($fname, "r");
	
	$lines = array();
	while (!feof($handle)) {
        $buffer = fgets($handle, filesize($fname));
		array_push($lines,$buffer);
    }	
	fclose($handle);
	
	$racers=array();
	for($i=4;$i<count($lines);$i++){
		$items = explode("|",$lines[$i]);
		$nr = str_replace("\"","",$items[1]);
		$time = str_replace("\"","",$items[4]);
		$racers[$nr][count($racers[$nr])] = $time;
	}
	
	$keys = array_keys($racers);
	for($i=0;$i<count($keys);$i++){
		$sql = "
			SELECT * FROM `enduro_day_racer` edr
			inner join `enduro_application` ea on (edr.`ea_id` = ea.`era_id` ) 
				inner join `phpbb_profile_fields_data` pd on (pd.`user_id` = ea.`racer_id`)
			where pd.`pf_rm_sport_nr` = '".$keys[$i]."' and edr.`erd_id` = ".$_SESSION['params']['day'].";";
		
		$r = queryDB($sql);
		if($row1 = mysql_fetch_array($r, MYSQL_ASSOC)){
			for($j=0;$j<count($racers[$keys[$i]]);$j++){
				$sql="	
					insert into `enduro_test_result` (`EDR_ID`,`LAP`,`RESULT`,`TASK`)
						values (".$row1['EDR_ID'].",".($j+1).",'00:".$racers[$keys[$i]][$j]."',".$_SESSION['params']['task'].")";				
				queryDB($sql);
			}
		}
	}	
}

function savetestres(){
	$names = explode(";",$_SESSION['params']['names']);
	for ($i=0;$i<count($names);$i++){
		if($names[$i]){
			$name = explode("x",$names[$i]);
			$values = explode(".",$_SESSION['params'][$names[$i]]);
			if($name[4] == -1){
				$sql = "insert into `enduro_test_result` (`EDR_ID`,`LAP`,`RESULT`,`SEC_PARTS`,`TASK`) 
						values (".$name[1].",".$name[2].",'".$values[0]."',".$values[1].",".$name[3].")";
				queryDB($sql);
			} else {
				$sql = "update `enduro_test_result` 
						set `RESULT` = '".$values[0]."',`SEC_PARTS` = ".$values[1]."						
						where `ETR_ID` = ".$name[4];
				queryDB($sql);
			}			
		}
	}
}

function testinp($opt){
	$rcm = new RacerManager;
	$rm = new raceManager;
	$em = new EnduroManager;
	$cm = new champManager;
	
	$names = "";
	$day=$_SESSION['params']['day'];
	$cl = $em->getERCD($opt,$_SESSION['params']['day'],$_SESSION['params']['c']=="all" ? "":$_SESSION['params']['c']);
	$et = $em-> getEt($_SESSION['params']['test'],"");
	$r = $rm->getRace($cl[0]->RACE_ID,"","","","","","","");
	$erd = $em->getERD1($day);
	
	echo "<a href=\"?rm_func=enduro&rm_subf=laiks&opt=$opt&day=$day\"><b>Rezultātu ievade</b></a>";
	echo " -> <b>",$r[0]->getName(),"</b>";
	echo " -> <b>",$erd[0]->START_DATE,"</b>";
	echo " -> <b>",$_SESSION['params']['c']=="all" ? "Visas klases" : $cl[0]->NAME." klase","</b>";
	echo " -> <b>",$et[0]->NAME," tests";
	
	echo "<hr>";

	echo "<form action =\"index.php\" method=\"post\">";
		if (count($cl)>0){
			for($n=0;$n<count($cl);$n++){
									
				echo "<br><b>",$cl[$n]->NAME,"</b><br>";
				echo "<table border=\"1\">";
					echo "<tr>";
						echo "<td>&nbsp";
						for($i=0;$i<$cl[$n]->ENDURO_LAPS;$i++){
							echo "<td>",$et[0]->NAME,$i+1;
						}
				
					$rcr = $em->getEnduroDayFreeRacerList1($day,$cl[$n]->CLASS_ID,"","");
					for($i=0;$i<count($rcr);$i++){
						echo "<tr><td>",$rcr[$i]->getNr();
						for($j=0;$j<$cl[$n]->ENDURO_LAPS;$j++){
							$edr = $em->getEDRByracer($day,$rcr[$i]->getUserID());
							
							$sql = "select *
									from `enduro_test_result`
									where `edr_id` = ".$edr[0]->EDR_ID." and `lap` = ".($j+1)." and `task` = ".$et[0]->ET_ID.";";
							$r = queryDB($sql);
							$row = mysql_fetch_array($r, MYSQL_ASSOC);
							
							$name = "etrx".$edr[0]->EDR_ID ."x".($j+1)."x".$et[0]->ET_ID ."x".($row ? $row['ETR_ID']:"-1");
							
							echo "<td><input 
										type=\"text\" 
										size=\"11\" 
										maxlength=\"11\" 
										name=\"$name\"
										value=\"",($row ? $row['RESULT'].".".($row['SEC_PARTS'] < 10 ? "0" : "").$row['SEC_PARTS']  : "00:00:00.00"),"\"";
							echo (($row ? $row['RESULT'].".".($row['SEC_PARTS'] < 10 ? "0" : "").$row['SEC_PARTS']  : "00:00:00.00") != "00:00:00.00" ? "style=\"background-color: #99FF99\"" : "style=\"background-color: #ff99ff\"");
							echo		" onkeypress=\"resultGlow(this);\" onchange=\"resultGlow(this);\" onfocus=\"foc(this);\" onkeyup=\"kpressed(this);\" onblur=\"kpressed(this);\">";
							$names.=$name.";";
						}
					}
				echo "</table>";
			}
		}
		
		echo "<input name=\"names\" type=\"hidden\" value=\"$names\">";		
		echo "<input name=\"rm_subf\" type=\"hidden\" value=\"savetestres\">";
		echo "<input name=\"rm_func\" type=\"hidden\" value=\"enduro\">";
		echo "<input name=\"opt\" type=\"hidden\" value=\"$opt\">";
		echo "<input name=\"day\" type=\"hidden\" value=\"$day\">";
		echo "<hr><center><input type=\"submit\" value=\"Saglabāt\"></center>";
	echo "</form>";
	
}

function savelkimp(){
	$lk = explode(";",$_SESSION['params']['lk']);
	for($i=0;$i<count($lk);$i++){
		if($lk[$i]){
			$id=explode("x",$lk[$i]);
			$sql = "update `enduro_day_racer` set `lk` = ".($_SESSION['params'][$lk[$i]] ? "'".$_SESSION['params'][$lk[$i]]."'" : " null ")."
					where `edr_id` = ".$id[1]."";
			//echo $sql;
			queryDB($sql);
		}
	}
	$lk = explode(";",$_SESSION['params']['lk0']);
	for($i=0;$i<count($lk);$i++){
		if($lk[$i]){
			$id=explode("x",$lk[$i]);
			$sql = "update `enduro_day_racer` set `lk0k` = ".($_SESSION['params'][$lk[$i]] ? "'".$_SESSION['params'][$lk[$i]]."'" : " null ")."
					where `edr_id` = ".$id[1]."";
			queryDB($sql);
		}
	}
	$ids = explode(";",$_SESSION['params']['ids']);
	for($i=0;$i<count($ids);$i++){
		if($ids[$i]){
			$sql = "update `enduro_day_racer` 
					set `DQ`  = ".($_SESSION['params']["DQx". $ids[$i]] ? 1 : 0)." ,
					    `IZS` = ".($_SESSION['params']["IZSx".$ids[$i]] ? 1 : 0)." 
					where `edr_id` = ".$ids[$i]."";
					//echo $sql;
			queryDB($sql);
		}
	}
}

function lkinp($opt){
	$rcm = new RacerManager;
	$rm = new raceManager;
	$em = new EnduroManager;
	$cm = new champManager;	
	
	$cl = $em->getERCD($opt,$_SESSION['params']['day'],$_SESSION['params']['c']=="all" ? "":$_SESSION['params']['c']);
	$day=$_SESSION['params']['day'];
	$r = $rm->getRace($cl[0]->RACE_ID,"","","","","","","");
	$erd = $em->getERD1($day);
	
	$slot = $r[0]->slots;
	
	echo "<a href=\"?rm_func=enduro&rm_subf=laiks&opt=$opt&day=$day\"><b>Rezultātu ievade</b></a>";
	echo " -> <b>",$r[0]->getName(),"</b>";
	echo " -> <b>",$erd[0]->START_DATE,"</b>";
	echo " -> <b>",$_SESSION['params']['c']=="all" ? "Visas klases" : $cl[0]->NAME." klase","</b>";
	
	echo "<hr>";
	echo "<form action=\"index.php\" method=\"post\">";
		$lk0 = "";
		$lk="";		
		$ids = "";
		echo "<table  border = \"1\">";
		for($i=0;$i<count($cl);$i++){
			$cnt = $em->getEnduroDayRacerCNT($day,$cl[$i]->CLASS_ID);
			if ($cnt > 0){
				echo "<tr>";
					echo "<td >";
						echo $cl[$i]->NAME;			
					echo "<td>";								
						echo "<table border=\"1\">";
							echo "<tr>";
								echo "<td width=\"50\">LK0";
									echo str_repeat("
									  <td width=\"30\" colspan=\"2\">NR
									  <td width=\"50\">LK0 Laiks
									  <td width=\"50\">LK",$slot);
									  
									for($j=0;$j<$cnt/$slot;$j++){
										echo "<tr>";
											$sql = "select `lk0` from `enduro_day_racer` 
													where `erd_id` = $day and `pair` = ". ($j+1) ."
													and `ea_id` in (select `era_id` from `enduro_application` where `class_id` = ".$cl[$i]->CLASS_ID.")";
													
											$r = queryDB($sql);
											$row = mysql_fetch_array($r, MYSQL_ASSOC);
											echo "<td>",substr($row["lk0"],0,5);
											
											for($x=0;$x<$slot;$x++){
												$rcr = $em->getEnduroDayFreeRacerList1($day,$cl[$i]->CLASS_ID,$j+1,$x+1);
																							
												if($rcr[0]){
													$edr = $em->getEDRByracer($day,$rcr[0]->getUserID());
													$ids.=$edr[0]->EDR_ID.";";
													echo "<td width=\"30\">
														<font style=\"font-size:14px;font-weight:bold;\"", $rcr[0]->getNr() ? ">".$rcr[0]->getNr()."</font>" : " color=\"red\">NAV</font>";
													echo "<td align=\"right\">";
														echo "Izs<input type=\"checkbox\" title=\"Izstājies\"
															",$edr[0]->IZS ? " checked ": "","
															name = \"IZSx",$edr[0]->EDR_ID,"\"
														>";
														echo "<br>";
														echo "DQ<input type=\"checkbox\" title=\"DQ\" 
															",$edr[0]->DQ ? " checked ": "","
															name = \"DQx",$edr[0]->EDR_ID,"\"
														>";
													echo "<td><input 
															type=\"text\" 
															size=\"8\" 
															maxlength=\"8\" 
															name=\"lk0kx",$edr[0]->EDR_ID,"\"
															value=\"",$edr[0]->LK0K ? $edr[0]->LK0K : "00:00:00","\"
														>";	
													$lk0.="lk0kx".$edr[0]->EDR_ID .";";	
													echo "<td><input 
															type=\"text\" 
															size=\"8\" 
															maxlength=\"8\" 
															name=\"lkx",$edr[0]->EDR_ID,"\"
															value=\"",$edr[0]->LK ? $edr[0]->LK : "00:00:00","\"
														>";	
													$lk.="lkx".$edr[0]->EDR_ID .";";		
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
	
	echo "<input name=\"ids\" type=\"hidden\" value=\"$ids\">";
	echo "<input name=\"lk0\" type=\"hidden\" value=\"$lk0\">";
	echo "<input name=\"lk\" type=\"hidden\" value=\"$lk\">";
	echo "<input name=\"rm_subf\" type=\"hidden\" value=\"savelkimp\">";
	echo "<input name=\"rm_func\" type=\"hidden\" value=\"enduro\">";
	echo "<input name=\"opt\" type=\"hidden\" value=\"$opt\">";
	echo "<input name=\"day\" type=\"hidden\" value=\"$day\">";
	echo "<hr><center><input type=\"submit\" value=\"Saglabāt\"></center>";
	echo "</form>";
}

function timeInput($opt){

	printAactualRaceMenu(3);
	
	$rcm = new RacerManager;
	$rm = new raceManager;
	$em = new EnduroManager;
	$cm = new champManager;
	
	$r = $rm->getRace($opt ? $opt : "","","","","",1,0);
	if (!$r || $r[0]->getType() <> 3){
		echo "<h1 align=\"center\" style=\"color:red;font-weight:bold\">Nav nevienas aktīvas sacensības!</h1>";
		return; 
	}
	$opt = $r[0]->getID();
	$erd = $em->getERD($opt);
	
	if ($erd){
	} else {
		echo "<h1 align=\"center\" style=\"color:red;font-weight:bold\">Sacensībām nav nevienas sacensības dienas!</h1>";
		return;
	}
	$day = $_SESSION['params']['day'];
	$erday = $erd[0];
	
	echo "sacensības diena: ";
		echo "<select onchange=\"window.location = this.options[this.selectedIndex].value;\">";
		for ($i=0;$i<count($erd);$i++){
			echo "<option value = \"index.php?rm_func=enduro&rm_subf=laiks&opt=$opt&day=",$erd[$i]->ERD_ID,"\"";
			if($day){
				if($day == $erd[$i]->ERD_ID){
					echo " selected ";
					$erday = $erd[$i];
				}
			} elseif (substr($erd[$i]->START_DATE,0,10) == date("Y-m-d")) {
				echo " selected ";
				$erday = $erd[$i];
				$day = $erd[$i]->ERD_ID;
			}
			echo ">";
				echo $erd[$i]->START_DATE;
			echo "</option>";
		}
		if(!$day){$day=$erd[0]->ERD_ID;}
		echo "</select>";
		
		echo " | <a href=\"?rm_func=reslt&rm_subf=publishDayResult&day=$day\">".ORG_RACE_DAY_RESULT_PUBLISH."</a>";
	
	$cl = $em->getERCD($opt,$day,"");
	$task = $em->getEt("",$opt);	
	
	echo "<br><br><b><font style=\"font-size:16px\">Kontrollaiki</font></b><br>";
	for($i=0;$i<count($cl);$i++){
		echo "<a href=\"?rm_func=enduro&rm_subf=lkinp&day=$day&c=",$cl[$i]->CLASS_ID,"&opt=$opt\">";
			echo $cl[$i]->NAME;
		echo "</a>",(($i+1) < count($cl) ? " | " : "");
	}
	echo "<br><a href=\"?rm_func=enduro&rm_subf=lkinp&day=$day&c=all&opt=$opt\" style=\"font-weight:bold\">";
		echo "Visas klases";
	echo "</a>";
	
	echo "<br><br><b><font style=\"font-size:16px\">Testu laiki</font></b><br>";
	echo "<table border = \"1\">";
		echo "<tr style=\"background-color:#cccccc;\">";
		for($i=0;$i<count($task);$i++){
			echo "<td><b>",$task[$i]->NAME,"</b>";
		}
		for($i=0;$i<count($cl);$i++){
			echo "<tr>";
			for($j=0;$j<count($task);$j++){
				echo "<td><a href=\"?rm_func=enduro&rm_subf=testinp&day=$day&c=",$cl[$i]->CLASS_ID,"&opt=$opt&test=",$task[$j]->ET_ID,"\">";
					echo "",$cl[$i]->NAME;
				echo "</a>";
			}
		}
		echo "<tr style=\"background-color:#cccccc;\">";
		for($j=0;$j<count($task);$j++){
			echo "<td><a href=\"?rm_func=enduro&rm_subf=testinp&day=$day&c=all&opt=$opt&test=",$task[$j]->ET_ID,"\">";
				echo "Visas klases";
			echo "</a>";
		}

/* 		echo "<tr >";
		for($j=0;$j<count($task);$j++){
			echo "<td>";
				echo "<form action=\"index.php\" method=\"POST\" enctype=\"multipart/form-data\">";
					echo "<input type=\"file\" name=\"file\">";
					echo "<input type=\"submit\" value=\"OK\">";
					
					echo "<input type=\"hidden\" name=\"rm_func\" value=\"enduro\">";
					echo "<input type=\"hidden\" name=\"rm_subf\" value=\"importresults\">";
					echo "<input type=\"hidden\" name=\"task\" value=\"",$task[$j]->ET_ID,"\">";
					echo "<input type=\"hidden\" name=\"day\" value=\"$day\">";
					echo "<input type=\"hidden\" name=\"opt\" value=\"$opt\">";
				echo "</form>";
		} */
		echo "<tr >";
		for($j=0;$j<count($task);$j++){
			echo "<td align=\"center\">";
			echo "<a onclick=\"confDelGet('Tiešām dzēst?','?rm_func=enduro&rm_subf=deltestresult&day=$day&opt=$opt&test=",$task[$j]->ET_ID,"')\"
				onmouseover=\"document.body.style.cursor = 'pointer'\"
				onmouseout = \"document.body.style.cursor = 'default'\"
			>";
				echo "<img src=\"images/CROSS_24x24.png\" border=\"0\" alt=\"X\" title=\"Izdzēst testa rezultātus\">";
			echo "</a>";
		}
	echo "</table>";

	if($erday->MOTOCROSS){
		echo "<br><br>";
			echo "<b><font style=\"font-size:16px\">Motokrosa punkti</font></b><br>";	
			echo "<a href=\"?rm_func=enduro&rm_subf=motoinp&day=$day&race=$opt\">Ievadīt motkorosa punktus</a>";
	}

	echo "<br><br>";
		echo "<b><font style=\"font-size:16px\">Iepazīšanas apļi</font></b><br>";
	if($cl){
		$sql = "
			select max(`enduro_laps`) as cnt
			from `enduro_race_class_day`
			where `erd_id` = $day;
		";
		$r = queryDB($sql);
		$row = mysql_fetch_array($r, MYSQL_ASSOC);
		$Laps['max'] = $row['cnt'];
		
		$sql = "
			SELECT `class_id`,`enduro_laps` from `enduro_race_class_day`
			where `ERD_ID` = $day
		";
		$r = queryDB($sql);
		while($row = mysql_fetch_array($r, MYSQL_ASSOC)){
			$Laps[$row['class_id']] = $row['enduro_laps'];
		}
		
		echo "<table border = \"1\" style=\"border-collapse:collapse\">";
			echo "<tr><td>";
			for($i=0;$i<count($cl);$i++){
				echo "<td width=\"50px\">",$cl[$i]->NAME;
			}
			for($j=0;$j<count($task);$j++){
				for($k=0;$k<$Laps['max'];$k++){
					echo "<tr><td>",$task[$j]->NAME,$k+1;
					
					for($i=0;$i<count($cl);$i++){
						if($k>=$Laps[$cl[$i]->CLASS_ID]){
							echo "<td width=\"50px\" align=\"center\" valign=\"middle\">";
								echo "<img src=\"./images/RedCross_16x16.png\" Title=\"Nav paredzēts\" alt = \"X\">";
						} else {
							echo "<td width=\"50px\" align=\"center\" valign=\"middle\">";
							
							$sql = "
								SELECT * from `enduro_test_ignore`
								where `ERD_ID` = $day and `CLASS_ID` = ".$cl[$i]->CLASS_ID." and `TEST_ID` = ".$task[$j]->ET_ID." and `LAP` = ".($k+1);
								//echo $sql;
								$r = queryDB($sql);
							if(mysql_num_rows($r)>0){
								echo "<img src=\"./images/Red_bubble_24x24.png\" Title=\"Nav ieskaitē\" alt = \"X\" height=\"16px\" width=\"16px\"
								onmouseover=\"document.body.style.cursor = 'pointer'\"
								onmouseout = \"document.body.style.cursor = 'default'\"
								onclick=\"testIgnore(this,$day,",$task[$j]->ET_ID,",",$cl[$i]->CLASS_ID,",",$k+1,");\"
							>";
							} else {
								echo "<img src=\"./images/Green_bubble_24x24.png\" Title=\"Ieskaitē\" alt = \"O\" height=\"16px\" width=\"16px\"
								onmouseover=\"document.body.style.cursor = 'pointer'\"
								onmouseout = \"document.body.style.cursor = 'default'\"
								onclick=\"testIgnore(this,$day,",$task[$j]->ET_ID,",",$cl[$i]->CLASS_ID,",",$k+1,");\"
							>";
							}
						}
					}
				}
			}
		echo "</table>";
	}
}

function put_separator(){
	$sql = "update `enduro_race_class_day` set `separator` = ".$_SESSION['params']['val']."
			where `ercd_id` = ".$_SESSION['params']['id'];
	queryDB($sql);
	echo 1;
}

function erd_racer_change(){
	$e1 = explode("x",$_SESSION['params']['e1']);
	$e2 = explode("x",$_SESSION['params']['e2']);
	
	$sql = "select `EDR_ID` ,`lk0`
			from `enduro_day_racer`
			where `erd_id` = ".$e1[1]." and
				  `pair` = ".$e1[3]." and 
				  `position` = ".$e1[4]." and
				  `ea_id` in (select `era_id` from `enduro_application` where `class_id` = ".$e1[2].")";				  
	$r = queryDB($sql);
	$row = mysql_fetch_array($r, MYSQL_ASSOC);
	
	$sql = "select `EDR_ID` ,`lk0`
			from `enduro_day_racer`
			where `erd_id` = ".$e2[1]." and
				  `pair` = ".$e2[3]." and 
				  `position` = ".$e2[4]." and
				  `ea_id` in (select `era_id` from `enduro_application` where `class_id` = ".$e2[2].")";
	$r = queryDB($sql);
	$row1 = mysql_fetch_array($r, MYSQL_ASSOC);
	
	$sql = "update `enduro_day_racer` set `pair` = ".$e1[3].", 
										  `position` = ".$e1[4].",
										  `lk0` = '".($row['lk0'] ? $row['lk0'] : "00:00:00")."'
			where `edr_id` = ".$row1["EDR_ID"];
	//echo $sql;
	queryDB($sql);
	$sql = "update `enduro_day_racer` set `pair` = ".$e2[3].", 
										  `position` = ".$e2[4].",
										  `lk0` = '".($row1['lk0'] ? $row1['lk0'] : "00:00:00")."'
			where `edr_id` = ".$row["EDR_ID"];
	//echo $sql;
	queryDB($sql);
	echo 1;
}

function rcer_offset_change(){
	return offset_change($_SESSION['params']['d'],"",$_SESSION['params']['val'],$_SESSION['params']['p'] ."|". $_SESSION['params']['c']);
}

function offset_change($day,$val,$start_time,$start_pair){	
	$ret = 1;
	if($val){
		$sql = "update `enduro_race_day` set `OFFSET_MIN` = $val where `erd_id` = $day";
		queryDB($sql);
	}
	
	$sql = "select * from `enduro_race_day` where `erd_id` = $day";
	$r = queryDB($sql);
	$row = mysql_fetch_array($r,MYSQL_ASSOC);
	if(!$val){
		$val = $row['OFFSET_MIN'];
	}
	
	$h = $start_time ? substr($start_time,0,2): substr($row['START_DATE'],11,2);
	$m = $start_time ? substr($start_time,3,2): substr($row['START_DATE'],14,2);
	
	$h = ($m - $val) < 0 ? $h-1:$h; $h = $h < 0 ? "00" : $h;
	$m = ($m - $val) < 0 ? $m = 60 - abs($m-$val) : $m - $val;
	
	$sql = "SELECT edr.`edr_id`,edr.`pair`,ercd.`start_order`,ercd.`class_id`
			FROM `enduro_day_racer` edr
				inner join `enduro_application` ea on (ea.`era_id` = edr.`ea_id`)
					inner join `enduro_race_class_day` ercd on (ercd.`class_id` = ea.`class_id` and ercd.`erd_id` = edr.`erd_id`)
			where edr.`erd_id` = $day
			order by ercd.`start_order` asc, edr.`pair` asc";	
	$r = queryDB($sql);
	
	$pair =	$class = $p = $c = -1;
	if($start_pair){
		$tmp = explode("|",$start_pair);
		$p = $tmp[0];
		$c = $tmp[1];
	}
	$do = !$start_pair;
	
	while ($row = mysql_fetch_array($r,MYSQL_ASSOC)){
		if(($row['pair'] == $p) && ($row['class_id'] == $c)){
			$do = 1;
		}
		if ($do){
			if(($row['pair'] != $pair) || ($row['start_order'] != $class)){
				$h = ($m + $val) >= 60 ? $h+1 : $h; $h = $h > 24 ? "01" : $h;
				$m = ($m + $val) >= 60 ? $m+$val-60 : $m + $val;
				$pair = $row['pair'];
				$class = $row['start_order'];
			}
			$time = $h.":".$m.":00";
			$sql = "update `enduro_day_racer`
						set `LK0` = '$time'
					where `edr_id` = ".$row['edr_id'];		
			//return $sql;
			if (!queryDB($sql)){
				$ret = 0;
			}
		}
	}
	return $ret;
}

function moveClass(){
	$day = $_SESSION['params']['day'];
	$ordr= $_SESSION['params']['ordr'];
	$up = $_SESSION['params']['up'];
	$class = $_SESSION['params']['class'];
	
	$sql = "select ".($up ? "max":"min")."(`start_order`) as x from `enduro_race_class_day` ercd
				inner join `enduro_day_racer` edr on (edr.`erd_id` = ercd.`erd_id`)
					inner join `enduro_application` ea on (
						ea.`era_id` = edr.`ea_id` and
						ea.`class_id` = ercd.`class_id`
					)
			where 
				ercd.`erd_id` = $day and `start_order` ".($up ? "<" : ">")." $ordr"  ;
				
	//echo $sql;
	$r = queryDB($sql);
	$row = mysql_fetch_array($r, MYSQL_ASSOC);
	if($row['x']){
		$sql = "update `enduro_race_class_day` set `start_order` = $ordr where `start_order` = ".$row['x']." and `erd_id` = $day";
		//echo $sql;
		queryDB($sql);
		$sql = "update `enduro_race_class_day` set `start_order` = ".$row['x']." where `ercd_id` = ".$_SESSION['params']['id']."";
		//echo $sql;
		queryDB($sql);
		$sql = "update `enduro_day_racer` set `lk0` = null 
				where   `ERD_ID` = $day";
					//echo $sql;
		queryDB($sql);
	}
	offset_change($day,"","","");				
}

function printEnduroApply($opt){
	$sec = new Security;
	if(!$sec->testUserGroup($_SESSION['user']['user_id'],"Sportisti")){
		echo prntWarn(ENDURO_APPLY_AUTH_WARN);
		echo ENDURO_APPLY_AUTH_TEXT;
		return;
	}
	
	$rm = new raceManager;
	$cm = new champManager;
	$em = new EnduroManager;
	$rcm = new RacerManager;
	
	echo "
		<script>
		function fillTeh(v,nr){
	
			
			var teh = v.split(\"^\");
			
			x = document.getElementById(\"teh_Marka\"+nr);
			x.value = teh[0]?teh[0]:null;
			
			x = document.getElementById(\"teh_Model\"+nr);
			x.value = teh[1]?teh[1]:null;
			
			x = document.getElementById(\"teh_V\"+nr);
			x.value = teh[2]?teh[2]:null;
			
			x = document.getElementById(\"teh_T\"+nr);
			x.value = teh[3]?teh[3]:null;
			
		}
</script>
	";
	
	
	
	echo "<form action=\"index.php\" method=\"post\">";
	echo "<table style=\"border: 0px\">";
	
	if ($_SESSION['params']['org']){
		echo "<input type=\"hidden\" name = \"org\" value=\"1\">";
	}
	
	
	$r = $rm->getRace($opt?$opt:"","","",1,$_SESSION['params']['type'],"","");	
	
	if ($r){
		if (count($r)>1){
			
			echo "<tr><td width=\"50px\">".ENDURO_APPLY_RACE;
			echo "<td><select onchange=\"window.location = this.options[this.selectedIndex].value;\">";
				for($i=0;$i<count($r);$i++) {
					$cmp = $cm->getChamps($r[$i]->getCH_ID(),"","","");
					echo "<option value=\"?rm_func=enduro&rm_subf=apply&opt=",$r[$i]->getID(),"&type=",$_SESSION['params']['type'],"\" ";
					if($opt == $r[$i]->getID()) {echo " selected ";}
					echo ">";					
						echo $cmp[0]->getName(),", ", $r[$i]->getName()," - ",$r[$i]->getDate();
					echo "</option>";
				}				
			echo "</select>";
			
			echo "<input type=\"hidden\" name = \"raceid\" value=\"",($opt ? $opt: $r[0]->getID()),"\">";
			$opt = $opt ? $opt: $r[0]->getID();
		} else {
			$cmp = $cm->getChamps($r[0]->getCH_ID(),"","","");			
			echo "<tr><td width=\"50px\">".ENDURO_APPLY_RACE."<td><font style=\"font-size:18px;color:blue;font-weight:bold\">",
				 $cmp[0]->getName(),", ",$r[0]->getName() ," - ",$r[0]->getDate(),"</font>";
			echo "<input type=\"hidden\" name = \"raceid\" value=\"",$r[0]->getID(),"\">";
			$opt = $r[0]->getID();
		}
	} else {
		echo "<tr><td colspan=\"2\" style=\"align:center\"><h1 style=\"color:red;font-weight:bold\">".ENDURO_APPLY_NO_ACTIVE_RACE."</h1>";
		return;
	}
		
	$user = $_SESSION['params']['rcr'] ? $_SESSION['params']['rcr'] : $_SESSION['user']['user_id'];
		
	$apl = $em->getERA("",$opt,"",$user,"");
	//print_r($apl);
	if(!$apl[0]){
		$cl = $cm->getActulaRaceClass($opt);
		if ($cl){			
			echo "<tr><td>".ENDURO_APPLY_CLASS;
			echo "<td><select name=\"class\" style=\"width: 150px;\">";
				for($i=0;$i<count($cl);$i++) {
					echo "<option value=\"",$cl[$i]->getID(),"\">";					
						echo $cl[$i]->getName();
					echo "</option>";
				}				
			echo "</select>";
		}
		
		$racer = $rcm->getRacer($user);
		
			
		echo "<tr><td>".ENDURO_APPLY_START_NR;	
			
			/*$re snr = $racer[0]->getNR()?$racer[0]->getNR():1111;
			
			$sql= "select * 
				from 
				(
					SELECT @row_number:=@row_number+1 AS row_number 
					FROM  `d_checkpoint`, (SELECT @row_number:=0) AS t	
				 ) nr 
					left join `phpbb_profile_fields_data` fd on nr.`row_number` = fd.`pf_rm_sport_nr`
					left join `enduro_application` ea on `row_number` = ea.`NR` and ea.`race_id` = $opt
				where 
					`user_ID` is null 
					and `ERA_ID` is null
					and  `row_number` > 0 and `row_number` < 1000
					or `row_number` = $resnr
					and `row_number` <> 1111";
			
			$q_result = queryDB($sql);
		
			echo '<td style="width: 150px;"><select name = "NR"  style="width: 50px;" ';
			if ($resnr!= 1111){ echo " disabled ";}
			echo '>';
				while($row = mysql_fetch_array($q_result, MYSQL_ASSOC)){
					echo "<option value=\"",$row["row_number"],"\" ";
					if ($row){
						if ($row["row_number"]==$resnr){echo " selected ";}
					}
					echo ">";
					echo $row["row_number"];
					echo "</option>";
				}
			echo "</select>"; */
			echo '<td><input type="text" name = "NR" style="width: 142px;" value="',$racer[0]->getNR(),'">';
				
		echo "<tr><td>".ENDURO_APPLY_LICENSE."<td>";	
		
		$sql = "select *
				from  `enduro_licence` 
				where `racer_id` = ".$racer[0]->getUserID()." and YEAR(`start_date`) = year(now())";

		$q_result = queryDB($sql);
	/* 	echo '<select name = "lic"  style="width: 150px;"> ';
		while($row = mysql_fetch_array($q_result, MYSQL_ASSOC)){
					echo "<option value=\"",$row["LIC_NR"],"\" >";
					echo $row["LIC_NR"]," (",$row["TYPE"],")";
					echo "</option>";
		}
		echo "</select>"; */
		$row = mysql_fetch_array($q_result, MYSQL_ASSOC);
		echo '<input type="text" name = "lic" style="width: 142px;" value="',$row ? $row['LIC_NR'] : "" ,'">';
		
		
		$sql = "
		select distinct(`tehn`) as tehn
				from `enduro_application` 
				where `tehn` is not null and `RACER_ID` = ".$user."
				
				union 
				
				select distinct(`tehn`) as tehn
				from `e_trracer` 
				where `tehn` is not null and `TeamRacerID` =".$user;
				//echo $sql;
		$q_result = queryDB($sql);
		
		//print_r($apl1);
		
		
		echo "<tr><td>".ENDURO_APPLY_TECHN."<td>";		
		echo '<select name="tehn1" style="width: 150px;"
				onchange="fillTeh(this.value,1)"
		
		>';      
			echo '<option></option>';
		while($apl1 = mysql_fetch_array($q_result, MYSQL_ASSOC)){
			echo '<option value="',$apl1['tehn'],'">',str_replace("^", " ",$apl1['tehn']),' taktis</option>';
		}
		
		echo ' </select>';
		echo "<tr><td><td>";
			echo '<table border = "0">';
				echo '<tr><td>'.ENDURO_APPLY_MAKE.'<td>'.ENDURO_APPLY_MODEL.'<td>'.ENDURO_APPLY_CC.'<td>'.ENDURO_APPLY_TAKT;
				echo '<tr>';
				echo '<td><input type="text" name ="teh_Marka" ID ="teh_Marka1">';
				echo '<td><input type="text" name ="teh_Model" ID ="teh_Model1">';
				echo '<td><input type="text" name ="teh_V" ID ="teh_V1">';
				echo '<td><select  name ="teh_T" ID ="teh_T1" >';
					echo '<option value = "2">2</option>';
					echo '<option value = "4">4</option>';
				echo '</select>';
			echo '</table>';
		//echo "<tr><td>Apdrošināšana:<td><input type=\"checkbox\" name=\"INS\" >";

		$covid19 = $r[0]->COVID19;
		if($covid19){			
			echo '<tr><td colspan=2><hr><h1 style="color:red;text-align:center;">'.ENDURO_APPLY_COVID19_TITLE.'</h1>';
			echo '<tr><td colspan=2 style="color:red">'.ENDURO_APPLY_COVID19_TEXT;
			echo '<tr><td width=150px>'.ENDURO_APPLY_RACER_ID;
				echo '<td><input type="text" name ="covid19RacerID">';
			echo '<tr><td width=150px>'.ENDURO_APPLY_RACER_PHONE;
				echo '<td><input type="text" name ="covid19RacerPhone" value="'.$racer[0]->getTel().'">';
			echo '<tr><td width=150px>'.ENDURO_APPLY_TECH_NAME;
				echo '<td><input type="text" name ="covid19TechnName">';
			echo '<tr><td width=150px>'.ENDURO_APPLY_TECH_ID;
				echo '<td><input type="text" name ="covid19TechnID">';			
			echo '<tr><td width=150px>'.ENDURO_APPLY_TECH_PHONE;
				echo '<td><input type="text" name ="covid19TechnPhone">';
			echo '<tr><td colspan=2><hr>';
		}

		if(!$_SESSION['params']['org']){
			echo "<tr><td colspan=\"2\" style=\"font-size:14px;text-align: justify;\">".APPLY_AGREE;
			echo '<tr><td colspan="2"> <input type="checkbox" onchange="document.getElementById(\'sub\').disabled = !this.checked">'.ENDURO_APPLY_AGREE;	
		}
		
		echo "<tr><td colspan=\"2\"><center><input type=\"submit\" value=\"";
		
		if(!$_SESSION['params']['org']){
			echo ENDURO_APPLY_BTN_APPLY."\" ID = \"sub\" disabled ";
		} else {
			echo "Pieteikt\"";
		}
		
		
		echo "></center>";
			echo "<input type=\"hidden\" name =\"rm_func\" value=\"enduro\">";
			echo "<input type=\"hidden\" name =\"rm_subf\" value=\"addapplication\">";
			echo "<input type=\"hidden\" name = \"opt\" value =\"$opt\">";
			echo "<input type=\"hidden\" name = \"racer\" value =\"$user\">";
			
			echo "</form>";
	}	else {
		echo "<tr><td width=\"\">".ENDURO_APPLY_CLASS."<td> ";
			//$cl = $cm->getClass($apl[0]->CLASS_ID,"");,$cl[0]->getName()
		echo "<font style=\"font-size:18px;color:blue;font-weight:bold\">",$apl[0]->CLASS_NAME,"</font>";
		
		echo "<tr><td>".ENDURO_APPLY_START_NR."<td>",$apl[0]->NR;
		echo "<tr><td>".ENDURO_APPLY_LICENSE."<td>",$apl[0]->LIC_NR,$apl[0]->LIC_NR?" (".$apl[0]->LIC_TYPE.")":"";	
		echo "<tr><td>".ENDURO_APPLY_TECHN."<td>",str_replace("^", " ",$apl[0]->TEHN)," ".ENDURO_APPLY_TAKT;
		echo "<tr><td colspan=\"2\"><a onclick=\"confDelGet('Tiešām atteikties?','index.php?rm_func=enduro&opt=$opt&rm_subf=delapl&id=",$apl[0]->ERA_ID,"')\"
			onmouseover=\"document.body.style.cursor = 'pointer'\"
			onmouseout = \"document.body.style.cursor = 'default'\"
		>";
			echo ENDURO_APPLY_REVOKE;
		echo "</a>";
	}
	
	
	
}

function printEnduroClubApply($opt){
	
	$rm = new raceManager;
	$cm = new champManager;
	$em = new EnduroManager;
	$rcm = new Racermanager;
	
	$r = $rm->getRace("","","",1,3,"","");
	
	echo "<form action=\"index.php\" method=\"post\">";
	if ($r){
		if (count($r)>1){
			echo "<font style=\"font-size:15px\">Izvēlies sacensības: </font>";
			echo "<select onchange=\"window.location = this.options[this.selectedIndex].value;\">";
				for($i=0;$i<count($r);$i++) {
					$cmp = $cm->getChamps($r[$i]->getCH_ID(),"","","");
					echo "<option value=\"?rm_func=enduro&rm_subf=clubapply&opt=",$r[$i]->getID(),"\" ";
					if($opt == $r[$i]->getID()) {echo " selected ";}
					echo ">";					
						echo $cmp[0]->getName(),", ", $r[$i]->getName()," - ",$r[$i]->getDate();
					echo "</option>";
				}				
			echo "</select>";
			
			echo "<input type=\"hidden\" name = \"raceid\" value=\"",($opt ? $opt: $r[0]->getID()),"\">";
			$opt = $opt ? $opt: $r[0]->getID();
		} else {
			$cmp = $cm->getChamps($r[0]->getCH_ID(),"","","");
			echo "<font style=\"font-size:15px\">sacensības: </font><font style=\"font-size:18px;color:blue;font-weight:bold\">",
				 $cmp[0]->getName(),", ",$r[0]->getName() ," - ",$r[0]->getDate(),"</font>";
			echo "<input type=\"hidden\" name = \"raceid\" value=\"",$r[0]->getID(),"\">";
			$opt = $r[0]->getID();
		}
	} else {
		echo prntWarn("Nav nevienas aktīvas sacensības!");
		return;
	}
	$manager = $rcm->getRacer($_SESSION['user']['user_id']);
	$racers = $em->getEnduroRacerListByClub($opt,$manager[0]->getClub());
	$cl = $cm->getActulaRaceClass($opt);
	$clbyid = array();
	for($j=0;$j<count($cl);$j++) {
		$clbyid[$cl[$j]->getID()] = $cl[$j];
	}
	
	echo "<table border = \"0\" width=\"100%\">";
		for($i=0;$i<count($racers);$i++){
			$apl = $em->getERA("",$opt,"",$racers[$i]->getUserID(),"");
			if($apl){
				echo "<tr>";				
					echo "<td width=\"50px\"> ";
						if ($cl){									
							echo $clbyid[$apl[0]->CLASS_ID]->getName();
						}
					echo "<td width=\"25px\">";
						echo "<a onclick=\"confDelGet('Tiešām atteikties?','index.php?f2=club&rm_func=enduro&opt=$opt&rm_subf=delapl&id=",$apl[0]->ERA_ID,"')\"
							onmouseover=\"document.body.style.cursor = 'pointer'\"
							onmouseout = \"document.body.style.cursor = 'default'\"
						>";
							echo "<img src=\"./images/CHECK_24x24.png\" border = \"0\" alt=\"Pieteikts\" title=\"Pieteikts\">";
						echo "</a>";
					echo "<td width=\"25px\"> ";
						echo "<a href=\"index.php?rm_mode=print&print_func=enduroapl&apl=",$apl[0]->ERA_ID," \" target=\"_blank\">";
							echo "<img src=\"./images/ANKETA_24x24.png\" border = \"0\" alt=\"Drukāt anketu\" title=\"Drukāt anketu\">";
						echo "</a>";					
			} else {
				echo "<tr>";				
					echo "<td width=\"50px\">";
						if ($cl){									
							echo "<select id=\"class",$racers[$i]->getUserID(),"\""; 
								echo "onchange=\"setLink('class",$racers[$i]->getUserID(),"','link",$racers[$i]->getUserID(),"');\"";										
							echo ">";
								for($j=0;$j<count($cl);$j++) {
									echo "<option value=\"?rm_func=enduro&rm_subf=addapplication&f2=club&class=",$cl[$j]->getID(),"&raceid=$opt&opt=$opt&racer=",$racers[$i]->getUserID(),"\">";					
										echo $cl[$j]->getName();
									echo "</option>";
								}				
							echo "</select>";
						}
					echo "<td width=\"25px\">";
						echo "<a id=\"link",$racers[$i]->getUserID(),"\" href=\"?rm_func=enduro&rm_subf=addapplication&f2=club&class=",$cl[0]->getID(),"&raceid=$opt&opt=$opt&racer=",$racers[$i]->getUserID(),"\">";
							echo "<img src=\"./images/Blue_arrow_right_24x24.png\" border = \"0\" alt=\"Nav pieteikts\" title=\"Nav pieteikts\">";
						echo "</a>";
						echo "<td width=\"25px\"> ";
						echo "&nbsp";					
			}
					echo "<td>";
						echo "<a href=\"?rm_func=racer&rm_subf=viewprofile&id=",$racers[$i]->getUserID(),"&red_f=enduro&red_s=clubapply&editmode=enduroreg\">";
							echo "<b>",$racers[$i]->getFName()," ",$racers[$i]->getLName(),"</b>";
						echo "</a>";
						echo " / ",$racers[$i]->getNR() ? $racers[$i]->getNR() : "NAV"," / ",$racers[$i]->getLNR() ? $racers[$i]->getLNR() : "NAV", " / ",$racers[$i]->getBYear_text()," / ",$racers[$i]->getClub_name();						
}
	echo "</table>";
}

function printEnduroReg($opt){
	printAactualRaceMenu(3);
	
	$rcm = new RacerManager;
	$rm = new raceManager;
	$em = new EnduroManager;
	$cm = new champManager;
	
	$r = $rm->getRace($opt ? $opt : "","","","","",1,0);
	if (!$r || $r[0]->getType() <> 3){
		echo "<h1 align=\"center\" style=\"color:red;font-weight:bold\">Nav nevienas aktīvas sacensības!</h1>";
		return; 
	}
	$opt = $r[0]->getID();
	$erd = $em->getERD($opt);
	
	if ($erd){
	} else {
		echo "<h1 align=\"center\" style=\"color:red;font-weight:bold\">Sacensībām nav nevienas sacensības dienas!</h1>";
		return;
	}
	$day = $_SESSION['params']['day'];
	$erday = $erd[0];
	
	echo "sacensības diena: ";
		echo "<select onchange=\"window.location = this.options[this.selectedIndex].value;\">";
		for ($i=0;$i<count($erd);$i++){
			echo "<option value = \"index.php?rm_func=enduro&rm_subf=reg&opt=$opt&day=",$erd[$i]->ERD_ID,"\"";
			if($day){
				if($day == $erd[$i]->ERD_ID){
					echo " selected ";
					$erday = $erd[$i];
				}
			} elseif (substr($erd[$i]->START_DATE,0,10) == date("Y-m-d")) {
				echo " selected ";
				$erday = $erd[$i];
				$day = $erd[$i]->ERD_ID;
			}
			echo ">";
				echo $erd[$i]->START_DATE;
			echo "</option>";
		}
		if(!$day){$day=$erd[0]->ERD_ID;}
		echo "</select>";
	
	
	
	echo "<table border=\"1\" width=\"100%\">";
		echo "<tr align=\"center\">
					<td width= \"32\">";
					echo "<a href=\"?rm_func=enduro&rm_subf=",$erday->REG_ACTIVE ? "daylock" : "dayunlock","&opt=$opt&day=$day\">";
						echo "<img border=\"0\" src=\"./images/",$erday->REG_ACTIVE ? "un" : "","locked_32x32.png\"",
							$erday->REG_ACTIVE ? "alt=\"Reģistrācija atvērta\" title=\"Reģistrācija atvērta\""
							:"alt=\"Reģistrācija aizvērta\" title=\"Reģistrācija aizvērta\""
						,">";						
					echo "</a>";
				echo "<td width=\"60%\"><font style=\"font-size:15px;font-weight:bold\">Registrētie sportisti</font>
					<td width=\"*\"><font style=\"font-size:15px;font-weight:bold\">Visi sportisti</font>
					<td width=\"32\">
						<a href=\"?rm_func=racer&rm_subf=newteamracer&opt=$opt&day=$day&red_f=enduro&red_s=reg&addmode=enduroreg\">
							<img src=\"./images/User_32x32.png\" border =\"0\" alt=\"+ Sportists\" title=\"Pievienot sportistu\">
						</a>";
		echo "<tr>";
			echo "<td valign=\"top\" colspan=\"2\">";
				$racers = $em->getEnduroDayRacerList($day);
				
				$nrs = array();
				for($i=0;$i<count($racers);$i++){
					if ($racers[$i]->NR){
						array_push($nrs,$racers[$i]->NR);
					}
				}
				$nrs = array_count_values($nrs);
				
				$class=-1;
				echo "<table border = \"1\" width=\"100%\" valign=\"top\" style=\"background-color:white\">";
					for($i=0;$i<count($racers);$i++){
						if(!$erday->REG_ACTIVE && !$racers[$i]->ACCEPTED){continue;}
						if($class <> $racers[$i]->CLASS_ID){
							echo "<tr><td colspan=\"4\" style=\"background-color:#C8C8C8\">";
							echo "<a name=\"clas",$racers[$i]->CLASS_ID,"\" id=\"clas",$racers[$i]->CLASS_ID,"\"></a>";
							echo "<h1>", $racers[$i]->CLASS_NAME,"</h1>";
							$class = $racers[$i]->CLASS_ID;
							
						}
						echo "<tr ";
							if($nrs[$racers[$i]->NR] > 1 && $racers[$i]->NR ){
								echo "style=\"background-color:#FF6666\"";
							} elseif($racers[$i]->RACER->getUserID() == $_SESSION['params']['racer']){
								echo "style=\"background-color:#99FF99\"";
							}
						echo ">";
							echo "<td width=\"25\">";
								if($racers[$i]->ACCEPTED){
									if($erday->REG_ACTIVE){
										echo "<a href=\"index.php?rm_func=enduro&rm_subf=denyracerday&opt=$opt&day=$day&racer=",$racers[$i]->RACER->getUserID(),"&id=",$racers[$i]->ACCEPTED,"#clas",$racers[$i]->CLASS_ID,"\">";
									}
										echo "<img src=\"./images/CHECK_24x24.png\" alt=\"√\" title=\"Pieteikums apstiprināts\" border=\"0\">";
									if($erday->REG_ACTIVE){
										echo "</a>";
									}
								} else {
									if($erday->REG_ACTIVE){
										echo "<a href=\"index.php?rm_func=enduro&rm_subf=accracerday&opt=$opt&day=$day&racer=",$racers[$i]->RACER->getUserID(),"&ea=",$racers[$i]->EA_ID,"#clas",$racers[$i]->CLASS_ID,"\">";
									}
											echo "<img src=\"./images/WARN_24x24.png\" alt=\"?\" title=\"Pieteikums nav apstiprināts\" border=\"0\">";
									if($erday->REG_ACTIVE){
										echo "</a>";
									}
								}
							echo "<td width=\"25\">";
								echo "<a href=\"./?rm_mode=print&print_func=enduroapl&apl=",$racers[$i]->EA_ID,"\" target=\"_blank\">";
									echo "<img src=\"./images/ANKETA_24x24.png\" border=\"0\" alt=\"Drukāt\" title=\"Drukāt anketu\">";
								echo "</a>";
							
							echo "<td width=\"*\">";
								echo "<span style=\"font-weight:bold;font-size:14px;cursor:pointer;\" onclick=\"changeNumber(",$racers[$i]->EA_ID,",",$racers[$i]->CLASS_ID,",'",$racers[$i]->NR,"')\">",$racers[$i]->NR ? $racers[$i]->NR : "<font color=\"red\">NAV</font>" ,"</span> / ";
								echo "<a style=\"font-weight:bold;font-size:14px;text-decoration:none;\" href = \"?rm_func=racer&rm_subf=viewprofile&opt=$opt&day=$day&red_f=enduro&red_s=reg&editmode=enduroreg&anh=clas",$racers[$i]->CLASS_ID,"&racer=",$racers[$i]->RACER->getUserID(),"&id=",$racers[$i]->RACER->getUserID(),"\">";
									echo $racers[$i]->RACER->getFName(), " ", $racers[$i]->RACER->getLName();									
								echo "</a>";								
								echo " / ",$racers[$i]->RACER->getLNR() ? $racers[$i]->RACER->getLNR() : "NAV"," / ",$racers[$i]->RACER->getBYear_text()," / ",$racers[$i]->RACER->getClub_name()," / ",$racers[$i]->RACER->getValsts_name();
							echo "<td width=\"17\">";
								echo "<img width=\"16px\" height = \"16px\" src=\"./images/CROSS_",$erday->REG_ACTIVE? "" :"TRANS_","24x24.png\" alt=\"X\" title=\"Noraidīt pieteikumu\" border=\"0\"";
									if($erday->REG_ACTIVE){
										echo "	onmouseover=\"document.body.style.cursor = 'pointer'\"
												onmouseout = \"document.body.style.cursor = 'default'\"
												onclick=\"confDelGet('Tiešām noraidīt?','index.php?rm_func=enduro&rm_subf=delapl1&opt=$opt&day=$day&racer=",$racers[$i]->RACER->getUserID(),"&id=",$racers[$i]->EA_ID,"#clas",$racers[$i]->CLASS_ID,"')\"";
									}
								echo ">";
					}
				echo "</table>";				
			echo "<td colspan=\"2\" valign=\"top\">";
			
				$freeracers = $em->getFreeRacerList($opt);
			
				$cl = $cm->getActulaRaceClass($opt);
				echo "<table border = \"1\" width=\"100%\" style=\"background-color:white\">";
				
					for($i=0;$i<count($freeracers);$i++){
						echo "<tr ";
							if($freeracers[$i]->getUserID() == $_SESSION['params']['racer']){echo "style=\"background-color:#99FF99\"";}
						echo ">";
							echo "<td width=\"17px\">";	
								if($_SESSION['params']['anh']=="new1"){
									if($freeracers[$i]->getUserID() == $_SESSION['params']['racer']){echo "<a name=\"new1\"></a>";}
								}else { 
									echo "<a name=\"rcr",$freeracers[$i]->getUserID(),"\"></a>";
								}
							if($erday->REG_ACTIVE){
																
								// if ($cl){									
									// echo "<select id=\"class",$freeracers[$i]->getUserID(),"\""; 
										// echo "onchange=\"modifyEnduroRegLinks(",$freeracers[$i]->getUserID(),",",$cl[0]->getID(),");\"";										
									// echo ">";
										// for($j=0;$j<count($cl);$j++) {
											// echo "<option value=\"",$cl[$j]->getID(),"\">";					
												// echo $cl[$j]->getName();
											// echo "</option>";
										// }				
									// echo "</select>";
								// }
								
								//echo "<td width=\"17px\">";
								
									//echo "<a id=\"add",$freeracers[$i]->getUserID(),"\" href= \"index.php?rm_func=enduro&rm_subf=apladd&racer=",$freeracers[$i]->getUserID(),"&day=$day&opt=$opt&c=",$cl[0]->getId(),"#clas",$cl[0]->getId(),"\">";
									
									// echo "<img src=\"./images/BlueAdd_16x16.png\" alt=\"+\" title=\"Piereģistrēt sacensībām\" border=\"0\"		
												// onclick=\"showApplMenu(this,hs);\"																	
												// onmouseover=\"document.body.style.cursor = 'pointer'\"
												// onmouseout = \"document.body.style.cursor = 'default'\"				
									// >";
		
									//echo "</a>";
								
								//echo "<td width=\"17px\">";
								
									echo "<a id=\"apl",$freeracers[$i]->getUserID(),"\" href= \"?rm_func=enduro&rm_subf=apply&opt=$opt&rcr=",$freeracers[$i]->getUserID(),"&org=1\">";
									//rm_func=enduro&rm_subf=aplapply&racer=",,"&day=$day&opt=$opt&c=",$cl[0]->getId(),"#clas",$cl[0]->getId(),"\">";
									
									echo "<img src=\"./images/BlueAdd_16x16.png\" alt=\"√\" title=\"Piereģistrēt sacensībām\" border=\"0\">";
								
									echo "</a>";
								
								echo "<td width=\"*\">";
							}
								echo "<a href = \"?rm_func=racer&rm_subf=viewprofile&opt=$opt&day=$day&red_f=enduro&red_s=reg&editmode=enduroreg&anh=rcr",$freeracers[$i]->getUserID(),"&id=",$freeracers[$i]->getUserID(),"\" style=\"text-decoration:none;\">";
									echo "(",$freeracers[$i]->getNR(),")",$freeracers[$i]->getFname(), " ", $freeracers[$i]->getLname()," (",$freeracers[$i]->LATEST_APP_DATE,")";
								echo "</a>";
					}
				echo "</table>";
				echo "<div class=\"highslide-maincontent\" id=\"div_apl\"></div>";
	echo "</table>";
}

function printStarts($opt){
	

	printAactualRaceMenu(3);
	
	$rcm = new RacerManager;
	$rm = new raceManager;
	$em = new EnduroManager;
	$cm = new champManager;
	
	$fullname="";
	$r = $rm->getRace($opt ? $opt : "","","","","",1,0);
	
	$slot= $r[0]->slots;
	
	if (!$r || $r[0]->getType() <> 3){
		echo "<h1 align=\"center\" style=\"color:red;font-weight:bold\">Nav nevienas aktīvas sacensības!</h1>";
		return; 
	}
	$opt = $r[0]->getID();
	$erd = $em->getERD($opt);
	
	if ($erd){
	} else {
		echo "<h1 align=\"center\" style=\"color:red;font-weight:bold\">Sacensībām nav nevienas sacensības dienas!</h1>";
		return;
	}
	$day = $_SESSION['params']['day'];
	$erday = $erd[0];	
	echo "<table border=\"0\" style=\"vertical-align:middle\">";
		echo "<tr>";
			echo "<td >";
				echo "sacensības diena: ";
					echo "<select onchange=\"window.location = this.options[this.selectedIndex].value;\">";
					for ($i=0;$i<count($erd);$i++){
						echo "<option value = \"index.php?rm_func=enduro&rm_subf=start&opt=$opt&day=",$erd[$i]->ERD_ID,"\"";
						if($day){
							if($day == $erd[$i]->ERD_ID){
								echo " selected ";
								$erday = $erd[$i];
							}
						} elseif (substr($erd[$i]->START_DATE,0,10) == date("Y-m-d")) {
							echo " selected ";
							$erday = $erd[$i];
							$day = $erd[$i]->ERD_ID;
						}
						echo ">";
							echo $erd[$i]->START_DATE;
						echo "</option>";
					}
					if(!$day){$day=$erd[0]->ERD_ID;}
					echo "</select>";
			echo "<td > <font style=\"vertical-align:middle\">|</font> ";
				echo " LK atstarpe: <input type=\"text\" size=\"1\" maxlength=\"1\" value=\"",$erday->OFFSET_MIN,"\"  name=\"offset\">";
				echo "<input type=\"hidden\" name=\"erd\" value=\"",$erday->ERD_ID,"\" style=\"vertical-align:middle\">";
				echo " <img src=\"./images/blue_arrow_down_11x16.png\" onclick=\"changeOffset('dn');\"
							onmouseover=\"document.body.style.cursor = 'pointer'\"
							onmouseout = \"document.body.style.cursor = 'default'\"
							style=\"vertical-align:middle\" 
							alt=\"▼\" Title=\"Samazināt\"
						>
						<img src=\"./images/blue_arrow_up_11x16.png\" onclick=\"changeOffset('up');\"
							onmouseover=\"document.body.style.cursor = 'pointer'\"
							onmouseout = \"document.body.style.cursor = 'default'\"
							style=\"vertical-align:middle\"
							alt=\"▲\" Title=\"Palielināt\"
						>";
				
			echo "<td style=\"vertical-align:middle\" valign=\"middle\"> | ";
				echo "<td>";
					echo "<a href=\"?rm_func=enduro&rm_subf=reload_offset&day=",$erday->ERD_ID,"&opt=$opt\">";
						echo "<img src = \"./images/Reload_green_24x24.png\"
								style=\"vertical-align:middle\" 
								alt=\"Pārreķināt\" Title=\"Pārreķināt intervalus\"
								border = \"0\"
						>";
					echo "</a>";
					

			$sql =" select * 
					from `enduro_race_day` 
					where 
						`race_id` = ".$erday->RACE_ID." and
						`START_DATE` < '".$erday->START_DATE."'";
			if(mysql_num_rows(queryDB($sql)) > 0){	
				echo "<td style=\"vertical-align:middle\" valign=\"middle\"> | ";
				echo "<td>";
					echo "<a style=\"vertical-align:middle\" href=\"?rm_func=enduro&rm_subf=copyracers&day=",$erday->ERD_ID,"&opt=$opt\" valign=\"middle\">";
						echo "<img src=\"./images/Blue_arrow_right_24x24.png\" border=\"0\" valign=\"middle\"
							alt=\">>\"
							title=\"Kopēt pārus no iepriekšējās dienas\">";
					echo "</a>";
				echo "<td>";
					echo "<a style=\"vertical-align:middle\" href=\"?rm_func=enduro&rm_subf=copyracers&day=",$erday->ERD_ID,"&opt=$opt\" valign=\"middle\">";
						echo "Kopēt pārus no iepriekšējās dienas";
					echo "</a>";
			}
			
	echo "</table>";
	
	$cl = $em->getERCD($opt,$day,"");
	echo "<table width=\"",$slot * 200 + 200,"px\" style=\"background-color:white;\">";
		$time = explode(" ",$erday->START_DATE);
		$time = explode(":",$time[1]);
		$hr=$time[0];
		$m = $time[1];
		
		for($i=0;$i<count($cl);$i++){
			$cnt = $em->getEnduroDayRacerCNT($day,$cl[$i]->CLASS_ID);
			if ($cnt > 0){
				echo "<tr style=\"background-color:#C8C8C8;font-weight:bold;text-align:left;\">";
					echo "<td style=\"font-size:14px;\" width=\"*\">";
						echo "<a name=\"anh",$cl[$i]->CLASS_ID,"\"></a>";
						echo "<img src=\"./images/Refresh_16x16.png\" alt=\"Mainīt vietām\" title=\"Mainīt vietām\" 
								onmouseover=\"document.body.style.cursor = 'pointer'\"
								onmouseout = \"document.body.style.cursor = 'default'\"
								onclick=\"changeGlowing();\"
							> ";
						echo $cl[$i]->NAME;
						
					echo "<td  align=\"right\">";						
							echo "<input type=\"checkbox\" name=\"ercdx",$cl[$i]->ERCD_ID,"\" 
								onchange=\"putSeparator('ercdx",$cl[$i]->ERCD_ID,"');\"";
								if($cl[$i]->SEPARATOR){echo " checked ";}
							echo "> Atdalīt sarakstā ";
						echo "<a href=\"?rm_func=enduro&rm_subf=moveclass&up=1&class=",$cl[$i]->CLASS_ID,"&opt=$opt&ordr=",$cl[$i]->ORDER,"&day=$day&id=",$cl[$i]->ERCD_ID,"#anh",$cl[$i]->CLASS_ID,"\">";
							echo "<img src=\"./images/yellow_up_24x24.png\" border =\"0\" alt=\"▲\" Title=\"Bīdīt uz augšu\">";
						echo "</a>";
						echo "<a href=\"?rm_func=enduro&rm_subf=moveclass&down=1&class=",$cl[$i]->CLASS_ID,"&opt=$opt&ordr=",$cl[$i]->ORDER,"&day=$day&id=",$cl[$i]->ERCD_ID,"#anh",$cl[$i]->CLASS_ID,"\">";
							echo "<img src=\"./images/yellow_down_24x24.png\" border =\"0\" alt=\"▼\" Title=\"Bīdīt uz leju\">";
						echo "</a>";
				echo "<tr>";
					echo "<td colspan=\"2\">";
						echo "<table width=\"",$slot * 200 + 200,"px\" border=\"1\">";
							echo "<tr style=\"font-weight:bold\">";
								echo "<td width=\"*\">Starta numuri";
								echo "<td width=\"65px\" align=\"center\">LK0";								
								
								echo "<td width=\"180px\" align=\"right\">Sportisti";
							echo "<tr valign=\"top\">";
								echo "<td colspan=2>";
									echo "<table width=\"100%\" border=\"1\">";
										for($j=0;$j<$cnt/$slot;$j++){
											echo "<tr style=\"height:23px\">";
												for($x=0;$x<$slot;$x++){
													$rcr = $em->getEnduroDayFreeRacerList1($day,$cl[$i]->CLASS_ID,$j+1,$x+1);
													$name = "rcrx$day"."x".$cl[$i]->CLASS_ID ."x".($j+1)."x".($x+1);
													if($rcr[0]){														
														echo "<td width=\"183px\"
																id = \"$name\"
																onclick=\"glow('$name');\"
															  >
															<font style=\"font-size:14px;font-weight:bold;\"", $rcr[0]->getNr() ? ">".$rcr[0]->getNr()."</font>" : " color=\"red\">NAV</font>";
															echo " ",$rcr[0]->getFname()," ",$rcr[0]->getLname();	
														echo "</td>";
														echo "<td width=\"17px\">";
															echo "<a href=\"?rm_func=enduro&rm_subf=unpairracer&slot=$x&class=",$cl[$i]->CLASS_ID,"&opt=$opt&day=$day&pair=$j#anh",$cl[$i]->CLASS_ID,"\">";
																echo "<img src=\"images/RedCross_trans_16x16.png\" border=\"0\" alt=\"X\" Title = \"Izņemt\">";
															echo "</a>";
													} else {														
														echo "<td width=\"183px\"
																id = \"$name\"
																onclick=\"glow('$name');\"
															>&nbsp</td>";
														echo "<td width=\"17px\">";
															echo "<a href=\"?rm_func=enduro&rm_subf=unpairracer&slot=$x&class=",$cl[$i]->CLASS_ID,"&opt=$opt&day=$day&pair=$j#anh",$cl[$i]->CLASS_ID,"\">";
																echo "<img src=\"images/RedCross_trans_16x16.png\" border=\"0\" alt=\"X\" Title = \"Izņemt\">";
															echo "</a>";
													}
												}	
												
												$sql = "select `lk0` from `enduro_day_racer` 
													where `erd_id` = $day and `pair` = ". ($j+1) ."
													and `ea_id` in (select `era_id` from `enduro_application` where `class_id` = ".$cl[$i]->CLASS_ID.")";
												$r = queryDB($sql);
												$row = mysql_fetch_array($r, MYSQL_ASSOC);
												
												$name = "lkx$i"."x".($j+1)."x".$cl[$i]->CLASS_ID."x$day";
												echo "<td>
													<input 
														type=\"text\" 
														size=\"5\" 
														maxlength=\"5\" 
														value=\"",
															$row["lk0"] ? 
																substr($row["lk0"],0,5) :
																($hr.":". (($m < 10 and $m <> "00") ? "0".$m : $m )),
														"\"
														name=\"$name\"
														onchange=\"editoffset('$name');\"
													>";
												$m+=$erday->OFFSET_MIN;
												if($m > 59){
													$h++;
													$m = 0;
												}	
												$fullname.=$name.";";
										}										
									echo "</table>";								
								echo "<td align =\"right\">";
									$racers = $em->getEnduroDayFreeRacerList($day,$cl[$i]->CLASS_ID);
									echo "<table border=\"1\" width=\"100%\">";
										if($racers){
											for($j=0;$j<count($racers);$j++){
												echo "<tr>";
													echo "<td width=\"17px\" align=\"center\">";
														echo "<a href = \"?rm_func=enduro&rm_subf=pairracer&cnt=$slot&class=",$cl[$i]->CLASS_ID,"&opt=$opt&day=$day&racer=",$racers[$j]->getUserId(),"#anh",$cl[$i]->CLASS_ID,"\">";
															echo "<img src=\"./images/BlueAdd_16x16.png\" alt=\"Pievienot\" title=\"Pievienot\" border =\"0\"> ";
														echo "</a>";
													echo "<td width=\"150px\" align=\"left\">",$racers[$j]->getNr()," - ",$racers[$j]->getFname()," ",$racers[$j]->getLname();
											}
											echo "<tr>";
												echo "<td align=\"center\">";
													echo "<a href = \"?rm_func=enduro&rm_subf=pairracer&cnt=$slot&class=",$cl[$i]->CLASS_ID,"&opt=$opt&day=$day&racer=all#anh",$cl[$i]->CLASS_ID,"\">";
														echo "<img src=\"./images/green_arrow_left_16x16.png\" alt=\"Pievienot visus\" title=\"Pievienot visus\" border =\"0\"> ";
													echo "</a>";
												echo "<td align=\"left\">Pievienot visus";
										}
										
									echo "</table>";
						echo "</table>";
			}
			
			
		}
	echo "</table>";
	echo "<input type=\"hidden\" name = \"fullname\" value=\"$fullname\">";
	
	echo "<hr><a href=\"./?rm_mode=print&print_func=rudite&day=$day&mode=1\" target=\"_blank\">Protokols \"Rudītes\"</a>";
	echo " | <a href=\"./?rm_mode=print&print_func=rudite&day=$day&mode=2\" target=\"_blank\">Protokols \"Robis\"</a>";
	echo " | <a  href=\"./?rm_mode=print&print_func=enduro_start&day=$day\" target=\"_blank\">Starta laiki</a>";
	echo " | <a  href=\"./?rm_mode=print&print_func=kartina&day=$day\" target=\"_blank\">Kartiņas</a>";
	
}

function pairRacer(){
	$em = new EnduroManager;
	
	$racers = $_SESSION['params']['racer'] == "all" ? $em->getEnduroDayFreeRacerList($_SESSION['params']['day'],$_SESSION['params']['class']) :  null;
	
	$cnt = ($racers && count($racers) > 0) ? count($racers): 1;
	
	for($i=0;$i<$cnt;$i++){
		$edr = $em->getLastOrder($_SESSION['params']['day'],$_SESSION['params']['racer'] == "all" ? $racers[$i]->getUserId(): $_SESSION['params']['racer']);
		if($edr[0]->PAIR){
			return;
		}
		
		$sql = "select min(edr.`pair`) as mi, count(*) as cnt 
			from (select * from `enduro_day_racer` where `pair` is not null) edr
					inner join `enduro_application` ea on (
						edr.`ea_id` = ea.`era_id` and 
						ea.`class_id` = ".$_SESSION['params']['class']." and 
						edr.`erd_id` = ".$_SESSION['params']['day']."
					)
				group by edr.`pair`
				having count(*) < ".$_SESSION['params']['cnt'];

		$r = queryDB($sql);		
		$row = mysql_fetch_array($r, MYSQL_ASSOC);
		
		$pair=1;
		$pos = 1;
		if(!$row['mi'] ){
			$sql = "select max(edr.`pair`) as ma from `enduro_day_racer` edr
					inner join `enduro_application` ea on (
						edr.`ea_id` = ea.`era_id` and 
						ea.`class_id` = ".$_SESSION['params']['class']." and 
						edr.`erd_id` = ".$_SESSION['params']['day']."
					)";
			$r = queryDB($sql);
			$row = mysql_fetch_array($r, MYSQL_ASSOC);
			if($row['ma']){
				$pair = $row['ma'] +1;
			}
		} else {
			$pair = $row['mi'];
			
			
			$sql = "select `position` from `enduro_day_racer` edr
						inner join `enduro_application` ea on (
							edr.`ea_id` = ea.`era_id` and 
							ea.`class_id` = ".$_SESSION['params']['class']." and 
							edr.`erd_id` = ".$_SESSION['params']['day']." 
						)
					where edr.`pair` = ".$row['mi']."
					order by edr.`position` asc";

			$r = queryDB($sql);
			
			$pos = mysql_num_rows($r)+1;		
			$x=1;
			while($row = mysql_fetch_array($r, MYSQL_ASSOC)){
				if ($row['position'] != $x){
					$pos = $x;
					break;
				}
				$x++;
			}
		}
		if ($pos !=0){
			
		}else if($pair == 1){
		}
		
		$sql = "update `enduro_day_racer` set `pair` = $pair, `position` = $pos where EDR_ID = ".$edr[0]->EDR_ID;		
		queryDB($sql);		
	}
}
?>
