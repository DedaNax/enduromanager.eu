<?php
define("VERSION","2.2.2");

function queryDB($sql){
	
	return mysql_query($sql); 	
	
}
function sendMail($to,$from,$subj,$text){
	if(EMAIL_ENABLED){
		if (!isset($from)){
			$from = ADMIN_MAIL;
		}	
		//ini_set("sendmail_from", $from);
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
		
		@mail($to,$subj,wordwrap($text, 70),$headers);
	}	
}
function validMail($mail){
	if (!(stripos($mail,"@") > 0)){return false;}
	if(strrpos($mail,"@") <> stripos($mail,"@")){return false;}
	//if (!(stripos($mail,".") > 2)){return false;}
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
		$reslt[$row[option_id]] = $row[lang_value];
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
		$reslt[$row[option_id]] = $row[lang_value];
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
		$reslt[$row[option_id]] = $row[lang_value];
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
?>