<?php
/**
*
* viewforum [Latviešu]
*
* @package language
* @version $Id: viewforum.php,v 1.18 2007/10/04 15:07:24 acydburn Exp $
* @copyright (c) 2005 phpBB Group
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
   exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine

$lang = array_merge($lang, array(
	'ACTIVE_TOPICS'			=> 'Aktīvās tēmas',
	'ANNOUNCEMENTS'			=> 'Paziņojumi',

	'FORUM_PERMISSIONS'		=> 'Piekļuves tiesības',

	'ICON_ANNOUNCEMENT'		=> 'Paziņojums',
	'ICON_STICKY'			=> 'Pielīmēta',

	'LOGIN_NOTIFY_FORUM'	=> 'Jūs saņēmāt paziņojumu par to, ka ir jauns ziņojums šajā tēmā, lūdzu, autorizējaties lai to apskatītu.',

	'MARK_TOPICS_READ'		=> 'Atzīmēt visas tēmas kā lasītas',

	'NEW_POSTS_HOT'			=> 'Jauni ziņojumi [ Populāra tēma ]',
	'NEW_POSTS_LOCKED'		=> 'Jauni ziņojumi [ Tēma slēgta ]',
	'NO_NEW_POSTS_HOT'		=> 'Nav jaunu ziņojumu [ Populāra tēma ]',
	'NO_NEW_POSTS_LOCKED'	=> 'Nav jaunu ziņojumu [ Тēma slēgta ]',
	'NO_READ_ACCESS'		=> 'Jums nav pieejas lai lasītu tēmas šajā forumā.',

	'POST_FORUM_LOCKED'		=> 'Forums slēgts',

	'TOPICS_MARKED'			=> 'Visas tēmas šajā forumā tika atzīmētas kā izlasītas.',

	'VIEW_FORUM'			=> 'Skatīt forumu',
	'VIEW_FORUM_TOPIC'		=> '1 tēma',
	'VIEW_FORUM_TOPICS'		=> 'Tēmas: %d',
));

?>