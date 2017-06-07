<?php
if (!defined('IN_PHPBB')) exit;
$expired = (time() > 1310736443) ? true : false;
if ($expired) { return; }

$data =  unserialize('a:10:{i:-1;i:8;i:-2;s:1:"d";i:0;s:3:"142";i:1;s:3:"127";i:2;s:3:"126";i:3;s:3:"124";i:4;s:3:"121";i:5;s:2:"42";i:6;s:2:"40";i:7;s:2:"32";}');

?>