<?php
namespace Cognizant\Helloworld\Model\ResourceModel\Post;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	protected $_idFieldName = 'id';
	protected $_eventPrefix = 'cognizant_helloworld_post_collection';
	protected $_eventObject = 'contactdetails_collection';

	/**
	 * Define resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_init('Cognizant\Helloworld\Model\Contactdetails', 'Cognizant\Helloworld\Model\ResourceModel\Contactdetails');
	}

}
