<?php

function doLic($subf,$opt){

	switch ($subf){
		case "list":
			licList();
			break;
		case 'dellic':
			dellic($opt);
			licList();
			break;
		case 'savelic':
			savelic();
			licList();
			break;
		case "nr":
			nrList();
			break;
		case 'delnr':
			delnr($opt);
			nrList();
			break;
		case 'savenr':
			savenr();
			nrList();
			break;
		case "cpynr":
			cpynr($opt);
			nrList();
			break;
		case "getNR":
			getNR($opt);
			break;
	}

}

function getNR($nr){

	$resnr = $nr;
	$sql= "select * 
		from 
		(
			SELECT @row_number:=@row_number+1 AS row_number 
			FROM  `d_checkpoint`, (SELECT @row_number:=0) AS t	
		 ) nr 
			left join `phpbb_profile_fields_data` fd on nr.`row_number` = fd.`pf_rm_sport_nr`
		where 
			fd.`user_ID` is null				
			and  `row_number` > 0 and `row_number` < 1000
			or `row_number` = $resnr
			and `row_number` <> 1111"
			;
		
	$q_result = queryDB($sql);
	
	echo '<td ><select name = "SNR">';
		echo "<option value=\"\" ></option>";
		while($row = mysql_fetch_array($q_result, MYSQL_ASSOC)){
			echo "<option value=\"",$row["row_number"],"\" ";
			if ($row){
				if ($row["row_number"]==$resnr){echo " selected ";}
			}
			echo ">";
			echo $row["row_number"];
			echo "</option>";
		}
	echo "</select>";
	
}

function cpynr($opt){
	$sql = 'delete from `enduro_nr` where `yr` = '.$opt;
	queryDB($sql);
	$sql = 'insert into `enduro_nr` (`YR` , `COMMENT` , `NR` , `COUNTRY` , `CLUB` , `RACER_ID` ) select '.$opt.',  `COMMENT`,  `NR` , `COUNTRY`,  `CLUB`  ,`RACER_ID` from `enduro_nr` where `yr` = '.($opt -1);
	echo $sql;
	queryDB($sql);
	
}


function savelic(){

	$sql = '';

	if ($_SESSION['params']['ID']){
		$sql = "UPDATE `enduro_licence` 
				SET `RACER_ID`= ".$_SESSION['params']['RACER_ID'].",`LIC_NR`='".$_SESSION['params']['LIC_NR']."',`TYPE`='".$_SESSION['params']['LIC_TYPE']."',`CLUB`=".$_SESSION['params']['LIC_CLUB'].",`COUNTRY` = ".$_SESSION['params']['LIC_COUNTRY']." ,`START_DATE`='".formatDate($_SESSION['params']['LIC_FROM'])."' 
				WHERE `ID` = ".$_SESSION['params']['ID'];
		/*$sql = "UPDATE `enduro_licence` 
				SET `RACER_ID`= ".$_SESSION['params']['RACER_ID'].",`LIC_NR`='".$_SESSION['params']['LIC_NR']."',`CLUB`=".$_SESSION['params']['LIC_CLUB'].",`COUNTRY` = null ,`TYPE`='".$_SESSION['params']['LIC_TYPE']."',`START_DATE`='".formatDate($_SESSION['params']['LIC_FROM'])."',`END_DATE`='".formatDate($_SESSION['params']['LIC_TO'])."' 
				WHERE `ID` = ".$_SESSION['params']['ID'];*/
	} else {
		$sql = "INSERT INTO `enduro_licence`( `RACER_ID`, `LIC_NR`, `CLUB`, `COUNTRY`,`TYPE`, `START_DATE`) VALUES 
											(".$_SESSION['params']['RACER_ID'].",'".$_SESSION['params']['LIC_NR']."',".$_SESSION['params']['LIC_CLUB'].",".$_SESSION['params']['LIC_COUNTRY'].",'".$_SESSION['params']['LIC_TYPE']."','".formatDate($_SESSION['params']['LIC_FROM'])."')";
		/*$sql = "INSERT INTO `enduro_licence`( `RACER_ID`, `LIC_NR`, `CLUB`, `COUNTRY`, `TYPE`, `START_DATE`, `END_DATE`) VALUES 
											(".$_SESSION['params']['RACER_ID'].",'".$_SESSION['params']['LIC_NR']."',".$_SESSION['params']['LIC_CLUB'].",null,'".$_SESSION['params']['LIC_TYPE']."','".formatDate($_SESSION['params']['LIC_FROM'])."','".formatDate($_SESSION['params']['LIC_TO'])."')";*/
	}
	
	//echo $sql;
	if ($sql != ''){
		
		queryDB($sql);
	}
	$sql = '';
	if ($_SESSION['params']['SNR']){
		$sql = '
			update 
				`phpbb_profile_fields_data`
			set 
				`pf_rm_sport_nr` = '.$_SESSION['params']['SNR'].'
			where 
				`user_id` = '.$_SESSION['params']['RACER_ID'];
	} elseIF ($_SESSION['params']['ID']){
		$sql = '
			update 
				`phpbb_profile_fields_data`
			set 
				`pf_rm_sport_nr` = null
			where 
				`user_id` = '.$_SESSION['params']['RACER_ID'];
	}
	
	if ($sql != ''){		
		queryDB($sql);
	}
	
}

