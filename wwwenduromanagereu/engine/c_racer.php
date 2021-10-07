<?php

class Racer{
	private $userid;
	public $lname;
	public $fname;
	private $addr;
	private $tel;
	public $mail;
	private $pk;
	private $sex;
	private $ins;
	public $tehn;
	private $tehnn;
	private $motocc;
	private $valsts;
	private $byear;
	private $valsts_name;
	private $club_name;
	
	public $allowemails;
	public $enduromanager;
	public $LIC_TYPE;
	public $LIC_YR;
	public $LATEST_APP_DATE;
	
	public function getValsts_name(){
		return $this->valsts_name;
	}
	public function setValsts_name($value){
		$this->valsts_name = $value;
	}
	
	public function getClub_name(){
		return $this->club_name;
	}
	public function setClub_name($value){
		$this->club_name = $value;
	}
		
	public function getBYear_text(){
		prntWarn($this->byear);	
		return $this->byear > 0 ? (1939 + $this->byear ): "&ltNav norādīts&gt";
	}
		
	public function setUserID($value){
		$this->userid = $value;
	}
	public function getUserID(){
		return $this->userid;
	}		
	public function getLname(){
		return $this->lname;
	}
	public function getFname(){
		return $this->fname;
	}
	public function getAddr(){
		return $this->addr;
	}
	public function getTel(){
		return $this->tel;
	}
	public function getMail(){
		return $this->mail;
	}
	public function getSex(){
		return $this->sex;
	}
	public function getIns(){
		return $this->ins;
	}
	public function getPK(){
		return $this->pk;
	}
	public function getTehn(){
		return $this->tehn;
	}
	public function getTehnN(){
		return $this->tehnn;
	}
	public function getRid(){
		return $this->rid;
	}
	public function getMotocc(){
		return $this->motocc;
	}
	public function getValsts(){
		return $this->valsts;
	}
	public function getBYear(){
		return $this->byear;
	}		
	
	public function setLname($value){
		$this->lname = $value;
	}
	public function setFname($value){
		$this->fname = $value;
	}
	public function setAddr($value){
		$this->addr = $value;
	}
	public function setTel($value){
		$this->tel = $value;
	}
	public function setMail($value){
		$this->mail = $value;
	}
	public function setSex($value){
		$this->sex = $value;
	}
	public function setIns($value){
		$this->ins = $value;
	}
	public function setPK($value){
		$this->pk = $value;
	}
	public function setTehn($value){
		$this->tehn = $value;
	}
	public function setTehnN($value){
		$this->tehnn = $value;
	}
	public function setRid($value){
		$this->rid = $value;
	}
	public function setMotocc($value){
		$this->motocc = $value;
	}
	public function setValsts($value){
		$this->valsts = $value;
	}
	public function setBYear($value){
		$this->byear = $value;
	}
	
	private $NR;
	public function getNR(){
		return $this->NR;
	}
	public function setNR($value){
		$this->NR = $value;
	}
	
	private $club;
	public function getClub(){
		return $this->club;
	}
	public function setClub($value){
		$this->club = $value;
	}
	private $LNR;
	public function getLNR(){
		return $this->LNR;
	}
	public function setLNR($value){
		$this->LNR = $value;
	}			
}
class Team{
	private $teamid;
	public function setID($value){
		$this->teamid = $value;
	}
	public function getID(){
		return $this->teamid;
	}
	
	private $name;
	public function setName($value){
		$this->name = $value;		
	}
	public function getName(){
		return $this->name;
	}
	
	private $active;
	public function setActive($value){
		$this->active = $value;		
	}
	public function getActive(){
		return $this->active;
	}
	
	private $racers;
	public function setRacers($value){
		$this->racers = $value;
	}
	public function getRacers(){
		return $this->racers;
	}
	public function addRacer($value){
		array_push($this->racers,$value);
	}

	public function getLeader(){
		for($i=0;$i<count($this->racers);$i++){
			if ($this->racers[$i]->IsLeader()){
				return $this->racers[$i];
			}
		}
	}
}
class TeamRacer{
	private $trid;
	public function setTRID($value){
		$this->trid = $value;
	}
	public function getTRID(){
		return $this->trid;
	}
	
	private $RacerID;
	public function setRacerID($value){
		$this->RacerID = $value;
	}
	public function getRacerID(){
		return $this->RacerID;
	}
	
	private $TeamID;
	public function setTeamID($value){
		$this->TeamID = $value;
	}
	public function getTeamID(){
		return $this->TeamID;
	}
	
	private $Leader;
	public function setIsLeader($value){
		$this->Leader = $value;
	}
	public function getIsLeader(){
		return $this->Leader;
	}
	
	private $RacerDet;
	public function setRacerDet($value){
		$this->RacerDet = $value;
	}
	public function getRacerDet(){
		return $this->RacerDet;
	}

	public function IsLeader(){
		return $this->getIsLeader();
	}
}
class TeamRace{
	private $trid;
	public function setTRID($value){
		$this->trid = $value;
	}
	public function getTRID(){
		return $this->trid;
	}
	
	private $TeamID;
	public function setTeamID($value){
		$this->TeamID = $value;
	}
	public function getTeamID(){
		return $this->TeamID;
	}
	
	private $cid;
	public function setCID($value){
		$this->cid = $value;
	}
	public function getCID(){
		return $this->cid;
	}
	
	public $rid;
	public function setRID($value){
		$this->rid = $value;
	}
	public function getRID(){
		return $this->rid;
	}
	
	private $accepted;
	public function setACC($value){
		$this->accepted = $value;
	}
	public function getACC(){
		return $this->accepted;
	}

	private $cnt;
	public function setCNT($value){
		$this->cnt = $value;
	}
	public function getCNT(){
		return $this->cnt;
	}

	private $comp;
	public function setComp($value){
		$this->comp = $value;
	}
	public function getComp(){
		return $this->comp;
	}
	
	private $sum;
	public function setSUM($value){
		$this->sum = $value;
	}
	public function getSUM(){
		return $this->sum;
	}

	private $closed;
	public function setClosed($value){
		$this->closed = $value;
	}
	public function getClosed(){
		return $this->closed;
	}
}
class Club{
	private $id;
	private $name;
	private $country;
	private $cName;
	
	public function setID($value){
		$this->id = $value;
	}
	public function getID(){
		return $this->id;
	}
	public function setName($value){
		$this->name = $value;
	}
	public function getName(){
		return $this->name;
	}
	public function setCountry($value){
		$this->country = $value;
	}
	public function getCountry(){
		return $this->country;
	}
	public function setcName($value){
		$this->cName = $value;
	}
	public function getcName(){
		return $this->cName;
	}
}
class TRRacer{
	private $id;
	private $TRID;
	private $trr;
	private $rid;
	
	public $nr;
	public $lic;
	public $tehn;
	public $type;
	public $club;
	public $clubName;
	
	
	public function setID($value){
		$this->id = $value;
	}
	public function getID(){
		return $this->id;
	}
	public function setTRID($value){
		$this->TRID = $value;
	}
	public function getTRID(){
		return $this->TRID;
	}
	public function setTRRID($value){
		$this->trr = $value;
	}
	public function getTRRID(){
		return $this->trr;
	}
	public function setRID($value){
		$this->rid = $value;
	}
	public function getRID(){
		return $this->rid;
	}
}
class ClubTeam{
	private $teamid;
	public function setID($value){
		$this->teamid = $value;
	}
	public function getID(){
		return $this->teamid;
	}
	
	private $name;
	public function setName($value){
		$this->name = $value;		
	}
	public function getName(){
		return $this->name;
	}
	
	private $Clubid;
	public function setClubID($value){
		$this->Clubid = $value;
	}
	public function getClubID(){
		return $this->Clubid;
	}
	
	
	private $racers;
	public function setRacers($value){
		$this->racers = $value;
	}
	public function getRacers(){
		return $this->racers;
	}
	public function addRacer($value){
		array_push($this->racers,$value);
	}

	public function getLeader(){
		for($i=0;$i<count($this->racers);$i++){
			if ($this->racers[$i]->IsLeader()){
				return $this->racers[$i];
			}
		}
	}
}
class CTeamRacer{
	private $trid;
	public function setTRID($value){
		$this->trid = $value;
	}
	public function getTRID(){
		return $this->trid;
	}
	
	private $RacerID;
	public function setRacerID($value){
		$this->RacerID = $value;
	}
	public function getRacerID(){
		return $this->RacerID;
	}
	
	private $TeamID;
	public function setTeamID($value){
		$this->TeamID = $value;
	}
	public function getTeamID(){
		return $this->TeamID;
	}
	
	private $Leader;
	public function setIsLeader($value){
		$this->Leader = $value;
	}
	public function getIsLeader(){
		return $this->Leader;
	}
	
	private $RacerDet;
	public function setRacerDet($value){
		$this->RacerDet = $value;
	}
	public function getRacerDet(){
		return $this->RacerDet;
	}

	public function IsLeader(){
		return $this->getIsLeader();
	}
} 
class ClubTRRacer{
	private $id;
	private $TRID;
	private $trr;
	
	public function setID($value){
		$this->id = $value;
	}
	public function getID(){
		return $this->id;
	}
	public function setCTRID($value){
		$this->TRID = $value;
	}
	public function getCTRID(){
		return $this->TRID;
	}
	
	public function setRDetID($value){
		$this->trr = $value;
	}
	public function getRDetID(){
		return $this->trr;
	}
	
	private $cid;
	public function setCID($value){
		$this->cid = $value;
	}
	public function getCID(){
		return $this->cid;
	}
}
class ClubTRace{
	private $trid;	
	public function setCTRID($value){
		$this->trid = $value;
	}
	public function getCTRID(){
		return $this->trid;
	}
	
	private $TeamID;
	public function setCTeamID($value){
		$this->TeamID = $value;
	}
	public function getCTeamID(){
		return $this->TeamID;
	}
	
	private $rid;
	public function setRID($value){
		$this->rid = $value;
	}
	public function getRID(){
		return $this->rid;
	}

}

class RacerManager{
	public function renameTeam($id, $name){
		$sql = "update `c_team` set `name` = '$name' where `teamid` = $id";
		queryDB($sql);
		return 1;
	}
	public function testTName($n){
		$sql = "select * from `c_team` where `name` = '$n'";
		$q_result = queryDB($sql);
		return mysql_num_rows($q_result) !=0 ? 0 : 1;
	}
	
	public function userAddGroup($user,$gr){
		$sql="
			insert into `phpbb_user_group` 
				(user_id, group_id, group_leader, user_pending)
			values ($user,$gr,0,0)
		";
		queryDB($sql);
	}
	
	public function chechName($name){
		$sql ="
			SELECT 1 
			FROM `phpbb_users`
			WHERE lower(`username`) = lower('$name')";
			
		$q_result = queryDB($sql);	
		while ($row = mysql_fetch_array($q_result, MYSQL_ASSOC))
		{
			return false;
		}
		return true;
	}
	
	public function getRacer($id){
		
		$not = $_SESSION['params']['hided'] ? "" : "not";
		$sql = "SELECT 
					fd.user_id,
					pf_rm_l_name,
					pf_rm_f_name,
					pf_rm_address,
					pf_rm_phone,
					pf_rm_sex,
					pf_rm_ins,
					pf_rm_pk,
					pf_rm_sport_nr,
					pf_rm_moto_name,
					pf_rm_moto_v,
					pf_rm_country,
					pf_rm_bd_year,
					pf_rm_moto_type,
					pf_rm_club,
					
					pf_rm_allow_emails,
					ifnull(pf_rm_enduro_manager,-1) as pf_rm_enduro_manager,
					
					us.user_email,
					
					lic.`LIC_NR` as pf_rm_lic_nr,
					lic.`TYPE` as TYPE,
					YEAR(lic.`START_DATE`) as YR,
					
					
					contry.lang_value as cont_name,
					club.`name` as club_name
					
				FROM `phpbb_profile_fields_data` fd
					inner join `phpbb_users` us on (us.`user_id` = fd.`user_id`)
						left join (
							select 
								fd1.`user_id`,
								max(lic1.`ID`) as ID
							from `phpbb_profile_fields_data` fd1
								inner join `enduro_licence` lic1 on lic1.`racer_id` = fd1.`user_id`
							group by fd1.`user_id`						
						) l on l.`user_id` = fd.`user_id`
							left join `enduro_licence` lic on lic.`ID` = l.`ID`
								left join `phpbb_profile_fields_lang` contry on (
									contry.`option_id` = fd.`pf_rm_country`  and
									contry.`field_id` = ".KL_COUNT."
								) 
							left join `c_club` club on club.`id` = `pf_rm_club`
				WHERE 
					fd.`user_id` in (select `user_id` from `phpbb_user_group` where `group_id` = ".RACER_GROUP_ID.") and
					fd.`user_id` $not in (select `id` from `c_racer_hide`)
					
		";
		
		if ($id <> "") {
			$sql = $sql." and fd.`user_id` = $id";
		}
		
		$order = $_SESSION['params']['sort']=="nr" ? " coalesce(
		case 
			when pf_rm_sport_nr = '' then 'zzz'
			else pf_rm_sport_nr
		end 
		,'zzz'), " : "";		
		
		$sql = $sql ."
			order by $order pf_rm_f_name, pf_rm_l_name, us.user_email
		";
	//echo $sql;
		$q_result = queryDB($sql);		
		$reslt = array();		
		 while ($row = mysql_fetch_array($q_result, MYSQL_ASSOC)) {
			
			$item = new Racer;
			
			$item->setUserID($row['user_id']);
			$item->setLname($row['pf_rm_l_name']);
			$item->setFname($row['pf_rm_f_name']);
			$item->setAddr($row['pf_rm_address']);
			$item->setTel($row['pf_rm_phone']);			
			$item->setSex($row['pf_rm_sex']);
			$item->setIns($row['pf_rm_ins']);
			$item->setPK($row['pf_rm_pk']);
			$item->setTehn($row['pf_rm_moto_type']);
			$item->setTehnN($row['pf_rm_moto_name']);			
			$item->setMotocc($row['pf_rm_moto_v']);
			$item->setValsts($row['pf_rm_country']);
			$item->setBYear($row['pf_rm_bd_year']);
			$item->setNR($row['pf_rm_sport_nr']);
			$item->setClub($row['pf_rm_club']);
			$item->setLNR($row['pf_rm_lic_nr']);
			$item->setClub_name($row['club_name']);
			$item->setValsts_name($row['cont_name']);
			$item->setMail($row['user_email']);
			
			$item->allowemails = ($row['pf_rm_allow_emails']==1 ? 1: 0);
			$item->enduromanager = ($row['pf_rm_enduro_manager'] == 0 ? 1 : 0);
			
			
			$item->LIC_TYPE = $row['TYPE'];
			$item->LIC_YR = $row['YR'];
			
			array_push($reslt,$item);
		}
		
		if (count($reslt)<1 && $id <> ""){
			
			$item = new Racer;
			
			$item->setUserID($id);
			$item->setLname('Neaktuāls');
			$item->setFname('Sportists');
			array_push($reslt, $item);
		}
		
