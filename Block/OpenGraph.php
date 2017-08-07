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
    protected $themeHelper;

    /**
     * @var \Magento\Catalog\Block\Product\ListProduct
     */
    protected $listProduct;

    /**
     * OpenGraph constructor.
     * @param Template\Context $context
     * @param \Unet\SocialShare\Helper\Data $themeHelper
     * @param \Magento\Catalog\Block\Product\ListProduct $listProduct
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Unet\SocialShare\Helper\Data $themeHelper,
        \Magento\Catalog\Block\Product\ListProduct $listProduct,
        array $data = []
    ) {
        $this->themeHelper = $themeHelper;
        $this->listProduct = $listProduct;

        parent::__construct($context, $data);
    }

    /**
     * @return string
     */
    public function getPageType()
    {
        $type= 'og:page';
        if ($this->themeHelper->getCurrentCategory()) {
            $type = 'og:category';
        }

        return $type;
    }

    /**
     * @return mixed
     */
    public function getPageUrl()
    {
         $url = $this->themeHelper->getCurrentUrl();

         return $url;
    }

    /**
     * @return string
     */
    public function getCanonicalUrl()
    {
        $canonicalUrl = $this->themeHelper->getCurrentUrl();

        return $canonicalUrl;
    }

    /**
     * @return mixed
     */
    public function getPageTitle()
    {
        $title = $this->themeHelper->getTitle();
        if ($category = $this->themeHelper->getCurrentCategory()) {
            $title = $category->getName();
        } elseif ($this->themeHelper->getCmsPage()->getIdentifier()) {
            $title = $this->themeHelper->getCmsPage()->getTitle();
        }

        return $title;
    }

    /**
     * @return mixed
     */
    public function getPageDescription()
    {
        $description = $this->themeHelper->getDefaultDescription();
        if ($category = $this->themeHelper->getCurrentCategory()) {
            $description = $category->getData('meta_description');
        } elseif ($this->themeHelper->getCmsPage()->getIdentifier()) {
            $description = $this->themeHelper->getCmsPage()->getData('meta_description');
        }

        return $description;
    }

    /**
     * @return mixed
     */
    public function getPageImage()
    {
        $image = $this->themeHelper->getLogoSrc();
        if ($category = $this->themeHelper->getCurrentCategory()) {
            $image = $category->getImageUrl();
        }
        if ($product = $this->themeHelper->getCurrentProduct()) {
            $image = $this->listProduct->getImage($product, 'product_base_image')->getImageUrl();
        }

        return $image;
    }
}
