<?php
class Champ{
	public $id;
	public $name;
	public $year;
	public $rules;
	public $notes;
	public $type;
	
	public function getID(){
		return $this->id;
	}
	public function getName(){
		return $this->name;
	}
	public function getYear(){
		return $this->year;
	}
	public function getRules(){
		return $this->rules;
	}
	public function getNotes(){
		return $this->notes;
	}
	public function getType(){
		return $this->type;
	}
	
	public Function setId($value){
		$this->id = $value;
	}
	public Function setName($value){
		$this->name = $value;
	}
	public Function setYear($value){
		$this->year = $value;
	}
	public Function setRules($value){
		$this->rules = $value;
	}
	public Function setNotes($value){
		$this->notes = $value;
	}
	public Function setType($value){
		$this->type = $value;
	}
}
class RClass{
	private $id;
	private $name;
	private $code;
	private $type;
	private $WEIGHT;
	
	public function setId($value){
		$this->id = $value;
	}
	public function setName($value){
		$this->name = $value;
	}
	public function getId(){
		return $this->id;
	}
	public function getName(){
		return $this->name;
	}
	
	public function getCode(){
		return $this->code;
	}
	public function setCode($value){
		$this->code = $value;
	}
	
	public function getType(){
		return $this->type;
	}
	public function setType($value){
		$this->type = $value;
	}
	
	public function getWeight(){
		return $this->WEIGHT;
	}
	public function setWeight($value){
		$this->WEIGHT = $value;
	}
}
class PTask{
	private $id;
	private $name;
	
	public function setId($value){
		$this->id = $value;
	}
	public function setName($value){
		$this->name = $value;
	}
	public function getId(){
		return $this->id;
	}
	public function getName(){
		return $this->name;
	}

}
class Country{
	private $id;
	private $name;
	private $code;
	private $order;
	public function setId($value){
		$this->id = $value;
	}
	public function setName($value){
		$this->name = $value;
	}
	public function getId(){
		return $this->id;
	}
	public function getName(){
		return $this->name;
	}
	
	public function getCode(){
		return $this->code;
	}
	public function setCode($value){
		$this->code = $value;
	}
	public function getOrder(){
		return $this->order;
	}
	public function setOrder($value){
		$this->order = $value;
	}
}

class champManager{
	public function getChamps($id,$name,$year,$type) {
		
		
		$sql = "SELECT * FROM d_champ";
		$where = "";
		if ($id <> "") {$where = "ch_id = '$id'";}
		if ($name <> "") {
			if ($where <> "") { $where = "$where and";}
			$where = "$where name = '$name'";
		}
		if($year<>""){
			if ($where <> "") { $where = "$where and";}
			$where = "$where year = '$year'";
		}
		if($type){
			if ($where <> "") { $where = "$where and";}
			$where = "$where `type` = $type";			
		}
		if ($where <> "") {$sql = "$sql where $where order by `year` desc";}		
		
			
			
		$q_result = queryDB($sql);		
		
		$reslt = array();		
		 while ($row = mysql_fetch_array($q_result, MYSQL_ASSOC)) {
			
			$item = new Champ;
			
			$item->setId($row[CH_ID]);
			$item->setName($row[NAME]);
			$item->setYear($row[YEAR]);						
			$item->setNotes($row[NOTES]);						
			$item->setRules($row[RULES]);						
			$item->setType($row[TYPE]);	
			
			array_push($reslt,$item);
		}

		return $reslt;
	}
	public function insChamp($name,$year,$notes,$rules,$type){
		
		$sql = "INSERT INTO `d_champ` (`name` ,`year` ,`notes`,`rules`,`type` )VALUES ('$name', '$year', '$notes','$rules',$type);";
		
		$q_result = queryDB($sql);
		
		
	}
	public function saveChamp($id,$name,$year,$notes,$rules,$type){
		
		$sql = "UPDATE `d_champ` SET `name` = '$name',`year` = '$year',`notes` = '$notes',`rules` = '$rules',`type` = $type where `ch_id` = $id;";
		$q_result = queryDB($sql);
	}	
	public function delChamp($id){
		
		$sql = "delete from `d_champ` where `ch_id` = '$id';";
		$q_result = queryDB($sql);
	}
	