		return $reslt;
		
	}
	
	public function getLastRacer($user){
		$sql = "SELECT * FROM `c_racer`";
		$where = "";
		if ($user <> "") {$where = "`UserID` = '$user'";}
		if ($where <> "") {$sql = "$sql where $where";}	
		$sql="$sql ORDER BY `RacerID` desc LIMIT 1";
		$q_result = queryDB($sql);
		
		$reslt = array();		
		 while ($row = mysql_fetch_array($q_result, MYSQL_ASSOC)) {
			
			$item = new Racer;
			$item->setUserID($row['UserID']);
			$item->setRacerID($row['RacerID']);
			$item->setLinked($row['Linked']);
			
			array_push($reslt,$item);
		}
		
		return $reslt;
		
	}
	public function getFreeRacer(){
		$sql = "SELECT * 
				FROM `phpbb_profile_fields_data` pd
				WHERE 
					exists (
						select *
						from `phpbb_user_group` ug
						where
							pd.`user_id` = ug.`user_id` and
							ug.`group_id` = ".RACER_GROUP_ID."
					) and
					not exists (
						select * 
						from `c_teamracer` tr
						where tr.`racerid` = pd.`user_id`
					)";
	
		$q_result = queryDB($sql);
		//echo $sql;
		$reslt = array();		
		 while ($row = mysql_fetch_array($q_result, MYSQL_ASSOC)) {
			
			$item = new Racer;
			
			$item->setUserID($row['user_id']);
			$item->setLname($row['pf_rm_l_name']);
			$item->setFname($row['pf_rm_f_name']);
			$item->setAddr($row['pf_rm_address']);
			$item->setTel($row['pf_rm_phone']);			
			$item->setSex($row['pf_rm_sex']);
			$item->setIns($row['pf_rm_ins']);
			$item->setPK($row['pf_rm_pk']);
			$item->setTehn($row['pf_rm_moto_type']);
			$item->setTehnN($row['pf_rm_moto_name']);			
			$item->setMotocc($row['pf_rm_moto_v']);
			$item->setValsts($row['pf_rm_country']);
			$item->setBYear($row['pf_rm_bd_year']);
			$item->setNR($row['pf_rm_sport_nr']);
			$item->setClub($row['pf_rm_club']);
			$item->setLNR($row['pf_rm_lic_nr']);
			$item->setClub_name($row['club_name']);
			$item->setValsts_name($row['cont_name']);
			
			array_push($reslt,$item);
		}
		
		return $reslt;
		
	}
	public function getFreeCRacer($club){
		$sql = "SELECT * FROM `c_racer` r";
		$sql = "$sql INNER JOIN (SELECT * 
								 FROM `c_racerdet` rd
								 INNER JOIN (SELECT max( `TimeStamp` ) , `RacerDetID` as rd2
											 FROM `c_racerdet` 
											 GROUP BY `RacerID` 
											 )rd2 ON ( rd.`RacerDetID` = rd2.`rd2` ) 
								)inf on (inf.`RacerID` = r.`RacerID`)";
		$sql ="$sql where not (r.`RacerID` in (select distinct(cr.`RacerId`) from `c_clubtracer` cr )) and inf.`Club` = $club";
			//echo $sql;
		$q_result = queryDB($sql);
		
		$reslt = array();		
		 while ($row = mysql_fetch_array($q_result, MYSQL_ASSOC)) {
			
			$item = new Racer;
			$item->setUserID($row['UserID']);
			$item->setRacerID($row['RacerID']);
			$item->setLinked($row['Linked']);
			
			array_push($reslt,$item);
		}
		
		return $reslt;
		
	}
	public function insRacer($userid,$linked){
		$sql = "INSERT INTO `c_racer` (`UserID`,`Linked`)
				VALUES($userid,$linked)" ;
		queryDB($sql);
	}

	public function saveRacerInfo($racerid,$lname,$fname,$pk,$address,$phone,$sex,$ins,$teh,$tehinfo,$nr,$club,$lnr,$motocc,$byear,$cont,$em,$tn){
		
		if (!$motocc){$motocc = 'null';}
		
		$sql = "UPDATE  `phpbb_profile_fields_data`
				SET					
					pf_rm_l_name = '$lname',
					pf_rm_f_name = '$fname',
					pf_rm_address = '$address',
					pf_rm_phone = '$phone',
					pf_rm_sex = $sex,					
					pf_rm_pk = '$pk',
					pf_rm_sport_nr = '$nr',
					pf_rm_country = $cont,
					pf_rm_bd_year = $byear,					
					pf_rm_enduro_manager = ".($em ? 0 : 1).",
					pf_rm_moto_name = '$tn',
					pf_rm_club = ".($club?$club:"null")."
					
				WHERE `user_id` = $racerid;
		";
		//pf_rm_ins = $ins,
		
					//pf_rm_moto_name = '$tehinfo',
		//			pf_rm_moto_v = $motocc,
		//pf_rm_moto_type = $teh,
		//			pf_rm_club = $club,
		//			pf_rm_lic_nr = '$lnr',
		//echo $sql;
		
		queryDB($sql);
	}
	
	public function insTeam($name){
		$sql = "INSERT INTO `c_team` (`Name`)  VALUES ('$name')";
		queryDB($sql);
		$sql = "select LAST_INSERT_ID() as id";
		$r = queryDB($sql);
		$r1 = mysql_fetch_array($r, MYSQL_ASSOC);
		return "OK".$r1["id"];
	}
	public function getTeam($tid,$racer,$withracer,$name){
		$sql = "SELECT t.`TeamID`,t.`Name`,t.`ACTIVE` from `c_team` t";
		
		if ($racer<>""){
			$sql = "$sql INNER JOIN `c_teamracer` tr ON (t.`TeamID` = tr.`TeamID`)";
		}
		
		$where = "";
		if ($tid<> ""){$where = "t.`TeamID` = $tid";}
		if ($racer <> ""){
			if ($where <> ""){$where = "$where and ";}
			$where = "$where tr.`RacerID` = $racer";
		}
		if ($name <> ""){
			if ($where <> ""){$where = "$where and ";}
			$where = "$where t.`Name` = '$name'";
		}
		
		if ($where <> ""){$sql = "$sql where $where";}
		
		$q_result = queryDB($sql);
		
		$reslt = array();		
		 while ($row = mysql_fetch_array($q_result, MYSQL_ASSOC)) {
			$item = new Team;
			
			$item->setId($row['TeamID']);
			$item->setName($row['Name']);
			$item->setActive($row['ACTIVE']);
			
			if ($withracer == 1){
				$item->setRacers($this->getTeamRacer("","",$row['TeamID'],""));
			}
			
			array_push($reslt,$item);
		}
		
		return $reslt;		
	}
	public function getActTeam($tid,$racer,$withracer,$name,$act){
		$sql = "SELECT t.`TeamID`,t.`Name`,t.`ACTIVE` from `c_team` t";
		
		if ($racer<>""){
			$sql = "$sql INNER JOIN `c_teamracer` tr ON (t.`TeamID` = tr.`TeamID`)";
		}
		
		$where = "";
		if ($tid<> ""){$where = "t.`TeamID` = $tid";}
		if ($racer <> ""){
			if ($where <> ""){$where = "$where and ";}
			$where = "$where tr.`RacerID` = $racer";
		}
		if ($name <> ""){
			if ($where <> ""){$where = "$where and ";}
			$where = "$where t.`Name` = '$name'";
		}
		if ($act <> ""){
			if ($where <> ""){$where = "$where and ";}
			$where = "$where t.`active` = '$name'";
		}
		if ($where <> ""){$sql = "$sql where $where";}
		
		$q_result = queryDB($sql);
		
		$reslt = array();		
		 while ($row = mysql_fetch_array($q_result, MYSQL_ASSOC)) {
			$item = new Team;
			
			$item->setId($row['TeamID']);
			$item->setName($row['Name']);
			$item->setActive($row['ACTIVE']);
			
			if ($withracer == 1){
				$item->setRacers($this->getTeamRacer("","",$row['TeamID'],""));
			}
			
			array_push($reslt,$item);
		}
		
		return $reslt;		
	}
	public function saveTeam($id,$name){
		$sql = "UPDATE `c_team` SET `Name` = '$name' WHERE `TeamID` = $id";
		
		queryDB($sql);
	}
	
	public function insCTeam($name,$club){
		$sql = "INSERT INTO `c_clubteam` (`Name`,`ClubID`)  VALUES ('$name',$club)";
		queryDB($sql);
	}
	public function getCTeam($tid,$racer,$withracer,$name,$club){
		$sql = "SELECT t.`CT_ID`,t.`Name`,t.`ClubID` from `c_clubteam` t";
		
		if ($racer<>""){
			$sql = "$sql INNER JOIN `c_clubtracer` tr ON (t.`CT_ID` = tr.`CT_ID`)";
		}
		
		$where = "";
		if ($tid<> ""){$where = "t.`CT_ID` = $tid";}
		if ($racer <> ""){
			if ($where <> ""){$where = "$where and ";}
			$where = "$where tr.`RacerID` = $racer";
		}
		if ($name <> ""){
			if ($where <> ""){$where = "$where and ";}
			$where = "$where t.`Name` = '$name'";
		}
		if ($club <> ""){
			if ($where <> ""){$where = "$where and ";}
			$where = "$where t.`ClubID` = '$club'";
		}
		if ($where <> ""){$sql = "$sql where $where";}
		
		$q_result = queryDB($sql);
		
		$reslt = array();		
		 while ($row = mysql_fetch_array($q_result, MYSQL_ASSOC)) {
			$item = new ClubTeam;
			
			$item->setId($row['CT_ID']);
			$item->setName($row['Name']);
			$item->setClubID($row['ClubID']);
			if ($withracer == 1){
				$item->setRacers($this->getCTeamRacer("","",$row['CT_ID'],""));
			}
			
			array_push($reslt,$item);
		}
		
		return $reslt;
		
	}
	public function saveCTeam($id,$name){
		$sql = "UPDATE `c_clubteam` SET `Name` = '$name' WHERE `CT_ID` = $id";
		
		queryDB($sql);
	}
	
	public function insCTeamRacer($racer,$team,$isLead){
		$sql = "INSERT INTO `c_clubtracer` (`RacerID`,`CT_ID`,`IsLeader`)  VALUES ($racer,$team,$isLead)";
		
		queryDB($sql);
	}
	public function getCTeamRacer($id,$racer,$team,$led){
		$sql = "SELECT * FROM `c_clubtracer` ";
		$where = "";
		
		if ($id <> "") {$where = "`CTR_ID` = '$id'";}
		if ($racer <> "") {
			if ($where <> "") { $where = "$where and";}
			$where = "$where `RacerID` = $racer";			
		}
		if ($team <> "") {
			if ($where <> "") { $where = "$where and";}
			$where = "$where `CT_ID` = $team";			
		}
		if ($led <> "") {
			if ($where <> "") { $where = "$where and";}
			$where = "$where `IsLeader` = $led";			
		}
		if ($where <> ""){$sql = "$sql where $where";}
		
		$q_result = queryDB($sql);
		
		$reslt = array();		
		 while ($row = mysql_fetch_array($q_result, MYSQL_ASSOC)) {
			$item = new TeamRacer;
			
			$item->setTRID($row['CTR_ID']);
			$item->setRacerID($row['RacerID']);
			$item->setTeamID($row['CT_ID']);
			$item->setIsLeader($row['IsLeader']);
			
			array_push($reslt,$item);
		}
		
		return $reslt;
	}
	public function delCTeamRacer($id,$racer){
		$sql = "DELETE FROM `c_clubtracer`";
		$where ="";
		if ($id <> "") {$where = "`CTR_ID` = $id";}
		if ($racer <> ""){
			if ($where <> ""){$where = "$where and";}
			$where = "$where `RacerID` = $racer";
		}
		if ($where <> ""){$sql = "$sql where $where";}
		queryDB($sql);
	}
	public function makeCTLead($rac){
		$t = $this->getTeam("",$rac,1,"");
		
		$this->remLeader($t[0]->getID());
		
		
		$sql="UPDATE `c_teamracer` SET `IsLeader` = 1 WHERE `RacerID`= $rac;";
		//echo $sql;
		queryDB($sql);
	}
	public function remCTLeader($tim){
		$sql = "UPDATE `c_teamracer` SET `IsLeader` = 0 WHERE `TeamID`= $tim";
		//echo $sql;
		queryDB($sql);
	}
	
	public function insTeamRacer($racer,$team,$isLead){
		$sql = "INSERT INTO `c_teamracer` (`RacerID`,`TeamID`,`IsLeader`)  VALUES ($racer,$team,$isLead)";
		
		queryDB($sql);
	}
	public function getTeamRacer($id,$racer,$team,$led){
		$sql = "SELECT * FROM `c_teamracer` ";
		$where = "";
		
		if ($id <> "") {$where = "`TeamRacerID` = '$id'";}
		if ($racer <> "") {
			if ($where <> "") { $where = "$where and";}
			$where = "$where `RacerID` = $racer";			
		}
		if ($team <> "") {
			if ($where <> "") { $where = "$where and";}
			$where = "$where `TeamID` = $team";			
		}
		if ($led <> "") {
			if ($where <> "") { $where = "$where and";}
			$where = "$where `IsLeader` = $led";			
		}
		if ($where <> ""){$sql = "$sql where $where";}
		
		$q_result = queryDB($sql);
		
		$reslt = array();		
		 while ($row = mysql_fetch_array($q_result, MYSQL_ASSOC)) {
			$item = new TeamRacer;
			
			$item->setTRID($row['TeamRacerID']);
			$item->setRacerID($row['RacerID']);
			$item->setTeamID($row['TeamID']);
			$item->setIsLeader($row['IsLeader']);
			$item->setRacerDet($this->getRacer($row['RacerID']));
			
			array_push($reslt,$item);
		}
		
		return $reslt;
	}
	public function delTeamRacer($id,$racer){
		$sql = "DELETE FROM `c_teamracer`";
		$where ="";
		if ($id <> "") {$where = "`TeamRacerID` = $id";}
		if ($racer <> ""){
			if ($where <> ""){$where = "$where and";}
			$where = "$where `RacerID` = $racer";
		}
		if ($where <> ""){$sql = "$sql where $where";}
		queryDB($sql);
	}
	public function makeLead($rac){
		$t = $this->getTeam("",$rac,1,"");
		
		$this->remLeader($t[0]->getID());
		
		
		$sql="UPDATE `c_teamracer` SET `IsLeader` = 1 WHERE `RacerID`= $rac;";
		//echo $sql;
		queryDB($sql);
	}
	public function remLeader($tim){
		$sql = "UPDATE `c_teamracer` SET `IsLeader` = 0 WHERE `TeamID`= $tim";
		//echo $sql;
		queryDB($sql);
	}
	
	public function insTeamRace($tid,$rid,$cid){
		$sql = "INSERT INTO `e_teamrace` (`TeamID`,`RaceID`,`ClassID`) VALUES ($tid,$rid,$cid);";
		//echo $sql;
		queryDB($sql);
	}
	public function getTeamRace($id,$tid,$rid,$cid){
		$sql = "SELECT * FROM `e_teamrace`";
		$where = "";
		
		if ($tid <> "") {$where = "`TeamID` = '$tid'";}
		if ($rid <> "") {
			if ($where <> "") { $where = "$where and";}
			$where = "$where `RaceID` = $rid";			
		}
		if ($id <> "") {
			if ($where <> "") { $where = "$where and";}
			$where = "$where `TRID` = $id";			
		}
		if ($cid <> "") {
			if ($where <> "") { $where = "$where and";}
			$where = "$where `ClassID` = $cid";			
		}
		if ($where <> ""){$sql = "$sql where $where order by Accepted desc";}
		$q_result = queryDB($sql);
		//echo $sql;
		$reslt = array();		
		 while ($row = mysql_fetch_array($q_result, MYSQL_ASSOC)) {
			$item = new TeamRace;
			
			$item->setTRID($row['TRID']);
			$item->setCID($row['ClassID']);
			$item->setRID($row['RaceID']);
			$item->setTeamID($row['TeamID']);
			$item->setACC($row['Accepted']);
			$item->setComp($row['Completed']);
			
			array_push($reslt,$item);
		}
		
		return $reslt;
	}
	public function getACCTeamRace($rid,$cid,$withDel,$compl){
		if (!($compl <> "")){$compl = 0;}
		$sql = "SELECT tr.`TRID`,tr.`ClassID`,tr.`RaceID`,tr.`TeamID`,tr.`Accepted`,tr.`Closed`,tr.`Completed`,count(trc.`TRID`) as cnt ,sum(ch.`cost`) as sum_cost FROM `e_teamrace` tr
				LEFT JOIN `e_trchp` trc on ((tr.`TRID` = trc.`TRID`)";
		if ($withdel<>1){
			$sql ="$sql and trc.`Deleted` <> 1";
		}
		$sql=		"$sql )left join `d_checkpoint` ch on (ch.`CP_ID` = trc.`ChpID`)";
				//
				$sql = "$sql WHERE tr.`RaceID` = '$rid'";
				if($cid<> ""){$sql = "$sql  and `ClassID` = $cid ";}
				$sql = "$sql and tr.`Accepted` = 1 ";
				if ($compl<> ""){
				$sql = "$sql and tr.`Completed` = $compl  ";
				}
				
				
				$sql ="$sql group by tr.`TRID`
				order by sum_cost desc, cnt desc
				";
		
		//echo $sql;
		$q_result = queryDB($sql);
		
		$reslt = array();		
		 while ($row = mysql_fetch_array($q_result, MYSQL_ASSOC)) {
			$item = new TeamRace;
			
			$item->setTRID($row['TRID']);
			$item->setCID($row['ClassID']);
			$item->setRID($row['RaceID']);
			$item->setTeamID($row['TeamID']);
			$item->setACC($row['Accepted']);
			$item->setClosed($row['Closed']);
			$item->setComp($row['Completed']);
			$item->setCNT($row['cnt']);
			$item->setSUM($row['sum_cost']);
			
			array_push($reslt,$item);
		}
		
		return $reslt;
	}
	
	public function getACCTeamRace1($rid,$cid,$withDel,$chmp){
		
		$sql = "SELECT tr.`TRID`,tr.`ClassID`,tr.`RaceID`,tr.`TeamID`,tr.`Accepted`,tr.`Closed`,tr.`Completed`,count(trc.`TRID`) as cnt ,sum(ch.`cost`) as sum_cost 
				FROM `e_teamrace` tr
					inner join `d_race` rc on (rc.`race_id` = tr.`raceid`)
					left join `e_trchp` trc on ((tr.`TRID` = trc.`TRID`)".($withdel<>1 ? " and trc.`Deleted` <> 1" : "").")
						left join `d_checkpoint` ch on (ch.`CP_ID` = trc.`ChpID`)
				WHERE 
					tr.`Accepted` = 1 ".
					($rid  ? " and tr.`RaceID`  = $rid"  : "").
					($cid  ? " and tr.`ClassID` in ($cid)"  : "").
					($chmp ? " and rc.`ch_id`   = $chmp" : "")."
				GROUP BY tr.`TRID`
				ORDER BY sum_cost desc, cnt desc
				";
		
		//echo $sql;
		$q_result = queryDB($sql);
		
		$reslt = array();		
		 while ($row = mysql_fetch_array($q_result, MYSQL_ASSOC)) {
			$item = new TeamRace;
			
			$item->setTRID($row['TRID']);
			$item->setCID($row['ClassID']);
			$item->setRID($row['RaceID']);
			$item->setTeamID($row['TeamID']);
			$item->setACC($row['Accepted']);
			$item->setClosed($row['Closed']);
			$item->setComp($row['Completed']);
			$item->setCNT($row['cnt']);
			$item->setSUM($row['sum_cost']);
			
			array_push($reslt,$item);
		}
		
		return $reslt;
	}
	
	public function getResults($rid,$cid,$withDel,$chmp){
		
		$sql = "
			SELECT 
				tr.`TRID`,
				tr.`ClassID`,
				tr.`RaceID`,
				tr.`TeamID`,
				tr.`Accepted`,
				tr.`Closed`,
				tr.`Completed`,
					
				coalesce(
					(
						select 
							sum(
								case 
									when trc.`AOK` =  1 and trc.`IOK` = 1 
										then chp.`cost` 
									when not trc.`AOK` =  1 and trc.`IOK` = 1 
										then chp.`cost` -1
									else 0					
								end
							)
						from `e_trchp` trc
							inner join `d_checkpoint` chp on (trc.`ChpID` = chp.`CP_ID`)
						where 
							trc.`TRID` = tr.`TRID` and
							not trc.`deleted` = 1 
					)
				,0) +
				coalesce(
					(
						select 
							sum(sup.`PTS`)
						from `e_suprot` sup
						where 
							sup.`TR_ID` = tr.`TRID`
					)
				,0) -
				coalesce(
					(
						select 
							sum(pen.`pen`)
						from `e_sodsprot` pen
						where 
							pen.`TRID` = tr.`TRID`
					)
				,0) -
				coalesce(
					(
						select 
							sum(
								case 
									when sfp.`FIN` > sf.`Fin`
										then floor(TIME_TO_SEC(TIMEDIFF(sfp.`FIN`,sf.`Fin`))/60)
									else 0
								end
							) 
						from `e_stfinprot` sfp
							inner join `d_stfin` sf on (sf.`StFinID` = sfp.`SF_ID`)
						where 
							sfp.`TR_ID` = tr.`TRID`
					)
				,0) as total_pts,
				
				coalesce(
					(
						select 
							sum(chp.`cost`)
						from `e_trchp` trc
							inner join `d_checkpoint` chp on (trc.`ChpID` = chp.`CP_ID`)
						where 
							trc.`TRID` = tr.`TRID` and
							not trc.`deleted` = 1 
					)
				,0) as pts_sum,
				
				coalesce(
					(
						select 
							sum(1)
						from `e_trchp` trc
							inner join `d_checkpoint` chp on (trc.`ChpID` = chp.`CP_ID`)
						where 
							trc.`TRID` = tr.`TRID` and 
							not trc.`AOK` = 1 and
							not trc.`deleted` = 1 
					)
				,0) as NAOK_pts,
				
				coalesce(
					(
						select 
							sum(chp.`cost`)
						from `e_trchp` trc
							inner join `d_checkpoint` chp on (trc.`ChpID` = chp.`CP_ID`)
						where 
							trc.`TRID` = tr.`TRID` and 
							not trc.`IOK` = 1 and
							not trc.`deleted` = 1 
					)
				,0) as NIOK_pts,
				
				coalesce(
					(
						select 
							sum(sup.`PTS`)
						from `e_suprot` sup
						where 
							sup.`TR_ID` = tr.`TRID`
					)
				,0) as SU_pts,
				
				coalesce(
					(
						select 
							sum(pen.`pen`)
						from `e_sodsprot` pen
						where 
							pen.`TRID` = tr.`TRID`
					)
				,0) as pen,
				
				coalesce(
					(
						select 
							sum(
								case 
									when sfp.`FIN` > sf.`Fin`
										then floor(TIME_TO_SEC(TIMEDIFF(sfp.`FIN`,sf.`Fin`))/60)
									else 0
								end
							) 
						from `e_stfinprot` sfp
							inner join `d_stfin` sf on (sf.`StFinID` = sfp.`SF_ID`)
						where 
							sfp.`TR_ID` = tr.`TRID`
					)
				,0) as sfpen,
				
				SEC_TO_TIME(
					(
						select 
							sum(TIME_TO_SEC( TIMEDIFF(  sfp.`FIN` ,  sf.`Start` ) ) )
						from `e_stfinprot` sfp
							inner join `d_stfin` sf on (sf.`StFinID` = sfp.`SF_ID`)
						where 
							sfp.`TR_ID` = tr.`TRID`
					)
				) as fintime
			FROM `e_teamrace` tr
			
			WHERE 				
				tr.`Accepted` = 1 ".
				($rid  ? " and tr.`RaceID`  = $rid"  : "").
				($cid  ? " and tr.`ClassID` in ($cid)"  : "")."
			ORDER BY total_pts desc, fintime asc
				";
		
		//echo $sql;
		$q_result = queryDB($sql);
		
		$reslt = array();		
		 while ($row = mysql_fetch_array($q_result, MYSQL_ASSOC)) {
					
			$item['TRID'] = $row['TRID'];
			$item['ClassID'] = $row['ClassID'];
			$item['RaceID'] = $row['RaceID'];
			$item['TeamID'] = $row['TeamID'];
			$item['Accepted'] = $row['Accepted'];
			$item['Closed'] = $row['Closed'];
			$item['Completed'] = $row['Completed'];
						
			$item['total_pts'] = $row['total_pts'];
			$item['pts_sum'] = $row['pts_sum'];
			$item['NAOK_pts'] = $row['NAOK_pts'];
			$item['NIOK_pts'] = $row['NIOK_pts'];
			$item['SU_pts'] = $row['SU_pts'];
			$item['pen'] = $row['pen'];
			$item['sfpen'] = $row['sfpen'];
			$item['fintime'] = $row['fintime'];
			
			array_push($reslt,$item);
		}
		
		return $reslt;
	}
	
	public function delTeamRace($id){
		$sql="DELETE FROM `e_teamrace` WHERE `TRID` = $id";
		queryDB($sql);
	}
	public function acceptTRace($tr){
		$sql = "UPDATE `e_teamrace` SET `Accepted` = 1 WHERE `TRID` = $tr";			
		queryDB($sql);
	}
	public function unacceptTRace($tr){
		$sql = "UPDATE `e_teamrace` SET `Accepted` = 0 WHERE `TRID` = $tr";
		queryDB($sql);
	}
	
	public function getTRRacer($tr){
		$sql="
			SELECT 
				trr.`TRID`,
				trr.`TeamRacerID`,
				trr.`TRRacerID` ,
				trr.`NR`,
				trr.`TEHN`,
				trr.`LIC_NR`,
				trr.`TYPE`,
				trr.`club`,
				c.`NAME` as club_name,
				trr.`ins`
			from `e_trracer` trr
				left join `c_club` c on c.`id` = trr.`club`
			where  trr.`TRID` = $tr";
			
		//echo $sql;
		$q_result = queryDB($sql);
		
		$reslt = array();		
		while ($row = mysql_fetch_array($q_result, MYSQL_ASSOC)) {
			$item = new TRRacer;
			
			$item->setID($row['TRRacerID']);
			$item->setTRRID($row['TeamRacerID']);
			$item->setTRID($row['TRID']);
			
			$item->nr = $row['NR'];
			$item->tehn = $row['TEHN'];
			$item->lic = $row['LIC_NR'];
			$item->type = $row['TYPE'];
			$item->club = $row['club'];
			$item->clubName = $row['club_name'];
			$item->ins = $row['ins'];
			
			array_push($reslt,$item);
		}
		
		return $reslt;
	}	
	public function delTRRacer($id,$trid){
		$sql="DELETE FROM `e_trracer` WHERE `TRID` = $trid";
		queryDB($sql);
	}
	public function insTrRacer($trace,$tracer,$nr,$teh,$lic,$type,$cl,$ins){
		$sql="INSERT INTO `e_trracer` (`TRID`,`TeamRacerID`,`NR`,`TEHN`,`LIC_NR`,`TYPE`,`CLUB`,`INS`) 
				VALUES ($trace,$tracer,".($nr?"'".$nr."'":"null").",".($teh?"'".$teh."'":"null").",".($lic?"'".$lic."'":"null").",".($type?$type:"null").",".($cl?$cl:"null").",".($ins?$ins:"null").");";
		//echo $sql;
		queryDB($sql);
	}
		
	public function getClub($id){
				
		$sql = "
		
		select null as ID ,'<Nav izvēlēts>' as NAME,null as COUNTRY,null as cName
				union all
		SELECT 
					ID,
					NAME,
					COUNTRY,
					lang_value as cName
				FROM  `c_club` c
					left join `phpbb_profile_fields_lang` contry on (
						contry.`option_id` = c.`COUNTRY` and
						contry.`field_id` = ".KL_COUNT."
					)	

			
		";
			
		
		if ($id) {$sql = $sql .		"
			where `ID` = ".$id;
		} 
		
		$sql = $sql ."
			order by NAME
		";
		//echo $sql;
		$q_result = queryDB($sql);
		
		$reslt = array();		
		 while ($row = mysql_fetch_array($q_result, MYSQL_ASSOC)) {
			
			$item = new Club;
			
			$item->setId($row['ID']);
			$item->setName($row['NAME']);
			$item->setCountry($row['COUNTRY']);
			$item->setcName($row['cName']);
			array_push($reslt,$item);
		}
		return $reslt;
	}
	public function insClub($name,$c){
		
		$sql = "INSERT INTO `c_club` (`name`,`country`)VALUES ('$name',".($c?$c:" null ").");";
		//echo $sql;
		$q_result = queryDB($sql);
	}
	public function saveClub($id,$name,$c){
		$sql = "UPDATE `c_club` SET `name` = '$name' , `country`  = ".($c?$c:" null ")." where `ID` = $id;";
		//echo $sql;
		$q_result = queryDB($sql);
	}
	public function delClub($id){
		$sql = "delete from `c_club` where `ID` = $id;";
		//echo $sql;
		$q_result = queryDB($sql);
	}

	public function insCTeamRace($tid,$rid){
		$sql = "INSERT INTO `e_clubteamrace` (`CT_ID`,`RACE_ID`) VALUES ($tid,$rid);";
		queryDB($sql);
	}
	public function getCTeamRace($id,$tid,$rid){
		$sql = "SELECT * FROM `e_clubteamrace`";
		$where = "";
		
		if ($tid <> "") {$where = "`CT_ID` = '$tid'";}
		if ($rid <> "") {
			if ($where <> "") { $where = "$where and";}
			$where = "$where `RACE_ID` = $rid";			
		}
		if ($id <> "") {
			if ($where <> "") { $where = "$where and";}
			$where = "$where `CTR_ID` = $id";			
		}
		
		if ($where <> ""){$sql = "$sql where $where ";}
		
		
		$q_result = queryDB($sql);
		
		$reslt = array();		
		 while ($row = mysql_fetch_array($q_result, MYSQL_ASSOC)) {
			$item = new ClubTRace;
			
			$item->setCTRID($row['CTR_ID']);
			$item->setCTeamID($row['CT_ID']);
			$item->setRID($row['RACE_ID']);
			
			array_push($reslt,$item);
		}
		
		return $reslt;
	}
	public function delCTeamRace($id){
		$sql = "DELETE FROM `e_clubteamrace` WHERE `CTR_ID` = $id;";
		queryDB($sql);
	}
	
	public function insCTrRacer($trace,$tracer,$cid){
		$sql="INSERT INTO `e_clubtrracer` (`RacerDet_ID`,`Class_ID`,`CTR_ID`) VALUES ($tracer,$cid,$trace);";
		//echo $sql;
		queryDB($sql);
	}
	public function delCTrRacer($id,$ctrid){
		$sql="DELETE FROM `e_clubtrracer`";
		$where = "";
		if ($id <> ""){$where = " `CTRR_ID` = $id";}
		if ($ctrid <> ""){
			if ($where <> "") { $where = "$where and";}
			$where = "$where `CTR_ID` = $ctrid";
		}
		if ($where <> ""){$sql = "$sql where $where ";}
		//echo $sql;
		queryDB($sql);
	}
	public function getCTRRacer($id,$racerdet,$ctr){
		$sql="SELECT * from `e_clubtrracer`";
		if ($id <> ""){$where = " `CTRR_ID` = $id";}
		if ($racerdet <> ""){
			if ($where <> "") { $where = "$where and";}
			$where = "$where `RacerDet_ID` = $racerdet";
		}
		if ($ctr <> ""){
			if ($where <> "") { $where = "$where and";}
			$where = "$where `CTR_ID` = $ctr";
		}

		if ($where <> ""){$sql = "$sql where $where ";}
		
		
		$q_result = queryDB($sql);
		
		$reslt = array();		
		while ($row = mysql_fetch_array($q_result, MYSQL_ASSOC)) {
			$item = new ClubTRRacer;
			
			$item->setID($row['CTRR_ID']);
			$item->setRDetID($row['RacerDet_ID']);
			$item->setCTRID($row['CTR_ID']);
			$item->setCID($row['Class_ID']);
					
			array_push($reslt,$item);
		}
		
		return $reslt;
	}

	public function getTeamLiast($r){
		$sql ="
			SELECT `teamid`
			FROM  `c_team` t
			WHERE 
				t.`teamid` NOT IN (
					SELECT  `teamid` 
					FROM  `e_teamrace` 
					WHERE raceid =$r
				)
			ORDER BY `name`";
		
		$q_result = queryDB($sql);
		$reslt = array();		
		 while ($row = mysql_fetch_array($q_result, MYSQL_ASSOC)) {
			$items = $this->getTeam($row['teamid'],"",1,"");
			array_push($reslt,$items[0]);
		}
		return $reslt;
	}
	public function getActTeamLiast($r,$a){
		$sql ="
			SELECT `teamid`
			FROM  `c_team` t
			WHERE 
				t.`teamid` NOT IN (
					SELECT  `teamid` 
					FROM  `e_teamrace` 
					WHERE raceid =$r
				) and
				t.`ACTIVE` = $a
			ORDER BY `name`";
		
		$q_result = queryDB($sql);
		$reslt = array();		
		 while ($row = mysql_fetch_array($q_result, MYSQL_ASSOC)) {
			$items = $this->getTeam($row['teamid'],"",1,"");
			array_push($reslt,$items[0]);
		}
		return $reslt;
	}
	
	public function setteamActive($t,$a){
		$sql="update `c_team` set `active` = $a where `teamid` = $t";		
		queryDB($sql);
	}
	
	public function trydelteam($t){
		$sql="delete from `c_teamracer` where `TeamID` = $t";				
		queryDB($sql);
		$sql="delete from `c_team` where `TeamID` = $t and not exists(select * from `e_teamrace` where `teamid` = $t)";				
		queryDB($sql);
	}
	
	public function getFreeRacerList($r){
		$sql = "SELECT 
					fd.user_id,
					pf_rm_l_name,
					pf_rm_f_name,
					pf_rm_address,
					pf_rm_phone,
					pf_rm_sex,
					pf_rm_ins,
					pf_rm_pk,
					pf_rm_sport_nr,
					pf_rm_moto_name,
					pf_rm_moto_v,
					pf_rm_country,
					pf_rm_bd_year,
					pf_rm_moto_type,
					pf_rm_club,
					
					pf_rm_allow_emails,
					ifnull(pf_rm_enduro_manager,-1) as pf_rm_enduro_manager,
					
					us.user_email,
					
					lic.`LIC_NR` as pf_rm_lic_nr,
					lic.`TYPE` as TYPE,
					YEAR(lic.`START_DATE`) as YR,
					
					
					contry.lang_value as cont_name,
					club.`name` as club_name,
					dates.latestdate latest_apl
					
				FROM `phpbb_profile_fields_data` fd
					inner join `phpbb_users` us on (us.`user_id` = fd.`user_id`)
						left join (
							select 
								fd1.`user_id`,
								max(lic1.`ID`) as ID
							from `phpbb_profile_fields_data` fd1
								inner join `enduro_licence` lic1 on lic1.`racer_id` = fd1.`user_id`
							group by fd1.`user_id`						
						) l on l.`user_id` = fd.`user_id`
							left join `enduro_licence` lic on lic.`ID` = l.`ID`
								left join `phpbb_profile_fields_lang` contry on (
									contry.`option_id` = fd.`pf_rm_country`  and
									contry.`field_id` = ".KL_COUNT."
								) 
							left join `c_club` club on club.`id` = lic.`club`

					left join (
						select max(r2.`date`) latestdate, apl2.racer_id
						from `enduro_application` apl2 
							inner join `d_race` r2 on apl2.`Race_id` = r2.`race_id`
                            group by apl2.racer_id
					) dates on dates.`racer_id` = us.`user_id`


				WHERE 
							fd.`user_id` not in (select racer_id from `enduro_application` where `race_id` = $r) and 
							fd.`user_id` in (select `user_id` from `phpbb_user_group` where `group_id` = ".RACER_GROUP_ID.") and
							fd.user_id not in (SELECT `ID` FROM `c_racer_hide`)
				ORDER BY `pf_rm_sport_nr`
			
		";
	//echo $sql;
		$q_result = queryDB($sql);		
		$reslt = array();		
		 while ($row = mysql_fetch_array($q_result, MYSQL_ASSOC)) {
			
			$item = new Racer;
			
			$item->setUserID($row['user_id']);
			$item->setLname($row['pf_rm_l_name']);
			$item->setFname($row['pf_rm_f_name']);
			$item->setAddr($row['pf_rm_address']);
			$item->setTel($row['pf_rm_phone']);			
			$item->setSex($row['pf_rm_sex']);
			$item->setIns($row['pf_rm_ins']);
			$item->setPK($row['pf_rm_pk']);
			$item->setTehn($row['pf_rm_moto_type']);
			$item->setTehnN($row['pf_rm_moto_name']);			
			$item->setMotocc($row['pf_rm_moto_v']);
			$item->setValsts($row['pf_rm_country']);
			$item->setBYear($row['pf_rm_bd_year']);
			$item->setNR($row['pf_rm_sport_nr']);
			$item->setClub($row['pf_rm_club']);
			$item->setLNR($row['pf_rm_lic_nr']);
			$item->setClub_name($row['club_name']);
			$item->setValsts_name($row['cont_name']);
			$item->setMail($row['user_email']);
			
			$item->allowemails = ($row['pf_rm_allow_emails']==1 ? 1: 0);
			$item->enduromanager = ($row['pf_rm_enduro_manager'] == 0 ? 1 : 0);
			
			
			$item->LIC_TYPE = $row['TYPE'];
			$item->LIC_YR = $row['YR'];
			$item->LATEST_APP_DATE = $row['latest_apl'];
			
			array_push($reslt,$item);
		}
		
		return $reslt;
	}
}

