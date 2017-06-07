<?

//error_reporting(E_ALL ^ E_NOTICE);

class BB3Auth {
	
	
	
	function __construct() {
				
		@define('IN_PHPBB', true);
				
		global $phpbb_root_path;
		global $phpEx;
		global $db;
		global $config;
		global $user;
		global $auth;
		global $cache;
		//global $template;
		
		$phpEx = substr(strrchr(__FILE__, "."), 1);
		
		
		
		$dir = dirname(__FILE__);
		$phpbb_root_path = $dir . '/phpBB3/';
		
		require_once($phpbb_root_path ."common.php");
		
		$this->user = $user;
		$this->auth = $auth;
		
		if(!isset($_GET['sid']) && !isset($_GET['mode']) && !isset($_GET['redirect'])) {
						
			$user->session_begin();			
			$auth->acl($user->data);
		}

		$phpbb_root_path = "././";
		
		// $result = $this->auth->acl_get('u_view_foo');
		// echo print_r($this->user->data, true) . " / " . $result;		

	}
	
	
	
	function destroy() {
		
		//global $user;
		//$user->session_kill(false);
	}
	
	
	
	
	function login() {
		
		$a1 = $this->auth->acl_get('u_raksti_edit');
		$a2 = $this->auth->acl_get('u_raksti_full');
		$a3 = $this->auth->acl_get('u_galerija_full');
		$a4 = $this->auth->acl_get('u_kalendars_full');
				
		if(!$a1 && !$a2 && !$a3 && !$a4) {
			
			// trigger_error('NOT_AUTHORISED');
			
			@header("Location: " . BASE_URL . "phpBB3/ucp.php?mode=login&redirect=" . BASE_URL . "admin.php");
		}
		
	}
	

	
	
	function link() {
		
		$links[] = '<a href="'.BASE_URL.'admin.php">CMS</a>';
		$links[] = '<a target="_blank" href="'.BASE_URL.'phpBB3/ucp.php">Profile</a>';
		$links[] = '<a target="_blank" href="'.BASE_URL.'phpBB3/mcp.php?i=main">Forum moderate</a>';
		$links[] = '<a target="_blank" href="'.BASE_URL.'phpBB3/adm/index.php?sid='.$this->user->data["session_id"].'">Forum admin</a>';
		
		return '<div class="logo">'.implode(' | ', $links) . '</div>';
	}
	
	
	
	function logout() {
		
		$out = '<a href="' . BASE_URL . 'phpBB3/ucp.php?mode=logout&sid='.$this->user->data["session_id"].'">LogOut</a>';
		
		return '<div class="logout">'.$out.'</div>';
	}
	
	
	// obj = simple vai obj|obj|obj
	
	function check($obj) {
				
		foreach((array)explode('|', $obj) as $o ) {
		
			$status = $this->auth->acl_get($o);
			//echo "$obj = $status; ";
			
			if($status)
				return true;
		}
		
		return $status;
	}
	
	
	
}





?>