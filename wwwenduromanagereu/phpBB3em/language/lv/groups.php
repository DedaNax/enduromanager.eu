<?php
/** 
*
* groups [Latviešu]
*
* @package language
* @version $Id: groups.php,v 1.22 2007/10/04 15:07:24 acydburn Exp $
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
	'ALREADY_DEFAULT_GROUP'				=> 'Izvēlētā grupa jau ir Jūsu  noklusējuma grupa.',
	'ALREADY_IN_GROUP'					=> 'Jūs jau esat šīs grupas biedrs.',
	'ALREADY_IN_GROUP_PENDING'			=> 'Jūs jau esat pieteicies dalībai šajā grupā.',
	
	'CHANGED_DEFAULT_GROUP'				=> 'Noklusējuma grupa ir nomainīta.',
	
	'GROUP_AVATAR'						=> 'Grupas avatars', 
	'GROUP_CHANGE_DEFAULT'				=> 'Vai tiešām vēlaties nomainīt noklusējuma grupu uz «%s»?',
	'GROUP_CLOSED'						=> 'Slēgtā grupa',
	'GROUP_DESC'						=> 'Grupas apraksts',
	'GROUP_HIDDEN'						=> 'Slēpta grupa',
	'GROUP_INFORMATION'					=> 'Informācija par grupu', 
	'GROUP_IS_CLOSED'					=> 'Šī ir slēgtā grupa, tajā var iestāties tikai pēc ielūguma saņemšanas no grupas līdera.',
	'GROUP_IS_FREE'						=> 'Šajā grupā var iestāties jebkurš foruma lietotājs.', 
	'GROUP_IS_HIDDEN'					=> 'Šī ir slēgtā grupa, tikai šīs grupas dalībnieki var apskatīt grupā ietilpstošo biedru sarakstu.',
	'GROUP_IS_OPEN'						=> 'Šī grupa ir atvērta, jebkurš lietotājs var tajā iestāties.',
	'GROUP_IS_SPECIAL'					=> 'Šī grupa ir speciāla, to vada foruma administrators.', 
	'GROUP_JOIN'						=> 'Iestāties grupā',
	'GROUP_JOIN_CONFIRM'				=> 'Jūs tiešām vēlaties iestāties šajā grupā?',
	'GROUP_JOIN_PENDING'				=> 'Pieprasījums iestāties grupā',
	'GROUP_JOIN_PENDING_CONFIRM'		=> 'Vai Jūs vēlaties izdarīt pieprasījumu iestāties šajā grupā?',
	'GROUP_JOINED'						=> 'Jūs tikāt iekļauts izvēlētajā grupā.',
	'GROUP_JOINED_PENDING'				=> 'Pieprasījums iestāties grupā ir veiksmīgi nosūtīts. Lūdzu, gaidiet apstiprinājumu no grupas līdera.',
	'GROUP_LIST'						=> 'Vadīt lietotājus',
	'GROUP_MEMBERS'						=> 'Grupas dalībnieki',
	'GROUP_NAME'						=> 'Grupas nosaukums',
	'GROUP_OPEN'						=> 'Atvērta grupa',
	'GROUP_RANK'						=> 'Grupas rangs', 
	'GROUP_RESIGN_MEMBERSHIP'			=> 'Izstāties no grupas',
	'GROUP_RESIGN_MEMBERSHIP_CONFIRM'	=> 'Vai tiešām vēlaties izstāties no šīs grupas?',
	'GROUP_RESIGN_PENDING'				=> 'Atsaukt pieprasījumu iestāties grupā',
	'GROUP_RESIGN_PENDING_CONFIRM'		=> 'Vai tiešām vēlaties atsaukt pieprasījumu iestāties grupā?',
	'GROUP_RESIGNED_MEMBERSHIP'			=> 'Jūs tikāt dzēsts no izvēlētās grupas.',
	'GROUP_RESIGNED_PENDING'			=> 'Jūsu pieprasījums iestāties izvēlētajā grupā ir veiksmīgi atsaukts.',
	'GROUP_TYPE'						=> 'Grupas veids',
	'GROUP_UNDISCLOSED'					=> 'Slēpta grupa',
	'FORUM_UNDISCLOSED'					=> 'Slēpto  forumu moderēšana',

	'LOGIN_EXPLAIN_GROUP'				=> 'Jums ir jāielogojas , lai apskatītu informāciju par grupu.',

	'NO_LEADERS'						=> 'Nevienā no grupām Jūs neesat līderis.',
	'NOT_LEADER_OF_GROUP'				=> 'Pieprasīto darbību var izdarīt tikai šīs grupas līderis.',
	'NOT_MEMBER_OF_GROUP'				=> 'Pieprasīto darbību var izdarīt tikai šīs grupas dalībnieki.',
	'NOT_RESIGN_FROM_DEFAULT_GROUP'		=> 'Jūs nevarat atteikties no dalības noklusējuma grupā.',

	'PRIMARY_GROUP'						=> 'Pamatgrupa',

	'REMOVE_SELECTED'					=> 'Dzēst izvēlēto',

	'USER_GROUP_CHANGE'					=> 'No grupas «%1$s» uz grupu «%2$s»',
	'USER_GROUP_DEMOTE'					=> 'Atteikties no līdera statusa',
	'USER_GROUP_DEMOTE_CONFIRM'			=> 'Vai tiešām vēlaties atteikties no līdera statusa šajā grupā?',
	'USER_GROUP_DEMOTED'				=> 'Jūs vairāk neesat grupas līderis.',
));

?>