<?php

class Galerija extends Plugin {
	
	
	var $objType 	= 0;
	var $objTitle 	= "Galerija";
	
	
	
	
	
	function objType() {
		
		return false;
	}
	
	
	
	
	
	
	
	
	
	function body(&$row, &$out) {
		
		if($this->ref->root == 7) {

			$out = '<div class="locator"><h1>' . $this->ref->showLocatorPublic() . '</h1></div>';
			
			$folders = $this->folders($row);
			$out .= '<div class="galerijas">' . $folders;
			$out .= '<div style="clear: both;"></div></div>';
			
			//if(!$folders) {
				$out .= '<div id="galerija" class="galerijas images">
							' . $this->images($row) . '
							<div style="clear: both;"></div>
						</div>';
			//}
			
		}
		
		return false;		
	}	
	
	
	
	
	
	function folders($row) {
		
		if(!$this->ref->isAdmin) {
			
			$bb3auth = new BB3Auth();
			$priv = $bb3auth->check('u_galerija_priv') ? ' AND active = 1' : ' AND active = 1 AND priv < 1';
		}		
		
		$sql = "SELECT
					id, objType, parent,
					title_".$this->ref->lang." as title 
				FROM items WHERE parent = " . (int)$row->id . $priv . " ORDER BY seq, id";
		$result = mysql_query($sql) or die(mysql_error().$sql);
		
		$out = "";
		
		while($row = mysql_fetch_object($result)) {

			$out .= $this->folder_template($row);
		}
		
		return $out;
	}

	
	
	function folder_template(&$row) {
		
		$link = $this->ref->isAdmin ? '?id=' . $row->id : SEO::encode($row->id, $row->title);
		
		$out = '<div class="galerija">
					<a href="'.$link.'"><img src="'.BASE_URL.'images/folder.png" alt="" border="0" /></a>
					<div class="title"><a href="'.$link.'">'.$row->title.'</a></div>
				</div>';
		
		return $out;
	}
	
	
	
	
	
	
	function adminBody(&$row, &$out) {

		if($this->ref->root == 7) {
		
			//$out = '<div class="locator"><h1>' . $this->ref->showLocatorPublic() . '</h1></div>';
			
			$folders = $this->folders($row);
			$out .= '<div class="galerijas">' . $folders . '<br style="clear: both;"></div>';
			$out .= '';
			
			//if(!$folders) {
				$out .= '<div id="galerija" class="galerijas images">' . $this->images($row) . '<br style="clear: both;"></div>';
				$out .= '';
			//}
		
		}
	}
	
	
	
	
	
	function editor(&$row, &$out, $lang) {

		if($this->ref->root == 7) {
		
			if($lang == 'lv') {
			
				$out = '<div>';
		
			   	$out .= '<div style="position: relative; height: 22px;">
							<span id="upload">upload</span>
							<input id="uploadCancel" type="button" value="Atcelt" onclick="cancelQueue(upload);" disabled="disabled" style="position: absolute; top: 0;">
						</div>';

				$out .= '<div id="uploadProgress"></div>';
	
				
				$out .= '<div id="galerija" style="margin-top: 10px; height: 83%; width: 98%; position: absolute; overflow-y: scroll;">
						 	'.$this->images($row, true).'
						 </div>';
				
				$out .= '</div>';
				
			
			} else {
				
				$out = '';
			}
		}
			
		return $out;
	}
	

	
	
	
	function images($row, $allow = false) {

		if(!$this->ref->isAdmin) {
			
			$bb3auth = new BB3Auth();
			$priv = $bb3auth->check('u_galerija_priv') ? ' AND active = 1' : ' AND active = 1 AND priv < 1';
		}

		$sql = 'SELECT 
					g.*,
					i.title_lv as title
				FROM galerija g
				inner join items i ON i.id = g.parent 
				WHERE g.parent = ' . ($row->id) . $priv . ' 
				ORDER BY g.seq, g.id';
		$result = mysql_query($sql) or die(mysql_error());

		if($allow)
			$delete = '<div onClick=rmImage(this) class="delete" style="display: none; z-order: 999;"><img src="images/delete_big.gif" border="0"></div>';

		while($row = mysql_fetch_object($result)) {

		$out .= '<div class="imageSet" id="'.$row->id.'" style="position: relative;">
					<input type="hidden" name="image['.$row->id.']" value="'.$row->image.'">
					<a href="'.$row->image.'"  class="bilde lightbox" rel="lightbox" title="'.htmlspecialchars($row->title).' &#187; ' . htmlspecialchars($row->image) . '" style="background: url(\'gimage.php?img='.$row->image.'&w=170\') no-repeat center center;">&nbsp;</a>
			'.$delete.' 
				</div>';

		}


		return $out;
	}
	
	
	
	
	
	function update() {
		
		$this->updateGallery();
	}
	
	
	

	
	function updateGallery() {

		$image = (Array)$_POST['image'];
		$parent = $this->ref->id;
		
		$i = (count($image) > 0) ? ' AND id NOT IN (' . implode(',', array_keys($image)) . ')' : '';

		$sql = 'DELETE FROM galerija WHERE parent = ' . (int)$parent . $i;
		mysql_query($sql) or die(mysql_error());


		if(mysql_affected_rows() > 0)
			$this->gc();
		

		// secД«ba

		$seq = 0;

		foreach($image as $id => $img) {

			$sql = 'UPDATE galerija SET seq = '.(int)$seq.' WHERE parent = ' . (int)$parent . ' AND id = ' . (int)$id;
			mysql_query($sql) or die(mysql_error());			

			$seq++;
		}	

	}




	function gc() {

		$images = Array();

		$sql = 'SELECT * FROM galerija WHERE parent = ' . (int)$this->id ;
		$result = mysql_query($sql) or die(mysql_error());

		while($row = mysql_fetch_object($result)) {

			$images[] = $row->image;
		}



		foreach (new DirectoryIterator('userfiles/images/galerija/' . $this->id) as $fileInfo) {
		    
			if($fileInfo->isDot() || $fileInfo->isDir() ) continue;
		    
			if(!in_array($fileInfo->getPathname(), $images)) {
			
				echo $fileInfo->getPathname() . "<br>\n";
				unlink($fileInfo->getPathname());
			}

	
		}

		// clear cache

		deltree('userfiles/images/galerija/' . $this->id . '/.cache');

	}
	
	
	
}




function deltree($dir)
{
	if(is_dir($dir))
	{
            $dir = (substr($dir, -1) != "/")? $dir."/":$dir;
            $openDir = opendir($dir);
            while($file = readdir($openDir))
            {
                if(!in_array($file, array(".", "..")))
                {
                    if(!is_dir($dir.$file))
                        @unlink($dir.$file);
                    else
                        deltree($dir.$file);
                }
            }
            closedir($openDir);
            @rmdir($dir);
        }
}




?>