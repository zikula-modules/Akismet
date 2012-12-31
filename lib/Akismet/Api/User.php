<?php

/**
 * Akismet integrator API for Zikula
 *
 * @license GNU/GPL - http://www.gnu.org/copyleft/gpl.html
 */
require_once 'modules/Akismet/lib/vendor/Akismet.class.php';

class Akismet_Api_User extends Zikula_AbstractApi
{

    /**
     * verify an akismet key
     *
     * @param $args['apikey'] The key to verify
     * @return bool true if API key is valid, false otherwise
     */
    public function verifykey($args)
    {
        // argument check
        if (!isset($args['apikey'])) {
            return LogUtil::registerArgsError();
        }

        // create the new object
        $akismet = new Akismet(System::getBaseUrl(), $args['apikey'], false);

        // verify the key
        return $akismet->isKeyValid();
    }

    /**
     * pass the comment to the akismet service to check if the comment is spam
     *
     * @param $args['author'] string author (optional)
     * @param $args['authoremail'] string author E-mail address (optional)
     * @param $args['authorurl'] string author URL (optional)
     * @param $args['content'] string comment content (required)
     * @param $args['permalink'] string permalink (optional)
     * @return bool true if the comment is spam, false otherwise
     */
    public function isspam($args)
    {
        // argument check
        if (!isset($args['content'])) {
            return LogUtil::registerArgsError();
        }

        // create the new object
        $akismet = new Akismet(System::getBaseUrl(), $this->getVar('apikey'));

        // set the comment parameters
        $akismet->setCommentAuthor(isset($args['author']) ? $args['author'] : '');
        $akismet->setCommentAuthorEmail(isset($args['authoremail']) ? $args['authoremail'] : '');
        $akismet->setCommentAuthorURL(isset($args['authorurl']) ? $args['authorurl'] : '');
        $akismet->setCommentContent($args['content']);
        $akismet->setPermalink(isset($args['permalink']) ? $args['permalink'] : '');

        // is it spam?
        if ($akismet->isCommentSpam()) {
            $this->setVar('count', $this->getVar('count') + 1);
            return true;
        } else {
            return false;
        }
    }

    /**
     * notify akismet of a comment that is spam
     *
     * @param $args['author'] string author (optional)
     * @param $args['authoremail'] string author E-mail address (optional)
     * @param $args['authorurl'] string author URL (optional)
     * @param $args['content'] string comment content (required)
     * @param $args['permalink'] string permalink (optional)
     * @return bool result of spam submision process
     */
    public function submitspam($args)
    {
        // argument check
        if (!isset($args['content'])) {
            return LogUtil::registerArgsError();
        }

        // create the new object
        $akismet = new Akismet(System::getBaseUrl(), $this->getVar('apikey'));

        // set the comment parameters
        $akismet->setCommentAuthor(isset($args['author']) ? $args['author'] : '');
        $akismet->setCommentAuthorEmail(isset($args['authoremail']) ? $args['authoremail'] : '');
        $akismet->setCommentAuthorURL(isset($args['authorurl']) ? $args['authorurl'] : '');
        $akismet->setCommentContent($args['content']);
        $akismet->setPermalink(isset($args['permalink']) ? $args['permalink'] : '');

        return $akismet->submitSpam();
    }

    /**
     * notify akismet of a comment that isn't spam (ham!)
     *
     * @param $args['author'] string author (optional)
     * @param $args['authoremail'] string author E-mail address (optional)
     * @param $args['authorurl'] string author URL (optional)
     * @param $args['content'] string comment content (required)
     * @param $args['permalink'] string permalink (optional)
     * @return bool result of ham submision process
     */
    public function submitham($args)
    {
        // argument check
        if (!isset($args['content'])) {
            return LogUtil::registerArgsError();
        }

        // create the new object
        $akismet = new Akismet(System::getBaseUrl(), $this->getVar('apikey'));

        // set the comment parameters
        $akismet->setCommentAuthor(isset($args['author']) ? $args['author'] : '');
        $akismet->setCommentAuthorEmail(isset($args['authoremail']) ? $args['authoremail'] : '');
        $akismet->setCommentAuthorURL(isset($args['authorurl']) ? $args['authorurl'] : '');
        $akismet->setCommentContent($args['content']);
        $akismet->setPermalink(isset($args['permalink']) ? $args['permalink'] : '');

        return $akismet->submitHam();
    }

}