function savenr(){

	$sql = '';

	if ($_SESSION['params']['ID']){
		$sql = "UPDATE `enduro_nr` 
				SET `RACER_ID`= ".$_SESSION['params']['RACER_ID'].",`NR`='".$_SESSION['params']['NR_NR']."',`YR`=".$_SESSION['params']['NR_YR'].",`COMMENT`='".$_SESSION['params']['NR_COMMENT']."' 
				WHERE `ID` = ".$_SESSION['params']['ID'];
	} else {
		$sql = "INSERT INTO `enduro_nr`( `RACER_ID`, `NR`,   `YR`, `COMMENT`) VALUES 
											(".$_SESSION['params']['RACER_ID'].",'".$_SESSION['params']['NR_NR']."',".$_SESSION['params']['NR_YR'].",'".$_SESSION['params']['NR_COMMENT']."')";
	}
	
	/*if ($_SESSION['params']['ID']){
		$sql = "UPDATE `enduro_nr` 
				SET `RACER_ID`= ".$_SESSION['params']['RACER_ID'].",`NR`='".$_SESSION['params']['NR_NR']."',`CLUB`=".$_SESSION['params']['NR_CLUB'].",`COUNTRY` = '".$_SESSION['params']['NR_COUNTRY']."' ,`YR`=".$_SESSION['params']['NR_YR'].",`COMMENT`='".$_SESSION['params']['NR_COMMENT']."' 
				WHERE `ID` = ".$_SESSION['params']['ID'];
	} else {
		$sql = "INSERT INTO `enduro_nr`( `RACER_ID`, `NR`, `CLUB`, `COUNTRY`,  `YR`, `COMMENT`) VALUES 
											(".$_SESSION['params']['RACER_ID'].",'".$_SESSION['params']['NR_NR']."',".$_SESSION['params']['NR_CLUB'].",'".$_SESSION['params']['NR_COUNTRY']."',".$_SESSION['params']['NR_YR'].",'".$_SESSION['params']['NR_COMMENT']."')";
	}*/
	
	//echo $sql;
	if ($sql != ''){
		
		queryDB($sql);
	}


}

