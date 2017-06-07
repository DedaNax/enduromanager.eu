<?php

class Item
{

	protected $host = "localhost";
	protected $user = "root";
	protected $pass = "tux.tux";
	protected $db	= "test";

	public $vienibas = array(), $valuta = array();

	public $id = false, $post = false, $doc = "about", $page = false, $imgID = 0;
	public $perPage = 10;




	public function __construct( $table = "lv_items")
	{
		$this->table = $table;


		require_once "mysql.php";

		if(isset($_GET['cls'])) 
		{ 
			$this->destorySession();
		}

		// refID ir dots



		if(!isset($_GET['doc']) || strlen($_GET['doc']) < 1) {
		
			$this->doc = "about";

		} else {

			$this->doc = $_GET['doc'];
		}

		$this->sub = $_GET['sub'];		$_SESSION['objTips'] = $this->sub;

		$this->op = $_GET['op'];		
			if($_GET['op'] > 0) { $_SESSION['darijums'] =  $this->op; }
	
		$this->id = $_GET['id'];
		
		if(isset($_POST['refID']) && $_POST['refID'] > 0)
		{
			$this->id = $_POST['refID'];
		}

		if(isset($_POST['search'])) 
		{ 
			$this->post = true; 
			$this->destorySession();
			$this->sub = $_POST['objTips'] > 0 ? $_POST['objTips'] : $_GET['sub'];
			$this->setPost();
		}

		if(isset($_GET['page'])) 
		{ 
			$this->page = $_GET['page']; 
			$_SESSION['page'] = $this->page;

		}



	}




	protected function getImage($w = false, $h = false, $id = false)
	{
		$popup = "";

		if(!$id) 
		{ 
			$id = $this->id;
			$popup = "onClick='JavaScript:bildes($this->id)'"; 		
		}


		$sql = "SELECT * FROM images WHERE objektsID = '$id'";
		$result = mysql_query($sql);

		if($w) 
		{
			if($h)
			{
				$parms = "&w=$w&h=$h";
			} else {
				$parms = "&w=$w";
			}
		} else if($h) {

			if($h)
			{
				$parms = "&h=$h";
			} 
		} else {
			$parms = "";
		}

		if($row = mysql_fetch_object($result))		
		{
			return "<img src='images/fp.gif' width='$w' border='0' style='background: url(gimage.php?img=".str_replace('img/', '', $row->image).$parms.") no-repeat center center' $popup>";
		} else {
			return "<img src='images/fp.gif' border='0'>";
		}
	}



	protected function countImages()
	{
		$sql = "SELECT * FROM galery_images WHERE objektsID = '$this->id'";
		$result = mysql_query($sql);

		if($row = mysql_fetch_object($result))
		{
			return mysql_num_rows($result);
		} else {
			return 0;
		}

	}





	public function getSmallImages()
	{
		$sql = "SELECT * FROM galery_images WHERE objektsID = '$this->id' ORDER BY seq, id";
		$result = mysql_query($sql);

		$skaits = mysql_num_rows($result);
		$rindas = ceil($skaits / 2);

		$data = array();

		$out .= "<table width='160' border='0' cellspacing='5'>";

		while($row = mysql_fetch_object($result))
		{

			$data[] = array($row->id, $row->image);

			//return "<img src='gimage.php?img=".$row->image.$parms."' border='0' $popup>";
		}
		
		for($k=0; $k < count($data); $k+=2)
		{
			$color1 = ($data[$k][0] == $this->imgID) ? "red" : "gray";
			$color2 = ($data[$k+1][0] == $this->imgID) ? "red" : "gray";

			$href1 = "?id=$this->id&imgID=".$data[$k][0];
			$href2 = "?id=$this->id&imgID=".$data[$k+1][0];

			$img1 = isset($data[$k][1]) ? "<td width='80' height='60' style='border: 1px solid $color1;'><a href='$href1'><img src='images/small.gif' border='0' style='background: url(gimage.php?img=".str_replace('img/', '',$data[$k][1])."&w=80) no-repeat center center'></a></td>" : "<td width='80' height='60'></td>";

			$img2 = isset($data[$k+1][1]) ? "<td width='80' height='60' style='border: 1px solid $color2;'><a href='$href2'><img src='images/small.gif' border='0' style='background: url(gimage.php?img=".str_replace('img/', '',$data[$k+1][1])."&w=80) no-repeat center center'></a></td>" : "<td width='80' height='60'></td>";

			$out .= "<tr>
						$img1
						$img2
					</tr>";
		}
		
		$out .= "</table>";

		return $out;
	}



