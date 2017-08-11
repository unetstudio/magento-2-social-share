<?php

namespace Unet\SocialShare\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;

/**
 * Class Data
 * @package Unet\SocialShare\Helper
 */
class Data extends AbstractHelper
{
    /**
     * @var \Magento\Framework\Registry
     */
    protected $registry;

    /**
     * @var \Magento\Cms\Model\Page
     */
    protected $page;

    /**
     * @var \Magento\Framework\View\Page\Title
     */
    protected $pageTitle;

    /**
     * @var \Magento\Theme\Block\Html\Header\Logo
     */
    protected $logo;

    /**
     * @var \Magento\Directory\Model\Currency
     */
    protected $currency;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var \Magento\Eav\Model\Config
     */
    protected $eavConfig;

    /**
     * @var \Magento\Swatches\Helper\Data
     */
    protected $swatchHelper;

     /**
     * const
     */
    const MAIN_LANGUAGE = 'en-US';

    /**
     * Data constructor.
     * @param Context $context
     * @param \Magento\Directory\Model\Currency $currency
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Cms\Model\Page $page
     * @param \Magento\Framework\View\Page\Title $pageTitle
     * @param \Magento\Theme\Block\Html\Header\Logo $logo
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Eav\Model\Config $eavConfig
     * @param \Magento\Swatches\Helper\Data $swatchHelper
     */
    public function __construct(
        Context $context,
        \Magento\Directory\Model\Currency $currency,
        \Magento\Framework\Registry $registry,
        \Magento\Cms\Model\Page $page,
        \Magento\Framework\View\Page\Title $pageTitle,
        \Magento\Theme\Block\Html\Header\Logo $logo,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Eav\Model\Config $eavConfig,
        \Magento\Swatches\Helper\Data $swatchHelper
    ) {
        $this->currency = $currency;
        $this->registry = $registry;
        $this->page = $page;
        $this->pageTitle = $pageTitle;
        $this->logo = $logo;
        $this->storeManager = $storeManager;
        $this->eavConfig = $eavConfig;
        $this->swatchHelper = $swatchHelper;

        parent::__construct($context);
    }


    /**
     * Get currency symbol for current locale and currency code
     *
     * @return string
     */
    public function getCurrentCurrencySymbol()
    {
        return $this->currency->getCurrencySymbol();
    }

     /**
     * @return string
     */
    public function getStoreName()
    {
        return $this->storeManager->getStore()->getName();
    }

    /**
     * @return mixed
     */
    public function getBaseUrl()
    {
        return $this->storeManager->getStore()->getBaseUrl();
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->pageTitle->getShort();
    }

    /**
     * @return mixed
     */
    public function getLogoSrc()
    {
        return $this->logo->getLogoSrc();
    }

    /**
     * @return string
     */
    public function getCurrentUrl()
    {
        return $this->_urlBuilder->getCurrentUrl();
    }

    /**
     * @param $fromStore
     * @return mixed
     */
    public function getCurrentStoreUrl($fromStore)
    {
        return $this->storeManager->getStore()->getCurrentUrl($fromStore);
    }

    /**
     * @return \Magento\Cms\Model\Page
     */
    public function getCmsPage()
    {
        return $this->page;
    }

    /**
     * @return mixed
     */
    public function getCurrentCategory()
    {
        return $this->registry->registry('current_category');
    }

    /**
     * @return mixed
     */
    public function getCurrentProduct()
    {
        return $this->registry->registry('current_product');
    }

    /**
     * @param $path
     * @return mixed
     */
    public function getStoreConfig($path)
    {
        $config =  $this->scopeConfig->getValue(
            $path,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $this->storeManager->getStore()->getStoreId()
        );

        return $config;
    }

    /**
     * @return mixed
     */
    public function getDefaultDescription()
    {
        $description = $this->scopeConfig->getValue(
            'design/head/default_description',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $this->storeManager->getStore()->getStoreId()
        );

        $description = (!empty($description)) ? $description : '';

        return $description;
    }

    /**
     * @return mixed
     */
    public function getLocale()
    {
        $locale = $this->scopeConfig->getValue(
            'general/locale/code',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $this->storeManager->getStore()->getStoreId()
        );

        return $locale;
    }

    /**
     * @return string
     */
    public function getLanguage()
    {
        $locate = trim($this->getLocale());
        $language = '';
        if (!empty($locate)) {
            $language = implode('-', explode('_', $locate));
        }

        return $language;
    }

    /**
     * @return mixed
     */
    public function getPlaceholderImage()
    {
        $imagePlaceholder = $this->scopeConfig->getValue('catalog/placeholder/image_placeholder');

        return $imagePlaceholder;
    }

    /**
     * @param $attribute
     * @return array
     */
    public function getProductAttributeOptions($attribute)
    {
        $attribute = $this->eavConfig->getAttribute('catalog_product', $attribute);
        $options = $attribute->getSource()->getAllOptions();

        return $options;
    }

    /**
     * @return mixed
     */
    public function isFrontUrlSecure()
    {
        return $this->storeManager->getStore()->isFrontUrlSecure();
    }
}
