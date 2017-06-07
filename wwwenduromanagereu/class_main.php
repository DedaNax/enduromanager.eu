<?php
session_start();

/*
function __autoload($class_name) {
    require_once "plugins/" . $class_name . '.php';
}
*/

//require_once("plugins/SEO.php");
//require_once("plugins/Plugin.php");
//require_once("plugins/Galerija.php");
//require_once("plugins/Kalendars.php");


/*
 *	Revision v2.0
 */



require_once("_config.php");
require_once("BB3Auth.php");



class main {


/******************************************************************************/


	public $lang = "lv";
	public $id = 0;
	public $firstChild = false;
	public $depthID = 0;
	public $objType;
	
	protected $tree = array();
	protected $treeX = array();
	protected $depth;
	
	public $table;
	var $title = "";

	public $qDebug = true;
	public $useTopCategories = false;
	public $useOnlyCategories = true;
	public $useAsDefault = 1;

	var $isAdmin = false;

	var $plugins = Array();



	public function __construct( $table = "items")
	{
	/*
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


		
		if(mysql_affected_rows() > 0)
		{
			$result = mysql_query("INSERT INTO $table SET id=1, objType=1, title='About'") or die(mysql_error());
		}
			
		$result = mysql_query("SET NAMES UTF8");
		

		// set plugins
		
		//$this->plugins[] = new Galerija($this);
		//$this->plugins[] = new Kalendars($this);
		//$this->plugins[] = new Map($this);
*/
		
	}






	public function setID($id)
	{

		$sql = "SELECT id FROM " . $this->table . " WHERE objType = 0 ORDER BY seq, id LIMIT 1";
		$result = mysql_query($sql) or $this->debug($sql, mysql_error());

		if($row = mysql_fetch_object($result)) {		
			$useNext = $row->id;
		} 
		
		$this->id = ($id > 0) ? $id : $useNext;


		$sql = "SELECT objType, parent, texis_$this->lang as texis FROM " . $this->table . " WHERE id = '" . $id . "'";
		$result = mysql_query($sql) or $this->debug($sql, mysql_error());

		if($row = mysql_fetch_object($result))
		{

			//echo $this->isAdmin;

			if(!$this->isAdmin && preg_match("/^(\<p\>){0,1}([0-9]){1,}(\<\/p\>){0,1}$/", $row->texis, $result))
			{
				return $this->setID(strip_tags($result[0]));
			}


			$this->objType  = $row->objType;
			$this->parent	= $row->parent;
			$this->depthID	= count($this->findRelatives($this->id));
			$this->root		= $this->findRoot($id);

		} else {

			$this->setID($this->useAsDefault);

			$this->objType  = false;
			$this->parent	= false;
			$this->root 	= 0;
					
		}
			
	}


	
	
	
	
	




	public function setLanguage($lang = "lv")
	{
		$this->lang = $lang;
		//$this->table = $this->lang . "_" . $this->table;
	}







	public function getTopCategories()
	{

		$out = array();

		$sql = "SELECT 
					id, 
					objType, 
					parent, 
					title_$this->lang as title,
					short_$this->lang as short,
					seq 
				FROM " . $this->table . " 
				WHERE objType = 0 AND parent = 0 ORDER BY seq";

		$result = mysql_query($sql) or $this->debug($sql, mysql_error());

		while($row = mysql_fetch_object($result))
		{
			$out[$row->id] = array(	'title'		=> $row->title, 
									'objType'	=> $row->objType,
									'short'		=> $row->short
									);
		}
	
		return $out;
	}







	public function showTopCategories()
	{
		$data = $this->getTopCategories();
		$parent = $this->findParentForSide();


		foreach($data as $key => $value)
		{
			if($this->findRoot($this->id) == $key || $parent == $key) { $style = "style='font-weight: bold;'"; } else { $style = "";}

			$out .= "<span id='$key' class='links'><a class='links' $style href='admin.php?id=".$key."'>".$value['title']."</a> : </span>";
		}

		//$out .= "<span id='links'>:</span>";

		return $out;
	}







