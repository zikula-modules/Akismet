<?php

/**
 * Akismet integrator API for Zikula
 *
 * @license GNU/GPL - http://www.gnu.org/copyleft/gpl.html
 */
class Akismet_Controller_Admin extends Zikula_AbstractController
{

    /**
     * Adminstration entry point
     *
     * @return string HTML output string
     */
    public function main()
    {
        return $this->redirect(ModUtil::url('Akismet', 'admin', 'modifyconfig'));
    }

    /**
     * Modify module configuration
     *
     * @return string HTML output string
     */
    public function modifyconfig()
    {
        $this->throwForbiddenUnless(SecurityUtil::checkPermission('Akismet::', '::', ACCESS_ADMIN), LogUtil::getErrorMsgPermission());

        return $this->view->fetch('akismet_admin_modifyconfig.tpl');
    }

    /**
     * Update module configuration
     *
     * @return mixed error string or true
     */
    public function updateconfig()
    {
        $this->throwForbiddenUnless(SecurityUtil::checkPermission('Akismet::', '::', ACCESS_ADMIN), LogUtil::getErrorMsgPermission());

        $this->checkCsrfToken();

        // get our input
        $enable = (bool)$this->request->getPost()->get('enable', false);
        $apikey = (string)$this->request->getPost()->get('apikey', '');

        // validate the key
        if (!ModUtil::apiFunc('akismet', 'user', 'verifykey', array('apikey' => $apikey))) {
            LogUtil::registerError($this->__('Error! Sorry! Invalid API key. Please obtain one from http://wordpress.com/api-keys/.'));
            $this->setVar('apikeyvalid', false);
            return System::redirect(ModUtil::url('Akismet', 'admin', 'modifyconfig'));
        } else {
            $this->setVar('apikeyvalid', true);
        }

        // set our new values
        $this->setVar('enable', $enable);
        $this->setVar('apikey', $apikey);

        // the module configuration has been updated successfuly
        LogUtil::registerStatus($this->__('Done! Module configuration updated.'));

        $this->redirect(ModUtil::url('akismet', 'admin', 'modifyconfig'));
    }

    public function postInitialize()
    {
        $this->view->setCaching(false);
    }

}