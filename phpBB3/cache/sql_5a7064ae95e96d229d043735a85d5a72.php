<?php
if (!defined('IN_PHPBB')) exit;

/* SELECT forum_name FROM phpbb_forums WHERE forum_id = 14 */

$expired = (time() > 1468331649) ? true : false;
if ($expired) { return; }

$this->sql_rowset[$query_id] = unserialize('a:1:{i:0;a:1:{s:10:"forum_name";s:33:"Sacīkstes - Piedzīvojumu Enduro";}}');

?>