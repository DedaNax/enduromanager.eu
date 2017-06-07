<?php
if (!defined('IN_PHPBB')) exit;
$expired = (time() > 1283930708) ? true : false;
if ($expired) { return; }

$data =  unserialize('a:4:{i:-1;i:2;i:-2;s:1:"d";i:0;s:3:"146";i:1;s:2:"82";}');

?>