	public function getClass($id,$t){
				
		$sql = "SELECT * FROM d_class";
		$where = "";
		if ($id <> "") {$where = "ClassID = $id";}
		if ($t <> "") {
			if ($where <> "") {$where = "$where and ";}
			$where = "$where type = $t ";
		}
		if ($where <> "") {$sql = "$sql where $where" ;}			
		$sql =  "$sql order by `WEIGHT` asc";
			
		$q_result = queryDB($sql);
		
		$reslt = array();		
		 while ($row = mysql_fetch_array($q_result, MYSQL_ASSOC)) {
			
			$item = new RClass;
			
			$item->setId($row['ClassID']);
			$item->setName($row['Name']);
			$item->setCode($row['Code']);
			$item->setType($row['TYPE']);
			$item->setWeight($row['WEIGHT']);
			
			array_push($reslt,$item);
		}
		return $reslt;
	}	
	public function getActulaRaceClass($r){
		$sql = "SELECT DISTINCT(cl.`ClassID`),cl.`Name`,cl.`Code` FROM d_class cl
				INNER JOIN `d_raceclass` tr on (tr.`ClassID` = cl.`ClassID`)
				INNER JOIN `d_race` r on (r.`RACE_ID` = tr.`RaceID`)";
		if ($r <> ""){
			$sql = "$sql WHERE r.`RACE_ID` = $r ";
		} else {
			$sql = "$sql WHERE r.`ACTUAL` = 1 ";
		}
		
		
		
		$sql =  "$sql order by cl.`WEIGHT` asc";
			
		$q_result = queryDB($sql);
		
		$reslt = array();		
		 while ($row = mysql_fetch_array($q_result, MYSQL_ASSOC)) {
			
			$item = new RClass;
			
			$item->setId($row[ClassID]);
			$item->setName($row[Name]);
			$item->setCode($row[Code]);
			$item->setType($row[TYPE]);
			$item->setWeight($row[WEIGHT]);
			
			array_push($reslt,$item);
		}
		return $reslt;
	}
	public function insClass($name,$code,$t,$w){
		
		$sql = "INSERT INTO `d_class` (`name`,`code`,`type`,`WEIGHT`)VALUES ('$name','$code',$t,".($w ? $w : "null").");";				
		$q_result = queryDB($sql);
	}
	public function saveClass($id,$name,$code,$w){
		
		$sql = "UPDATE `d_class` SET `name` = '$name',`Code` = '$code',`WEIGHT` = ".($w ? $w : "null")." where `ClassID` = $id;";
		$q_result = queryDB($sql);
	}
	public function delClass($id){
		$sql = "delete from `d_class` where `ClassID` = '$id';";
		$q_result = queryDB($sql);
	}
	
	
	public function getPTask($id){
				
		$sql = "SELECT * FROM d_phototask";
		$where = "";
		if ($id <> "") {$where = "PhotoTaskID = $id";}
		if ($where <> "") {$sql = "$sql where $where";}			
			
		$q_result = queryDB($sql);
		
		$reslt = array();		
		 while ($row = mysql_fetch_array($q_result, MYSQL_ASSOC)) {
			
			$item = new PTask;
			
			$item->setId($row[PhotoTaskID]);
			$item->setName($row[Name]);
			
			array_push($reslt,$item);
		}
		return $reslt;
	}	
	public function getRacePTask($rid){
				
		$sql = "SELECT * FROM `d_phototask` pt
				inner join `d_racephototask` r on (pt.`PhotoTaskID` = r.`PTID`)
				where r.`RaceID` = $rid";
			
		$q_result = queryDB($sql);
		
		$reslt = array();		
		 while ($row = mysql_fetch_array($q_result, MYSQL_ASSOC)) {
			
			$item = new PTask;
			
			$item->setId($row[PhotoTaskID]);
			$item->setName($row[Name]);
			
			array_push($reslt,$item);
		}
		return $reslt;
	}
	
