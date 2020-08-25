<?php
/**
 *
 * @package     magento2
 * @author      Cognizant Technologies
 * @license     https://opensource.org/licenses/OSL-3.0 Open Software License v. 3.0 (OSL-3.0)
 * @link        https://www.Cognizant.com/
 */

namespace Cognizant\HelloWorld\Block;


use Magento\Framework\View\Element\Template;


class Hello extends Template
{
    protected $_contactdetailsFactory;

	public function __construct(
	
		\Cognizant\HelloWorld\Model\ContactdetailsFactory $contactdetailsFactory
		)
	{
		
		$this->_contactdetailsFactory = $contactdetailsFactory;
		
    }
    
    public function getContactDetails(){

        $ccd = $this->_contactdetailsFactory->create();
		$collection = $ccd->getCollection();
		return $collection;
    }

    public function getText() {
        return "welcome to magento 2 training";
    }
}