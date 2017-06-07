<?php

@define("BASE", dirname(__FILE__). '/../');

/*
 *	@title RM papilklase, kas nolasa header un footer
 *	@author Eriks
 */


require_once BASE . "class_main.php";

class AP {
	
	
	function __construct() {

		$this->items = new main("items");
		$this->items->setID(166);
	}
	
	
	
	function head() {

		$out = file_get_contents(BASE . "template_js.html");	
		$out = str_replace('<script type="text/javascript"></script>', js(), $out);
		
		$out = str_replace('="/apPasaule/', '="' . BASE_URL, $out);
		
		return $out;
	}
	
	
	function headers( $ext ) {


		$out = file_get_contents(BASE . "template_header.html");

		$out = str_replace("<lang>", lang(), $out);
		$out = str_replace("<side>", $this->items->showSideCategoriesPublic2( $ext ), $out);
		$out = str_replace("<sponsors>", $this->items->sponsors(), $out);
		
		$out = str_replace('="/apPasaule/', '="' . BASE_URL, $out);
		
		return $this->head() . $out . '<head><body>';
	}
	
	
	function footer() {

		$out = file_get_contents(BASE . "template_footer.html");

		$out = str_replace('="/apPasaule/', '="' . BASE_URL, $out);
		
		return $out . '</body></html>';
	}
	
}



function lang() {

	$langs['lv'] = 'LATVISKI';
	$langs['ru'] = 'ПО-РУССКИ';
	$langs['en'] = 'ENGLISH';
	$langs['es'] = 'ESPAÑOL';
	$langs['de'] = 'DEUTSCH';

	$out = Array();

	foreach($langs as $key => $value) {

		$active = ($_SESSION['lang'] == $key) ? 'style="color: black;"' : '';

		$out[] = '<li><a href="/apPasaule/?lang=' . $key . '" ' . $active . '>' . $value . '</a></li>';
	}


	return implode('<li>|</li>', $out);

}