	public function insPTask($name){
		
		$sql = "INSERT INTO `d_phototask` (`name`)VALUES ('$name');";
		$q_result = queryDB($sql);
	}
	public function savePTask($id,$name){
		
		$sql = "UPDATE `d_phototask` SET `name` = '$name' where `PhotoTaskID` = $id;";
		$q_result = queryDB($sql);
	}
	public function delPTask($id){
		$sql = "delete from `d_phototask` where `PhotoTaskID` = '$id';";
		$q_result = queryDB($sql);
	}
	
	public function getCountry(){
				
		$sql = "SELECT * 
				FROM  `phpbb_profile_fields_lang`
				WHERE `field_id` =".KL_COUNT."
				ORDER BY `lang_value` asc
		";
			
		$q_result = queryDB($sql);
		
		$reslt = array();		
		 while ($row = mysql_fetch_array($q_result, MYSQL_ASSOC)) {
			
			$item = new Country;
			
			$item->setId($row[option_id]);
			$item->setName($row[lang_value]);
			
			array_push($reslt,$item);
		}
		return $reslt;
	}	
	public function insCountry($name,$code,$ord){
		
		if (!$ord){$ord= "NULL";}
		$sql = "INSERT INTO `c_country` (`name`,`code`,`oreder`)VALUES ('$name','$code',$ord);";
		
		$q_result = queryDB($sql);
	}
	public function saveCountry($id,$name,$code,$ord){
		if (!$ord){$ord= "NULL";}
		$sql = "UPDATE `c_country` SET `name` = '$name',`Code` = '$code',oreder = $ord where `c_id` = $id;";
		
		$q_result = queryDB($sql);
	}
	public function delCountry($id){
		$sql = "delete from `c_country` where `c_id` = '$id';";
		$q_result = queryDB($sql);
	}
}

function editChamp($subf,$opt){
	switch($subf){
		case "savecountry":
			saveCountry($opt);
			listCountry();
			break;
		case "delcountry";
			delcountry($opt);
			listCountry();
			break;
		case "opencountry":
			openCountry($opt);
			break;
		case "newcountry":
			newCountry();
			break;
		case "countlist":
			listCountry();
			break;
		case "champlist":
			listChamps();
			break;
		case "newchamp":
			printNewChamp();
			break;
		case "savechamp":
			saveChamps($opt);
			listChamps();
			break;
		case "delchamp":
			delChamp($opt);
			listChamps();
			break;
		case "openchamp":
			printEditChamps($opt);
			break;
		case "classlist":
			printClass();
			break;
		case "newclass":
			printNewClass();
			break;
		case "saveclass":
			saveClass($opt);
			printClass();
			break;
		case "delclass":
			delClass($opt);
			printClass();
			break;
		case "openclass":
			printEditClass($opt);
			break;
		case "tasklist":
			printPTask();
			break;
		case "newptask":
			printNewPTask();
			break;
		case "saveptask":
			savePTask($opt);
			printPTask();
			break;
		case "delptask":
			delPTask($opt);
			printPTask();
			break;
		case "openptask":
			printEditPTask($opt);
			break;
		default:
	}
}

function openCountry($opt){
$rm = new champManager;
	
	echo "<form enctype=\"multipart/form-data\" action=\"index.php\" method=\"post\">";
		echo "<input type=\"hidden\" name = \"rm_func\" value=\"champ\"> ";
		echo "<table width =\"100%\" border = \"1\">";
	
			echo "<tr class=\"title\"><td>Nosaukums<td>Kods<td>Secības pazīme";
	
	
		if (isset($opt)){
			$list = $rm->getCountry($opt);
			if ($list){			
				echo "<tr>";
				echo "<td><input type=\"text\" name = \"name\" value=\"".$list[0]->getName()."\">";
				echo "<td><input type=\"text\" name = \"code\" value=\"".$list[0]->getCode()."\">";
				echo "<td><input type=\"text\" name = \"order\" value=\"".$list[0]->getOrder()."\">";
			}
		}
		echo "</table> ";
		echo "<input type=\"hidden\" name = \"opt\" value=\"".$list[0]->getID()."\">";
		echo "<input type=\"hidden\" name = \"rm_subf\" value=\"savecountry\">";
		echo "<hr><center><input type=\"submit\" value=\"Saglabāt\" ></center>";
	echo "</form>";
}