	public function showTopCategoriesPublic()
	{
		$data = $this->getTopCategories();
		$root = $this->findRoot($this->id);
		
		$sql = "SELECT id, parent, objType, title_$this->lang as title FROM $this->table WHERE id IN (0,1,2,3,4,5,6)";
		$result = mysql_query($sql) or die(mysql_error());
		
		while($row = mysql_fetch_object($result)) {
			
			if($row->id == $root) {
				
				$top[] = "<a class=\"active\" href=\"" . SEO::encode($row->id, $row->title) . "\"> $row->title </a>";

			} else {

				$top[] = "<a href=\"" . SEO::encode($row->id, $row->title) . "\"> $row->title </a>";				
				
			}
			
		}


		return implode(" | ", $top);
	}




	


	public function getSideCategories($parent = 0, $depth = 0)
	{
	
		if($depth > 2)
			return;

		$id = $this->id;
		
		if($parent == -1) { $parent = $this->findParentForSide(); }

		$relatives = $this->findRelatives($id);
		
		$sql = "SELECT 
					id, 
					parent,
					objType, 
					title_$this->lang as title,
					bold
				FROM $this->table 
				WHERE parent = '$parent' 
				ORDER BY objType, seq";
		$result = mysql_query($sql);

		
		$this->firstChild = false;

		while($row = mysql_fetch_object($result)) {

			if($row->parent != 0 && !$this->useTopCategories) { $offset = 1; }

			if($row->objType == 0 || (!$this->useOnlyCategories && $row->objType !=0)) {

				// get First Child
				//if($row->parent == $this->id && !$this->firstChild && $row->objType != 0) { $this->firstChild = $row->id; }


				$this->tree[$row->id] = array(	'parent'	=> $row->parent, 
												'objType'	=> $row->objType, 
												'title'		=> $row->title, 
												'bold'		=> $row->bold,	
												'depth'		=> $relatives[$parent] + $offset);
			}

			if(array_key_exists($row->id, $relatives))
			{			
				$this->getSideCategories($row->id, $depth + 1);
			}

		}


	return $this->tree;
	}






	// izmantojas arÄ« admin

	public function showSideCategories()
	{	
		
		$data = $this->getSideCategories();

		foreach($data as $id => $item)
		{

			if($this->id == $id) { $style = "font-weight: bold;"; } else { $style = ""; }
			if(!$data[$this->id] && $this->useOnlyCategories && $id == $this->findParent($this->id)) { $style = "font-weight: bold;"; } 
			

			switch($item['objType'])
			{
				case 0:
					$img = "<img src='images/tree-folder.gif' align='absmiddle'>";
					break;

				case 1:
					$img = "<img src='images/tree-doc.gif' align='absmiddle'>";
					break;
				
				case 2:
					$img = "<img src='images/tree-img.gif' align='absmiddle'>";
					break;
			}
			
			// only categories
			if($item[$id]['objType'] == 0)
			{
				$out .= $this->spaces($item['depth'])."$img <a id='links' style='$style' href='?id=".$id."'>".$item['title']."</a><br>";
			}

			// other objects
			if($this->useOnlyCategories == false && $item[$id]['objType'] != 0)
			{
				$out .= $this->spaces($item['depth'])."$img <a id='links' style='$style' href='?id=".$id."'>".$item['title']."</a><br>";
			}
		}
		unset($this->tree);
		return $out;
	}






	function showSideCategoriesPublic2($ext = false) {

		
		return $this->showSideCategoriesPublic(false, 0, $ext);
	}







