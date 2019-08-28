<?php

namespace Devmousam\Buynow\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{
	protected $helperData;

	public function __construct(
		\Magento\Framework\App\Action\Context $context,
		\Devmousam\Buynow\Helper\Data $helperData

	)
	{
		$this->helperData = $helperData;
		return parent::__construct($context);
	}

    public function execute()
    {

    	echo $this->helperData->getGeneralConfig('enable');
		
		exit();

        $this->_view->loadLayout();
        $this->_view->getLayout()->initMessages();
        $this->_view->renderLayout();
    }
}