function saveCountry($opt){
	$rm = new champManager;
	
		if (isset($opt)){
			$rm->saveCountry($opt,$_POST["name"],$_POST["code"],$_POST["order"]);
		}else {
			$rm->insCountry($_POST["name"],$_POST["code"],$_POST["order"]);
		}		
	
}

function newCountry(){
	echo "<form action=\"index.php\" method=\"post\">";
		
		echo "<table width =\"100%\" border = \"1\">";
	
		echo "<tr class=\"newtitle\">";
		echo "<td>Nosaukums:<input type=\"text\" name = \"name\" >";
		echo "<td>Kods:<input type=\"text\" name = \"code\" >";
		echo "<td>Secības pazīme:<input type=\"text\" name = \"order\" >";
		
		echo "</table> ";
		echo "<input type=\"hidden\" name = \"rm_func\" value=\"champ\"> ";
		echo "<input type=\"hidden\" name = \"rm_subf\" value=\"savecountry\">";
		echo "<hr><center><input type=\"submit\" value=\"Saglabāt\" ></center>";
	echo "</form>";
}

function delcountry($opt){
	$rm = new champManager;
	$rm->delCountry($opt);
}

function listCountry(){
	$rm = new champManager;
	$list = $rm->getCountry("");
	
	
	
	echo "<form action=\"index.php\" method=\"post\">";
		echo "<input type=\"hidden\" name = \"rm_func\" value=\"champ\"> ";
		echo "<input type=\"hidden\" name = \"rm_subf\" value=\"newcountry\"> ";
		echo "<center><input type=\"submit\" value=\"Jauns\"> </center>";
	echo "</form><hr>";
	
	echo "<table width =\"100%\" border = \"1\">";
	echo "<tr class=\"title\"><td width=\"20\">&nbsp<td>Nosaukums<td>Kods<td>Secības pazīme";
	for($i=0;$i<count($list);$i++){
	
		echo "<tr><td width=\"70\"><table border=\"0\"><tr><td>";
		
		echo "<form action=\"index.php\" method=\"post\">";
				echo "<input type=\"hidden\" name = \"rm_func\" value=\"champ\"> ";
				echo "<center><input type=\"submit\" value=\"Atvērt\" >";		
				echo "<input type=\"hidden\" value=\"opencountry\" name = \"rm_subf\">";
				echo "<input type=\"hidden\" value=\"".$list[$i]->getId()."\" name = \"opt\">";				
		echo "</form>";
		
		
		echo "<input type=\"button\" value=\"Dzēst\" onclick=\"confDel('form".$list[$i]->getId()."','Tiešām dzēst?')\">";
			echo "<td><form action=\"index.php\" method=\"post\" id=\"form".$list[$i]->getId()."\">";
				echo "<input type=\"hidden\" name = \"rm_func\" value=\"champ\"> ";
				echo "<input type=\"hidden\" value=\"delcountry\" name = \"rm_subf\">";
				echo "<input type=\"hidden\" value=\"".$list[$i]->getId()."\" name = \"opt\">";
		echo "</form></table>";
		
		echo "<td>". $list[$i]->getName();
		echo "<td>". $list[$i]->getCode();
		echo "<td>". $list[$i]->getOrder();
		
	}
	echo "</table>";
	
	echo "<hr><form action=\"index.php\" method=\"post\">";
		echo "<input type=\"hidden\" name = \"rm_func\" value=\"champ\"> ";
		echo "<input type=\"hidden\" name = \"rm_subf\" value=\"newcountry\"> ";
		echo "<center><input type=\"submit\" value=\"Jauns\"> </center>";
	echo "</form>";
}

