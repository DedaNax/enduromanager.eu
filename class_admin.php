<?php


require_once "class_main.php";



class admin extends main
{


	var $isAdmin = true;
	var $maxDepth = 5;

	var $objects = Array();
	
	var $plugins = Array();
	

	public function __construct( $table = "items")
	{
		$this->table = $table;

			$link = mysql_connect(DB_HOST, DB_USER, DB_PASS);		
		if (!$link) {
			die("Nevaru pievienties serverim : " . mysql_error());
		}

		$db_selected = mysql_select_db(DB_NAME, $link);
		if(!$db_selected) {
			die("Nevaru atrast datubaazi <b>" . $this->db . "</b> : " . mysql_error());
		}

		$sql = "CREATE TABLE IF NOT EXISTS $table (
			`id` int(10) unsigned NOT NULL auto_increment,
			`objType` int(10) unsigned default NULL,
			`parent` int(10) unsigned default NULL,
			`title` varchar(255) character set utf8 default NULL,
			`short` text character set utf8,
			`texis` text character set utf8,
			`seq` int(10) unsigned NOT NULL default '0',
			`datums` date default NULL,
			`laiks` time default NULL,
			PRIMARY KEY  (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

		$result = mysql_query($sql) or die(mysql_error());

		// ja tabulas tiešām nebija, tad liekam arī 1 ierakstu
		$result = mysql_query("INSERT INTO $table SET id=1, objType=1, parent=0, title='About'");

		
		$result = mysql_query("SET NAMES UTF8");
		
		
		// plugins
		
		$this->plugins[] = new Galerija($this);
		$this->plugins[] = new Kalendars($this);
		//$this->plugins[] = new Map($this);

	}


	
	
	
	
	
	public function setID($id) {
		
		$this->id = $id;
		
		$sql = "SELECT objType, parent, title_$this->lang as title, texis_$this->lang as texis FROM " . $this->table . " WHERE id = '" . $id . "'";
		$result = mysql_query($sql) or $this->debug($sql, mysql_error());

		if($row = mysql_fetch_object($result))
		{

			$this->objType  = $row->objType;
			$this->title 	= isset($row->title) ? $row->title : "";
			$this->parent	= $row->parent;
			$this->depthID	= count($this->findRelatives($this->id));
			$this->root		= $this->findRoot($id);

		} else {

			//$this->setID($this->useAsDefault);

			$this->objType  = 0;
			$this->parent	= 0;
			$this->root 	= 0;		
		}		
		
	}
	
	
	
	




	function adminSideCategories($side)
	{
		
		global $bb3auth;

		$root = $this->findRoot($this->id);
		$root = 0;
		
		$data = $this->getSideCategories();

		if($this->objType != 0) {
			$select = $this->findParent($this->id);
		} else {
			$select = ($this->id) ? $this->id : 0; 
		}

		// Kategoriju koks

		$out = UL::recursive($root, $data, $select)->toString();


		
		// acl
		
		$root = $this->findRoot($this->id);
		
		if( !$bb3auth->check('u_raksti_full|u_raksti_edit') && 
			!($bb3auth->check('u_galerija_full') && $root == 7 ) ) {
			
			return $out;	
		}

		

		// insert | delete

		$out .= "\n\n<form name='frm' method='post' action='admin.php?id=$this->id'>";

		$out .= "<input type='hidden' name='admin'>";

		$out .= "<div id='menu_control' style='width:100%;text-align: center;border-top: 0px dotted black;padding-top:3px;'>";
		
		if($this->depthID < $this->maxDepth)
		{

			$out .= "<img id='insImg' src='".BASE_URL."images/insert.gif' title='Insert new' style='border: 1px solid white; cursor: pointer;'
						onClick='showInsert(".$this->id.")'>";

		} else {

			$out .= "<img id='insImg' src='".BASE_URL."images/insert.gif' style='border: 1px solid white;'
						onClick=''>";
		}



		$out .= "<img id='remImg' src='".BASE_URL."images/delete.gif' title='Delete' style='border: 1px solid white; cursor: pointer;'
					onClick='remove(\"" . $this->id . "\", \"" . htmlspecialchars($this->title) . "\")'>&nbsp;";

		$out .= "<img id='edImg' src='".BASE_URL."images/edit.jpg' title='Edit' style='border: 1px solid white; cursor: pointer;'
					onClick='edit(" . $this->id . ")'>";		
		
		$out .= "</div>";

		$out .= "<div id='insert' style='width:100%; text-align:center; display: none;'>
					<input type='text' name='item' style='width:98%;font-family:tahoma ;font-size:11px;	border:1px solid gray;'>";
																		
		$out .= "	<input type='radio' name='objType' id='obj0' value='0' checked>
						<label for='obj0'>Folder</label>";
						
		$out .= "	<input type='radio' name='objType' id='obj1' value='1'>
						<label for='obj1'>Post</label><br>";
						
						
		
		// plugins
		
		foreach($this->plugins as $plugin) {
				
			$out .= $plugin->objType();
		}	
		
		
		
		$out .= "<br>";
		
		$out .= 	"<input type='button' value='Add' id='links' style='' onClick='insert(\"$this->id\");'>
					<input type='button' value='Cancel' id='links' style='' onClick='showInsert(\"$this->id\");'>
				</div>
				 </div>";
		$out .= "</form>";


		return $out;
	}












	public function adminTopCategories($top)
	{
		$top = " <span id='0' style='margin-right: 10px;'><a href='admin.php'><img src='".BASE_URL."images/home.gif' border='0' title='Sākums' valign='absmiddle'></a> </span> " . $top;
		return $top;
	}









	public function adminBody()
	{

		global $bb3auth;

		// if(strlen(parent::showBody()) > 0) { $body = parent::showBody(); } else { $body = "&nbsp;"; }

		$sql = "SELECT
					id, objType, parent, images,
					short_$this->lang as short,
					title_$this->lang as title,
					texis_$this->lang as texis
				FROM " . $this->table . " WHERE id = '$this->id'";
		$result = mysql_query($sql) or $this->debug($sql, mysql_error());

		
		$out .= $this->showLocator();
				
			
		if($row = mysql_fetch_object($result))
		{

			
			$inner = ($row->texis) ? $row->texis : "&nbsp;";			
			
			foreach($this->plugins as $plugin) {
				
				$ret = $plugin->adminBody($row, $inner);
				
				if($ret) {
					return $inner;
				}
			}				

			
			// acl
		
			$root = $this->findRoot($this->id);
			
			if( $bb3auth->check('u_raksti_full|u_raksti_edit') || 
				($bb3auth->check('u_galerija_full') && $root == 7 ) ) {
				
				$edit = "onDblClick=\"JavaScript:edit('$this->id');\"";
			}
			
			
			$out .= "<div class='inner' $edit style='width:100%; border-top: 1px dotted gray; border-bottom: 1px dotted gray;'>";
			$out .= $inner;
			$out .= "</div>";


			
			
			
			$out .= "<hr>\n";
			
			
			// plugins
			
			foreach($this->plugins as $plugin) {
					
				$out .= $plugin->docs($row);
			}

		
			if(!isset($_GET['sitemap']))
				$out .= $this->showDocs($this->id);	
							
		}
				

				

		return $out;
	}







	function showDocs($parent) 
	{
		
		
		$this->objects[1] = "tree-doc.gif";
		
		
		foreach($this->getDocs($parent) as $key => $data)
		{
			
			if($data["objType"] == 1) {
				
				$li .= "<li id='$key'>";
				$li .= $this->docs($data);
				$li .= "</li>\n";
				
			}

		}	
		
		if($li) {
			$out .= "<ul class='docsList'>\n";
			$out .= $li;
			$out .= "</ul>\n";
		}

		return $out;
	}




	
	
	
	function docs(&$data) {
		
		$out = "<div><img src='images/" . $this->objects[$data["objType"]] . "' align='absmiddle'><b><a href='admin.php?id=".$data['id']."' class='links'>". $data['title']."</a></b></div>";
		$out .= "<div style='margin-bottom: 5px;'>[".$data["datums"]."]</div>";
		$out .= "<div>".$data["short"]."</div>";
		
		return $out;
	}
	






	function admin($admin)
	{

		$id = $this->id;
		
		switch ($admin)
		{

			case "edit":
				echo $this->doEdit();
				exit;
				break;


			case "insert":

				$bb3auth = new BB3Auth();
				
				if(!$bb3auth->check('u_raksti_full') && !($this->root == 6 && $bb3auth->check('u_galerija_full'))) {
					
					$msg = "Nav tiesību :(";
					
				} else {
						
					$id = $this->doInsert();
				}
				break;


			case "remove":
				
				$bb3auth = new BB3Auth();
				
				if(!$bb3auth->check('u_raksti_full')) {
					
					$msg = "Nav tiesību :(";
					
				} else {
									
					$id = $this->findParent($this->id);
					
					if( $this->doRemove() == 0 ) {
						$id = $this->id;
						$msg = "Object has child objects..!";						
					}
					
				}
				
				break;

			case "newOrder":
				$this->newOrder();
				exit;
				break;
		}



		if($admin != "") {
			echo "<script language=\"JavaScript\">";
			echo ($msg) ? "alert(\"$msg\");\n" : "";
			echo "window.location.href = '?id=$id';";
			echo "</script>";
		}

		
	}







	function newOrder()
	{
		
		$items = $_GET['items'];

		$data = explode(",", $items);

		$sql = "SELECT * FROM $this->table WHERE id IN ($items)";
		$result = mysql_query($sql) or die(mysql_error());


		while($row = mysql_fetch_object($result))
		{
			$seq = (int)(array_search($row->id, $data) * 10);
			mysql_query("UPDATE $this->table SET seq = $seq WHERE id = $row->id");

		}

	}











	protected function doInsert()
	{

		$objType	= $_POST['objType'];
		$str		= $_POST['item'];

		if($this->objType != 0 && $this->objType != 1)
		{
			$parent = $this->findParent($this->id);

		} else {

			$parent = (int)$this->id;

		}

		// arī doc var būt apakš doc.

		// $parent = $this->id;
		
		$sql = "INSERT INTO $this->table 
				SET objType='$objType', parent='$parent', title_$this->lang=\"" . mysql_real_escape_string($str)."\", datums=now()";
		$result = mysql_query($sql) or die(mysql_error());

		
		return $parent;
	}



	

	protected function doRemove()
	{

		$sql = "DELETE FROM $this->table WHERE id = $this->id AND (select * from (select count(*) from $this->table where parent = $this->id) as p) = 0";
		$result = mysql_query($sql) or die(mysql_error().$sql);

		return mysql_affected_rows();

	}



	protected function findChildrenTree($id)
	{

		$data = array();

		foreach($this->findChildrens($id) as $key => $value)
		{
			$data[$key] = 0;
			$data += $this->findChildrenTree($key);
		}

		return $data;
	}






	protected function doEdit()
	{

		if(count($_POST) > 1)
		{

			$images = mysql_real_escape_string(stripslashes( implode(";", (Array)$_POST['images'])) );
			$links	= mysql_real_escape_string( $_POST['links'] );
			$parent = $_POST["parent"];
			$datums = $_POST["datums"];

			
			$items[] = isset($_POST["active"]) ? 'active = 1' : 'active = 0';
			$items[] = isset($_POST["priv"]) ? 'priv = 1' : 'priv = 0';
			$items[] = isset($_POST["bold"]) ? 'bold = 1' : 'bold = 0';
			
			$langs = Array('lv', 'ru', 'en', 'de', 'es');
			
			foreach($langs as $lang) {
				
				$items[] = 'title_' . $lang . ' = "' . mysql_real_escape_string(stripslashes($_POST['title_' . $lang])) . '"';
				$items[] = 'short_' . $lang . ' = "' . mysql_real_escape_string(stripslashes($_POST['short_' . $lang])) . '"';
				$items[] = 'texis_' . $lang . ' = "' . mysql_real_escape_string(stripslashes($_POST['texis_' . $lang])) . '"';
			}
			

			$sql = "UPDATE ".$this->table." SET 
						parent	='$parent',
						images	='".$images."',
						links	='".$links."',
						datums	='".$datums."',
						" . implode(', ', $items) . "
					WHERE id='".$this->id."'";
						
			$result = mysql_query($sql) or die(mysql_error() . '<pre>' . $sql);

			
			foreach($this->plugins as $plugin) {
				$plugin->update($_POST);
			}			
			

			
			echo "<script language=\"JavaScript\">";
			echo "window.opener.location.href = '?id=$this->id';";
			echo "window.close();";
			echo "</script>";

		} else {


			include_once 'fckeditor/fckeditor.php' ;
			require_once 'ckfinder/ckfinder.php' ;


			$out .= "<html><head>";
			$out .= "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">";
			$out .= "<script type=\"text/javascript\" src=\"js/jquery-1.3.2.js\"></script>";
			$out .= "<script type=\"text/javascript\" src=\"js/plugins/preload/jquery.preload-min.js\"></script>";
			$out .= "<script type=\"text/javascript\" src=\"js/ui/ui.core.js\"></script>";
			$out .= "<script type=\"text/javascript\" src=\"js/ui/ui.sortable.js\"></script>";
			$out .= "<script type=\"text/javascript\" src=\"js/ui/ui.tabs.js\"></script>";
			$out .= "<script type=\"text/javascript\" src=\"js/ui/ui.datepicker.js\"></script>";
		
			$out .= "<script type=\"text/javascript\" src=\"js/jquery.qtip-1.0.0-rc3.min.js\"></script>";
					

			$out .= "<link type=\"text/css\" rel=\"stylesheet\" href=\"css/custom-theme/jquery-ui-1.7.2.custom.css\" >";
			
			$out .= "<script type=\"text/javascript\" src=\"js/swfupload.js\"></script>";
			$out .= "<script type=\"text/javascript\" src=\"js/swfupload.queue.js\"></script>";
			$out .= "<script type=\"text/javascript\" src=\"js/fileprogress.js\"></script>";
			$out .= "<script type=\"text/javascript\" src=\"js/handlers.js\"></script>";

			$out .= "<script type=\"text/javascript\" src=\"js/ajax.js\"></script>";
			
			$out .= "<link rel=\"stylesheet\" href=\"css/galerija.css\" type=\"text/css\">";

			
			$out .= "<style>
						
				body, table {
					font-family: tahoma;
					font-size: 11px;
					margin: 0;
				}
			
				#links
				{
					text-decoration: none;
					font-family: verdana;
					font-size: 10px;
				}

				.ui-tabs-panel {
					padding: 10px 0 0 0 !important;
				}
				
				</style>";

			$out .= js();
			
			$out .= "</head>";
			
			$out .= "<body id='$this->id'>";
			$out .= "<form method='POST' action='?admin=edit&id=".$this->id."'>";
			$out .= "<input type='hidden' name='id' value='$this->id'>";
			
			$out .= $this->templateArticle();

			$out .= "</form>";
			$out .= "</body>";
			$out .=  "</html>";
		}
		return $out;
	}


	
	
	
	
	function templateArticle() {

		
		$sql = "SELECT 
					*			
				FROM $this->table WHERE id = '$this->id'";
		$result = mysql_query($sql) or die(mysql_error().$sql);
		
		if(!$row = mysql_fetch_object($result)) {
			die("Ierakts [$this->id] nav atrasts..". $sql);
		}
		
		$active = ($row->active == 1) ? "checked" : "";
		$priv 	= ($row->priv == 1) ? "checked" : "";			
		$bold 	= ($row->bold == 1) ? "checked" : "";
		$datums = ($row->datums == "0000-00-00") ? date("Y-m-d") : $row->datums;
		
		
		$out = '<div id="container-1" style="position: relative; height: 620px;;">

			<input type="hidden" name="parent" id="parent" value="'.$row->parent.'">
			
            <ul>
            	<!--li><img src="images/sitemap.gif" border="0" align="absmiddle" title="Change location" onClick="changeParent(0, "parent");"></li-->
                <li><a href="#fragment-1"><span>LV</span></a></li>
                <li><a href="#fragment-2"><span>RU</span></a></li>
                <li><a href="#fragment-3"><span>EN</span></a></li>
                <li><a href="#fragment-4"><span>ES</span></a></li>
                <li><a href="#fragment-5"><span>DE</span></a></li>
            </ul>
            
            <div id="fragment-1">'.$this->edit($row, 'lv').'</div>
            <div id="fragment-2">'.$this->edit($row, 'ru').'</div>
            <div id="fragment-3">'.$this->edit($row, 'en').'</div>
            <div id="fragment-4">'.$this->edit($row, 'es').'</div>
            <div id="fragment-5">'.$this->edit($row, 'de').'</div>

            
            <div style="position: absolute; right: 15px; top: 8px;">
	            <table>
	            <tr>
	            	 <td width="130" align="center">
					   	<b>Date:</b> <input type="text" name="datums" class="date" value="'.$row->datums.'" '.$priv.' style="width: 90px;" readonly="readonly">
					</td>	
	            	<td width="70" align="center">
					   	<b>Priv:</b> <input type="checkbox" name="priv" value="1" '.$priv.'>
					</td>';				

		if($this->objType == 0) {

			$out .= '<td width="70" align=\"center\">
					   	<b>Izcelt:</b> <input type="checkbox" name="bold" value="1" '.$bold.'>
					</td>';

		}

		$out .= '	<td width="70" align=\"center\">
					   	<b>Rādīt:</b> <input type="checkbox" name="active" value="1" '.$active.'>
					</td>
					<td width="50">
						<input type="submit" value="Save">
					</td>
				</tr>
	            </table>
            </div>
            
        </div>';

		return $out;
	}
	
	
	
	
	



	protected function edit($row, $lang = 'lv')
	{
		

		$frame .= "<table border='0' width='100%' height='100%' style='font-size: 12px; font-family: Tahoma; border-collapse: collapse;'>";
		$frame .= "<tr>"; 
		$frame .= "<td width=\"10%\" height=\"15\" align=\"right\">
						<b>Title ($lang):</b>
					</td>
					<td width=\"90%\">
						<input type='text' name='title_$lang' style='width: 100%;' value=\"" . htmlspecialchars($row->{'title_' . $lang}) . "\">
					</td>";
		$frame .= "</tr>";

		
		if($lang == 'lv' && $row->id == 6) {
			
			$frame .= "<tr>
						<td height=\"15\" align=\"right\">Bilde:</td>
						<td><input type='text' id='files' name='images' value='$row->images' readonly='readonly' style='width: 300px;'><input type='button' value='Browse' onClick=\"BrowseServer();\">
						&nbsp;Links:<input type='text' name='links' value=\"" . htmlspecialchars($row->links) . "\" style='width: 200px;'></td>
					   </tr>";
			
		}
		
	
			
		$frame .= "<tr><td valign='top' colspan='2'>";
		
		// default - editors
		
		$out = "<table border='0' width='100%' style='height: 92%'>";			
		$out .= "<tr>
					<td height='70'>
						<textarea name='short_$lang' style='width:100%;height:100%;'>" . htmlspecialchars($row->{'short_' . $lang}) . "</textarea>
					</td>
				</tr>";
		$out .= "<tr>
					<td valign='top'>
						<div style='width:100%;height:100%;'>
						" . $this->editor($row->{'texis_' . $lang}, 'texis_' . $lang) . "
						</div>
					</td>
				</tr>";
		
		$out .= "</table>";

		
		// plugins
		
		
		foreach($this->plugins as $plugin) {
			
			if($this->objType == $plugin->objType) {
				$plugin->editor($row, $out, $lang);		// out ir callBack!
			}
		}
		
		
		$frame .= $out;
		
		
		$frame .= "</td></tr></table>";			
			
		return $frame;
	}




	




	function editor($texis, $name = 'texis')
	{

		$fckeditor = new FCKeditor( $name ) ;
		$fckeditor->BasePath	= 'fckeditor/' ;
		$fckeditor->ToolbarSet	= "Eriks";
		$fckeditor->Height		= "100%";
		$fckeditor->Value		= $texis ;

		
		CKFinder::SetupFCKeditor( $fckeditor, 'ckfinder/' ) ;
		
		$out = $fckeditor->CreateHtml() ;

		return $out;
	}




	
}	// eof class















/**
	
	Klase, kas uztaisa no masīva koku ar UL/LI

	$item[1] = Array("parent" => 0);
		$item[2] = Array("parent" => 1);
		$item[3] = Array("parent" => 1);
	$item[4] = Array("parent" => 0);

*/


class UL
{

	var $items;
	var $depth = 0;
	var $select;

	function recursive($parent = 0, &$items, $select)
	{
		$o = new UL;

		foreach((Array)$items as $key => $data)
		{
			if($data["parent"] == $parent)
				$o->add($key, $data, UL::recursive($key, $items, $select), $select);
		}

		return $o;
	}




	function add($key, $item, $obj, $select = 0)
	{
		$this->items[$key] = Array($item, $obj);
		$this->depth = $item["depth"];
		$this->select = $select;
	}



	function toString()
	{

		if(count($this->items) == 0)
			return;
		

		
		$out = "<ul class='catList' style='margin-left: " . $this->depth . "em;'>";

		foreach($this->items as $key => $item)
		{
			
			if($key == $this->select || $item[0]["bold"] == 1) {
				$style = " style='font-weight: bold;' ";
			} else {
				$style = "";
			}



			$out .= "<li id='$key'>";
			$out .= "<a href=\"admin.php?id=$key\" $style><img src=\"images/tree-folder.gif\" border=\"0\" align=\"absmiddle\" />" . $item[0]["title"] ."</a>" . $item[1]->toString() . "\n";
			$out .= "</li>";
		}

		$out .= "</ul>";


		return $out;
	}
}


?>