	public function getBigImage()
	{

		$this->imgID = isset($_GET['imgID']) ? $_GET['imgID'] : 0;

		if($this->imgID != 0) { $str = " AND id = '$this->imgID'"; }

		$sql = "SELECT * FROM galery_images WHERE objektsID = '$this->id' $str ORDER BY seq, id";
		$result = mysql_query($sql);

		if($row = mysql_fetch_object($result))
		{
			$this->imgID = $row->id;
			$parms = "&w=500";
			//return "<img src='gimage.php?img=".$row->image.$parms."' border='0' $popup>";
			return "<img src='images/image.gif' style='background: url(gimage.php?img=".$row->image.$parms.") no-repeat center center'>";
		}

		return $out;
	}



	public function getNext()
	{
		$sql = "SELECT * FROM galery_images WHERE objektsID = '$this->id' ORDER BY seq, id";
		$result = mysql_query($sql);

		$yes = false;

		while($row = mysql_fetch_object($result))
		{
			if($yes)
			{
				return "<a href='?id=$this->id&imgID=$row->id'><img src='images/next.gif' border='0'></a>";
				$yes = false;
			}

			if($this->imgID == $row->id)
			{
				$yes = true;
			}
		}
	}


	public function getPrev()
	{

		$sql = "SELECT * FROM galery_images WHERE objektsID = '$this->id' ORDER BY seq, id";
		$result = mysql_query($sql);

		$yes = false;

		while($row = mysql_fetch_object($result))
		{

			if($this->imgID == $row->id)
			{
				return $prev;
			}

			$prev = "<a href='?id=$this->id&imgID=$row->id'><img src='images/prev.gif' border='0'></a>";

		}

	}






