<?php
if (!defined('IN_PHPBB')) exit;

/* SELECT forum_id, forum_name, parent_id, forum_type, left_id, right_id FROM phpbb_forums ORDER BY left_id ASC */

$expired = (time() > 1364912457) ? true : false;
if ($expired) { return; }

$this->sql_rowset[$query_id] = unserialize('a:8:{i:0;a:6:{s:8:"forum_id";s:2:"14";s:10:"forum_name";s:33:"Sacīkstes - Piedzīvojumu Enduro";s:9:"parent_id";s:1:"0";s:10:"forum_type";s:1:"1";s:7:"left_id";s:1:"1";s:8:"right_id";s:1:"2";}i:1;a:6:{s:8:"forum_id";s:2:"18";s:10:"forum_name";s:12:"Ekspedicijas";s:9:"parent_id";s:1:"0";s:10:"forum_type";s:1:"1";s:7:"left_id";s:1:"3";s:8:"right_id";s:1:"8";}i:2;a:6:{s:8:"forum_id";s:2:"34";s:10:"forum_name";s:16:"apKarpatiem 2009";s:9:"parent_id";s:2:"18";s:10:"forum_type";s:1:"1";s:7:"left_id";s:1:"4";s:8:"right_id";s:1:"5";}i:3;a:6:{s:8:"forum_id";s:2:"36";s:10:"forum_name";s:14:"apArabija 2009";s:9:"parent_id";s:2:"18";s:10:"forum_type";s:1:"1";s:7:"left_id";s:1:"6";s:8:"right_id";s:1:"7";}i:4;a:6:{s:8:"forum_id";s:2:"26";s:10:"forum_name";s:9:"TOURATECH";s:9:"parent_id";s:1:"0";s:10:"forum_type";s:1:"1";s:7:"left_id";s:1:"9";s:8:"right_id";s:2:"10";}i:5;a:6:{s:8:"forum_id";s:2:"24";s:10:"forum_name";s:15:"Pērk / Pārdod";s:9:"parent_id";s:1:"0";s:10:"forum_type";s:1:"1";s:7:"left_id";s:2:"11";s:8:"right_id";s:2:"12";}i:6;a:6:{s:8:"forum_id";s:2:"38";s:10:"forum_name";s:18:"Kā lietot FORUMU?";s:9:"parent_id";s:1:"0";s:10:"forum_type";s:1:"1";s:7:"left_id";s:2:"13";s:8:"right_id";s:2:"14";}i:7;a:6:{s:8:"forum_id";s:2:"22";s:10:"forum_name";s:14:"Par mājaslapu";s:9:"parent_id";s:1:"0";s:10:"forum_type";s:1:"1";s:7:"left_id";s:2:"15";s:8:"right_id";s:2:"16";}}');

?>