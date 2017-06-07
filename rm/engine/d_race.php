<?php

class Race{
	public $ID;
	public $CH_ID;
	public $name;
	public $notes;
	public $date;
	public $code;
	public $edate;
	public $actual;
	public $type;
	
	public $galid;	
	public $ogalid;	
	public $tgalid;
	public $galvis;
	public $ogalvis;
	public $tgalvis;
	public $exresLink;
		
	public function setID($value){
		$this->ID = $value;
	}
	public function setCH_ID($value){
		$this->CH_ID = $value;
	}
	public function setName($value){
		$this->name = $value;
	}
	public function setNotes($value){
		$this->notes = $value;
	}
	public function setDate($value){
		$this->date = $value;
	}
	public function setCode($value){
		$this->code = $value;
	}
	public function setEndDate($value){
		$this->edate = $value;
	}
	public function setActual($value){
		$this->actual = $value;
	}
	public function setType($value){
		$this->type = $value;
	}
	
	public function getID(){
		return $this->ID;
	}
	public function getCH_ID(){
		return $this->CH_ID;
	}
	public function getName(){
		return $this->name;
	}
	public function getNotes(){
		return $this->notes;
	}
	public function getDate(){
		return $this->date;
	}
	public function getCode(){
		return $this->code;
	}
	public function getEndDate(){
		return $this->edate;
	}
	public function getActual(){
		return $this->actual;
	}
	public function getType(){
		return $this->type;
	}
	
}
class RaceClass{
	private $rcid;
	public function setRCID($value){
		$this->rcid = $value;
	}
	public function getRCID(){
		return $this->rcid;
	}
	private $raceID;
	public function setRID($value){
		$this->raceID = $value;
	}
	public function getRID(){
		return $this->raceID;
	}
	private $cid;
	public function setCID($value){
		$this->cid = $value;
	}
	public function getCID(){
		return $this->cid;
	}
	
}
class RacePTask{
	private $rcid;
	public function setID($value){
		$this->rcid = $value;
	}
	public function getID(){
		return $this->rcid;
	}
	private $raceID;
	public function setRID($value){
		$this->raceID = $value;
	}
	public function getRID(){
		return $this->raceID;
	}
	private $cid;
	public function setPTID($value){
		$this->cid = $value;
	}
	public function getPTID(){
		return $this->cid;
	}
}
class ChPoint{
	private $Id;
	private $race_id;
	private $name;
	private $decr;
	private $quest;
	private $answ;
	private $cost;
	private $image;	
	private $notes;
	private $v_c_h;
	private $v_c_m;
	private $v_c_mp;
	private $v_c_offset;
	private $h_c_h;
	private $h_c_m;
	private $h_c_mp;
	private $h_c_offset;
	private $wp;
	private $wpname;
	private $lat;
	private $long;
	private $coordstodesc;
	private $lab_dir;
	private $lab_bg_color;
	
	public $galid;
	
	public function setId($value){
		$this->Id = $value;
	}
	public function setRaceId($value){
		$this->race_id = $value;
	}
	public function setName($value){
		$this->name = $value;
	}
	public function setDescr($value){
		$this->descr = $value;
	}
	public function setQuest($value){
		$this->quest = $value;
	}
	public function setAnsw($value){
		$this->answ = $value;
	}
	public function setCost($value){
		$this->cost = $value;
	}
	public function setImage($value){
		$this->image = $value;
	}
	public function setCoord($value){
		$this->coord = $value;
	}
	public function setNotes($value){
		$this->notes = $value;
	}
	public function setVch($value){
		$this->v_c_h = $value;
	}
	public function setVcm($value){
		$this->v_c_m = $value;
	}
	public function setVcmp($value){
		$this->v_c_mp = $value;
	}
	public function setVcoffset($value){
		$this->v_c_offset = $value;
	}
	public function setHch($value){
		$this->h_c_h = $value;
	}
	public function setHcm($value){
		$this->h_c_m = $value;
	}
	public function setHcmp($value){
		$this->h_c_mp = $value;
	}
	public function setHcoffset($value){
		$this->h_c_offset = $value;
	}
	public function setWP($value){
		$this->wp = $value;
		$wp = explode(",",$value);
		$this->setWPName($wp[1]);
	}
	public function setWPName($value){
		$this->wpname = $value;
	}
	public function setLat($value){
		$this->lat = $value;
	}
	public function setLong($value){
		$this->long = $value;
	}
	public function setCtD($value){
		$this->coordstodesc = $value;
	}
	public function setLabDir($value){
		$this->lab_dir = $value;
	}
	public function setLabBgColor($value){
		$this->lab_bg_color = $value;
	}
	
	public function getLabBgColor(){
		return $this->lab_bg_color;
	}
	public function getLabDir(){
		return $this->lab_dir;
	}
	public function getId(){
		return $this->Id;
	}
	public function getRaceId(){
		return $this->race_id;
	}
	public function getName(){
		return $this->name;
	}
	public function getDescr(){
		return $this->descr;
	}
	public function getQuest(){
		return $this->quest;
	}
	public function getAnsw(){
		return $this->answ;
	}
	public function getCost(){
		return $this->cost;
	}
	public function getImage(){
		return $this->image;
	}
	public function getCoord(){
		return $this->coord;
	}
	public function getNotes(){
		return $this->notes;
	}
	public function getVch(){
		return floor(abs($this->getLat()));
	}
	public function getVcm(){
		return floor((abs($this->getLat()) - $this->getVch())*60);
	}
	public function getVcmp(){
		$tmp =(abs($this->getLat()) - $this->getVch())*60;
		$tmp = explode('.',"$tmp");		
		return substr($tmp[1], 0, 5);		
	}
	public function getVcoffset(){
		if ($this->GetLat() > 0){
			return "N";
		} else {
			return "S";
		}
	}
	public function getHch(){
		return floor(abs($this->getLong()));
	}
	public function getHcm(){
		return floor((abs($this->getLong()) - $this->getHch())*60);
	}
	public function getHcmp(){
		$tmp =(abs($this->getLong()) - $this->getHch())*60;
		$tmp = explode('.',"$tmp");		
		return substr($tmp[1], 0, 5);	
	}
	public function getHcoffset(){
		if ($this->GetLong() > 0){
			return "E";
		} else {
			return "W";
		}		
	}
	public function getWP(){
		return $this->wp;
	}
	public function getWPName(){
		return $this->wpname;
	}	
	public function getLat(){
		return $this->lat;
	}	
	public function getLong(){
		return $this->long;
	}
	public function getCtD(){
		return $this->coordstodesc;
	}
}
class ChpDet{
	private $id;
	private $class_id;
	private $chp_id;
	private $diff;
	
	public function setId($value){
		$this->id=$value;
	}
	public function setClassId($value){
		$this->class_id=$value;
	}
	public function setChpId($value){
		$this->chp_id=$value;
	}
	public function setDiff($value){
		$this->diff=$value;
	}
	public function getId(){
		return $this->id;
	}
	public function getClassId(){
		return $this->class_id;
	}
	public function getChpId(){
		return $this->chp_id;
	}
	public function getDiff(){
		return $this->diff;
	}
}
class StartFin{
	private $id;
	private $rid;	
	private $start;
	private $fin;
	private $name;
	
	public function setId($value){
		$this->id=$value;
	}
	public function setRId($value){
		$this->rid=$value;
	}
	public function setStart($value){
		$this->start=$value;
	}
	public function setFin($value){
		$this->fin=$value;
	}
	public function setName($value){
		$this->name=$value;
	}
	
	public function getId(){
		return $this->id;
	}
	public function getRId(){
		return $this->rid;
	}
	public function getStart(){
		return $this->start;
	}
	public function getFin(){
		return $this->fin;
	}
	public function getName(){
		return $this->name;
	}
	
	private $det;
	public function getDet(){
		return $this->det;
	}
	public function setDet($value){
		$this->det =$value;
	}
	
	public function hasDet($cid){
		for($i=0;$i<count($this->det);$i++){
		//echo $this->det[$i]->getClassId()," $cid <br>";
			if($this->det[$i]->getClassId() == $cid){
				return true;
				break;
			}
		}
		return false;
	}
}
class STFinDet{
	private $id;
	private $class_id;
	private $stf;	
	
	public function setId($value){
		$this->id=$value;
	}
	public function setClassId($value){
		$this->class_id=$value;
	}
	public function setStfId($value){
		$this->stf=$value;
	}
	
	public function getId(){
		return $this->id;
	}
	public function getClassId(){
		return $this->class_id;
	}
	public function getStfId(){
		return $this->stf;
	}
	
}
class RaceCrew{
	private $id;
	private $uid;
	private $rid;
	private $perm;
	private $name;
	
	public function setId($value){
		$this->id=$value;
	}
	public function setUId($value){
		$this->uid=$value;
	}
	public function setRId($value){
		$this->rid=$value;
	}
	public function setPerm($value){
		$this->perm=$value;
	}
	public function setName($value){
		$this->name=$value;
	}
	public function getId(){
		return $this->id;
	}
	public function getUId(){
		return $this->uid;
	}
	public function getRId(){
		return $this->rid;
	}
	public function getPerm(){
		return $this->perm;
	}
	public function getName(){
		return $this->name;
	}
}


class raceManager{

	public function getRace($id,$ch_id,$date,$act,$type,$sel,$list){
		//echo $_SESSION['selrace'];
		if ($sel<>"" && $sel==1){
			if(isset($_SESSION['selrace'])){
				$id=$_SESSION['selrace'];
			} else {
				$id=-1;
			}
		}
		
		$sql = "
			SELECT r.*,g.`active` as GAL_VISIBLE, og.`active` as ORG_GAL_VISIBLE,tg.`active` as TMS_GAL_VISIBLE
			FROM `d_race` r 
				left join `items` g on (g.`id` = r.`gal_id`)
				left join `items` og on (og.`id` = r.`ORG_GAL_ID`)
				left join `items` tg on (tg.`id` = r.`TMS_GAL_ID`)";
  
 		if ($id <> "") {$where = "r.`race_id` = '$id'";} 			
		
		if ($list){		
			if(!$type){
				return;
			} else {
				switch ($type){
					case 1:						
					case 2:
						$group = MPS_ADMINS;
						break;
					case 3:
						$group = ENDURO_ADMINS;
						break;
					default:
						$group = RM_ADMINS;
				}
			}
			
			if ($where <> "") { $where = "$where and";}
			$where = "  $where (
						exists(
							select * 
							from `b_racecrew` rc 
							where (rc.raceid = r.race_id ) and rc.`userid` = ".$_SESSION[user_id]."
						) or
						exists (
							select * 
							from `phpbb_user_group` ug
								inner join `phpbb_groups` g on (g.`group_id` = ug.`group_id`)
							WHERE ug.`user_id` = ".$_SESSION[user_id]." and (g.`group_name` = '$group' or g.`group_name` = '".RM_ADMINS."')
						)
					)";
		}
		
		if ($ch_id <> "") {
			if ($where <> "") { $where = "$where and";}
			$where = "$where ch_id = '$ch_id'";
		}
		
		if($act<>""){
			if ($where <> "") { $where = "$where and";}
			$where = "$where `actual` = $act";
		}
		if($type<>""){
			if ($where <> "") { $where = "$where and";}
			$where = "$where `TYPE` = $type";
		}
		if ($where <> "") {$sql = "$sql where $where";}			
			
			$sql = "$sql 
			ORDER BY r.`DATE` desc";

		$q_result = queryDB($sql);		
		
		$reslt = array();		
		 while ($row = mysql_fetch_array($q_result, MYSQL_ASSOC)) {
			
			$item = new Race;
			
			$item->setID($row[RACE_ID]);
			$item->setCH_ID($row[CH_ID]);
			$item->setName($row[NAME]);
			$item->setDate($row[DATE]);						
			$item->setNotes($row[NOTES]);
			$item->setCode($row[CODE]);
			$item->setEndDate($row[END_DATE]);
			$item->setActual($row[ACTUAL]);
			$item->setType($row[TYPE]);
							
			$item->galid = $row[GAL_ID];						
			$item->galvis = $row[GAL_VISIBLE];
			$item->ogalid = $row[ORG_GAL_ID];
			$item->ogalvis = $row[ORG_GAL_VISIBLE];
			$item->tgalid = $row[TMS_GAL_ID];
			$item->tgalvis = $row[TMS_GAL_VISIBLE];
			$item->exresLink = $row[EX_RES_LINK];
			
			array_push($reslt,$item);
		}