function editRacer($subf,$opt){
	switch($subf){
		case "up":
			racerUp($opt);
			viewList();
			break;		
		case "dwn":
			racerDwn($opt);
			viewList();
			break;
		case "prntracerList":
			prntracerList();
			break;
		case "renTeam":
			$rm =  new RacerManager;
			if ($rm->testTName($_SESSION['params']['name'])){
				if($_SESSION['params']['id'] == -1){
					echo $rm->insTeam($_SESSION['params']['name']);
				} else {
					echo $rm->renameTeam($_SESSION['params']['id'],$_SESSION['params']['name']);
				}
			} else {
				echo "Tāda komanda jau eksistē!";
			}
			break;
		case "importUser":
			imp();
			break;
		case "makelead":
			makeLead($opt);
			listMyTeam();
			break;
		case "myprofile":			
			printProfile($_SESSION['user']['user_id']);
			break;
		case "viewprofile":
			printProfile($opt);
			break;
		case "savemyprofile":
			saveProfile($_SESSION['params']['id']);
			switch($_SESSION['params']['red_f']){
				case "enduro":
					$_SESSION['params']['racer'] = $_SESSION['params']['id'];
					proceedEnduro($_SESSION['params']['red_s'],$opt);
					break;
				case "racer":
					editRacer($_SESSION['params']['red_s'],"");
					break;
				default:
					printProfile($_SESSION['params']['id']);	
			}			
			break;
		case "myteam":
			listMyTeam();
			break;
		case "newteam":
			printNewTeam();
			break;
		case "saveteam":
			saveTeam($opt);
			listMyTeam();
			break;
		case "addteamracer":
			printAddTRacer($opt);
			break;
		case "newteamracer":
			printNewTRacer($opt,0);
			break;
		case "savenewteamracer":
			saveNewTRacer($opt);
			printAddTRacer($opt);			
			break;
		case "saveaddteamracer":
			saveAddTRacer($opt);
			listMyTeam();
			break;
		case "remRacer":
			remRacer($opt);
			listMyTeam();
			break;
		case "raceAppl":
			printRaceAppl();
			break;
		case "raceAppl1":
			printRaceAppl1($opt);
			break;
		case "saveraceAppl":
			saveRaceAppl($opt);
			if ($_SESSION['params']['admin']){
				listTeamrace();
			} else {
				printRaceAppl();
			}
			break;
		case "raceapplist":					
			switch($_SESSION['params']['f2']){
				case "addtr":				
					saveRaceAppl($opt);
					break;
				case "acctr":					
					acctrApl(saveRaceAppl($opt));
					break;
				case "teamhide":
					trydelteam($opt);
					setteamActive($opt,0);
					break;
				case "teamunhide";
					setteamActive($opt,1);
					break;
				case "remRacer";
					remRacer($opt);
					break;				
				case "addTMate":
					saveAddTRacer($opt);
					break;
				default;
			}			
			listTeamrace();
			break;
		case "prntaddracer":
			printAddTeamMate($opt);
			break;
		case "accraceapplist":
			acctrApl($opt);
			listTeamrace();
			break;
		case "UNaccraceapplist":
			unacctrApl($opt);
			listTeamrace();
			break;	
		case "returnapl":
			returnAppl($opt);
			listTeamrace();
			break;
		case "clublist":
			printClub();
			break;	
		case "saveclub":
			
			saveClub($opt);
			printClub();
			break;
		case "delclub":
			delClub($opt);
			printClub();
			break;
		case "viewlist":
			viewList();
			break;
		case "mycteam":
			ListClubTeams();
			break;
		case "newcteam":
			printNewCTeam($opt);
			break;
		case "savecteam";
			savecteam($opt);
			ListClubTeams();
			break;	
		case "addcteamracer":
			printAddCTRacer($opt);
			break;
		case "saveaddcteamracer":
			saveAddCTRacer($opt);
			ListClubTeams();
			break;
		case "remCRacer":
			remCRacer($opt);
			ListClubTeams();
			break;
		case "raceCTAppl":
			printCTappl();
			break;
		case "appcteam";
			appcteam();
			printCTappl();
			break;
		case "remappcteam":
			remappcteam($opt);
			printCTappl();
			break;
		case "savenewuser":
			$id = saveNewUser();
						
			if ($id){
				if (!$_SESSION['params']['red_f']){
					echo "<p class=\"regusertitle\">",REG_USER_TITLE,"</p>";
					echo REG_USER_TXT;
				}			

					
				switch($_SESSION['params']['red_f']){
					case "enduro":					
						$_SESSION['params']['racer'] = $id;						
						proceedEnduro($_SESSION['params']['red_s'],$opt);
						break;
					case "appl":					
						registerNewUser($_SESSION['params']['red_s']);
						break;
					case "racer":					
						editRacer($_SESSION['params']['red_s'],$opt);
						break;
					case "":					
						break;
					default:					
						printAddTRacer($opt);
				}
			} else {
				printNewTRacer($opt,1);
			}
			
			break;
		default:
			
	}
}

function racerDwn($opt){
	$sql = "insert into `c_racer_hide` (`ID`) values ($opt)";
	queryDB($sql);	
}

function racerUp($opt){
	$sql = "delete from `c_racer_hide` where `ID` = $opt";
	queryDB($sql);
}

function trydelteam($t){
	$rcm = new RacerManager;
	$rcm->trydelteam($t);
}

function setteamActive($t,$a){
	$rcm = new RacerManager;
	$rcm->setteamActive($t,$a);
}

