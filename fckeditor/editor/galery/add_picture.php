<html>
<head>
<META http-equiv="Content-Type" content="text/html; charset=utf-8">
<script src="ajax.js"></script>
<style>
table,body
{
	font-family: verdana;
	font-size: 10px;
}

input.button
{
	border: 1px solid black;
	width: 80px;
	font-family: verdana;
	font-size: 9px;
}
</style>
</head>
<body>

<?php

$id = $_GET['id'];

$form = "
	<form enctype='multipart/form-data' action='?id=$id' method='POST'>
		<table style='width:100%; border-collapse:collapse;' border='0'>
			<tr>
				<td align='center'>
					<input type='hidden' name='MAX_FILE_SIZE' value='1000000' />
					Attēls:
					<input name='uploadedfile' type='file' /><br />
					<input type='submit' name='submit' class='button' value='Pievienot' />
					<input type='button' class='button' value='Aizvērt' onClick=\"JavaScript:self.close();\" />
				</td>
			</tr>
		</table>
	</form>	
";

if (isset($_POST['submit'])) {	

	if (!strstr($_FILES['uploadedfile']['type'], "jpeg")) {
		
		echo $form;
		echo "<br />Attēlu pievienot neizdevās, jo tam jābūt 'jpeg' vai 'jpg' formātā!";
	
	} else {	

		include "mysql.php";

		$sql = "SELECT max(id) AS imgID FROM galery_images";
		$res = mysql_query($sql) OR die(mysql_error());
		$row = mysql_fetch_object($res);
		
		// $target_path = "../../../img/GAL".$id."_".$row->imgID.".jpg";
		
		$target_path = $img_path . "GAL".$id."_".$row->imgID.".jpg";
		$img = basename($target_path);

		if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {

			$sql = "INSERT INTO galery_images SET objektsID='$id', image='GAL".$id."_".$row->imgID.".jpg'";
			mysql_query($sql) OR die(mysql_error());
			echo $form;
			echo "<br />Attēls ". basename( $_FILES['uploadedfile']['name']). " veiksmīgi pievienots"; 

			$sql = "SELECT max(id) AS imgID FROM galery_images WHERE objektsID='$id'";
			$res = mysql_query($sql) OR die(mysql_error());
			$row = mysql_fetch_object($res);
			$dblClick = "
				<script>
					//var img = window.opener.listImages($id);
					var img = window.opener.reloadGalery();
				</script>
			";
			
			echo $dblClick;

		} else {
			
			echo $form;
			echo "<br />Pievienojot attēlu, radusies kļūda, lūdzu mēģiniet vēlreiz!";			
		}
	}

} else {

	echo $form;

}

?>

</body>
</html>
