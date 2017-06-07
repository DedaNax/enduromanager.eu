<?php
class rm_user{
	private $id;
	public function setID($value) {
		$this->id = $value;
	}
	public function getID()	{
		return $this->id;
	}
	
	private $login;
	public function setLogin($value) {
		$this->login = $value;
	}
	public function getLogin()	{
		return $this->login;
	}
	
	private $pass;
	public function setPass($value){
		$this->pass = $value;
	}
	public function getPass(){
		return $this->pass;
	}
	
	private $perms;
	public function getPermissions(){
		return $this->perms;
	}
	public function setPermissions($value){
		$this->perms = $value;
	}
	public function addPermisson($value){
		array_push($this->perms,$value);
	}
	public function hasPermission($perm){
		
		for($i=0;$i<count($this->getPermissions());$i++){
			if ($this->perms[$i]->getID() == $perm){
				return true;
			}
		}
		
		return false;
	}
}
class permission{
	private $name;
	private $id;
	
	public function setName($value) {
		$this->name = $value;
	}
	public function getName()	{
		return $this->name;
	}
	
	public function setID($value) {
		$this->id = $value;
	}
	public function getID()	{
		return $this->id;
	}
}
class applictation{
	
	private $applID;
	public function getApplID(){
		return $this->applID;
	}
	public function setApplID($value){
		$this->applID = $value;
	}

	private $userID;
	public function getUserID(){
		return $this->userID;
	}
	public function setUserID($value){
		$this->userID = $value;
	}	

	private $username;
	public function getUserName(){
		return $this->username;
	}
	public function setUserName($value){
		$this->username = $value;
	}
	
	private $commited;
	public function getCommitDate(){
		return $this->commited;
	}
	public function setCommitDate($value){
		$this->commited = $value;
	}
}


class Security {
	public function getUsers($id,$login,$withPerm) {
				
		$sql = "SELECT * FROM a_user";
		$where = "";
		if ($id <> "") {$where = "UserID = '$id'";}
		
		if ($login <> "") {
			if ($where <> "") { $where = "$where and";}
			$where = "$where login = '$login'";			
		}
		if ($where <> "") {$sql = "$sql where $where";}	
		$q_result = queryDB($sql);
		
			
		$reslt = array();		
		 while ($row = mysql_fetch_array($q_result, MYSQL_ASSOC)) {
			
			$item = new rm_user;
			$item->setID($row[UserID]);
			$item->setLogin($row[Login]);
			$item->setPass($row[pass]);
			if ($withPerm == 1){
				$item->setPermissions($this->getUserPermissions($row[UserID]));
			}
			array_push($reslt,$item);
		}

		return $reslt;
	}
	public function delUser($id){
		$sql = "DELETE from `a_user` where `UserID` = '$id';";
		queryDB($sql);
	}
	public function insUser($login,$pass){
		$sql = "INSERT INTO `a_user` (`login`,`pass`) VALUES ('$login','$pass');";
		
		queryDB($sql);
	}
	
	public function getFreeRaceCrew($race,$perm){
		$gr=0;
		if ($perm == 7){
			$gr=ORG_GROUP_ID;
		} elseif($perm==8){
			$gr=TIES_GROUP_ID;
		}
		
		$sql = "SELECT  u.`user_Id` as UserID ,u.`pf_rm_f_name` ,u.`pf_rm_l_name`
				FROM `phpbb_profile_fields_data`  u
					inner join `phpbb_user_group` ug on (ug.`user_id` = u.`user_id` and ug.`group_id` = $gr)
				
				WHERE not (u.`user_id` in (select userid from `b_racecrew` where `raceid` = $race and `perm`=$perm))";
		//echo $sql;
		$q_result = queryDB($sql);
		
			
		$reslt = array();		
		 while ($row = mysql_fetch_array($q_result, MYSQL_ASSOC)) {
			
			$item = new rm_user;
			$item->setID($row[UserID]);
			$item->setLogin($row[pf_rm_f_name]." ".$row[pf_rm_l_name]);
		
			array_push($reslt,$item);
		}

		return $reslt;
	}
	
