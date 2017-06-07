<?php

/**
 * SEO encoder/decoder
 * @author eriks
 *
 */


class SEO
{
	
	
	function encode($id, &$title2 = "")
	{
		
		// $prefix = "/apPasaule";
		
		return BASE_URL . "?id=" . $id;
		
		$parent = $id;
		$link = Array();
		
		while($parent > 0) {
		
			$sql = "SELECT id, parent, title_lv as title FROM items WHERE id = '$parent'";
			$result = mysql_query($sql) or die(mysql_error());
			
			if($row = mysql_fetch_object($result))
			{
				// some replacements
				
				//setlocale(LC_CTYPE, "en_US.utf8");
				//$t = iconv("utf-8", "ASCII//TRANSLIT", $row->title);
				
				$link[] = str_replace("%2F", "_/", urlencode(trim($t)));
				$link2[] = trim($row->title);
				$parent = $row->parent;

			} else {
				
				$parent = 0;
			}
		
		}
		
		
		if(count($link) > 0) { 
			
			$title = urldecode(implode(" / ", array_reverse($link)));
			$title = strlen($title) > 0 ? " :: " . str_replace("_/", "/", $title) : "";
			
			
			$title2 = urldecode(implode(" / ", array_reverse($link2)));
			$title2 = strlen($title2) > 0 ? " :: " . $title2 : "";			
			
			return $prefix . "/" . implode("/", array_reverse($link));
		}
		
		return "?id=" . $id;
	}
	
	
	
	
	
	
	function decode($id)
	{
		
		return $id;
		$id = str_replace("_/", "%2F", $id);

		$link = explode("/", $id);	
		
		// ja id = number
		
		if(count($link) <= 1 && is_numeric($id))
			return $id;
		
		$parent = 0;

		foreach($link as $item)
		{

			$item =  ((String)urldecode($item));
			
			// if parent give, use it
			if($parent)
				$where = " AND parent = '$parent'";
			
			$sql = "SELECT id, parent, title_lv FROM items WHERE title_lv LIKE \"$item\" $where";
			$result = mysql_query($sql) or die(mysql_error());
			
			if($row = mysql_fetch_object($result))
			{
				$parent = $row->id;
			}
			
		}
			
			
		return $parent;
	}
}

?>