function saveNewUser(){	
	$rcm = new RacerManager;
	if ($_SESSION['params']['addmode']=="enduroreg"){
			
		$alfa = "1234567890qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM";
		$token = "";
		for($i = 0; $i < 7; $i ++) {
		  $token .= $alfa[rand(0, strlen($alfa))];
		}    
		
		$_SESSION['params']['p1'] =  $token;
		
		if (!$_SESSION['params']['hasmail']){
			$characters = array('ā'=>'a','č'=>'c','ē'=>'e','ģ'=>'g','ī'=>'i','ķ'=>'k','ļ'=>'l','ņ'=>'n','õ'=>'o','ŗ'=>'r','š'=>'s','ū'=>'u','ž'=>'z',
								'Ā'=>'a','Č'=>'c','Ē'=>'e','Ģ'=>'g','Ī'=>'i','Ķ'=>'k','Ļ'=>'l','Ņ'=>'n','Õ'=>'o','Ŗ'=>'r','Š'=>'s','Ū'=>'u','Ž'=>'z');
			
			$name= strtr(strtolower($_SESSION['params']['fn']),$characters).".".strtr(strtolower($_SESSION['params']['ln']),$characters);
			$i = 0;
			while(!$rcm->chechName($name.($i ? $i : "")."@enduromanager.eu")){						
				$i++;
			}				
			$_SESSION['params']['email'] = $name.($i ? $i : "")."@enduromanager.eu";
		}
	}	

	if(!filter_var(trim($_SESSION['params']['email']), FILTER_VALIDATE_EMAIL)) {
		echo prntWarn("e-pastam neatbilstošs formāts!");
		return 0; 
	} elseif (!$rcm->chechName(trim($_SESSION['params']['email']))) {
		echo prntWarn("Lietotājs ar tādu vārdu jau eksistē!");
		return 0; 
	} elseif (($_SESSION['params']['p1'] <> $_SESSION['params']['p2']) && ($_SESSION['params']['addmode']<>"enduroreg")) {
		echo prntWarn("Paroles nesakrīt!");		
		return 0;
	}
		
	$user_row = array(
		'username'				=> trim($_SESSION['params']['email']),
		'user_password'			=> password_hash($_SESSION['params']['p1'], PASSWORD_DEFAULT),
		'user_email'			=> trim($_SESSION['params']['email']),
		'group_id'				=> USER_GROUP_ID,
		'user_timezone'			=> 0.00,
		'user_dst'				=>  0,
		'user_lang'				=> "eng",
		'user_type'				=> 0,
		'user_actkey'			=> 0,
		'user_ip'				=> "193.41.45.81",
		'user_regdate'			=> time(),
		'user_inactive_reason'	=> 0,
		'user_inactive_time'	=> 0,
	);
	
	$cp_data = array(
		'pf_rm_f_name'			=> $_SESSION['params']['fn'],
		'pf_rm_l_name'			=> $_SESSION['params']['ln'],
		'pf_rm_pk'				=> $_SESSION['params']['pk'],		
		'pf_rm_address'			=> $_SESSION['params']['adr'],
		'pf_rm_phone'			=> $_SESSION['params']['tel'],
		'pf_rm_sex'				=> $_SESSION['params']['sex'],
		'pf_rm_ins'				=> !isset(	$_SESSION['params']['ins'])+1,
		'pf_rm_moto_type'		=> $_SESSION['params']['tt'],
		'pf_rm_moto_name'		=> $_SESSION['params']['tn'],
		'pf_rm_sport_nr'		=> $_SESSION['params']['nr'],
		'pf_rm_club'			=> $_SESSION['params']['club'],
		'pf_rm_lic_nr'			=> $_SESSION['params']['lnr'],
		'pf_rm_moto_v'			=> $_SESSION['params']['motocc']*1,
		'pf_rm_bd_year'			=> $_SESSION['params']['byear'],
		'pf_rm_country'			=> $_SESSION['params']['cont'],
		'pf_rm_allow_emails'	=> 1
	);
	
	$user_id = user_add($user_row, $cp_data);
	
	$rcm->userAddGroup($user_id,RACER_GROUP_ID);
	
	$text = str_replace("{pass}",$_SESSION['params']['p1'],USER_REG_TEXT);
	sendMail($_SESSION['params']['email'],"","Reģistrācija portālā www.enduromanager.eu",$text);
	
	return $user_id;
}

function remappcteam($opt){
	$rcm = new RacerManager;
	$rcm->delCTrRacer("",$opt);
	$rcm->delCTeamRace($opt);
}

function appcteam(){

	$rcrs = explode("x",$_POST["rar"]);
	if (count($rcrs)>7){
		echo "<h1 align=\"center\" style=\"color:red\">Komandas dalībnieku skaits nevar būt lielāks par 6!</h1>";
		return;
	}
	
	$rcm = new RacerManager;
	$rm = new raceManager;
	$r = $rm->getRace("","","",1,"",1);
	$rcm->insCTeamRace($_POST['ct'],$r[0]->getID());
	$ctr=$rcm->getCTeamRace("",$_POST['ct'],$r[0]->getID());
	
	for($i=1;$i<count($rcrs);$i++){
		$det = $rcm->getRacerInfo($rcrs[$i]);
		$rcm->insCTrRacer($ctr[0]->getCTRID(),$det[0]->getId(),$_POST["class".$rcrs[$i]]);	
	}
}

function printCTappl(){
	$rcm = new RacerManager;
	$cm = new champManager;
	$rm = new raceManager;
	$r = $rm->getRace("","","",1,"",1);
	$racer = $rcm->getRacer("",$_SESSION['user']->getID(),1);
	$racer = $rcm->getRacerWithDet($racer[0]->getRacerID());
	$ri = $racer[0]->getInfo();
	
	$club= $rcm->getClub($ri[0]->getClub());
	echo "\"<b>",$club[0]->getName(),"</b>\" kluba komandas";	
	
	$team = $rcm->getCTeam("","",1,"",$club[0]->getID());
	$cl = $cm->getActulaRaceClass("");
	for ($x=0;$x<count($team);$x++){
		$ctr=$rcm->getCTeamRace("",$team[$x]->getID(),$r[0]->getID());
		$rcrs = $team[$x]->getRacers();
		echo "<form action=\"index.php\" method=\"post\">";
		echo "<table width =\"100%\" border = \"1\">";
		echo "<tr class=\"title\"><td colspan =\"2\" ><b>",$team[$x]->getName(),"</b>";
		$r_ar="";
		for($i=0;$i<count($rcrs);$i++){
			$r_ar="$r_ar"."x".$rcrs[$i]->getRacerID();
			$rci = $rcm->getRacerInfo($rcrs[$i]->getRacerID());
			echo "<tr>";echo "<td width=\"150\"> ";
			if($ctr){
				$det = $rcm->getRacerInfo($rcrs[$i]->getRacerID());
				$y = $rcm->getCTRRacer("",$det[0]->getId(),$ctr[0]->getCTRID());
				$cll = $cm->getClass($y[0]->getCID());
				echo $cll[0]->getName()," klasē";
			} else {
				echo "<select name = \"class",$rcrs[$i]->getRacerID(),"\">";
					for($z=0;$z<count($cl);$z++){
						echo "<option value=\"",$cl[$z]->getId(),"\">";					
						echo $cl[$z]->getName();
						echo "</option>";
					}	
				echo "</select>"," klasē";
			}	
			echo "<td width=\"*\">",$rci[0]->getLName()," ",$rci[0]->getFName();
		}
		echo "<tr><td colspan=\"2\" align=\"center\">";
			echo "<input type=\"hidden\" name = \"rar\" value=\"$r_ar\" > ";
			echo "<input type=\"hidden\" name = \"rm_func\" value=\"racer\" > ";
			
			echo "<input type=\"hidden\" name = \"ct\"  value=\"",$team[$x]->getID(),"\" >";				
			if($ctr){
				echo "<input type=\"hidden\" name = \"rm_subf\" value=\"remappcteam\">";
				echo "<input type=\"submit\" value=\"Noņemt komandu\">";	
				echo "<input type=\"hidden\" name = \"opt\" value=\"",$ctr[0]->getCTRID(),"\">";
			} else {
				echo "<input type=\"hidden\" name = \"rm_subf\" value=\"appcteam\">";
				echo "<input type=\"submit\" value=\"Pieteikt komandu\">";	
			}
				
			
		echo "</table> ";
		echo "</form>";					
	}
}
function remCRacer($opt){
	$rcm = new RacerManager;
	$rcm->delCTeamRacer("",$opt);
}

function saveAddCTRacer($opt){
	$rcm = new RacerManager;
	$rcm->insCTeamRacer($_SESSION['params']['rcr'],$opt,0)	;	
}

function printAddCTRacer($opt){
	$rcm = new RacerManager;
	$rcrs=$rcm->getFreeCRacer($_SESSION['params']['club']);
	
	echo "<table width =\"100%\" border = \"1\">";
	echo "<tr class=\"title\"><td colspan =\"2\" >Brīvie sportisti";
	for($i=0;$i<count($rcrs);$i++){
		$rci = $rcm->getRacerInfo($rcrs[$i]->getRacerID());
		echo "<tr><td width=\"100\">";
		
		echo "<table border=\"0\">";
			echo "<tr><td><form action=\"index.php\" method=\"post\">";
				echo "<input type=\"hidden\" name = \"rm_func\" value=\"racer\" > ";
				echo "<input type=\"hidden\" name = \"rm_subf\" value=\"saveaddcteamracer\">";
				echo "<input type=\"hidden\" name = \"rcr\"  value=\"".$rcrs[$i]->getRacerID()."\" >";				
				echo "<input type=\"hidden\" name = \"opt\" value=\"$opt\">";
				echo "<input type=\"submit\" value=\"Pievienot\">";	
			echo "</form>";			
		echo "</table>";
		
		
		echo "<td width=\"*\">",$rci[0]->getLName()," ",$rci[0]->getFName();
	}
	echo "</table> <hr>";
	
	//echo "<center><a href=\"index.php?rm_func=racer&rm_subf=newteamracer&opt=$opt\">Izveidot jaunu</a></center>";
	
	
	
}

function savecteam($opt){
	$rcm = new RacerManager;
	$tms = $rcm->getCTeam("","","",$_SESSION['params']['name'],"");
	
	if ((count($tms) > 0) and ($opt <> $tms[0]->getID())){
		echo "<center><h1 style=\"color:red;\">Komanda ar tādu nosaukumu jau eksistē!</h1></center>";
		return;
	}
		
	if ($opt > 0){
		$rcm->saveCTeam($opt,$_SESSION['params']['name']);
	} else {
		$rcm->insCTeam($_SESSION['params']['name'],$_SESSION['params']['club']);
		
		//$tms = $rcm->getCTeam("","","",$_SESSION['params']['name'],"");
		//$racer = $rcm->getRacer("",$_SESSION['user']->getID(),1);
		//$rcm->insTeamRacer($racer[0]->getRacerID(),$tms[0]->getID(),1)	;	
	}
}

function printNewCTeam($opt){
	echo "<form action=\"index.php\" method=\"post\">";
	echo "<table width =\"100%\" border = \"1\">";
		echo "<tr class=\"title\"><td colspan =\"2\" >Komandas dati";
		echo "<tr><td width = \"100\">Nosaukums: <td ><input type=\"text\" name = \"name\" size=\"100\">";		
	echo "</table> ";
	
	echo "<hr>";
	echo "<center><input type=\"submit\" value=\"Apstiprināt\"></center>";
	echo "<input type=\"hidden\" name=\"rm_func\" value = \"racer\">";
	echo "<input type=\"hidden\" name=\"rm_subf\" value = \"savecteam\">";
	echo "<input type=\"hidden\" name=\"club\" value=\"$opt\">";
	echo "</form>";
}

function ListClubTeams(){
	$rcm = new RacerManager;
	
	$racer = $rcm->getRacer("",$_SESSION['user']->getID(),1);
	$racer = $rcm->getRacerWithDet($racer[0]->getRacerID());
	$ri = $racer[0]->getInfo();
	
	$club= $rcm->getClub($ri[0]->getClub());
	echo "\"<b>",$club[0]->getName(),"</b>\" kluba komandas";
	echo " | <a href=\"index.php?rm_func=racer&rm_subf=newcteam&opt=",$club[0]->getID(),"\">Izveidot jaunu</a><hr>";
	
	$team = $rcm->getCTeam("","",1,"",$club[0]->getID());
	
	for ($x=0;$x<count($team);$x++){
		
		$rcrs = $team[$x]->getRacers();
		echo "<table width =\"100%\" border = \"1\">";
		echo "<tr class=\"title\"><td colspan =\"2\" ><b>",$team[$x]->getName(),"</b>";
		for($i=0;$i<count($rcrs);$i++){
			$rci = $rcm->getRacerInfo($rcrs[$i]->getRacerID());
			echo "<tr><td width=\"100\">";
			echo "<table border=\"0\"><tr>";
		/*
			echo "<td><form action=\"index.php\" method=\"post\">";
				echo "<input type=\"hidden\" name = \"rm_func\" value=\"racer\" > ";
				echo "<input type=\"hidden\" name = \"rm_subf\" value=\"makelead\">";
				echo "<input type=\"hidden\" name = \"opt\"  value=\"".$rcrs[$i]->getRacerID()."\" >";				
				echo "<input type=\"submit\" value=\"Likt par kapteini\">";	
			echo "</form>";	
			*/			
			echo "<td><form action=\"index.php\" method=\"post\">";
				echo "<input type=\"hidden\" name = \"rm_func\" value=\"racer\" > ";
				echo "<input type=\"hidden\" name = \"rm_subf\" value=\"viewprofile\">";
				echo "<input type=\"hidden\" name = \"opt\"  value=\"".$rcrs[$i]->getRacerID()."\" >";				
				echo "<input type=\"submit\" value=\"Dalībnieka dati\">";	
			echo "</form>";	
			
			echo "<td><button onclick=\"confDel('rem",$rcrs[$i]->getRacerID(),"','Tiešām atvienot?');\">Atvienot</button>";	
					echo "<form action=\"index.php\" method=\"post\"id =\"rem",$rcrs[$i]->getRacerID(),"\">";
						echo "<input type=\"hidden\" name = \"rm_func\" value=\"racer\" > ";
						echo "<input type=\"hidden\" name = \"rm_subf\" value=\"remCRacer\">";
						echo "<input type=\"hidden\" name = \"opt\"  value=\"".$rcrs[$i]->getRacerID()."\" >";
			echo "</form>";	
		
			echo "</table>";
			echo "<td width=\"*\">",$rci[0]->getLName()," ",$rci[0]->getFName();
		}
		echo "</table> ";	
		echo "<a href=\"index.php?rm_func=racer&rm_subf=addcteamracer&opt=",$team[$x]->getID(),"&club=",$club[0]->getID(),"\">Pievienot sportistu</a><hr>";
		
	}	
}

function viewList(){
	$rcm = new RacerManager;
	$list = $rcm->getRacer("");
	//print_r($list);
	
	
	echo "<table border=\"0\" style=\"border-style:none\">";
	echo "<tr><td width=\"20px\"><a href = \"index.php?rm_func=racer&rm_subf=newteamracer&red_f=racer&red_s=viewlist&addmode=enduroreg\">";
				echo "<img src = \"./images/BlueAdd_16x16.png\" alt=\"Jauns sportists\" title=\"Jauns sportists\" border = \"0\">";
				echo " </a>";
			
				echo "<td ><a href = \"index.php?rm_func=racer&rm_subf=newteamracer&red_f=racer&red_s=viewlist&addmode=enduroreg\">";
					echo " <b >Jauns sportists</b>";
				echo " </a>";
				
				if (!$_SESSION['params']['hided']){
					echo " <td width=\"20px\"><a href = \"index.php?rm_func=racer&rm_subf=viewlist&hided=1\">";
					echo "<img src = \"./images/bin.png\" alt=\"Jauns sportists\" title=\"Slēptie sportisti\" border = \"0\" height=\"16\" width=\"16\">";
					echo " </a>";
				}
				
	echo "</table>";
	
	echo "<table border=\"1\" >";
	echo "<tr><td><td><TD width=\"30px\">
	<a href=\"?rm_func=racer&rm_subf=viewlist&sort=nr\">NR</a>
	<td >
	<a href = \"?rm_func=racer&rm_subf=viewlist\">Vārds Uzvārds</a>
	<td>e-pasts<td>Licences numurs<td>Klubs<td width=\"50px\">Valsts";
	for($i=0;$i<count($list);$i++){
		echo "<tr><td width=\"18px\">";		
		echo '<a href="?rm_func=racer&rm_subf=viewprofile&opt='.$list[$i]->getUserID().'">
					<img src = "./images/PageWhiteEdit_16x16.png" alt="Atvērt" title="Atvērt" border = "0"								
					onmouseover="document.body.style.cursor = \'pointer\'"
					onmouseout = "document.body.style.cursor = \'default\'"				
				> ';
		
		$todo = $_SESSION['params']['hided']? "up": "dwn";
		$file = $_SESSION['params']['hided']? "GreenArrowUp_16x16.png": "RedArrowDown_16x16.png";
		$alt = $_SESSION['params']['hided']? "Aktivizēt": "Paslēpt";
		
		echo "<td width=\"18px\"><a href=\"?rm_func=racer&rm_subf=$todo&opt=".$list[$i]->getUserID()."\">
					<img src = \"./images/$file\" alt=\"$alt\" title=\"$alt\" border = \"0\"								
					onmouseover=\"document.body.style.cursor = 'pointer'\"
					onmouseout = \"document.body.style.cursor = 'default'\"				
				> ";
		
		echo "<td width=\"30px\">",$list[$i]->getNR();
		echo "<td width=\"230px\">",$list[$i]->getFname()," ",$list[$i]->getLname();//, " ",$list[$i]->getUserID();
		echo "<td width=\"130px\">",$list[$i]->getMail();//, " ",$list[$i]->getUserID();
		echo "<td >"; 
		if ($list[$i]->LIC_YR && $list[$i]->LIC_YR == date('Y')){
			
			echo $list[$i]->getLNR();//"<br>",$list[$i]->LIC_YR," gads.";
		}
		
		$st = "";
		if ($list[$i]->LIC_YR && $list[$i]->LIC_YR != date('Y')){
			$st = 'style="color:grey;font-style: italic"';
		}
		echo "<td $st>",$list[$i]->getClub_name();//, " ",$list[$i]->getUserID();
		echo "<td >",$list[$i]->getValsts_name();//, " ",$list[$i]->getUserID();
		
	}
	echo "</table>";
}

function printEditClub($opt){
	$rm = new RacerManager;
	
	echo "<form enctype=\"multipart/form-data\" action=\"index.php\" method=\"post\">";
		echo "<input type=\"hidden\" name = \"rm_func\" value=\"racer\"> ";
		echo "<table width =\"100%\" border = \"1\">";
	
			echo "<tr class=\"title\"><td>Nosaukums";
	
	
		if (isset($opt)){
			$list = $rm->getClub($opt);
			if ($list){			
				echo "<tr>";
				echo "<td><input type=\"text\" name = \"name\" value=\"".$list[0]->getName()."\">";				
			}
		}
		echo "</table> ";
		echo "<input type=\"hidden\" name = \"opt\" value=\"".$list[0]->getID()."\">";
		echo "<input type=\"hidden\" name = \"rm_subf\" value=\"saveclub\">";
		echo "<hr><center><input type=\"submit\" value=\"Saglabāt\" ></center>";
	echo "</form>";
}

function delClub($opt){
	$rm = new RacerManager;
	
		if ($opt){
			$rm->delClub($opt);
		}		
	
}

function saveClub($opt){
	$rm = new RacerManager;
	
		if ($opt){
			$rm->saveClub($opt,$_POST["NAME"],$_POST["cont"]);
		}else {
			$rm->insClub($_POST["NAME"],$_POST["cont"]);
		}		
	
}

function printNewClub(){
	echo "<form enctype=\"multipart/form-data\" action=\"index.php\" method=\"post\">";
		echo "<input type=\"hidden\" name = \"rm_func\" value=\"racer\"> ";
		echo "<table width =\"100%\" border = \"1\">";
	
		echo "<tr class=\"newtitle\">";
		echo "<td>Nosaukums:<input type=\"text\" name = \"name\" >";
				
		echo "</table> ";
		
		echo "<input type=\"hidden\" name = \"rm_subf\" value=\"saveclub\">";
		echo "<hr><center><input type=\"submit\" value=\"Saglabāt\" ></center>";
	echo "</form>";
}

function printClub(){
	
	$rm = new RacerManager;
	$cm = new champManager;
	
	
	echo "<table width =\"100%\" border = \"1\">";
	echo "<tr class=\"title\"><td style=\"width:20px\">&nbsp<td>Nosaukums<td width=\"70px\">Valsts";
	
	echo '<tr ><td  ><img src= "./images/CHECK_16x16.png" align="right"
			onclick="submitForm(\'CLUB_FORM\');"
			onmouseover="document.body.style.cursor = \'pointer\'"
			onmouseout = "document.body.style.cursor = \'default\'"
	 
	>';
	
	echo '<td width= "65px">
	<form action="index.php" method="post" id="CLUB_FORM">
	<input style="width: 150px;"  type="text" name="NAME" id="NAME">';
	
	$list = $cm->getCountry();
		echo '<td ><select name = "cont" id = "cont" style="width: 150px;">';
		for($i=0;$i<count($list);$i++){
			echo "<option value=\"",$list[$i]->getID(),"\">";
			echo $list[$i]->getName();
			echo "</option>";
		}
		echo "</select>";
		
		echo "<input type=\"hidden\" value=\"\" name = \"opt\" id = \"ID\">";
		echo "<input type=\"hidden\" value=\"racer\" name = \"rm_func\" >";
		echo "<input type=\"hidden\" value=\"saveclub\" name = \"rm_subf\" >";
	echo "</form>";
	
	$list = $rm->getClub("");
	$i =0;
	while (isset($list[$i]) ){
	
		echo "<tr><td style=\"width:20px\">";
		
		echo '<img src = "./images/PageWhiteEdit_16x16.png" alt="'.EDIT.'" title="'.EDIT.'" border = "0"
					onclick="editClub('.$list[$i]->getID().',\''.$list[$i]->getName().'\','.($list[$i]->getCountry()?$list[$i]->getCountry():0).');"
					onmouseover="document.body.style.cursor = \'pointer\'"
					onmouseout = "document.body.style.cursor = \'default\'"
				> ';				
		echo "<a onclick=\"confDelGet('".DEL_CONFIRM."','index.php?rm_func=racer&rm_subf=delclub&opt=".$list[$i]->getID()."')\">";
				echo "<img src=\"./images/RedCross_16x16.png\" border = \"0\" alt=\"Dzēst\" title=\"Dzēst\" 
					onmouseover=\"document.body.style.cursor = 'pointer'\"
					onmouseout = \"document.body.style.cursor = 'default'\"
				></a>";
		echo "<td>". $list[$i]->getName();
		echo "<td>". $list[$i]->getcName();
		
		$i++;
	}
	echo "</table>";
	

}

