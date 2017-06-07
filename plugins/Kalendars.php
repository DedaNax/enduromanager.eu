<?php

class Kalendars extends Plugin {
	
	
	var $objType 	= 5;
	var $objTitle 	= "Kalendārs";
	
	
	const _table = 'kalendars';
	var $langs = Array('lv', 'ru', 'en', 'es', 'de');
	
	
	
	
	
	
	
	
	function objType() {
		
		return false;
	}
	
	
	
	
	
	
	
	function body(&$row, &$out) {
		
		if($this->ref->root == 6) {

			
			$out .= '<form action="?id='.$row->id.'" method="get" style="position: relative; padding-top: 20px;">
					
						<select name="year" style="position: absolute; right: 10px; top: -10px;" onchange="submit();">'.$this->years().'</select
					</form>';
					
			
			$out .= $this->cal();
			
			
		}
		
		return false;		
	}	
	
	
	
	

	
	
	
	
	
	function adminBody(&$row, &$out) {
				
		if($this->ref->root == 6) {
		
			if(isset($_GET['remove']))
				$this->remove($_GET['remove']);
			
			$out .= "</div><div>";
			
			$out .= '<form action="?id='.$row->id.'" method="get" style="position: relative; height: 20px;">
						<a href="javascript:editKalendars();" style="line-height: 20px; padding-left: 10px; color: red; text-decoration: none;"><img src="'.BASE_URL.'/images/insert.gif" alt="" border="0" style="vertical-align: middle;" />Pievienot jaunu</a>
						<select name="year" style="position: absolute; right: 10px;" onchange="submit();">'.$this->years().'</select
					</form>';
			
			$out .= $this->cal();
		}
	}
	
	
	
	
	
	function years() {
		
		$sql = 'SELECT DISTINCT year(`from`) as year 
				FROM '.Kalendars::_table.' 
				ORDER BY year';

		$result = mysql_query($sql) or die(mysql_error() . $sql);
		
		$year = (isset($_GET['year'])) ? $_GET['year'] : date('Y');
		
		while($row = mysql_fetch_object($result)) {
			
			$selected = ($year == $row->year) ? 'selected' : '';
			
			if($row->year > 0)
				$out .= '<option '.$selected.'>' . $row->year . '</option>';
		}
		
		return $out;
	}
	
	
	
	
	

	
	function cal() {
		
		$out = '<table width="100%" class="kalendars" border="1">';
		
		$monthes = Array(1 => "Jan.", 
						 2 => "Feb.", 
						 3 => "Mar.", 
						 4 => "Apr.", 
						 5 => "Mai", 
						 6 => "Jūn.", 
						 7 => "Jūl.", 
						 8 => "Aug.", 
						 9 => "Sep.", 
						 10 => "Okt.",
						 11 => "Nov.", 
						 12 => "Dec.");
		
		for($month = 1; $month <= 12; $month++) {
		
			$out .= '<tr>
						<td class="month">' . $monthes[$month] . '</td>
						<td class="event">' . $this->events($month) . '
						</td>
					</tr>';
			
		}
			
		$out .= '</table>';
				
		return $out;
	}
	
	
	
	
	function events($month) {

		
		$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'lv';
		
		$year = (isset($_GET['year'])) ? $_GET['year'] : date('Y');
		
		
		
		$bb3auth = new BB3Auth();
		$priv = $bb3auth->check('u_kalendars_priv') ? '' : ' AND priv < 1';
		
		
		
		$sql = 'SELECT 
					id, `from`, till, link,
					title_'.$lang.' as title,
					short_'.$lang.' as short
				FROM ' . Kalendars::_table . ' 
				WHERE year(`from`) = ' . (int)$year . ' AND month(`from`) = '.(int)$month . ' '.$priv.' AND active = 1
				HAVING title <> ""
				ORDER BY `from`';
		
		$result = mysql_query($sql) or die(mysql_error() . $sql);
		
		while($row = mysql_fetch_object($result)) {
						
			$out .= $this->event($row);
		}
		
		return $out;
	}
	
	
	
