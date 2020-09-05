<?php


namespace Custom\Demo\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class Testinfo implements DataPatchInterface
{

    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    public function __construct(
       ModuleDataSetupInterface $moduleDataSetup

     ) {

        $this->moduleDataSetup = $moduleDataSetup;

    }
    public function apply()
    {
        $this->moduleDataSetup->startSetup();
        $setup = $this->moduleDataSetup;
        
        $data[] = ['product_id' => 1, 'product_message' => 'Product id 1 product message'];
        $data[] = ['product_id' => 2, 'product_message' => 'Product id 2 product message'];
             
         $this->moduleDataSetup->getConnection()->insertArray(
            $this->moduleDataSetup->getTable('product_message_details'),
            ['product_id', 'product_message'],
            $data
        );     
        $this->moduleDataSetup->endSetup();
    }
    public function getAliases()
    {
        return [];
    }
    public static function getDependencies()
    {
        return [];
    }
}
