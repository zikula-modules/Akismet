<?php

/**
 * Akismet integrator API for Zikula
 *
 * @license GNU/GPL - http://www.gnu.org/copyleft/gpl.html
 */
class Akismet_Installer extends Zikula_AbstractInstaller
{

    /**
     * init module
     */
    public function install()
    {
        // create module settings
        $this->setVar('enable', false);
        $this->setVar('apikey', '');
        $this->setVar('apikeyvalid', false);
        $this->setVar('count', 0);

        // Initialisation successful
        return true;
    }

    /**
     * upgrade module
     */
    public function upgrade($oldversion)
    {
        switch ($oldversion) {
            case '1.2':
                $modvars = ModUtil::getVar('akismet');
                if ($modvars) {
                    foreach ($modvars as $key => $value) {
                        $this->setVar($key, $value);
                    }
                    ModUtil::delVar('akismet');
                }
        }
        return true;
    }

    /**
     * delete module
     */
    public function uninstall()
    {
        // delete all module vars
        $this->delVars();

        // Deletion successful
        return true;
    }

}