function returnAppl($opt){
	unacctrApl($opt);
	
	$rcm = new RacerManager;
	$rm= new raceManager;
	
	$tr = $rcm->getTeamRace($opt,"","","");	
	if(!$tr){
		return;
	}
	$rcs = $rcm->getTeamRacer("","",$tr[0]->getTeamId(),"");
	
	$rcm->delTRRacer("",$opt);
	$rcm->delTeamRace($opt);
	
	$race = $rm->getRace($tr[0]->rid,"","","","","","");
	$text = str_replace("{race}",$race[0]->getName(),REM_TEAM_TEXT);	
	
	for($i = 0; $i < count($rcs);$i++){
		$d = $rcs[$i]->getRacerDet();		
		if ($d[0]->allowemails){
			sendMail($d[0]->mail,"","Pieteikums Piedzīvojumu enduro sacensībām \"".$race[0]->getName()."\"",$text);
		}		
	}
}

function makeLead($opt){
	$rcm = new RacerManager;
	$rcm->makeLead($opt);
}

function unacctrApl($opt){
	$rcm = new RacerManager;
	$rcm->unacceptTRace($opt);
	
	$tr = $rcm->getTeamRace($opt,"","","");
	if(!$tr){
		return;
	}
	$rcs = $rcm->getTeamRacer("","",$tr[0]->getTeamId(),"");
	
	$mail_text = "hello! Jūsu komandas dalība sacensībās ir noņemta!";
	$mail_subj = "Dalības apstiprināšana";
	
	for($i = 0; $i < count($rcs);$i++){
		$det = $rcs[$i]->getRacerDet();
		//sendMail($det[0]->getMail(),ADMIN_MAIL,$mail_subj,$mail_text);
	}	
}

function acctrApl($opt){
	$rm= new raceManager;
	$rcm = new RacerManager;
	$rcm->acceptTRace($opt);
	
	$tr = $rcm->getTeamRace($opt,"","","");	
	if(!$tr){
		return;
	}
	$rcs = $rcm->getTeamRacer("","",$tr[0]->getTeamId(),"");
	
	$race = $rm->getRace($tr[0]->rid,"","","","","","");
	$text = str_replace("{race}",$race[0]->getName(),ACC_TEAM_TEXT);	
	
	echo "racers: ",count($rcs);
	
	for($i = 0; $i < count($rcs);$i++){
		$d = $rcs[$i]->getRacerDet();		
		if ($d[0]->allowemails){
			sendMail($d[0]->mail,"","Pieteikums Piedzīvojumu enduro sacensībām \"".$race[0]->getName()."\"",$text);
		}		
	}	
}

function listTeamrace(){
	printAactualRaceMenu(1);
	
	$rcm = new RacerManager;
	$rm = new raceManager;
	$r = $rm->getRace("","","",1,"",1,0);
	
	if(count($r) < 1){
		echo prntWarn("Nevienas sacensības nav izvēlētas!");
		return;
	}
	
	$cm= new champManager;
	$cl = $cm->getActulaRaceClass($r[0]->getID());
	$totaltms = 0;
	
echo "<div>";

	echo "<table width=\"100%\" border =1 >";
		echo "<tr valign=\"top\">";
			echo "<td width=\"450\">";
				for ($j = 0;$j < count($cl);$j++){
					echo "<a name =\"c",$cl[$j]->getID(),"\"></a>";
					$apls = $rcm->getTeamRace("","",$r[0]->getID(),$cl[$j]->getID());
					$totaltms +=count($apls);
					echo "<b>",$cl[$j]->getName(),"</b> klase - ",count($apls), " komandas";
					echo "<br>";					
					
					echo "<table  border = \"1\" width=\"100%\">";
					
					$i=0;
					while (isset($apls[$i]) ){
						echo "<tr valign=\"middle\"";
							if($_SESSION['params']['tm']==$apls[$i]->getTeamID()){
									echo "style=\"background-color:#99ff99\"";
								}
						echo ">";
						echo "<td align=\"center\" width=\"50\">";
						
						echo "<a href=\"?rm_func=racer&rm_subf=";
							if(!$apls[$i]->getACC()){
								echo "accraceapplist";
							} else {
								echo "UNaccraceapplist";
							}
						echo "&opt=",$apls[$i]->getTRID(),"&tm=",$apls[$i]->getTeamID(),"\">";
							if(!$apls[$i]->getACC()){
								echo "<img src=\"./images/WARN_24x24.png\" border=\"0\" alt=\"???\" title=\"Nav apstiprināts\" >";							
							} else {
								echo "<img src=\"./images/CHECK_24x24.png\" border=\"0\" alt=\"OK\" title=\"Apstiprināts\">";							
							}
						echo "</a>";
						
						echo "<a href=\"index.php?rm_mode=print&print_func=tr&print_mode=new&tr=",$apls[$i]->getTRID(),"\" target=\"_blank\">";
							echo "<img src=\"./images/ANKETA_24x24.png\" border=\"0\" alt=\"Drukāt\" title=\"Drukāt anketu\">"; 
						echo "</a>";
						
						$tm = $rcm->getTeam($apls[$i]->getTeamID(),"",1,"");
						
						
						$rcrs = Array();			
						$trr= $rcm->getTRRacer($apls[$i]->getTRID());
						for($k=0;$k<count($trr);$k++){
							$item=$rcm->getRacer($trr[$k]->getTRRID(),"","");
							array_push($rcrs,$item[0]);
						}
						
						$p = $rcrs[0];
						$p1 = $rcrs[1];
						
						echo "<td width=\"50\">";
						if($p){
							switch ($trr[0]->type){
								case 2:
									echo "<img src=\"./images/moto_icon_36x36.png\" width=\"24px\" height=\"24px\" alt=\"M\" title=\"Moto\">";
									break;
								case 3:
									echo "<img src=\"./images/velo_icon_36x36.png\" width=\"24px\" height=\"24px\" alt=\"V\" title=\"Velo\">";
									break;
								case 4:
									echo "<img src=\"./images/atv_icon_36x36.png\" width=\"24px\" height=\"24px\" alt=\"K\" title=\"Kvadro\">";
									break;
								default:
									echo "<img src=\"./images/quest_icon_36x36.png\" width=\"24px\" height=\"24px\" alt=\"?\" Title=\"Nav zināms\">";
							}
						}
						
						if($p1){
							switch ($trr[1]->type){
								case 2:
									echo "<img src=\"./images/moto_icon_36x36.png\" width=\"24px\" height=\"24px\" alt=\"M\" title=\"Moto\">";
									break;
								case 3:
									echo "<img src=\"./images/velo_icon_36x36.png\" width=\"24px\" height=\"24px\" alt=\"V\" title=\"Velo\">";
									break;
								case 4:
									echo "<img src=\"./images/atv_icon_36x36.png\" width=\"24px\" height=\"24px\" alt=\"K\" title=\"Kvadro\">";
									break;
								default:
									echo "<img src=\"./images/quest_icon_36x36.png\" width=\"24px\" height=\"24px\" alt=\"?\" Title=\"Nav zināms\">";
							}
						}
						
						echo "<td width=\"300\" ";
						if ($apls[$i]->getACC()){
							echo " style=\"color:green;font-weight:bold\" ";
						}
						echo ">",$tm [0]->getName() ;
						if($tm[0]->getLeader()){$leader = $tm[0]->getLeader()->getRacerID();}
						echo " (";
						if($p){
							echo "<a title=\"Labot datus\" style=\"text-decoration:none;",$apls[$i]->getACC() ? "color:green;font-weight:bold":"","\" href=\"?rm_func=racer&rm_subf=viewprofile&red_f=racer&red_s=raceapplist&editmode=pe&tm=",$apls[$i]->getTeamID(),$_SESSION["params"]["act"] ? "&act=1" : "","&anh=tm",$apls[$i]->getTeamID(),"&racer=",$p->getUserId(),"&id=",$p->getUserId(),"\">";
								echo $p->getFname()," ",$p->getLname()," - ",$trr[0]->nr;
							echo "</a>";
						}
						if($rcrs[0]){
							if ($leader){if ($leader == $rcrs[0]->getUserID()){echo " <b>(k)</b> ";}}	
						}
						
						echo "; ";
						if($p1){
							echo "<a title=\"Labot datus\" style=\"text-decoration:none;",$apls[$i]->getACC() ? "color:green;font-weight:bold":"","\" href=\"?rm_func=racer&rm_subf=viewprofile&red_f=racer&red_s=raceapplist&editmode=pe&tm=",$apls[$i]->getTeamID(),$_SESSION["params"]["act"] ? "&act=1" : "","&anh=tm",$apls[$i]->getTeamID(),"&racer=",$p1->getUserId(),"&id=",$p1->getUserId(),"\">";
								echo $p1->getFname()," ",$p1->getLname()," - ",$trr[1]->nr;
							echo "</a>";
						}
						if ($rcrs[1]){
							if($leader){if ($leader == $rcrs[1]->getUserID()){echo " <b>(k)</b> ";}}
						}
						
						echo ") ";
					
					
															
														
														
						echo "<td width=\"25\">";
							echo "<a onclick=\"confDelGet('Tiešām noraidīt?','?rm_func=racer&rm_subf=returnapl&opt=",$apls[$i]->getTRID(),"&tm=",$apls[$i]->getTeamID(),"#tm",$apls[$i]->getTeamID(),"')\"
								onmouseover=\"document.body.style.cursor = 'pointer'\"
								onmouseout = \"document.body.style.cursor = 'default'\"
							>";
								echo "<img src=\"./images/CROSS_24x24.png\" alt=\"X\" title=\"Noraidīt\">";							
							echo "</a>";
						
						$i++;
					}
					echo "</table>";
				} 
				echo "<p>";
					echo "Kopā $totaltms komandas";
				echo "</p>";
		echo "<td width=\"250\">";						
			echo "<table width=\"250\" border=\"0\" style=\"border-style:none\">";
				echo "<tr>";
					echo "<td align=\"right\" width=\"100%\" colspan=\"3\">";
						echo "<a href=\"?rm_func=racer&rm_subf=newteamracer&red_f=racer&red_s=raceapplist&addmode=enduroreg\">";
							echo "<img src=\"./images/User_32x32.png\" border = \"0\" alt=\"+S\" title=\"Pievienot jaunu sportistu\">";
						echo "</a> ";
						echo "<a onclick=\"addteam();\"
								onmouseover=\"document.body.style.cursor = 'pointer'\"
								onmouseout = \"document.body.style.cursor = 'default'\"	
							>";	
							echo "<img src=\"./images/Team_32x32.png\" border = \"0\" alt=\"+K\" title=\"Pievienot jaunu komandu\">";
						echo "</a>";						
				$tm = $rcm->getActTeamLiast($r[0]->getID(),1);
				for($i=0;$i<count($tm);$i++){
					echo "<tr>";
						echo "<td colspan=\"3\">";
							echo "<a name=\"tm",$tm[$i]->getId(),"\"></a>";
							echo "<table width=\"250px\" border = \"0\" ";
								if($_SESSION['params']['tm']==$tm[$i]->getId()){
									echo "style=\"background-color:#99ff99\"";
								}
							echo ">";
								echo "<tr>";
										echo "<td style=\"border-bottom-style: solid;border-bottom-width: 1px\">";	
											echo "<a id =\"add",$tm[$i]->getId(),"\" onclick=\"openTeamApply('divNew".$tm[$i]->getId()."',".$tm[$i]->getId().",this,hs)\"
											
												onmouseover=\"document.body.style.cursor = 'pointer'\"
												onmouseout = \"document.body.style.cursor = 'default'\"
											
											>";
													echo "<img src=\"./images/BlueAdd_16x16.png\" border = \"0\" alt=\"+\" title=\"Pieņemt\"> ";
											echo "</a>";
											echo "<div class=\"highslide-maincontent\" id=\"divNew".$tm[$i]->getId()."\"></div>";
										
											echo "<a title=\"Labot nosaukumu\" onclick=\"changeTeamName(",$tm[$i]->getId(),",'",str_replace("\"","&#34",$tm[$i]->getName()),"',",($_SESSION["params"]["act"] ? 1 : 0),");\"
											
												onmouseover=\"document.body.style.cursor = 'pointer'\"
												onmouseout = \"document.body.style.cursor = 'default'\"
											>";
												echo "<b>",$tm[$i]->getName(),"</b>" ;
											echo "</a>";
										echo "<td width=\"17\" align=\"right\">";
											echo "<a onclick=\"confDelGet('Tiešām dzēst?','?rm_func=racer&rm_subf=raceapplist&f2=teamhide",($_SESSION["params"]["act"] ? "&act=1" : ""),"&opt=",$tm[$i]->getId(),"&tm=",$tm[$i]->getId(),"#tm",$tm[$i]->getId(),"');\"
												onmouseover=\"document.body.style.cursor = 'pointer'\"
												onmouseout = \"document.body.style.cursor = 'default'\"
											>";
												echo "<img src=\"./images/RedCross_16x16.png\" atl=\"x\" title=\"Dzēst komandu\"> ";
											echo "</a>";											
									echo "<tr>";
										echo "<td colspan=\"2\">";
											echo "<table width=\"100%\" border = \"0\" style=\"border-style:none\">";
												echo "<tr>";
													
												$racers = $tm[$i]->getRacers();
												for($j=0;$j<2;$j++){
													
													if($racers[$j]){
														echo "<td width=\"97\" align=\"left\">";
														$rdet = $racers[$j]->getRacerDet();													
														if ($rdet){
															echo "<a title=\"Labot datus\" style=\"text-decoration:none;\" href=\"?rm_func=racer&rm_subf=viewprofile&red_f=racer&red_s=raceapplist&editmode=pe&tm=",$tm[$i]->getId(),$_SESSION["params"]["act"] ? "&act=1" : "","&anh=tm",$tm[$i]->getId(),"&racer=",$rdet[0]->getUserId(),"&id=",$rdet[0]->getUserId(),"\">";
																echo $rdet[0]->getFName()," ",$rdet[0]->getLName();
															echo "</a>";																							
															echo "<td width=\"8px\" valign=\"top\">";
																echo "<a onclick=\"confDelGet('Tiešām atvienot?','?rm_func=racer&rm_subf=raceapplist&f2=remRacer",($_SESSION["params"]["act"] ? "&act=1" : ""),"&opt=",$rdet[0]->getUserId(),"&tm=",$tm[$i]->getId(),"#tm",$tm[$i]->getId(),"');\"
																	onmouseover=\"document.body.style.cursor = 'pointer'\"
																	onmouseout = \"document.body.style.cursor = 'default'\"																
																>";
																	echo "<img src=\"./images/RedCross_trans_16x16.png\" border = \"0\" width=\"8px\" height=\"8px\" alt=\"x\" Title=\"Izņemt no komandas\">";
																echo "</a>";
														}
													} else {
														echo "<td width=\"105\" align=\"center\">";
															echo "<a onclick=\"showAddTMate(",$tm[$i]->getId(),",",$_SESSION["params"]["act"] ? 1:0,",",$j==0 ? 1 : 2,",this,hs);\"
																	
																onmouseover=\"document.body.style.cursor = 'pointer'\"
																onmouseout = \"document.body.style.cursor = 'default'\"	
															>";
																echo "<img src=\"./images/quest_icon_36x36.png\" border = \"0\" width=\"16px\" height=\"16px\" alt=\"+\" Title=\"Pievienot sportistu\">";
															echo "</a>";
															echo "<div class=\"highslide-maincontent\" id=\"div",$tm[$i]->getId(),"x",$j==0 ? 1 : 2,"\"></div>";
															
													}
												}												
											echo "</table>";									
							echo "</table>";
				}
				
				$tm = $rcm->getActTeamLiast($r[0]->getID(),0);
					echo "<tr style=\"background-color:#f2e19e\">";	
						echo "<td  >";
							echo "<a name=\"neakt\"> ";
							echo "<a href=\"?rm_func=racer&rm_subf=raceapplist&act=1#neakt\">";
								echo "Neaktīvas komandas (",count($tm),")";
							echo "</a>";
						echo "<td width=\"17px\" align=\"right\">";
							echo "<a onclick=\"addteam();\"
								onmouseover=\"document.body.style.cursor = 'pointer'\"
								onmouseout = \"document.body.style.cursor = 'default'\"	
							>";	
								echo "<img src=\"./images/Team_32x32.png\" height=\"16\" width=\"16\" border = \"0\" alt=\"+\" title=\"Pievienot jaunu komandu\">";
							echo "</a>";
						echo "<td width=\"17px\" align=\"right\">";
							if($_SESSION["params"]["act"]){	
								echo "<a href=\"?rm_func=racer&rm_subf=raceapplist\">";	
									echo "<img src=\"./images/blue_dbl_arrow_up_16x16.png\" border = \"0\" alt=\"\" title=\"Aizvērt neaktīvas komandas\">";
								echo "</a>";
							} else {
								echo "<a href=\"?rm_func=racer&rm_subf=raceapplist&act=1#neakt\">";	
									echo "<img src=\"./images/blue_dbl_arrow_dwn_16x16.png\" border = \"0\" alt=\"\" title=\"Atvērt neaktīvas komandas\">";
								echo "</a>";
							}
				if($_SESSION["params"]["act"]){			
					
					for($i=0;$i<count($tm);$i++){
						echo "<tr>";
							echo "<td colspan=\"3\">";
								echo "<a name=\"tm",$tm[$i]->getId(),"\"></a>";
								echo "<table width=\"250px\" border = \"0\" ";
									if($_SESSION['params']['tm']==$tm[$i]->getId()){
										echo "style=\"background-color:#99ff99\"";
									}
								echo ">";
								
									echo "<tr>";
										echo "<td width=\"40\">";
											echo "<select title=\"Izvēlies klasi\" id=\"class",$tm[$i]->getId(),"\"";
												echo " onchange=\"modifyPEnduroRegLinks(",$tm[$i]->getId(),",",$cl[0]->getID(),");\"";
											echo ">";
												for($j=0;$j<count($cl);$j++){
													echo "<option title=\"",$cl[$j]->getName(),"\" value=\"",$cl[$j]->getID(),"\">",$cl[$j]->getCode(),"</option>";
												}
											echo "</select>";
											echo "<td style=\"border-bottom-style: solid;border-bottom-width: 1px\">" ;
												echo "<a title=\"Labot nosaukumu\" onclick=\"changeTeamName(",$tm[$i]->getId(),",'",str_replace("\"","&#34",$tm[$i]->getName()),"',",($_SESSION["params"]["act"] ? 1 : 0),");\"
													onmouseover=\"document.body.style.cursor = 'pointer'\"
													onmouseout = \"document.body.style.cursor = 'default'\"
												>";
													echo "<b>",$tm[$i]->getName(),"</b>" ;
												echo "</a>";
											echo "<td width=\"17\" align=\"right\">";
												echo "<a href=\"?rm_func=racer&rm_subf=raceapplist&f2=teamunhide&act=1&opt=",$tm[$i]->getId(),"&tm=",$tm[$i]->getId(),"#tm",$tm[$i]->getId(),"\">";
													echo "<img src=\"./images/GreenArrowUp_16x16.png\" atl=\"^\" title=\"Atgriezt komandu\" border = \"0\"> ";
												echo "</a>";
										echo "<tr>";
											echo "<td width=\"40\">";
												echo "<a id =\"add",$tm[$i]->getId(),"\"";
												echo " href=\"?rm_func=racer&rm_subf=raceapplist&race=",$r[0]->getID(),"&f2=addtr&opt=",$tm[$i]->getId(),"&tm=",$tm[$i]->getId(),"&class=",$cl[0]->getId(),"#c",$cl[0]->getId(),"\">";
													echo "<img src=\"./images/BlueAdd_16x16.png\" border = \"0\" alt=\"+\" title=\"Pieņemt\"> ";
												echo "</a>";
												echo "<a id =\"acc",$tm[$i]->getId(),"\"";
												echo " href=\"?rm_func=racer&rm_subf=raceapplist&race=",$r[0]->getID(),"&f2=acctr&opt=",$tm[$i]->getId(),"&tm=",$tm[$i]->getId(),"&class=",$cl[0]->getId(),"#c",$cl[0]->getId(),"\">";
													echo "<img src=\"./images/CHECK_16x16.png\" border = \"0\" alt=\"√\" title=\"Pieņemt & apstiprināt\">";
												echo "</a>";
											echo "<td colspan=\"2\">";
												echo "<table width=\"100%\" border = \"0\" style=\"border-style:none\">";
													echo "<tr>";
														
													$racers = $tm[$i]->getRacers();
													for($j=0;$j<2;$j++){
														
														if($racers[$j]){
															echo "<td width=\"97\" align=\"left\">";
															$rdet = $racers[$j]->getRacerDet();
															echo "<a title=\"Labot datus\" style=\"text-decoration:none;\" href=\"?rm_func=racer&rm_subf=viewprofile&red_f=racer&red_s=raceapplist&editmode=pe&tm=",$tm[$i]->getId(),$_SESSION["params"]["act"] ? "&act=1" : "","&anh=tm",$tm[$i]->getId(),"&racer=",$rdet[0]->getUserId(),"&id=",$rdet[0]->getUserId(),"\">";
																echo $rdet[0]->getFName()," ",$rdet[0]->getLName();
															echo "</a>";
															echo "<td width=\"8px\" valign=\"top\">";
																echo "<a onclick=\"confDelGet('Tiešām atvienot?','?rm_func=racer&rm_subf=raceapplist&f2=remRacer",($_SESSION["params"]["act"] ? "&act=1" : ""),"&opt=",$rdet[0]->getUserId(),"&tm=",$tm[$i]->getId(),"#tm",$tm[$i]->getId(),"')\"
																	onmouseover=\"document.body.style.cursor = 'pointer'\"
																	onmouseout = \"document.body.style.cursor = 'default'\"
																>";
																	echo "<img src=\"./images/RedCross_trans_16x16.png\" border = \"0\" width=\"8px\" height=\"8px\" alt=\"x\" Title=\"Izņemt no komandas\">";
																echo "</a>";
														} else {
															echo "<td width=\"105\" align=\"center\">";
															echo "<a onclick=\"showAddTMate(",$tm[$i]->getId(),",",$_SESSION["params"]["act"] ? 1:0,",",$j==0 ? 1 : 2,",this,hs);\"
																	
																onmouseover=\"document.body.style.cursor = 'pointer'\"
																onmouseout = \"document.body.style.cursor = 'default'\"	
															>";
																echo "<img src=\"./images/quest_icon_36x36.png\" border = \"0\" width=\"16px\" height=\"16px\" alt=\"+\" Title=\"Pievienot sportistu\">";
															echo "</a>";
															echo "<div class=\"highslide-maincontent\" id=\"div",$tm[$i]->getId(),"x",$j==0 ? 1 : 2,"\"></div>";
														}
													}												
												echo "</table>";										
								echo "</table>";
					}
				}
			echo "</table>";
	echo "</table>";	
echo "</div>";
}

