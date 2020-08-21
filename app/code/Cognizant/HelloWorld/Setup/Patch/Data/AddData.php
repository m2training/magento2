<?php
namespace Cognizant\Helloworld\Setup\Patch\Data;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchVersionInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Cognizant\Helloworld\Model\ContactdetailsFactory;
use Cognizant\Helloworld\Model\ResourceModel\Contactdetails;

class AddData implements DataPatchInterface, PatchVersionInterface
{
	private $contactDetailsFactory;
	private $contactDetailsResource;
	private $moduleDataSetup;
	public function __construct(
		ContactdetailsFactory $contactDetailsFactory,
		Contactdetails $contactDetailsResource,
		ModuleDataSetupInterface $moduleDataSetup
	)
	{
		$this->contactDetailsFactory = $contactDetailsFactory;
		$this->contactDetailsResource = $contactDetailsResource;
		$this->moduleDataSetup=$moduleDataSetup;
	}
	
	public function apply()
	{
	//Install data row into contact_details table
		$this->moduleDataSetup->startSetup();
		$contactDTO=$this->contactDetailsFactory->create();    	   
		$contactDTO->setCustomerName('customer 1')->setCustomerEmail('customer1@email.com')
		->setContactNo('9988884441');
		$contactDTO->setCustomerName('customer 2')->setCustomerEmail('customer2@email.com')
		->setContactNo('9988884442');
		$contactDTO->setCustomerName('customer 3')->setCustomerEmail('customer3@email.com')
		->setContactNo('9988884443');
		$this->contactDetailsResource->save($contactDTO);
		$this->moduleDataSetup->endSetup();
	}
	
	public static function getDependencies()
	{
		return [];
	}

	public static function getVersion()
	{
		return '3.0.0';
	}
	
	public function getAliases()
	{
		return [];
	}
}