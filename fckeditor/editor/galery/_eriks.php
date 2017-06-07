<?php


include "mysql.php";

$sql = "SELECT * FROM galery_images WHERE objektsID = 75 ORDER BY seq, id LIMIT 7";
$result = mysql_query($sql) or die(mysql_error());


$items = array();
$k = 0;

while($row = mysql_fetch_object($result))
{
	
	$items[] = array("id" => $row->id, "sql" => $k);
	$k += 10;
}


echo "<pre>";
print_r($items);
echo "</pre>";

// [5] 577 seq:50 -> [1] 573 seq:10
$imgID = 573;
$imgPos = 572;


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


echo "<pre>";
print_r($new);
echo "</pre>";










function findItem($item, $array)
{
	
	foreach($array as $key => $data)
	{
		if($data["id"] == $item)
			return $key;
	}

}


?>