function saveRaceAppl($opt){
	setteamActive($opt,1);
	
	$rcm = new RacerManager;
	$cm = new champManager;
	$rm = new raceManager;
	
	$tm = $rcm->getTeam($opt,"",1,"");
	$r=$tm[0]->getRacers();
	
	if (count($r) <> 2){
		echo prntWarn("Komandā jābūt 2 dalībnieki!");
		return;
	}
	
	$rt = $rcm->getTeamRace("",$opt,$_SESSION['params']['race'],"");
	if ($rt){
		echo prntWarn("Komanda jau ir pieteikta!");
		return;
	}
	
	//print_r($_SESSION['params']);
	
	$rcm->insTeamRace($opt,$_SESSION['params']['race'],$_SESSION['params']['class']);
		
	$rt = $rcm->getTeamRace("",$opt,$_SESSION['params']['race'],"");
	
	$text = TEAM_APPLY_TEXT;	
	$race = $rm->getRace($_SESSION['params']['race'],"","","","","","");
	$text = str_replace("{race}",$race[0]->getName(),$text);	
	$c = $cm->getClass($_SESSION['params']['class'],1);	
	$text = str_replace("{class}",$c[0]->getName(),$text);
	
	for($i=0;$i<count($r);$i++){	
		$d = $r[$i]->getRacerDet();
		
		$nr = $_SESSION['params']['NR'.$d[0]->getUserID()];
		$lic = $_SESSION['params']['lic'.$d[0]->getUserID()];
		$tehn = ($_SESSION['params']['teh_Marka'.$d[0]->getUserID()]?$_SESSION['params']['teh_Marka'.$d[0]->getUserID()]:"?")."^".
				($_SESSION['params']['teh_Model'.$d[0]->getUserID()]?$_SESSION['params']['teh_Model'.$d[0]->getUserID()]:"?")."^".
				($_SESSION['params']['teh_V'.$d[0]->getUserID()]?str_replace("cc","",$_SESSION['params']['teh_V'.$d[0]->getUserID()])."cc":"?")."^".
				($_SESSION['params']['teh_T'.$d[0]->getUserID()]?$_SESSION['params']['teh_T'.$d[0]->getUserID()]:"?");
				
		$type = $_SESSION['params']['teht'.$d[0]->getUserID()]?$_SESSION['params']['teht'.$d[0]->getUserID()]:1;
		$cl = $_SESSION['params']['CLUB'.$d[0]->getUserID()];
		$ins = $_SESSION['params']['INS'.$d[0]->getUserID()];
		
		$rcm->insTrRacer($rt[0]->getTRID(),$d[0]->getUserID(),$nr,$tehn,$lic,$type,$cl,$ins);
		
		$text = str_replace("{racer$i}",$d[0]->lname." ".$d[0]->fname,$text);
		$text = str_replace("{tehn$i}",($d[0]->tehn == 2 ? "moto" : ($d[0]->tehn == 3 ? "Velo" : ($d[0]->tehn == 4 ? "Kvadro" : "Nav norādīts"))),$text);
		$text = str_replace("{kapt$i}",($r[$i]->IsLeader() ? "- kapteinis":""),$text);
	}	
	
	for($i=0;$i<count($r);$i++){
		$d = $r[$i]->getRacerDet();
		if ($d[0]->allowemails){
			sendMail($d[0]->mail,"","Pieteikums Piedzīvojumu enduro sacensībām \"".$race[0]->getName()."\"",$text);
		}
	}
		
	return $rt[0]->getTRID();
}

function printInfo(){

	$rcm = new RacerManager;
	$cm = new champManager;
	$rm = new raceManager;
	
	$racer = $rcm->getRacer($_SESSION['user']['user_id']);
	$team = $rcm->getTeam("",$racer[0]->getUserID(),1,"");
	$r = $rm->getRace("","","",1,"",1,0);
	$x = $rcm->getTeamRace("",$team[0]->getID(),$r[0]->getID(),"");
	
	echo "<a href=\"http://www.appasaule.lv/rm/index.php?rm_mode=print&print_func=tr&print_mode=new&tr=",$x[0]->getTRID(),"\" target=\"_blank\">",RACE_APL_INFO_PRINT,"</a><hr>";
	echo RACE_APL_INFO_RACE,": <b style=\"font-size:15px\">",$r[0]->getName()," - ",$r[0]->getDate(),"</b><hr>";
	
		
		$rc = $cm->getClass($x[0]->getCID(),1);
		echo RACE_APL_INFO_CLASS,": ",$rc[0]->getName();
		
		// $rinfo = Array();
		
		$trr= $rcm->getTRRacer($x[0]->getTRID());
		// for($i=0;$i<count($trr);$i++){
			// $item=$rcm->getRacer($trr[$i]->getTRRID());
			// array_push($rinfo,$item[0]);
		// }
		
	for ($i=0;$i<count($trr);$i++){
		$rinfo = $rcm->getRacer($trr[$i]->getTRRID());
		$rinfo = $rinfo[0];
		echo "<table width =\"100%\" border = \"1\">";
			echo "<tr class=\"title\"><td colspan =\"2\" > ",$i+1,". ",RACE_APL_INFO_RACER_DATA;
			echo "<tr><td width=\"200\">",RACE_APL_INFO_FNAME,": <td >",$rinfo->getFname();
			echo "<tr><td width=\"100\">",RACE_APL_INFO_LNAME,": <td> ",$rinfo->getLname();
			echo "<tr><td>",RACE_APL_INFO_ID,": <td >",$rinfo->getPK();
			echo "<tr><td>",RACE_APL_INFO_ADDRESS,": <td >",$rinfo->getAddr();
			echo "<tr><td>",RACE_APL_INFO_PHONE,": <td >",$rinfo->getTel();
			
			echo "<tr><td>",RACE_APL_INFO_NR,": <td >",$trr[$i]->nr;
			echo "<tr><td>",RACE_APL_INFO_LIC,": <td >",$trr[$i]->lic;
			
			echo "<tr><td>",RACE_APL_INFO_CLUB,": <td >",$trr[$i]->clubName;
			
			
			
			echo "<tr><td>",RACE_APL_INFO_SEX,": <td >";
					if ($rinfo->getSex() == 2){echo " ",RACE_APL_INFO_MALE," ";}else {echo RACE_APL_INFO_FEMALE;}
			
			echo "<tr><td>",RACE_APL_INFO_INS,": <td >";
				if ($trr[$i]->ins == 1){echo " ",RACE_APL_INFO_INSY," ";} else {echo RACE_APL_INFO_INSN;}
			
			
			echo "<tr><td>",RACE_APL_INFO_TEHT,": <td >";
				
					if ($trr[$i]->type == 1){echo RACE_APL_INFO_EMPTY;}
					if ($trr[$i]->type == 2){echo " Moto ";}
					if ($trr[$i]->type == 3){echo " Velo ";}
					if ($trr[$i]->type == 4){echo " Kvadro ";}
				
			echo "<tr><td width=\"100\" >",RACE_APL_INFO_TEH,": <td >",str_replace("^", " ",$trr[$i]->tehn)," ",RACE_APL_INFO_TAK;
		echo "</table> ";
	}	
}

function printRaceAppl(){
	printAactualRaceMenu(1);
	$rcm = new RacerManager;
	$racer = $rcm->getRacer($_SESSION['user']['user_id']);
	$team = $rcm->getTeam("",$racer[0]->getUserID(),1,"");
	if (!$team){
		echo prntWarn(RACE_APL_TEAM_WRN);		
		return;
	}
	$cm = new champManager;
	$rm = new raceManager;
	$r = $rm->getRace("","","",1,"",1,0);
	if ($r){
		$x = $rcm->getTeamRace("",$team[0]->getID(),$r[0]->getID(),"");		
	} else {
		echo prntWarn(RACE_APL_RACE_WRN);	
		return;
	}
	$x = $rcm->getTeamRace("",$team[0]->getID(),$r[0]->getID(),"");
	if ($x){
		echo "<b style=\"color:blue;font-size:15px\">",$team[0]->getName(),"</b> - ";
		echo "<b style=\"color:green;font-size:15px\">",RACE_APL_APL_SUC,"</b><hr>";
		printInfo();
		return;
	}
	echo "<b style=\"color:blue;font-size:15px\">",$team[0]->getName(),"</b><hr>";
	
	echo "<form action=\"index.php\" method=\"post\">";
		echo "<input type=\"hidden\" name = \"race\" value =\"".$r[0]->getID()."\">";
		echo RACE_APL_CLASS,": ";
	
		$rc = $rm->getRClass($r[0]->getID());
		echo "<select name = \"class\">";
		for($i=0;$i<count($rc);$i++){
			echo "<option value=\"",$rc[$i]->getCID(),"\">";
				$cl = $cm->getClass($rc[$i]->getCID(),"");
				echo $cl[0]->getName();
			echo "</option>";
		}
		echo "</select>";
		
		$rcrs = $team[0]->getRacers();		
	
		echo "<br><table width =\"100%\" border = \"1\">";
		for($i=0;$i<count($rcrs);$i++){
			$rci = $rcrs[$i]->getRacerDet();
			echo "<input type=\"hidden\"  name =\"rec".$rcrs[$i]->getRacerID()."\" value = \"".$rcrs[$i]->getRacerID()."\" >";				
			
			echo "<tr><td style=\"font-size:15px;font-weight:bold;\" colspan=\"4\">",$rci[0]->getLName()," ",$rci[0]->getFName();	
			echo "<tr class=\"title\">";
				echo"<td colspan=\"4\">".PE_APPL_TEHN_TYPE_TITLE;
				echo"<tr><td >";
				echo "<select  name =\"teht".$rcrs[$i]->getRacerID()."\" style=\"width:200px;\">";
					echo "<option value =\"1\"> ".PE_APPL_TEHN_NOT_CHOSEN_NAME."</option>";
					echo "<option value =\"2\"> ".PE_APPL_TEHN_MOTO_NAME."</option>";
					echo "<option value =\"3\"> ".PE_APPL_TEHN_VELO_NAME."</option>";
					echo "<option value =\"4\"> ".PE_APPL_TEHN_KVADRO_NAME."</option>";					
				echo "</select>";
								
				echo "<td rowspan=\"2\" colspan=\"3\"> ";
				echo '<table border = "0">';
					echo '<tr><td>'.MOTO_BRAND.'<td>'.MOTO_MODEL.'<td>'.MOTO_V.'<td>'.MOTO_T;
					echo '<tr>';
					echo '<td><input type="text" name ="teh_Marka'.$rcrs[$i]->getRacerID().'" ID ="teh_Marka'.$rcrs[$i]->getRacerID().'">';
					echo '<td><input type="text" name ="teh_Model'.$rcrs[$i]->getRacerID().'" ID ="teh_Model'.$rcrs[$i]->getRacerID().'">';
					echo '<td><input type="text" name ="teh_V'.$rcrs[$i]->getRacerID().'" ID ="teh_V'.$rcrs[$i]->getRacerID().'">';
					echo '<td><select  name ="teh_T'.$rcrs[$i]->getRacerID().'" ID ="teh_T'.$rcrs[$i]->getRacerID().'" >';
						echo '<option value = "2">2</option>';
						echo '<option value = "4">4</option>';
					echo '</select>';
				echo '</table>';
				
				echo"<tr><td >  ";
				
				$sql = "select distinct(`tehn`) as tehn
				from `enduro_application` 
				where `tehn` is not null and `RACER_ID` = ".$rcrs[$i]->getRacerID()."
				
				union 
				
				select distinct(`tehn`) as tehn
				from `e_trracer` 
				where `tehn` is not null and `TeamRacerID` = ".$rcrs[$i]->getRacerID();
				
				//echo $sql;
				$q_result = queryDB($sql);
		
				//print_r($apl1);
		
				echo '<select name="tehn'.$rcrs[$i]->getRacerID().'"
						onchange="fillTeh(this.value,'.$rcrs[$i]->getRacerID().')"	 style="width:200px;"			
				>';      
					echo '<option>'.PE_APL_CHOOSE_TEHN.'</option>';
					while($apl1 = mysql_fetch_array($q_result, MYSQL_ASSOC)){
						echo '<option value="',$apl1['tehn'],'">',str_replace("^", " ",$apl1['tehn']),' taktis</option>';
					}				
				echo ' </select>';
				
			echo "<tr>";				
				echo"<td >".PE_APPL_NR_TITLE;
				echo"<td >".PE_APPL_LIC_TITLE;
				echo"<td >".PE_APPL_CLUB_TITLE;
				echo"<td >".PE_APPL_INS_TITLE;
			echo "<tr>";					
				
				$resnr =$rci[0]->getNR()?$rci[0]->getNR():1111;
				
				$sql= "select * 
					from 
					(
						SELECT @row_number:=@row_number+1 AS row_number 
						FROM  `d_checkpoint`, (SELECT @row_number:=0) AS t	
					 ) nr 
						left join `phpbb_profile_fields_data` fd on nr.`row_number` = fd.`pf_rm_sport_nr`
						left join `e_trracer` trr on `row_number` = trr.`NR` 
						left join `e_teamrace` tr on  tr.`trid` = trr.`trid` and tr.`raceid` = ".$r[0]->getID()."
												
					where 
						`user_ID` is null 
						and trr.`TRRacerID` is null
						and  `row_number` > 0 and `row_number` < 1000
						or `row_number` = $resnr
						and `row_number` <> 1111";
				
				$q_result = queryDB($sql);
				if ($resnr!= 1111){ 
				
					echo '<td> <input type="text" name = "NR'.$rcrs[$i]->getRacerID().'" style="width: 200px;" value = "'.$resnr.'" readonly>';
				
				
				} else {
					echo '<td ><select name = "NR'.$rcrs[$i]->getRacerID().'"  style="width: 200px;" disabled>';
							echo "<option value =\"\"></option>";
						while($row = mysql_fetch_array($q_result, MYSQL_ASSOC)){
							echo "<option value=\"",$row["row_number"],"\" ";
							if ($row){
								if ($row["row_number"]==$resnr){echo " selected ";}
							}
							echo ">";
							echo $row["row_number"];
							echo "</option>";
						}
					echo "</select>";
				}
					echo"<td >";
					
					$sql = "select *
							from  `enduro_licence` 
							where `racer_id` = ".$rci[0]->getUserID()." and YEAR(`start_date`) = year(now())";

					$q_result = queryDB($sql);
					$k = 1;
					$lclub='';
					echo '<select name = "lic'.$rcrs[$i]->getRacerID().'"  style="width: 150px;"> ';
					while($row = mysql_fetch_array($q_result, MYSQL_ASSOC)){
						if ($k==1){$lclub = $row["CLUB"];}
						echo "<option value=\"",$row["LIC_NR"],"\" >";
						echo $row["LIC_NR"]," (",$row["TYPE"],")";
						echo "</option>";
						$k++;
					}
					echo "</select>";					
					
					echo"<td >";
					
						$list = $rcm->getClub("");
						echo '<select name = "CLUB'.$rcrs[$i]->getRacerID().'" id = "CLUB'.$rcrs[$i]->getRacerID().'" style="width: 200px;" >';
						for($j=0;$j<count($list);$j++){
							echo "<option value=\"",$list[$j]->getID(),"\" ";
							if ($lclub == $list[$j]->getID()){echo " selected ";};
							echo ">";
							echo $list[$j]->getName();
							echo "</option>";
						}
						echo "</select>";
					echo "<td><input type=\"checkbox\" value = \"1\" name =\"INS".$rcrs[$i]->getRacerID()."\">";
		}
		echo "</table>";
		
		echo "<input type=\"hidden\" name = \"rm_func\" value=\"racer\"> ";
		echo "<input type=\"hidden\" name = \"rm_subf\" value=\"saveraceAppl\"> ";
		echo "<input type=\"hidden\" name = \"opt\" value=\"",$team[0]->getID(),"\"> ";
		echo "<hr><center><input type=\"submit\" value=\"",RACE_APL_OK,"\"> </center>";
	echo "</form>";
}