	public function testUserGroup($u,$g){
		$sql = "SELECT  * FROM `phpbb_user_group` ug
					inner join `phpbb_groups` g on (g.`group_id` = ug.`group_id`)
					WHERE ug.`user_id` = $u and g.`group_name` = '$g'";
		
		//echo $sql;
		$q_result = queryDB($sql);
		 while ($row = mysql_fetch_array($q_result, MYSQL_ASSOC)) {
			return true;
		 }
		return false;
	}
	
	public function getCustomField($u,$f){
		$sql = "SELECT  `$f` FROM `phpbb_profile_fields_data` fd					
					WHERE fd.`user_id` = $u";
		
		//echo $sql;
		$q_result = queryDB($sql);
		 while ($row = mysql_fetch_array($q_result)) {
			return $row[0];
		 }
		return null;
	}
	
}	

function editUser($subf,$opt){	
	switch($subf){
		case "applicationWarn":
			printNewApplication();
			break;
		case "applSave":
			saveApplication();
			break;
		case "userlist":
			listUsers();
			break;
		case "openUser":
			printUser($opt);
			break;
		case "saveUser":
			saveUser($opt);
			listUsers();
			break;
		case "applist":
			listApps();
			break;
		case "openAppl":
			printApplication($opt);
			break;
		case "commitAppl":
			commitApplication($opt);
			listApps();
			break;
		default:
	}
}

function printNewApplication(){
	$sec = new Security;
	
	if (isset($_SESSION['user']) and count($sec->getApplications($_SESSION['user']->getID(),"")) > 0){
		echo "Pieteikums pieņemts, gaidiet <b>apPasaules RaceManager</b> administrācijas atbildi!";
		return;
	}
	
	echo "<form action=\"index.php\" method=\"post\">";
	echo "<input type=\"hidden\" name = \"func\" value=\"user\">";
	echo "<input type=\"hidden\" name = \"subf\" value=\"applSave\">";
	
	echo "<table width =\"100%\" border = \"1\">";
		echo "<tr class=\"title\"><td colspan =\"2\" > Dalībnieka reģistrēšana";
		echo "<tr><td>Vards: <td ><input type=\"text\" name = \"fn\" >";
		echo "<tr><td width=\"100\">Uzvards: <td ><input type=\"text\" name = \"ln\" >";
		echo "<tr><td>Personas kods: <td ><input type=\"text\" name = \"pk\" >";
		echo "<tr><td>Adrese: <td <input type=\"text\" name = \"adr\" >";
		echo "<tr><td>Telefons: <td ><input type=\"text\" name = \"tel\" >";
		echo "<tr><td>E-pasts: <td ><input type=\"text\" name = \"mail\" >";		
		echo "<tr><td>Dzimums: <td ><select name =\"sex\"><option value=\"0\">Sv.</option><option value=\"1\">Vr.</option></select>";
		echo "<tr><td>Apdrosinasana: <td ><input type=\"checkbox\" name =\"ins\" >";
		echo "<tr><td>Tehnikas tips: <td ><select name =\"tt\"><option value=\"0\">Velo</option><option value=\"1\">Moto</option><option value=\"2\">Kvadro</option></select>";
		echo "<tr><td width=\"100\" >Marka un motora tilpums: <td ><textarea rows=\"3\" cols=\"30\" name =\"tn\"></textarea>";
	echo "</table> ";
	echo "<hr><center><input type=\"submit\" value=\"Saglabāt\" name=\"sub\"></center>";
	echo "</form>";
}

