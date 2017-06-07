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



function em_login($login,$pass){

	global $phpbb_root_path;	
	$phpbb_root_path = "./phpBB3em/";
	require_once("./phpBB3em/includes/auth.php");
	
	$auth = new auth;
	$loginResult = $auth->login($login, $pass, 0, 1, 0);
	
	if ($loginResult[error_msg]){
		//print_r($loginResult);
		echo prntWarn(WRONG_LOGIN);
	} else {
		$_SESSION['user_id'] = $loginResult[user_row][user_id];
		header( 'Location: http://www.enduromanager.eu' ) ;
		//$_SESSION['ses_id'] = $bb3auth->user->data["session_id"];
	}
		
}

function em_logout(){
	$bb3auth = new BB3Auth();
	$user = $bb3auth->user;
	
	$user->session_kill();
	$user->session_begin();
	
	header( 'Location: http://www.enduromanager.eu' ) ;
	 
	//print_r($user);//->lang['LOGOUT_REDIRECT'];
}



?>



