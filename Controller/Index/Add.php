<?php

namespace Devmousam\Buynow\Controller\Index;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Data\Form\FormKey;
use Magento\Checkout\Model\Cart;
use Magento\Catalog\Model\Product;

class Add extends \Magento\Framework\App\Action\Action
{
    protected $formKey;   
    protected $cart;
    protected $product;
    protected $resultJsonFactory;
    public function __construct(
        Context $context,
        FormKey $formKey,
        Cart $cart,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        Product $product) {
            $this->formKey = $formKey;
            $this->cart = $cart;
            $this->product = $product;      
            parent::__construct($context);
            $this->resultJsonFactory = $resultJsonFactory;
    }

    public function execute()
    {
        try {
            $resultJson = $this->resultJsonFactory->create();
            $requestParams = $this->getRequest()->getPostValue();

            $productId = $requestParams['id'];

            $product = $this->product->load($requestParams['id']);

            if($product->getTypeId() == "simple") {
                $params = array(
                            'form_key' => $this->formKey->getFormKey(),
                            'product' => $requestParams['id'], 
                            'qty'   => $requestParams['qty']
                        );

            } else {
                $options = $requestParams['options'];
                $params = array(
                            'form_key' => $this->formKey->getFormKey(),
                            'product' => $requestParams['id'], 
                            'qty'   => $requestParams['qty'],
                            'super_attribute' => $options
                        );  

            }      
                   
            $this->cart->addProduct($product, $params);
            $this->cart->save();

            $response = ['success' => 'true'];

        } catch (\Magento\Framework\Exception\LocalizedException $e) {
            $response = ['success' => 'false'];
        }

        
        $resultJson->setData($response);
        return $resultJson;
    }
}