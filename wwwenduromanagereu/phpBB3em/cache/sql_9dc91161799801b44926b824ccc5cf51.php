<?php
if (!defined('IN_PHPBB')) exit;

/* SELECT ban_ip, ban_userid, ban_email, ban_exclude, ban_give_reason, ban_end FROM phpbb_banlist WHERE ban_email = '' AND (ban_userid = 1 OR ban_ip <> '') */

$expired = (time() > 1496859367) ? true : false;
if ($expired) { return; }

$this->sql_rowset[$query_id] = unserialize('a:1:{i:0;a:6:{s:6:"ban_ip";s:12:"188.92.74.83";s:10:"ban_userid";s:1:"0";s:9:"ban_email";s:0:"";s:11:"ban_exclude";s:1:"0";s:15:"ban_give_reason";s:0:"";s:7:"ban_end";s:1:"0";}}');

?>