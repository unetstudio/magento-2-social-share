<?php

namespace Unet\SocialShare\Block\Widget;

/**
 * Class Share
 * @package Unet\SocialShare\Block\Widget
 */
class ShareTo extends \Unet\SocialShare\Block\AbstractShare
{
    /**
     * @var string
     */
    private $_template = "Unet_SocialShare::shareto.phtml";

    /**
     * setTemplate
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate($this->_template);
    }
}