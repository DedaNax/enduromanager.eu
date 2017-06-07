<?php
if (!defined('IN_PHPBB')) exit;
$expired = (time() > 1409690683) ? true : false;
if ($expired) { return; }

$data =  unserialize('a:6:{i:-1;i:4;i:-2;s:1:"d";i:0;s:3:"221";i:1;s:3:"179";i:2;s:3:"124";i:3;s:3:"121";}');

?>