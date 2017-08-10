<?php

namespace Unet\SocialShare\Block\Widget;

use Magento\Widget\Block\BlockInterface;
use Unet\SocialShare\Block\AbstractShare;

class ShareTo extends AbstractShare implements BlockInterface
{
    /**
     * @var string
     */
    protected $template = "Unet_SocialShare::shareto.phtml";

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Unet\SocialShare\Helper\Data $helper,
        \Unet\SocialShare\Block\OpenGraph $openGraph,
        array $data = []
    ) {
        parent::__construct($context, $helper, $openGraph, $data);
        $this->setTemplate($this->template);
    }
}