	function showSideCategoriesPublic($parent = false, $level = 0, $ext = false) {

		/*
		if($level > 2)
			return;
		

		$overwrite = Array(8 => 'phpBB3/', 166 => 'rm/');

		$root = $this->findRoot($this->id);
		
		if(!is_numeric($parent))
			$parent = 0;


		$relatives = $this->findRelatives($this->id);			
	
		
		if(!$this->isAdmin) {
			
			$bb3auth = new BB3Auth();
			$priv = $bb3auth->check('u_raksti_priv') ? 'AND active = 1' : ' AND active = 1 AND priv < 1';
			
		}
		
		
		$sql = "SELECT 
					id, 
					parent,
					title_$this->lang as title,
					bold
				FROM $this->table
				WHERE title_$this->lang <> '' AND objType = 0 AND parent = '$parent' $priv
				ORDER BY seq, id";

		$result = mysql_query($sql) or die(mysql_error());


		$out = "\n<ul class=\"side level$level\">\n";

		while($row = mysql_fetch_object($result))
		{
			
			//$row->title = ($level == 0) ? mb_strtolower($row->title, "utf-8") : $row->title;
			$row->title = ($level == 0) ? strtolower($row->title) : $row->title;
			$bold		= ($row->bold == 1) ? 'bold' : '';

			if(isset($overwrite[$row->id])) {
				$link = BASE_URL . $overwrite[$row->id];	
			} else {
			//	$link = SEO::encode($row->id, $this->title);
			}
			
			if(array_key_exists($row->id, $relatives)) {

				$out .= "<li class=\"active $bold\"><a class=\"active $bold\" href=\"" . $link . "\"> $row->title </a> \n";

				$o = $this->showSideCategoriesPublic($row->id, ($level + 1), $ext);


				if(preg_match("/<li/", $o)) {
					$out .= $o;
				}

				
				if($this->id == $row->id && $this->id = 166) {
					// $out .= '<ul class="side level2"><li><a href="">tests</a></li></ul>';
				}


				// ext hook
*/
				$i=0;
				foreach((Array)$ext as $id => $items) {

					if($row->id == $id) {
											
						$out .= '<ul >';
						
						foreach($items as $item) {		
							if (isset($item['href'])){
								$out .= '<li class="side level'.$item['level'].(($i==0 && $item['level']==0)?'first':'').($item['sel']?'sel':'').'"><a href="' . $item['href'] . '"  '.(isset($item['target'])? 'target="'.$item['target'].'"':'').'>' . $item['title'] . '</a></li>';
							} else {
								$out .= '<li class="side level'.$item['level'].(($i==0 && $item['level']==0)?'first':'').($item['sel']?'sel':'').'"><hr></li>';
							}
							if($item['level']==0){$i++;}
						}

						$out .= '</ul>';
					}
				}	

							
				$out .= "</li>"; 
				$out .= '<p><img src="./enduro_logo.jpg" class="logo"></p>';
				$out .= '<p><img src="./enduro_logo90.jpg" class="logo90"></p>';
				/*	
				/*	
				
			} else {
				
				$out .= "<li><a class=\"$bold\" href=\"" . $link . "\"> $row->title </a></li>\n";
			}
			
		}
		*/
		$out .= "</ul>\n";
		
		

		return $out;
	}



	





	
	
	

	
	
	
	protected function getDocs($parent)
	{

		
		if(!$this->isAdmin) {
			
			$bb3auth = new BB3Auth();
			$priv = $bb3auth->check('u_raksti_priv') ? 'AND active = 1' : ' AND active = 1 AND priv < 1';
		}
		

		$sql = "SELECT 
					id, 
					parent, 
					objType, 
					title_$this->lang as title,
					short_$this->lang as short,
					datums
				FROM $this->table 
				WHERE objType = 1 AND parent = '$parent' $priv
				HAVING title <> ''
				ORDER BY seq, id DESC";
		$result = mysql_query($sql) or die(mysql_error());
		
		$out = array();

		while($row = mysql_fetch_object($result))
		{
			
			foreach($row as $key => $value) {
				
				$out[$row->id][$key] = $value;
			}
		}

		return $out;
	}







	public function showDocs($parent)
	{
		
		$out = "";

		foreach($this->getDocs($parent) as $key => $data)
		{
			
			$out .= '<div class="doc">';
			$out .= '<div class="title"><a href="'. SEO::encode($key, $data['title']).'">' . $data['title'] . '</a></div>';
			$out .= '<div class="datums">[' . $data["datums"] . ']</div>';
			$out .= '<div class="short">' . $data["short"] . '</div>';
			$out .= '</div>';
		}

		return '<div class="docs">' . $out . '</div>';
	}
	
	
	
	