		return $reslt;
	}	
	
	public function insRace($ch_id,$name,$notes,$date,$edate,$rules,$code,$type,$galid,$orggalid,$tmgalid,$erl){
		
		$sql = "INSERT INTO `d_race` (`ch_id` ,`name`, `notes`,`date`,`end_date`,`code`,`type`,`GAL_ID`,`ORG_GAL_ID`,`TMS_GAL_ID`,`EX_RES_LINK` ) 
		        VALUES ('$ch_id', '$name', ".($notes ? "'$notes'" : " null ").",
				".($date ? "'$date'" : " null ").",".($edate ? "'$edate'" : " null ").",'$code',$type,$galid,$orggalid,$tmgalid,'$erl');";
		//echo $sql;
		$q_result = queryDB($sql);
	}	
	public function saveRace($id,$ch_id,$name,$notes,$date,$edate,$rules,$code,$type,$erl){
		$sql = "UPDATE `d_race` SET `type` = $type,`name` = '$name',
			`date` = ".( $date ? "'$date'" : " null ").",
			`END_DATE` = ".( $edate ? "'$edate'" : " null ").",
		                            `notes` = ".($notes ? "'$notes'" : " null ").",`ch_id` = $ch_id, `EX_RES_LINK` = '$erl'
				where `race_id` = $id;";
				//echo $sql;
		$q_result = queryDB($sql);
	}	
	public function delRace($id){
		
		$sql = "delete from `d_race` where `race_id` = '$id';";
		$q_result = queryDB($sql);
	}	
	public function secActiveRace($id,$val,$type){
		
		//$sql = "UPDATE `d_race` SET  `actual` = 0 where `type` =$type";
		//$q_result = queryDB($sql);
		$sql = "UPDATE `d_race` SET  `actual` = not `actual` where `race_id` = $id;";
		$q_result = queryDB($sql);
	}

	public function getRClass($rid){
		$sql = "SELECT * FROM `d_raceclass` WHERE `RaceID` = $rid";
		$q_result = queryDB($sql);		
		
		$reslt = array();		
		 while ($row = mysql_fetch_array($q_result, MYSQL_ASSOC)) {
			
			$item = new RaceClass;
			
			$item->setRCID($row[RaceClassID]);
			$item->setRID($row[RaceID]);
			$item->setCID($row[ClassID]);
				
			array_push($reslt,$item);
		}

		return $reslt;
	}
	public function delRClass($rid){
		$sql = "DELETE FROM `d_raceclass` WHERE `RaceID` = $rid";
		$q_result = queryDB($sql);
	}
	public function delRClassByID($id){
		$sql = "delete from `d_raceclass` where RaceClassID = $id";
		$q_result = queryDB($sql);
	}
	public function insRClass($rid,$cid){
		$sql="INSERT INTO `d_raceclass` (`RaceID`,`ClassID`) VALUES ($rid,$cid)";
		//echo $sql;
		$q_result = queryDB($sql);
	}
	
	public function getRPTask($rid){
		$sql = "SELECT * FROM `d_racephototask` WHERE `RaceID` = $rid";
		$q_result = queryDB($sql);		
		//echo $sql;
		$reslt = array();		
		 while ($row = mysql_fetch_array($q_result, MYSQL_ASSOC)) {
			
			$item = new RacePTask;
			
			$item->setID($row[RacePTID]);
			$item->setRID($row[RaceID]);
			$item->setPTID($row[PTID]);
		
			
			array_push($reslt,$item);
		}

		return $reslt;
	}
	public function getRPTaskByRPid($rpid){
		$sql = "SELECT * FROM `d_racephototask` WHERE `RacePTID` = $rpid";
		$q_result = queryDB($sql);		
		echo $sql;
		$reslt = array();		
		 while ($row = mysql_fetch_array($q_result, MYSQL_ASSOC)) {
			
			$item = new RacePTask;
			
			$item->setID($row[RacePTID]);
			$item->setRID($row[RaceID]);
			$item->setPTID($row[PTID]);
		
			
			array_push($reslt,$item);
		}

		return $reslt;
	}
	public function delRPTask($rid){
		$sql = "DELETE FROM `d_racephototask` WHERE `RaceID` = $rid";
		$q_result = queryDB($sql);
	}
	public function insRPTask($rid,$tid){
		$sql="INSERT INTO `d_racephototask` (`RaceID`,`PTID`) VALUES ($rid,$tid)";
		$q_result = queryDB($sql);
	}

	public function getChPoint($id,$race_id,$name,$cost){
		$sql = "SELECT * FROM `d_checkpoint`";
		$where = "";
		if ($id <> "") {$where = "cp_id = $id";}
		if($name<>""){
			if ($where <> "") { $where = "$where and";}
			$where = "$where `name` = '$name'";
		}
		if($race_id<>""){
			if ($where <> "") { $where = "$where and";}
			$where = "$where `race_id` = $race_id";
		}
		if($cost<>""){
			if ($where <> "") { $where = "$where and";}
			$where = "$where `cost` = $cost";
		}
		if ($where <> "") {$sql = "$sql where $where order by `name` asc, `cost` asc,CAST(SUBSTRING(`WP_ENTRY`,INSTR(`WP_ENTRY`,'WP')+2,INSTR(SUBSTRING(`WP_ENTRY`,INSTR(`WP_ENTRY`,'WP')+2),',')-1) as SIGNED) asc";}				
			
			
			
		$q_result = queryDB($sql);			
		
		$reslt = array();	
		$su = array();
		
		 while ($row = mysql_fetch_array($q_result, MYSQL_ASSOC)) {
			
			$item = new ChPoint;
			
			$item->setId($row[CP_ID]);
			$item->setName($row[NAME]);
			$item->setDescr($row[DESCR]);
			$item->setQuest($row[QUESTION]);
			$item->setAnsw($row[ANSWER]);
			$item->setCost($row[COST]);
			$item->setImage($row[IMAGE]);
			$item->setCoord($row[COORDS]);
			$item->setNotes($row[NOTES]);						
			$item->setRaceId($row[RACE_ID]);				
			$item->setWP($row[WP_ENTRY]);	
			$item->setLat($row[lat]);	
			$item->setLong($row[long]);	
			$item->setCtD($row[cordstodesc]);	
			$item->setLabDir($row[LABEL_DIR]);	
			$item->setLabBgColor($row[LABEL_BG_COLOR]);	
			$item->galid = $row[GAL_ID];
			
			if (strtoupper(substr($item->getName(),0,2))=="SU"){
				array_push($su,$item);					
			} else {
				array_push($reslt,$item);
			}
		}
		$i=0;
		while($reslt[$i]){
			array_push($su,$reslt[$i]);
			$i++;
		}
		
		return $su;
	}	
	public function getGPSChPoint($race_id){
		$sql = "SELECT * FROM `d_checkpoint`";
		$where = "";
		
		if($race_id<>""){
			$where = "$where `race_id` = $race_id";
		}
		$where ="$where and `cordstodesc` = 1";
		
		if ($where <> "") {$sql = "$sql where $where order by `name` asc, `cost` asc,CAST(SUBSTRING(`WP_ENTRY`,INSTR(`WP_ENTRY`,'WP')+2,INSTR(SUBSTRING(`WP_ENTRY`,INSTR(`WP_ENTRY`,'WP')+2),',')-1) as SIGNED) asc";}				
			
			
			
		$q_result = queryDB($sql);			
		
		$reslt = array();	
		$su = array();
		
		 while ($row = mysql_fetch_array($q_result, MYSQL_ASSOC)) {
			
			$item = new ChPoint;
			
			$item->setId($row[CP_ID]);
			$item->setName($row[NAME]);
			$item->setDescr($row[DESCR]);
			$item->setQuest($row[QUESTION]);
			$item->setAnsw($row[ANSWER]);
			$item->setCost($row[COST]);
			$item->setImage($row[IMAGE]);
			$item->setCoord($row[COORDS]);
			$item->setNotes($row[NOTES]);						
			$item->setRaceId($row[RACE_ID]);				
			$item->setWP($row[WP_ENTRY]);	
			$item->setLat($row[lat]);	
			$item->setLong($row[long]);	
			$item->setCtD($row[cordstodesc]);	
			$item->galid = $row[GAL_ID];
			
			if (strtoupper(substr($item->getName(),0,2))=="SU"){
				array_push($su,$item);					
			} else {
				array_push($reslt,$item);
			}
		}
		$i=0;
		while($su[$i]){
			array_push($reslt,$su[$i]);
			$i++;
		}
		
		return $reslt;
	}
	public function getActRaceChPoint($race_id){
		$sql = "SELECT  cp.`NAME`, cp.`CP_ID`, cp.`COST` FROM `d_checkpoint` cp
				INNER JOIN `d_race` r on (r.`RACE_ID` = cp.`race_id`)";
		$where = "";
		if ($race_id <> "") {
			$where = "r.`RACE_ID` = $race_id";
		} else {
			$where = "r.`ACTUAL` = 1";
		}
		
		if ($where <> "") {$sql = "$sql where $where order by cp.`name` asc, `cost` asc";}				
			
			
			
		$q_result = queryDB($sql);			
		
		$reslt = array();	
		$su = array();
		
		 while ($row = mysql_fetch_array($q_result, MYSQL_ASSOC)) {
			
			$item = new ChPoint;
			
			$item->setId($row[CP_ID]);
			$item->setName($row[NAME]);
			$item->setDescr($row[DESCR]);
			$item->setQuest($row[QUESTION]);
			$item->setAnsw($row[ANSWER]);
			$item->setCost($row[COST]);
			$item->setImage($row[IMAGE]);
			$item->setCoord($row[COORDS]);
			$item->setNotes($row[NOTES]);						
			$item->setRaceId($row[RACE_ID]);				
			$item->setWP($row[WP_ENTRY]);	
			$item->setLat($row[lat]);	
			$item->setLong($row[long]);	
			$item->setCtD($row[cordstodesc]);	
			$item->galid = $row[GAL_ID];
			
			if (strtoupper(substr($item->getName(),0,2))=="SU"){
				array_push($su,$item);					
			} else {
				array_push($reslt,$item);
			}
		}
		$i=0;
		while($su[$i]){
			array_push($reslt,$su[$i]);
			$i++;
		}
		
		return $reslt;
	}
	public function getActRaceClassCPoint($race_id,$class){
		$sql = "SELECT  cp.`NAME`, cp.`CP_ID`, cp.`COST` FROM `d_checkpoint` cp
				WHERE cp.`CP_ID` in (select rd2.`ChpID` from `d_chpdet` rd2 
									 inner join `d_checkpoint` cp2 on (cp2.`CP_ID` = rd2.`ChpID`)
									 where rd2.`RClassID` = $class and cp.`RACE_ID` = $race_id)
				order by cp.`name` asc, `cost` asc";
		
		
	//echo $sql;		
			
			
			
		$q_result = queryDB($sql);			
		
		$reslt = array();	
		$su = array();
		
		 while ($row = mysql_fetch_array($q_result, MYSQL_ASSOC)) {
			
			$item = new ChPoint;
			
			$item->setId($row[CP_ID]);
			$item->setName($row[NAME]);
			$item->setDescr($row[DESCR]);
			$item->setQuest($row[QUESTION]);
			$item->setAnsw($row[ANSWER]);
			$item->setCost($row[COST]);
			$item->setImage($row[IMAGE]);
			$item->setCoord($row[COORDS]);
			$item->setNotes($row[NOTES]);						
			$item->setRaceId($row[RACE_ID]);				
			$item->setWP($row[WP_ENTRY]);	
			$item->setLat($row[lat]);	
			$item->setLong($row[long]);	
			$item->setCtD($row[cordstodesc]);	
			$item->galid = $row[GAL_ID];
			
			if (strtoupper(substr($item->getName(),0,2))=="SU"){
				array_push($su,$item);					
			} else {
				array_push($reslt,$item);
			}
		}
		$i=0;
		while($su[$i]){
			array_push($reslt,$su[$i]);
			$i++;
		}
		
		return $reslt;
	}
	public function insChPoint($race_id,$name,$desr,$quest,$answ,$cost,$image,$notes,$WP,$lat,$long,$ctd,$labDir,$labBgCol,$galid){
		$sql = "INSERT INTO `d_checkpoint` (`race_id`,`name`, `descr`,`question`,`answer`,`cost`,`image`,`notes`,`WP_ENTRY`,`lat`,`long`,`cordstodesc`,`LABEL_DIR`,`LABEL_BG_COLOR`,`GAL_ID` )VALUES ($race_id,'$name','$desr','$quest','$answ',$cost,'$image','$notes','$WP',$lat,$long,$ctd,$labDir,$labBgCol,".($galid ? $galid : "null").");";
		//echo $sql;
		queryDB($sql);
	}
	public function saveChPoint($id,$race_id,$name,$desr,$quest,$answ,$cost,$image,$notes,$lat,$long,$ctd,$labDir,$labBgCol,$galid){
		$sql = "UPDATE `d_checkpoint` SET `race_id` = $race_id,`name` = '$name',`descr` = '$desr',`notes` = '$notes',`image` = '$image',
				`question` ='$quest',`answer` = '$answ',`cost` = $cost,`cordstodesc` = $ctd, `lat`= $lat,`long`=$long ,
				`LABEL_DIR` = $labDir,`LABEL_BG_COLOR`= $labBgCol,`GAL_ID` = ".($galid ? $galid : "null")."
				where `cp_id` = $id;";
		
		queryDB($sql);
	}
	public function delChPoint($id){
		$sql = "delete from `d_checkpoint` where `cp_id` = '$id';";
		queryDB($sql);
	}
	
	public function getChpDet($id,$class_id,$chp_id){
			
		$sql = "SELECT * FROM `d_chpdet`";
		$where = "";
		if ($id <> "") {$where = "ChpDetID = $id";}
		if($class_id<>""){
			if ($where <> "") { $where = "$where and";}
			$where = "$where `RClassID` = '$class_id'";
		}
		if($chp_id<>""){
			if ($where <> "") { $where = "$where and";}
			$where = "$where `ChpID` = '$chp_id'";
		}
		if ($where <> "") {$sql = "$sql where $where";}			
			
		$q_result = queryDB($sql);	
				
		$reslt = array();		
		 while ($row = mysql_fetch_array($q_result, MYSQL_ASSOC)) {
			
			$item = new ChpDet;
			
			$item->setId($row[ChpDetID]);
			$item->setClassId($row[RClassID]);
			$item->setChpId($row[ChpID]);
			$item->setDiff($row[RacePTID]);
			
			array_push($reslt,$item);
		}
		return $reslt;
	}	
	public function insChpDet($class_id,$chp_id,$diff){
		$sql = "INSERT INTO `d_chpdet` (`RClassID`,`ChpID`,`RacePTID`)VALUES ($class_id, $chp_id, '$diff')";
		queryDB($sql);
	}
	public function delChpDet($id){
		$sql = "delete from `d_chpdet` where `ChpDetID` = '$id';";
		queryDB($sql);
	}
	public function delChpDet1($chp_id){
		$sql = "delete from `d_chpdet` where  `CHPID` = $chp_id;";
		queryDB($sql);
	}

	public function getSF($id,$race){
		
		
		$sql = "SELECT * FROM `d_stfin`";
		$where = "";
		if ($id <> "") {$where = "`StFinID` = $id";}
		if ($race <> "") {
			if ($where <> "") { $where = "$where and";}
			$where = "$where `RaceID` = '$race'";
		}
		if ($where <> "") {$sql = "$sql where $where";}			
			

			
		$q_result = queryDB($sql);		
		
		$reslt = array();		
		 while ($row = mysql_fetch_array($q_result, MYSQL_ASSOC)) {
			
			$item = new StartFin;
			
			$item->setId($row[StFinID]);
			$item->setRid($row[RaceID]);
			$item->setName($row[Name]);
			$item->setStart($row[Start]);						
			$item->setFin($row[Fin]);						
			$item->setDet($this->getSTFDet("",$row[StFinID]));			
			array_push($reslt,$item);
		}
//print_r($reslt);
		return $reslt;
	}	
	public function insSF($race,$name,$st,$fin){
		
		$sql = "INSERT INTO `d_stfin` (`RaceID` ,`Name`, `Start`,`Fin`)VALUES ($race, '$name', '$st','$fin');";
		//echo $sql;
		$q_result = queryDB($sql);
	}	
	public function saveSF($id,$race,$name,$st,$fin){
		
		$sql = "UPDATE `d_stfin` SET `RaceID` = $race,`Name` = '$name',`Start` = '$st',`Fin` = '$fin' where `StFinID` = $id;";
	$q_result = queryDB($sql);
	}	
	public function delSF($id){
		$this->delstfdet($id);
		$sql = "delete from `d_stfin` where `StFinID` = $id;";
		$q_result = queryDB($sql);
	}	
	
	public function getRaceSTFDet($race,$class){
		$sql = "SELECT stf.`StFinID`,stf.`RaceID`,stf.`Name`,stf.`Start`,stf.`Fin` FROM `d_stfin` stf 
					inner join `d_stfinclas` stfc on (stf.`stfinid` = stfc.`stf_id`)
				where stf.`raceid` = $race and stfc.`cl_id` = $class";
			
		$q_result = queryDB($sql);		
		
		$reslt = array();		
		 while ($row = mysql_fetch_array($q_result, MYSQL_ASSOC)) {
			
			$item = new StartFin;
			
			$item->setId($row[StFinID]);
			$item->setRid($row[RaceID]);
			$item->setName($row[Name]);
			$item->setStart($row[Start]);						
			$item->setFin($row[Fin]);						
			//$item->setDet($this->getSTFDet("",$row[StFinID]));	
			
			array_push($reslt,$item);
		}

		return $reslt;
	}
	public function getSTFDet($id,$stf){
		$sql = "SELECT * FROM `d_stfinclas`";
		$where = "";
		if ($id <> "") {$where = "`STFC_ID` = $id";}
		if ($stf <> "") {
			if ($where <> "") { $where = "$where and";}
			$where = "$where `STF_ID` = $stf";
		}
		if ($where <> "") {$sql = "$sql where $where";}			
			
//echo "$sql";
			
		$q_result = queryDB($sql);		
		
		$reslt = array();		
		 while ($row = mysql_fetch_array($q_result, MYSQL_ASSOC)) {
			
			$item = new STFinDet;
			
			$item->setId($row[STFC_ID]);
			$item->setStfId($row[STF_ID]);
			$item->setClassId($row[CL_ID]);
			
			array_push($reslt,$item);
		}

		return $reslt;
	}
	public function delstfdet($stf){
		$sql="DELETE FROM `d_stfinclas` where `STF_ID` = $stf";
		//echo $sql;
		queryDB($sql);
	}
	public function insStfDet($stf,$cid){
		$sql="INSERT INTO `d_stfinclas` (`STF_ID`,`CL_ID`) VALUES ($stf,$cid) ";
		//echo $sql;
		queryDB($sql);
	}
	
	public function getRaceCrew($race,$perm,$user){
		$sql = "SELECT cr.`RaceManID`,cr.`UserID`,cr.`RaceID`,cr.`PERM`,u.`pf_rm_f_name`, u.`pf_rm_l_name`
				FROM `b_racecrew` cr 
				inner join `phpbb_profile_fields_data` u on (u.`user_id` = cr.`userid`)";
		$where = "";
		if ($race <> "") {$where = "cr.`raceid` = $race";}
		if ($perm <> "") {
			if ($where <> "") { $where = "$where and";}
			$where = "$where cr.`perm` = $perm";
		}
		if ($user <> "") {
			if ($where <> "") { $where = "$where and";}
			$where = "$where cr.`UserID` = $user";
		}
		if ($where <> "") {$sql = "$sql where $where";}			
			
//echo "$sql";
			
		$q_result = queryDB($sql);		
		
		$reslt = array();		
		 while ($row = mysql_fetch_array($q_result, MYSQL_ASSOC)) {
			
			$item = new RaceCrew;
			
			$item->setId($row[RaceManID]);
			$item->setUId($row[UserID]);
			$item->setRId($row[RaceID]);
			$item->setPerm($row[PERM]);
			$item->setName($row[pf_rm_f_name]." ".$row[pf_rm_l_name]);
			
			array_push($reslt,$item);
		}

		return $reslt;
	}
	public function delRaceCrew($rc){
		$sql = "delete from `b_racecrew` where `RaceManID` = $rc";
		queryDB($sql);
	}
	public function saveRaceCrew($race,$perm,$crew){
		$sql="INSERT INTO `b_racecrew` (`RaceID`,`UserID`,`PERM`) VALUES ($race,$crew,$perm) ";		
		//echo $sql;
		queryDB($sql);
	}

	public function insGallery($name,$parent,$act){
		$sql ="
			INSERT INTO `items` 
				(`objType`, `parent`, `title_lv`, `title_ru`, `title_en`, `title_es`, `title_de`, `links`, `priv`, `active`, `bold`, `seq`, `datums`) 			
			select 0,$parent,'$name','$name','$name','$name','$name','',0,$act,0,case when max(seq) is null then 1 else max(seq) + 1 end ,now()
			from `items` 
				where `parent` = $parent;";
		//echo $sql;
		queryDB($sql);
		return mysql_insert_id();
	}

	public function setGal($g,$s){
		$sql = "
			update `items`
			set `active` = $s
			where `id` = $g
		";
		queryDB($sql);
	}

	public function delGal($id){
		$sql = "
			delete 
			from `items` 
			where 
				`id` = $id and 
				not exists(select * from `galerija` where `parent` = $id ) ;";
		queryDB($sql);
		//echo $sql;
		$sql = "select count(*) as cnt from `items` where `id` = $id";
		$r = queryDB($sql);
		$row = mysql_fetch_array($r);
		return !$row[0];
	}
	
	public function insPicture($p,$img){
			$sql ="
			INSERT INTO `galerija` 
				( `parent`, `seq`, `image`) 			
			select $p,case when max(seq) is null then 1 else max(seq) + 1 end ,'$img'
			from `galerija` 
				where `parent` = $p;";
		//echo $sql;
		queryDB($sql);
		return mysql_insert_id();
	}
	public function getGalItem($id){
		$sql = "select `image` from `galerija` where `id` = $id";
		$r = queryDB($sql);
		$row = mysql_fetch_array($r);
		return $row[0];
	}
	public function updGalItem($id,$path){
		$sql = "update `galerija` set `image` = '$path' where `id` = $id";
		queryDB($sql);
	}
	public function delGalItem($id){
		$sql = "delete from `galerija` where `id` = $id";
		queryDB($sql);
	}
	
}