	function event(&$row) {
		
		if($this->ref->isAdmin) {
			
			$adm = '<div class="adm">';
			$adm .= '<a href="javascript:editKalendars('.$row->id.');"><img src="'.BASE_URL.'/images/edit.jpg" border="0" /></a>';
			$adm .= '<a href=\'javascript:removeKalendars('.$row->id.',"'.base64_encode($row->title).'");\'><img src="'.BASE_URL.'/images/delete.gif" border="0" /></a>';
			$adm .= '</div>';
		
		} else {
			$adm = '';
		}
		
		list($foo, $fromMonth, $fromDay ) = explode('-', $row->from);
		list($foo, $tillMonth, $tillDay ) = explode('-', $row->till);
		
		
		$link = !empty($row->link) ? $row->link : 'javascript:;';
		
		
		$out = '<div class="event">
					<a href="'.$link.'" class="event" title="'.htmlspecialchars(Kalendars::show($row)).'">No '.$fromDay.'.'.$fromMonth.' līdz '.$tillDay.'.'.$tillMonth.' &#187; <b>'.$row->title.'</b></a> '.$adm.'
				</div>';
		
		return $out;
	}
	
	
	
	
	
	static function feed($year, $month) {
				
		$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'lv';

		$bb3auth = new BB3Auth();
		$priv = $bb3auth->check('u_kalendars_priv') ? '' : ' AND priv < 1';
		
		$sql = 'SELECT 
					id, `from`, till, link,
					title_'.$lang.' as title,
					short_'.$lang.' as short
				FROM ' . Kalendars::_table . ' 
				WHERE year(`from`) = ' . (int)$year . ' AND month(`from`) = '.(int)$month . ' '.$priv.' AND active = 1
				HAVING title <> ""
				ORDER BY `from`';
		
		$result = mysql_query($sql) or die(mysql_error() . $sql);
		
		$out = Array();
		
		while($row = mysql_fetch_object($result)) {		
			
			list($y, $m, $d ) = explode('-', $row->from);
			
			$out[(int)$y . '/' . (int)$m . '/' . (int)$d][] = Kalendars::show($row);
		}
		
		return $out;
	}
	
	
	
	
	static function show($row) {
		
		list($foo, $fromMonth, $fromDay ) = explode('-', $row->from);
		list($foo, $tillMonth, $tillDay ) = explode('-', $row->till);
		
		$link = !empty($row->link) ? $row->link : 'javascript:;';
		
		$out = '<p>
					No '.$fromDay.'.'.$fromMonth.' līdz '.$tillDay.'.'.$tillMonth.' &#187; <a href="'.$link.'"><b>'.$row->title.'</b></a><br>
					' . $row->short . '
				</p>';
		
		return $out;
	}
	
	
	
	
	
	
	
	function admin($id) {
		
		include_once 'fckeditor/fckeditor.php' ;
		require_once 'ckfinder/ckfinder.php' ;
		
		global $langs;
		
		$bb3auth = new BB3Auth();
		if(!$bb3auth->check('u_kalendars_full'))
			die("Nav tiesību:(");
		
		$sql = 'SELECT 
					*
				FROM ' . Kalendars::_table . ' 
				WHERE id = ' . (int)$id;
		
		$result = mysql_query($sql) or die(mysql_error() . $sql);
		
		$row = mysql_fetch_object($result);
		
		$active = ($row->active == 1 || !isset($row->active)) ? "checked" : "";
		$priv 	= ($row->priv == 1) ? "checked" : "";	
		
		
		$out = '<div id="container-1">
            <ul>
                <li><a href="#fragment-1"><span>LV</span></a></li>
                <li><a href="#fragment-2"><span>RU</span></a></li>
                <li><a href="#fragment-3"><span>EN</span></a></li>
                <li><a href="#fragment-4"><span>EN</span></a></li>
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
	            	<td width="70" align="center">
					   	<b>Priv:</b> <input type="checkbox" name="priv" value="1" '.$priv.'>
					</td>					
					<td width="70" align=\"center\">
					   	<b>Rādīt:</b> <input type="checkbox" name="active" value="1" '.$active.'>
					</td>
					<td width="50">
						<input type="submit" value="Save">
					</td>
				</tr>
	            </table>
            </div>
            
        </div>
		';
		
		return $out;
	}
	
	
	
	
	
	
	
