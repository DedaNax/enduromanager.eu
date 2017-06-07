<?php
/** 
*
* memberlist [Latviešu]
*
* @package language
* @version $Id: memberlist.php,v 1.35 2007/10/04 15:07:24 acydburn Exp $
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
	'ABOUT_USER'			=> 'Profils',
	'ACTIVE_IN_FORUM'		=> 'Aktīvākais forumā',
	'ACTIVE_IN_TOPIC'		=> 'Aktīvākais tēmā',
	'ADD_FOE'				=> 'Pievienot nedraugiem',
	'ADD_FRIEND'			=> 'Pievienot draugiem',
	'AFTER'					=> 'Pēc',

	'ALL'					=> 'Viss',

	'BEFORE'				=> 'līdz',

	'CC_EMAIL'				=> 'Atsūtīt man šī ziņojuma kopiju.',
	'CONTACT_USER'			=> 'Kontaktinformācija',

	'DEST_LANG'				=> 'ValodaЯ',
	'DEST_LANG_EXPLAIN'		=> 'Izvēlaties zinōjuma saņēmēja valodu (ja ir pieejama).',

	'EMAIL_BODY_EXPLAIN'	=> 'Ziņojums tiks nosūtīts kā parasts teksts,neiekļaujiet tajā html vai BBCode. Kā atpakaļadrese tiks norādīts Jūsu e-mails.',
	'EMAIL_DISABLED'		=> 'Piedodiet, bet visas funkcijas, kas ir saistītas ar e-mail nosūtīšanu ir atslēgtas.',
	'EMAIL_SENT'			=> 'Ziņojums tika nosūtīts.',
	'EMAIL_TOPIC_EXPLAIN'	=> 'Ziņojums tiks nosūtīts kā parasts teksts,neiekļaujiet tajā html vai BBCode. Kā atpakaļadrese tiks norādīts Jūsu e-mails.',
	'EMPTY_ADDRESS_EMAIL'	=> 'Norādiet saņēmēja pareizu e-mail adresi.',
	'EMPTY_MESSAGE_EMAIL'	=> 'Lai nosūtītu jums ir jāievada ziņojuma teksts.',
	'EMPTY_MESSAGE_IM'		=> 'Lai nosūtītu jums ir jāievada ziņojuma teksts.',
	'EMPTY_NAME_EMAIL'		=> 'Ievadiet pareizu lietotāja vārdu.',
	'EMPTY_SUBJECT_EMAIL'	=> 'Norādiet ziņojuma tēmu.',
	'EQUAL_TO'				=> 'vienāds',

	'FIND_USERNAME_EXPLAIN'	=> 'Šeit varat meklēt konkrētus lietotājus. Nav nepieciešamības aizpildīt visus laukus. Lai meklētu pēc šablona izmantojiet *. Ievadot datumus izmantojiet formātu <kbd>YYYY-ММ-DD</kbd>, piemēram, <samp>2004-02-29</samp>. Atzīmējiet ar ķeksīti vienu vai vairākus lietotājus un spiediet uz "Izvēlēties atzīmētos".',
	'FLOOD_EMAIL_LIMIT'		=> 'Jūs nevarat sūtīt vēl vienu vēstuli! Lūdzu pamēģiniet mazliet vēlāk',

	'GROUP_LEADER'			=> 'Grupas līderis',

	'HIDE_MEMBER_SEARCH'	=> 'Slēpt lietotāju meklēšanu',

	'IM_ADD_CONTACT'		=> 'Pievienot kontaktiem',
	'IM_AIM'				=> 'Ņemat vērā, ka ir jābūt uzstādītai programmai AOL Instant Messenger.',
	'IM_AIM_EXPRESS'		=> 'AIM Express',
	'IM_DOWNLOAD_APP'		=> 'Lejupielādēt pielikumu',
	'IM_ICQ'				=> 'Ņemat vērā, ka lietotājs varēja atslēgt funkciju - Vēstuļu saņemšana no nepazīstamiem kontaktiem.',
	'IM_JABBER'				=> 'Ņemat vērā, ka lietotājs varēja atslēgt funkciju - Vēstuļu saņemšana no nepazīstamiem kontaktiem.',
	'IM_JABBER_SUBJECT'		=> 'Šis ir automātiski radīts ziņojums uz kuru nevajag atbildēt! Ziņojuma autors %1$s no %2$s.',
	'IM_MESSAGE'			=> 'Jūsu ziņojums',
	'IM_MSNM'				=> 'Ņemat vērā, ka šim nolūkam jums ir jābūt uzstādītai programmai Windows Messenger.',
	'IM_MSNM_BROWSER'		=> 'Jūsu interneta pārlūks neatbalsta šo funkciju.',
	'IM_MSNM_CONNECT'		=> 'MSNM neatbild.\nLai turpinātu ir nepieciešams savienojums ar klientu.',
	'IM_NAME'				=> 'Jūsu vārds',
	'IM_NO_DATA'			=> 'Šim lietotājam neeksistē kontaktinformācija.',
	'IM_NO_JABBER'			=> 'Atvainojiet, bet ziņojumu sūtīšana pa tiešo Jabber lietotājiem nav iespējama. Lai sazinātos ar šo lietotāju Jums ir jāuzstāda Jabber klients.',
	'IM_RECIPIENT'			=> 'Saņēmējs',
	'IM_SEND'				=> 'Sūtīt ziņojumu',
	'IM_SEND_MESSAGE'		=> 'Sūtīt ziņojumu',
	'IM_SENT_JABBER'		=> 'Jūsu ziņojums priekš %1$s tika veiksmīgi nosūtīts.',
	'IM_USER'				=> 'Sūtīt ātro ziņojumu',
	
	'LAST_ACTIVE'				=> 'Pēdējais apmeklējums',
	'LESS_THAN'					=> 'mazāk',
	'LIST_USER'					=> 'Lietotājs: 1',
	'LIST_USERS'				=> 'Lietotāji: %d',
	'LOGIN_EXPLAIN_LEADERS'		=> 'Jums ir jāautorizējas, lai apskatītu mūsu komandas dalībnieku sarakstu.',
	'LOGIN_EXPLAIN_MEMBERLIST'	=> 'Jums ir jāautorizējas, lai apskatītu lietotāju sarakstu.',
	'LOGIN_EXPLAIN_SEARCHUSER'	=> 'Jums ir jāautorizējas, lai varētu meklēt lietotājus.',
	'LOGIN_EXPLAIN_VIEWPROFILE'	=> 'Jums ir jāautorizējas lai apskatītu lietotāju profilus.',

	'MORE_THAN'				=> 'vairāk',

	'NO_EMAIL'				=> 'Jums nav atļauts sūtīt e-mailu šim lietotājam.',
	'NO_VIEW_USERS'			=> 'Jums ir liegta pieeja lietotāju sarakstam.',

	'ORDER'					=> 'Sakārtot',
	'OTHER'					=> 'Cita',

	'POST_IP'				=> 'IP/Hosts',

	'RANK'					=> 'Rangs',
	'REAL_NAME'				=> 'Lietotāja vārds',
	'RECIPIENT'				=> 'Saņēmējs',
	'REMOVE_FOE'			=> 'Dzēst no nedraugiem',
	'REMOVE_FRIEND'			=> 'Dzēst no draugiem',

	'SEARCH_USER_POSTS'		=> 'Atrast lietotāja ziņojumus',
	'SELECT_MARKED'			=> 'Izvēlēties atzīmētos',
	'SELECT_SORT_METHOD'	=> 'Šķirošanas metode',
	'SEND_AIM_MESSAGE'		=> 'Sūtīt AIM-ziņojumu',
	'SEND_ICQ_MESSAGE'		=> 'Sūtīt ICQ-ziņojumu',
	'SEND_IM'				=> 'Sūtīt ātro ziņojumu',
	'SEND_JABBER_MESSAGE'	=> 'Sūtīt Jabber-ziņojumu',
	'SEND_MESSAGE'			=> 'Sūtīt',
	'SEND_MSNM_MESSAGE'		=> 'Sūtīt MSNM/WLM-ziņojumu',
	'SEND_YIM_MESSAGE'		=> 'Sūtīt YIM-ziņojumu',
	'SORT_EMAIL'			=> 'email',
	'SORT_LAST_ACTIVE'		=> 'Pēdējais apmeklējums',
	'SORT_POST_COUNT'		=> 'Ziņojumu skaits',

	'USERNAME_BEGINS_WITH'	=> 'Lietotājvārds sākas ar',
	'USER_ADMIN'			=> 'Administrēt',
	'USER_FORUM'			=> 'Lietotāja statistika',
	'USER_ONLINE'			=> 'Onlainā',
	'USER_PRESENCE'			=> 'Klātesamība forumā',

	'VIEWING_PROFILE'		=> '%s Lietotāja profils',
	'VISITED'				=> 'Pēdējais apmeklējums',

	'WWW'					=> 'WEB lapa',
));

?>