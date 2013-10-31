<?php

/**
 * Akismet integrator API for Zikula
 *
 * @license GNU/GPL - http://www.gnu.org/copyleft/gpl.html
 */
class Akismet_Version extends Zikula_AbstractVersion
{

    public function getMetaData()
    {
        $meta = array();
        $meta['oldnames'] = 'akismet';
        $meta['displayname'] = __('Akismet');
        //! module url in lowercase and different from displayname
        $meta['url'] = __('akismet');
        $meta['version'] = '2.1.0';
        $meta['description'] = __('Akismet spam detection service');
        $meta['securityschema'] = array('Akismet::' => '::');
        return $meta;
    }

}