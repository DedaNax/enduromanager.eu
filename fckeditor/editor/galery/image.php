<?php

error_reporting(E_ALL);

// The file
$filename = $_GET['img'];
$w = $_GET['w'];


// Content type
//header('Content-type: image/jpeg');

//$img_path = "../../../img/";

include "mysql.php";


// cache
$image_p = cache($filename, $w);


// Output
imagejpeg($image_p, null, 100);












function cache($filename, $w)
{

	global $img_path;

	list($file, $ext) = explode(".", $filename);


	$image = $img_path . $file . "-" . $w . "." . $ext;


	if(is_file($image))
	{

		$image_p = imagecreatefromjpeg($image);


	} else {

		// resamplētais faiļuks izskatās, ka neeksistē...

		$image_p = resample($filename, $w);

		ob_start();
			imageJPEG($image_p);
			$image_buffer = ob_get_contents();
		ob_end_clean();


		$myFile = $image;
		$fh = fopen($myFile, 'w');
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


	if($width > $w && $height > ($w / 1.3157))
	{
		$new_width = ($w > 1) ? $w : $width;
		$new_height = $height * ((($w > 1) ? $w : $width) / $width);

	} else {

		$new_width = $width;
		$new_height = $height;
	}


	// korekcijas attieciba uz height

	if($new_height > ($w / 1.3157))
	{
		$new_height = $w / 1.3157;
		$new_width = $width * ($new_height / $height);
	}




	// Resample

	$image_p = imagecreatetruecolor($new_width, $new_height);
	$image = imagecreatefromjpeg($img_path.$filename);
	imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);


	return $image_p;
}








?>