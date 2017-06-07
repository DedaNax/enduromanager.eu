<?php
if (!defined('IN_PHPBB')) exit;
$expired = (time() > 1267021172) ? true : false;
if ($expired) { return; }

$data =  unserialize('a:10:{i:-1;i:8;i:-2;s:1:"d";i:0;s:2:"92";i:1;s:2:"46";i:2;s:2:"44";i:3;s:2:"36";i:4;s:2:"34";i:5;s:1:"8";i:6;s:1:"6";i:7;s:1:"4";}');

?>