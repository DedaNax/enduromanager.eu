<?php

global $img_path;


$root = $_SERVER["DOCUMENT_ROOT"];


if(is_file($root . "v2/class_main.php"))
{

    // inicializee mysql savienojumu
    
    require_once($root . "v2/class_main.php");
    $foo = new main;

    $img_path = $root . "v2/" . $foo->galeryPath;

} else {

    die("MySQL connection data missing..");

//$db = mysql_connect("localhost", "root", "tux.tux");
//mysql_select_db("aig", $db);

//require_once "../../../mysql.php";

}



?>