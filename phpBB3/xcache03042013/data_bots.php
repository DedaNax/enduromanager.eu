<?php
if (!defined('IN_PHPBB')) exit;
$expired = (time() > 1394293753) ? true : false;
if ($expired) { return; }

$data =  unserialize('a:6:{i:0;a:3:{s:7:"user_id";s:2:"13";s:9:"bot_agent";s:20:"Mediapartners-Google";s:6:"bot_ip";s:0:"";}i:1;a:3:{s:7:"user_id";s:2:"15";s:9:"bot_agent";s:18:"Feedfetcher-Google";s:6:"bot_ip";s:0:"";}i:2;a:3:{s:7:"user_id";s:2:"14";s:9:"bot_agent";s:14:"Google Desktop";s:6:"bot_ip";s:0:"";}i:3;a:3:{s:7:"user_id";s:2:"51";s:9:"bot_agent";s:12:"Yahoo! Slurp";s:6:"bot_ip";s:0:"";}i:4;a:3:{s:7:"user_id";s:2:"16";s:9:"bot_agent";s:9:"Googlebot";s:6:"bot_ip";s:0:"";}i:5;a:3:{s:7:"user_id";s:2:"25";s:9:"bot_agent";s:7:"msnbot/";s:6:"bot_ip";s:0:"";}}');

?>