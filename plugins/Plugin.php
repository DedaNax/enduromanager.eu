<?php




class Plugin {
	
	
	var $objType 	= 99;
	var $objTitle 	= "Plugins";
	var $ref;
	
	
	function __construct(&$ref) {
		
		$this->ref = $ref;
	}
	
	
	/*
	 *	Kas parādās publiskajā lapā (t.s. arī apakšdokumenti
	 *	@return $out ir callBack!
	 */
	
	
	function body(&$row, &$out) {

		// ja atvērta ziņa, tad rādām tikai to un neko vairāk
		
		if($row->objType == $this->objType) {
			$out = $row->text;
			return true;
		}

		// čekojam vai ir apakšdokumenti
		
		$out .= $this->docs($row);
		
		return false;		
	}
	

	
	
	
	function docs($row) {
		
		return $out;
	}
	
	

	/*
	 *	funkcija, kas pieliek klāt pie plusiņa (admin) jaunu objektu
	 */	

	
	function objType() {
		
		$out .= "<input type='radio' name='objType' id='obj".$this->objType."' value='".$this->objType."'>
					<label for='obj".$this->objType."'>". $this->objTitle . " </label><br>";
		
		return $out;
	}
	
	
	

	/*
	 *	Teksts, kas parādās admin body
	 *	Jāņem vērā, ka docs() lasās atsevišķi!
	 *	@return $out ir callBack!
	 */	
	

	function adminBody(&$row, &$out) {
		
		// rādā to pašu, ko public
		
		$this->body($row, $out);
		
		return false;
	}
	
	

	/*
	 *	Editors (admin, popup). Jāņem vērā, ka admin klasē ir saglabāti obligātie lauki - parent, title, show un save
	 *	@return $out ir callBack, bet aizvieto tikai neobligāto daļu!
	 */		
	
	
	function editor(&$row, &$out) {
		
		//$out = $this->ref->editor($row->texis);
	}

	
	
	/*
	 *	Tiek inicializēts pašās beigās, ja nu ko papildus jāsaglabā
	 */		
	
	
	function update(&$post) {
		
		// $id = $this->ref->id;
		// $table = $this->ref->table;
	}
	
	
	
}




?>