	function edit($row, $lang = 'lv') {
		
		$out .= "<table border='0' width='100%' style='height: 93%; font-size: 12px; font-family: Tahoma; border-collapse: collapse;'>";
		$out .= "<tr>
					<td width=\"110\" height='15' align=\"right\">
						<span id=links><b>Nosaukums ($lang): </b></span>
					</td>
					<td>
						<input type='text' name='title_$lang' style='width: 100%;' value=\"" . htmlspecialchars($row->{'title_' . $lang}) . "\">
					</td>
				</tr>";
		
		if($lang == 'lv') {
			
		$out .= "<tr>
					<td colspan='0' height='15' align='right'>
						No: 
					</td>
					<td valign='top' colspan='0' >
						<input type='text' class='date' name='from' value='$row->from' readonly='readonly' style='width: 90px;'> 
						Līdz: <input type='text' class='date' name='till' value='$row->till' readonly='readonly' style='width: 90px;'>
						
						&nbsp;&nbsp;
						URL: <input type='text' name='link' value='$row->link' style='width: 300px;'>
					</td>
				</tr>";
		}
		
		$out .= "<tr><td valign='top' colspan='2'>";
		
		// default - editors
		
		$out .= "<table border='0' width='100%' height='100%' style='font-size: 12px; font-family: Tahoma;'>
				 <tr>
					<td colspan='2' valign='top'>
						<div style='width:100%;height:100%;'>". $this->editor($row->{'short_' . $lang}, 'short_' . $lang)."</div>
					</td>
				 </tr>
				 </table>";		
		
		$out .= "</td></tr>";
		
		$out .= "</table>";	
		
		return $out;
	}
	
	
	
	
	function editor($texis, $field = 'texis')
	{

		$fckeditor = new FCKeditor( $field ) ;
		$fckeditor->BasePath	= 'fckeditor/' ;
		$fckeditor->ToolbarSet	= "Basic";
		$fckeditor->Height		= "100%";
		$fckeditor->Value		= $texis ;
		
		CKFinder::SetupFCKeditor( $fckeditor, 'ckfinder/' ) ;
		
		$out = $fckeditor->CreateHtml() ;

		return $out;
	}	
	
	
	
	
	
	
	function update() {
		
		
		if(count($_POST) > 1) {
			
			$id = $_GET['id'];
			
			
			$items[] = '`from` = ' . (!empty($_POST['from']) ? '"'.mysql_real_escape_string($_POST['from']).'"' : 'NULL');
			$items[] = 'till = ' . (!empty($_POST['till']) ? '"'.mysql_real_escape_string($_POST['till']).'"' : 'NULL');
			$items[] = 'link = "' . mysql_real_escape_string($_POST['link']) . '"';
			
			if(isset($_POST['active'])) { $items[] = 'active = 1'; } else { $items[] = 'active = 0'; }
			if(isset($_POST['priv'])) { $items[] = 'priv = 1'; } else { $items[] = 'priv = 0'; }
			
			foreach($this->langs as $lang) {
				
				$items[] = 'title_'.$lang.' = "' . mysql_real_escape_string(stripslashes($_POST['title_' . $lang])) . '"';
				$items[] = 'short_'.$lang.' = "' . mysql_real_escape_string(stripslashes($_POST['short_' . $lang])) . '"';
			}
			
			
			if($id > 0) {

				// update
				
				$sql = 'UPDATE ' . Kalendars::_table . ' 
						SET 
								' . implode(', ', $items) . '
						WHERE id = ' . (int)$id;
				
				$result = mysql_query($sql) or die(mysql_error() . '<pre>' . $sql);
				
			} else {
			
				// insert
				
				$sql = 'INSERT INTO ' . Kalendars::_table . '
						SET 
								' . implode(', ', $items);

				$result = mysql_query($sql) or die(mysql_error() . '<pre>' . $sql);
				
			}
			
			
			echo "<script language=\"JavaScript\">";
			echo "window.opener.location.reload();";
			echo "window.close();";
			echo "</script>";
			exit;
		}
		
	}
	
	
	
	
	
	function remove($id) {
		
		$bb3auth = new BB3Auth();
		if(!$bb3auth->check('u_kalendars_full'))
			die("Nav tiesību:(");
		
		$sql = 'DELETE FROM ' . Kalendars::_table . ' WHERE id = ' . (int)$id;
		$result = mysql_query($sql) or die(mysql_error() . '<pre>' . $sql);
	}
	
	
}





?>