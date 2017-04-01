<?php

namespace Unet\SocialShare\Model\Config\Source;

/**
 * Class Enable
 * @package Unet\SocialShare\Model\Config\Source
 */
class Enable implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @return array
     */
    public function toOptionArray()
    {

        return [
            ['value' => 0, 'label' => __('Disable')],
            ['value' => 1, 'label' => __('Enable')]
        ];
    }
}