function editRace($subf,$opt){
	switch($subf){
	case "allanswer":
			printAllAnswer($opt);
			break;	
		case "enduroraceclassdaystage":
			printEditERCDS($opt);
			break;
		case "save_ercds":
			saveERCDS($opt);
			printEditRace($opt);
			break;
		case "delet":
			$em = new EnduroManager;
			$em->delEt($_SESSION['params']['et']);
			printEditRace($opt);
			break;
		case "addendurotask":
			$em = new EnduroManager;
			$em->insET($opt,"");
			printEditRace($opt);
			break;
		case "addenduroday":
			$em = new EnduroManager;
			$em->insERD($opt,"");
			printEditRace($opt);
			break;
		case "delerd":
			$em = new EnduroManager;
			$em->delERD($_SESSION['params']['erd']);
			printEditRace($opt);
			break;
		case "delorg":
			delOrg($_SESSION['params']['org']);
			printEditRace($opt);
			break;
		case "saveorg";
			saveOrg($opt);
			printEditRace($opt);
			break;
		case "addorg":
			printAddorg($opt);
			break;		
		case "racelist":
			$rm= new RaceManager;
			switch($_SESSION["params"]["f2"]){
				case "setgal":
					$rm->setGal($_SESSION["params"]["gal"],$_SESSION["params"]["set"]);
					break;
				default:
			}
			printRace();
			break;
		case "newrace":
			printNewRace();
			break;
		case "saverace":
			$opt = saveRace($opt);			
			printEditRace($opt);
			break;
		case "delrace":
			delRace($opt);
			printRace();
			break;
		case "actrace":
			actRace($opt);
			printRace();
			break;
		case "openrace":
			printEditRace($opt);
			break;
		case "raceclass":
			listRaceClass($opt);
			break;
		case "saveraceclass":
			saveRaceClass($opt);
			printEditRace($opt);
			break;
		case "files":
			showFiles();
			break;
		case "racept":
			listRacePT($opt);
			break;
		case "saveracept":
			saveRacePT($opt);
			printEditRace($opt);
			break;
		case "cplist":	
			printChp($opt);
			break;
		case "newcp":
			printNewChp($opt);
			break;
		case "savecp":
			saveChp($opt);
			printChp($_POST['chprace']);
			break;
		case "opencp":
			printEditChp($opt);
			break;
		case "delcp":
			delChp($opt);
			printChp($_POST['chprace']);
			break;
		case "wpimp":
			printWPimp($opt);
			break;
		case "wpsave":
			WPimp($opt);
			printChp($opt);
			break;
		case "sflist":
			listSF($opt);
			break;
		case "delsf":
			deleteSF($opt);
			listSF($_POST['race']);
			break;
		case "opensf":
			printEditSF($opt);
			break;
		case "savesf":
			saveSF($opt);
			listSF($_POST['race']);
			break;
		case "newsf":
			printNewSF($opt);
			break;
		default;
		
	}
}

function printAllAnswer($opt){
	$rm = new raceManager;
	$rc = new champManager;
	
	$r = $rm->getRace($opt,"","","","","","");
	if(!$r){
		echo "ERROR!";
		break;
	}
	$cl = $rc->getClass("",$r[0]->getType());
	$rcl = $rm->getRClass($opt);
	
		
	echo "<b><a href=\"?rm_func=race&rm_subf=racelist&type=",$r[0]->getType(),"\">",getRaceTypeName($r[0]->getType())," sacensības<a/></b>";
	echo " -> <b><a href=\"index.php?rm_func=race&rm_subf=openrace&opt=$opt\">",$r[0]->getName(),"</a></b>";
	echo " -> Visas atbildes";	
	echo "<br><br>";
	
	$sql = "
		SELECT 
			chp.`name`,
			chp.`cost`,
			tm.`Name`,
			trchp.`answer`
		FROM  
		`e_trchp` trchp
			inner join `d_checkpoint` chp on (trchp.`ChpID` = chp.`CP_ID`)
			inner join `e_teamrace` tr on (tr.`TRID` = trchp.`TRID`)
				inner join `c_team` tm on (tr.`TeamID` = tm.`TeamID`)
		WHERE
			tr.`RaceID` = $opt
		ORDER BY chp.`name`,chp.`cost`,tm.`Name`";
	

	$r = queryDB($sql);
	if ($r){
	echo "<table border=\"1\">";
		echo "<tr>";
			echo "<th>Punkts";
			echo "<th>Komanda";
			echo "<th>Atbilde";
		while($row = mysql_fetch_array($r, MYSQL_NUM)){
			echo "<tr><td>",$row[0],$row[1],"<td>",$row[2],"<td>",$row[3];
			$clubs[$row[option_id]] = $row[lang_value];
		}	
	echo "</table>";
	}
	
	
}

function printEditERCDS($opt){
	$rm = new raceManager;
	$em = new EnduroManager;
	$cmp = new champManager;
	
	$days = $em->getERD($opt);
	$stage = $em->getES($opt);
	$cl = $cmp->getActulaRaceClass($opt);
	
	$r = $rm->getRace($opt,"","","","","","");
	echo "<b><a href=\"?rm_func=race&rm_subf=racelist&type=",$r[0]->getType(),"\">",getRaceTypeName($r[0]->getType())," sacensības<a/></b>";
	echo " -> <b><a href=\"index.php?rm_func=race&rm_subf=openrace&opt=$opt\">",$r[0]->getName(),"</a></b>";
	echo " -> Laika kontroles";	
	echo "<br>";
	
	echo "<form action=\"index.php\" method=\"post\">";
		echo "<a href = \"?rm_func=enduro&rm_subf=addstage&opt=$opt&red_f=race&red_s=enduroraceclassdaystage\">";
			echo "<img src = \"./images/BlueAdd_16x16.png\" alt=\"Jaunā laika kontrole\" title=\"Jaunā laika kontrole\" border = \"0\">";
		echo " </a>";			
		echo "<a href = \"?rm_func=enduro&rm_subf=addstage&opt=$opt&red_f=race&red_s=enduroraceclassdaystage\">";
			echo " <b >Jaunā laika kontrole</b>";
		echo " </a><br>";
		
		echo "<table width=\"100%\" border = \"1\">";
			echo "<tr><td colspan=\"2\">";
			for($i=0;$i<count($cl);$i++){
				echo "<td style=\"font-weight:bold\">",$cl[$i]->getName();
			}
			$items="";
			for($i=0;$i<count($days);$i++){
				echo "<tr>";
					$time = explode(" ",$days[$i]->START_DATE); 
					echo "<td valign=\"middle\" style=\"height:60px;padding:0px;writing-mode: tb-rl;white-space: nowrap;-webkit-transform: rotate(270deg);\">",$time[0];
					echo "<td width=\"100\">";
						echo "<table width = \"100%\">";
							for($j=0;$j<count($stage);$j++){
								echo "<tr>";
									echo "<td>";
										echo " <a onclick=\"confDelGet('Tiešām dzēst?','?rm_func=enduro&opt=$opt&id=",$stage[$j]->ES_ID,"&rm_subf=delstage&red_f=race&red_s=enduroraceclassdaystage')\">";
											echo "<img src=\"./images/RedCross_16x16.png\" border = \"0\" alt=\"Dzēst\" title=\"Dzēst\" 
												onmouseover=\"document.body.style.cursor = 'pointer'\"
												onmouseout = \"document.body.style.cursor = 'default'\"
											>";
										echo "</a>";
									echo "<td width=\"100\" height=\"23px\">LK",$j+1;
							}	
							echo "<tr><td>&nbsp<td> PF";
						echo "</table>";
						for($k=0;$k<count($cl);$k++){
							echo "<td>";
								echo "<table>";
									for($m=0;$m<count($stage);$m++){
										echo "<tr>";
											$rcd = $em->getERCD("",$days[$i]->ERD_ID,$cl[$k]->getId());
											//print_r($rcd);
											$item= $em->getRCDS("",$cl[$k]->getId(),$stage[$m]->ES_ID,$rcd[0]->ERCD_ID);
											//print_r($item);
											
											echo "<td height=\"23px\"><input type=\"text\" maxlength=\"5\" size=\"5\" name=\"",$days[$i]->ERD_ID,"x",$cl[$k]->getId(),"x",$stage[$m]->ES_ID,"x",$item ? $item[0]->RCDS_ID:"-1","\"value=\"",$item[0]->OFFSET_TIME ? substr($item[0]->OFFSET_TIME,0,5):"00:00","\">";
											$items = $items.";".($days[$i]->ERD_ID . "x".$cl[$k]->getId()."x".$stage[$m]->ES_ID ."x".($item ? $item[0]->RCDS_ID : "-1"));
									}
									echo "<tr>";
										$ercd= $em->getERCD("",$days[$i]->ERD_ID,$cl[$k]->getId());									
										echo "<td height=\"23px\"><input type=\"text\" size=\"5\" name=\"",$days[$i]->ERD_ID,"x",$cl[$k]->getId(),"x-1xfin\" value=\"",($ercd? substr ($ercd[0]->FIN_OFFSET,0,5) :  "00:00"),"\">";
										$items = $items.";".($days[$i]->ERD_ID."x".$cl[$k]->getId()."x-1xfin");
								echo "</table>";
						}
			};
		echo "</table>";
		
		echo "<input type=\"hidden\" name=\"items\" value=\"$items\">";
		echo "<input type=\"hidden\" name=\"opt\" value=\"$opt\">";
		echo "<input type=\"hidden\" name=\"rm_func\" value=\"race\">";
		echo "<input type=\"hidden\" name=\"rm_subf\" value=\"save_ercds\">";
		echo "<center><input type = \"submit\" value=\"Saglabāt\"></center>";
	echo "</form>";
}

