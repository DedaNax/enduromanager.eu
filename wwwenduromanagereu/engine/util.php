<?php
define("VERSION","2.2.2");

$connection = null;

function queryDB($sql)
{
	return mysqli_query($GLOBALS["connection"], $sql);
}

function mysql_fetch_array($result, $mode) {
	return mysqli_fetch_array($result, $mode);
}

function mysql_num_rows($r) {
	return mysqli_num_rows($r);
}

function mysql_insert_id(){
	return mysqli_insert_id($GLOBALS["connection"]);
}

function sendMail($to,$from,$subj,$text){
	if(EMAIL_ENABLED){
		if (!isset($from)){
			$from = ADMIN_MAIL;
		}	

		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
		$headers .= 'From: noreply@enduromanager.eu' . "\r\n";
		$headers .= 'Reply-To: noreply@enduromanager.eu' . "\r\n";
		
		@mail($to,$subj,wordwrap($text, 70),$headers);
	}	
}

function validMail($mail){
	if (!(stripos($mail,"@") > 0)){return false;}
	if(strrpos($mail,"@") <> stripos($mail,"@")){return false;}
	if(stripos($mail,"@") > strrpos($mail,".")){return false;}
	return true;
}

function imgesize($path,$p2,$size){

	$img = imagecreatefromjpeg ($path); 
	$imgh = imagesy($img); $imgw = imagesx($img);

	if($imgw>$imgh)
	{
		$tnw=$size;
		$tnh=$size*($imgh/$imgw);
	}
	else
	{
		$tnh=$size;
		$tnw=$size*($imgw/$imgh);
	}

	$tn = imagecreatetruecolor($tnw,$tnh);

	if(imagecopyresized($tn,$img,0,0,0,0,$tnw,$tnh,$imgw,$imgh)) 
		imagejpeg ( $tn ,$p2); 
	else
	{
		imagejpeg (imagecreate(),"$path");
	}

	imagedestroy ($img);

}

function getFileList($dir){
	$handle = opendir($dir);
	
	$i=0;
	while (false !== ($files[$i] = readdir($handle))) { 
       $i++;   
    }

	closedir($handle);

	return $files;
}

function getRaceTypeName($t){
	return $t == 1 ? "PE" : ($t == 2 ? "Ezeru" : "Enduro");
}

function isFolderEmpty($dir){
	if (!is_dir($dir)){
		return false;
	}	
	if (count(scandir ($dir)) > 2){
		return false;
	}
	return true;
}

function getYears(){
	$sql = "
		SELECT * 
		FROM  `phpbb_profile_fields_lang` 
		WHERE `field_id` = ".KL_YEAR."
		ORDER BY `option_id` asc";
	$r = queryDB($sql);	
	$reslt= array();
	while($row = mysql_fetch_array($r, MYSQL_ASSOC)){		
		$reslt[$row['option_id']] = $row['lang_value'];
	}
	return $reslt;
}

function getClub(){
	$sql = "
		SELECT * 
		FROM  `phpbb_profile_fields_lang` 
		WHERE `field_id` = ".KL_CLUB."
		ORDER BY `option_id` asc";
	$r = queryDB($sql);	
	$reslt= array();
	while($row = mysql_fetch_array($r, MYSQL_ASSOC)){		
		$reslt[$row['option_id']] = $row['lang_value'];
	}
	return $reslt;
}

function getMoto(){
		$sql = "
		SELECT * 
		FROM  `phpbb_profile_fields_lang` 
		WHERE `field_id` = ".KL_MOTO."
		ORDER BY `option_id` asc";
		//echo $sql;
	$r = queryDB($sql);	
	$reslt= array();
	while($row = mysql_fetch_array($r, MYSQL_ASSOC)){		
		$reslt[$row['option_id']] = $row['lang_value'];
	}
	return $reslt;
}

function prntWarn($s){
	return "<center style=\"color:red;font-size:20px\">$s</center><br>";
}

function printheader(){
	return "<html>
				<head>
					<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
				</head>
				<body>
	";
}

function printfooter(){
	return "</body></html>";
}

function DateTimeString($input){
	return strftime("%d.%m.%Y %H:%M",strtotime($input));
}

function DateString($input){
	return strftime("%d.%m.%Y",strtotime($input));
}

function array_sort($array, $on, $order=SORT_ASC)
{
	$new_array = array();
	$sortable_array = array();

	if (count($array) > 0) {
		foreach ($array as $k => $v) {
			if (is_array($v)) {
				foreach ($v as $k2 => $v2) {
					if ($k2 == $on) {
						$sortable_array[$k] = $v2;
					}
				}
			} else {
				$sortable_array[$k] = $v;
			}
		}

		switch ($order) {
			case SORT_ASC:
				asort($sortable_array);
			break;
			case SORT_DESC:
				arsort($sortable_array);
			break;
		}

		foreach ($sortable_array as $k => $v) {
			$new_array[$k] = $array[$k];
		}
	}

	return $new_array;
}

