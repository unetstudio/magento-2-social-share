<?php

namespace Unet\SocialShare\Block;

use Magento\Framework\View\Element\Template;

/**
 * Class OpenGraph
 * @package Unet\SocialShare\Block
 */
class OpenGraph extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Unet\SocialShare\Helper\Data
     */
    protected $_themeHelper;

    /**
     * OpenGraph constructor.
     * @param Template\Context $context
     * @param \Unet\SocialShare\Helper\Data $_themeHelper
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        \Unet\SocialShare\Helper\Data $_themeHelper,
        array $data
    ) {
        $this->_themeHelper = $_themeHelper;
        parent::__construct($context, $data);
    }

    /**
     * @return string
     */
    public function getPageType()
    {
        $type= 'og:page';
        if ($this->_themeHelper->getCurrentCategory()) {
            $type = 'og:category';
        }

        return $type;
    }

    /**
     * @return mixed
     */
    public function getPageUrl()
    {
         $url = $this->_themeHelper->getCurrentUrl();

         return $url;
    }

    /**
     * @return string
     */
    public function getCanonicalUrl()
    {
        $canonicalUrl = $this->_themeHelper->getCurrentUrl();

        return $canonicalUrl;
    }

    /**
     * @return mixed
     */
    public function getPageTitle()
    {
        $title = $this->_themeHelper->getTitle();
        if ($category = $this->_themeHelper->getCurrentCategory()) {
            $title = $category->getName();
        } else if ($this->_themeHelper->getCmsPage()->getIdentifier()) {
            $title = $this->_themeHelper->getCmsPage()->getTitle();
        }

        return $title;
    }

    /**
     * @return mixed
     */
    public function getPageDescription()
    {
        $description = $this->_themeHelper->getDefaultDescription();
        if ($category = $this->_themeHelper->getCurrentCategory()) {
            $description = $category->getData('meta_description');
        } else if ($this->_themeHelper->getCmsPage()->getIdentifier()) {
            $description = $this->_themeHelper->getCmsPage()->getData('meta_description');
        }

        return $description;
    }

    /**
     * @return mixed
     */
    public function getPageImage()
    {
        $image = $this->_themeHelper->getLogoSrc();
        if ($category = $this->_themeHelper->getCurrentCategory()) {
            $image = $category->getImageUrl();
        }

        return $image;
    }
}
