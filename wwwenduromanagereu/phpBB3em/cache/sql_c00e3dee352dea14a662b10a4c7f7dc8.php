<?php
if (!defined('IN_PHPBB')) exit;

/* SELECT forum_name FROM phpbb_forums WHERE forum_id = 36 */

$expired = (time() > 1301381675) ? true : false;
if ($expired) { return; }

$this->sql_rowset[$query_id] = unserialize('a:1:{i:0;a:1:{s:10:"forum_name";s:14:"apArabija 2009";}}');

?>