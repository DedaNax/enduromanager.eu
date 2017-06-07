<?php
class TRKP{
	private $id;
	private $cpid;
	private $trid;
	private $anwer;
	private $image;
	private $iok;
	private $aok;
	private $done;
	private $pen;
	
	public $galid;
	
	public function getId(){
		return $this->id;
	}
	public function getCpId(){
		return $this->cpid;
	}
	public function getTrId(){
		return $this->trid;
	}
	public function getAnswer(){
		return $this->answer;
	}
	public function getImage(){
		return $this->image;
	}
	public function getIok(){
		return $this->iok;
	}
	public function getAok(){
		return $this->aok;
	}
	public function getDel(){
		return $this->done;
	}
	public function getPen(){
		return $this->pen;
	}

	public function setId($value){
		$this->id = $value;
	}
	public function setCpId($value){
		$this->cpid = $value;
	}
	public function setTrId($value){
		$this->trid = $value;
	}
	public function setAnswer($value){
		$this->answer = $value;
	}
	public function setImage($value){
		$this->image = $value;
	}
	public function setIok($value){
		$this->iok = $value;
	}
	public function setAok($value){
		$this->aok = $value;
	}
	public function setDel($value){
		$this->done = $value;
	}
	public function setPen($value){
		$this->pen = $value;
	}
}
class TRPen{
	private $penid;
	public function getId(){
		return $this->penid;
	}
	public function setId($value){
		$this->penid = $value;
	}
	private $trid;
	public function getTRID(){
		return $this->trid;
	}
	public function setTRID($value){
		$this->trid = $value;
	}
	private $pen;
	public function getPen(){
		return $this->pen;
	}
	public function setPen($value){
		$this->pen = $value;
	}
	private $com;
	public function getCom(){
		return $this->trid;
	}
	public function setCom($value){
		$this->trid = $value;
	}
}
class TRSF{
	private $id;
	private $sf;
	private $tr;
	private $fin;
	
	public function setId($value){
		$this->id=$value;
	}
	public function setSF($value){
		$this->sf=$value;
	}
	public function setTR($value){
		$this->tr=$value;
	}
	public function setFin($value){
		$this->fin=$value;
	}
	
	public function getId(){
		return $this->id;
	}
	public function getSF(){
		return $this->sf;
	}
	public function getTR(){
		return $this->tr;
	}
	public function getFin(){
		return $this->fin;
	}
}
class TRSU{
	private $id;
	private $tr;
	private $start;
	private $fin;
	private $pts;
	private $su;
	
	public function getId(){
		return $this->id;
	}
	public function getTR(){
		return $this->tr;
	}
	public function getStart(){
		return $this->start;
	}
	public function getFin(){
		return $this->fin;
	}
	public function getPts(){
		return $this->pts;
	}
	public function getSU(){
		return $this->su;
	}
	
	public function setId($value){
		$this->id=$value;
	}
	public function setTR($value){
		$this->id=$value;
	}
	public function setStart($value){
		$this->start=$value;
	}
	public function setFin($value){
		$this->fin=$value;
	}
	public function setPts($value){
		$this->pts=$value;
	}
	public function setSU($value){
		$this->su=$value;
	}
}


class TRManager{

	public function getTRKP($id,$tr,$race,$team,$chp,$del){
		$sql = "SELECT * FROM `e_trchp`";
		$where = "";
		if ($del <> ""){$where = " `Deleted` <> 1";}
		if ($tr<> ""){
			if($where <> ""){$where = "$where and";}
			$where ="$where `TRID`= $tr";
		}
		if ($chp<> ""){
			if($where <> ""){$where = "$where and";}
			$where ="$where `ChpID`= $chp";
		}
		if ($id<> ""){
			if($where <> ""){$where = "$where and";}
			$where ="$where `TRChpID`= $id";
		}
		if ($where <> "") {$sql = "$sql where $where";}	
		//echo $sql;
		$q_result = queryDB($sql);		
		
		$reslt = array();		
		 while ($row = mysql_fetch_array($q_result, MYSQL_ASSOC)) {
			
			$item = new TRKP;
			
			$item->setId($row[TRChpID]);
			$item->setCpId($row[ChpID]);
			$item->setTrId($row[TRID]);
			$item->setAnswer($row[Answer]);						
			$item->setImage($row[Image]);						
			$item->setIok($row[IOK]);						
			$item->setAok($row[AOK]);
			$item->setDel($row[Deleted]);
			$item->galid = $row[GAL_ID];
			//$item->setPen($row[ACTUAL]);
			
			array_push($reslt,$item);
		}

		return $reslt;
		
	}
	public function insTRKP($tr,$cp){
		$sql="INSERT INTO `e_trchp` (`TRID`,`ChpID`) VALUES ($tr,$cp);";
		//echo $sql;
		queryDB($sql);	
	}
	public function selTRKP($trkp,$val){
		$sql="UPDATE `e_trchp` SET `Deleted` = $val WHERE `TRChpID` = $trkp";
		//echo $sql;
		queryDB($sql);	
	}
	public function updKP_User($id,$answ,$img,$gid){
		$sql="UPDATE `e_trchp` SET `Answer` = '$answ', `Image` = '$img', `gal_id` = ".($gid ? $gid : " null ")." WHERE `TRChpID` = $id;";
		//echo $sql;
		queryDB($sql);
	}
	public function updKP_Ties($id,$aok,$iok){
		$sql="UPDATE `e_trchp` SET `AOK` = '$aok', `IOK` = '$iok' WHERE `TRChpID` = $id";
		queryDB($sql);
	}
	public function galKP($id,$galid){
		$sql="UPDATE `e_trchp` SET `GAL_ID` = ".($galid ? $galid : " null ")." WHERE `TRChpID` = $id";
		queryDB($sql);
	}
	
	public function compltr($opt){
		$sql = "UPDATE `e_teamrace` SET `Completed` = 1 WHERE `TRID` = $opt";
		queryDB($sql);
	}
	public function retTR($opt){
		$sql = "UPDATE `e_teamrace` SET `Completed` = 0,`Closed`=0 WHERE `TRID` = $opt";
		queryDB($sql);
	}
	public function ClosetTR($opt){
		$sql = "UPDATE `e_teamrace` SET `Closed` = 1 WHERE `TRID` = $opt";
		queryDB($sql);
	}

