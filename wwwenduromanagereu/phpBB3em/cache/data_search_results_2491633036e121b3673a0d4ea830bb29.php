<?php
if (!defined('IN_PHPBB')) exit;
$expired = (time() > 1273748752) ? true : false;
if ($expired) { return; }

$data =  unserialize('a:3:{i:-1;i:1;i:-2;s:1:"d";i:0;s:3:"128";}');

?>