	public function spaces($nr)
	{
		for($k=0; $k<$nr; $k++)
		{
			$out .= "&nbsp;&nbsp;&nbsp;&nbsp;";
		}
		return $out;
	}







	public function showBody($id = 0)
	{


		if(isset($_GET['sitemap']))
		{
			return $this->showTree(0);
		}




		//$out .= $this->showLocator();
		//$out .= "<br>";

		if($id == 0) { $id = $this->id; }

		$sql = "SELECT id, title, texis FROM " . $this->table . " WHERE id = '$id'";
		$result = mysql_query($sql) or $this->debug($sql, mysql_error());

		if($row = mysql_fetch_object($result))
		{
			$out = $row->texis;
		}

		

		return $out;
	}



	
	


	function showBodyPublic($id = 0)
	{

		// default
		
		if($id == 0) { $id = $this->id; }			
		
		
		
		if(isset($_POST["search"]) && !empty($_POST["search"])) {
			
			return $this->search();
		}
		
		
		
		
		$sql = "SELECT
					id, parent, objType, images,
					title_$this->lang as title,
					texis_$this->lang as texis,
					datums
				FROM " . $this->table . " WHERE id = '$id'";
		$result = mysql_query($sql) or $this->debug($sql, mysql_error());

		
		if($row = mysql_fetch_object($result))
		{

			// sākumā rādām kas ir appasaule
			
			if($row->id == 1)
				$out = $this->kasir();
			
			$out .= '<div class="locator"><h1>' . $this->showLocatorPublic() . '</h1></div>';
			
			$out .= $row->texis;
			$out .= $this->showDocs($row->id);
			
			foreach($this->plugins as $plugin) {
				
				if($plugin->body($row, $out))
					return $out;
			}
			
			
		}
			
		return $out;
	}



	
	
	
	
	
	
	function kasir() {

		$sql = "SELECT
					id, parent, objType, images,
					title_$this->lang as title,
					texis_$this->lang as texis,
					datums
				FROM " . $this->table . " WHERE id = 23 HAVING title <> ''";
		$result = mysql_query($sql) or $this->debug($sql, mysql_error());

		
		if($row = mysql_fetch_object($result)) {
		
		$out = '<div style="position: relative; height: auto;">
						<div style="position: relative; left: 85px; width: 614px; height: 131px;">
							<img src="'.BASE_URL.'/images/kas_bg.png" border="0">
							<div style="position: absolute; right: 20px; top: 10px; height: 110px; width: 450px; overflow: hidden; ">
								<h3>'.$row->title.'</h3>
								'.$row->texis.'
							</div>
						</div>
						<img src="'.BASE_URL.'/images/logo_big.png" alt="" border="0" style="position: absolute; bottom: -14px; left: 15px;" />
					</div>';
		
		}
		
		return $out;
	}
	
	
	
	
	
	
	
	function getCalImg() {
		

		$sql = "SELECT
					id, parent, objType, images, links
				FROM " . $this->table . " WHERE id = 6";
		$result = mysql_query($sql) or $this->debug($sql, mysql_error());

		
		if($row = mysql_fetch_object($result)) {
			
			return Array($row->images, $row->links);
		}
		
	}
	
	
	
	
	
	
	
	
	
	function sponsors() {
		
			$sql = "SELECT
					id, parent, objType, images,
					title_$this->lang as title,
					texis_lv as texis,
					datums
				FROM " . $this->table . " WHERE id = 22
				HAVING title <> ''";
		$result = mysql_query($sql) or $this->debug($sql, mysql_error());

		
		if($row = mysql_fetch_object($result)) {
			
			$out = '<div style="margin-top: 20px;">
						<h3 style="color: #b3b3b3;" class="sponsors">'.$row->title.'</h3>
						'.$row->texis.'
					</div>';
			
			return $out;
		}		
		
	}
	
	
	
	

	
	