	public function getTRPen($id,$tr){
		$sql = "SELECT * FROM `e_sodsprot`";
		$where = "";
		if ($id <> ""){$where = " `SodProtID` = $id";}
		if ($tr<> ""){
			if($where <> ""){$where = "$where and";}
			$where ="$where `TRID`= $tr";
		}
		
		if ($where <> "") {$sql = "$sql where $where";}	
		//echo $sql;
		$q_result = queryDB($sql);		
		
		$reslt = array();		
		 while ($row = mysql_fetch_array($q_result, MYSQL_ASSOC)) {
			
			$item = new TRPen;
			
			$item->setId($row[SodProtID]);
			$item->setTRID($row[TRID]);
			$item->setPen($row[Pen]);
			$item->setCom($row[Comment]);	
			
			array_push($reslt,$item);
		}

		return $reslt;
		
	}
	public function saveTRPen($id,$pen,$com){
		$sql="UPDATE `e_sodsprot` SET `Pen`= $pen,`Comment`='$com' WHERE `SodProtID` = $id";
		queryDB($sql);
	}
	public function insTRPen($tr,$pen,$com){
		$sql="INSERT INTO `e_sodsprot` (`TRID`,`Pen`,`Comment`) VALUES ($tr,$pen,'$com')";
		//echo $sql;
		queryDB($sql);
	}
	public function delTRPen($id){
		$sql="DELETE FROM `e_sodsprot` WHERE `SodProtID` = $id";
		//echo $sql;
		queryDB($sql);
	}

	public function getTRSU($id,$tr,$su){
	
		
		
		$sql = "SELECT * FROM e_suprot ";
		$where = "";
		if ($id <> "") {$where = "id = '$id'";}
		if ($tr<> "") {
			if ($where <> "") { $where = "$where and";}
			$where = "$where tr_id = $tr";
		}
		if ($su<> "") {
			if ($where <> "") { $where = "$where and";}
			$where = "$where su_id = $su";
		}
		
		if ($where <> "") {$sql = "$sql where $where ";}			
		
		$q_result = queryDB($sql);		
		
		$reslt = array();		
		 while ($row = mysql_fetch_array($q_result, MYSQL_ASSOC)) {
			
			$item = new TRSU;
			
			$item->setID($row[ID]);
			$item->setTR($row[TR_ID]);			
			$item->setStart($row[START]);								
			$item->setFin($row[FIN]);								
			$item->setPts($row[PTS]);	
			$item->setSU($row[SU_ID]);
			array_push($reslt,$item);
		}

		return $reslt;
	
	}
	public function insTRSU($tr,$start,$fin,$pts,$su){
		
		$sql = "INSERT INTO `e_suprot` (`tr_id` ,`fin` ,`start` ,`pts`,`su_id`)VALUES ($tr, '$fin', '$start',$pts,$su);";
		//echo $sql;
		queryDB($sql);
	}
	public function delTRSU($id){
		
		$sql = "delete from `e_suprot` where `id` = '$id';";
		queryDB($sql);
	}
	public function saveTRSU($id,$start,$fin,$name){
		
		$sql = "UPDATE `e_suprot` SET `start` = '$start',`fin` = '$fin' , `pts` = '$pts' where `id` = $id;";
		queryDB($sql);
	}
	public function clearTRSU($tr,$su){
		
		$sql = "delete from `e_suprot` where `tr_id` = $tr and `su_id` = $su;";
		queryDB($sql);
	}
	
	public function getTRSF($id,$sf,$tr){
	
		
		
		$sql = "SELECT * FROM e_stfinprot ";
		$where = "";
		if ($id <> "") {$where = "id = '$id'";}
		if ($sf <> "") {
			if ($where <> "") { $where = "$where and";}
			$where = "$where sf_id = '$sf'";
		}
		if($tr<>""){
			if ($where <> "") { $where = "$where and";}
			$where = "$where `tr_id` = '$tr'";
		}
		
		if ($where <> "") {$sql = "$sql where $where";}			
		
		$q_result = queryDB($sql);		
		
		$reslt = array();		
		 while ($row = mysql_fetch_array($q_result, MYSQL_ASSOC)) {
			
			$item = new TRSF;
			
			$item->setID($row[ID]);
			$item->setSF($row[SF_ID]);
			$item->setTR($row[TR_ID]);
			$item->setFin($row[FIN]);								
			
			array_push($reslt,$item);
		}

		return $reslt;
	
	}
	public function insTRSF($sf,$tr,$fin){
		
		$sql = "INSERT INTO `e_stfinprot` (`sf_id` ,`tr_id` ,`fin` )VALUES ('$sf', '$tr', '$fin');";
		//echo $sql;
		queryDB($sql);
	}
	public function saveTRSF($id,$fin){
		
		$sql = "UPDATE `e_stfinprot` SET `fin` = '$fin' where `id` = $id;";
		queryDB($sql);
	}
	public function delTRSF($id){
		
		$sql = "delete from `e_stfinprot` where `id` = '$id';";
		queryDB($sql);
	}
	public function delTRSF2($tr,$sf){
		
		$sql = "delete from `e_stfinprot` where `tr_id` = $tr and `sf_id` = $sf;";
		
	queryDB($sql);
	}

	public function TRHasQuest($tr){
		$sql = "SELECT count(*) as cnt FROM `e_trchp` where (`aok` = 2 or `iok` = 2) and `TRID` = $tr";
		//echo $sql;
		$q_result = queryDB($sql);	
		
		if ($row = mysql_fetch_array($q_result, MYSQL_ASSOC)){
			
			return $row[cnt];
		}
		return 0;
	}
}

function editTR($subf,$opt){
	switch($subf){
		case "sendtogal":
			echo sendtogal($opt,$_SESSION["params"]["state"]);
			break;
		case "chpaccept":
			listTR($opt);
			break;
		case "chpinp":
			printInpCp($opt);
			break;
		case "savetrkp":
			saveTRKP($opt);
			listTR("");
			break;
		case "imginp":
			printImgInp();
			break;
		case "compltr";
			compltr($opt);
			printImgInp();
			break;
		case "openKP":
			openKP($opt);
			break;
		case "saveKP":
			saveKP($opt);
			printImgInp();
			break;
		case "trvert":
			trvert($opt);
			break;
		case "retTR":
			retTR($opt);
			trvert("");
			break;
		case "doverttr":
			doverttr($opt);			
			break;
		case "saveverttr":
			saveverttr($opt);
			trvert("");
			break;
		case "trpen":
			trpen($opt);
			break;
		case "newtrpen":
			newtrpen($opt);
			break;
		case "savetrpen":
			savetrpen($opt);
			trpen($_POST['tr']);
			break;
		case "deltrpen":
			deltrpen($opt);
			trpen($_POST['tr']);
			break;
		case "prot":
			printMainProt($opt);
			break;
		case "sfin":
			printSFProtIn($opt);
			break;
		case "sfout":
			printSFProtOut($opt);
			break;
		case "suin":
			printSUProtIN($opt);
			break;
		case "suout":
			printSUProtOUT($opt);
			break;
		case "savetrsf";
			sfProtsave($opt);
			printSFProtOut($opt);
			break;
		case "savetrsu":
			suProtsave($opt);
			printSUProtOUT($opt);
			break;
		default:
	}
}

