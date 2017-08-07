<?php
/**
 * AbstractShare
 */

namespace Unet\SocialShare\Block;

/**
 * Class AbstractShare
 * @package Unet\SocialShare\Block
 */
abstract class AbstractShare extends \Magento\Framework\View\Element\Template implements \Unet\SocialShare\Adapter\SocialAdapter
{
    /**
     * @var \Unet\SocialShare\Helper\Data
     */
    protected $helper;

    /**
     * @var OpenGraph
     */
    protected $openGraph;

    const FACEBOOK_ENABLE_PATH = 'social_share/facebook/facebook_enable';

    const TWITTER_ENABLE_PATH = 'social_share/twitter/twitter_enable';

    const GOOGLE_PLUS_ENABLE_PATH = 'social_share/network/google_plus_enable';

    const PINTEREST_ENABLE_PATH = 'social_share/network/pinterest_enable';

    const FACEBOOK_APP_ID = 'social_share/facebook/facebook_app_id';

    const TWITTER_NAME = 'social_share/twitter/twitter_site_name';

    /**
     * AbstractShare constructor.
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Unet\SocialShare\Helper\Data $helper
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Unet\SocialShare\Helper\Data $helper,
        \Unet\SocialShare\Block\OpenGraph $openGraph,
        array $data = []
    ) {
        $this->helper = $helper;
        $this->openGraph = $openGraph;
        parent::__construct($context, $data);
    }

    /**
     * getShareConfig
     * @return array
     */
    public function getShareConfig()
    {
        $config = [
            'facebook' => [
                'enable' => $this->helper->getStoreConfig(self::FACEBOOK_ENABLE_PATH),
                'link' => \Unet\SocialShare\Adapter\SocialAdapter::FACEBOOK_SHARE_LINK
            ],
            'twitter' => [
                'enable' => $this->helper->getStoreConfig(self::TWITTER_ENABLE_PATH),
                'link' => \Unet\SocialShare\Adapter\SocialAdapter::TWITTER_SHARE_LINK
            ],
            'gplus' => [
                'enable' => $this->helper->getStoreConfig(self::GOOGLE_PLUS_ENABLE_PATH),
                'link' => \Unet\SocialShare\Adapter\SocialAdapter::GOOGLE_PLUS_SHARE_LINK
            ],
            'pinterest' => [
                'enable' => $this->helper->getStoreConfig(self::PINTEREST_ENABLE_PATH),
                'link' => \Unet\SocialShare\Adapter\SocialAdapter::PINTEREST_SHARE_LINK
            ]
        ];

        return $config;
    }

    /**
     * @return mixed
     */
    public function getImage() {
        return $this->openGraph->getPageImage();
    }
}
