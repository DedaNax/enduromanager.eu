<?php


switch ($_REQUEST["op"])
{

	case "listGaleries":
		echo listGaleries();
		break;

	case "listImages":
		echo listImages($_REQUEST["id"]);
		break;

	case "addGalery":
		echo addGalery();
		break;

	case "delGalery":
		echo delGalery();
		break;

	case "editGalery":
		echo editGalery();
		break;


	case "delImage":
		echo delImage();
		break;

	default:
		echo "Netrāpīji..";
		exit;
		break;
}









function listImages($galeryID)
{

	require_once "mysql.php";


	$imgID = $_GET["imgID"];
	$imgPos = $_GET["imgPos"];

	if(is_numeric($imgPos))
		order($galeryID, $imgID, $imgPos);



	$sql = "SELECT * FROM galery_images WHERE objektsID='$galeryID' ORDER BY seq ASC, id";
	$result = mysql_query($sql) or die(mysql_error() . $sql); 


	//$out = "GaleryID: <b>" . $galeryID . "</b> / imgID:" . $_GET["imgID"] . ", imgPos:" . $_GET["imgPos"];

	$out .= "<table border='0'><tr>";

	while($row = mysql_fetch_object($result))
	{
		$out .= "<td id='$row->id' valign='bottom' onMouseOver=\"JavaScript:setPosition($row->id);\"
													onMouseOut=\"JavaScript:resetPosition($row->id);\"
													onMouseDown=\"JavaScript:setImage($row->id);\">
					<span onDblClick=JavaScript:delImage(".$row->id.")><img src='image.php?img=".$row->image."&w=150' border='0'></span>
				 </td>";
	}

	$out .= "</tr></table>";
	return $out;
}







function order($galeryID, $imgID, $imgPos)
{

	require_once "mysql.php";

	$sql = "SELECT * FROM galery_images WHERE objektsID = '$galeryID' ORDER BY seq, id";
	$result = mysql_query($sql) or die(mysql_error());


	$items = array();
	$k = 0;

	while($row = mysql_fetch_object($result))
	{
		
		$items[] = array("id" => $row->id, "sql" => $k);
		$k += 10;
	}



	// kārtojam jauno masīvu

	$new = array();
	$k = 0;
	$newID = findItem($imgPos, $items);
	$oldID = findItem($imgID, $items);

	if($imgID != $imgPos)
		unset($items[$oldID]);


	foreach($items as $key => $data)
	{

		if($key == $newID && $imgID != $imgPos)
		{
			$new[] = array("id" => $imgID, "seq" => $k);
			$new[] = array("id" => $data["id"], "seq" => $k += 10);

		} else {
			$new[] = array("id" => $data["id"], "seq" => $k);
		}

		$k += 10;
	}


	// updeitojam tabulu

	foreach($new as $key => $data)
	{
		
		$sql = "UPDATE galery_images SET seq = '" . $data["seq"] . "' WHERE id = '" . $data["id"] . "'";
		$result = mysql_query($sql) or die(mysql_error());
	}

}


function findItem($item, $array)
{
	
	foreach($array as $key => $data)
	{
		if($data["id"] == $item)
			return $key;
	}

}












