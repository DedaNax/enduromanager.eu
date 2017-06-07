<?php

//error_reporting(E_ALL ^ E_NOTICE);

/**
*	resaizo bildes, saglabājot cache
*	Usage: http://eriks.tuxit.lv/iinuu4/gimage.php?img=/UserFiles/images/WEB_lapas/ez1.jpg&w=200
*/


// file
$filename = $_GET['img'];
$filename = preg_replace("/^(\/evelo\/|\/)/", '', $filename);




// width
$w = (isset($_GET['width'])) ? $_GET['width'] :  $_GET['w'];


/*
$allowed = Array(230,800);
if(!in_array($w, $allowed)) {
	$w = 120;
}
*/


// Content type
header('Content-type: image/jpeg');



global $img_path;

$img_path = dirname($filename) . "/";

if(substr($img_path, 0, 1) == "/")
	$img_path = substr($img_path, 1, strlen($img_path));


$img_path = str_replace("evelo/", "", $img_path);





if(!is_file($filename))
	exit(1);




// cache
$image_p = cache(basename($filename), $w);


// Output
imagejpeg($image_p, null, 80);











function cache($filename, $w)
{

	global $img_path;

	list($file, $ext) = explode(".", $filename);

	@mkdir($img_path . ".cache");
	$image = $img_path . ".cache/" . $file . "-" . $w . "." . $ext;


	if(is_file($image))
	{

		//$image_p = imagecreatefromjpeg($image);
		readfile($image);
		exit;

	} else {

		// resamplētais faiļuks izskatās, ka neeksistē...
		
		$image_p = resample($filename, $w);

		ob_start();
			imageJPEG($image_p);
			$image_buffer = ob_get_contents();
		ob_end_clean();


		$myFile = $image;
		$fh = fopen($myFile, 'w+');
		fwrite($fh, $image_buffer);

		fclose($fh);


	}


	return $image_p;
}









function resample($filename, $w)
{

	global $img_path;


	// Get new dimensions
	list($width, $height) = getimagesize($img_path.$filename);


	if($w < 1) { $w = $width; }


	if( $width < $height ) {
		$rate = $w / $width;
	} else {
		$rate = $w / $height;
	}

	
	$new_width	= round($width * $rate, 0);
	$new_height = round($height * $rate, 0);

	
	// ja jaunie izmēri lielāki nekā orģināls, tad neresamplējam.
	
	if($new_width > $width && $new_height > $height) {
		$new_width = $width;
		$new_height  = $height;
	}
	
	
	// Resample

	$image_p = imagecreatetruecolor($new_width, $new_height);
	$image = imagecreatefromjpeg($img_path.$filename);
	imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

		
	return $image_p;
}








?>