function dellic($opt){
	$sql = "delete from `enduro_licence` where `ID` = $opt";
	queryDB($sql);
}
function delnr($opt){
	$sql = "delete from `enduro_nr` where `ID` = $opt";
	queryDB($sql);
}
function LICSQL(){
return '
		SELECT 			
			el.`ID`,
			el.`LIC_NR`, 
			
			el.`TYPE`, 
			
			DATE_FORMAT(el.`START_DATE`,\'%d.%m.%Y\') as START_DATE, 
			
			el.`CLUB`, 				
			kl.`name` as KLUB_NAME,
			
			el.`COUNTRY`, 
			cntr.`lang_value` as COUNTRY_NAME,
			
			el.`RACER_ID`,
			pd.`pf_rm_f_name` as F_NAME,
			pd.`pf_rm_l_name` as L_NAME,
			pd.`pf_rm_pk` as PK,
			
			pd.`pf_rm_sport_nr` as NR
		FROM 
			`enduro_licence` el				
				inner join `phpbb_profile_fields_data` pd on (pd.`user_id` = el.`racer_id`)
				left join `c_club` kl on kl.`id` = el.`CLUB`
				left join `phpbb_profile_fields_lang` cntr on cntr.`field_id` = '.KL_COUNT.' and cntr.`option_id` = el.`COUNTRY`
	';
}

function NRSQL(){
return '
		SELECT 			
			enr.`ID`,
			enr.`NR`, 			
			
			enr.`YR`,
			
			enr.`CLUB`, 				
			kl.`name` as KLUB_NAME,
			
			enr.`COUNTRY`, 
			cntr.`lang_value` as COUNTRY_NAME,
			
			enr.`RACER_ID`,
			pd.`pf_rm_f_name` as F_NAME,
			pd.`pf_rm_l_name` as L_NAME,
			pd.`pf_rm_pk` as PK,
			
			enr.`COMMENT`
		FROM 
			`enduro_nr` enr				
				inner join `phpbb_profile_fields_data` pd on (pd.`user_id` = enr.`racer_id`)
				left join `c_club` kl on  kl.`id` = enr.`CLUB`
				left join `phpbb_profile_fields_lang` cntr on cntr.`field_id` = '.KL_COUNT.' and cntr.`option_id` = enr.`COUNTRY`
	';
}

function nrList(){
    $rcm = new RacerManager;
	$cm = new champManager;
	
	$yr = isset($_SESSION['params']['yr']) ? $_SESSION['params']['yr'] : date('Y');
	
	$sql = "select min(`YR`) as ymin , max(`YR`) as ymax from `enduro_nr`";
	$q_result = queryDB($sql);
	
	$row = mysql_fetch_array($q_result, MYSQL_ASSOC);
	//echo $yr; print_r($row);
	echo "<p width=\"100%\" align=\"center\">";
	$j = 0;
	for ($i = ($row['ymin'] > $yr ? $yr: $row['ymin']); $i <= ($row['ymax']+1 > $yr ? $row['ymax']+1 : $yr) ;$i++){
		$j++;
		if($j==10){
			echo "<br>";
			$j=0;
		}
		echo '<a class="YRfilter" href="?rm_func=lic&rm_subf=nr&yr='.$i.'" '.($i==$yr?'style="background-color: #9CA9C3"':'').'>'.$i.'</a>&nbsp&nbsp&nbsp';
	}
	echo "</p>";
	
	
	
	echo "<a onclick=\"confDelGet('".NR_CPY_CONFIRM   ."','index.php?rm_func=lic&rm_subf=cpynr&opt=$yr&yr=$yr')\">Kopēt iepriekšējo gadu </a>";
	
	
	$reslt = array();		
	echo "<table width=\"100%\" border=\"1\">";
	echo '<tr class="title"><td>&nbsp<td>'.LIC_NR_NR.'<td>'.LIC_LIC_RACER.'<td>'.LIC_LIC_PK./*'<td>'.LIC_LIC_CLUB.*/'<td>'.LIC_NR_YR./*'<td>'.LIC_NR_COUNTRY.*/'<td>'.LIC_NR_COMMENT;
	
	echo "<form action=\"index.php\" method=\"post\" id=\"NR_FORM\">";
	echo '<tr ><td width="40px" ><img src= "./images/CHECK_16x16.png" align="right"
			onclick="submitForm(\'NR_FORM\');"																	
			onmouseover="document.body.style.cursor = \'pointer\'"
			onmouseout = "document.body.style.cursor = \'default\'"
	 
	>';
		echo '<td width= "30px"><input style="width: 30px;"  type="text" name="NR_NR" id="NR_NR">';
		echo '<td colspan="2"><img src="./images/User_32x32.png" width="16" height="16"			
					onclick="showRacerList(this,hs);"																	
					onmouseover="document.body.style.cursor = \'pointer\'"
					onmouseout = "document.body.style.cursor = \'default\'"				
		> ';	
		echo "<div class=\"highslide-maincontent\" id=\"divx\"></div>";
		echo "<input type=\"text\" name=\"NAME\" style=\"border: 0;\" readonly id=\"NAME\">";
		/*$list = $rcm->getClub("");
		echo '<td style="width: 110px;"><select name = "NR_CLUB" id = "NR_CLUB" style="width: 110px;">';
		for($i=0;$i<count($list);$i++){
			echo "<option value=\"",$list[$i]->getID(),"\">";
			echo $list[$i]->getName();
			echo "</option>";
		}
		echo "</select>";*/	
		
		echo '<td style="width: 60px;"><select name = "NR_YR" id = "NR_YR" style="width: 60px;">';
		for($i=($row['ymin'] > $yr ? date('Y'): $row['ymin'])-1; $i <= (($row['ymax'] > date('Y') ? $row['ymax'] : $yr)+1);$i++){
			echo "<option value=\"",$i,"\">";
			echo $i;
			echo "</option>";
		}
		echo "</select>";
		
		/*$list = $cm->getCountry();
		echo '<td style="width: 110px;"><select name = "NR_COUNTRY" id = "NR_COUNTRY" style="width: 110px;">';
		for($i=0;$i<count($list);$i++){
			echo "<option value=\"",$list[$i]->getID(),"\">";
			echo $list[$i]->getName();
			echo "</option>";
		}
		echo "</select>";*/
		
		echo "<td style=\"width: 120px\"><input type=\"text\" name=\"NR_COMMENT\"  id=\"NR_COMMENT\" style=\"width: 120px\">";
				
			
		
		echo "<input type=\"hidden\" value=\"$yr\" name = \"yr\">";
		echo "<input type=\"hidden\" value=\"\" name = \"RACER_ID\" id = \"RACER_ID\">";
		echo "<input type=\"hidden\" value=\"\" name = \"ID\" id = \"ID\">";
		echo "<input type=\"hidden\" value=\"lic\" name = \"rm_func\" >";
		echo "<input type=\"hidden\" value=\"savenr\" name = \"rm_subf\" >";
	echo "</form>";
	
	$sql = NRSQL();
	$sql = $sql. '
	WHERE
		'.$yr.' = enr.`YR`
	ORDER BY `NR`';
	
	$q_result = queryDB($sql);
	while ($row = mysql_fetch_array($q_result, MYSQL_ASSOC)) {
		$readonly = 0;
		
		echo '<tr>';
		echo '<td>';
			if (!$readonly){
				
				echo '<img src = "./images/PageWhiteEdit_16x16.png" alt="Atvērt" title="Atvērt" border = "0"			
					onclick="editNR('.$row['ID'].',\''.$row['NR'].'\','.$row['RACER_ID'].',\''.$row['F_NAME'].' '.$row['L_NAME'].'\',1'./*$row['CLUB'].*/','.$row['YR'].',\''.$row['COMMENT'].'\',1'./*$row['COUNTRY'].*/');"																	
					onmouseover="document.body.style.cursor = \'pointer\'"
					onmouseout = "document.body.style.cursor = \'default\'"				
				> ';
				
			} else {
				echo "<img src = \"./images/PageWhiteEdit_16x16_gray.png\" alt=\"Atvērt\" title=\"Atvērt\" border = \"0\">";
			}
				
			echo " <a onclick=\"confDelGet('".DEL_CONFIRM."','index.php?rm_func=lic&rm_subf=delnr&opt=".$row['ID']."')\">";
				echo "<img src=\"./images/RedCross_16x16.png\" border = \"0\" alt=\"Dzēst\" title=\"Dzēst\" 
					onmouseover=\"document.body.style.cursor = 'pointer'\"
					onmouseout = \"document.body.style.cursor = 'default'\"
				>";
			echo "</a>";
		
		
		$sql = "select 
					`racer_id`,
					pd.`pf_rm_f_name` as F_NAME,
					pd.`pf_rm_l_name` as L_NAME
				from `enduro_nr` enr
					inner join `phpbb_profile_fields_data` pd on (pd.`user_id` = enr.`racer_id`)
				where enr.`YR` = $yr and enr.`NR` = '".$row['NR']."' and enr.`racer_id` <> ".$row['RACER_ID']."";
		$q_result_dbl_nr = queryDB($sql);
	
		$row_wrn = mysql_fetch_array($q_result_dbl_nr, MYSQL_ASSOC);
		$warn = '';
		if ($row_wrn ){
			$warn = ' style="background-color: #FF3333" title="'.$row_wrn['F_NAME'].' '.$row_wrn['L_NAME'].'"';
		}
		echo '<td '.$warn.'>'.$row['NR'].'<td>'.$row['F_NAME'].' '.$row['L_NAME'].'<td>'.$row['PK']./*'<td>'.$row['KLUB_NAME'].*/'<td>'.$row['YR']./*'<td>'.$row['COUNTRY_NAME'].*/'<td>'.$row['COMMENT'];	
	}
	echo "</table>";
	
	
}

function formatDate($d){

	$d = str_replace("-",".",$d);
	
	$expl = explode(".",$d);
	
	return $expl[2].".".$expl[1].".".$expl[0];

}


function licList(){
    $rcm = new RacerManager;
	$cm = new champManager;	
	$yr = isset($_SESSION['params']['yr']) ? $_SESSION['params']['yr'] : date('Y');
	
	$sql = "select min(year(`START_DATE`)) as ymin , max(year(`START_DATE`)) as ymax from `enduro_licence`";
	$q_result = queryDB($sql);
	
	$row = mysql_fetch_array($q_result, MYSQL_ASSOC);

	echo "<p width=\"100%\" align=\"center\">";
	$j = 0;
	for ($i = ($row['ymin'] > $yr ? $yr: $row['ymin']); $i <= max($row['ymax'] , date('Y')) ;$i++){
		$j++;
		if($j==10){
			echo "<br>";
			$j=0;
		}
		echo '<a class="YRfilter" href="?rm_func=lic&rm_subf=list&yr='.$i.'" '.($i==$yr?'style="background-color: #9CA9C3"':'').'>'.$i.'</a>&nbsp&nbsp&nbsp';
	}
	echo "</p>";
	
	$sql = LICSQL();
	$sql = $sql. '
	WHERE
		'.$yr.' = year(el.`START_DATE`) 
	ORDER BY `LIC_NR` asc';
	
	//echo $sql;
	$q_result = queryDB($sql);
		
	
	
	$reslt = array();		
	echo "<table width=\"100%\" border=\"1\">";
	echo '<tr class="title"><td>&nbsp<td>'.LIC_LIC_NR.'<td>'.LIC_LIC_TYPE.'<td>'.LIC_LIC_RACER.'<td>'.LIC_LIC_PK.'<td>'.LIC_LIC_CLUB.'<td>'.LIC_LIC_COUNTRY.'<td>'.LIC_LIC_FROM;//'<td>'.LIC_LIC_TO;
	
	echo "<form action=\"index.php\" method=\"post\" id=\"LIC_FORM\">";
	echo '<tr ><td width="40px" ><img src= "./images/CHECK_16x16.png" align="right"
			onclick="submitForm(\'LIC_FORM\');"																	
			onmouseover="document.body.style.cursor = \'pointer\'"
			onmouseout = "document.body.style.cursor = \'default\'"
	 
	>';
		echo '<td width= "65px"><input style="width: 65px;"  type="text" name="LIC_NR" id="LIC_NR">';
		
		echo '<td width= "35px" ><select style="width: 35px;" type="text" name="LIC_TYPE" id="LIC_TYPE">';
			echo '<option value = "ALL" selected >ALL</option>';
			echo '<option value = "P">P</option>';
			echo '<option value = "4H">4H</option>';
		echo '</select>';
		
		echo '<td colspan="2">';
		
		$resnr = 1111;
		$sql= "select * 
			from 
			(
				SELECT @row_number:=@row_number+1 AS row_number 
				FROM  `d_checkpoint`, (SELECT @row_number:=0) AS t	
			 ) nr 
				left join `phpbb_profile_fields_data` fd on nr.`row_number` = fd.`pf_rm_sport_nr`
			where 
				fd.`user_ID` is null				
				and  `row_number` > 0 and `row_number` < 1000
				or `row_number` = $resnr
				and `row_number` <> 1111"
				;
			
		$q_result1 = queryDB($sql);
		
		echo '<select name = "SNR"  style="width: 50px;" id="SNR">';
			echo "<option value=\"\" ></option>";
			while($row1 = mysql_fetch_array($q_result1, MYSQL_ASSOC)){
				echo "<option value=\"",$row1["row_number"],"\" ";
				if ($row1){
					if ($row1["row_number"]==$resnr){echo " selected ";}
				}
				echo ">";
				echo $row1["row_number"];
				echo "</option>";
			}
		echo "</select>";
				
		echo '<img src="./images/User_32x32.png" width="16" height="16"			
					onclick="showRacerList(this,hs);"																	
					onmouseover="document.body.style.cursor = \'pointer\'"
					onmouseout = "document.body.style.cursor = \'default\'"				
		> ';	
		
		echo "<input type=\"text\" name=\"NAME\" style=\"width: 100px;border: 0;\" readonly id=\"NAME\">";
		echo "<div class=\"highslide-maincontent\" id=\"divx\"></div>";
		$list = $rcm->getClub("");
		
		echo "<script>";
			echo 'var clubs = {';
				for($i=0;$i<count($list);$i++){
					echo $list[$i]->getID()?$list[$i]->getID():'null',":";
					echo $list[$i]->getCountry() ? $list[$i]->getCountry() : 'null',",";
				}
				echo 'x:"x"';
			echo '};';
		
		echo "</script>";
		
		echo '<td style="width: 150px;"><select name = "LIC_CLUB" id = "LIC_CLUB" style="width: 150px;" onchange="setCountry();">';
		for($i=0;$i<count($list);$i++){
			echo "<option value=\"",$list[$i]->getID(),"\">";
			echo $list[$i]->getName();
			echo "</option>";
		}
		echo "</select>";	
		
		
		
		$list = $cm->getCountry();
		echo '<td style="width: 100px;"><select name = "LIC_COUNTRY" id = "LIC_COUNTRY" style="width: 100px;">';
		for($i=0;$i<count($list);$i++){
			echo "<option value=\"",$list[$i]->getID(),"\">";
			echo $list[$i]->getName();
			echo "</option>";
		}
		echo "</select>";
		
		echo '<td style="width: 70px;"><input style="width: 70px;"  type="text" name="LIC_FROM" id="LIC_FROM">';
		echo "<script type=\"text/javascript\">
			$(function(){
				$('*[name=LIC_FROM]').appendDtpicker({
					\"dateOnly\": true,
					\"dateFormat\": \"DD-MM-YYYY\"						
				});
			});
		</script>";
	
		echo "<input type=\"hidden\" value=\"$yr\" name = \"yr\">";
		echo "<input type=\"hidden\" value=\"\" name = \"RACER_ID\" id = \"RACER_ID\">";
		echo "<input type=\"hidden\" value=\"\" name = \"ID\" id = \"ID\">";
		echo "<input type=\"hidden\" value=\"lic\" name = \"rm_func\" >";
		echo "<input type=\"hidden\" value=\"savelic\" name = \"rm_subf\" >";
	echo "</form>";
	
	while ($row = mysql_fetch_array($q_result, MYSQL_ASSOC)) {
		$readonly = 0;
		
		echo '<tr>';
		echo '<td>';
			if (!$readonly){
				
				echo '<img src = "./images/PageWhiteEdit_16x16.png" alt="Atvērt" title="Atvērt" border = "0"			
					onclick="editLIC('.$row['ID'].',\''.$row['LIC_NR'].'\','.'\''.$row['TYPE'].'\','.$row['RACER_ID'].',\''.$row['F_NAME'].' '.$row['L_NAME'].'\','.$row['CLUB'].','.($row['COUNTRY']?$row['COUNTRY']:-1).',\''.$row['START_DATE'].'\',\'\''./*',\''.$row['END_DATE'].'\''*/',',$row['NR']?$row['NR']:"1111",');"																	
					onmouseover="document.body.style.cursor = \'pointer\'"
					onmouseout = "document.body.style.cursor = \'default\'"				
				> ';
				
			} else {
				echo "<img src = \"./images/PageWhiteEdit_16x16_gray.png\" alt=\"Atvērt\" title=\"Atvērt\" border = \"0\">";
			}
				
			echo " <a onclick=\"confDelGet('".DEL_CONFIRM."','index.php?rm_func=lic&rm_subf=dellic&opt=".$row['ID']."')\">";
				echo "<img src=\"./images/RedCross_16x16.png\" border = \"0\" alt=\"Dzēst\" title=\"Dzēst\" 
					onmouseover=\"document.body.style.cursor = 'pointer'\"
					onmouseout = \"document.body.style.cursor = 'default'\"
				>";
			echo "</a>";
		
		echo '<td>'.$row['LIC_NR'].'<td>'.$row['TYPE'].'<td>';
		if ($row['NR']){
			echo "(".$row['NR'].") ";
		}
		echo $row['F_NAME'].' '.$row['L_NAME'].'<td>'.$row['PK'].'<td>'.$row['KLUB_NAME'].'<td>'.$row['COUNTRY_NAME'].'<td>'.$row['START_DATE'];//.'<td>'.$row['END_DATE'];	
	}
	echo "</table>";
	
	
}

?>