function sendtogal($id,$state){
	$tr = new TRManager;
	$rm = new raceManager;
	$rcr = new RacerManager;
	
	$trkp = $tr->getTRKP($id,"","","","","");
	
	if ($state){
		$name = $rm->getGalItem($trkp[0]->galid);					
		$path_parts = pathinfo($name);
		$name1 = $path_parts["dirname"]."/.cache/".str_replace(".".$path_parts["extension"],"",$path_parts["basename"])."-170.".$path_parts["extension"]; 
		
		@unlink("../".$name);
		@unlink("../".$name1);
		
		$rm->delGalItem($trkp[0]->galid);
		$tr->galKP($id,null);
	} else {
		if($trkp[0]->getImage()){
			$trace = $rcr->getTeamRace($trkp[0]->getTrId(),"","","");
			$race = $rm->getRace($trace[0]->getRID(),"","","","","","");
		
			$name=GAL_ROOT_PATH.$race[0]->tgalid."/".date("Y-m-d_H-i-s_").$trkp[0]->getId().".jpg";
			$path_parts = pathinfo($name);					
			
			copy($trkp[0]->getImage(),$name);
			
			//return "| ".$trkp[0]->getImage(). " | $name |";
			$tr->galKP($id, $rm->insPicture($race[0]->tgalid,str_replace("../","",$name)));
		} else {
			return "NAK";
		};
	}
	return "OK";
}


function printSUProtIN($opt){
	$rm = new raceManager;
	$rcm = new RacerManager;
	$tr = new TRManager;

	$race = $rm->getRace($_SESSION["params"]["r"],"","","","","","");
	
	$trs = $rcm->getACCTeamRace($race[0]->getID(),$opt,"","");
	
	$cp = $rm->getChPoint("",$race[0]->getID(),"","");

	echo "<form action=\"index.php\" method=\"post\"> ";
	echo "<table border =\"1\">";

	$i=0;
	while($cp[$i]){
		if ((strtoupper(substr($cp[$i]->getName(),0,2))=="SU") and ($rm->getChpDet("",$opt,$cp[$i]->getId())) ){
			echo "<tr><td><table border = \"1\">";
			echo "<tr><td colspan = \"4\">",$cp[$i]->getName()," - ",$cp[$i]->getCost();
			echo "<tr><td>Komanda<td>Starts<td>Finišs<td>Punkti";

			$j=0;
			while(isset($trs[$j])){
			
				$team = $rcm->getTeam($trs[$j]->getTeamID(),"",0,"");
				echo "<tr><td>",$team[0]->getName();

				$trsu = $tr->getTRSU("",$trs[$j]->getTRID(),$cp[$i]->getID());

				echo "<td><input type=\"text\" value=\"";
				if ($trsu){echo $trsu[0]->getStart();} else {echo "0000-00-00 00:00:00";}
				echo"\" name = ",$trs[$j]->getTRID(),"TRSUSTART",$cp[$i]->getID()," > ";
				echo "<td><input type=\"text\" value=\"";
				if ($trsu){echo $trsu[0]->getFin();} else {echo "0000-00-00 00:00:00";}
				echo"\" name = ",$trs[$j]->getTRID(),"TRSUFIN",$cp[$i]->getID()," > ";
				echo "<td><input type=\"text\" value=\"";
				if ($trsu){echo $trsu[0]->getPts();}
				echo"\" name = ",$trs[$j]->getTRID(),"TRSUPTS",$cp[$i]->getID()," > ";
				$j++;
			}
			echo "</table>";
		}
		$i++;
	}
	echo "</table>";
	echo "<input type=\"hidden\" name=\"rm_func\" value=\"teamrace\"> ";
	echo "<input type=\"hidden\" name=\"rm_subf\" value=\"savetrsu\">";
	echo "<input type=\"hidden\" name = \"opt\" value=\"$opt\">";
	echo "<input type=\"hidden\" name = \"r\" value=\"",$_SESSION['params']['r'],"\">";
		
	echo "<hr><center><input type=\"submit\" value=\"Saglabāt\" ></center>";
	echo "</form>";
}
function printSUProtOUT($opt){
	$rm = new raceManager;
	$rcm = new RacerManager;
	$tr = new TRManager;

	$race = $rm->getRace($_SESSION["params"]["r"],"","","","","","");
	$trs = $rcm->getACCTeamRace($race[0]->getID(),$opt,"","");
	
	$cp = $rm->getChPoint("",$race[0]->getID(),"","");

	
	echo "<table border =\"1\">";

	$i=0;
	while($cp[$i]){
		if ((strtoupper(substr($cp[$i]->getName(),0,2))=="SU") and ($rm->getChpDet("",$opt,$cp[$i]->getId())) ){
			echo "<tr><td><table border = \"1\">";
			echo "<tr><td colspan = \"5\">",$cp[$i]->getName()," - ",$cp[$i]->getCost();
			echo "<tr><td>Komanda<td>Starts<td>Finišs<td>Punkti<td>Laiks";

			$j=0;
			while(isset($trs[$j])){
			
				$team = $rcm->getTeam($trs[$j]->getTeamID(),"",0,"");
				echo "<tr><td>",$team[0]->getName();

				$trsu = $tr->getTRSU("",$trs[$j]->getTRID(),$cp[$i]->getID());
				if($trsu){
					echo "<td>"; echo $trsu[0]->getStart();				
					echo "<td>"; echo $trsu[0]->getFin();				
					echo "<td>"; echo $trsu[0]->getPts();
					
					$s = strtotime($trsu[0]->getStart());					
					$f = strtotime($trsu[0]->getFin());
					
					$h = floor((floor((($s-$f)* -1)/60))/60);
					$m = floor((($s-$f)* -1)/60) - $h*60;
					$sec = ($s - $f) * -1 - $h*60*60 - $m*60;
					echo "<td>$h:";if ($m < 10) {echo 0;} echo "$m:";if ($sec < 10) {echo 0;} echo "$sec";
					
				} else {
					echo "<td>&nbsp<td>&nbsp<td>&nbsp<td>&nbsp";
				}
				
				$j++;
			}
			echo "</table>";
		}
		$i++;
	}
	echo "</table>";
	

}
function suProtsave($opt){
	$rm = new raceManager;
	$rcm = new RacerManager;
	$tr = new TRManager;

	$race = $rm->getRace($_SESSION['params']['r'],"","","","","","");
	$trs = $rcm->getACCTeamRace($race[0]->getID(),$opt,"","");
	
	$cp = $rm->getChPoint("",$race[0]->getID(),"","");
	
	$i=0;
	while($cp[$i]){
		if ((strtoupper(substr($cp[$i]->getName(),0,2))=="SU") and ($rm->getChpDet("",$opt,$cp[$i]->getId())) ){

			$j=0;
			while($trs[$j]){
				
				$tr->clearTRSU($trs[$j]->getTRID(),$cp[$i]->getId());

				if (($_POST[$trs[$j]->getTRID()."TRSUSTART".$cp[$i]->getId()]!= "") 
						or ($_POST[$trs[$j]->getTRID()."TRSUFIN".$cp[$i]->getId()]!="") 
						or ($_POST[$trs[$j]->getTRID()."TRSUPTS".$cp[$i]->getId()]!="")){
					$tr->insTRSU($trs[$j]->getTRID(),$_POST[$trs[$j]->getTRID()."TRSUSTART".$cp[$i]->getId()],
					$_POST[$trs[$j]->getTRID()."TRSUFIN".$cp[$i]->getId()],
					($_POST[$trs[$j]->getTRID()."TRSUPTS".$cp[$i]->getId()]=="")?0:$_POST[$trs[$j]->getTRID()."TRSUPTS".$cp[$i]->getId()],
					$cp[$i]->getId());
				}

				$j++;
			}
		}
		$i++;
	}
}

