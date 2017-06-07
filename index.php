<?php
error_reporting(1);
ini_set("display_errors", 1);



require_once "class_main.php";


global $langs;
$langs = Array('lv', 'ru', 'en', 'es', 'de');


if(isset($_GET['lang']) && in_array($_GET['lang'], $langs)) {
	
	$_SESSION['lang'] = $_GET['lang'];
	
} else if (!isset($_SESSION['lang'])) {
	
	$_SESSION['lang'] = 'lv';
}



$items = new main("items");
$items->setID(SEO::decode($_GET['id']));
$items->setLanguage($_SESSION['lang']);


$start 	= file_get_contents("template_start.html");
$js 	= file_get_contents("template_js.html");
$header = file_get_contents("template_header.html");
$footer = file_get_contents("template_footer.html");
$end 	= file_get_contents("template_end.html");


$start = str_replace("<js>", $js, $start);

$body = $items->showBodyPublic();
$template = $start . $header . $body . $footer . $end;
$template = str_replace("<sponsors>", $items->sponsors(), $template);

$template = str_replace("<lang>", lang(), $template);

$template = str_replace("<side>", (string)$items->showSideCategoriesPublic(), $template);

$template = str_replace('<script type="text/javascript"></script>', js(), $template);
$template = str_replace('="/apPasaule/', '="' . BASE_URL, $template);

echo $template;







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






?>