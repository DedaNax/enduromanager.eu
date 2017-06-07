<?php
/** 
*
* viewtopic [Latviešu]
*
* @package language
* @version $Id: viewtopic.php,v 1.20 2007/10/29 13:39:34 kellanved Exp $
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
	'ATTACHMENT'						=> 'Pielikumi',
	'ATTACHMENT_FUNCTIONALITY_DISABLED'	=> 'Pielikumu ielikšanas funkcija ir atslēgta.',

	'BOOKMARK_ADDED'		=> 'Tēma ir pievienota grāmatzīmēm',
	'BOOKMARK_REMOVED'		=> 'Tēma ir dzēsta no grāmatzīmēm.',
	'BOOKMARK_TOPIC'		=> 'Grāmatzīmes',
	'BOOKMARK_TOPIC_REMOVE'	=> 'Dzēst  no grāmatzīmēm',
	'BUMPED_BY'				=> 'Pēdējo reisi tēma bija aktuāla %1$s %2$s.',
	'BUMP_TOPIC'			=> 'Aktualizēt tēmu',

	'CODE'					=> 'Kods',

	'DELETE_TOPIC'			=> 'Dzēst tēmu',
	'DOWNLOAD_NOTICE'		=> 'Jūs nevarat redzēt šī ziņojuma pielikumus.',

	'EDITED_TIMES_TOTAL'	=> 'Pēdējo reizi labots %1$s %2$s, pavisam labots %3$d reizi(es).',
	'EDITED_TIME_TOTAL'		=> 'Pēdējo reizi labots %1$s %2$s, pavisam labots %3$d reizes.',
	'EMAIL_TOPIC'			=> 'Paziņot draugam',
	'ERROR_NO_ATTACHMENT'	=> 'Izvēlētais pielikums vairs neeksistē.',

	'FILE_NOT_FOUND_404'	=> 'Fails <strong>%s</strong> neeksistē.',
	'FORK_TOPIC'			=> 'Kopēt tēmu',

	'LINKAGE_FORBIDDEN'		=> 'Jūs neesat reģistrējies lai varētu apskatīt un lejupielādēt failu.',
	'LOGIN_NOTIFY_TOPIC'	=> 'Jūs saņēmāt paziņojumu par to, ka tēmā, ir jauns ziņojums,lūdzu, autorizējaties lai apskatītu ziņojumu',
	'LOGIN_VIEWTOPIC'		=> 'Lai apskatītu tēmu jums ir jābūt reģistrētam lietotājam.',

	'MAKE_ANNOUNCE'				=> 'Izveidot par paziņojumu',
	'MAKE_GLOBAL'				=> 'Izveidot par svarīgu',
	'MAKE_NORMAL'				=> 'Izveidot par parastu',
	'MAKE_STICKY'				=> 'Izveidot par pielīmētu',
	'MAX_OPTIONS_SELECT'		=> 'Jūs varat izvēlēties līdz pat <strong>%d</strong> atbilžu variantiem.',
	'MAX_OPTION_SELECT'			=> 'Jūs varat izvēlēties <strong>1</strong> atbilžu variantu.',
	'MISSING_INLINE_ATTACHMENT'	=> 'Pielikums <strong>%s</strong> nav pieejams.',
	'MOVE_TOPIC'				=> 'Pārvietot tēmu',

	'NO_ATTACHMENT_SELECTED'=> 'Jūs neesat izvēlējies lejupielādei pielikumu.',
	'NO_NEWER_TOPICS'		=> 'Šajā forumā nav jaunāku tēmu.',
	'NO_OLDER_TOPICS'		=> 'Šajā forumā nav vecāku tēmu.',
	'NO_UNREAD_POSTS'		=> 'Šajā tēmā nav jaunu nelasītu ziņojumu',
	'NO_VOTE_OPTION'		=> 'Pie balsošanas ir jānorāda atbildes variants.',
	'NO_VOTES'				=> 'Nav atbilžu.',

	'POLL_ENDED_AT'			=> 'Aptauja ir beigusies %s',
	'POLL_RUN_TILL'			=> 'Aptauja ilgst līdz %s',
	'POLL_VOTED_OPTION'		=> 'Jūs balsojāt par šo variantu',
	'PRINT_TOPIC'			=> 'Printēšanai',

	'QUICK_MOD'				=> 'Ātrās darbības',
	'QUOTE'					=> 'Citēts',

	'REPLY_TO_TOPIC'		=> 'Atbildēt uz tēma',
	'RETURN_POST'			=> '%sAtgriezties pie ziņojuma%s',

	'SUBMIT_VOTE'			=> 'Nobalsot',

	'TOTAL_VOTES'			=> 'Pavisam balsu',

	'UNLOCK_TOPIC'			=> 'Atvērt tēmu',

	'VIEW_INFO'				=> 'Informācija par ziņojumu',
	'VIEW_NEXT_TOPIC'		=> 'Nākošā tēma',
	'VIEW_PREVIOUS_TOPIC'	=> 'Iepriekšējā tēma',
	'VIEW_RESULTS'			=> 'Balsojuma rezultāti',
	'VIEW_TOPIC_POST'		=> '1 ziņojums',
	'VIEW_TOPIC_POSTS'		=> 'Ziņojumi: %d',
	'VIEW_UNREAD_POST'		=> 'Pirmais nelasītais ziņojums',
	'VISIT_WEBSITE'			=> 'WWW',
	'VOTE_SUBMITTED'		=> 'Paldies, Jūsu balss tiks ņemta vērā.',
	'VOTE_CONVERTED'		=> 'Balsu izmaiņas konvertētās aptaujās nav pieļaujama.',

));

?>