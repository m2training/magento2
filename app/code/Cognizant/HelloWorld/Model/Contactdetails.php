<?php
namespace Cognizant\Helloworld\Model;
use Magento\Framework\Model\AbstractModel;

class Contactdetails extends AbstractModel{
	protected function _construct()
	{
		$this->_init("Cognizant\Helloworld\Model\ResourceModel\Contactdetails");
	}
}