function saveERCDS($opt){
	$em = new EnduroManager;
	//echo $_SESSION['params']['items'];
	//print_r($_SESSION['params']);
	$items = explode(";",$_SESSION['params']['items']);
	for ($i=0;$i<count($items);$i++){
		if($items[$i]){
			$val =  $_SESSION['params'][$items[$i]];
			$params = explode("x",$items[$i]);
			$ercd= $em->getERCD("",$params[0],$params[1]);	
			
			switch($params[3]){
				case -1:
					$em->insRCDS($params[2],$ercd[0]->ERCD_ID,$val);
					break;
				case "fin":									
					$em->saveERCD($ercd[0]->ERCD_ID,$ercd[0]->ENDURO_LAPS,$val);
					break;					
				default:					
					$em->saveRCDS($params[3],$val);
			}
		}		
	}

}

function delOrg($opt){
	$rm= new raceManager;
	$rm->delRaceCrew($opt);
}


function saveOrg($opt){
	$rm= new raceManager;
	$rm->saveRaceCrew($opt,$_SESSION['params']['perm'],$_SESSION['params']['org']);
}

function printAddorg($opt){
	$sec = new Security;
	$usr = $sec->getFreeRaceCrew($opt,$_SESSION['params']['perm']);
	echo "<h1>";
	if ($_SESSION['params']['perm']==7){
		echo "Organizatora ";
	} elseif($_SESSION['params']['perm']==8){
		echo "Tiesneša ";
	}
	
	echo "izvēle</h1>";
	echo "<table border =\"1\" width=\"100%\">";
		echo "<tr class=\"title\"><td>&nbsp<td>Lietotājs";
		for($i=0;$i<count($usr);$i++){
			echo "<tr>";
				echo "<td width=\"100\" align=\"center\">";
					echo "<form action=\"index.php\" enctype=\"multipart/form-data\" method=\"post\">";
						echo "<input type=\"hidden\" name = \"type\" value=\"",$_SESSION['params']['type'],"\" >";			
						echo "<input type=\"hidden\" name = \"rm_func\" value=\"race\"> ";
						echo "<input type=\"hidden\" name = \"rm_subf\" value=\"saveorg\"> ";
						echo "<input type=\"hidden\" name = \"perm\" value=\"",$_SESSION['params']['perm'],"\"> ";
						echo "<input type=\"hidden\" name = \"org\" value=\"",$usr[$i]->getID(),"\"> ";
						echo "<input type=\"hidden\" name = \"opt\" value=\"$opt\">";
						echo "<input type=\"submit\" value=\"Pievienot\">";
					echo "</form>";
				echo "<td>";
					echo $usr[$i]->getLogin();
		}
	echo "</table>";
	
	
	
}

function printEditSF($opt){
	$rm = new raceManager;
	$cm = new champManager;
	$classl = $cm->getActulaRaceClass($_POST['race']);
	echo "<form action=\"index.php\" method=\"post\">";
		echo "<input type=\"hidden\" name = \"rm_func\" value=\"race\"> ";
		echo "<table width =\"100%\" border = \"1\">";
	
		if (isset($opt)){
			$list = $rm->getSF($opt,"");
			if ($list){			
				
				echo "<tr ><td class=\"title\" width=\"100\">Nosaukums<td><input type=\"text\" name = \"name\" value=\"".$list[0]->getName()."\">";
				echo "<tr ><td class=\"title\">Starts<td><input type=\"text\" name = \"st\" value=\"".$list[0]->getStart()."\">";
				echo "<tr ><td class=\"title\">Finišs<td><input type=\"text\" name = \"fin\" value=\"".$list[0]->getFin()."\">";
			}
		}
		echo "</table> <hr>";
		echo "<table  border =\"0\" width=\"100%\"><tr>";
			
			$j=0;
			while(isset($classl[$j])){
				echo "<td>",$classl[$j]->getName(),": ";
				
				echo "<input type=\"checkbox\" name=\"cb",$classl[$j]->getId(),"\"";
				if ($list[0]->hasDet($classl[$j]->getId())){echo " checked ";}
				echo " value = \"chb\">";
				
				$j++;
			}
			
		echo "</table> ";		
		
		echo "<input type=\"hidden\" name = \"opt\" value=\"".$list[0]->getID()."\">";
		echo "<input type=\"hidden\" name = \"rm_subf\" value=\"savesf\">";
		echo "<input type=\"hidden\" name = \"race\" value=\"",$_POST['race'],"\">";
		echo "<hr><center><input type=\"submit\" value=\"Saglabāt\" ></center>";
	echo "</form>";
}

function saveSF($opt){
	$rm = new raceManager;
	//print_r($_POST);
		if (isset($opt)){
			$rm->saveSF($opt,$_POST["race"],$_POST["name"],$_POST["st"],$_POST["fin"]);
			$rm->delstfdet($opt);
			$keys = array_keys($_SESSION['params'],"chb");
			for($i=0;$i<count($keys);$i++){
				$rm->insStfDet($opt,str_replace("cb","",$keys[$i]));
			}		
		}else {
			$rm->insSF($_POST["race"],$_POST["name"],$_POST["st"],$_POST["fin"]);
		}	
	
	
}

function printNewSF($opt){
	$cm = new champManager;
	$classl = $cm->getActulaRaceClass($opt);
	
	echo "<form  action=\"index.php\" method=\"post\">";
		echo "<input type=\"hidden\" name = \"rm_func\" value=\"race\"> ";
		echo "<table width =\"100%\" border = \"1\">";
	
		
		echo "<tr><td class=\"newtitle\" width=\"100\">Nosaukums:<td><input type=\"text\" name = \"name\" >";
		echo "<tr><td class=\"newtitle\">Starts:<td><input type=\"text\" name = \"st\" value=\"0000-00-00 00:00:00\">";
		echo "<tr><td class=\"newtitle\">Finišs:<td><input type=\"text\" name = \"fin\" value=\"0000-00-00 00:00:00\">";
		
		echo "</table> ";
			
		echo "<input type=\"hidden\" name = \"rm_subf\" value=\"savesf\">";
		echo "<input type=\"hidden\" name = \"race\" value=\"$opt\">";
		echo "<hr><center><input type=\"submit\" value=\"Saglabāt\" ></center>";
	echo "</form>";
		
}

function deleteSF($opt){
	$rm= new raceManager;
	$rm->delSF($opt);
}

function listSF($opt){
	$rm = new raceManager;
	$list = $rm->getSF("",$opt);
	$i =0;
	
	
	echo "<form action=\"index.php\" method=\"post\">";
		echo "<input type=\"hidden\" name = \"rm_func\" value=\"race\"> ";
		echo "<input type=\"hidden\" name = \"rm_subf\" value=\"newsf\"> ";
		echo "<center><input type=\"submit\" value=\"Jauns\"> </center>";
		echo "<input type=\"hidden\" value=\"$opt\" name = \"opt\">";
	echo "</form><hr>";
	
	echo "<table width =\"100%\" border = \"1\">";
	echo "<tr class=\"title\"><td width=\"20\">&nbsp<td>Nosaukums<td>Starts<td>Finišs";
	while (isset($list[$i]) ){
	
		echo "<tr><td width=\"70\"><table border=\"0\"><tr><td>";
		
		echo "<form action=\"index.php\" method=\"post\">";
				echo "<input type=\"hidden\" name = \"rm_func\" value=\"race\"> ";
				echo "<center><input type=\"submit\" value=\"Atvērt\" >";		
				echo "<input type=\"hidden\" value=\"opensf\" name = \"rm_subf\">";
				echo "<input type=\"hidden\" value=\"$opt\" name = \"race\">";
				echo "<input type=\"hidden\" value=\"".$list[$i]->getId()."\" name = \"opt\">";				
		echo "</form>";
		
		
		echo "<input type=\"button\" value=\"Dzēst\" onclick=\"confDel('form".$list[$i]->getId()."','Tiešām dzēst?')\">";
			echo "<td><form action=\"index.php\" method=\"post\" id=\"form".$list[$i]->getId()."\">";
				echo "<input type=\"hidden\" name = \"rm_func\" value=\"race\"> ";
				echo "<input type=\"hidden\" value=\"delsf\" name = \"rm_subf\">";
				echo "<input type=\"hidden\" value=\"".$list[$i]->getId()."\" name = \"opt\">";
				echo "<input type=\"hidden\" value=\"$opt\" name = \"race\">";
			echo "</form></table>";
		
		echo "<td>". $list[$i]->getName();
		echo "<td>". $list[$i]->getStart();
		echo "<td>". $list[$i]->getFin();
		$i++;
	}
	echo "</table>";
	
	echo "<form action=\"index.php\" method=\"post\">";
		echo "<input type=\"hidden\" name = \"rm_func\" value=\"race\"> ";
		echo "<input type=\"hidden\" name = \"rm_subf\" value=\"newsf\"> ";
		echo "<center><input type=\"submit\" value=\"Jauns\"> </center>";
		echo "<input type=\"hidden\" value=\"$opt\" name = \"opt\">";
	echo "</form><hr>";
}

function WPimp($opt){
	
	$handle = fopen($_FILES["WP"]['tmp_name'], "r");
	
	
	$wp=array();
	while (!feof($handle)) {
	
		$buffer = fgets($handle,4096);
	
		array_push($wp,$buffer);
	}
	fclose($handle);

	//print_r($wp);
	$rm = new raceManager;
	$list = $rm->getChPoint("",$opt,"","");
	


	for($i=4;$i<sizeof($wp);$i++){	
		$str = explode(",",$wp[$i]);
		if ( checkWP($str[1],$list)){		
			$rm->insChPoint($opt,"","","","",0,"",$str[10],$wp[$i],$str[2],$str[3],0,0,65535,'');
		}
	}
	
}

function checkWP($wp, $arr){
 

 $size =sizeof($arr);
  //echo "====== $size =======<br>";
	for($i=0;$i<$size;$i++){
		
		if(strtoupper($wp) == strtoupper($arr[$i]->getWPName())){
			//echo $wp," - " ,$arr[$i]->getWPName()," - $i<br>";
			return false;
		}
	}
	return true;
 }
 
function printWPimp($opt){
	echo "<form enctype=\"multipart/form-data\" action=\"index.php\" method=\"post\">";
	echo "<input type=\"hidden\" name = \"rm_func\" value=\"race\"> ";
	echo "<input type=\"hidden\" name = \"rm_subf\" value=\"wpsave\"> ";
	echo "<input type=\"hidden\" name = \"opt\" value=\"$opt\"> ";
			
	echo "Waypoint fails: <input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"1000000000\" /><input type=\"file\" name = \"WP\" >";
			
	
	echo "<hr><center><input type=\"submit\" value=\"Importēt\" </center>";
	echo "</form>";
}

function printEditChp($opt){
	$rm = new raceManager;
	$cm = new champManager;
	
	echo "<form action=\"index.php\" enctype=\"multipart/form-data\" method=\"post\">  ";
	
	
	
	if (isset($opt)){
		$list = $rm->getChPoint($opt,"","","");
		echo "<center><h1><font color=\"blue\">",strtoupper($list[0]->getName()),$list[0]->getCost(), " - ",$list[0]->getWPName(),"</font></h1></cenetr>";
		if (isset($list[0])){
			echo "<input type=\"hidden\" name = \"opt\" value=\"".$list[0]->getID()."\">";
			echo "<input type=\"hidden\" name = \"chprace\" value=\"".$list[0]->getRaceId()."\">";
			echo "<table width =\"100%\" border = \"1\">";
				echo "<tr valign=\"top\">";
					echo "<td>Nosaukums:<br><input type=\"text\" name = \"name\"  value=\"".$list[0]->getName()."\">";
					echo "<td>Vertība: <br><input type=\"text\" name = \"cost\"  value=\"".$list[0]->getCost()."\">";
					echo "<td>Apraksts: <br><textarea cols=\"30\" rows=\"4\" name = \"descr\" >",$list[0]->getDescr(),"</textarea>";
					echo "<td>Jautājums: <br><textarea cols=\"30\" rows=\"4\" name = \"quest\"  >",$list[0]->getQuest(),"</textarea>";
	
				echo "<tr valign=\"top\">";
					echo "<td>Atbilde: <br><textarea cols=\"30\" rows=\"4\" name = \"answ\">",$list[0]->getAnsw(),"</textarea>";
					echo "<td>Koordinātes:";
						
						echo "<br><input type=\"text\" name = \"v1\" size=\"3\" value=\"".$list[0]->getVch()."\"><sup>o</sup> <input type=\"text\" name = \"v2\" size=\"3\" value=\"".$list[0]->getVcm()."\">.<input type=\"text\" name = \"v3\" size=\"3\" value=\"".$list[0]->getVcmp()."\">' ";
						echo "<select name = \"v4\" ><option value=\"N\" "; if($list[0]->getVcoffset()=="N"){echo " selected ";}echo ">N</option><option value=\"S\" "; if($list[0]->getVcoffset()=="S"){echo " selected ";}echo ">S</option></select>";		
						
						echo "<br><input type=\"text\" name = \"h1\" size=\"3\" value=\"".$list[0]->getHch()."\"><sup>o</sup> <input type=\"text\" name = \"h2\" size=\"3\" value=\"".$list[0]->getHcm()."\">.<input type=\"text\" name = \"h3\" size=\"3\" value=\"".$list[0]->getHcmp()."\">' ";
						echo "<select name = \"h4\" ><option value=\"E\" "; if($list[0]->getHcoffset()=="E"){echo " selected ";}echo ">E</option><option value=\"W\" "; if($list[0]->getHcoffset()=="W"){echo " selected ";} echo " >W</option></select>";
						
						echo "<br>GPS punkts<input type=\"checkbox\" name = \"ctd\" ";if($list[0]->getCtD()){echo " checked ";}echo ">";
					echo "<td>Piezīmes:<br> <textarea cols=\"30\" rows=\"4\" name = \"notes\">",$list[0]->getNotes(),"</textarea>";			
					
					echo "<td>Bilde:<br>";
						if ($list[0]->getImage()){
							echo "<a href =\"".$list[0]->getImage()."\" target=\"_blank\" class=\"img\"><img  border = \"0\" src = \"". $list[0]->getImage()."\" height=\"100\"> </a>";
						}
					echo "<br><input type=\"file\" name = \"image\" >";
				echo "<tr valign=\"top\">";
					echo "<td>Labelīša orientācija:<br>";
						echo "<select name=\"labDir\">";
							echo "<option value=\"0\" ",($list[0]->getLabDir() == 0 ? " selected ": ""),">Uz augsu</option>";
							echo "<option value=\"1\" ",($list[0]->getLabDir() == 1 ? " selected ": ""),">Uz leju</option>";
							echo "<option value=\"2\" ",($list[0]->getLabDir() == 2 ? " selected ": ""),">Pa labi</option>";
							echo "<option value=\"3\" ",($list[0]->getLabDir() == 3 ? " selected ": ""),">Pa kreisi</option>";
						echo "</select>";
					echo "<td>Labelīša krāsa:<br>";
						echo "<select name =\"labbgcol\">";
							echo "<option value = \"255\" style=\"background:#",dechex(16711680),"\" ",($list[0]->getLabBgColor() == 255 ? " selected ": ""),">Sarkans</option>";							
							echo "<option value = \"16711680\" style=\"background:#",dechex(2003199),"\" ",($list[0]->getLabBgColor() == 16711680 ? " selected ": ""),">Zils</option>";
							echo "<option value = \"65535\" style=\"background:#",dechex(16766720),"\" ",($list[0]->getLabBgColor() == 65535 ? " selected ": ""),">Dzeltens</option>";
							echo "<option value = \"12632256\" style=\"background:#",dechex(13882323),"\" ",($list[0]->getLabBgColor() == 12632256 ? " selected ": ""),">Sudraba</option>";
							echo "<option value = \"0\" style=\"background:black\" ",($list[0]->getLabBgColor() == 0 ? " selected ": ""),">Melns</option>";
							echo "<option value = \"16776960\" style=\"background:Cyan\" ",($list[0]->getLabBgColor() == 16776960 ? " selected ": ""),">Gaiši zils</option>";
							echo "<option value = \"65280\" style=\"background:#",dechex(11403055),"\" ",($list[0]->getLabBgColor() == 65280 ? " selected ": ""),">Lime</option>";
							echo "<option value = \"4227327\" style=\"background:#",dechex(16747520),"\" ",($list[0]->getLabBgColor() == 4227327 ? " selected ": ""),">Orandžs</option>";
							echo "<option value = \"16777215\" style=\"background:white\" ",($list[0]->getLabBgColor() == 16777215 ? " selected ": ""),">Blats</option>";
						echo "<\select>";
			echo "<tr><td colspan=\"4\"><table  border =\"0\"><tr>";
			
			$classl = $cm->getActulaRaceClass($list[0]->getRaceId());
			$j=0;
			while(isset($classl[$j])){
				echo "<td>",$classl[$j]->getName(),": ";
				printDiffMenu($classl[$j]->getId(),$list[0]->getId());
				
				$j++;
			}
			
			echo "</table> ";		
	echo "</table><hr>";
		}
	}			
	
	echo "<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"1000000000\" />";
	echo "<input type=\"hidden\" name = \"rm_func\" value=\"race\">";
	echo "<input type=\"hidden\" name = \"rm_subf\" value=\"savecp\">";	
	echo "<center><input type=\"submit\" value=\"Saglabāt\"></center>";
	echo "</form>";
}

