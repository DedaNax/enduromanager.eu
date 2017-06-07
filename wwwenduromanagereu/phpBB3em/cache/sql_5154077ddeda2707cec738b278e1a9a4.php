<?php
if (!defined('IN_PHPBB')) exit;

/* SELECT forum_name FROM phpbb_forums WHERE forum_id = 43 */

$expired = (time() > 1311607293) ? true : false;
if ($expired) { return; }

$this->sql_rowset[$query_id] = unserialize('a:1:{i:0;a:1:{s:10:"forum_name";s:19:"Zaubes rudenis 2010";}}');

?>