	function showLocator()
	{

		$relatives = $this->findRelatives($this->id);
		$item = $this->getItems($relatives);


		foreach($relatives as $id => $value)
		{
			//if($this->id == $id) { $style = "style='font-weight: bold;'"; }
			$out .= " <span id='links'>&#187</span> <a id='links' href='?id=$id'>".$item[$id]['title']."</a> ";
		}

		return $out;
	}







	function showLocatorPublic($id = 0)
	{

		if($id == 0)
			$id = $this->id;
		
		$relatives = $this->findRelatives($id);
		$item = $this->getItems($relatives);

		$rel = (int)count($relatives);
		
		$n = 1;
		
		foreach($relatives as $id => $value) {
			
			$last = ($rel == $n) ? 'class="last"' : ''; 
			//$arr[] = '<a '.$last.' href="' . SEO::encode($id) . '">' . mb_strtoupper($item[$id]['title'], "utf-8") . '</a>';
			$arr[] = '<a '.$last.' href="' . SEO::encode($id) . '">' . strtoupper($item[$id]['title']) . '</a>';
			
			$n++;
		}
		
		return implode(" &#187; ", $arr);
	}







	function getItems( $ids = array())
	{

		$out	= array();
		$str		= " id = 0";

		foreach ($ids  as $id => $valute)
		{
			$id = $id > 0 ? $id : 0;
			$str .= " OR id = $id";
		}

		$sql = "SELECT 
					id, 
					objType, 
					parent, 
					title_$this->lang as title, 
					texis_$this->lang as texis 
				FROM " . $this->table . " WHERE $str";
		$result = mysql_query($sql) or $this->debug($sql, mysql_error());

		while($row = mysql_fetch_object($result))
		{
			
			foreach($row as $key => $value) {
				
				$out[$row->id][$key] = $value;
				
			}
			
			
			//$out[$row->id] = array('objType' => $row->objType, 'parent' => $row->parent, 'title' => $row->title, "short" => $row->short, 'texis' => $row->texis);
		}	

	return $out;
	}







	function findParentForSide()
	{

		$data = array();
		

		if($this->useTopCategories)
		{
		
			if(isset($this->id) && $this->id != 0)
			{
			
				$data = $this->getTopCategories();
				$parent = isset($data[$this->findRoot($this->id)]) ? $this->findRoot($this->id) : array_shift(array_keys($data)) ;

			} else {
			
				// id nav noradits, (pirmaa vertiba | useAsDefault)
			
				if(isset($this->useAsDefault) && $this->useAsDefault > 0)
				{
					$parent = $this->useAsDefault;

				} else {

					$data = $this->getTopCategories();
					$parent = array_shift(array_keys($data));
					$this->setID($parent);
				}
			}

		} else {

			$parent = 0;
		}
		
		return $parent;
	}








	function findParent($id)
	{

		$sql = "SELECT parent FROM " . $this->table . " WHERE id = '" . (int)$id . "'";
		$result = mysql_query($sql) or $this->debug($sql, mysql_error());

		if($row = mysql_fetch_object($result))
		{
			$out = $row->parent;
		} else {
			$out = false;
		}

		return $out;
	}





	


	function findRoot($id)
	{

		$parent = $this->findParent($id);

		while($parent > 0)
		{
			$id = $parent;
			$parent = $this->findParent($parent);
		}

		return $id;
	}








	function findRelatives($id)
	{
		
		$parent = $this->findParent($id);
		$out = array();
		//$depth = count($this->findRelatives($this->id)) - 1;
		$depth = $this->depthID - 1;
		
		$out[$id] = $depth;

		while($parent > 0)
		{
			$depth--;
			$out[$parent] = $depth;
			
			$parent = $this->findParent($parent);
		}

		ksort($out);

		return $out;
	}









	function findChildrens($id)
	{

		$out = array();

		$sql = "SELECT id, objType, parent, title_$this->lang as title FROM " . $this->table . " WHERE parent = '" . $id . "' ORDER BY objType";
		$result = mysql_query($sql) or $this->debug($sql, mysql_error());

		while($row = mysql_fetch_object($result))
		{
			$out[$row->id] = array('objType' => $row->objType, 'parent' => $row->parent, 'title' => $row->title);
		}		

		return $out;
	}








