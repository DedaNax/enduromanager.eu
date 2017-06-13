<?php

function printHowTo(){
	
	$bb3auth = new BB3Auth();
	$sec = new Security;
	
	$pelink="";
	$elink="";
	$eklink="";
	
	if ($bb3auth->check('u_rm_use')){
		if ($sec->testUserGroup($_SESSION['user_id'],"Sportisti")){
			$pelink="?rm_func=racer&rm_subf=raceAppl";
			$elink="?rm_func=enduro&rm_subf=apply";
		} else {
			echo "Jūs neesat reģistrējies ka sportists! Vai vēlaties aizsūtīt pieprasījumu?";
		}
	} else {
		$pelink="?rm_func=appl&rm_subf=pe";
		$elink="?rm_func=appl&rm_subf=enduro";
		$eklink="?rm_func=appl&rm_subf=ek";
	}
	
	echo "<center>";
		echo "<a ".($pelink ? "href=\"$pelink\"" : "").">";
			echo "<img src=\"./images/PE_Application.png\" border = \"0\">";
		echo "</a><br><br>";		
		echo "<a ".($elink ? "href=\"$elink\"" : "").">";
			echo "<img src=\"./images/Enduro_Application.png\" border = \"0\">";
		echo "</a><br><br>";
		echo "<a ".($eklink ? "href=\"$eklink\"" : "").">";
			echo "<img src=\"./images/EK_Application.png\" border = \"0\">";
		echo "</a>";		
	echo "</center>";
}

function registerNewUser($subf){
	$bb3auth = new BB3Auth();
	$sec = new Security;
	
	if ($bb3auth->check('u_rm_use')){
		if ($sec->testUserGroup($_SESSION['user_id'],"Sportisti")){
			switch($func) {		
				case "pe":
					header('Location: ?rm_func=racer&rm_subf=raceAppl');
					break;
				case "enduro":
					header('Location: ?rm_func=enduro&rm_subf=apply');
					break;
				case "ek";
					echo "Nezināms sacensību veids EK!";
					break;
				default:
					echo "Nezināms sacensību veids!";
			}
		} 
	} elseif($_SESSION['params']['reg']==1){		
		printNewTRacer("","");
		
	} elseif($_SESSION['params']['login']==1 || $_SESSION['params']['regdone']==1){
		// global $phpbb_root_path;
		// $phpbb_root_path = "../phpBB3/";
		// require_once("../phpBB3/includes/auth.php");
	
		// $auth = new auth;	
		
		// if ($_SESSION['params']['regdone']==1){
			// $loginResult = $auth->login($_SESSION['params']['email'], $_SESSION['params']['p1'], 0, 1, 0);
		// } else {
			// $loginResult = $auth->login($_SESSION['params']['username'], $_SESSION['params']['password'], 0, 1, 0);
		// }		
		
		// if (!$loginResult[error_msg]){
			// switch ($subf){
				// case "pe":
					@header('location: ?menuitem=enduro&rm_func=enduro&rm_subf=apply');
					// break;
				// case "enduro":
					// @header('location: ?rm_func=enduro&rm_subf=apply');
					// break;
				// case "ek":
					// @header('location: ?rm_func=enduro&rm_subf=apply');
					// break;
				// default:
					// echo prntWarn("Nezināma funkcija!");
			// }
		// } else {
			// echo "<center style=\"color:red;font-size:20px\">Autorizācijas neizdevās!</center><br>";
			// $_SESSION['params']['login']=0;
			// registerNewUser($subf);			
		// }
		
	} else {
		?>
		<form action="index.php" method="post" >
			<table border = "0">
				<tr>
					<td width = "100px"><h2>Ieiet</h2>
					<td> &nbsp
				<tr>									
					<td >Lietotājvārds:
					<td><input type="text" name="username" id="username" size="25"  />
				<tr>
					<td >Parole:
					<td><input type="password"  id="password" name="password" size="25" />
					    <input type = "hidden" name = "rm_func" value = "appl">
						<input type = "hidden" name = "rm_subf" value = "<?php echo $_SESSION['params']['rm_subf']; ?>">
						<input type = "hidden" name = "login" value = "1">
				<tr>
					<td ><a href="../phpBB3/ucp.php?mode=sendpassword">Aizmirsāt paroli?</a>
					<td><a href="../phpBB3/ucp.php?mode=resend_act">Atkārtoti izsūtīt vēstuli lietotāja konta aktivācijai</a>
				<tr>
					<td align = "right"><input type="submit"   value="Ieiet"  />
					<td>&nbsp
				<tr>
					<td>Reģistrācija
					<td>&nbsp
				<tr>
					<td colspan="3">Lai piekļūtu forumam Jums ir jābūt reģistrētam lietotājam. Reģistrācija aizņems tikai dažas minūtes, bet sniegs jums plašākas iespējas foruma izmantošanā. Pirms reģistrēšanās Jums ir jāiepazīstas ar foruma lietošanas noteikumiem. Atceraties, ka Jūsu  atrašanās  forumā nozīmē to, ka piekrītat <strong>visiem</strong> noteikumiem.
				<tr>	
				
					<td colspan="2"><strong><a href="../phpBB3/ucp.php?mode=terms">Vispārējie noteikumi</a> | <a href="./phpBB3/ucp.php?mode=privacy">Privātuma noteikumi</a></strong>
				<tr>
					<td><strong><a href="?rm_func=appl&rm_subf=<?php echo $_SESSION['params']['rm_subf']; ?>&reg=1&addmode=appl&red_f=appl&red_s=<?php echo $_SESSION['params']['rm_subf']; ?>" class="button2">Reģistrācija</a></strong>
					<td>&nbsp
			</table>
		</form>
		<?php
	}
} 
?>