function printSelcted($v1,$v2){
	if($v1==$v2){return " selected ";}
	return "";
}

function printDiffMenu($id1,$id2){
	$rm = new raceManager;
	$cm = new champManager;
	$item = $rm->getChpDet("",$id1,$id2);
	$sel=-1;
	if ($item){$sel=$item[0]->getDiff();}
	$dif = $cm->getRacePTask($_POST['chprace']);
	
	echo "<select name=\"sel$id1"."x$id2\">";
	$i =0;
		echo "<option value=\"-1\" style=\"color:red; font-style:italic\" ".printSelcted(-1,$sel).">Nav</option>";
		while (isset($dif[$i])){
			echo "<option value=\"",$dif[$i]->getId(),"\" style=\"color:green; font-style:italic\" ".printSelcted($dif[$i]->getId(),$sel).">",$dif[$i]->getName(),"</option>";	
			$i++;
		}		
	echo "</select>";
}

function delChp($opt){
	$rm = new raceManager;
	if ($opt){
		$list = $rm->getChPoint($opt,"","","");
		
		if (file_exists($list[0]->getImage())){
			@unlink ($list[0]->getImage());
		}		
		$rm->delChPoint($opt);
		
		$name = $rm->getGalItem($list[0]->galid);					
		$path_parts = pathinfo($name);
		$name1 = $path_parts["dirname"]."/.cache/".str_replace(".".$path_parts["extension"],"",$path_parts["basename"])."-170.".$path_parts["extension"]; 
		
		@unlink("../".$name);
		@unlink("../".$name1);
		
		$rm->delGalItem($list[0]->galid);
	}			
}

function saveChp($opt){

	$rm = new raceManager;
	
	
		$ctd=0;
		if (isset($_POST["ctd"])){$ctd=1;}
		$lat=$_POST["v1"]+(($_POST["v2"].".".$_POST["v3"])/60);
		if ($_POST["v4"]=="S"){$lat*= -1;}
		$long=$_POST["h1"]+(($_POST["h2"].".".$_POST["h3"])/60);
		if ($_POST["h4"]=="W"){$long*= -1;}
		
		
		if ($opt){
		
			if ($_POST["name"]){
			
				$item = $rm->getChPoint("",$_POST['chprace'],$_POST["name"],$_POST["cost"]);
				
				if ($item and ($item[0]->getId() <> $opt) and ($_POST["name"] != "SU")){
					echo "<center><b style=\"color:red;font-size:20pt;\">Tāds kontrolpunkts jau eksistē! </b></center>";
					return;
				}	
			}		
			
			$cp = $rm->getChPoint($opt,"","","");
			$gid = $cp[0]->galid;
			if (!$_FILES["image"]['tmp_name']){
				if ($cp){
					$_POST["image"] = $cp[0]->getImage();				
				}
			} else {
				$date= getdate();
				$race = $rm->getRace($cp[0]->getRaceId(),"","","","","","");
				
				if(!file_exists("Files/RACE/".$race[0]->getCode()."/KKP/")){
					mkdir("Files/RACE/".$race[0]->getCode()."/KKP/");
				}
				$path = "Files/RACE/".$race[0]->getCode()."/KKP/". date("Y-m-d_H-i-s_").$cp[0]->getWPName().".jpg";
				imgesize($_FILES["image"]['tmp_name'],$path,800);
				
				if($gid){
					$name = $rm->getGalItem($gid);					
					$path_parts = pathinfo($name);
					$name1 = $path_parts["dirname"]."/.cache/".str_replace(".".$path_parts["extension"],"",$path_parts["basename"])."-170.".$path_parts["extension"]; 
					
					@unlink("../".$name1);
					
					imgesize($_FILES["image"]['tmp_name'],"../".$name,800);					
				} else {
					$name=GAL_ROOT_PATH.$race[0]->ogalid."/".date("Y-m-d_H-i-s_").$cp[0]->getWPName().".jpg";
					$path_parts = pathinfo($name);					
					
					imgesize($_FILES["image"]['tmp_name'],$name,800);									
					
					$gid = $rm->insPicture($race[0]->ogalid,str_replace("../","",$name));
				}
				
				if ($cp){
					@unlink($cp[0]->getImage());				
				}				
				$_POST["image"] = $path;				
			}
			
			
			
			$rm->saveChPoint($opt,$_POST['chprace'],$_POST["name"],$_POST["descr"],$_POST["quest"],$_POST["answ"],$_POST["cost"],$_POST["image"],$_POST["notes"],$lat,$long,$ctd,$_POST["labDir"],$_POST["labbgcol"],$gid);
			
			$rm->delChpDet1($opt);
			
			$cm = new champManager;
			$classl = $cm->getActulaRaceClass($_POST['chprace']);
			
			for($i = 0;$i < count($classl);$i++){
				if (isset($_SESSION['params']["sel".$classl[$i]->getId()."x".$opt])){
					if ($_SESSION['params']["sel".$classl[$i]->getId()."x".$opt] <> -1){
						$rm->insChpDet($classl[$i]->getId(),$opt,$_SESSION['params']["sel".$classl[$i]->getId()."x".$opt]);
					}
				}
			}
			
		}else {
			
			
				if ($_POST["name"]==""){
					echo "<center><b style=\"color:red;font-size:20pt;\">Kontrolpunkta nosaukums ir obligāts!</b></center>";
					return;
				}
				
				$item = $rm->getChPoint("",$_POST['chprace'],$_POST["name"],$_POST["cost"]);
				if ($item and (!$opt or ($item[0]->getId() <> $opt))){
					echo "<center><b style=\"color:red;font-size:20pt;\">Tāds kontrolpunkts jau eksistē!</b></center>";
					return;
				}
				
				
				$race = $rm->getRace($_POST['chprace'],"","","","","","");
				$gid = null;
				if ($_FILES["image"]['name']){				
					if(!file_exists("Files/RACE/".$race[0]->getCode()."/KKP/")){
						mkdir("Files/RACE/".$race[0]->getCode()."/KKP/");
					}
					
					$path = "Files/RACE/".$race[0]->getCode()."/KKP/".date("Y-m-d_H-i-s_").$_POST["name"].$_POST["cost"].".jpg";
					
					imgesize($_FILES["image"]['tmp_name'],$path,800);
					
					
					$name=GAL_ROOT_PATH.$race[0]->ogalid."/".date("Y-m-d_H-i-s_").$_POST["name"].$_POST["cost"].".jpg";
					$path_parts = pathinfo($name);					
					
					imgesize($_FILES["image"]['tmp_name'],$name,800);									
					
					$gid = $rm->insPicture($race[0]->ogalid,str_replace("../","",$name));
				}
				
				$rm->insChPoint($_POST['chprace'],$_POST["name"],$_POST["descr"],$_POST["quest"],$_POST["answ"],$_POST["cost"],$path,$_POST["notes"],"",$lat,$long,$ctd,$_POST["labDir"],$_POST["labbgcol"],$gid);	
							
		}		
	
}

function printNewChp($opt){
	echo "<form enctype=\"multipart/form-data\" action=\"index.php\" method=\"post\">";
	echo "<table width =\"100%\" border = \"1\">";
	
		
		echo "<tr><td width =\"100\">Nosaukums:<td><input type=\"text\" name = \"name\" >";
		echo "<tr><td>Vertība: <td><input type=\"text\" name = \"cost\" >";
		echo "<tr><td>Apraksts: <td><textarea cols=\"30\" rows=\"4\" name = \"descr\" ></textarea>";
		echo "<tr><td>Jautājums: <td><textarea cols=\"30\" rows=\"4\" name = \"quest\" ></textarea>";
		 
		echo "<tr >";
		echo "<td>Atbilde: <td><textarea cols=\"30\" rows=\"4\" name = \"answ\" ></textarea>";
		
		echo "<tr><td>Koordinātes: ";
			echo "<td><input type=\"text\" name = \"v1\" size=\"3\" value=\"0\"><sup>o</sup> <input type=\"text\" name = \"v2\" size=\"3\" value=\"0\">.<input type=\"text\" name = \"v3\" size=\"3\" value=\"0\">'";
			echo "<select name = \"v4\" ><option value=\"N\">N</option><option value=\"S\">S</option></select>";		
			echo "<br><input type=\"text\" name = \"h1\" size=\"3\"  value=\"0\"><sup>o</sup> <input type=\"text\" name = \"h2\" size=\"3\" value=\"0\">.<input type=\"text\" name = \"h3\" size=\"3\" value=\"0\">' ";
			echo "<select name = \"h4\" ><option value=\"E\">E</option><option value=\"W\">W</option></select>";			
			echo "<br>GPS punkts<input type=\"checkbox\" name = \"ctd\" >";
		echo "<tr><td>Piezīmes: <td><textarea cols=\"30\" rows=\"4\" name = \"notes\" ></textarea>";	
		echo "<tr><td>Labelīša orientācija: <td>";	
			echo "<select name=\"labDir\">";
				echo "<option value=\"0\" >Uz augsu</option>";
				echo "<option value=\"1\" >Uz leju</option>";
				echo "<option value=\"2\" >Pa labi</option>";
				echo "<option value=\"3\" >Pa kreisi</option>";
			echo "</select>";
		echo "<tr><td>Labelīša krāsa: ";	
			echo "<td><select name =\"labbgcol\">";
				echo "<option value = \"255\" style=\"background:#",dechex(16711680),"\" >Sarkans</option>";				
				echo "<option value = \"16711680\" style=\"background:#",dechex(2003199),"\" >Zils</option>";
				echo "<option value = \"65535\" style=\"background:#",dechex(16766720),"\" >Dzeltens</option>";
				echo "<option value = \"12632256\" style=\"background:#",dechex(13882323),"\" >Sudraba</option>";
				echo "<option value = \"0\" style=\"background:black\" >Melns</option>";
				echo "<option value = \"16776960\" style=\"background:Cyan\" >Aqua</option>";
				echo "<option value = \"65280\" style=\"background:#",dechex(11403055),"\" >Lime</option>";
				echo "<option value = \"4227327\" style=\"background:#",dechex(16747520),"\" >Orandžs</option>";
				echo "<option value = \"16777215\" style=\"background:white\" >Balts</option>";
			echo "<\select>";
		echo "<tr><input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"1000000000\" /><td>Bilde:<td><input type=\"file\" name = \"image\" >";
			
	echo "</table> ";
	echo "<hr><center><input type=\"submit\" value=\"Saglabāt\"</center>";
	echo "<input type=\"hidden\" name = \"rm_func\" value=\"race\">";
	echo "<input type=\"hidden\" name = \"chprace\" value=\"$opt\">";
	echo "<input type=\"hidden\" name = \"rm_subf\" value=\"savecp\">";	
	echo "</form>";
}

