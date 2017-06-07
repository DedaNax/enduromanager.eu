<?php
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


// Eriks:
// http://wiki.phpbb.com/Permissions


// Adding new category
$lang['permission_cat']['foo'] = 'Lietotāju tiesības';

// Adding the permissions
$lang = array_merge($lang, array(
    'acl_u_raksti_priv'  	=> array('lang' => 'Raksti (priv)', 'cat' => 'foo'),
	'acl_u_raksti_edit'     => array('lang' => 'Raksti (labot)', 'cat' => 'foo'),
    'acl_u_raksti_full'  	=> array('lang' => 'Raksti (labot/dzēst)', 'cat' => 'foo'),
	'acl_u_galerija_priv'   => array('lang' => 'Galerijas (priv)', 'cat' => 'foo'),
    'acl_u_galerija_full'   => array('lang' => 'Galerijas (labot/dzēst)', 'cat' => 'foo'),
	'acl_u_kalendars_priv'  => array('lang' => 'Kalendārs (priv)', 'cat' => 'foo'),
	'acl_u_kalendars_full'  => array('lang' => 'Kalendārs (labot/dzēst)', 'cat' => 'foo'),
));


// Adding new category
$lang['permission_cat']['rm'] = 'Race Manager';

$lang = array_merge($lang, array(
    'acl_u_rm_use'  		=> array('lang' => 'RM lietošana',				'cat' => 'rm'),
    'acl_u_rm_profile' 		=> array('lang' => 'Profila skatīšana',			'cat' => 'rm'),
    'acl_u_rm_team_profile' => array('lang' => 'Komandas profila skatīšana', 'cat' => 'rm'),
    'acl_u_rm_champ_admin' 	=> array('lang' => 'Čempionātu administrēšana', 'cat' => 'rm'),
    'acl_u_rm_race_admin'  	=> array('lang' => 'Sacīkstes administrēšana',	'cat' => 'rm'),
    'acl_u_rm_race_crew' 	=> array('lang' => 'Sacīkstes tiesāšana',		'cat' => 'rm'),
    'acl_u_rm_race_apl'		=> array('lang' => 'Pieteikties sacīkstēm',		'cat' => 'rm'),
    'acl_u_rm_race_data_imp'=> array('lang' => 'Ievadīt sacīkstes datus',	'cat' => 'rm'),
	'acl_u_rm_klasif' 		=> array('lang' => 'Klasifikatoru labošana',	'cat' => 'rm')
));

?>