function saveApplication(){

	$sec = new Security;
	$rcm = new RacerManager;
	
	$sec->insUser($_SESSION['username']);	
	$usr = $sec->getUsers("",$_SESSION['username'],0);
	$sec->insUserPermission($usr[0]->getID(),1);
	$sec->insUserPermission($usr[0]->getID(),4);
		
	$rcm->insRacer($usr[0]->getID(),1);
	$racer = $rcm->getRacer("",$usr[0]->getID(),1);
	$ins =0;
	if (isset($_SESSION['params']['ins'])){$ins =1;}
	
	$rcm->addRacerInfo($racer[0]->getRacerID(),$_SESSION['params']['ln'],$_SESSION['params']['fn'],$_SESSION['params']['pk'],$_SESSION['params']['adr'],$_SESSION['params']['tel'],$_SESSION['params']['mail'],$_SESSION['params']['sex'],$ins,$_SESSION['params']['tt'],$_SESSION['params']['tn']);
	
	$sec->saveApplication($usr[0]->getID());
	
	echo "Pieteikums pieņemts, gaidiet <b>apPasaules RaceManager</b> administrācijas atbildi!";
	//$mailText = "";
	//sendMail(ADMIN_MAIL,"Jauns pieteikums RM lietošanai",$mailText);

}

function listUsers(){
	$sec = new Security;
	$usrs = $sec->getUsers("","","");
		
	echo "<table width =\"100%\" border = \"1\">";
	echo "<tr class=\"title\"><td width=\"20\">&nbsp<td width=\"150\">Lietotāja vārds";
	for($i=0;$i<count($usrs);$i++){
		echo "<tr><td width=\"70\">";
			echo "<form action=\"index.php\" method=\"post\">";
				echo "<input type=\"hidden\" name = \"func\" value=\"user\" > ";
				echo "<input type=\"hidden\" name = \"subf\" value=\"openUser\">";
				echo "<input type=\"hidden\" name = \"opt\"  value=\"".$usrs[$i]->getID()."\" >";				
				echo "<input type=\"submit\" value=\"Labot\">";	
			echo "</form>";
		echo "<td width=\"*\">". $usrs[$i]->getLogin();
	}
	echo "</table> ";
	
}

function printUser($opt){
	$sec = new Security;
	$usr = $sec->getUsers($opt,"",1);
	echo "<h1>Lietotājs: ".$usr[0]->getLogin()."</h1>";
	echo "<h1>Lietotāja tiesības:</h1>";
	
	echo "<form action=\"index.php\" method=\"post\">";
	echo "<table width =\"100%\" border = \"1\">";
	echo "<tr class=\"title\"><td width=\"20\">&nbsp<td width=\"150\">Tiesības nosaukums";
	
		$perms = $sec->getPermissions();
		for($i=0;$i<count($perms);$i++){
			echo "<tr>";
			echo "<td>";
			echo "<input type=\"checkbox\" name =\"perm".$perms[$i]->getID()."\" value=\"perm\"";
			if ($usr[0]->hasPermission($perms[$i]->getID())){echo " checked ";}
			echo ">";
			echo "<td>",$perms[$i]->getName();
		}	
	
	echo "</table> ";
	echo "<hr>";
	echo "<center><input type=\"submit\" value=\"Saglabāt\"></center>";
	echo "<input type=\"hidden\" name=\"func\" value = \"user\">";
	echo "<input type=\"hidden\" name=\"subf\" value = \"saveUser\">";
	echo "<input type=\"hidden\" name=\"opt\" value = \"$opt\">";
	echo "</form>";
}

function saveUser($opt){

	$keys = array_keys($_SESSION['params'],"perm");
	$sec = new Security;
	if (!isset($_SESSION['params']['fromList'])){
		$sec->delUserPermissionByUser($opt);
	}
	for($i=0;$i<count($keys);$i++){
		$sec->insUserPermission($opt,str_replace("perm","",$keys[$i]));
	}
}

function listApps(){
	$sec = new Security;
	$apps = $sec->getApplications("","");
	
	echo "<table width =\"100%\" border = \"1\">";
	echo "<tr class=\"title\"><td width=\"20\">&nbsp<td width=\"150\">Lietotāja vārds";
	for($i=0;$i<count($apps);$i++){
		echo "<tr><td width=\"70\">";
		echo "<table border=\"0\">";
			echo "<tr><td><form action=\"index.php\" method=\"post\">";
				echo "<input type=\"hidden\" name = \"func\" value=\"user\" > ";
				echo "<input type=\"hidden\" name = \"subf\" value=\"openAppl\">";
				echo "<input type=\"hidden\" name = \"opt\"  value=\"".$apps[$i]->getApplID()."\" >";				
				echo "<input type=\"submit\" value=\"Atvērt\">";	
			echo "</form>";
			echo "<td><form action=\"index.php\" method=\"post\">";
				echo "<input type=\"hidden\" name = \"func\" value=\"user\" > ";
				echo "<input type=\"hidden\" name = \"subf\" value=\"commitAppl\">";
				echo "<input type=\"hidden\" name = \"opt\"  value=\"".$apps[$i]->getApplID()."\" >";
				echo "<input type=\"hidden\" name = \"fromList\" value=\"1\">";
				echo "<input type=\"submit\" value=\"Apstiprināt\">";	
			echo "</form>";
		echo "</table>";
		echo "<td width=\"*\">". $apps[$i]->getUserName();
	}
	echo "</table> ";
	
}

