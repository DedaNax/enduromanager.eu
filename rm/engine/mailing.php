<?php

function proceedMailing($subf,$opt){
	switch($subf){
		case "massmail":
			printMassMail(0);
			break;
		case "send";
			if (sende_Mail() <> 1){
				printMassMail(1);
			} else {
				printMassMail(0);
			};
			break;
		default:
			printMailMenu();
	}
}

function sende_Mail(){

	if(!$_SESSION['params']['mailtype']){
		echo "<font color=\"red\"><b>* e-pasta adresāts nav izvēlēts</b></font>";
		return -1;
	}
	if(!$_SESSION['params']['subj']){
		echo "<font color=\"red\"><b>* e-pasta temats nav ievadīts</b></font>";
		return -2;
	}
	if(!$_SESSION['params']['elm1']){
		echo "<font color=\"red\"><b>* e-pasta saturs nav ievadīts</b></font>";
		return -3;
	}
	
	$text = "<html>
	<head>
		<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
		<meta http-equiv=\"Content-Language\" content=\"lv\">
	</head>
	<body>".$_SESSION['params']['elm1']."</body></html>";
	
	$mails = array();//0 => "olegs.ivanovs@gmail.com",1=>"ooleg@inbox.lv",2=>"olegs.ivanovs@meditec.lv");
	
	$groups = "-1";
	switch ($_SESSION['params']['mailtype']){
		case "allusers":
			$groups = "8,9,10,11,12,13,14";
			break;
		case "allRacers":
			$groups = "8";
			break;
	}
	
	$sql = "SELECT  `user_email` as mail
			FROM  `phpbb_users` u
			INNER JOIN  `phpbb_user_group` ug ON ( u.`user_id` = ug.`user_id` 
							and ug.`group_id` in ( $groups ))
			GROUP BY  `user_email` ";
	
	//echo $sql;
	$r = queryDB($sql);
	print_r($r);
	 while($row = mysql_fetch_array($r, MYSQL_ASSOC)){
		 array_push($mails,$row['mail']);
	}
	
	for($i=0;$i<count($mails);$i++){
		sendMail($mails[$i],"apPasaule@apPasaule.lv", $_SESSION['params']['subj'], $text);
	}
	return 1;
}

function printMassMail($err){
	echo "<form method=\"post\" action=\"index.php\" name=\"freeRTE_content\">";
		echo "<table>";
			echo "<tr>";
				echo "<td>";
					echo "<input type=\"radio\" name=\"mailtype\" value=\"allusers\"> Visi RM lietotāji";
				echo "<td>";
					echo "<input type=\"radio\" name=\"mailtype\" value=\"allRacers\"> Visi sportisti";
				echo "<td>";
					echo "<input type=\"radio\" name=\"mailtype\" value=\"allMPSRacers\" disabled> Visi PE sportisti";
				echo "<td>";
					echo "<input type=\"radio\" name=\"mailtype\" value=\"allENDURORacers\" disabled> Visi Enduro sportisti";
				echo "<td width=\"*\">";
					echo "&nbsp";
			echo "<tr>";
				echo "<td colspan=\"5\">";
					echo "Temats: <input type=\"text\" name=\"subj\" ";
						if($err){
							echo " value=\"",$_SESSION['params']['subj'],"\"";
						}
					echo ">";
			echo "<tr>";
				echo "<td colspan=\"5\">";
					?>
					
					<script type="text/javascript" src="./rtb/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,noneditable,visualchars,nonbreaking",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "style.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Style formats
		style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'font', styles : {color : '#ff0000'}},
			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
			{title : 'Example 1', inline : 'span', classes : 'example1'},
			{title : 'Example 2', inline : 'span', classes : 'example2'},
			{title : 'Table styles'},
			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
		],

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>
<div>
			<textarea id="elm1" name="elm1" rows="15" cols="200" style="width: 80%"><?php
			if($err){
				echo $_SESSION['params']['elm1'];
			}
			?></textarea>
		</div>

					<?php
		echo "</table>";
		
		echo "<input type=\"hidden\" name=\"rm_func\" value =\"mail\">";
		echo "<input type=\"hidden\" name=\"rm_subf\" value =\"send\">";
		echo "<center><input type=\"submit\" value=\"Sūtīt\"></center>";
	echo "</form>";
}

function printMailMenu(){
	printMassMail(0);	
}
?>