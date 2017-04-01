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
    protected $_registry;

    /**
     * @var \Magento\Cms\Model\Page
     */
    protected $_page;

    /**
     * @var \Magento\Framework\View\Page\Title
     */
    protected $_pageTitle;

    /**
     * @var \Magento\Theme\Block\Html\Header\Logo
     */
    protected $_logo;

    /**
     * @var \Magento\Directory\Model\Currency
     */
    protected $_currency;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * @var \Magento\Eav\Model\Config
     */
    protected $eavConfig;

    /**
     * @var \Magento\Swatches\Helper\Data
     */
    protected $_swatchHelper;

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
     * @param \Magento\Swatches\Helper\Data $_swatchHelper
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
        \Magento\Swatches\Helper\Data $_swatchHelper
    ){
        $this->_currency = $currency;
        $this->_registry = $registry;
        $this->_page = $page;
        $this->_pageTitle = $pageTitle;
        $this->_logo = $logo;
        $this->_storeManager = $storeManager;
        $this->eavConfig = $eavConfig;
        $this->_swatchHelper = $_swatchHelper;

        parent::__construct($context);
    }


    /**
     * Get currency symbol for current locale and currency code
     *
     * @return string
     */
    public function getCurrentCurrencySymbol()
    {
        return $this->_currency->getCurrencySymbol();
    }

     /**
     * @return string
     */
    public function getStoreName()
    {
        return $this->_storeManager->getStore()->getName();
    }

    /**
     * @return mixed
     */
    public function getBaseUrl()
    {
        return $this->_storeManager->getStore()->getBaseUrl();
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->_pageTitle->getShort();
    }

    /**
     * @return mixed
     */
    public function getLogoSrc()
    {
        return $this->_logo->getLogoSrc();
    }

    /**
     * @return string
     */
    public function getCurrentUrl()
    {
        return $this->_urlBuilder->getCurrentUrl();
    }

    /**
     * @param bool $fromStore
     * @return mixed
     */
    public function getCurrentStoreUrl($fromStore = false) {
        return $this->_storeManager->getStore()->getCurrentUrl($fromStore);
    }

    /**
     * @return \Magento\Cms\Model\Page
     */
    public function getCmsPage() {
        return $this->_page;
    }

    /**
     * @return mixed
     */
    public function getCurrentCategory()
    {
        return $this->_registry->registry('current_category');
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
            $this->_storeManager->getStore()->getStoreId()
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
            $this->_storeManager->getStore()->getStoreId()
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
            $this->_storeManager->getStore()->getStoreId()
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
        $image_placeholder = $this->scopeConfig->getValue('catalog/placeholder/image_placeholder');

        return $image_placeholder;
    }

    /**
     * @param $attribute
     * @return array
     */
    public function getProductAttributeOptions($attribute) {
        $attribute = $this->eavConfig->getAttribute('catalog_product', $attribute);
        $options = $attribute->getSource()->getAllOptions();

        return $options;
    }

}
