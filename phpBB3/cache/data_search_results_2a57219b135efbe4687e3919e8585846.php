<?php
if (!defined('IN_PHPBB')) exit;
$expired = (time() > 1300716253) ? true : false;
if ($expired) { return; }

$data =  unserialize('a:6:{i:-1;i:4;i:-2;s:1:"d";i:0;s:3:"162";i:1;s:3:"155";i:2;s:3:"151";i:3;s:3:"148";}');

?>