function printEditPTask($opt){
	$rm = new champManager;
	
	echo "<form enctype=\"multipart/form-data\" action=\"index.php\" method=\"post\">";
		echo "<input type=\"hidden\" name = \"rm_func\" value=\"champ\"> ";
		echo "<table width =\"100%\" border = \"1\">";
	
			echo "<tr class=\"title\"><td>Nosaukums";
	
	
		if (isset($opt)){
			$list = $rm->getPTask($opt);
			if ($list){			
				echo "<tr>";
				echo "<td><input type=\"text\" name = \"name\" value=\"".$list[0]->getName()."\">";
			}
		}
		echo "</table> ";
		echo "<input type=\"hidden\" name = \"opt\" value=\"".$list[0]->getID()."\">";
		echo "<input type=\"hidden\" name = \"rm_subf\" value=\"saveptask\">";
		echo "<hr><center><input type=\"submit\" value=\"Saglabāt\" ></center>";
	echo "</form>";
}

function delPTask($opt){
	$rm = new champManager;
	
		if ($opt){
			$rm->delPTask($opt);
		}		
	
}

function savePTask($opt){
	$rm = new champManager;
	
		if (isset($opt)){
			$rm->savePTask($opt,$_POST["name"]);
		}else {
			$rm->insPTask($_POST["name"]);
		}		
	
}

function printNewPTask(){
	echo "<form enctype=\"multipart/form-data\" action=\"index.php\" method=\"post\">";
		
		echo "<table width =\"100%\" border = \"1\">";
	
		echo "<tr class=\"newtitle\">";
		echo "<td>Nosaukums:<input type=\"text\" name = \"name\" >";
		
		echo "</table> ";
		echo "<input type=\"hidden\" name = \"rm_func\" value=\"champ\"> ";
		echo "<input type=\"hidden\" name = \"rm_subf\" value=\"saveptask\">";
		echo "<hr><center><input type=\"submit\" value=\"Saglabāt\" ></center>";
	echo "</form>";
}

function printPTask(){
	$rm = new champManager;
	$list = $rm->getPTask("");
	$i =0;
	
	
	echo "<form action=\"index.php\" method=\"post\">";
		echo "<input type=\"hidden\" name = \"rm_func\" value=\"champ\"> ";
		echo "<input type=\"hidden\" name = \"rm_subf\" value=\"newptask\"> ";
		echo "<center><input type=\"submit\" value=\"Jauns\"> </center>";
	echo "</form><hr>";
	
	echo "<table width =\"100%\" border = \"1\">";
	echo "<tr class=\"title\"><td width=\"20\">&nbsp<td>Nosaukums";
	while (isset($list[$i]) ){
	
		echo "<tr><td width=\"70\"><table border=\"0\"><tr><td>";
		
		echo "<form action=\"index.php\" method=\"post\">";
				echo "<input type=\"hidden\" name = \"rm_func\" value=\"champ\"> ";
				echo "<center><input type=\"submit\" value=\"Atvērt\" >";		
				echo "<input type=\"hidden\" value=\"openptask\" name = \"rm_subf\">";
				echo "<input type=\"hidden\" value=\"".$list[$i]->getId()."\" name = \"opt\">";				
		echo "</form>";
		
		
		echo "<input type=\"button\" value=\"Dzēst\" onclick=\"confDel('form".$list[$i]->getId()."','Tiešām dzēst?')\">";
			echo "<td><form action=\"index.php\" method=\"post\" id=\"form".$list[$i]->getId()."\">";
				echo "<input type=\"hidden\" name = \"rm_func\" value=\"champ\"> ";
				echo "<input type=\"hidden\" value=\"delptask\" name = \"rm_subf\">";
				echo "<input type=\"hidden\" value=\"".$list[$i]->getId()."\" name = \"opt\">";
			echo "</form></table>";
		
		echo "<td>". $list[$i]->getName();
		$i++;
	}
	echo "</table>";
	
	echo "<hr><form action=\"index.php\" method=\"post\">";
		echo "<input type=\"hidden\" name = \"rm_func\" value=\"champ\"> ";
		echo "<input type=\"hidden\" name = \"rm_subf\" value=\"newptask\"> ";
		echo "<center><input type=\"submit\" value=\"Jauns\"> </center>";
	echo "</form>";
}