function printChp($opt){
	$rm = new raceManager;
	$cm = new champManager;
	$list = $rm->getChPoint("",$opt,"","");
	$i =0;
	
	$r = $rm->getRace($opt,"","","","","","");
	echo "Gonkas administrēšana -> <b><a href=\"index.php?rm_func=race&rm_subf=openrace&opt=$opt\">",$r[0]->getName(),"</a></b><hr>";
	
	
	echo "<form action=\"index.php\" method=\"post\">";
	echo "<input type=\"hidden\" name = \"rm_func\" value=\"race\"> ";
	echo "<input type=\"hidden\" name = \"rm_subf\" value=\"newcp\"> ";
	echo "<input type=\"hidden\" name = \"opt\" value=\"$opt\"> ";
	echo "<center><input type=\"submit\" value=\"Jauns\" </center>";
	echo "</form>";
	
	echo "<hr><table width =\"100%\" border = \"1\">";
	echo "<tr class=\"title\"><td width=\"20\">&nbsp<td >Nosaukums<td>Apraksts<td>Jautājums<td>Atbilde<td>Koordinātes<td>Piezīmes<td width = \"100\">Bilde<td width=\"150\">Saistibas";
	$classl = $cm->getActulaRaceClass($opt);
	
	while (isset($list[$i]) ){
		echo "<form action=\"index.php\" method=\"post\"> <input type=\"hidden\" name = \"rm_func\" value=\"cp\"> ";
		echo "<tr>";
		
		echo "<td width=\"70\" valign=\"top\" align=\"middle\"><table border=\"0\"><tr><td >";
		
		echo "<form action=\"index.php\" method=\"post\">";
			echo "<input type=\"hidden\" name = \"rm_func\" value=\"race\"> ";
			echo "<center><input type=\"submit\" value=\"Atvērt\" >";		
			echo "<input type=\"hidden\" value=\"opencp\" name = \"rm_subf\">";
			echo "<input type=\"hidden\" name = \"chprace\" value=\"$opt\">";
			echo "<input type=\"hidden\" value=\"".$list[$i]->getId()."\" name = \"opt\">";				
		echo "</form>";
		
		
		echo "<input type=\"button\" value=\"Dzēst\" onclick=\"confDel('form".$list[$i]->getId()."','Tiešām dzēst?')\">";
		echo "<td><form action=\"index.php\" method=\"post\" id=\"form".$list[$i]->getId()."\">";
			echo "<input type=\"hidden\" name = \"rm_func\" value=\"race\"> ";
			echo "<input type=\"hidden\" value=\"delcp\" name = \"rm_subf\">";
			echo "<input type=\"hidden\" name = \"chprace\" value=\"$opt\">";
			echo "<input type=\"hidden\" value=\"".$list[$i]->getId()."\" name = \"opt\">";
			
		echo "</form></table>";
		
		echo "<table border=\"0\">";
			echo "<tr>";
				
				echo "<td style=\"background:";
				
				switch($list[$i]->getLabBgColor()){
					case 65535:
						echo "yellow";
						break;
					case 255:
						echo "red";
						break;
					case 4227327:
						echo "orange";
						break;
					case 16711680:
						echo "blue";
						break;
					case 65280:
						echo "lime";
						break;
					case 12632256:
						echo "gray";
						break;
					case 16776960:
						echo "cyan";
						break;
					case 0:
						echo "black";
						break;
					case 16777215:
						echo "white";
						break;					
				}
				
				
				
				echo "\" width = \"20\">&nbsp";
				
				echo "<td width = \"20\"><b style=\"font-size:16px\">";
				switch($list[$i]->getLabDir()){
					case 0:
						echo "&uArr;";
						break;
					case 1:
						echo "&dArr;";
						break;
					case 2:
						echo "&rArr;";
						break;
					case 3:
						echo "&lArr;";
						break;
				}
				echo "</b>";
			echo "</table>";
		
		
		$name ="";
		if ($list[$i]->getName()<>"" ){
			$name = $list[$i]->getName();
			if(strtoupper(substr($list[$i]->getName(),0,2))=="SU"){$name = $name." - ";}
			$name = $name.$list[$i]->getCost();
		} elseif ($name.$list[$i]->getCost() > 0) {
			$name ="_";
			$name = $name.$list[$i]->getCost();
		}
		echo "<td><center><h1><font color=\"blue\">", $name,"</font></h1>";
		if($list[$i]->getWPName()<>""){echo "(",$list[$i]->getWPName(),")";} 
		echo "</center>";
		echo "<td>". $list[$i]->getDescr();
		if ($list[$i]->getCtD()){
			echo "<br>",  $list[$i]->getVch(),"<sup>o</sup> ",$list[$i]->getVcm(),".",$list[$i]->getVcmp(),"' ",$list[$i]->getVcoffset(),"<br>",$list[$i]->getHch(),"<sup>o</sup> ",$list[$i]->getHcm(),".",$list[$i]->getHcmp(),"' ",$list[$i]->getHcoffset();
		}
		echo "<td>". $list[$i]->getQuest();
		echo "<td>". $list[$i]->getAnsw();
		echo "<td>", $list[$i]->getVch(),"<sup>o</sup> ",$list[$i]->getVcm(),".",$list[$i]->getVcmp(),"' ",$list[$i]->getVcoffset(),"<br>",$list[$i]->getHch(),"<sup>o</sup> ",$list[$i]->getHcm(),".",$list[$i]->getHcmp(),"' ",$list[$i]->getHcoffset();
		echo "<td>". $list[$i]->getNotes();
		echo "<td width=\"100 px\"><a href =\"".$list[$i]->getImage()."\" target=\"_blank\" class=\"img\"><img  border = \"0\" src = \"". $list[$i]->getImage()."\" height=\"100\"> </a>";
		echo "<td><table width =\"100%\" border=\"0\">";
		
		$j =0;
		while (isset($classl[$j]) ){
			echo "<tr><td>",$classl[$j]->getName();
			$item = $rm->getChpdet("",$classl[$j]->getId(),$list[$i]->getId());
			if ($item){
				$dif=$cm->getPTask($item[0]->getDiff());
				if($dif){
					echo "<td>- <font color=\"green\"><b>",$dif[0]->getName(),"</b></font>";
				}
			} else {
				echo "<td>- <font color=\"red\">nav</font>";
			}
			
			$j++;
		}
		
		$i++;
		echo "</table>";
		echo "</form>";
	}
	echo "</table>";
	echo "<form action=\"index.php\" method=\"post\">";
	echo "<input type=\"hidden\" name = \"rm_func\" value=\"race\"> ";
	echo "<input type=\"hidden\" name = \"rm_subf\" value=\"newcp\"> ";
	echo "<input type=\"hidden\" name = \"opt\" value=\"$opt\"> ";
	echo "<hr><center><input type=\"submit\" value=\"Jauns\" </center>";
	echo "</form>";
	
	echo "<hr>Gonkas administrēšana -> <b><a href=\"index.php?rm_func=race&rm_subf=openrace&opt=$opt\">",$r[0]->getName(),"</a></b><br>";
	

}

function saveRacePT($opt){
	$rc = new raceManager;
	$rc->delRPTask($opt);
	
	$keys = array_keys($_SESSION['params'],"class");
	for($i=0;$i<count($keys);$i++){
		$rc->insRPTask($opt,str_replace("class","",$keys[$i]));
	}
}

function listRacePT($opt){
	$rm = new raceManager;
	$rc = new champManager;
	
	$cl = $rc->getPTask("");
	$rcl = $rm->getRPTask($opt);
	$r = $rm->getRace($opt,"","","","","","");
	echo "Gonkas administrēšana -> <b><a href=\"index.php?rm_func=race&rm_subf=openrace&opt=$opt\">",$r[0]->getName(),"</a></b><br>";
	
	echo "<form action=\"index.php\" method=\"post\">";
	echo "<table width =\"100%\" border = \"1\">";
	echo "<tr class=\"title\"><td width=\"20\">&nbsp<td>Nosaukums";
	for($i=0;$i<count($cl);$i++){
		echo "<tr><td width=\"70\">";		
		echo "<input type=\"checkbox\" name =\"class".$cl[$i]->getID()."\" value=\"class\"";
		for($j=0;$j<count($rcl);$j++){
			if($rcl[$j]->getPTID() == $cl[$i]->getID()){
				echo " checked ";
				
			}
		}
		echo ">";
		echo "<td>". $cl[$i]->getName();		
	}
	echo "</table>";
	echo "<center><input type=\"submit\" value=\"Saglabāt\"></center>";
	echo "<input type=\"hidden\" name = \"rm_func\" value = \"race\">";
	echo "<input type=\"hidden\" name = \"rm_subf\" value = \"saveracept\">";
	echo "<input type=\"hidden\" name=\"opt\" value = \"$opt\">";
	echo "</form>";
	
}

function showFiles(){

echo "<h1 > Šī brīža aktualitātes:</h1>";
		echo "<font size=\"4\">Zaubes vasara 2009 Nolikums<a href=\"Files/Zaubes_vasara_2009_nolikums.pdf\" target=\"_blank\"> Skatīt šeit >>></a></font><br>";
		
	echo "<h1 >Noteikumi:</h1>";
		echo "<font size=\"4\">Moto piedzīvojumu sacensību noteikumi<a href=\"Files/MPS_noteikumi_2009_GALA.pdf\" target=\"_blank\"> Skatīt šeit >>></a></font><br>";
		echo "<font size=\"4\">Velo piedzīvojumu sacensības 2009. gada Noteikumi<a href=\"Files/VeloPS_noteikumi_2009_GALA.pdf\" target=\"_blank\"> Skatīt šeit >>></a></font><br>";	
				
				
				
	
	echo "<h1 >2009. gada Nolikumi:</h1>";
	
		
		echo "<font size=\"4\">MPS Latvijas čempionāta 2009.gada Nolikums<a href=\"Files/MPS_LC_nolikums_2009_GALA.pdf\" target=\"_blank\"> Skatīt šeit >>></a></font><br>";
		echo "<font size=\"4\">Velo piedzīvojumu sacensības LaMSF Kausa 2009.gada Nolikums<a href=\"Files/VeloPS_kausa_nolikums_2009_GALA.pdf\" target=\"_blank\"> Skatīt šeit >>></a></font><br><br>";
		echo "<font size=\"4\">Latvijas atklātā kausa „Latvijas Labākais Kvadriciklists” 2009. gada Nolikums<a href=\"Files/LLK_projekts_2009_gala_variants.pdf\" target=\"_blank\"> Skatīt šeit >>></a></font><br><br>";
			
	echo "<h1 >Citi reglamentējosie dokumenti:</h1>";
	
		echo "<font size=\"4\">LaMSF Disciplinārais un Arbitrāžas kodekss<a href=\"http://www.lamsf.lv/DISCIPLIN%C2R%C2UNARBITR%C2%DEAS/NOLIKUMI/tabid/155/locale/lv-LV/default.aspx\" target=\"_blank\"> Skatīt šeit >>></a></font><br>";
		echo "<font size=\"4\">UEM jeb Eiropas Motociklisma savienības sporta kodekss<a href=\"http://www.uem-moto.eu/AboutUEM/UEMrules/SportingCode/tabid/164/Default.aspx\" target=\"_blank\"> Skatīt šeit >>></a></font><br>";
		echo "<font size=\"4\">FIM jeb Pasaules motosporta federācijas sporta kodekss <a href=\"http://www.fim-live.com/fileadmin/alfresco/Codes_et_reglements/STATUTES_English.pdf\" target=\"_blank\"> Skatīt šeit >>></a></font><br>";
	
	echo "<h1 >Iepriekšējie...</h1>";
		echo "<font size=\"4\">Daudzeses Vasara 2009 Nolikums<a href=\"Files/DV2009_nol_v1.pdf\" target=\"_blank\"> Skatīt šeit >>></a></font><br><br>";
		echo "<font size=\"4\">MPS Sējas Pavasaris 2009 Nolikums<a href=\"Files/SP2009_Nolikums_v3.pdf\" target=\"_blank\"> Skatīt šeit >>></a></font><br>";
		echo "<font size=\"4\">MPK ApPasaule Moto Piedzīvojumu un Velo Piedzīvojumu sacensību NOLIKUMA <br>„Sējas pavasaris 2009” PIELIKUMS Nr:1.<a href=\"Files/SP_Nolikuma_papildinajums_Nr1.pdf\" target=\"_blank\"> Skatīt šeit >>></a></font><br>";
	
}

function saveRaceClass($opt){
	$rc = new raceManager;
	$em = new EnduroManager;
	
	$rcl = $rc->getRClass($opt);
	
	$keys = array_keys($_SESSION['params'],"class");
	for($i=0;$i<count($keys);$i++){
		$c = str_replace("class","",$keys[$i]);
		$ins = 1;
		for($j=0;$j<count($rcl);$j++){
			if ($rcl[$j]->getCID() == $c){$ins = 0;continue;}
		}
		if ($ins){$rc->insRClass($opt,$c);}
	}
	
	for($i=0;$i<count($rcl);$i++){
		$del = 1;
		
		for($j=0;$j<count($keys);$j++){
			$c = str_replace("class","",$keys[$j]);
			if ($c==$rcl[$i]->getCID()){$del=0;continue;};
		}
		
		if ($del){
			$ercd = $em->getERCD($opt,"",$rcl[$i]->getCID());
			for($j=0;$j<count($ercd);$j++){
				$em->delERCD($ercd[$j]->ERCD_ID);
			}
			
			$rc->delRClassByID($rcl[$i]->getRCID());
			
		}
	}
	
}

function listRaceClass($opt){
	$rm = new raceManager;
	$rc = new champManager;
	
	$r = $rm->getRace($opt,"","","","","","");
	if(!$r){
		echo "ERROR!";
		break;
	}
	$cl = $rc->getClass("",$r[0]->getType());
	$rcl = $rm->getRClass($opt);
	
		
	echo "<b><a href=\"?rm_func=race&rm_subf=racelist&type=",$r[0]->getType(),"\">",getRaceTypeName($r[0]->getType())," sacensības<a/></b>";
	echo " -> <b><a href=\"index.php?rm_func=race&rm_subf=openrace&opt=$opt\">",$r[0]->getName(),"</a></b>";
	echo " -> sacensības klases";	
	echo "<br>";
	
	echo "<form action=\"index.php\" method=\"post\">";
	echo "<table width =\"100%\" border = \"1\">";
	echo "<tr class=\"title\"><td width=\"20\">&nbsp<td>Nosaukums";
	for($i=0;$i<count($cl);$i++){
		echo "<tr><td width=\"70\">";		
		echo "<input type=\"checkbox\" name =\"class".$cl[$i]->getID()."\" value=\"class\"";
		for($j=0;$j<count($rcl);$j++){
			if($rcl[$j]->getCID() == $cl[$i]->getID()){
				echo " checked ";
			}
		}
		echo ">";
		echo "<td>". $cl[$i]->getName();				
	}
	echo "</table>";
	echo "<center><input type=\"submit\" value=\"Saglabāt\"></center>";
	echo "<input type=\"hidden\" name = \"rm_func\" value = \"race\">";
	echo "<input type=\"hidden\" name = \"rm_subf\" value = \"saveraceclass\">";
	echo "<input type=\"hidden\" name=\"opt\" value = \"$opt\">";
	echo "</form>";
	
}

