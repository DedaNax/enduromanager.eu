<?php
if (!defined('IN_PHPBB')) exit;
$expired = (time() > 1394289421) ? true : false;
if ($expired) { return; }

$data =  unserialize('a:5:{s:4:"name";s:5:"Bl@ck";s:9:"copyright";s:11:"Seven ALive";s:7:"version";s:5:"1.0.5";s:14:"parse_css_file";b:1;s:8:"filetime";i:1350935709;}');

?>