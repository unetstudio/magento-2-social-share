<?php

namespace Unet\SocialShare\Api;

/**
 * Class SocialAdapter
 * @package Unet\SocialShare\Api
 */
interface SocialAdapter
{
    const FACEBOOK_SHARE_LINK = 'https://www.facebook.com/sharer/sharer.php';
    const TWITTER_SHARE_LINK = 'https://twitter.com/intent/tweet';
    const GOOGLE_PLUS_SHARE_LINK = 'https://plus.google.com/share';
    const PINTEREST_SHARE_LINK = 'https://pinterest.com/pin/create/button';

    public function getShareConfig();
}