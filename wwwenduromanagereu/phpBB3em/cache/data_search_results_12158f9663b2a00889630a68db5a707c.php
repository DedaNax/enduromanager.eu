<?php
if (!defined('IN_PHPBB')) exit;
$expired = (time() > 1284560918) ? true : false;
if ($expired) { return; }

$data =  unserialize('a:9:{i:-1;i:7;i:-2;s:1:"d";i:0;s:3:"145";i:1;s:3:"133";i:2;s:2:"78";i:3;s:2:"54";i:4;s:2:"22";i:5;s:1:"2";i:6;s:1:"1";}');

?>