function printRaceAppl1($opt){
	
	$rcm = new RacerManager;
	
	$team = $rcm->getTeam($opt,"",1,"");
	
	$cm = new champManager;
	$rm = new raceManager;
	$r = $rm->getRace("","","",1,"",1,0);
	if ($r){
		$x = $rcm->getTeamRace("",$team[0]->getID(),$r[0]->getID(),"");		
	} else {
		echo prntWarn("Nav aktuālās sacensības!!");	
		return;
	}
	$x = $rcm->getTeamRace("",$team[0]->getID(),$r[0]->getID(),"");
	// if ($x){
		// echo "<b style=\"color:blue;font-size:15px\">",$team[0]->getName(),"</b> - ";
		// echo "<b style=\"color:green;font-size:15px\">komanda ir pieteikta!</b><hr>";
		// printInfo();
		// return;
	// }
	//echo "<b style=\"color:blue;font-size:15px\">",$team[0]->getName(),"</b><hr>";
	
	echo "<form action=\"index.php\" method=\"post\">";
		echo "<input type=\"hidden\" name = \"race\" value =\"".$r[0]->getID()."\">";
		echo "Klase: ";
	
		$rc = $rm->getRClass($r[0]->getID());
		echo "<select name = \"class\">";
		for($i=0;$i<count($rc);$i++){
			echo "<option value=\"",$rc[$i]->getCID(),"\">";
				$cl = $cm->getClass($rc[$i]->getCID(),"");
				echo $cl[0]->getName();
			echo "</option>";
		}
		echo "</select>";
					
		$rcrs = $team[0]->getRacers();		
				
		echo "<br><table width =\"100%\" border = \"1\">";
		for($i=0;$i<count($rcrs);$i++){
			$rci = $rcrs[$i]->getRacerDet();
			echo "<input type=\"hidden\"  name =\"rec".$rcrs[$i]->getRacerID()."\" value = \"".$rcrs[$i]->getRacerID()."\" >";				
			
			echo "<tr><td style=\"font-size:15px;font-weight:bold;\" colspan=\"4\">",$rci[0]->getLName()," ",$rci[0]->getFName();	
			echo "<tr class=\"title\">";
				echo"<td colspan=\"4\">".PE_APPL_TEHN_TYPE_TITLE;
				echo"<tr><td >";
				echo "<select  name =\"teht".$rcrs[$i]->getRacerID()."\" style=\"width:200px;\">";
					echo "<option value =\"1\"> ".PE_APPL_TEHN_NOT_CHOSEN_NAME."</option>";
					echo "<option value =\"2\"> ".PE_APPL_TEHN_MOTO_NAME."</option>";
					echo "<option value =\"3\"> ".PE_APPL_TEHN_VELO_NAME."</option>";
					echo "<option value =\"4\"> ".PE_APPL_TEHN_KVADRO_NAME."</option>";					
				echo "</select>";
								
				echo "<td rowspan=\"2\" colspan=\"3\"> ";
				echo '<table border = "0">';
					echo '<tr><td>'.MOTO_BRAND.'<td>'.MOTO_MODEL.'<td>'.MOTO_V.'<td>'.MOTO_T;
					echo '<tr>';
					echo '<td><input type="text" name ="teh_Marka'.$rcrs[$i]->getRacerID().'" ID ="teh_Marka'.$rcrs[$i]->getRacerID().'">';
					echo '<td><input type="text" name ="teh_Model'.$rcrs[$i]->getRacerID().'" ID ="teh_Model'.$rcrs[$i]->getRacerID().'">';
					echo '<td><input type="text" name ="teh_V'.$rcrs[$i]->getRacerID().'" ID ="teh_V'.$rcrs[$i]->getRacerID().'">';
					echo '<td><select  name ="teh_T'.$rcrs[$i]->getRacerID().'" ID ="teh_T'.$rcrs[$i]->getRacerID().'" >';
						echo '<option value = "2">2</option>';
						echo '<option value = "4">4</option>';
					echo '</select>';
				echo '</table>';
				
				echo"<tr><td >  ";
				
				$sql = "select distinct(`tehn`) as tehn
				from `enduro_application` 
				where `tehn` is not null and `RACER_ID` = ".$rcrs[$i]->getRacerID()."
				
				union 
				
				select distinct(`tehn`) as tehn
				from `e_trracer` 
				where `tehn` is not null and `TeamRacerID` = ".$rcrs[$i]->getRacerID();
				
				//echo $sql;
				$q_result = queryDB($sql);
		
				//print_r($apl1);
		
				echo '<select name="tehn'.$rcrs[$i]->getRacerID().'"
						onchange="fillTeh(this.value,'.$rcrs[$i]->getRacerID().')"	 style="width:200px;"			
				>';      
					echo '<option>'.PE_APL_CHOOSE_TEHN.'</option>';
					while($apl1 = mysql_fetch_array($q_result, MYSQL_ASSOC)){
						echo '<option value="',$apl1['tehn'],'">',str_replace("^", " ",$apl1['tehn']),' taktis</option>';
					}				
				echo ' </select>';
				
			echo "<tr>";				
				echo"<td >".PE_APPL_NR_TITLE;
				echo"<td >".PE_APPL_LIC_TITLE;
				echo"<td >".PE_APPL_CLUB_TITLE;
				echo"<td >".PE_APPL_INS_TITLE;
			echo "<tr>";					
				
				$resnr =$rci[0]->getNR()?$rci[0]->getNR():1111;
				$ix = 1;
				echo '<td ><select name = "NR'.$rcrs[$i]->getRacerID().'"  style="width: 200px;">';
					while($ix < 1000){
						echo "<option value=\"",$ix,"\" ";
						//if ($row){
							if ($ix==$resnr){echo " selected ";}
						//}
						echo ">";
						echo $ix;
						echo "</option>";
						$ix++;
					}
				echo "</select>";
					echo"<td >";
					
					$sql = "select *
							from  `enduro_licence` 
							where `racer_id` = ".$rci[0]->getUserID()." and YEAR(`start_date`) = year(now())";

					$q_result = queryDB($sql);
					$k = 1;
					$lclub='';
					echo '<select name = "lic'.$rcrs[$i]->getRacerID().'"  style="width: 150px;"> ';
					while($row = mysql_fetch_array($q_result, MYSQL_ASSOC)){
						if ($k==1){$lclub = $row["CLUB"];}
						echo "<option value=\"",$row["LIC_NR"],"\" >";
						echo $row["LIC_NR"]," (",$row["TYPE"],")";
						echo "</option>";
						$k++;
					}
					echo "</select>";					
					
					echo"<td >";
					
						$list = $rcm->getClub("");
						echo '<select name = "CLUB'.$rcrs[$i]->getRacerID().'" id = "CLUB'.$rcrs[$i]->getRacerID().'" style="width: 200px;" >';
						for($j=0;$j<count($list);$j++){
							echo "<option value=\"",$list[$j]->getID(),"\" ";
							if ($lclub == $list[$j]->getID()){echo " selected ";};
							echo ">";
							echo $list[$j]->getName();
							echo "</option>";
						}
						echo "</select>";
					echo "<td><input type=\"checkbox\" value = \"1\" name =\"INS".$rcrs[$i]->getRacerID()."\">";
		}
		echo "</table>";
		
		echo "<input type=\"hidden\" name = \"rm_func\" value=\"racer\"> ";
		echo "<input type=\"hidden\" name = \"rm_subf\" value=\"saveraceAppl\"> ";
		echo "<input type=\"hidden\" name = \"admin\" value=\"1\"> ";
		echo "<input type=\"hidden\" name = \"opt\" value=\"",$team[0]->getID(),"\"> ";
		echo "<hr><center><input type=\"submit\" value=\"Apstiprināt\"> </center>";
	echo "</form>";
}

function printProfile($opt){
	
	$rcm = new RacerManager;
	$chm = new champManager;
	$sec = new Security;
	
	switch($_SESSION['params']['editmode']){
		case "enduroreg":
		case "pe":
			$id=$_SESSION['params']['id'];
			break;
		default:
			$id=$opt;
	}
	$racer = $rcm->getRacer($id);
	if (count($racer) < 1) {return;}

	echo "<form action=\"index.php\" method=\"post\">";
	echo "<table width =\"100%\" border = \"1\">";
		echo "<tr><td>",MY_DATA_MAIL,": <td >";
		if (
				
				$sec->testUserGroup($_SESSION['user']["user_id"],ENDURO_ADMINS) || 
				$sec->testUserGroup($_SESSION['user']["user_id"],RM_ADMINS) ||
				$sec->testUserGroup($_SESSION['user']['user_id'],"RM_ENDURO_ORG") ||
				$sec->testUserGroup($_SESSION['user']['user_id'],"RM_MPS_Orgi") ||
				$sec->testUserGroup($_SESSION['user']['user_id'],"RM_MPS_admins")
		)
		{ 
			echo "<input type=\"text\" name = \"email\" value=\"",$racer[0]->getMail(),"\">";
		} else {
			echo $racer[0]->getMail();
		}
		
		echo "<tr><td>",MY_DATA_NAME,": <td ><input type=\"text\" name = \"fn\" value=\"",$racer[0]->getFname(),"\">";
		echo "<tr><td width=\"100\">",MY_DATA_LNAME,": <td> <input type=\"text\" name = \"ln\" value=\"",$racer[0]->getLname(),"\">";
		echo "<tr><td>",MY_DATA_ID,": <td ><input type=\"text\" name = \"pk\" value=\"",$racer[0]->getPK(),"\">";
		
		echo "<tr><td>",MY_DATA_SEX,": <td ><select name =\"sex\">";
			echo "<option value=\"1\"";
				if ($racer[0]->getSex() == 1){echo " selected ";};
			echo ">&lt;",SELECT_NOTHING,"&gt;</option>";
			echo "<option value=\"2\"";
				if ($racer[0]->getSex() == 2){echo " selected ";};
			echo ">",MY_DATA_MALE,"</option>";
			echo "<option value=\"3\"";
				if ($racer[0]->getSex() == 3){echo " selected ";};
			echo ">",MY_DATA_FEMALE,"</option>";
		echo "</select>";
		
		echo "<tr><td>",MY_DATA_BD,": <td ><select name = \"byear\">";			
			$years = getYears();
			for($i = 0;$i<count($years);$i++){
				echo "<option value =\"$i\"" ;
					if ($racer[0]->getBYear() == $i){echo " selected ";}
				echo " >",$years[$i],"</option>";
			}
		echo "</select>";	
		
		$conts = $chm->getCountry();
		echo "<tr><td>",MY_DATA_CONT,": <td ><select  name = \"cont\">";
			for($i=0;$i<count($conts);$i++){
				echo "<option value=\"",$conts[$i]->getId(),"\"";
				if($racer[0]->getValsts() == $conts[$i]->getId()){echo " selected ";}
				echo ">",$conts[$i]->getName(),"</option>";
			}
		echo "</select>";
				
		echo "<tr><td>",MY_DATA_ADDRESS,": <td ><input type=\"text\" name = \"adr\" value=\"",$racer[0]->getAddr(),"\">";
		echo "<tr><td>",MY_DATA_PHONE,": <td ><input type=\"text\" name = \"tel\" value=\"",$racer[0]->getTel(),"\">";
				
		if (
				$racer[0]->getNR() ||
				$sec->testUserGroup($_SESSION['user']["user_id"],'ENDURO_ADMINS') || 
				$sec->testUserGroup($_SESSION['user']["user_id"],'RM_ADMINS') ||
				$sec->testUserGroup($_SESSION['user']['user_id'],"RM_ENDURO_ORG") ||
				$sec->testUserGroup($_SESSION['user']['user_id'],"RM_MPS_Orgi") ||
				$sec->testUserGroup($_SESSION['user']['user_id'],"RM_MPS_admins")
		)
		{
			echo "<tr><td>",MY_DATA_NR,": ";
			$resnr = $racer[0]->getNR()?$racer[0]->getNR():1111;
				$sec = new Security;
				
				$ndis = " disabled ";
				if(
					$sec->testUserGroup($_SESSION['user']["user_id"],'ENDURO_ADMINS') || 
					$sec->testUserGroup($_SESSION['user']["user_id"],'RM_ADMINS') ||
					$sec->testUserGroup($_SESSION['user']['user_id'],"RM_ENDURO_ORG") ||
					$sec->testUserGroup($_SESSION['user']['user_id'],"RM_MPS_Orgi") ||
					$sec->testUserGroup($_SESSION['user']['user_id'],"RM_MPS_admins")
				){ $ndis = "";}
				
				echo '<td ><select name = "nr"  style="width: 50px;" '.$ndis.'>';
					echo "<option value=\"\" ></option>";
					$ix = 1;
					while($ix < 1000){
						echo "<option value=\"",$ix,"\" ";
						if ($ix==$resnr){echo " selected ";}
						echo ">";
						echo $ix;
						echo "</option>";
						$ix++;
					}
				echo "</select>";
		}
		
		if((date('Y')== $racer[0]->LIC_YR) && $racer[0]->LIC_YR){
			echo "<tr><td>",MY_DATA_LICNO,": <td >",$racer[0]->getLNR();	
		}	

		if($sec->testUserGroup($_SESSION['user']["user_id"],ENDURO_ADMINS) || $sec->testUserGroup($_SESSION['user']["user_id"],RM_ADMINS)){
			echo " <tr><td>",MY_DATA_MANAGER,"<td> <input type=\"checkbox\" name=\"enduro_manager\" value=\"1\" ";
			if($racer[0]->enduromanager){
				echo " checked ";
			}
			echo ">";
		}
		echo "<tr><td width=\"100\" >",MY_DATA_TEHN,": <td >";		
		echo "<select name =\"tn\">";		
		$moto = getMoto();
		for($i=0;$i<count($moto);$i++){
			echo "<option value=\"",$i+1,"\"";
				if ($i+1 == $racer[0]->getTehnN()) {echo " selected ";};
			echo ">",$moto[$i],"</option>";
		}
		
		echo "</select>";
	
		$listCl = $rcm->getClub("");
		echo "<tr><td>",MY_DATA_CLUB,": <td >";
		echo "<select name=\"club\">";
		for($icl = 0;$icl<count($listCl);$icl++)
		{
			echo "<option value=\"",$listCl[$icl]->getID(),"\" ";
				if($listCl[$icl]->getID() == $racer[0]->getClub()) {echo " selected ";}
			echo ">",$listCl[$icl]->getName(),"</option>";
		}
		echo "</select>";
	
	echo "</table> ";
	
	echo "<hr>";
	echo "<center><input type=\"submit\" value=\"",MY_DATA_OK,"\"></center>";
	echo "<input type=\"hidden\" name=\"rm_func\" value = \"racer\">";
	echo "<input type=\"hidden\" name=\"rm_subf\" value = \"savemyprofile\">";
	echo "<input type=\"hidden\" name=\"opt\" value = \"$opt\">";
	echo "<input type=\"hidden\" name=\"id\" value = \"$id\">";
	
	switch($_SESSION['params']['editmode']){
		case "enduroreg":
			echo "<input type=\"hidden\" name=\"editmode\" value=\"",$_SESSION['params']['editmode'],"\">";
			echo "<input type=\"hidden\" name=\"day\" value = \"",$_SESSION['params']['day'],"\">";
			echo "<input type=\"hidden\" name=\"red_f\" value = \"",$_SESSION['params']['red_f'],"\">";
			echo "<input type=\"hidden\" name=\"red_s\" value = \"",$_SESSION['params']['red_s'],"\">";
			echo "<input type=\"hidden\" name=\"racer\" value = \"",$_SESSION['params']['racer'],"\">";
			echo "<input type=\"hidden\" name=\"anh\" value = \"",$_SESSION['params']['anh'],"\">";
			break;
		case "pe":
			echo "<input type=\"hidden\" name=\"red_f\" value = \"",$_SESSION['params']['red_f'],"\">";
			echo "<input type=\"hidden\" name=\"red_s\" value = \"",$_SESSION['params']['red_s'],"\">";
			echo "<input type=\"hidden\" name=\"tm\" value = \"",$_SESSION['params']['tm'],"\">";			
			echo "<input type=\"hidden\" name=\"act\" value = \"",$_SESSION['params']['act'],"\">";
			break;
	}
	echo "</form>";

	if($sec->testUserGroup($_SESSION['user']["user_id"],ENDURO_ADMINS) || $sec->testUserGroup($_SESSION['user']["user_id"],RM_ADMINS)){
		echo "<hr>";
		echo "<center><h2>Nomainīt paroli</h2></center>";

		echo '<form method="post">';
		echo "<center><table width =\"300px\" border = \"1\">";
			echo "<tr>";
				echo '<td width="100px"> Parole:<td><input type="password" name="pass1" width = "200px">';
			echo "<tr>";
				echo '<td width="100px"> Parole atkārtoti:<td><input type="password" name="pass2" width = "200px">';
		echo "</table>";
		echo '<input type="submit" value="Mainīt"></center>';

		echo "<input type=\"hidden\" name=\"rm_func\" value=\"resetPass\">";
		echo "<input type=\"hidden\" name=\"rm_subf\" value=\"changePassAdmin\">";
		echo "<input type=\"hidden\" name=\"opt\" value = \"$opt\">";

		switch($_SESSION['params']['editmode']){
			case "enduroreg":
				echo "<input type=\"hidden\" name=\"editmode\" value=\"",$_SESSION['params']['editmode'],"\">";
				echo "<input type=\"hidden\" name=\"day\" value = \"",$_SESSION['params']['day'],"\">";
				echo "<input type=\"hidden\" name=\"red_f\" value = \"",$_SESSION['params']['red_f'],"\">";
				echo "<input type=\"hidden\" name=\"red_s\" value = \"",$_SESSION['params']['red_s'],"\">";
				echo "<input type=\"hidden\" name=\"racer\" value = \"",$_SESSION['params']['racer'],"\">";
				echo "<input type=\"hidden\" name=\"anh\" value = \"",$_SESSION['params']['anh'],"\">";
				break;
			case "pe":
				echo "<input type=\"hidden\" name=\"red_f\" value = \"",$_SESSION['params']['red_f'],"\">";
				echo "<input type=\"hidden\" name=\"red_s\" value = \"",$_SESSION['params']['red_s'],"\">";
				echo "<input type=\"hidden\" name=\"tm\" value = \"",$_SESSION['params']['tm'],"\">";			
				echo "<input type=\"hidden\" name=\"act\" value = \"",$_SESSION['params']['act'],"\">";
				break;
		}

		echo "</form>";
	}
}

function saveProfile($opt){
	$rcm = new RacerManager;
	$sec = new Security;
	
	if (
		(
			$sec->testUserGroup($_SESSION['user']["user_id"],'ENDURO_ADMINS') || 
			$sec->testUserGroup($_SESSION['user']["user_id"],'RM_ADMINS') ||
			$sec->testUserGroup($_SESSION['user']['user_id'],"RM_ENDURO_ORG") ||
			$sec->testUserGroup($_SESSION['user']['user_id'],"RM_MPS_Orgi") ||
			$sec->testUserGroup($_SESSION['user']['user_id'],"RM_MPS_admins") 
		) && $_SESSION['params']['email']	
	){
	
		if (!validMail($_SESSION['params']['email'])){
			echo prntWarn(WRONG_MAIL_FORMAT);
			return false; 
		}
	
		$sql = "
			select
				`username`,
				`user_email`,
				
				(select
					u2.`user_email`
				 from `phpbb_users` u2
				 where 
					u2.`user_email` = '".$_SESSION['params']['email']."' and
					u2.`user_id` <> $opt
				 limit 1
				) as other
				
			from `phpbb_users`
			where `user_id` = $opt
		";
		
		$r = queryDB($sql);
		
		if ($row = mysql_fetch_array($r,MYSQL_ASSOC)){
			//print_r($row);
			if($row['other']){
				echo prntWarn(EMAIL_EXISTS);
				return false;
			}
			
			$sql = null;
			if($row['username'] == $row['user_email']){
				$sql = "
					update 
						`phpbb_users` 
					set 
						`user_email` = '".$_SESSION['params']['email']."' , 
						`username` = '".$_SESSION['params']['email']."'
					where 
						`user_id` = $opt
				";
			} else {
				$sql = "
					update 
						`phpbb_users` 
					set 
						`user_email` = '".$_SESSION['params']['email']."' 
					where 
						`user_id` = $opt
				";
			}
			
			if ($sql){
			//echo $sql;
				$r = queryDB($sql);
			}
		
		
		} else {
			return false;
		}
	
	}
		
	$rcm->saveRacerInfo($opt,$_SESSION['params']['ln'],$_SESSION['params']['fn'],$_SESSION['params']['pk'],$_SESSION['params']['adr'],$_SESSION['params']['tel'],$_SESSION['params']['sex'],!isset($_SESSION['params']['ins'])+1,$_SESSION['params']['tt'],$_SESSION['params']['tn'],$_SESSION['params']['nr'],$_SESSION['params']['club'],$_SESSION['params']['lnr'],$_SESSION['params']['motocc'],$_SESSION['params']['byear'],$_SESSION['params']['cont'],$_SESSION['params']['enduro_manager'],$_SESSION['params']['tn']);
	
	
}

