<?php
if (!defined('IN_PHPBB')) exit;

/* SELECT forum_name FROM phpbb_forums WHERE forum_id = 1 */

$expired = (time() > 1313571678) ? true : false;
if ($expired) { return; }

$this->sql_rowset[$query_id] = array();

?>