function sfProtsave($opt){

$rm = new raceManager;
	$rcm = new RacerManager;
	$tr = new TRManager;
	//$tm = new teamManager;

	$race = $rm->getRace($_SESSION['params']['r'],"","","","","","");
	$trs = $rcm->getACCTeamRace($race[0]->getID(),$opt,"","");

	$sf = $rm->getSF("",$race[0]->getId());
	$i=0;
	while ($sf[$i]){
		if ($sf[$i]->hasDet($opt)){
			$j=0;
			while($trs[$j]){
				$tr->delTRSF2($trs[$j]->getTRID(),$sf[$i]->getId());

				if ($_POST[$trs[$j]->getTRID()."trsf".$sf[$i]->getId()] <> "" ){
					$tr->insTRSF($sf[$i]->getId(),$trs[$j]->getTRID(),$_POST[$trs[$j]->getTRID()."trsf".$sf[$i]->getId()]);
				}
				$j++;	
			}
			
		}
		$i++;
	}
	
}
function printSFProtIn($opt){

	$rm = new raceManager;
	$rcm = new RacerManager;
	$tr = new TRManager;
	

	$race = $rm->getRace($_SESSION["params"]["r"],"","","","","","");
	$trs = $rcm->getACCTeamRace($race[0]->getID(),$opt,"","");

	$sf = $rm->getSF("",$race[0]->getId());
	echo "<form action=\"index.php\" method=\"post\">";
	echo "<table border =\"1\"><tr>";

	$i=0;
	while ($sf[$i]){
		if ($sf[$i]->hasDet($opt)){
		echo "<td><table border = \"1\">";
			echo "<tr><td colspan = \"2\">",$sf[$i]->getName();
			$j=0;
			while($trs[$j]){
				$team = $rcm->getTeam($trs[$j]->getTeamID(),"",0,"");
				echo "<tr><td>",$team[0]->getName();
				echo "<td><input type=\"text\" ";
				$trsf = $tr->getTRSF("",$sf[$i]->getId(),$trs[$j]->getTRID());
				if($trsf){
					echo " value = \"",$trsf[0]->getFin(),"\"";
				} else {
					echo " value = \"0000-00-00 00:00:00\"";
				}
				echo " name =\"",$trs[$j]->getTRID(),"trsf",$sf[$i]->getId(),"\">";
				$j++;
			}
			echo "</table>";
		}
		$i++;
	}
	echo "</table>";
	
	echo "<input type=\"hidden\" name=\"rm_func\" value=\"teamrace\"> ";
	echo "<input type=\"hidden\" name=\"rm_subf\" value=\"savetrsf\">";
	echo "<input type=\"hidden\" name = \"opt\" value=\"$opt\">";
	echo "<input type=\"hidden\" name = \"r\" value=\"",$_SESSION['params']['r'],"\">";
		
	echo "<hr><center><input type=\"submit\" value=\"Saglabāt\" ></center>";
	echo "</form>";
}
function printSFProtOut($opt){

	$rm = new raceManager;
	$rcm = new RacerManager;
	$tr = new TRManager;
	//$tm = new teamManager;

	$race = $rm->getRace($_SESSION["params"]["r"],"","","","","","");
	$trs = $rcm->getACCTeamRace($race[0]->getID(),$opt,"","");

	$sf = $rm->getSF("",$race[0]->getId());
	
	echo "<table border =\"1\"><tr>";

	$i=0;
	while ($sf[$i]){

		

		if ($sf[$i]->hasDet($opt)){
		echo "<td><table border = \"1\">";
			echo "<tr><td colspan = \"2\">",$sf[$i]->getName();
			$j=0;
			while($trs[$j]){
				$team = $rcm->getTeam($trs[$j]->getTeamID(),"",0,"");
				echo "<tr><td>",$team[0]->getName();
				echo "<td width=\"200\">";
				
				$trsf = $tr->getTRSF("",$sf[$i]->getId(),$trs[$j]->getTRID());
				if($trsf){
					echo $trsf[0]->getFin();
				} else {
					echo "&nbsp";
				}
				
				$j++;
			}
			echo "</table>";
		}

		

		$i++;
	}
	echo "</table>";
	
	
}


function printMainProt($opt){
	printAactualRaceMenu(1);
	$rm = new raceManager;
	$cm = new champManager;
	
	if (!$opt){
		$r=$rm->getRace("","","",1,"",1,0);
		if(!$r){echo "<h1 style=\"color:red\"><center>Nevienas sacensības nav izvēlētas!</center></h1>";return;}
		$opt = $r[0]->getID();
	}
	echo "<h1>Starta - finiša protokoli</h1>";
	$cl = $cm->getActulaRaceClass($r[0]->getID());
	$i=0;
	echo "Ievade";
	while($cl[$i]){

		echo "<a href=\"index.php?rm_func=teamrace&rm_subf=sfin&r=$opt&opt=",$cl[$i]->getID(),"\"> " , $cl[$i]->getName(),"</a> ";
		if ($i <> sizeof($cl)-1){echo " | ";}

		$i++;
	}
	echo "<br>";
	$i=0;
	echo "Apskatīšana";
	while($cl[$i]){

		echo "<a href=\"index.php?rm_func=teamrace&rm_subf=sfout&r=$opt&opt=",$cl[$i]->getID(),"\"> " , $cl[$i]->getName(),"</a> ";
		if ($i <> sizeof($cl)-1){echo " | ";}

		$i++;
	}
	
	echo "<h1>SU protokoli</h1>";
	$i=0;
	echo "Ievade";
	while($cl[$i]){

		echo "<a href=\"index.php?rm_func=teamrace&rm_subf=suin&r=$opt&opt=",$cl[$i]->getID(),"\"> " , $cl[$i]->getName(),"</a> ";
		if ($i <> sizeof($cl)-1){echo " | ";}

		$i++;
	}
	echo "<br>";
	$i=0;
	echo "Apskatīšana";
	while($cl[$i]){

		echo "<a href=\"index.php?rm_func=teamrace&rm_subf=suout&r=$opt&opt=",$cl[$i]->getID(),"\"> " , $cl[$i]->getName(),"</a> ";
		if ($i <> sizeof($cl)-1){echo " | ";}

		$i++;
	}
	

}

