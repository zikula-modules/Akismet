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
 * verify an akismet key
 *
 * @author Mark West
 * @access private
 * @param $args['apikey'] The key to verify
 * @return bool true if API key is valid, false otherwise
 */
function akismet_userapi_verifykey($args)
{
    $dom = ZLanguage::getModuleDomain('akismet');
    // argument check
    if (!isset($args['apikey'])) {
        return LogUtil::registerArgsError();
    }

    // load the akismet class
    _akismet_userapi_loadclass();

    // create the new object
    $akismet = new Akismet(pnGetBaseURL(), $args['apikey'], false);

    // verify the key
    return $akismet->isKeyValid();
}

/**
 * pass the comment to the akismet service to check if the comment is spam
 *
 * @author Mark West
 * @param $args['author'] string author (optional)
 * @param $args['authoremail'] string author E-mail address (optional)
 * @param $args['authorurl'] string author URL (optional)
 * @param $args['content'] string comment content (required)
 * @param $args['permalink'] string permalink (optional)
 * @return bool true if the comment is spam, false otherwise
 */
function akismet_userapi_isspam($args)
{
    $dom = ZLanguage::getModuleDomain('akismet');
    // argument check
    if (!isset($args['content'])) {
        return LogUtil::registerArgsError();
    }

    // load the akismet class
    _akismet_userapi_loadclass();

    // create the new object
    $akismet = new Akismet(pnGetBaseURL(), pnModGetVar('akismet', 'apikey'));

    // set the comment parameters
    $akismet->setCommentAuthor(isset($args['author']) ? $args['author'] : '');
    $akismet->setCommentAuthorEmail(isset($args['authoremail']) ? $args['authoremail'] : '');
    $akismet->setCommentAuthorURL(isset($args['authorurl']) ? $args['authorurl'] : '');
    $akismet->setCommentContent($args['content']);
    $akismet->setPermalink(isset($args['permalink']) ? $args['permalink'] : '');

    // is it spam?
    if ($akismet->isCommentSpam()) {
        pnModSetVar('akismet', 'count', pnModGetVar('akismet', 'count') + 1);
        return true;
    } else {
        return false;
    }
}

/**
 * notify akismet of a comment that is spam
 *
 * @author Mark West
 * @param $args['author'] string author (optional)
 * @param $args['authoremail'] string author E-mail address (optional)
 * @param $args['authorurl'] string author URL (optional)
 * @param $args['content'] string comment content (required)
 * @param $args['permalink'] string permalink (optional)
 * @return bool result of spam submision process
 */
function akismet_userapi_submitspam($args)
{
    $dom = ZLanguage::getModuleDomain('akismet');
    // argument check
    if (!isset($args['content'])) {
        return LogUtil::registerArgsError();
    }

    // load the akismet class
    _akismet_userapi_loadclass();

    // create the new object
    $akismet = new Akismet(pnGetBaseURL(), pnModGetVar('akismet', 'apikey'));

    // set the comment parameters
    $akismet->setCommentAuthor(isset($args['author']) ? $args['author'] : '');
    $akismet->setCommentAuthorEmail(isset($args['authoremail']) ? $args['authoremail'] : '');
    $akismet->setCommentAuthorURL(isset($args['authorurl']) ? $args['authorurl'] : '');
    $akismet->setCommentContent($args['content']);
    $akismet->setPermalink(isset($args['permalink']) ? $args['permalink'] : '');

    // is it spam?
    return $akismet->submitSpam();
}

/**
 * notify akismet of a comment that isn't spam (ham!)
 *
 * @author Mark West
 * @param $args['author'] string author (optional)
 * @param $args['authoremail'] string author E-mail address (optional)
 * @param $args['authorurl'] string author URL (optional)
 * @param $args['content'] string comment content (required)
 * @param $args['permalink'] string permalink (optional)
 * @return bool result of ham submision process
 */
function akismet_userapi_submitham($args)
{
    $dom = ZLanguage::getModuleDomain('akismet');
    // argument check
    if (!isset($args['content'])) {
        return LogUtil::registerArgsError();
    }

    // load the akismet class
    _akismet_userapi_loadclass();

    // create the new object
    $akismet = new Akismet(pnGetBaseURL(), pnModGetVar('akismet', 'apikey'));

    // set the comment parameters
    $akismet->setCommentAuthor(isset($args['author']) ? $args['author'] : '');
    $akismet->setCommentAuthorEmail(isset($args['authoremail']) ? $args['authoremail'] : '');
    $akismet->setCommentAuthorURL(isset($args['authorurl']) ? $args['authorurl'] : '');
    $akismet->setCommentContent($args['content']);
    $akismet->setPermalink(isset($args['permalink']) ? $args['permalink'] : '');

    // is it spam?
    return $akismet->submitHam();
}

/**
 * load the class for our php version
 *
 * @access private
 * @author Mark West
 * @return void
 */
function _akismet_userapi_loadclass()
{
    if (version_compare(phpversion(), '5.0', '>=')) {
        require_once 'modules/akismet/pnincludes/Akismet.class.5.php';
    } else {
        require_once 'modules/akismet/pnincludes/Akismet.class.4.php';
    }
}
