<?php
namespace Cognizant\Helloworld\Setup\Patch\Data;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchVersionInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Cognizant\Helloworld\Model\ContactdetailsFactory;
use Cognizant\Helloworld\Model\ResourceModel\Contactdetails;

class UpdateData implements DataPatchInterface, PatchVersionInterface
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
        
		$rowData = [
            'customer_name' => 'customer 2',
            'customer_email' => 'customer2@email.com',
            'customer_no' => '9988884442'
			
         
        ];		
		
		$contactDTO->setData($rowData)->save();
		$this->moduleDataSetup->endSetup();
	}
	
	public static function getDependencies()
	{
		return [];
	}

	public static function getVersion()
	{
		return '4.0.1';
	}
	
	public function getAliases()
	{
		return [];
	}
}