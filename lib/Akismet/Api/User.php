<?php
/**
 * Akismet integrator API for Zikula
 *
 * @author Mark West
 * @link http://www.markwest.me.uk
 * @license GNU/GPL - http://www.gnu.org/copyleft/gpl.html
 */

/**
 * API class.
 */
class Akismet_Api_User extends Zikula_Api
{

    public function postInitialize()
    {
        $this->_loadclass();
    }
    /**
     * verify an akismet key
     *
     * @author Mark West
     * @access private
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
     * @author Mark West
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
     * @author Mark West
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
    private function _loadclass()
    {
        require_once 'modules/Akismet/lib/Akismet/vendor/Akismet.class.5.php';
    }

}