function printEditClass($opt){
	$rm = new champManager;
	
	echo "<form enctype=\"multipart/form-data\" action=\"index.php\" method=\"post\">";
		echo "<input type=\"hidden\" name = \"rm_func\" value=\"champ\"> ";
		echo "<table width =\"100%\" border = \"1\">";
	
			echo "<tr class=\"title\"><td>Nosaukums<td>Kods";
	
	
		if (isset($opt)){
			$list = $rm->getClass($opt,"");
			if ($list){			
				echo "<tr>";
				echo "<td><input type=\"text\" name = \"name\" value=\"".$list[0]->getName()."\">";
				echo "<td><input type=\"text\" name = \"code\" value=\"".$list[0]->getCode()."\">";
				echo "<td><input type=\"text\" name = \"weight\" value=\"".$list[0]->getWeight()."\">";
			}
		}
		echo "</table> ";
		echo "<input type=\"hidden\" name = \"opt\" value=\"".$list[0]->getID()."\">";
		echo "<input type=\"hidden\" name = \"rm_subf\" value=\"saveclass\">";
		echo "<input type=\"hidden\" name = \"type\" value=\"",$list[0]->getType(),"\">";
		
		echo "<hr><center><input type=\"submit\" value=\"Saglabāt\" ></center>";
	echo "</form>";
}

function delClass($opt){


	$rm = new champManager;
	
		if ($opt){
			$rm->delClass($opt);
		}		
	
}

function saveClass($opt){
	$rm = new champManager;
	
		if (isset($opt)){
			$rm->saveClass($opt,$_SESSION['params']["name"],$_SESSION['params']["code"],$_SESSION['params']["weight"]);
		}else {
			$rm->insClass($_SESSION['params']["name"],$_SESSION['params']["code"],$_SESSION['params']['type'],$_SESSION['params']['weight']);
		}		
	
}

function printNewClass(){
	echo "<form enctype=\"multipart/form-data\" action=\"index.php\" method=\"post\">";
		echo "<input type=\"hidden\" name = \"rm_func\" value=\"champ\"> ";
		echo "<table width =\"100%\" border = \"1\">";
	
		echo "<tr class=\"newtitle\">";
		echo "<td>Nosaukums:<input type=\"text\" name = \"name\" >";
		echo "<td>Kods:<input type=\"text\" name = \"code\" >";
		echo "<td>Secība:<input type=\"text\" name = \"weight\" >";
		
		echo "</table> ";
		
		echo "<input type=\"hidden\" name = \"rm_subf\" value=\"saveclass\">";
		echo "<input type=\"hidden\" name = \"type\" value=\"",$_SESSION['params']['type'],"\">";
		echo "<hr><center><input type=\"submit\" value=\"Saglabāt\" ></center>";
	echo "</form>";
}