function savetrpen($opt){
	$trm = new TRManager;	
	if ($opt){
		$trm->saveTRPen($opt,$_POST['tr'],$_POST['pen'],$_POST['com']);
	} else {
		$trm->insTRPen($_POST['tr'],$_POST['pen'],$_POST['com']);	
	}
}

function deltrpen($opt){
	$trm = new TRManager;
	$trm->delTRPen($opt);
}

function newtrpen($opt){
	echo "<form enctype=\"multipart/form-data\" action=\"index.php\" method=\"post\">";
		
		echo "<table width =\"100%\" border = \"1\">";
	
		echo "<tr class=\"newtitle\">";
		echo "<td>Punkti:<input type=\"text\" name = \"pen\" >";
		echo "<td>Par ko:<input type=\"text\" name = \"com\" >";
		echo "</table> ";
		echo "<input type=\"hidden\" name=\"rm_func\" value=\"teamrace\"> ";
		echo "<input type=\"hidden\" name=\"rm_subf\" value=\"savetrpen\">";
		echo "<input type=\"hidden\" name = \"tr\" value=\"$opt\">";
		echo "<hr><center><input type=\"submit\" value=\"Saglabāt\" ></center>";
	echo "</form>";
}

function trpen($opt){
	$trm = new TRManager;
	$list=$trm->getTRPen("",$opt);
	echo "<form action=\"index.php\" method=\"post\">";
		echo "<input type=\"hidden\" name=\"rm_func\" value=\"teamrace\"> ";
		echo "<input type=\"hidden\" name=\"rm_subf\" value=\"newtrpen\"> ";
		echo "<center><input type=\"submit\" value=\"Jauns\"> </center>";
		echo "<input type=\"hidden\" name = \"opt\" value=\"$opt\">";
	echo "</form><hr>";
	
	
	echo "<table width=\"100%\" border=\"1\">";
	echo "<tr class=\"title\"><td width=\"100\">&nbsp<td width=\"50\">Pukti<td>Par ko";
	
	for($i=0;$i<count($list);$i++){
		echo "<tr>";
		echo "<td>";
			echo "<input type=\"button\" value=\"Dzēst\" onclick=\"confDel('form".$list[$i]->getId()."','Tiešām dzēst?')\">";
			echo "<form action=\"index.php\" method=\"post\" id=\"form".$list[$i]->getId()."\">";
				echo "<input type=\"hidden\" name=\"rm_func\" value=\"teamrace\"> ";
				echo "<input type=\"hidden\" value=\"deltrpen\" name=\"rm_subf\">";
				echo "<input type=\"hidden\" name = \"tr\" value=\"$opt\">";
				echo "<input type=\"hidden\" value=\"".$list[$i]->getId()."\" name = \"opt\">";
			echo "</form>";
		echo "<td>",$list[$i]->getPen();
		echo "<td>",$list[$i]->getCom();
	}
	
	echo "</table>";
	echo "<hr><form action=\"index.php\" method=\"post\">";
		echo "<input type=\"hidden\" name=\"rm_func\" value=\"teamrace\"> ";
		echo "<input type=\"hidden\" name=\"rm_subf\" value=\"newtrpen\"> ";
		echo "<center><input type=\"submit\" value=\"Jauns\"> </center>";
		echo "<input type=\"hidden\" name = \"opt\" value=\"$opt\">";
	echo "</form>";
}

function doverttr($opt){
	$trm = new TRManager;
	$rm = new raceManager;
	$rcm =  new RacerManager;
	$cm = new champManager;
	
	$cp = $trm->getTRKP("",$opt,"","","",1);
	$tmr = $rcm->getTeamRace($opt,"","","");
	$tm= $rcm->getTeam($tmr[0]->getTeamID(),"","","");
	
	
	
	echo "<h1 style=\"text-align:center\">",$tm[0]->getName(),"</h1>";
	
	echo "<form action=\"index.php\" method=\"post\">";
	echo "<table width=\"100%\" border=\"1\">";
	for($i=0;$i<count($cp);$i++){
		$item = $rm->getChPoint($cp[$i]->getCpId(),"","","");
		if (strtoupper(substr($item[0]->getName(),0,2))!="SU"){
			echo "<tr><td rowspan=\"2\">";
			echo "<h1 style=\"color:blue\" >",$item[0]->getName(),$item[0]->getCost(),"</h1>";
			
			echo "<td colspan=\"3\">","<a class=\"img\"href=\"",$item[0]->getImage(),"\" target=\"_blank\"><img src=\"",$item[0]->getImage(),"\"  width=\"400\" border =\"0\"></a>";
								
							switch($cp[$i]->getIok() ){
								case 0:
									$style = "class=\"inp2\" value=\"X\"";
									break;
								case 1:
									$style = "class=\"inp3\" value=\"OK\"";
									break;
								case 2:
									$style = "class=\"inp4\" value=\"???\"";
									break;
							}

			
			
				
						echo "<td>";
							echo "<input type=\"text\" name=\"iok",$cp[$i]->getId(),"\" id=\"iok",$cp[$i]->getId(),"\" $style readonly=\"readonly\" onclick=\"return swBox('iok",$cp[$i]->getId(),"')\" />";
					echo "<hr>";	
						echo "<center>";
							if($cp[$i]->galid){
								echo "<img title=\"Ir ielikts galerijā\" src=\"./images/thumb_up_green_24x24.png\" onclick=\"sendToGal(this,",$cp[$i]->getId(),")\">";
							} else {
								echo "<img title=\"Nav ielikts galerijā\" src=\"./images/thumb_dn_red_24x24.png\" onclick=\"sendToGal(this,",$cp[$i]->getId(),")\">";
							}
						echo "</center>";	
			
		
			
			echo "<td>","<a class=\"img\"href=\"",$cp[$i]->getImage(),"\" target=\"_blank\"><img src=\"",$cp[$i]->getImage(),"\"  width=\"400\" border =\"0\"></a>";

			echo "<tr><td>",$item[0]->getDescr(),"<hr>",$item[0]->getQuest();
			echo "<td>",$item[0]->getAnsw(),"<td>";
			
			$cpd = $rm->getChpDet("",$tmr[0]->getCID(),$cp[$i]->getCpId());
			$pt  = $cm->getPTask($cpd[0]->getDiff());
			echo "<b style=\"color:green\">",$pt[0]->getName(),"</b>";
			
			
			
			switch($cp[$i]->getAok() ){
				case 0:
					$style = "class=\"inp2\" value=\"X\"";
					break;
				case 1:
					$style = "class=\"inp3\" value=\"OK\"";
					break;
				case 2:
					$style = "class=\"inp4\" value=\"???\"";
					break;
			} 
			
			echo "<td><input type=\"text\" name=\"aok",$cp[$i]->getId(),"\" id=\"aok",$cp[$i]->getId(),"\" $style readonly=\"readonly\" onclick=\"return swBox('aok",$cp[$i]->getId(),"')\" />";
		
			
			echo "<td align=\"center\"><b>",$cp[$i]->getAnswer(),"</b>";
		
		}
	}
	echo "</table>";
		echo "<hr>";
		echo "<input type=\"hidden\" name=\"rm_func\" value=\"teamrace\"> ";
		echo "<input type=\"hidden\" name = \"opt\" value=\"$opt\">";
		echo "<input type=\"hidden\" name=\"rm_subf\" value=\"saveverttr\">";	
		echo "<hr><center><input type=\"submit\" value=\"Saglabāt\" ></center>";
	echo "</form>";
}