	function getTree($parent = 0)
	{

		$this->dep = $dep;

		//if($parent == -1) { $parent = $this->findParentForSide(); }

		$sql = "select * from lv_items where parent = '$parent' ORDER BY objType, seq";
		$result = mysql_query($sql);
	
		while($row = mysql_fetch_object($result))
		{

			if($row->parent != 0 && !$this->useTopCategories) { $offset = 1; }
		
			$this->treeX[$row->id] = array(	'parent'	=> $row->parent, 
											'objType'	=> $row->objType, 
											'title'		=> $row->title, 
											'depth'		=> count($this->findRelatives($row->id)) - 1);
			
	
			$this->getTree($row->id);
			
		}


	return $this->treeX;
	}




	
	



	function showTree($parent = 0)
	{
		
		foreach($this->getTree($parent) as $id => $item)
		{

			if($item['objType'] == 0) { $style = "font-weight: bold;"; } else { $style = ""; }
				
			switch($item['objType'])
			{
				case 0:
					$img = "<img src='images/tree-folder.gif' align='absmiddle'>";
					break;

				case 1:
					$img = "<img src='images/tree-doc.gif' align='absmiddle'>";
					break;
				
				case 2:
					$img = "<img src='images/tree-img.gif' align='absmiddle'>";
					break;
			}
			
			// only categories
			if($item[$id]['objType'] == 0)
			{
				$out .= $this->spaces($item['depth'])."$img <a class='link' style='$style' href='?id=".$id."'>".$item['title']."</a><br>";
			}

			// other objects
			if($this->useOnlyCategories == false && $item[$id]['objType'] != 0)
			{
				$out .= $this->spaces($item['depth'])."$img <a class='link' style='$style' href='?id=".$id."'>".$item['title']."</a><br>";
			}
		}


		return $out;
	}


	
	
	
	
	
	
	
	function search() {
		
		$search = mysql_real_escape_string( $_POST["search"] );
		
		$out = '<h1 style="display: inline;">Search: </h1><span style="color: orange; font-weight: bold;">' . $search . '</span>';
		
		$lang = (isset($_SESSION['lang'])) ? $_SESSION['lang'] : 'lv';
		
		
		if(!$this->isAdmin) {
			
			$bb3auth = new BB3Auth();
			$priv = $bb3auth->check('u_raksti_priv') ? 'AND active = 1' : ' AND active = 1 AND priv < 1';
			
		}
		
		
		
		$sql = 'SELECT 
					id,  
					title_'.$lang.' as title,
					short_'.$lang.' as short,
					MATCH(title_'.$lang.', short_'.$lang.', texis_'.$lang.') AGAINST ("' . $search . '") AS score
        		FROM items
        		WHERE MATCH(title_'.$lang.', short_'.$lang.', texis_'.$lang.') AGAINST("' . $search . '") ' . $priv . '
        		ORDER BY score DESC ';
		
		$result = mysql_query($sql) or die(mysql_error());
		
		$num = mysql_num_rows($result);
		
		$out .= '<div>Found: ' . $num . ' records</div><hr size="1">';
		
		$n = 1;
		
		while($row = mysql_fetch_object($result)) {
			
			$out .= '<div class="search result">
					<a href="?id='.$row->id.'" style="font-size: 16px; font-weight: bold; display: block;">'.$row->title.'</a>
					' . $row->short . '
					</div>';
			
			$n++;
		}
		
		return $out;
	}


	



	function debug($sql, $err){
		if($this->qDebug)
		{
			echo $sql."<br>";
			echo $err."<br>";
			exit;
		}
	}



}	// EOF class












function js() {
	
	$items = new main();
	
	//list($images, $links) = $items->getCalImg();

	$out = '<script type="text/javascript">' . "\n";
	$out .= 'var BASE_URL = "'.BASE_URL.'";' . "\n";
	//$out .= 'var CAL_IMG = "'.BASE_URL.'' . $images . '";' . "\n";
	//$out .= 'var CAL_URL = "'. $links . '";' . "\n";
	$out .= '</script>' . "\n";
	
	return $out;
}






?>