function printClass(){
	$rm = new champManager;
	$list = $rm->getClass("",$_SESSION['params']['type']);
	$i =0;
	
	echo "<a href = \"index.php?rm_func=champ&rm_subf=newclass&type=",$_SESSION['params']['type'],"\">";
		echo "<img src = \"./images/BlueAdd_16x16.png\" alt=\"Jaunā klase\" title=\"Jaunā klase\" border = \"0\">";
	echo " </a>";
	echo "<a href = \"index.php?rm_func=champ&rm_subf=newclass&type=",$_SESSION['params']['type'],"\">";
		echo "<b>Jaunā klase</b>";
	echo " </a><hr>";
				
	echo "<table width =\"100%\" border = \"1\">";
	echo "<tr class=\"title\"><td width=\"20\">&nbsp<td>Nosaukums<td>Kods<td>Secība";
	
	while (isset($list[$i]) ){
	
		echo "<tr><td width=\"40\">";		
			echo "<a href = \"index.php?rm_func=champ&rm_subf=openclass&opt=",$list[$i]->getId(),"\">";
				echo "<img src = \"./images/PageWhiteEdit_16x16.png\" alt=\"Atvērt\" title=\"Atvērt\" border = \"0\">";
			echo "</a>";
			echo " <a onclick=\"confDelGet('Tiešām dzēst?','index.php?rm_func=champ&rm_subf=delclass&opt=",$list[$i]->getId(),"&type=",$_SESSION['params']['type'],"')\">";
				echo "<img src=\"./images/RedCross_16x16.png\" border = \"0\" alt=\"Dzēst\" title=\"Dzēst\" 
					onmouseover=\"document.body.style.cursor = 'pointer'\"
					onmouseout = \"document.body.style.cursor = 'default'\"
				>";
			echo "</a>";
		
		echo "<td>". $list[$i]->getName();
		echo "<td>". $list[$i]->getCode();
		echo "<td>". $list[$i]->getWeight();
		$i++;
	}
	echo "</table>";
	
}

function listChamps(){
	$rm = new champManager;
	$champs = $rm->getChamps("","","",$_SESSION['params']['type']);
	$i =0;
	
	echo "<a href = \"index.php?rm_func=champ&rm_subf=newchamp&type=",$_SESSION['params']['type'],"\">";
		echo "<img src = \"./images/BlueAdd_16x16.png\" alt=\"Jaunā sacensību sērija\" title=\"Jaunā sacensību sērija\" border = \"0\">";
	echo " </a>";
	echo "<a href = \"index.php?rm_func=champ&rm_subf=newchamp&type=",$_SESSION['params']['type'],"\">";
		echo "<b>Jaunā sacensību sērija</b>";
	echo " </a><hr>";
	
	echo "<table width =\"100%\" border = \"1\">";
	echo "<tr class=\"title\"><td width=\"70\">&nbsp<td width=\"200\">Nosaukums<td width=\"100\">Gads<td width = \"100\">Noteikumi<td width=\"*\">Piezīmes";
	while (isset($champs[$i]) ){
					
		echo "<tr><td width=\"40\">";		
			echo "<a href = \"index.php?rm_func=champ&rm_subf=openchamp&opt=",$champs[$i]->getId(),"\">";
				echo "<img src = \"./images/PageWhiteEdit_16x16.png\" alt=\"Atvērt\" title=\"Atvērt\" border = \"0\">";
			echo "</a>";
			echo " <a onclick=\"confDelGet('Tiešām dzēst?','index.php?rm_func=champ&rm_subf=delclass&opt=",$champs[$i]->getId(),"&type=",$_SESSION['params']['type'],"')\">";
				echo "<img src=\"./images/RedCross_16x16.png\" border = \"0\" alt=\"Dzēst\" title=\"Dzēst\" 
					onmouseover=\"document.body.style.cursor = 'pointer'\"
					onmouseout = \"document.body.style.cursor = 'default'\"
				>";
			echo "</a>";
		echo "<td>". $champs[$i]->getName();
		echo "<td>". $champs[$i]->getYear();
		echo "<td>"; if ($champs[$i]->getRules()){echo  "<a href = \"". $champs[$i]->getRules()."\" class=\"item\"> Noteikums</a>";} else {echo "Nav";}
		echo "<td>", $champs[$i]->getNotes();
		
		
		$i++;
	}
	echo "</table>";
	
	
}

