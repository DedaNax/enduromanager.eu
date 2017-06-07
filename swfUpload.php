<?php

session_start();

define('BASE', 'userfiles/images/galerija/');

if (isset($_FILES["Filedata"]) && is_uploaded_file($_FILES["Filedata"]["tmp_name"]) && $_FILES["Filedata"]["error"] == 0) {

	$parent = $_POST["id"];
	
	@mkdir(BASE . $parent, 0777, true);
	
	$temp = $_FILES["Filedata"]["tmp_name"];
	//$name = time() . rand(10,99) . '.jpg';
		$name = $_FILES["Filedata"]["name"];
	
	if(move_uploaded_file($temp, BASE . $parent . '/' . $name)) {
	
		
		require_once("class_main.php");
		$main = new Main();
		
		$sql = 'INSERT INTO galerija 
					SET
						parent = '.(int)$parent.',
						image = "'.mysql_real_escape_string(BASE . $parent . '/' . $name).'"
				';
		$result = mysql_query($sql) or die(mysql_error() . $sql);
		
		$id = mysql_insert_id();
	}
	
	echo '<div class="imageSet" id="'.$id.'">
				<input type="hidden" name="image['.$id.']" value="'.BASE . $parent . '/' . $name.'">
				<a href="userfiles/images/1471887.jpg"  class="bilde" style="background: url(gimage.php?img='.BASE . $parent . '/' . $name.'&w=170) no-repeat center center;"></a>
				<div onClick=rmImage(this) class="delete" style="display: none; z-order: 999;"><img src="images/delete_big.gif" border="0"></div>
			</div>';	
	
	
} else {
	
	header("HTTP/1.1 500 File Upload Error");
	if (isset($_FILES["Filedata"])) {
		echo $_FILES["Filedata"]["error"];
	}
	exit(0);
}






?>
