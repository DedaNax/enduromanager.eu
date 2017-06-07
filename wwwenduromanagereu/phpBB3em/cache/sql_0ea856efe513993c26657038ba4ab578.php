<?php
if (!defined('IN_PHPBB')) exit;

/* SELECT forum_name FROM phpbb_forums WHERE forum_id = 30 */

$expired = (time() > 1304017234) ? true : false;
if ($expired) { return; }

$this->sql_rowset[$query_id] = unserialize('a:1:{i:0;a:1:{s:10:"forum_name";s:21:"Daudzeses Vasara 2009";}}');

?>