function remRacer($opt){
	$rcm = new RacerManager;
	$rcm->delTeamRacer("",$opt);
}

function listMyTeam(){
	printAactualRaceMenu(1);
	
	$rcm = new RacerManager;
	$rm = new raceManager;
	
	$racer = $rcm->getRacer($_SESSION['user']['user_id']);
	$team = $rcm->getTeam("",$racer[0]->getUserID(),1,"");
	
	if (count($team) < 1){
		echo "<center>";
		echo "<center style=\"color:red;font-size:20px\">",TEAM_NO_TEAM_WRN,"</center><br>";		
		echo "<a href=\"index.php?rm_func=racer&rm_subf=newteam\">",TEAM_NEW,"</a>";
		echo "</center>";
		
		return;
	}
		
	$owner = 0;	
	if (	($team[0]->getLeader()) &&
			($team[0]->getLeader()->getRacerID() == $racer[0]->getUserID() )
	){
		$owner=1;
	}
		
	
	echo "<b style=\"color:blue;font-size:15px\">",$team[0]->getName(),"</b><hr>";
	$x;	$rcrs = Array();
	$r = $rm->getRace("","","",1,"",1,0);
	
	if ($r){
		$x = $rcm->getTeamRace("",$team[0]->getID(),$r[0]->getID(),"");
	}
	if ($x){
		$trr= $rcm->getTRRacer($x[0]->getTRID());
		for($i=0;$i<count($trr);$i++){
			$item=$rcm->getRacer($trr[$i]->getTRRID());
			array_push($rcrs,$item[0]);
		}				
	} else {
		$tmp = $team[0]->getRacers();
	
		for($i=0;$i<count($tmp);$i++){
			$tmp1 = $tmp[$i]->getRacerDet();
			array_push($rcrs,$tmp1[0]);
		}
	}
	
	
	echo "<table width =\"100%\" border = \"1\">";
	echo "<tr class=\"title\"><td colspan =\"2\" >",TEAM_CREW;	
	for($i=0;$i<count($rcrs);$i++){		
		$rci = $rcrs[$i];
		echo "<tr";
			if ($owner){echo " style=\"color:green;font-weight:bold\"";}
		echo "><td width=\"100\">";
		echo "<table border=\"0\"><tr>";
		
		echo "<td><form action=\"index.php\" method=\"post\">";
			echo "<input type=\"hidden\" name = \"rm_func\" value=\"racer\" > ";
			echo "<input type=\"hidden\" name = \"rm_subf\" value=\"makelead\">";
			echo "<input type=\"hidden\" name = \"opt\"  value=\"".$rcrs[$i]->getUserID()."\" >";				
			echo "<input type=\"submit\" value=\"",TEAM_MAKE_CHEF,"\">";	
		echo "</form>";	
				
				
		$msgtwxt = TEAM_LEAVE_Q;
		$btmname=TEAM_LEAVE;
		if ($owner){			
			echo "<td><form action=\"index.php\" method=\"post\">";
				echo "<input type=\"hidden\" name = \"rm_func\" value=\"racer\" > ";
				echo "<input type=\"hidden\" name = \"rm_subf\" value=\"viewprofile\">";
				echo "<input type=\"hidden\" name = \"opt\"  value=\"".$rcrs[$i]->getUserID()."\" >";				
				echo "<input type=\"submit\" value=\"",TEAM_RACER_DATA,"\">";	
			echo "</form>";	
			if (!($racer[0]->getUserId() == $rcrs[$i]->getUserID())){
				$msgtwxt=TEAM_REMOVE_Q;
				$btmname=TEAM_REMOVE;
			}
			
		} 
		
		
		if (!$x){
			if (($racer[0]->getUserId() == $rcrs[$i]->getUserID()) || $owner){
				echo "<td><button onclick=\"confDel('rem",$rcrs[$i]->getUserID(),"','$msgtwxt');\">$btmname</button>";	
				echo "<form action=\"index.php\" method=\"post\" id =\"rem",$rcrs[$i]->getUserID(),"\">";
					echo "<input type=\"hidden\" name = \"rm_func\" value=\"racer\" > ";
					echo "<input type=\"hidden\" name = \"rm_subf\" value=\"remRacer\">";
					echo "<input type=\"hidden\" name = \"opt\"  value=\"".$rcrs[$i]->getUserID()."\" >";									
				echo "</form>";
			}
		}
		
		echo "</table>";
		echo "<td width=\"*\">",$rcrs[$i]->getLname()," ",$rcrs[$i]->getFname();
	}
	echo "</table> ";
	
	if ($owner and count($rcrs) < 2 ){
		echo "<center>";
		echo "<a href=\"index.php?rm_func=racer&rm_subf=addteamracer&opt=",$team[0]->getID(),"\">",TEAM_ADD_NEW,"</a>";		
		echo "</center>";		
	}
}

function printNewTeam(){
	echo "<form action=\"index.php\" method=\"post\">";
	echo "<table width =\"100%\" border = \"1\">";
		echo "<tr class=\"title\"><td colspan =\"2\" >",NEW_TEAM_DATA;
		echo "<tr><td width = \"100\">",NEW_TEAM_NAME,": <td ><input type=\"text\" name = \"name\" size=\"100\">";		
	echo "</table> ";
	
	echo "<hr>";
	echo "<center><input type=\"submit\" value=\"",NEW_TEAM_OK,"\"></center>";
	echo "<input type=\"hidden\" name=\"rm_func\" value = \"racer\">";
	echo "<input type=\"hidden\" name=\"rm_subf\" value = \"saveteam\">";
	echo "<input type=\"hidden\" name=\"opt\" >";
	echo "</form>";
}

function saveTeam($opt){
	$rcm = new RacerManager;
	$tms = $rcm->getTeam("","","",$_SESSION['params']['name']);
	if ((count($tms) > 0) and ($opt <> $tms[0]->getID())){
		echo "<center><h1 style=\"color:red;\">",NEW_TEAM_WRN,"</h1></center>";
		return;
	}
		
	if ($opt > 0){
		$rcm->saveTeam($opt,$_SESSION['params']['name']);
	} else {
		$rcm->insTeam($_SESSION['params']['name']);
		
		$tms = $rcm->getTeam("","","",$_SESSION['params']['name']);		
		$rcm->insTeamRacer($_SESSION['user']['user_id'],$tms[0]->getID(),1)	;	
	}
}

function prntracerList(){
	$rcm = new RacerManager;
	$rcrs=$rcm->getRacer("");
	if (count($rcrs)>0){
		echo "<table border = \"1\" width=\"300\" style=\"border-collapse:collapse\">";
			for($i=0;$i<count($rcrs);$i++){
				
				echo "<tr><td width=\"17px\">";
					echo "<img src=\"./images/BlueAdd_16x16.png\" border = \"0\"
						onclick=\"addLicData(".$rcrs[$i]->getuserId().",'".$rcrs[$i]->getFname()," ",$rcrs[$i]->getLname()."',hs);\"																	
						onmouseover=\"document.body.style.cursor = 'pointer'\"
						onmouseout = \"document.body.style.cursor = 'default'\"
					>";
				echo "<td width=\"*\">",$rcrs[$i]->getLname()," ",$rcrs[$i]->getFname();
			}
		echo "</table> ";
	} else {
		echo prntWarn("Saraksts ir tukšs");
		echo "<center><a href=\"?rm_func=racer&rm_subf=newteamracer&red_f=racer&red_s=raceapplist&addmode=enduroreg\">";
			echo "<img src=\"./images/User_32x32.png\" border = \"0\" alt=\"+S\" title=\"Pievienot jaunu sportistu\">";
		echo "</a></center> ";
	}
}

function printAddTeamMate($opt){
	$rcm = new RacerManager;
	$rcrs=$rcm->getFreeRacer();
	if (count($rcrs)>0){
		echo "<table border = \"1\" width=\"300\" style=\"border-collapse:collapse\">";
			for($i=0;$i<count($rcrs);$i++){
				
				echo "<tr><td width=\"17px\">";
				
				echo "<a href=\"?rm_func=racer&rm_subf=raceapplist&f2=addTMate&opt=$opt&tm=$opt&rcr=",$rcrs[$i]->getuserId(),($_SESSION["params"]["act"] ? "&act=1" : ""),"#tm$opt\">";
					echo "<img src=\"./images/BlueAdd_16x16.png\" border = \"0\">";
				echo "</a>";
				
				
				echo "<td width=\"*\">",$rcrs[$i]->getLname()," ",$rcrs[$i]->getFname(), " (",$rcrs[$i]->getNR(),")";
			}
		echo "</table> ";
	} else {
		echo prntWarn("Saraksts ir tukšs");
		echo "<center><a href=\"?rm_func=racer&rm_subf=newteamracer&red_f=racer&red_s=raceapplist&addmode=enduroreg\">";
			echo "<img src=\"./images/User_32x32.png\" border = \"0\" alt=\"+S\" title=\"Pievienot jaunu sportistu\">";
		echo "</a></center> ";
	}
}

function printAddTRacer($opt){
	$rcm = new RacerManager;
	$rcrs=$rcm->getFreeRacer();
	
	echo "<table width =\"100%\" border = \"1\">";
	echo "<tr class=\"title\"><td colspan =\"2\" >",ADD_TEAM_MEMBER;
	for($i=0;$i<count($rcrs);$i++){
		
		echo "<tr><td width=\"100\">";
		
		echo "<table border=\"0\">";
			echo "<tr><td><form action=\"index.php\" method=\"post\">";
				echo "<input type=\"hidden\" name = \"rm_func\" value=\"racer\" > ";
				echo "<input type=\"hidden\" name = \"rm_subf\" value=\"saveaddteamracer\">";
				echo "<input type=\"hidden\" name = \"rcr\"  value=\"".$rcrs[$i]->getUserID()."\" >";				
				echo "<input type=\"hidden\" name = \"opt\" value=\"$opt\">";
				echo "<input type=\"submit\" value=\"",ADD_TEAM_ADD,"\">";	
			echo "</form>";			
		echo "</table>";
		
		
		echo "<td width=\"*\">",$rcrs[$i]->getLname()," ",$rcrs[$i]->getFname();
	}
	echo "</table> <hr>";
	
	echo "<center><a href=\"index.php?rm_func=racer&rm_subf=newteamracer&opt=$opt\">",ADD_TEAM_NEW,"</a></center>";
	
}

function printNewTRacer($opt,$withdata){
	$rcm = new RacerManager;	
	$chm = new champManager;
	
	echo "<form action=\"index.php\" method=\"post\">";
	echo "<table width =\"100%\" border = \"1\">";
		echo "<tr class=\"title\"><td colspan =\"2\"  align=\"center\"><h1> ",NEW_RACER_TITLE," </h1>";
		
		echo "<tr><td>e-pasts:";
		echo "<td >";
		if ($_SESSION['params']['addmode'] == "enduroreg"){
			echo "<input type=\"checkbox\" name = \"hasmail\" value=\"1\" checked onclick=\"document.getElementById('email').disabled = !this.checked\"> ";
		}
		echo "<input type=\"text\" name = \"email\" id=\"email\" value=\"";
		if ($withdata){echo $_SESSION['params']['email'];}
		echo "\">";
		
		switch($_SESSION['params']['addmode']){
			case "enduroreg":
				break;
			default:
				echo "<tr><td>",NEW_RACER_PASS,": <td ><input type=\"password\" name = \"p1\" value=\"";
				if ($withdata){echo $_SESSION['params']['p1'];}
				echo "\">";
				
				echo "<tr><td>",NEW_RACER_PASS2,": <td ><input type=\"password\" name = \"p2\" value=\"";
				if ($withdata){echo $_SESSION['params']['p2'];}
				echo "\">";
		}
		
		
		echo "<tr><td>",NEW_RACER_FNAME,": <td ><input type=\"text\" name = \"fn\" value=\"";
		if ($withdata){echo $_SESSION['params']['fn'];}
		echo "\">";
		
		echo "<tr><td width=\"100\">",NEW_RACER_LNAME,": <td> <input type=\"text\" name = \"ln\" value=\"";
		if ($withdata){echo $_SESSION['params']['ln'];}
		echo "\">";
		
		echo "<tr><td>",NEW_RACER_ID,": <td ><input type=\"text\" name = \"pk\" value=\"";
		if ($withdata){echo $_SESSION['params']['pk'];}
		echo "\">";
		
		echo "<tr><td>",NEW_RACER_SEX,": <td ><select name =\"sex\">";
			echo "<option value=\"1\">&lt;",NEW_RACER_EMPTY,"&gt;</option>";
			echo "<option value=\"2\">",NEW_RACER_SEXM,"</option>";
			echo "<option value=\"3\">",NEW_RACER_SEXF,"</option>";
		echo "</select>";
		
		echo "<tr><td>",NEW_RACER_BYEAR,": <td ><select name = \"byear\">";
			$years = getYears();
			for($i = 0;$i<count($years);$i++){
				echo "<option value =\"$i\">",$years[$i],"</option>";
			}
		echo "</select>";	
		
		$conts = $chm->getCountry();
		echo "<tr><td>",NEW_RACER_COUNTRY,": <td ><select  name = \"cont\">";
			for($i=0;$i<count($conts);$i++){
				echo "<option value=\"",$conts[$i]->getId(),"\">",$conts[$i]->getName(),"</option>";
			}
		echo "</select>";
				
		echo "<tr><td>",NEW_RACER_ADDRESS,": <td ><input type=\"text\" name = \"adr\" value=\"";
		if ($withdata){echo $_SESSION['params']['adr'];}
		echo "\">";
		
		echo "<tr><td>",NEW_RACER_PHONE,": <td ><input type=\"text\" name = \"tel\" value=\"";
		if ($withdata){echo $_SESSION['params']['tel'];}
		echo "\">";
		$sec = new Security;
		if (
			$sec->testUserGroup($_SESSION['user']["user_id"],'ENDURO_ADMINS') || 
			$sec->testUserGroup($_SESSION['user']["user_id"],'RM_ADMINS') ||
			$sec->testUserGroup($_SESSION['user']['user_id'],"RM_ENDURO_ORG") ||
			$sec->testUserGroup($_SESSION['user']['user_id'],"RM_MPS_Orgi") ||
			$sec->testUserGroup($_SESSION['user']['user_id'],"RM_MPS_admins")
		){
				$resnr = $_SESSION['params']['nr']?$_SESSION['params']['nr']:1111;
				$sql= "select * 
					from 
					(
						SELECT @row_number:=@row_number+1 AS row_number 
						FROM  `d_checkpoint`, (SELECT @row_number:=0) AS t	
					 ) nr 
						left join `phpbb_profile_fields_data` fd on nr.`row_number` = fd.`pf_rm_sport_nr`
					where 
						fd.`user_ID` is null				
						and  `row_number` > 0 and `row_number` < 1000
						or `row_number` = $resnr
						and `row_number` <> 1111"
						;
					
				$q_result = queryDB($sql);
				echo '<tr><td>',NEW_RACER_START_NO,': <td ><select name = "nr"  style="width: 50px;">';
					echo "<option value=\"\" ></option>";
					$ix = 1;
					while($ix < 1000){
						echo "<option value=\"",$ix,"\" ";
						if ($row){
							if ($ix==$resnr){echo " selected ";}
						}
						echo ">";
						echo $ix;
						echo "</option>";
						$ix++;
					}
				echo "</select>";
		}
	echo "</table> ";
	echo "<hr>";
	echo "<center><input type=\"submit\" value=\"",NEW_RACER_OK,"\"></center>";
	echo "<input type=\"hidden\" name=\"rm_func\" value = \"racer\">";
	echo "<input type=\"hidden\" name=\"rm_subf\" value = \"savenewuser\">";	
	switch($_SESSION['params']['addmode']){
		case "enduroreg":
			echo "<input type=\"hidden\" name=\"addmode\" value=\"",$_SESSION['params']['addmode'],"\">";
			echo "<input type=\"hidden\" name=\"day\" value = \"",$_SESSION['params']['day'],"\">";
			echo "<input type=\"hidden\" name=\"red_f\" value = \"",$_SESSION['params']['red_f'],"\">";
			echo "<input type=\"hidden\" name=\"red_s\" value = \"",$_SESSION['params']['red_s'],"\">";
			echo "<input type=\"hidden\" name=\"anh\" value = \"new1\">";
			echo "<input type=\"hidden\" name=\"opt\" value = \"$opt\">";
			break;
		case "appl":
			echo "<input type=\"hidden\" name=\"red_f\" value = \"",$_SESSION['params']['red_f'],"\">";
			echo "<input type=\"hidden\" name=\"red_s\" value = \"",$_SESSION['params']['red_s'],"\">";
			echo "<input type=\"hidden\" name=\"regdone\" value = \"1\">";
			echo "<input type=\"hidden\" name=\"addmode\" value = \"appl\">";
			break;
	}
	echo "</form>";
}

function saveAddTRacer($opt){
	$rcm = new RacerManager;
	$rcm->insTeamRacer($_SESSION['params']['rcr'],$opt,0)	;	
}

function saveNewTRacer($opt){
	if ($_SESSION['params']['login'] == ""){
		echo "<center><font color=\"red\"><b >e-pasts ir obligats!</b></font><center>";
		regShow();
		return false ;
	}
	if(!validMail($_SESSION['params']['login'])){
		echo "<center><font color=\"red\"><b >e-pasts neatbilst e-pasta formtam!</b></font><center>";
		regShow();
		return false ;
	}
	if (($_SESSION['params']['pass']!=$_SESSION['params']['pass2']) or (($_SESSION['params']['pass']== "") or ( $_SESSION['params']['pass2']==""))){
		echo "<center><font color=\"red\"><b >Ievadītās paroles nesakrīt</b></font><center>";
		regShow();
		return false;
	}	
	$sec = new Security;
	$usr = $sec->getUsers("",$_SESSION['params']['login'],"");
	if (count($usr)>0){
		echo "<center><font color=\"red\"><b >Lietotājs ar tāde e-pastu jau eksistē!</b></font><center>";
		regShow();
		return false ;
	}

	$sec->insUser($_SESSION['params']['login'],$_SESSION['params']['pass']);
	$usr = $sec->getUsers("",$_SESSION['params']['login'],"");
	$sec->insUserPermission($usr[0]->getID(),3);
	$sec->insUserPermission($usr[0]->getID(),4);
	$sec->insUserPermission($usr[0]->getID(),5);
	
	$rcm = new RacerManager;	
	$rcm->insRacer($usr[0]->getID(),1);
	$rac = $rcm->getRacer("",$usr[0]->getID(),1);
	$rcm->saveRacerInfo($rac[0]->getRacerID(),$_SESSION['params']['ln'],$_SESSION['params']['fn'],$_SESSION['params']['pk'],$_SESSION['params']['adr'],$_SESSION['params']['tel'],$_SESSION['params']['sex'],isset($_SESSION['params']['ins']),$_SESSION['params']['tt'],$_SESSION['params']['tn'],$_SESSION['params']['nr'],$_SESSION['params']['club']);
	
	echo "<center><b >Lietotājs veiksmīgi piereģistrēts!</b><br>";	
	return true;
}
?>
