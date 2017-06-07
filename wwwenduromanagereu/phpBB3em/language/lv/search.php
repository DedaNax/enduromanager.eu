<?php
/** 
*
* search [Latviešu]
*
* @package language
* @version $Id: search.php,v 1.26 2007/10/04 15:07:24 acydburn Exp $
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
	'ALL_AVAILABLE'			=> 'Viss pieejamais',
	'ALL_RESULTS'			=> 'Visas dienas',

	'DISPLAY_RESULTS'		=> 'Rezultātus attēlot kā',

	'FOUND_SEARCH_MATCH'		=> 'Meklēšanas rezultāti: %d',
	'FOUND_SEARCH_MATCHES'		=> 'Meklēšanas rezultāti: %d',
	'FOUND_MORE_SEARCH_MATCHES'	=> 'Meklēšanas rezultātu vairāk par %d',

	'GLOBAL'				=> 'Svarīga',

	'IGNORED_TERMS'			=> 'ignorētas',
	'IGNORED_TERMS_EXPLAIN'	=> 'Šie vārdi tika ignorēti, tāpēc ka tie ir bieži lietojami: <strong>%s</strong>.',

	'JUMP_TO_POST'			=> 'Apskatīt ziņojumu',

	'LOGIN_EXPLAIN_EGOSEARCH'	=> 'Jums ir jāpieslēdzas forumam, lai varētu apskatīt savus ziņojumus.',

	'NO_KEYWORDS'			=> 'Lai sāktu meklēšanu Jums ir jāievada vismaz viens vārds. Katra vārda garumam ir jābūt no %d līdz %d simboliem.',
	'NO_RECENT_SEARCHES'	=> 'Pēdējā laikā jaunu meklēšanas pieprasījumu nav bijis.',
	'NO_SEARCH'				=> 'Jums nav atļauts izmantot meklēšanu.',
	'NO_SEARCH_RESULTS'		=> 'Tēmas un ziņojumi netika atrasti.',
	'NO_SEARCH_TIME'		=> 'Jūs nevarat veikt meklēšanu uzreiz pēc iepriekšējās meklēšanas. Pamēģiniet to veikt mazliet vēlāk.',
	'WORD_IN_NO_POST'		=> 'Netika atrasts neviens ziņojums, kurš saturētu vārdu <strong>%s</strong>.',
	'WORDS_IN_NO_POST'		=> 'Netika atrasts neviens ziņojums, kurš saturētu vārdu <strong>%s</strong>.',

	'POST_CHARACTERS'		=> 'simbolu ziņojumā',

	'RECENT_SEARCHES'		=> 'Pēdējie meklēšanas rezultāti',
	'RESULT_DAYS'			=> 'Meklēt ziņojumus par',
	'RESULT_SORT'			=> 'Šķirošanas laukums',
	'RETURN_FIRST'			=> 'Rādīt pirmos',
	'RETURN_TO_SEARCH_ADV'	=> 'Atgriezties pie izvērstās meklēšanas',
	
	'SEARCHED_FOR'				=> 'Meklēts',
	'SEARCHED_TOPIC'			=> 'Meklēšana tēmā',
	'SEARCH_ALL_TERMS'			=> 'Meklēt visus vārdus',
	'SEARCH_ANY_TERMS'			=> 'Meklēt jebkuru vārdu',
	'SEARCH_AUTHOR'				=> 'Meklēt atkarībā no autora',
	'SEARCH_AUTHOR_EXPLAIN'		=> 'Izmantojiet * šablona vietā.',
	'SEARCH_FIRST_POST'			=> 'Tikai tēmas pirmajā ziņojumā',
	'SEARCH_FORUMS'				=> 'Meklēt forumā',
	'SEARCH_FORUMS_EXPLAIN'		=> 'Izvēlaties forumu, kurā notiks meklēšana.',
	'SEARCH_IN_RESULTS'			=> 'Meklēt atrastajā',
	'SEARCH_KEYWORDS_EXPLAIN'	=> 'Jūs varat izmantot <strong>+</strong>, lai noteiktu vārdus kuriem ir jābūt rezultātos, un   <strong>-</strong>  vārdiem ,kuriem nevajadzētu būt rezultātos.',
	'SEARCH_MSG_ONLY'			=> 'Tikai ziņojumu tekstos',
	'SEARCH_OPTIONS'			=> 'Meklēšanas parametri',
	'SEARCH_QUERY'				=> 'Pieprasījums',
	'SEARCH_SUBFORUMS'			=> 'Meklēt apakšforumos',
	'SEARCH_TITLE_MSG'			=> 'Tēmu nosaukumos un ziņojumu tekstos',
	'SEARCH_TITLE_ONLY'			=> 'Tikai pēc tēmas nosaukuma',
	'SEARCH_WITHIN'				=> 'Meklēt',
	'SORT_ASCENDING'			=> 'pieaugošā',
	'SORT_AUTHOR'				=> 'Autors',
	'SORT_DESCENDING'			=> 'samazinoties',
	'SORT_FORUM'				=> 'forums',
	'SORT_POST_SUBJECT'			=> 'Ziņojuma virsraksts',
	'SORT_TIME'					=> 'Ievietošanas laiks',

	'TOO_FEW_AUTHOR_CHARS'	=> 'Jums ir jāievada ne mazāk par %d autora vārda simboliem.',
));

?>