function printNewChamp(){
	echo "<form enctype=\"multipart/form-data\" action=\"index.php\" method=\"post\">";
		echo "<input type=\"hidden\" name = \"rm_func\" value=\"champ\"> ";
		echo "<table width =\"100%\" border = \"1\">";
			echo "<tr class=\"title\"><td width=\"200\">Nosaukums<td width=\"100\">Gads<td width = \"100\">Piezīmes<td width=\"*\">Noteikumi";	
			echo "<tr>";
				echo "<td><input type=\"text\" name = \"name\" >";
				echo "<td><input type=\"text\" name = \"year\" >";
				echo "<td><input type=\"text\" name = \"notes\" >";
				echo "<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"1000000000\" /><td><input type=\"file\" name = \"rules\" >";	
		echo "</table>";
		echo "<input type=\"hidden\" name = \"rm_subf\" value=\"savechamp\">";
		echo "<input type=\"hidden\" name = \"type\" value=\"".$_SESSION['params']['type']."\">";
		echo "<hr><center><input type=\"submit\" value=\"Saglabāt\" ></center>";
	echo "</form>";
}

function saveChamps($opt){
	$rm = new champManager;
	
		if (isset($opt)){
			$ch = $rm->getChamps($_POST["id"],"","","");
			if (!$_FILES["rules"]['tmp_name']){
				if ($ch){
					$_POST["rules"] = $ch[0]->getRules();				
				}
			} else {
				$date= getdate();
				$path = "Files/".md5($_POST["id"]."$date[year]$date[mon]$date[mday]$date[hours]$date[minutes]$date[seconds]"). basename( $_FILES["rules"]['name']);
				move_uploaded_file($_FILES["rules"]['tmp_name'],$path);
				if ($ch){
					@unlink($ch[0]->getRules());				
				}				
				$_POST["rules"] = $path;				
			}
			$rm->saveChamp($_POST["id"],$_POST["name"],$_POST["year"],$_POST["notes"],$_POST["rules"],$_POST["type"]);
		}else {
				$date= getdate();
				if ($_FILES["rules"]['tmp_name'])
				{
					$path = "Files/".md5($_SESSION['user']->getLogin()."0$date[year]$date[mon]$date[mday]$date[hours]$date[minutes]$date[seconds]"). basename( $_FILES["rules"]['name']);
						move_uploaded_file($_FILES["rules"]['tmp_name'],$path);
				}		
			
				$rm->insChamp($_POST["name"],$_POST["year"],$_POST["notes"],$path,$_POST["type"]);	
		}		
	
}

function delChamp($opt){
	$rm = new champManager;

		if ($opt){
			$champs = $rm->getChamps($opt,"","","");
			
			if ($champs and file_exists($champs[0]->getRules())){
				@unlink ($champs[0]->getRules());
			}
			
			$rm->delChamp($opt);
		}		
	
}

function printEditChamps($opt){
	$rm = new champManager;
	
	echo "<form enctype=\"multipart/form-data\" action=\"index.php\" method=\"post\">";
		echo "<input type=\"hidden\" name = \"rm_func\" value=\"champ\"> ";
		echo "<table width =\"100%\" border = \"1\">";
			echo "<tr class=\"title\"><td width=\"200\">Nosaukums<td width=\"100\">Gads<td width = \"100\">Piezīmes<td width=\"*\">Noteikumi";	
			if (isset($opt)){
			$champs = $rm->getChamps($opt,"","","");
			if (isset($champs[0])){
				echo "<tr>";
				echo "<input type=\"hidden\" name = \"id\" value=\"".$champs[0]->getId()."\">";
				echo "<td><input type=\"text\" name = \"name\" value=\"".$champs[0]->getName()."\">";
				echo "<td><input type=\"text\" name = \"year\" value=\"".$champs[0]->getYear()."\">";
				echo "<td><input type=\"text\" name = \"notes\" value=\"".$champs[0]->getNotes()."\">";
				echo "<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"1000000000\" /><td><input type=\"file\" name = \"rules\" >";
			}
		}
		echo "</table>";
		echo "<input type=\"hidden\" name = \"rm_subf\" value=\"savechamp\">";
		echo "<input type=\"hidden\" name = \"opt\" value=\"$opt\">";
		echo "<input type=\"hidden\" name = \"type\" value=\"".$champs[0]->getType()."\">";
		echo "<hr><center><input type=\"submit\" value=\"Saglabāt\" ></center>";
	echo "</form>";
}


?>