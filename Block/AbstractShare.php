<?php

namespace Unet\SocialShare\Block;

/**
 * Class AbstractShare
 * @package Unet\SocialShare\Block
 */
class AbstractShare extends \Magento\Framework\View\Element\Template implements \Unet\SocialShare\Api\SocialAdapter
{
    /**
     * @return array
     */
    public function getShareConfig() {
        $config = [
            'facebook' => \Unet\SocialShare\Api\SocialAdapter::FACEBOOK_SHARE_LINK,
            'twitter' => \Unet\SocialShare\Api\SocialAdapter::TWITTER_SHARE_LINK,
            'gplus' => \Unet\SocialShare\Api\SocialAdapter::GOOGLE_PLUS_SHARE_LINK,
            'pinterest' => \Unet\SocialShare\Api\SocialAdapter::PINTEREST_SHARE_LINK
        ];

        return $config;
    }
}