function saveverttr($opt){
	$trm = new TRManager;
	$rcm = new RacerManager;
	$rm = new raceManager;
	
	$cp = $trm->getTRKP("",$opt,"","","",1);
	for($i=0;$i<count($cp);$i++){
		
		$iok=0;
		switch($_POST["aok".$cp[$i]->getId()]){
			case "OK":
				$aok=1;
				break;
			case "X":
				$aok=0;
				break;
			case "???":					
				$aok=2;
				break;
		}		
		$iok=0;
		switch($_POST["iok".$cp[$i]->getId()]){
			case "OK":
				$iok=1;
				break;
			case "X":
				$iok=0;
				break;
			case "???":					
				$iok=2;
				break;
		}
		
		$trm->updKP_Ties($cp[$i]->getId(),$aok,$iok);
	}
	$trm->ClosetTR($opt);
	
	$tr = $rcm->getTeamRace($opt,"","","");		
	$rcs = $rcm->getTeamRacer("","",$tr[0]->getTeamId(),"");
	
	$race = $rm->getRace($tr[0]->rid,"","","","","","");
	$text = str_replace("{race}",$race[0]->getName(),TR_VERT_END);	
	
	echo "racers: ",count($rcs);
	
	for($i = 0; $i < count($rcs);$i++){
		$d = $rcs[$i]->getRacerDet();		
		if ($d[0]->allowemails){
			sendMail($d[0]->mail,"","Vērtēšana Piedzīvojumu enduro sacensībās \"".$race[0]->getName()."\"",$text);
		}		
	}
	
}

function retTR($opt){
	$trm = new TRManager;
	$trm->retTR($opt);
}

function trvert($opt){
	printAactualRaceMenu(1);
	
	$rcm = new raceManager;
	$rcr = new RacerManager;
	$cm = new champManager;
	$trm = new TRManager;
	if (!$opt){
		$r=$rcm->getRace("","","","","",1,0);
		if (!$r){
			echo "<h1 style=\"color:red\"><center>Nevienas sacensības nav izvēlētas!</center></h1>";
			return;
		}
		$opt = $r[0]->getID();
	}
	
	$cl = $cm->getActulaRaceClass($r[0]->getID());
	for($x=0;$x<count($cl);$x++){
		echo "<b style=\"font-size:25\">",$cl[$x]->getName(),"</b> klase";
		$tr = $rcr->getACCTeamRace($opt,$cl[$x]->getID(),"",1);
		
		echo "<table width =\"100%\" border = \"1\">";
		echo "<tr class=\"title\"><td width=\"20\">N p/k<td width=\"200\">&nbsp<td>Komanda";
		$i=0;
		while (isset($tr[$i]) ){	
		
			echo "<tr><td align = \"center\">",$i+1;
			echo "<td width=\"200\"><table border=\"0\" width=\"100%\"><tr><td>";
			
			echo "<form action=\"index.php\" method=\"post\">";
				echo "<input type=\"hidden\" name=\"rm_func\" value=\"teamrace\"> ";
				echo "<input type=\"submit\" value=\"Vertēt\" >";		
				echo "<input type=\"hidden\" value=\"doverttr\" name=\"rm_subf\">";
				echo "<input type=\"hidden\" value=\"".$tr[$i]->getTRID()."\" name = \"opt\">";				
			echo "</form>";
			echo "<td>";
			echo "<input type=\"button\" value=\"Atgriezt\" onclick=\"confDel('form",$tr[$i]->getTRID(),"','Tiešām atgriezt?')\"></center>";
			echo "<form action=\"index.php\" method=\"post\" id=\"form",$tr[$i]->getTRID(),"\">";
				echo "<input type=\"hidden\" name=\"rm_func\" value=\"teamrace\"> ";
				echo "<input type=\"hidden\" name = \"opt\" value=\"",$tr[$i]->getTRID(),"\">";
				echo "<input type=\"hidden\" name=\"rm_subf\" value=\"retTR\">";				
			echo "</form>";	
			
			echo "<td >";
			echo "<form action=\"index.php\" method=\"post\">";
				echo "<input type=\"hidden\" name=\"rm_func\" value=\"teamrace\"> ";
				echo "<input type=\"submit\" value=\"Sodi\" >";		
				echo "<input type=\"hidden\" value=\"trpen\" name=\"rm_subf\">";
				echo "<input type=\"hidden\" value=\"".$tr[$i]->getTRID()."\" name = \"opt\">";				
			echo "</form>";
			
			echo "</table>";
				
			$tm = $rcr->getTeam($tr[$i]->getTeamID(),"","","");
			echo "<td ";
			if ($tr[$i]->getClosed()==1){
				echo " style=\"color:green;font-weight:bold\" ";
			}			
			echo ">";
			
			$aps = $trm->TRHasQuest($tr[$i]->getTRID());
			if ($aps){				
				echo " <font style=\"color:red;font-size:20px;font-weight:bold\">!!! $aps punkti nenovērtēti !!! </font>";
			}
			
			echo $tm [0]->getName() ;
			
			$rcrs = Array();			
			$trr= $rcr->getTRRacer($tr[$i]->getTRID());
			for($k=0;$k<count($trr);$k++){
				$item=$rcr->getRacer($trr[$k]->getTRRID(),"","");
				array_push($rcrs,$item[0]);
			}
			
			$p = $rcrs[0];
			$p1 = $rcrs[1];
			
			echo " (",$p->getFname()," ",$p->getLname()," - ",$trr[0]->nr;
			echo "; ",$p1->getFname()," ",$p1->getLname()," - ",$trr[1]->nr;
			echo ") ";

			$i++;
		}
		echo "</table>";
	}
}