function printEditRace($opt){
	$rm = new raceManager;
	$cm = new champManager;
	$em = new EnduroManager;

	$id=-1;
	
	
	if ($opt){
		
		$id = $opt;
		$list = $rm->getRace($opt,"","","","","","");
		
		$_SESSION['params']['type'] = $list[0]->getType();
		
		if ($list){	
			$ch = $cm->getChamps("","","",$list[0]->getType());		
			echo "<a href=\"?rm_func=race&rm_subf=racelist&type=",$list[0]->getType(),"\"><h1>";
			switch ($list[0]->getType()){
				case 1:
					echo "Piedzīvojumu enduro";
					break;
				case 2:
					echo "Ezeru";
					break;
				case 3:
					echo "Enduro";
					break;
				case 4:
					echo "Enduro sprint";
					break;
				case 5:
					echo "Cross Country";
					break;
				case 6:
					echo "4H";
					break;
			}
			echo " sacensības:</h1></a>";
			echo "<form action=\"index.php\" enctype=\"multipart/form-data\" method=\"post\">";
				echo "<input type=\"hidden\" name = \"type\" value=\"",$_SESSION['params']['type'],"\" >";			
				echo "<input type=\"hidden\" name = \"rm_func\" value=\"race\"> ";
				echo "<input type=\"hidden\" name = \"rm_subf\" value=\"saverace\"> ";
				echo "<input type=\"hidden\" name = \"opt\" value=\"".$list[0]->getID()."\">";
				
				echo "<table width =\"100%\" border = \"1\" ><tbody style=\"vertical-align:top\">";
				
					echo "<tr class=\"title\" ><td>Nosaukums<td>Saīsinājums";
					echo "<tr >";						
						echo "<td><input type=\"text\" name = \"name\" value=\"".$list[0]->getName()."\" style=\"width:100%\">";
						echo "<td><input type=\"text\" name = \"code\" value=\"".$list[0]->getCode()."\" maxlength=\"8\" style=\"width:100%\">";
					echo "<tr>";
						echo "<td>Sākuma datums<td>Beigu datums";
					echo "<tr>";					
						echo "<td><input type=\"text\" name = \"date\" value=\"".$list[0]->getDate()."\">";
						echo "<td><input type=\"text\" name = \"edate\" value=\"".$list[0]->getEndDate()."\">";
					echo "<tr class=\"title\">";
						echo "<td>Čempionāts<td>Piezīmes";
					echo "<tr>";
						echo "<td><select name =\"ch_id\" size=\"1\">";
							$j=0;
							while(isset($ch[$j])){
								echo "<option value =\"".$ch[$j]->getId()."\" ";
								if ($list[0]->getCH_ID() == $ch[$j]->getId()){
									echo " selected ";
								}
								echo ">".$ch[$j]->getName()." - ".$ch[$j]->getYear()."</option>";
								$j++;
							}
						echo "</select>";
						
						echo "<td><textarea cols=\"30\" rows=\"4\" name = \"notes\" style=\"width:95%\">", $list[0]->getNotes(),"</textarea>";
						echo '<tr><td>Saite uz rezultātiem<td><input type="text" name = "ex_res" style="width:400px" value="',$list[0]->exresLink,'">';
				echo "</tbody></table>";
				switch ($list[0]->getType()){
					case 1:
						break;
					case 2:
						break;
					case 3:
					case 4:
						echo "<hr>";
						$days = $em->getERD($list[0]->getID());
						$cl = $cm->getActulaRaceClass($opt);
						//- enduro days
						echo "sacensības notiks ",count($days)," dienās: ";
						echo "<a href = \"index.php?rm_func=race&rm_subf=addenduroday&opt=",$list[0]->getID(),"\">";
							echo "<img src = \"./images/BlueAdd_16x16.png\" alt=\"Jaunā sacensības diena\" title=\"Jaunā sacensības diena\" border = \"0\">";
						echo " </a>";			
						echo "<a href = \"index.php?rm_func=race&rm_subf=addenduroday&opt=",$list[0]->getID(),"\">";
							echo " <b >Jaunā sacensības diena</b>";
						echo " </a><br>";
						if ($days){
							echo "<table border = 1 width=\"100%\">";
								echo "<tr align=\"center\"> <td colspan=\"2\">sacensību diena<td>Apļu skaits";
								$erdlist="";
								$ercdlist = "";
								for($i=0;$i<count($days);$i++){
								
									echo "<tr style=\"vertical-align:top\">";
										echo "<td>";
											echo " <a onclick=\"confDelGet('Tiešām dzēst?','index.php?rm_func=race&opt=",$list[0]->getID(),"&rm_subf=delerd&erd=",$days[$i]->ERD_ID,"')\">";
												echo "<img src=\"./images/RedCross_16x16.png\" border = \"0\" alt=\"Dzēst\" title=\"Dzēst\" 
													onmouseover=\"document.body.style.cursor = 'pointer'\"
													onmouseout = \"document.body.style.cursor = 'default'\"
												>";
											echo "</a>";
										echo "<td width=\"100\">";
											echo "<table border = \"0\">";
												echo "<tr><td>";
													$erdid = "erd".($days[$i] ? $days[$i]->ERD_ID : "x");
													
													echo "<input type = \"text\" value=\"",
														$days[$i]->START_DATE ? $days[$i]->START_DATE : "0000-00-00 00:00:00" ,
														"\" name=\"$erdid\">";
														
													$erdlist = "$erdlist;$erdid";
												echo "<tr><td>";
													echo "<input type=\"radio\" name=\"rad$erdid\" value=\"1\" title=\"Pulksten rādītaja virzienā\" ";
														echo (isset($days[$i]->ORIENTATION) && $days[$i]->ORIENTATION) ? " checked " : "";
													echo "><img src=\"./images/CW.png\" alt=\"Pulksten rādītaja virzienā\" title=\"Pulksten rādītaja virzienā\">";
													echo "<input type=\"radio\" name=\"rad$erdid\" value=\"0\" title=\"Pret pulksten rādītaju\" ";
														echo (isset($days[$i]->ORIENTATION) && $days[$i]->ORIENTATION == 0) ? " checked " : "";
													echo "><img src=\"./images/VCW.png\" alt=\"Pret pulksten rādītaju\" title=\"Pret pulksten rādītaju\">";
												echo "<tr><td>";
													echo "<a href=\"?rm_func=reslt&rm_subf=publishDayResult&day=".$days[$i]->ERD_ID."\">".ORG_RACE_DAY_RESULT_PUBLISH."</a>";
											echo "</table>";
											
										echo "<td>";
											if($cl){
												
												echo "<table border = \"1\" width = \"100%\">";
													
													$cnt = 4;
													$cnt2 = 4;
													
													for($j=0;$j<count($cl);$j++){
														if ($cnt==$cnt2){echo "<tr>";$cnt=0;}
														
														echo "<td>";
														echo $cl[$j]->getName();
														$ercd = $em->getERCD($opt,$days[$i]->ERD_ID ,$cl[$j]->getId());
														$id1 = ($ercd ? $ercd[0]->ERCD_ID : "x")."_".$cl[$j]->getId()."_".$days[$i]->ERD_ID;
														
														echo "<td style=\"width:20px\">";
														echo "<input type=\"text\" style=\"width:20px\" value=\"",
															$ercd?$ercd[0]->ENDURO_LAPS:0,
															"\" name=\"$id1\">";
															
														$ercdlist= "$ercdlist;$id1";
														$cnt++;
													}
												echo "</table>";
											} else {
												echo "Pievienojiet klases!";
											}
											
								}
								echo "<input type=\"hidden\" name=\"erdlist\" value=\"$erdlist\">";
								echo "<input type=\"hidden\" name=\"ercdlist\" value=\"$ercdlist\">";
								
							echo "</table>";
						} 
						echo "<hr>";
						//enduro tasks
						$tasks = $em->getET("",$id);
						echo "sacensību uzdevumi: ";						
						echo "<a href = \"index.php?rm_func=race&rm_subf=addendurotask&opt=",$list[0]->getID(),"\">";
							echo "<img src = \"./images/BlueAdd_16x16.png\" alt=\"Jauns uzdevums\" title=\"Jauns uzdevums\" border = \"0\">";
						echo " </a>";			
						echo "<a href = \"index.php?rm_func=race&rm_subf=addendurotask&opt=",$list[0]->getID(),"\">";
							echo " <b >Jauns uzdevums</b>";
						echo " </a><br>";
						
						if($tasks){
							$etlist="";
							echo "<table border=\"0\">";
								for($i=0;$i<count($tasks);$i++){
									echo "<tr>";
										echo "<td>";
											echo " <a onclick=\"confDelGet('Tiešām dzēst?','index.php?rm_func=race&opt=$id&rm_subf=delet&et=",$tasks[$i]->ET_ID,"')\">";
												echo "<img src=\"./images/RedCross_16x16.png\" border = \"0\" alt=\"Dzēst\" title=\"Dzēst\" 
													onmouseover=\"document.body.style.cursor = 'pointer'\"
													onmouseout = \"document.body.style.cursor = 'default'\"
												>";
											echo "</a>";
										echo "<td><input type=\"text\" name=\"et",$tasks[$i]->ET_ID,"\" value=\"",$tasks[$i]->NAME,"\">";
										$etlist="$etlist;et".$tasks[$i]->ET_ID;	
								}
							echo "</table>";
							echo "<input type=\"hidden\" name=\"etlist\" value=\"$etlist\">";
						}
						
						break;
					
						
					default:
						break;
				}
				echo "<hr><center><input type=\"submit\" value=\"Saglabāt\"></center>";
			echo "</form>";
		}
		
		switch ($list[0]->getType()){
			case 1:
			
				echo "<hr><h1>sacensības personāls:</h1>";
				echo "<table border =\"1\" width=\"100%\" align=\"center\">";
					echo "<tr class=\"title\">";
						echo "<td wdith=\"50%\"> Orgi";
						echo "<td width=\"50%\"> Tiesneši";
					echo "<tr valign=\"top\">";
						echo "<td>";
							$crew = $rm->getRaceCrew($opt,7,"");
							if ($crew){
								echo "<table border =\"1\" width=\"100%\">";
									echo "<tr class=\"title\"><td>&nbsp<td>Lietotājs";
									for($i=0;$i<count($crew);$i++){
										echo "<tr>";
											echo "<td width=\"100\" align=\"center\">";
												echo "<form action=\"index.php\" enctype=\"multipart/form-data\" method=\"post\">";
													echo "<input type=\"hidden\" name = \"type\" value=\"",$_SESSION['params']['type'],"\" >";			
													echo "<input type=\"hidden\" name = \"rm_func\" value=\"race\"> ";
													echo "<input type=\"hidden\" name = \"rm_subf\" value=\"delorg\"> ";												
													echo "<input type=\"hidden\" name = \"org\" value=\"",$crew[$i]->getID(),"\"> ";
													echo "<input type=\"hidden\" name = \"opt\" value=\"$opt\">";
													echo "<input type=\"submit\" value=\"Dzēst\">";
												echo "</form>";
											echo "<td>";
												echo $crew[$i]->getName();
									}
								echo "</table>";
							}						
						echo "<td>";
							$crew = $rm->getRaceCrew($opt,8,"");
							if ($crew){
								echo "<table border =\"1\" width=\"100%\">";
									echo "<tr class=\"title\"><td>&nbsp<td>Lietotājs";
									for($i=0;$i<count($crew);$i++){
										echo "<tr>";
											echo "<td width=\"100\" align=\"center\">";
												echo "<form action=\"index.php\" enctype=\"multipart/form-data\" method=\"post\">";
													echo "<input type=\"hidden\" name = \"type\" value=\"",$_SESSION['params']['type'],"\" >";			
													echo "<input type=\"hidden\" name = \"rm_func\" value=\"race\"> ";
													echo "<input type=\"hidden\" name = \"rm_subf\" value=\"delorg\"> ";												
													echo "<input type=\"hidden\" name = \"org\" value=\"",$crew[$i]->getID(),"\"> ";
													echo "<input type=\"hidden\" name = \"opt\" value=\"$opt\">";
													echo "<input type=\"submit\" value=\"Dzēst\">";
												echo "</form>";
											echo "<td>";
												echo $crew[$i]->getName();
									}
								echo "</table>";
							}						
					echo "<tr>";
						echo "<td align=\"center\">";
							echo "<form action=\"index.php\" enctype=\"multipart/form-data\" method=\"post\">";
								echo "<input type=\"hidden\" name = \"type\" value=\"",$_SESSION['params']['type'],"\" >";			
								echo "<input type=\"hidden\" name = \"rm_func\" value=\"race\"> ";
								echo "<input type=\"hidden\" name = \"rm_subf\" value=\"addorg\"> ";
								echo "<input type=\"hidden\" name = \"perm\" value=\"7\"> ";
								echo "<input type=\"hidden\" name = \"opt\" value=\"$opt\">";
								echo "<input type=\"submit\" value=\"Pievienot jaunu\">";
							echo "</form>";
						echo "<td align=\"center\">";
							echo "<form action=\"index.php\" enctype=\"multipart/form-data\" method=\"post\">";
								echo "<input type=\"hidden\" name = \"type\" value=\"",$_SESSION['params']['type'],"\" >";			
								echo "<input type=\"hidden\" name = \"rm_func\" value=\"race\"> ";
								echo "<input type=\"hidden\" name = \"rm_subf\" value=\"addorg\"> ";
								echo "<input type=\"hidden\" name = \"perm\" value=\"8\"> ";
								echo "<input type=\"hidden\" name = \"opt\" value=\"$opt\">";
								echo "<input type=\"submit\" value=\"Pievienot jaunu\">";					
							echo "</form>";
				echo "</table>";
		
				echo "<hr><h1>Papildus iespejas:</h1>";
				
				echo "<a href=\"index.php?rm_func=race&rm_subf=raceclass&opt=$id\">",$list[0]->getName()," sacensību klases</a>";
				echo " | <a href=\"index.php?rm_func=race&rm_subf=racept&opt=$id\">sacensības foto uzdevumi</a>";
				echo " | <a href=\"index.php?rm_func=race&rm_subf=sflist&opt=$id\"> Starpfinišu saraksts</a>";
				echo " | <a href=\"index.php?rm_func=champpts&rm_subf=ptslist&opt=$id\"> Sezonas ieskaites punkti</a>";			
				echo " | <a href=\"index.php?rm_func=race&rm_subf=allanswer&opt=$id\"> Visas atbildes</a>";		
				echo "<br>";
				echo "<a href=\"index.php?rm_func=race&rm_subf=cplist&opt=$id\"> Kontrolpunktu saraksts</a> | ";	
				echo "<a href=\"index.php?rm_func=race&rm_subf=wpimp&opt=$id\"> Kontrolpunktu imports</a> | ";	
				echo "<a href=\"kpexp.php?opt=$id\" terget=\_blank\"> Waypoint eksports</a> | ";	
				echo "<a href=\"kpexp.php?opt=$id&mode=gps\"> GPS punktu Waypoint eksports</a><br>";
				echo "<hr>";
				$classl = $cm->getActulaRaceClass($opt);
				
				
				echo "<table border=0>";
					for($j=0;$j<count($classl);$j++){
						echo "<tr>";
							echo "<td><a href=\"KK.php?&race=$id&class=",$classl[$j]->getId(),"\" terget=\_blank\"> Kontrolkarte - ",$classl[$j]->getName(),"</a>";
							echo "<td>| <a href=\"kpexp.php?opt=$id&class=",$classl[$j]->getId(),"\" terget=\_blank\"> Waypoint eksports - ",$classl[$j]->getName(),"</a>";
					}		
				echo "</table>";
				break;
			case 2:
				break;
			case 3:
			case 4:	
				echo "<hr><h1>Papildus iespejas:</h1>";			
				echo "<a href=\"index.php?rm_func=race&rm_subf=raceclass&opt=$id\">",$list[0]->getName()," sacensības klases</a>";
				echo " | <a href=\"index.php?rm_func=race&rm_subf=enduroraceclassdaystage&opt=$id\"> Laika kontroles</a>";
				break;
			case 5:
			case 6:
				echo "<hr><h1>Papildus iespejas:</h1>";			
				echo "<a href=\"index.php?rm_func=race&rm_subf=raceclass&opt=$id\">",$list[0]->getName()," sacensības klases</a>";
			break;
		}	
	}
}

function actRace($opt){
	$rm = new raceManager;
	if($opt){
		$rm->secActiveRace($opt,"",$_SESSION['params']['type']);
	}	
}

