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

/**
 * init module
*/
function akismet_init() 
{
	// create module settings
    ModUtil::setVar('akismet', 'enable', false);
    ModUtil::setVar('akismet', 'apikey', '');
    ModUtil::setVar('akismet', 'apikeyvalid', false);
    ModUtil::setVar('akismet', 'count', 0);

    // Initialisation successful
    return true;
}

/**
 * upgrade module
*/
function akismet_upgrade($oldversion)
{
    return true;
}

/**
 * delete module
*/
function akismet_delete() 
{
	// delete all module vars
    ModUtil::delVar('akismet');

    // Deletion successful
    return true;
}