function printApplication($opt){
	$sec = new Security;
	$rcm = new RacerManager;
	$appl = $sec->getApplications("",$opt);
	$usr = $sec->getUsers($appl[0]->getUserID(),"",1);
	$rcr = $rcm->getRacer("",$usr[0]->getID(),1);	
	$rcd = $rcm->getRacerInfo($rcr[0]->getRacerID());
	
	echo "<h1>Lietotāja informācija:</h1>";
	
	echo "<table width =\"100%\" border = \"1\">";
	echo "<tr ><td class=\"title\" width=\"20%\"> Vārds <td>",$rcd[0]->getFname();
	echo "<tr ><td class=\"title\"> Uzvārds <td>",$rcd[0]->getLname();
	echo "<tr ><td class=\"title\"> PK <td>",$rcd[0]->getPK();
	echo "<tr ><td class=\"title\"> Adrese <td>",$rcd[0]->getAddr();
	echo "<tr ><td class=\"title\"> Tel. <td>",$rcd[0]->getTel();
	echo "<tr ><td class=\"title\"> e-mail <td>",$rcd[0]->getMail();
	echo "<tr ><td class=\"title\"> Dzimums <td>";if($rcd[0]->getSex()){echo "Vīr.";} else {echo "Siev.";};
	echo "<tr ><td class=\"title\"> Apdrošināšana <td>";if($rcd[0]->getIns()){echo "Ir";}else{echo "Nav";};
	echo "<tr ><td class=\"title\"> Tehnika <td>";if($rcd[0]->getTehn()==0){echo "Velo";} elseif($rcd[0]->getTehn()==1){echo "Moto";}else{echo "Kvadro";};
	echo "<tr ><td class=\"title\"> Tehnikas apraksts <td>",$rcd[0]->getTehnN();
	
	echo "</table>";
	
	echo "<hr>";
	echo "<h1>Lietotāja tiesības:</h1>";
	echo "<form action=\"index.php\" method=\"post\">";
	echo "<table width =\"100%\" border = \"1\">";
	echo "<tr class=\"title\"><td width=\"20\">&nbsp<td width=\"150\">Tiesības nosaukums";
	
		$perms = $sec->getPermissions();
		for($i=0;$i<count($perms);$i++){
			echo "<tr>";
			echo "<td>";
			echo "<input type=\"checkbox\" name =\"perm".$perms[$i]->getID()."\" value=\"perm\"";
			if ($usr[0]->hasPermission($perms[$i]->getID())){echo " checked ";}
			echo ">";
			echo "<td>",$perms[$i]->getName();
		}	
	
	echo "</table> ";
	echo "<hr>";
	echo "<center><input type=\"submit\" value=\"Apstiprināt\"></center>";
	echo "<input type=\"hidden\" name=\"func\" value = \"user\">";
	echo "<input type=\"hidden\" name=\"subf\" value = \"commitAppl\">";
	echo "<input type=\"hidden\" name=\"opt\" value = \"$opt\">";
	echo "</form>";
}	
	
function commitApplication($opt){
	$sec = new Security;
		
	$appl = $sec->getApplications("",$opt);
	$usr = $sec->getUsers($appl[0]->getUserID(),"",1);
		
	saveUser($usr[0]->getID());
	$sec->delUserPermissionByUserPerm($appl[0]->getUserID(),1);
	
	$sec->commitApplication($opt);
}
?>