function delRace($opt){
	$rm = new raceManager;
	$allowDel = false;
	if ($opt){
		$races = $rm->getrace($opt,"","","","","","");			
		if ($races){				
			switch ($races[0]->getType()){
				case 1:
					if (				
						isFolderEmpty("./Files/RACE/".$races[0]->getCode()."/KKP") &&
						isFolderEmpty("./Files/RACE/".$races[0]->getCode()."/TEAMS") 
					){
						$del = true;
						if($rm->delGal($races[0]->ogalid)){rmdir(GAL_ROOT_PATH.$races[0]->ogalid."/.cache");rmdir(GAL_ROOT_PATH.$races[0]->ogalid);} else {$del=false;}
						if($rm->delGal($races[0]->tgalid)){rmdir(GAL_ROOT_PATH.$races[0]->tgalid."/.cache");rmdir(GAL_ROOT_PATH.$races[0]->tgalid);} else {$del=false;}
						if($del && $rm->delGal($races[0]->galid)){rmdir(GAL_ROOT_PATH.$races[0]->galid."/.cache");rmdir(GAL_ROOT_PATH.$races[0]->galid);}
											
						rmdir("./Files/RACE/".$races[0]->getCode()."/KKP");
						rmdir("./Files/RACE/".$races[0]->getCode()."/TEAMS");
						rmdir("./Files/RACE/".$races[0]->getCode());
							
						$allowDel = true;
					}
					
					break;
				case 2:
				case 3:
				default:
					$allowDel = true;
			}
		}
		
		if($allowDel){
			$rm->delRace($opt);
		}
		
	}	
}

function saveRace($opt){
	$rm = new raceManager;
	$em = new EnduroManager;
	if (isset($opt)){
		
		switch($_POST["type"]){			
			case 3:
				$erd = explode(";",$_SESSION['params']['erdlist']);
				for($i=0;$i<count($erd);$i++){
					if ($erd[$i]){
						$em->saveERD(str_replace("erd","",$erd[$i]),$_SESSION['params'][$erd[$i]],$_SESSION['params']["rad".$erd[$i]]);
					}
				}				
				$ercd = explode(";",$_SESSION['params']['ercdlist']);
				
				for ($i=0;$i<count($ercd);$i++){
					if($ercd[$i]){
						$item = explode("_",$ercd[$i]);						
						//print_r($item);
						if ($item[0]=="x"){
							$em->insERCD($item[2],$_SESSION['params'][$ercd[$i]],$item[1]);
						} else {
							$em->saveERCD($item[0],$_SESSION['params'][$ercd[$i]],"-1");
						}
					}
				}
				
				$et = explode(";",$_SESSION['params']['etlist']);
				for($i=0;$i<count($et);$i++){
					$em->saveET(str_replace("et","",$et[$i]),$_SESSION['params'][$et[$i]]);
				}
				
				$rm->saveRace($opt,$_POST["ch_id"],$_POST["name"],$_POST["notes"],$_POST["date"],$_POST["edate"],"",$_POST["code"],$_POST['type'],$_POST['ex_res']);
				break;
			default:	
				$rm->saveRace($opt,$_POST["ch_id"],$_POST["name"],$_POST["notes"],$_POST["date"],$_POST["edate"],"",$_POST["code"],$_POST['type'],$_POST['ex_res']);			
		}
		
	}else {
		if( $_POST["type"] == 1 && $_POST["code"]==""){
			echo "<center><b style=\"color:red;font-size:20pt;\">sacensības kods ir obligāts! </b></center>";
			return null;
		}

		switch($_SESSION['params']["type"]){
			case 1:
				mkdir("./Files/RACE/".$_POST["code"]);
				mkdir("./Files/RACE/".$_POST["code"]."/TEAMS");
				mkdir("./Files/RACE/".$_POST["code"]."/KKP");
				
				$gid = $rm->insGallery($_POST["name"],ROOT_GAL_ID,0);
				mkdir(GAL_ROOT_PATH."$gid");				
				mkdir(GAL_ROOT_PATH."$gid/.cache");				
				$ogid = $rm->insGallery("Trase",$gid,0);
				mkdir(GAL_ROOT_PATH."$ogid");
				mkdir(GAL_ROOT_PATH."$ogid/.cache");				
				$tmgid = $rm->insGallery("Dalībnieku bildes",$gid,0);
				mkdir(GAL_ROOT_PATH."$tmgid");
				mkdir(GAL_ROOT_PATH."$tmgid/.cache");				
				
				
				
				$rm->insRace($_POST["ch_id"],$_POST["name"],$_POST["notes"],$_POST["date"],$_POST["edate"],"",$_POST["code"],$_POST['type'],$gid,$ogid,$tmgid,$_POST['ex_res']);
				return mysql_insert_id();
				break;
			default:
				$rm->insRace($_POST["ch_id"],$_POST["name"],$_POST["notes"],$_POST["date"],$_POST["edate"],"",$_POST["code"],$_POST['type']," null "," null "," null ",$_POST['ex_res']);				     
				return mysql_insert_id();
				break;
						
		}
	}
	return $opt;
}

function printNewRace(){
	echo "<h1>Izveidot jaunās <font color=\"green\" style=\"font-size:20px\">";
	switch ($_SESSION['params']['type']){
		case 1:
			echo "Piedzīvojumu eduro </font>sacensības</h1>";
			break;
		case 2:
			echo "Ezeru foto</font>sacensības</h1>";
			break;
		case 3:
			echo "Enduro </font>sacensības</h1>";
			break;
		case 4:
			echo "Enduro sprint </font>sacensības</h1>";
			break;
		case 5:
			echo "Cross Country </font>sacensības</h1>";
			break;
		case 6:
			echo "4H </font>sacensības</h1>";
			break;
	}
	
	
	echo "<form enctype=\"multipart/form-data\" action=\"index.php\" method=\"post\">";
	echo "<input type=\"hidden\" name = \"rm_func\" value=\"race\"> ";
	echo "<input type=\"hidden\" name = \"rm_subf\" value=\"saverace\"> ";
	echo "<input type=\"hidden\" name = \"type\" value=\"",$_SESSION['params']['type'],"\"> ";
	
	echo "<table width =\"100%\" border = \"1\">";
	echo "<tr class=\"title\"><td>Nosaukums<td>Saīsinājums<td>Sākuma datums<td>Beigu datums";
	
		echo "<tr>";
		echo "<td><input type=\"text\" name = \"name\" >";
		echo "<td><input type=\"text\" name = \"code\" maxlength=\"8\">";
		echo "<td><input type=\"text\" name = \"date\" value=\"0000-00-00\">";
		echo "<td><input type=\"text\" name = \"edate\" value = \"0000-00-00\">";
		echo "<tr class=\"title\"><td>Čempionāts<td>Piezīmes";
		
		echo "<tr><td><select name =\"ch_id\" size=\"1\">";
		$cm = new champManager;
		$ch = $cm->getChamps("","","",$_SESSION['params']['type']);
		$i=0;
		while(isset($ch[$i])){
			echo "<option value =\"".$ch[$i]->getId()."\">".$ch[$i]->getName()." - ".$ch[$i]->getYear()."</option>";
			$i++;
		}
		echo "</select>";	
		
		echo "<td><textarea cols=\"30\" rows=\"4\" name = \"notes\" ></textarea>";
			
	echo "</table>";
	switch ($_SESSION['params']['type']){
		case 1:
			break;
		case 2:
			break;
		case 3:
			// echo "<hr>";
			// echo "Apļi: ","<td><input type=\"text\" name = \"enduro_laps\">";; 
			break;
		default:
			break;
	}
	echo "<hr><center><input type=\"submit\" value=\"Saglabāt\" ></center>";
	echo "</form>";
}

function printRace(){
	
	$bb3auth = new BB3Auth();
	if(!$bb3auth->check('u_rm_race_admin')){
		echo "<center><h1 style=\"color:red\">Nav tiesību</h1></center>";
		return;
	}

	$rm = new raceManager;
	$cm = new champManager;
	if(!$_SESSION['params']['type']){$_SESSION['params']['type']=1;}
	$races = $rm->getRace("","","","",$_SESSION['params']['type'],"",1);
	$i =0;

	echo "<table border = \"0\" align = \"left\" style=\"border:0px;\">";
		echo "<tr valign=\"middle\">";
			echo "<td>";
				echo "<a href = \"index.php?rm_func=race&rm_subf=racelist&type=",$_SESSION['params']['type'],"\" id = \"refreshRace\">";
					echo "<img  src = \"./images/Refresh_16x16.png\" alt=\"Atjaunot\" title=\"Atjaunot\" border = \"0\">";
				echo " </a>";
			echo "<td>";
				echo "|";
			echo "<td>";
				echo "<a href = \"index.php?rm_func=race&rm_subf=newrace&type=",$_SESSION['params']['type'],"\">";
					echo "<img src = \"./images/BlueAdd_16x16.png\" alt=\"Jaunās sacensības\" title=\"Jaunās sacensības\" border = \"0\">";
				echo " </a>";
			echo "<td>";
				echo "<a href = \"index.php?rm_func=race&rm_subf=newrace&type=",$_SESSION['params']['type'],"\">";
					echo " <b >Jaunās sacensības</b>";
				echo " </a>";
	echo "</table>";
	
	echo "<br>";
	echo "<table width =\"100%\" border = \"1\">";
	echo "<tr class=\"title\"><td width=\"60\">&nbsp<td width = \"150\">Nosaukums<td width=\"70\">Sākuma datums<td width=\"70\">Beigu datums<td width=\"150\">Čempionāts<td>Piezīmes";
		if($_SESSION['params']['type']==1){
			echo "<td width=\"50\">Galerijas (G/O/S)";
		}
		
	while (isset($races[$i]) ){
		
		echo "<tr";
		if($races[$i]->getActual() == 1){echo " style=\"color:Green;font-weight:bold;\" ";}
		echo ">";
		echo "<td align=\"center\">";
		
		echo "<a href = \"index.php?rm_func=race&rm_subf=openrace&opt=",$races[$i]->getId(),"&type=",$_SESSION['params']['type'],"\">";
			echo "<img src = \"./images/PageWhiteEdit_16x16.png\" alt=\"Atvērt\" title=\"Atvērt\" border = \"0\">";
		echo "</a>";
		
		echo " <a onclick=\"confDelGet('Tiešām dzēst?','index.php?rm_func=race&rm_subf=delrace&type=",$_SESSION['params']['type'],"&opt=",$races[$i]->getId(),"')\">";
			echo "<img src=\"./images/RedCross_16x16.png\" border = \"0\" alt=\"Dzēst\" title=\"Dzēst\" 
				onmouseover=\"document.body.style.cursor = 'pointer'\"
				onmouseout = \"document.body.style.cursor = 'default'\"
			>";
		echo "</a>";
		
		echo "<a href = \"index.php?rm_func=race&rm_subf=actrace&opt=",$races[$i]->getId(),"&type=",$_SESSION['params']['type'],"\">";
			echo "<img border = \"0\" ";
				if ($races[$i]->getActual() == 1){
					echo " src = \"./images/GreenArrowUp_16x16.png\" alt=\"Aizvērt (X)\" title=\"Aizvērt (X)\" ";
				} else {
					echo "src = \"./images/RedArrowDown_16x16.png\" alt=\"Atvērt (^)\" title=\"Atvērt (^)\" ";
				}
			echo ">";
		echo "</a>";
		
		echo "<td>";
			echo "<a href = \"index.php?rm_func=race&rm_subf=openrace&opt=",$races[$i]->getId(),"&type=",$_SESSION['params']['type'],"\">";
				echo $races[$i]->getName();
			echo "</a>";
		echo "<td>". $races[$i]->getDate();
		echo "<td>". $races[$i]->getEndDate();
		$ch = $cm->getChamps($races[$i]->getCH_ID(),"","","");		
		echo "<td>". $ch[0]->getName()." - ".$ch[0]->getYear();		
		echo "<td>"; if($races[$i]->getNotes()){echo $races[$i]->getNotes();} else {echo "&nbsp";};
		
		if($_SESSION['params']['type']==1){
			echo "<td width=\"50\">";
				if($races[$i]->galid){echo "<a href=\"?rm_func=race&rm_subf=racelist&type=1&f2=setgal&set=",$races[$i]->galvis ? 0:1,"&gal=",$races[$i]->galid,"\">";}
					echo "<img src=\"./images/",($races[$i]->galvis ? "Green_bubble_24x24.png" : "Red_bubble_24x24.png"),"\" border=\"0\" alt=\"","\" title=\"sacensības galerija\" width=\"16px\" height=\"16px\">";
				if($races[$i]->galid){echo "</a>" ;}
				
				if($races[$i]->ogalid){echo "<a href=\"?rm_func=race&rm_subf=racelist&type=1&f2=setgal&set=",$races[$i]->ogalvis ? 0:1,"&gal=",$races[$i]->ogalid,"\">";}
					echo "<img src=\"./images/",($races[$i]->ogalvis ? "Green_bubble_24x24.png" : "Red_bubble_24x24.png"),"\" border=\"0\" alt=\"","\" title=\"Orgu bildes (trase)\" width=\"16px\" height=\"16px\">";
				if($races[$i]->ogalid){echo "</a>" ;}
				
				if($races[$i]->tgalid){echo "<a href=\"?rm_func=race&rm_subf=racelist&type=1&f2=setgal&set=",$races[$i]->tgalvis ? 0:1,"&gal=",$races[$i]->tgalid,"\">";}
					echo "<img src=\"./images/",($races[$i]->tgalvis ? "Green_bubble_24x24.png" : "Red_bubble_24x24.png"),"\" border=\"0\" alt=\"","\" title=\"Dalībnieku bildes\" width=\"16px\" height=\"16px\">";
				if($races[$i]->tgalid){echo "</a>";}
		}
		$i++;
	}
	echo "</table>";
	
}

function printActRace(){
	$rm = new raceManager;
	$cm = new champManager;
	
	$r = $rm->getRace('','','',1,'','','');
	
	echo "<br><b><center  style=\"color:#0E0E6E;font-size:30px\">",COMP_APPLY_HEADER,"</center></b><br>";
	
	if(count($r) > 0){
		foreach ($r as &$v) {
			
			echo '<p>&nbsp&nbsp&nbsp&nbsp&nbsp
			<a href = "./';
			if ($v->getType() != 1 ){
				ECHO '?rm_func=enduro&rm_subf=apply&type=',$v->getType(),'&opt=',$v->getID();
			}else{
				echo '?rm_func=racer&rm_subf=raceAppl';
			}
			
			
			
			echo '" title="',MENU_APPL,'">';	
				$cmp = $cm->getChamps($v->getCH_ID(),"","","");			
				echo "<font style=\"font-size:18px;color:blue;font-weight:bold\">",
					 $cmp[0]->getName(),", ",$v->getName() ," - ",$v->getDate(),"</font>";
			echo '</a></p>';
		
		}
	} else {
		echo '<p style="text-align:center; color:#0E0E6E; font-weight:bold">',EM_RACE_LIST_EMPTY,'</p>';
	}	
}

?>