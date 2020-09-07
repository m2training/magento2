<?php

namespace Mageplaza\HelloWorld\Controller\Index;

class Test extends \Magento\Framework\App\Action\Action
{

	protected $_dataHelper;

	public function __construct(
		\Mageplaza\HelloWorld\Helper\Data $dataHelper
		
	)
	{		
		$this->_dataHelper = $dataHelper;
	}

	public function execute()
	{
		$textDisplay = new \Magento\Framework\DataObject(array('text' => 'Test event Observe'));
		$this->_eventManager->dispatch('mageplaza_helloworld_display_text', ['mp_text' => $textDisplay]);
		echo $textDisplay->getText();
		//exit;
	}
}