function saveKP($opt){
	$trm = new TRManager;
	$rm = new raceManager;
	
	$cp = $trm->getTRKP($opt,"","","","","");
	
	$gid = $cp[0]->galid;
	if (!$_FILES["image"]['tmp_name']){
		if ($cp){
			$_POST["image"] = $cp[0]->getImage();				
		}
	} else {
	echo $_SESSION["params"]["r"];
		$race = $rm->getRace($_SESSION["params"]["r"],"","","","","","");
		$path="Files/RACE/".$race[0]->getCode()."/TEAMS/".$cp[0]->getTrId();
		if(!file_exists($path)){
			mkdir($path);
		}
		$cp1 = $rm->getChPoint($cp[0]->getCpId(),"","","");
		$path = $path."/".date("Y-m-d_H-i-s_").$cp1[0]->getWPName().".jpg";
		imgesize($_FILES["image"]['tmp_name'],$path,800);
		if ($cp){
			@unlink($cp[0]->getImage());				
		}				
		$_POST["image"] = $path;
		$gid = null;		
	}
	$trm->updKP_User($opt,$_SESSION["params"]["answ"],$_POST["image"],$gid);
}

function openKP($opt){
	$rcm = new RacerManager;
	$trm = new TRManager;
	$rm = new raceManager;
	
	$cp = $trm->getTRKP($opt,"","","","","");
	$item= $rm->getChPoint($cp[0]->getCpId(),"","","");
	echo "<form action=\"index.php\" enctype=\"multipart/form-data\" method=\"post\">";
		echo "<input type=\"hidden\" name=\"rm_func\" value=\"teamrace\"> ";
		echo "<input type=\"hidden\" name = \"opt\" value=\"$opt\">";
		echo "<input type=\"hidden\" name=\"rm_subf\" value=\"saveKP\">";	
		echo "<input type=\"hidden\" name=\"r\" value=\"",$_SESSION["params"]["r"],"\">";	
		echo "<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"1000000000\" />";
		
		echo "<table width =\"100%\" border = \"1\">";
			echo "<tr class=\"title\"><td width=\"100\">Nosaukums<td width=\"250\">Jautājums<td>Atblide<td width =\"200\">Bilde";
				echo "<tr><td><font color=\"blue\"><b>",$item[0]->getName(),$item[0]->getCost(),"</b></font>";	
				echo "<td>",$item[0]->getQuest();
				echo "<td><textarea name=\"answ\" rows=\"5\" cols=\"40\">",$cp[0]->getAnswer(),"</textArea>";
				echo "<td>";
				if ($cp[0]->getImage()<>""){
					echo "<a href=\"",$cp[0]->getImage(),"\" target=\"_blank\"><img src=\"",$cp[0]->getImage(),"\" height=\"100\"></a>";
				}
				echo "<br><input type=\"file\" name = \"image\" >";
				
		echo "</table> ";
		echo "<center><font style=\"color:red;font-size:20px;text-weight:bold;\">Uzmanību! </font> Lai paātrinātu bilžu ielādi sistēmā, ieteicams tās iepriekš samāzināt līdz 800x600 izmēram!</center>";
		echo "<hr>";			
					
			
				echo "<center><input type=\"submit\" value=\"Saglabāt\" ></center>";	
	echo "</form>";

}

function compltr($opt){
	$trm = new TRManager;
	$trm->compltr($opt);
}

function printImgInp(){
	printAactualRaceMenu(1);
	
	$rcm = new RacerManager;
	$trm = new TRManager;
	$rm = new raceManager;
	
	$r = $rm->getRace("","","","","",1,0);
	if (!$r){echo prntWarn("Nevienas sacensības nav izvēlētas!"); return;}
	
	$team = $rcm->getTeam("",$_SESSION["user_id"],1,"");	
	if(!$team){echo prntWarn("Jūs neesat komandā!"); return;}
	$tr = $rcm->getTeamRace("",$team[0]->getID(),$r[0]->getId(),"");
	
	if(!$tr){echo prntWarn("Šīm sacensībām jūs nebijāt pieteikušies!");return;}
	
	$cp = $trm->getTRKP("",$tr[0]->getTRID(),"","","",1);
	if ($tr[0]->getComp()==0){
		echo "<center><font style=\"color:red;font-size:20px;text-weight:bold;\">Uzmanību! </font> Lai paātrinātu bilžu ielādi sistēmā, ieteicams tās iepriekš samāzināt līdz 800x600 izmēram!</center>";
		echo "<hr>";
	}
	echo "<table width=\"100%\" border = \"1\">";
	echo "<tr class=\"title\">";
	if ($tr[0]->getComp()==0){echo "<td width=\"70\">&nbsp";}
	echo"<td width=\"100\">Nosaukums<td width=\"250\">Jautājums<td>Atblide<td width =\"200\">Bilde";
	if ($tr[0]->getComp()==1){
		echo "<td>Īstā bilde";
	}
	
	for($i=0;$i<count($cp);$i++){
		$item = $rm->getChPoint($cp[$i]->getCpId(),"","","");
		if (strtoupper(substr($item[0]->getName(),0,2))!="SU"){
			echo "<tr>";
			if ($tr[0]->getComp()==0){
				echo "<td width=\"70\"><form action=\"index.php\" method=\"post\">";
					echo "<input type=\"hidden\" name=\"rm_func\" value=\"teamrace\"> ";
					echo "<input type=\"hidden\" name = \"opt\" value=\"",$cp[$i]->getId(),"\">";
					echo "<input type=\"hidden\" name=\"rm_subf\" value=\"openKP\">";	
					echo "<input type=\"hidden\" name=\"r\" value=\"",$r[0]->getId(),"\">";	
					echo "<center><input type=\"submit\" value=\"Atvērt\" ></center>";
				echo "</form>";
			} 
			echo "<td align=\"center\"><b style=\"color:blue;font-size:20\">",$item[0]->getName(),$item[0]->getCost(),"</b>";
			echo "<td>",$item[0]->getQuest();
			echo "<td>",$cp[$i]->getAnswer();
			echo "<td><a href=\"",$cp[$i]->getImage(),"\" target=\"_blank\"><img src=\"",$cp[$i]->getImage(),"\" height=\"100\"></a>";
			
			if ($tr[0]->getComp()==1){
				
				echo "<td><a href=\"",$item[0]->getImage(),"\" target=\"_blank\"><img src=\"",$item[0]->getImage(),"\" height=\"100\"></a>";
			}	
		}
		
	}
	echo "</table>";
	
	if ($tr[0]->getComp()==0){
		echo "<hr><center><font style=\"color:red;font-size:20px;text-weight:bold;\">Uzmanību! </font> Lai paātrinātu bilžu ielādi sistēmā, ieteicams tās iepriekš samāzināt līdz 800x600 izmēram!";
		echo "<hr>";
		echo "Ar šo Tu apstiprini, ka esi VISUS savus kontrolpunktus apstrādājis un iesniedz tos tiesnešiem vērtēšanai. Pēc pogas \"Nosūtīt tiesnešiem\" nospiešanas labot tos <b>vairs NEVARĒSI!</b> <br>";
		echo "<input type=\"button\" value=\"Nosūtīt tiesnešiem\" onclick=\"confDel('formX','Tiešām nosūtīt?')\"></center>";
		

		echo "<form action=\"index.php\" method=\"post\" id=\"formX\">";
			echo "<input type=\"hidden\" name=\"rm_func\" value=\"teamrace\"> ";
			echo "<input type=\"hidden\" name = \"opt\" value=\"",$tr[0]->getTRID(),"\">";
			echo "<input type=\"hidden\" name=\"rm_subf\" value=\"compltr\">";				
		echo "</form>";			
	} 
	
}

