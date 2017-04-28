<?php
/**
 * ShareTo
 */

namespace Unet\SocialShare\Block\Widget;

/**
 * Class Share
 * @package Unet\SocialShare\Block\Widget
 */
class ShareTo extends \Unet\SocialShare\Block\AbstractShare implements \Magento\Widget\Block\BlockInterface
{
    /**
     * $template
     * @var string
     */
    protected $template = "Unet_SocialShare::shareto.phtml";

    /**
     * ShareTo constructor.
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Unet\SocialShare\Helper\Data $helper
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Unet\SocialShare\Helper\Data $helper,
        array $data
    ) {
        parent::__construct($context, $helper, $data);
        $this->setTemplate($this->template);
    }
}
