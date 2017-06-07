<?php
if (!defined('IN_PHPBB')) exit;
$expired = (time() > 1334234765) ? true : false;
if ($expired) { return; }

$data =  unserialize('a:4:{i:-1;i:2;i:-2;s:1:"d";i:0;s:3:"165";i:1;s:3:"164";}');

?>