function sql_escape($msg)
{	
	return @mysqli_real_escape_string ($GLOBALS["connection"],$msg);	
}

function _sql_validate_value($var)
{
	if (is_null($var))
	{
		return 'NULL';
	}
	else if (is_string($var))
	{
		return "'" . sql_escape($var) . "'";
	}
	else
	{
		return (is_bool($var)) ? intval($var) : $var;
	}
}

function sql_build_array($query, $assoc_ary = false)
{
	if (!is_array($assoc_ary))
	{
		return false;
	}

	$fields = $values = array();

	if ($query == 'INSERT' || $query == 'INSERT_SELECT')
	{
		foreach ($assoc_ary as $key => $var)
		{
			$fields[] = $key;

			if (is_array($var) && is_string($var[0]))
			{
				// This is used for INSERT_SELECT(s)
				$values[] = $var[0];
			}
			else
			{
				$values[] = _sql_validate_value($var);
			}
		}

		$query = ($query == 'INSERT') ? ' (' . implode(', ', $fields) . ') VALUES (' . implode(', ', $values) . ')' : ' (' . implode(', ', $fields) . ') SELECT ' . implode(', ', $values) . ' ';
	}	

	return $query;
}

function user_add($user_row, $cp_data = false)
{
	if (empty($user_row['username']) || !isset($user_row['group_id']) || !isset($user_row['user_email']) || !isset($user_row['user_type']))
	{
		return false;
	}

	$sql_ary = array(
		'username'			=> $user_row['username'],
		'username_clean'	=> $user_row['username'],
		'user_password'		=> (isset($user_row['user_password'])) ? $user_row['user_password'] : '',
		'user_pass_convert'	=> 0,
		'user_email'		=> strtolower($user_row['user_email']),
		'user_email_hash'	=> crc32(strtolower($user_row['user_email'])) . strlen($user_row['user_email']),
		'group_id'			=> $user_row['group_id'],
		'user_type'			=> $user_row['user_type'],
	);

	// These are the additional vars able to be specified
	$additional_vars = array(
		'user_permissions'	=> '',
		'user_timezone'		=> 0,
		'user_dateformat'	=> 0,
		'user_lang'			=> 0,
		'user_style'		=> 0,
		'user_actkey'		=> '',
		'user_ip'			=> '',
		'user_regdate'		=> time(),
		'user_passchg'		=> time(),
		'user_options'		=> 895,

		'user_inactive_reason'	=> 0,
		'user_inactive_time'	=> 0,
		'user_lastmark'			=> time(),
		'user_lastvisit'		=> 0,
		'user_lastpost_time'	=> 0,
		'user_lastpage'			=> '',
		'user_posts'			=> 0,
		'user_dst'				=> 0,
		'user_colour'			=> '',
		'user_occ'				=> '',
		'user_interests'		=> '',
		'user_avatar'			=> '',
		'user_avatar_type'		=> 0,
		'user_avatar_width'		=> 0,
		'user_avatar_height'	=> 0,
		'user_new_privmsg'		=> 0,
		'user_unread_privmsg'	=> 0,
		'user_last_privmsg'		=> 0,
		'user_message_rules'	=> 0,
		'user_full_folder'		=> 0,
		'user_emailtime'		=> 0,

		'user_notify'			=> 0,
		'user_notify_pm'		=> 1,
		'user_notify_type'		=> 0,
		'user_allow_pm'			=> 1,
		'user_allow_viewonline'	=> 1,
		'user_allow_viewemail'	=> 1,
		'user_allow_massemail'	=> 1,

		'user_sig'					=> '',
		'user_sig_bbcode_uid'		=> '',
		'user_sig_bbcode_bitfield'	=> '',

		'user_form_salt'			=> 0,
	);

	// Now fill the sql array with not required variables
	foreach ($additional_vars as $key => $default_value)
	{
		$sql_ary[$key] = (isset($user_row[$key])) ? $user_row[$key] : $default_value;
	}

	// Any additional variables in $user_row not covered above?
	$remaining_vars = array_diff(array_keys($user_row), array_keys($sql_ary));

	// Now fill our sql array with the remaining vars
	if (sizeof($remaining_vars))
	{
		foreach ($remaining_vars as $key)
		{
			$sql_ary[$key] = $user_row[$key];
		}
	}

	$sql = 'INSERT INTO `phpbb_users` ' . sql_build_array('INSERT', $sql_ary);
	queryDB($sql);

	$user_id = mysqli_insert_id($GLOBALS["connection"]);

	// Insert Custom Profile Fields
	if ($cp_data !== false && sizeof($cp_data))
	{
		$cp_data['user_id'] = (int) $user_id;

		$sql = 'INSERT INTO `phpbb_profile_fields_data` ' .sql_build_array('INSERT', $cp_data);
		
		queryDB($sql);
	}

	return $user_id;
}
?>