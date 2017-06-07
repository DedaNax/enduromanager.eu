<?php
ini_set('display_errors','1');
ini_set('display_startup_errors','1');
error_reporting (E_ALL);
require_once "mysql.php";

function getGalleryVal($id)
	{

		// $bin = true dabuusim masīvu ar id, $bin = false dabūsim tekstu
		//$out = array();
		echo $this;
		$sql = "SELECT galery_list.id, galery_list.texis, galery_list.galleryMarker FROM galery_list WHERE galery_list.id = \'".$id."\'";

		$result = mysql_query($sql);
		$result = mysql_query($sql) or $this->debug($sql, mysql_error());
		while($row = mysql_fetch_object($result))
		{
			$out[$row->id] = array('title' => $row->title, 'objType' => $row->objType);
			echo 1;
		}
	
		return $out;
	}
?>

<html>
<head>
<META http-equiv="Content-Type" content="text/html; charset=utf-8">
<script src="ajax.js">
</script>
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




if (isset($_GET['id']))
	{
		$galeryID=getGalleryVal($id);

		echo "<form enctype='multipart/form-data' action='?id=$id' method='POST'>
			<table style='width:100%; border-collapse:collapse;' border='0'>
			<tr>
			<td align='center'>
			<input type='hidden' name='$galeryID'/>
		    <input type='text' name='galeryName'/>
		    <input type='text' name='galeryCat'/>
	 	    <input type='submit' name='submit' class='button' value='Ok' />
		    <input type='button' class='button' value='Aizvērt' onClick=\"JavaScript:self.close();\" />
			</td>
			</tr>
		    </table>
			</form>";
	}


if (isset($_POST['submit'])) 
	{
        
	
		$sql = "UPDATE galery_list SET texis = \"".$galeryName."\" WHERE id='".$galeryId."\"'";
			
		$result = mysql_query($sql);
		$result = mysql_query($sql1);
					
		$out = listGaleries();
		return $out;
							
	}    



?>
</BODY>
</HTML>
