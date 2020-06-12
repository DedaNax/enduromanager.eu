<?php
	function em_user($subf){
		switch ($subf){
			case "login":
				em_login($_SESSION['params']['username'], $_SESSION['params']['password']);
				break;
			case "logout":
				em_logout();
				break;
				
		}
	}

	function em_login($login,$pass) {
		if(!($login && $pass)){
			loginFail();
			return;
		}

		$sql = "SELECT * 
				FROM `phpbb_users` 
				WHERE 
					lower(`username`) = lower('$login')";
		
		$row = getUserRow(queryDB($sql));
		if ($row &&
			password_verify($pass,$row['user_password']))
		{
			$_SESSION['user'] = $row;
			header( 'Location: http://www.enduromanager.eu' ) ;		
		} else {						
			loginFail();		
		}		
	}

	function loginFail(){
		$_SESSION['user'] = null;
		echo prntWarn(WRONG_LOGIN);
		echo '<center><h2>'.WRONG_LOGIN_LINK.' <a href="?rm_func=resetPass">'.WRONG_LOGIN_PUSH.'!</a></h2></center>';
	}

	function getUserRow($r){
		if(!$r){
			return null;
		}

		if(mysqli_num_rows($r) != 1){
			return null;
		}

		return mysql_fetch_array($r,MYSQL_ASSOC);
	}

	function em_logout(){		
		$_SESSION['user'] = null;
		header( 'Location: http://www.enduromanager.eu' ) ;
	}	

	function resetPass($subf,$opt) {
		if ($subf == "savePass") {
			$res = changePass($opt);
			switch ($res) {
				case "OK":
					header('Location: http://www.enduromanager.eu?rm_func=resetPass&rm_subf=infoSuccess') ;
					break;
				case "expired":
					emailForm();
					break;
				default:
					if (!newPassForm($opt)) {
						emailForm();
					}
					break;
			}
		} elseif ($subf == "changePassAdmin"){
			changePassAdmin($opt);

			
			if($_SESSION['params']['red_f']){
				$_SESSION['params']['rm_func'] = $_SESSION['params']['red_f'];
				$_SESSION['params']['rm_subf'] = $_SESSION['params']['red_s'];
				printMain();
			}

		} elseif ($subf == "infoSent") {	
			printSendTokenSuccess();
		} elseif ($subf == "infoSuccess") {
			printChangeSuccess();
		} elseif ($subf == "email") {
			if (!sendReserLink($opt)) {
				emailForm();
			} else {
				header('Location: http://www.enduromanager.eu?rm_func=resetPass&rm_subf=infoSent') ;
			}
		} elseif ($opt) {
			if (!newPassForm($opt)) {
				emailForm();
			}
		} else {
			emailForm();
		}
	}

	function changePassAdmin($user_id){
		if(!trim($_SESSION['params']['pass1']) || !trim($_SESSION['params']['pass2'])) {
			echo prntWarn(RESET_PASS_EMPTY_PASS);
			return false;
		}

		if($_SESSION['params']['pass1'] != $_SESSION['params']['pass2']) {
			echo prntWarn(RESET_PASS_PASSWORD_MISSMATCH);
			return false;
		}

		if(!$user_id){
			echo prntWarn('Jāizvēlās sportists!');
			return false;
		}

		$sql = "
			UPDATE `phpbb_users`
			SET `user_password` = '".password_hash($_SESSION['params']['pass1'], PASSWORD_DEFAULT)."'
			WHERE `user_id` = $user_id";
		
		queryDB($sql);

		return true;
	}

	function changePass($opt){
		if(!trim($_SESSION['params']['pass1']) || !trim($_SESSION['params']['pass2'])) {
			echo prntWarn(RESET_PASS_EMPTY_PASS);
			return "emptypass";
		}

		if($_SESSION['params']['pass1'] != $_SESSION['params']['pass2']) {
			echo prntWarn(RESET_PASS_PASSWORD_MISSMATCH);
			return "passmissmatch";
		}

		$user_id = getUserFromToken($opt);
		if(!($user_id > 1)) {
			echo prntWarn(RESET_PASS_TOKEN_EXPIRED);
			return "expired";
		}		

		$sql = "
			SELECT * 
			FROM `passreset` pr
				INNER JOIN `phpbb_users` u on pr.`user_id` = u.`user_id`
			WHERE 
				pr.`token` = '$opt' AND
				lower(u.`username`) = lower('".$_SESSION['params']['email']."') AND
				u.`user_id` = $user_id";
		$r = queryDB($sql);

		if(!$r || mysql_num_rows($r) != 1) {
			echo prntWarn(RESET_PASS_WRONG_EMAIL);
			return "wrongemail";
		}

		$sql = "
			UPDATE `phpbb_users`
			SET `user_password` = '".password_hash($_SESSION['params']['pass1'], PASSWORD_DEFAULT)."'
			WHERE `user_id` = $user_id";
		
		queryDB($sql);

		$sql = "
			UPDATE `passreset`
			SET `valid` = 0
			WHERE `token` = '$opt'";
		
		queryDB($sql);

		return "OK";
	}

	function printSendTokenSuccess(){
		echo '
		<center style="font-size: medium; margin-top: 30px;">
			'.RESET_PASS_INFO.'
		</center>';
	}

	function newPassForm($opt) {
		if(getUserFromToken($opt) > 1) {
			echo '
				<form method="post" >
					<input type="hidden" name="rm_func" value="resetPass" >
					<input type="hidden" name="rm_subf" value="savePass" >
					<input type="hidden" name="opt" value="'.$opt.'" >
					<center>
						<table border="0" style="border: 0px; width:500px; margin-top: 30px;">
							<tr>
								<td colspan="2" style="text-align: justify; font-size: medium ">'.RESET_PASS_INPUT_INFO.'</td>
							</tr>
							<tr>
								<td style="width:100px">'.RESET_PASS_INPUT_EMAIL_FIELD.'</td>
								<td style="width:*"><input name="email" type="text" style="width:100%"/></td>
							</tr>
							<tr>
								<td style="width:100px">'.RESET_PASS_INPUT_PASS1_FIELD.'</td>
								<td style="width:*"><input name="pass1" type="password" style="width:100%"/></td>
							</tr>
							<tr>
								<td style="width:100px">'.RESET_PASS_INPUT_PASS2_FIELD.'</td>
								<td style="width:*"><input name="pass2" type="password" style="width:100%"/></td>
							</tr>
							<tr>
								<td colspan="2" align="center"><input type="submit" value = "'.RESET_PASS_INPUT_SUBMIT_BUTTON.'"></td>
							</tr>
						</table>
					</center>
				</form>';
			return true;
		} else {
			echo prntWarn(RESET_PASS_TOKEN_EXPIRED);
			return false;
		}		
	}

	function getUserFromToken($opt) {
		$sql = "
			SELECT * 
			FROM `passreset` 
			WHERE 
				`token` = '$opt' AND
				`valid` = 1 AND
				timediff(SYSDATE(),`time`) < '01:00:00'";
		$r = queryDB($sql);
		if(!$r || mysql_num_rows($r) != 1) {
			return null;
		}
		
		$row = mysql_fetch_array($r,MYSQL_ASSOC);

		return $row['user_id'];
	}

	function printChangeSuccess() {
		echo '
			<center style="font-size: medium; margin-top: 30px;">
				'.RESET_PASS_INFO_SUCCESS.'
			</center>';
	}

	function emailForm() {
		echo '
		<form method="post" >
			<input type="hidden" name="rm_func" value="resetPass" >
			<input type="hidden" name="rm_subf" value="email" >
			<center>
				<table border="0" style="border: 0px; width:500px; margin-top: 30px;">
					<tr>
						<td colspan="2" style="text-align: justify; font-size: medium ">'.RESET_PASS_RESET_INFO.'</td>
					</tr>
					<tr>
						<td style="width:100px">'.RESET_PASS_EMAIL_FIELD.'</td>
						<td style="width:*"><input name="opt" type="text" style="width:100%"/></td>
					</tr>
					<tr>
						<td colspan="2" align="center"><input type="submit" value = "'.RESET_PASS_EMAIL_BUTTON.'"></td>
					</tr>
				</table>
			</center>
		</form>
		';
	}

	function sendReserLink($email){
		$email = trim($email);

		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){			
			echo prntWarn(RESET_PASS_WRONG_EMAIL_FORMAT);
			return false;
		}

		$sql = "SELECT `user_id` FROM `phpbb_users` WHERE trim(`username`) = trim('$email')";
		$r = queryDB($sql);

		if(mysql_num_rows($r) != 1){
			echo prntWarn(RESET_PASS_USER_NOT_REGISTERED);
			return false;
		}
		$user_id = mysql_fetch_array($r,MYSQL_ASSOC)['user_id'];
		$guid = bin2hex(openssl_random_pseudo_bytes(32));
		
		$sql = "INSERT INTO `passreset` (`user_id`,`token`) VALUES ($user_id,'$guid')";
		queryDB($sql);		

		$text = file_get_contents(dirname(__DIR__."\..") ."/Files/passresetemail_".$_SESSION['params']['lang'].".html",true);
		$text = str_replace("{guid}", $guid, $text);
   
		sendMail($email,"noreply@enduromanager.eu",RESET_PASS_EMAIL_SUBJ,$text);
		

		return true;
	}
?>