	public function printing()
	{

		$titles = "font-weight: bold; color: green;";
		$item = "font-weight: bold; color: black;";

		//$data[] = array();
		$data[3] = array("objTips", "istabas", "stavs", "platiba", "cena");
		$data[2] = array("objTips", "stavi", "platiba", "cena");
		$data[4] = array("objTips", "platiba", "cena");
		$data[5] = array("objTips", "stavs", "platiba", "cena");
		$data[6] = array("objTips", "platiba", "cena");


		$href = "?doc=$this->doc&sub=$this->sub&page=".$_SESSION['page'];
		$out .= "<a href=\"JavaScript:history.back(-1);\" id='saite'>&#171 Back</a><br>";

		$out .= "<table width='100%' border='0' cellpadding='5' style='border-bottom: 1px solid gray;' id='saite'>
				<tr>
					<td style='$titles'><vieta></td>
					<td width='100'>Ref ID: $this->id</td>
					<td width='30'><img src='img/print.gif' border='0' onClick=\"JavaScript:window.print();\"></td>
				</tr>
				</table>";

		$out .= "<table width='100%' height='130' border='0' cellpadding='5' style='border-bottom: 1px solid #CCCCCC;' id='saite'>
				<tr>
					<td width='150' valign='top' align='center'>
						<div style='width:160px;height:140px;border:0px solid gray;'>
							<image>
						</div>
						<span style='color: #AAAAAA;'>
							"._tr('Attēli')." (<countImages>)
						</span>
					</td>
					<td valign='top'>

						<table width='100%' border='0' cellpadding='3' style='border-collapse: collapse;' id='saite'>
							<details>
						</table>
					</td>
				</tr>
				<tr><td style='height: 5px;'></td></tr>
				</table>";

		$out .= "<table width='100%' border='0' cellpadding='5' style='border-bottom: 1px solid #CCCCCC;' id='saite'>
				<tr>
					<td width='100' style='$titles' valign='top'>"._tr('Darījums').":</td>
					<td valign='top'><operacija></td>
				</tr>
				</table>";		

		$out .= "<table width='100%' border='0' cellpadding='5' style='border-bottom: 1px solid #CCCCCC;' id='saite'>
				<tr>
					<td width='100' style='$titles' valign='top'>"._tr('Apraksts').":</td>
					<td valign='top'><apraksts></td>
				</tr>
				</table>";

		$out .= "<table width='100%' border='0' cellpadding='5' style='border-bottom: 1px solid #CCCCCC;' id='saite'>
				<tr>
					<td width='100' style='$titles' valign='top'>"._tr('Kontakti').":</td>
					<td valign='top'><kontakti></td>
				</tr>
				</table>";


		$sql = "SELECT * FROM objekts WHERE id = '$this->id'";
		$result = mysql_query($sql);

		

		if($row = mysql_fetch_array($result))
		{
			$pilseta	= $row['pilseta'] > 1 ? $this->getValue('pilseta', $row['pilseta']) : "";
			$rajons		= $row['rajons'] > 1 ? ", ".$this->getValue('rajons', $row['rajons']) : "";
			$adrese		= strlen($row['adrese1']) > 1 ? ", ".$row['adrese1'] : "";
			$vieta = $pilseta.$rajons.$adrese;

			$apraksts = $row['apraksts'];
			$kontakti = $row['kontakti'];
			$operacija = $this->getValue('darijums', $row['darijums']);
			//$this->doc = $this->getValue('objTips', $row['objTips']);
			
			
			$x = $data[$row['objTips']];
			if(!is_array($x)) { $x = array(); }

			foreach($x as $value)
			{
				if($value == 'objTips') {

					$details .= "<tr><td width:'40%'>"._tr(objekts)."</td><td style='$item'>"._tr($this->getValue('objTips', $row['objTips']))."</td></tr>";

				} else if($value == 'stavs'){

					$details .= "<tr><td width:'40%'>"._tr($value)."</td><td style='$item'>".$row['stavs']." (".$row['stavi'].")</td></tr>";

				} else if($value == 'cena') {

					$details .= "<tr><td width:'40%'>"._tr($value)."</td><td style='$item'>".$row['cena']." ".$this->getValue('valuta', $row['valuta'])."</td></tr>";

				} else if($value == 'platiba') {

					$details .= "<tr><td width:'40%'>"._tr($value)."</td><td style='$item'>".$row['platiba']." ".$this->getValue('vienibas', $row['vienibas'])."</td></tr>";

				} else {
					$details .= "<tr><td width:'40%'>"._tr($value)."</td><td style='$item'>".$row[$value]."</td></tr>";
				}
			}

			$out = str_replace("<details>", $details, $out);
	
			$out = str_replace("<vieta>", $vieta, $out);
			$out = str_replace("<operacija>", $operacija, $out);
			$out = str_replace("<apraksts>", $apraksts, $out);
			$out = str_replace("<kontakti>", $kontakti, $out);

			$out = str_replace("<image>", $this->firstImage(), $out);
			$out = str_replace("<countImages>", $this->countImages(), $out);

		} else {

			$out = "<a href=\"JavaScript:window.history.back(-1);\" id='saite'>&#171 Back</a><br><br>";
			$out .= "<span id='saite'>"._tr('Objekts nav atrasts')."..</span>";

		}



		return $out;
	}



	public function firstImage()
	{
		$sql = "select * from images where objektsID = '$this->id' ORDER BY seq, id ASC";
		$result = mysql_query($sql);

		if($row = mysql_fetch_object($result))
		{
			$img = str_replace("img/", "", $row->image);
			return "<img src='gimage.php?img=".$img."&w=160'>";
		}
	}


	public function getGaleryName()
	{
		$sql = "
		SELECT
		`galery_images`.`objektsID`,
		`galery_list`.`texis`
		FROM
		`galery_images`
		Inner Join `galery_list` ON `galery_images`.`objektsID` = `galery_list`.`id`
		WHERE
		`galery_images`.`objektsID` =  '$this->id'";
		
		$result = mysql_query($sql);

		if($row = mysql_fetch_object($result))
		{
			$galeryName = str_replace("img/", "", $row->texis);
			return $galeryName;
		}
	}



}

?>