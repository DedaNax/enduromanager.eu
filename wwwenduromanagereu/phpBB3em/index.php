<?php
/**
*
* @package phpBB3
* @version $Id: index.php 8987 2008-10-09 14:17:02Z acydburn $
* @copyright (c) 2005 phpBB Group
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
*/

/**
* @ignore
*/
define('IN_PHPBB', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
include($phpbb_root_path . 'includes/functions_display.' . $phpEx);

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup('viewforum');

display_forums('', $config['load_moderators']);


$template->assign_vars(Array(
	'S_LOGIN_ACTION'	=> append_sid("{$phpbb_root_path}ucp.$phpEx", 'mode=login'),
	'SITENAME'			=> 'apPasaule'
));


page_header($user->lang['INDEX']);

$template->set_filenames(array(
	'body' => 'index_body.html')
);


$template->display('body');


page_footer();

?>