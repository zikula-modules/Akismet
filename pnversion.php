<?php
/**
 * Akismet integrator API for Zikula
 *
 * @author Mark West
 * @link http://www.markwest.me.uk
 * @version $Id$
 * @license GNU/GPL - http://www.gnu.org/copyleft/gpl.html
 * @package Zikula_3rdParty_Modules
 * @subpackage akismet
*/

$dom = ZLanguage::getModuleDomain('akismet');

$modversion['name']             = 'akismet';
$modversion['displayname']      = __('Akismet', $dom);
//! module url in lowercase and different from displayname
$modversion['url']      = __('akismet', $dom);
$modversion['version']          = '1.2';
$modversion['description']      = __('Akismet spam detection service', $dom);
$modversion['credits']          = 'pndocs/credits.txt';
$modversion['help']             = 'pndocs/readme.txt';
$modversion['changelog']        = '';
$modversion['license']          = 'pndocs/license.txt';
$modversion['official']         = 0;
$modversion['author']           = 'Mark West';
$modversion['contact']          = 'http://www.markwest.me.uk';
$modversion['admin']            = 1;
$modversion['user']             = 1;
$modversion['securityschema']   = array('akismet::' => '::');