function saveTRKP($opt){
	$rm = new raceManager;
	$trm= new TRManager;
	$rcm= new RacerManager;
	
	$cp = $rm->getActRaceChPoint("");
	
	for($i=0;$i<count($cp);$i++){
		$trcp = $trm->getTRKP("",$opt,"","",$cp[$i]->getID(),"");		
		if($trcp){
			$x = 1;
			if ($_POST["iok".$cp[$i]->getID()] == "V"){$x=0;}
			$trm->selTRKP($trcp[0]->getId(),$x);
		} else {
			if($_POST["iok".$cp[$i]->getID()]=="V"){
				$trm->insTRKP($opt,$cp[$i]->getID());	
			}		
			
		}
	}
	
	$tr = $rcm->getTeamRace($opt,"","","");		
	$rcs = $rcm->getTeamRacer("","",$tr[0]->getTeamId(),"");
	
	$race = $rm->getRace($tr[0]->rid,"","","","","","");
	$text = str_replace("{race}",$race[0]->getName(),TR_CHP_ACCEPT);	
	
	echo "racers: ",count($rcs);
	
	for($i = 0; $i < count($rcs);$i++){
		$d = $rcs[$i]->getRacerDet();		
		if ($d[0]->allowemails){
			sendMail($d[0]->mail,"","Vērtēšana Piedzīvojumu enduro sacensībās \"".$race[0]->getName()."\"",$text);
		}		
	}	
	
	
}

function printInpCp($opt){
	$rm = new raceManager;
	$trm = new TRManager;
	$trc = new RacerManager;
	$tr = $trc->getTeamRace($opt,"","","");
	
	$cp = $rm->getActRaceClassCPoint($tr[0]->getRID(),$tr[0]->getCID());
	
	echo "<form action=\"index.php\" method=\"post\"><table border=\"1\" width=\"100%\">";
	$col=0;
	for($i=0;$i<count($cp);$i++){
		if ($col==5){$col=0;}
		if ($col==0){
			echo "<tr>";
		}
		
		echo "<td width=\"",100/(5),"%\"><table width=\"100%\" border = \"0\"><tr>";
		echo "<td  width=\"100\" align=\"center\" valign=\"middle\">";		
		echo "<h1 style=\"color:blue;font-size:24px\" >",$cp[$i]->getName(),$cp[$i]->getCost(),"</h1>";
		echo "<td width=\"50\">";
		if($trm->getTRKP("",$opt,"","",$cp[$i]->getID(),1)){
			$style = "class=\"inp3\" value=\"V\"";
		} else {
			$style = "class=\"inp2\" value=\"X\"";
		}
			
		echo "<input type=\"text\" name=\"iok",$cp[$i]->getID(),"\" id=\"iok",$cp[$i]->getID(),"\" $style readonly=\"readonly\" onclick=\"return cpACC('iok",$cp[$i]->getID(),"')\" />";
		
		
		echo "</table>";
		$col++;
	}
	echo "</table>";
	
	echo "<input type=\"hidden\" name=\"rm_func\" value=\"teamrace\"> ";
	echo "<input type=\"hidden\" name = \"opt\" value=\"$opt\">";
	echo "<input type=\"hidden\" name=\"rm_subf\" value=\"savetrkp\">";	
	echo "<hr><center><input type=\"submit\" value=\"Saglabāt\" ></center>";
	echo "</form>";
	
}

function listTR($opt){
	printAactualRaceMenu(1);
	
	$rcm = new raceManager;
	$rcr = new RacerManager;
	$cm = new champManager;
	
	if (!$opt){
		$r=$rcm->getRace("","","","","",1,0);
		if (!$r){
			echo "<h1 style=\"color:red\"><center>Nevienas sacensības nav izvēlētas!</center></h1>";
			return;
		}
		$opt = $r[0]->getID();
	}
	
	$cl = $cm->getActulaRaceClass($r[0]->getID());
	for($x=0;$x<count($cl);$x++){
		echo "<b style=\"font-size:25\">",$cl[$x]->getName(),"</b> klase";
		$tr = $rcr->getACCTeamRace($opt,$cl[$x]->getID(),"",0);
	
		echo "<table width =\"100%\" border = \"1\">";
		echo "<tr class=\"title\"><td width=\"20\">N p/k<td width=\"100\">&nbsp<td>Komanda";
		$i=0;
		while (isset($tr[$i]) ){
			echo "<tr><td align = \"center\">",$i+1;
			echo "<td >";
			
			echo "<form action=\"index.php\" method=\"post\">";
					echo "<input type=\"hidden\" name=\"rm_func\" value=\"teamrace\"> ";
					echo "<input type=\"submit\" value=\"Akceptēt\" >";		
					echo "<input type=\"hidden\" name=\"rm_subf\" value=\"chpinp\" >";
					echo "<input type=\"hidden\" value=\"".$tr[$i]->getTRID()."\" name = \"opt\">";				
			echo "</form>";
		
			$tm = $rcr->getTeam($tr[$i]->getTeamID(),"","","");
			echo "<td ";
			if ($tr[$i]->getCNT()>0){
				echo " style=\"color:blue;font-weight:bold\" ";
			}
			
			echo ">". $tm [0]->getName() ;
			
			$rcrs = Array();			
			$trr= $rcr->getTRRacer($tr[$i]->getTRID());
			for($k=0;$k<count($trr);$k++){
				$item=$rcr->getRacer($trr[$k]->getTRRID(),"","");
				array_push($rcrs,$item[0]);
			}
			
			$p = $rcrs[0];
			$p1 = $rcrs[1];
			
			echo " (",$p->getFname()," ",$p->getLname()," - ",$trr[0]->nr;
			echo "; ",$p1->getFname()," ",$p1->getLname()," - ",$trr[1]->nr;
			echo ") ";
			
			echo $tr[$i]->getCNT()," KP (",$tr[$i]->getSUM()," punkti)";
			
			$i++;
		}
		echo "</table>";
	}
	
}

?>