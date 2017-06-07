<?php 
	error_reporting(E_ALL ^ E_NOTICE);
    ini_set('display_errors','On');

	include "AP.php";
	include "engine/conf.php";
	include "engine/util.php";	
	include "engine/d_race.php";
	include "engine/d_champ.php";
	
	$connection = mysql_connect(RM_DB_ADDRESS,RM_DB_USER,RM_DB_PASS);
	mysql_select_db(RM_DB_NAME, $connection);

	$rm = new raceManager;
	$cm = new champManager;
	$cl = $cm->getClass($_GET['class'],1);
	$filename = "KK-".strtoupper(substr($cl[0]->getName(),0,2));
	header( 'Content-Disposition: attachment; filename="'.$filename.'.doc"' );


	function getKPCount(){
		$rm = new raceManager;
		$list = $rm->getChpoint("",$_GET['race'],"","");
		$i=0;
		$cntr=0;
		while(isset($list[$i])){
			$item = $rm->getChpDet("",$_GET['class'],$list[$i]->getId());
			if($item and (strtoupper(substr($list[$i]->getName(),0,2)) <> "SU")){
				$cntr++;
			}
			$i++;
		}
		echo $cntr;
	}
	
	function getName(){
		$rm = new raceManager;
		$item = $rm->getRace($_GET['race'],"","","","","","");
		if ($item){
			echo $item[0]->getName(),"<br>",$item[0]->getDate();
		}
	}
	
	function getClass(){
		$cm = new champManager;
		$item = $cm->getClass($_GET['class'],1);
		if ($item){
			echo "Klase:", $item[0]->getName();
		}
	}
	
	function getMaxPoint(){
		$rm = new raceManager;
		$list = $rm->getChpoint("",$_GET['race'],"","");
		$i=0;
		$cntr=0;
		while(isset($list[$i])){
			$item = $rm->getChpDet("",$_GET['class'],$list[$i]->getId());
			if($item and (strtoupper(substr($list[$i]->getName(),0,2)) <> "SU")){
				$cntr+=$list[$i]->getCost();
			}
			$i++;
		}
		echo $cntr;
	}
	
	$ap = new AP;

	
	
echo "<html lang=\"lv\" xml:lang=\"lv\">
	<head>
		<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />	
		
		<style type=\"text/css\">
			tr.head{
				font-weight: bold;
				text-align: center;
			}
		</style>
</head>
<body>
	<table width=\"100%\" border=\"1\" style=\"border-collapse:collapse; border-color:black;\">
		<tr >
			<td align=\"center\">
				<b>Piedzīvojumu enduro sacensības</b>
				<br><b><font size=\"5\">",getName(),"</font></b>
				<br><u><b>KONTROLKARTE-LEĢENDA</b></u>			
		<tr>
			<td>
			<table width=\"100%\" border=\"1\" style=\"border-collapse:collapse; border-color:black;\">
				<tr><td width=\"50%\"><font size=\"4\"> <br>Komandas nosaukums:....................................
				<br> <br>Starta numuri:..................................................<br><br></font>
				<td align=\"center\"width=\"50%\" ><h2>",getClass(),"</h2>
			</table>
			
		<tr>
			<td valign=\"center\" >
				<u>Tehniskā informācija:</u>
				<table width=\"100%\" border = \"1\" >
					<tr valign=\"top\">
						<td width=\"230\" style=\"border-collapse:collapse; border-color:black;\">
							Organizatori:<br>
														
								1) Raivis Ansviesulis - 29234411<br>
								2) Jānis Vēvers - 29219436<br>
								3) Agnese Evarsone - 26491184<br>						
							</ol>
						<td width=\"500\" style=\"border-collapse:collapse; border-color:black;\">
							Kartes, kontrolpunkti:<br>
							
								1) KP skaits (bez SU):<b>",getKPCount(),"</b><br>
								2) Max punktu skaits (bez SU):<b>",getMaxPoint(),"</b><br>
								3) Karšu mērogs: <b>1:50’000</b> (kvadrāts=1km)<br>
							
						<td  style=\"border-collapse:collapse; border-color:black;\">	
							Laika Kontroles (LK):";
							
							
							
								$sf = $rm->getRaceSTFDet($_GET['race'],$_GET['class']);
								for($i=0;$i<count($sf);$i++){
									echo "<br>",$i+1,") <b>",$sf[$i]->getName(),"</b>: ";
									
									
									
									Switch(date("D",mktime(0, 0, 0, substr($sf[$i]->getStart(),5,2), substr($sf[$i]->getStart(),8,2), substr($sf[$i]->getStart(),0,4))))
									{
										case "Sun";
											echo "Svēt";
											break;
										case "Mon";
											echo "Pirm";
											break;
										case "Tue";
											echo "Otrd";
											break;
										case "Wed";
											echo "Treš";
											break;
										case "Thu";
											echo "Cet";
											break;
										case "Fri";
											echo "Piek";
											break;
										case "Sat";
											echo "Sest";
											break;
										
									}
									echo " ",substr($sf[$i]->getStart(),11,5);
									echo "-",substr($sf[$i]->getFin(),11,5);
								}
							echo "
							
							
				</table>
		<tr>					
			<td valign=\"top\">
				<u>Papildus paskaidrojumi:</u>	<br>			
				
				1) <b>Par FOTO:</b> fotogrāfijai kontrolpunktā OBLIGĀTI jāatbilst foto uzdevumam (ailīte FOTO):
	   <b>M</b> – mocis; <b>X</b> – sportists; <b>Z</b> - ZĪME punktā; <b>O</b> – Objekts 
	   Piem: MMXZ - fotogrāfijā jābūt redzamiem abiem močiem (M), vienam dalībniekam (X) un Zīmei (Z)
	<br>2)  Par LK: Komandām doti starta un finiša laiki posmiem, komanda nedrīkst startēt pirms starta laika, kā arī par posma (starp-finiša) kavējumu komanda saņem soda punktus (1min= -1p)

	</table><br>";
		
	echo "<table width=\"100%\" border=\"1\" style=\"border-collapse:collapse; border-color:black\"><tr class=\"head\"><td>Nr<td>Apraksts<td>FOTO<td>Uzdevums / Jautājums<td>Atbilde";
	$rm = new raceManager;
	$cm = new champManager;
	$list = $rm->getChpoint("",$_GET['race'],"","");
	$i=0;
	
	while(isset($list[$i])){
		$item = $rm->getChpDet("",$_GET['class'],$list[$i]->getId());
		if(count($item) > 0){
			echo "<tr>";
			echo "<td>",$list[$i]->getName(),$list[$i]->getCost();
			echo "<td>",$list[$i]->getDescr();
			if ($list[$i]->getCtD()){
				echo "<br>",  $list[$i]->getVch(),"<sup>o</sup> ",$list[$i]->getVcm(),".",$list[$i]->getVcmp(),"' ",$list[$i]->getVcoffset(),"<br>",$list[$i]->getHch(),"<sup>o</sup> ",$list[$i]->getHcm(),".",$list[$i]->getHcmp(),"' ",$list[$i]->getHcoffset();	
			}
			
			$dif=$cm->getPTask($item[0]->getDiff());
			if($dif){
				echo "<td>",$dif[0]->getName();				
			}
				
			echo "<td>",$list[$i]->getQuest();
			echo "<td>&nbsp";
		}
		$i++;
	}
	echo "</table>";

	mysql_close ($connection);
	echo "</body>
</html>";
?>
	