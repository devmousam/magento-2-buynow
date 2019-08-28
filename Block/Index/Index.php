<?php

namespace Devmousam\Buynow\Block\Index;

class Index extends \Magento\Framework\View\Element\Template {

    public function __construct(
        \Magento\Catalog\Block\Product\Context $context, 
        array $data = [],
        \Magento\Framework\ObjectManagerInterface $objectManager
    ) {
        parent::__construct($context, $data);
        $this->_objectManager = $objectManager;
    }

    protected function _prepareLayout()
    {
        return parent::_prepareLayout();
    }
    
    public function getProduct() {
	    $product = $this->_objectManager->get('Magento\Framework\Registry')->registry('current_product');
	    return $product;
    }
}