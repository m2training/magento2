<?php
namespace Cognizant\HelloWorld\Controller\Index;

class Contactdetails extends \Magento\Framework\App\Action\Action
{
	protected $_pageFactory;

	protected $_contactdetailsFactory;

	public function __construct(
		\Magento\Framework\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $pageFactory,
		\Cognizant\HelloWorld\Model\ContactdetailsFactory $contactdetailsFactory
		)
	{
		$this->_pageFactory = $pageFactory;
		$this->_contactdetailsFactory = $contactdetailsFactory;
		return parent::__construct($context);
	}

	public function execute()
	{
		$ccd = $this->_contactdetailsFactory->create();
		$collection = $ccd->getCollection();
		foreach($collection as $item){
			echo "<pre>";
			echo "Name:".$item->getCustomerName();
			echo "</pre>";
		}
		exit();
		return $this->_pageFactory->create();
	}
}