function findFirst($galeryID)
{
	require_once "mysql.php";

	$sql = "SELECT * FROM galery_images WHERE objektsID='$galeryID' ORDER BY seq, id";
	$result = mysql_query($sql);

	if($row = mysql_fetch_object($result))
	{
		return $row->image;
	}
}








	function listGaleries()
	{

		require_once "mysql.php";

		// check tables (IF EXISTS)
		
		$sql = "CREATE TABLE IF NOT EXISTS galery_list ( id INT NOT NULL AUTO_INCREMENT, texis TEXT,  PRIMARY KEY (id));";
		$result = mysql_query($sql) or die(mysql_error(). $sql);

		$sql = "CREATE TABLE IF NOT EXISTS galery_images ( id INT NOT NULL AUTO_INCREMENT, objektsID INT, image TEXT, texis TEXT, seq INT, PRIMARY KEY (id));";
		$result = mysql_query($sql) or die(mysql_error() . $sql);
		
		// -->

		$sql = "SELECT * FROM galery_list ORDER BY id";
		$result = mysql_query($sql);

		$skaits = mysql_num_rows($result);
		$rindas = ceil($skaits / 5);

		$data = array();

		$out .= "<table width='160' border='0' cellspacing='5'>";

		while($row = mysql_fetch_object($result))
		{

			$data[] = array($row->id, findFirst($row->id), $row->texis);

			//return "<img src='image.php?img=".$row->image.$parms."' border='0' $popup>";
		}
		
		for($k=0; $k < count($data); $k+=5)
		{

			$img1 = isset($data[$k][0]) ? "<td class='box' id=".$data[$k][0]." width='150' height='120' style='border: 1px solid black;' onClick=JavaScript:selectGalery('".$data[$k][0]."'); onDblClick=JavaScript:delGalery('".$data[$k][0]."');><img src='small.gif' width='150' border='0' style='background: url(image.php?img=".str_replace('img/', '',$data[$k][1])."&w=150) no-repeat center center'><br>".$data[$k][2]."</td>" : "<td class='box' id=".$data[$k][0]." width='150' height='120' ><img src='small.gif' width='150'>".$data[$k][2]."</td>";

			$img2 = isset($data[$k+1][0]) ? "<td class='box' id=".$data[$k+1][0]." width='150' height='120' style='border: 1px solid black;' onClick=JavaScript:selectGalery('".$data[$k+1][0]."'); onDblClick=JavaScript:delGalery('".$data[$k+1][0]."');><img src='small.gif' width='150' border='0' style='background: url(image.php?img=".str_replace('img/', '',$data[$k+1][1])."&w=150) no-repeat center center'><br>".$data[$k+1][2]."</td>" : "<td class='box' id=".$data[$k+1][0]." width='150' height='120' ><img src='small.gif' width='150'>".$data[$k+1][2]."</td>";

			$img3 = isset($data[$k+2][0]) ? "<td class='box' id=".$data[$k+2][0]." width='150' height='120' style='border: 1px solid black;' onClick=JavaScript:selectGalery('".$data[$k+2][0]."'); onDblClick=JavaScript:delGalery('".$data[$k+2][0]."');><img src='small.gif' width='150' border='0' style='background: url(image.php?img=".str_replace('img/', '',$data[$k+2][1])."&w=150) no-repeat center center'><br>".$data[$k+2][2]."</td>" : "<td class='box' id=".$data[$k+2][0]." width='150' height='120' ><img src='small.gif' width='150'>".$data[$k+2][2]."</td>";

			$img4 = isset($data[$k+3][0]) ? "<td class='box' id=".$data[$k+3][0]." width='150' height='120' style='border: 1px solid black;' onClick=JavaScript:selectGalery('".$data[$k+3][0]."'); onDblClick=JavaScript:delGalery('".$data[$k+3][0]."');><img src='small.gif' width='150' border='0' style='background: url(image.php?img=".str_replace('img/', '',$data[$k+3][1])."&w=150) no-repeat center center'><br>".$data[$k+3][2]."</td>" : "<td class='box' id=".$data[$k+3][0]." width='150' height='120' ><img src='small.gif' width='150'>".$data[$k+3][2]."</td>";

			$img5 = isset($data[$k+4][0]) ? "<td class='box' id=".$data[$k+4][0]." width='150' height='120' style='border: 1px solid black;' onClick=JavaScript:selectGalery('".$data[$k+4][0]."'); onDblClick=JavaScript:delGalery('".$data[$k+4][0]."');><img src='small.gif' width='150' border='0' style='background: url(image.php?img=".str_replace('img/', '',$data[$k+4][1])."&w=150) no-repeat center center'><br>".$data[$k+4][2]."</td>" : "<td class='box' id=".$data[$k+4][0]." width='150' height='120' ><img src='small.gif' width='150'>".$data[$k+4][2]."</td>";



			$out .= "<tr>
						$img1
						$img2
						$img3
						$img4
						$img5
					</tr>";
		}
		
		$out .= "</table>";

		return $out;
	}




function addGalery()
{

	require_once "mysql.php";

	$sql = "INSERT INTO galery_list SET texis = '".$_REQUEST['id']."'";
	$result = mysql_query($sql);

	$out = listGaleries();
	return $out;
}



function delGalery()
{

	require_once "mysql.php";

	$sql = "DELETE FROM galery_list WHERE ID = '".$_REQUEST['id']."'";
	$result = mysql_query($sql);

	$sql = "SELECT * FROM galery_images WHERE objektsID='".$_REQUEST['id']."'";
	$result = mysql_query($sql);

	while($row = mysql_fetch_object($result))
	{
		@unlink("../../..".$img_path.$row->image);
	}

	$sql = "DELETE FROM galery_images WHERE objektsID = '".$_REQUEST['id']."'";
	$result = mysql_query($sql);


	$out = listGaleries();
	return $out;
}


function editGalery()
{

	require_once "mysql.php";

	$sql = "UPDATE galery_list SET texis = \"".$_REQUEST['parm']."\" WHERE id='".$_REQUEST['id']."'";
	//$sql1 = "UPDATE galery_list SET galleryCat = \"".$_REQUEST['parm']."\" WHERE id='".$_REQUEST['id']."'";
	
	$result = mysql_query($sql);
	//$result = mysql_query($sql1);


	$out = listGaleries();

	return $out;
}


function delImage()
{

	require_once "mysql.php";

	$sql = "SELECT * FROM galery_images WHERE ID = '".$_REQUEST['id']."'";
	$result = mysql_query($sql);

	if($row = mysql_fetch_object($result))
	{
		@unlink("../../..".$img_path.$row->image);
	}

	$sql = "DELETE FROM galery_images WHERE ID = '".$_REQUEST['id']."'";
	$result = mysql_query($sql);

	$out = listImages($_REQUEST['parm']);
	return $out;
}

?>