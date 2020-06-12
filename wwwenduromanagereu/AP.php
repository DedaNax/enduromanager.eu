<?php

@define("BASE", dirname(__FILE__). '/');
require_once BASE . "class_main.php";

class AP {	
	
	function __construct() {
		$this->items = new main("items");
	}
	
	function head() {

		$out = file_get_contents(BASE . "template_js.html");	
		$out = str_replace('<script type="text/javascript"></script>', js(), $out);

		return $out;
	}	
	
	function headers($ext, $user) {
		$out = file_get_contents(BASE . "template_header.html");

		$out = str_replace("<lang>", lang(), $out);
		$out = str_replace("<login>", login($user), $out);
		
		$out = str_replace("<logo>", LOGO, $out);
		$out = str_replace("<logoname>", LOGONAME, $out);
		
		$out = str_replace("<side>", $this->items->showSideCategoriesPublic2( $ext ), $out);
		
		return $this->head() . $out . '<head><body>';
	}	
	
	function footer() {
		$out = file_get_contents(BASE . "template_footer.html");
		
		return $out . '</body></html>';
	}	
}

function lang() {

	$langs['lv'] = 'LAT';	
	$langs['en'] = 'ENG';

	$out = Array();

	foreach($langs as $key => $value) {		
		$out[] = '<li><a href="/?lang=' . $key . '" ' . $active . '>' . $value . '</a></li>';
	}

	return implode('<li>|</li>', $out);
}

function login($user){
	$out = '';
	if(!($user['user_id'] > 1)){
			
		$out = $out .'<form action="index.php?rm_func=em_user&rm_subf=login" method="post" >	
						<table border = "0" class="login">
							<tr>
								<td>'.LOGIN_IMP_NAME.'
								<td>'.LOGIN_IMP_PASS.'
								<td>
							<tr>
								<td><input type="text" name="username" id="username" class="loginimp"  />
								<td ><input type="password"  id="password" name="password" class="loginimp" />												
								<td ><input type="submit"   value="'.LOGIN_TITLE.'"  class="loginsubm"/>
						</table>
					</form>
					<div class="login_reg"><a href="./?rm_func=appl&rm_subf=pe&reg=1&addmode=appl&red_f=appl&red_s=pe">'.LOGIN_REG.'</a></div>';
	
	} else {
		$out = $out .'<table border = "0" class="logged">
						<tr>
							<td width="300px">'.WELCOME_STRING.', '.$user['username'].'
								<a href = "?rm_func=em_user&rm_subf=logout&no_gui=1"> | '.LOGOUT_STRING.'</a>
					</table>';
	}							
	
	return $out;
}
