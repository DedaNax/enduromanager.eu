<?php
/** 
*
* posting [Latviešu]
*
* @package language
* @version $Id: posting.php,v 1.74 2007/10/04 15:07:24 acydburn Exp $
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
	'ADD_ATTACHMENT'			=> 'Pievienot pielikumu',
	'ADD_ATTACHMENT_EXPLAIN'	=> 'Ja negribat pievienot pielikumu, tad atstājat lauku tukšu.',
	'ADD_FILE'					=> 'Pievienot failu',
	'ADD_POLL'					=> 'Pievienot aptauju',
	'ADD_POLL_EXPLAIN'			=> 'Ja negribat pievienot aptauju, tad atstājat lauku tukšu.',
	'ALREADY_DELETED'			=> 'Šis ziņojums jau ir dzēsts.',
	'ATTACH_QUOTA_REACHED'		=> 'Ir sasniegts maksimālais izmērs Jūsu pielikumiem.',
	'ATTACH_SIG'				=> 'Pievienot parakstu (parakstu var rediģēt foruma personīgajā sadaļā)',

	'BBCODE_A_HELP'				=> 'Pievienot tekstam  pielikumu: [attachment=]filename.ext[/attachment]',
	'BBCODE_B_HELP'				=> 'Bold: [b]text[/b]',
	'BBCODE_C_HELP'				=> 'Кods: [code]code[/code]',
	'BBCODE_E_HELP'				=> 'Saraksts: добавить элемент списка',
	'BBCODE_F_HELP'				=> 'Šrifta izmērs: [size=85]small text[/size]',
	'BBCODE_IS_OFF'				=> '%sBBCode%s <em>IZSLĒGTS</em>',
	'BBCODE_IS_ON'				=> '%sBBCode%s <em>IESLĒGTS</em>',
	'BBCODE_I_HELP'				=> 'Slīps teksts: [i]text[/i]',
	'BBCODE_L_HELP'				=> 'Saraкsts: [list]text[/list]',
	'BBCODE_LISTITEM_HELP'		=> 'Saraksta daļa: [*]text[/*]',
	'BBCODE_O_HELP'				=> 'Numurēts saraksts: [list=]text[/list]',
	'BBCODE_P_HELP'				=> 'Ielikta attēlu: [img]http://image_url[/img]',
	'BBCODE_Q_HELP'				=> 'Citēts: [quote]text[/quote]',
	'BBCODE_S_HELP'				=> 'Šrifta krāsa: [color=red]text[/color] Padoms: Jūs varat izmantot arī konstrukciju color=#FF0000',
	'BBCODE_U_HELP'				=> 'Pasvītrots teksts: [u]text[/u]',
	'BBCODE_W_HELP'				=> 'Ielikt saiti: [url]http://url[/url] vai [url=http://url]URL text[/url]',
	'BBCODE_D_HELP'				=> 'Flash: [flash=width,height]http://url[/flash]',
	'BUMP_ERROR'				=> 'Jūs nevarat pacelt tēmu uzreiz pēc Jūsu pēdējā ziņojuma. Pamēģiniet mazliet vēlāk.',

	'CANNOT_DELETE_REPLIED'		=> 'Atvainojiet, bet jūs varat dzēst tikai ziņojumus, uz kuriem nav atbilžu.',
	'CANNOT_EDIT_POST_LOCKED'	=> 'Šis ziņojums tika nobloķēts, jūs nevarat to labot.',
	'CANNOT_EDIT_TIME'			=> 'Jūs vairs nevarat labot vai dzēst šo ziņojumu.',
	'CANNOT_POST_ANNOUNCE'		=> 'Jūs nevarat veidot paziņojumus.',
	'CANNOT_POST_STICKY'		=> 'Jūs nevarat veidot pielipinātas tēmas.',
	'CHANGE_TOPIC_TO'			=> 'Mainīt tēmu uz',
	'CLOSE_TAGS'				=> 'Slēgt Tags',
	'CURRENT_TOPIC'				=> 'Tekošā tēma',

	'DELETE_FILE'				=> 'Dzēst failu',
	'DELETE_MESSAGE'			=> 'Dzēst ziņojumu',
	'DELETE_MESSAGE_CONFIRM'	=> 'Jūs tiešām vēlaties dzēst šo ziņojumu?',
	'DELETE_OWN_POSTS'			=> 'Atvainojiet, bet dzēst jūs varat tikai savus ziņojumus.',
	'DELETE_POST_CONFIRM'		=> 'Vai tiešām vēlaties dzēst šo ziņojumu?',
	'DELETE_POST_WARN'			=> 'Dzēsto ziņojumu atjaunot nav iespējams',
	'DISABLE_BBCODE'			=> 'Šajā ziņojumā atslēgt BBCode',
	'DISABLE_MAGIC_URL'			=> 'Nepārveidot URL adreses par saitēm',
	'DISABLE_SMILIES'			=> 'Šajā ziņojumā atslēgt smailus',
	'DISALLOWED_EXTENSION'		=> 'Paplašinājumu %s ir aizliegusi administrācija.',
	'DRAFT_LOADED'				=> 'Melnraksts ir ielādēts, tagad jūs varat pabeigt labot ziņojumu.<br />Pēc tam kad ziņojums tiks nosūtīts melnraksts tiks dzēsts.',
	'DRAFT_LOADED_PM'			=> 'Melnraksts ir ielādēts, tagad jūs varat pabeigt labot privāto vēstuli.<br />Pēc tam kad privātā vēstule tiks nosūtīta melnraksts tiks dzēsts.',
	'DRAFT_SAVED'				=> 'Melnraksts tika saglabāts.',
	'DRAFT_TITLE'				=> 'Melnraksta virsraksts',

	'EDIT_REASON'				=> 'Ziņojuma labošanas iemesls',
	'EMPTY_FILEUPLOAD'			=> 'Augšupielādētais fails ir tukšs.',
	'EMPTY_MESSAGE'				=> 'Ievadiet ziņojuma tekstu',
	'EMPTY_REMOTE_DATA'			=> 'Neizdevās ielādēt failu.',

	'FLASH_IS_OFF'				=> '[flash] <em>IZSLĒGTS</em>',
	'FLASH_IS_ON'				=> '[flash] <em>IESLĒGTS</em>',
	'FLOOD_ERROR'				=> 'Jūs nevarat uzreiz nosūtīt jaunu ziņojumu. Pamēģiniet to izdarīt mazliet vēlāk.',
	'FONT_COLOR'				=> 'Šrifta krāsa',
	'FONT_COLOR_HIDE'			=> 'Slēpt krāsu paneli',
	'FONT_HUGE'					=> 'Milzīgs',
	'FONT_LARGE'				=> 'Liels',
	'FONT_NORMAL'				=> 'Normāls',
	'FONT_SIZE'					=> 'Šrifta izmērs',
	'FONT_SMALL'				=> 'Mazs',
	'FONT_TINY'					=> 'Ļoti mazs',

	'GENERAL_UPLOAD_ERROR'		=> 'Neizdevās augšupielādēt pielikumu %s.',

	'IMAGES_ARE_OFF'			=> '[img] <em>IZSLĒGTS</em>',
	'IMAGES_ARE_ON'				=> '[img] <em>IESLĒGTS</em>',
	'INVALID_FILENAME'			=> '%s ir nepieļaujams faila nosaukums.',

	'LOAD'						=> 'Ielādēt',
	'LOAD_DRAFT'				=> 'Ielādēt melnrakstu',
	'LOAD_DRAFT_EXPLAIN'		=> 'Jūs varat izvēlēties melnrakstu, lai turpinātu rediģēt ziņojumu. Jūsu tekošais ziņojums tiks dzēsts un tā saturs tiks pazaudēts. <br />Apskatīt, labot un dzēst melnrakstus varat foruma personīgajā sadaļā.',
	'LOGIN_EXPLAIN_BUMP'		=> 'Jums ir jāautorizējas , lai paceltu tēmu šajā forumā.',
	'LOGIN_EXPLAIN_DELETE'		=> 'Jums ir jāautorizējas, lai varētu dzēst ziņojumus šajā forumā.',
	'LOGIN_EXPLAIN_POST'		=> 'Jums ir jāautorizējas, lai varētu rakstīt ziņojumus šajā forumā.',
	'LOGIN_EXPLAIN_QUOTE'		=> 'Jums ir jāautorizējas, lai varētu citēt ziņojumus šajā forumā.',
	'LOGIN_EXPLAIN_REPLY'		=> 'Jums ir jāautorizējas, lai varētu atbildēt uz ziņojumiem tēmās.',

	'MAX_FONT_SIZE_EXCEEDED'	=> 'Jūs varat izmantot šriftus ar izmēru ne lielāku par %1$d.',
	'MAX_FLASH_HEIGHT_EXCEEDED'	=> 'Jūsu flush failiem jābūt ne lielākiem par %1$d pikseļiem augstumā.',
	'MAX_FLASH_WIDTH_EXCEEDED'	=> 'Jūsu flush failiem jābūt ne lielākiem par %1$d pikseļiem platumā.',
	'MAX_IMG_HEIGHT_EXCEEDED'	=> 'Jūsu attēliem ir jābūt ne lielākiem par %1$d pikseļiem augstumā.',
	'MAX_IMG_WIDTH_EXCEEDED'	=> 'Jūsu attēliem ir jābūt ne lielākiem par %1$d pikseļiem platumā.',

	'MESSAGE_BODY_EXPLAIN'		=> 'Ievadiet ziņojuma tekstu. Ziņojumā maksimāli atļautais simbolu skaits: <strong>%d</strong>.',
	'MESSAGE_DELETED'			=> 'Ziņojums tika dzēsts.',
	'MORE_SMILIES'				=> 'Vairāk smailu…',

	'NOTIFY_REPLY'				=> 'Ziņot man par saņemto atbildi',
	'NOT_UPLOADED'				=> 'Neizdevās augšupielādēt failu.',
	'NO_DELETE_POLL_OPTIONS'	=> 'Jūs nevarat dzēst esošos atbilžu variantus.',
	'NO_PM_ICON'				=> 'Nav ikonas PZ',
	'NO_POLL_TITLE'				=> 'Ievadiet aptaujas nosaukumu.',
	'NO_POST'					=> 'Ziņojums neeksistē.',
	'NO_POST_MODE'				=> 'Norādiet ziņojuma veidu.',

	'PARTIAL_UPLOAD'			=> 'Fails ir augšupielādēts tikai daļēji.',
	'PHP_SIZE_NA'				=> 'Par lielu pielikuma izmērs.<br />Nav iespējams noteikt augšupielādējamo failu maksimālo izmēru, kas ir iestatīts failā php.ini.',
	'PHP_SIZE_OVERRUN'			=> 'Par lielu pielikuma izmērs.<br />Augšupielādējamā faila maksimālais izmērs: %d МB.',
	'PLACE_INLINE'				=> 'Ievietot ziņojuma tekstā',
	'POLL_DELETE'				=> 'Dzēst aptauju',
	'POLL_FOR'					=> 'Aptauja turpināsies',
	'POLL_FOR_EXPLAIN'			=> 'Ievadiet 0 vai atstājat laukumu tukšu, lai aptauja nebeigtos.',
	'POLL_MAX_OPTIONS'			=> 'Atbilžu varianti',
	'POLL_MAX_OPTIONS_EXPLAIN'	=> 'Atbilžu variantu skaits, kas ir atļauti pie balsošanas.',
	'POLL_OPTIONS'				=> 'Atbildes varianti',
	'POLL_OPTIONS_EXPLAIN'		=> 'Katru atbildes variantu ierakstiet jaunā rindā. Maksimālais variantu skaits: <strong>%d</strong>.',
	'POLL_OPTIONS_EDIT_EXPLAIN'	=> 'Katru atbildes variantu ierakstiet jaunā rindā. Maksimālais variantu skaits: <strong>%d</strong>. Ja jūs pievienosiet jaunu atbildes variantu vai dzēsīsiet esošo, tad balsojuma rezultāti tiks skaitīti no jauna.',
	'POLL_QUESTION'				=> 'Jautājums',
	'POLL_TITLE_TOO_LONG'		=> 'Jautājumam ir jābūt ne garākam par 100 simboliem.',
	'POLL_TITLE_COMP_TOO_LONG'	=> 'Aptaujas nosaukums ir par garu, pamēģiniet samazināt BBCode un smailu skaitu.',
	'POLL_VOTE_CHANGE'			=> 'Atļaut labot atbildes variantu',
	'POLL_VOTE_CHANGE_EXPLAIN'	=> 'Ja atļauts, tad foruma lietotāji var mainīt savus aptaujas atbilžu variantus.',
	'POSTED_ATTACHMENTS'		=> 'Publicēt pielikumus',
	'POST_APPROVAL_NOTIFY'		=> 'Jums tiks paziņots par to, ka jūsu ziņojums ir apstiprināts.',
	'POST_CONFIRMATION'			=> 'Sūtīšanas apstiprinājums',
	'POST_CONFIRM_EXPLAIN'		=> 'Lai nepieļautu automātisku ziņojumu rakstīšanu šajā forumā ir jāievada apstiprinājuma kods. Kods ir attēlots attēlā. Ja sliktās redzes dēļ nevarat saskatīt kodu, tad sazinieties ar foruma %sadministratoru%s',
	'POST_DELETED'				=> 'Ziņojums tika dzēsts.',
	'POST_EDITED'				=> 'Ziņojums tika izlabots.',
	'POST_EDITED_MOD'			=> 'Ziņojums tika izlabots, bet to ir vēl jāapstiprina moderatoram.',
	'POST_GLOBAL'				=> 'Svarīga',
	'POST_ICON'					=> 'Ikona',
	'POST_NORMAL'				=> 'Parasta',
	'POST_REVIEW'				=> 'Priekšskatījums',
	'POST_REVIEW_EXPLAIN'		=> 'Šajā tēmā tika pievienots vismaz viens ziņojums. Iespējams, ka gribēsiet labot sava ziņojuma saturu.',
	'POST_STORED'				=> 'Ziņojums tika veiksmīgi nosūtīts.',
	'POST_STORED_MOD'			=> 'Ziņojums tika nosūtīts, bet to vēl ir jāapstiprina moderatoram.',
	'POST_TOPIC_AS'				=> 'Veidojamās tēmas statuss',
	'PROGRESS_BAR'				=> 'Progresa indikators',

	'QUOTE_DEPTH_EXCEEDED'		=> 'Maksimāli pieļaujamais ielikto citātu skaits viena otrā: %1$d.',

	'SAVE'						=> 'Saglabāt',
	'SAVE_DATE'					=> 'Pēdējo reizi saglabāts',
	'SAVE_DRAFT'				=> 'Saglabāt melnrakstu',
	'SAVE_DRAFT_CONFIRM'		=> 'Lūdzu, ņemat vērā, ka tiks saglabāts tikai ziņojuma virsraksts un teksts, bet citi elementi tiks dzēsti.<br /> Vai vēlaties tagad saglabāt melnrakstu?',
	'SMILIES'					=> 'Smaili',
	'SMILIES_ARE_OFF'			=> 'Smaili <em>IZSLĒGTI</em>',
	'SMILIES_ARE_ON'			=> 'Smaili <em>IESLĒGTI</em>',
	'STICKY_ANNOUNCE_TIME_LIMIT'=> 'Pielipinātās/paziņojuma tēmas statusa termiņš',
	'STICK_TOPIC_FOR'			=> 'Tēma tiks pielipināta',
	'STICK_TOPIC_FOR_EXPLAIN'	=> 'Ievadiet 0 vai atstājiet laukumu tukšu, lai tēmas statuss vienmēr būtu paziņojums vai pielipināta.',
	'STYLES_TIP'				=> 'Padoms: Iezīmētam tekstam var ātri piemērot stilus.',

	'TOO_FEW_CHARS'				=> 'Jūsu ziņojums ir parāk īss.',
	'TOO_FEW_POLL_OPTIONS'		=> 'Ievadiet vismaz divus aptaujas atbilžu variantus.',
	'TOO_MANY_ATTACHMENTS'		=> 'Nav iespējams pielikt pielikumu, jo ir sasniegts to maksimālais skaits ziņojumā: <b>%d</b>.',
	'TOO_MANY_CHARS'			=> 'Jūsu ziņojums ir pārāk garš.',
	'TOO_MANY_CHARS_POST'		=> 'Jūsu ziņojums satur pārāk daudz simbolu: %1$d. To maksimāli atļautais daudzums: %2$d.',
	'TOO_MANY_CHARS_SIG'		=> 'Jūsu paraksts satur pārāk daudz simbolu: %1$d. To maksimāli atļautais daudzums: %2$d.',
	'TOO_MANY_POLL_OPTIONS'		=> 'Jūs izvēlējaties pārāk daudz aptaujas atbilžu variantu.',
	'TOO_MANY_SMILIES'			=> 'Jūsu ziņojumā ir pārāk daudz smailu.To maksimāli atļautais daudzums: %d.',
	'TOO_MANY_URLS'				=> 'Jūsu ziņojumā ir pārāk daudz URL saišu. To maksimāli atļautais daudzums: %d.',
	'TOO_MANY_USER_OPTIONS'		=> 'Par daudz atbilžu variantu.',
	'TOPIC_BUMPED'				=> 'Tēma ir pacelta.',

	'UNAUTHORISED_BBCODE'		=> 'Jums nav tiesību izmantot dažus BBCode: %s.',
	'UNGLOBALISE_EXPLAIN'		=> 'Lai izmainītu tēmas statusu no svarīgas uz parastu, jums ir jāizvēlās forums, kurā tā tiks publicēta.',
	'UPDATE_COMMENT'			=> 'Atjaunot komentāru',
	'URL_INVALID'				=> 'Norādītā faila adrese nav pieejama.',
	'URL_NOT_FOUND'				=> 'Norādītais fails nav atrodams.',
	'URL_IS_OFF'				=> '[url] <em>IZSLĒGTS</em>',
	'URL_IS_ON'					=> '[url] <em>IESLĒGTS</em>',
	'USER_CANNOT_BUMP'			=> 'Šajā forumā jūs nevarat pacelt tēmas.',
	'USER_CANNOT_DELETE'		=> 'Šajā forumā jūs nevarat dzēst ziņojumus.',
	'USER_CANNOT_EDIT'			=> 'Šajā forumā jūs nevarat labot ziņojumus.',
	'USER_CANNOT_REPLY'			=> 'Šajā forumā jūs nevarat atbildēt uz ziņojumiem.',
	'USER_CANNOT_FORUM_POST'	=> ' Šajā forumā jūs nevarat rakstīt ziņojumus, jo foruma tips to nepieļauj.',

	'VIEW_MESSAGE'				=> '%sApskatīt savu ziņojumu%s',
	'VIEW_PRIVATE_MESSAGE'		=> '%sApskatīt manis sūtītās privātās vēstules%s',

	'WRONG_FILESIZE'			=> 'Pārāk liels pielikuma izmērs. <br/>Tā maksimāli pieļaujamais izmērs: %1d %2s.',
	'WRONG_SIZE'				=> 'Attēla izmēriem ir jābūt ne mazākiem par %1$d×%2$d un ne lielākiem par %3$d×%4$d. Sūtītā attēla izmērs - %5$d×%6$d. Visi izmēri norādīti pikseļos.',
));

?>