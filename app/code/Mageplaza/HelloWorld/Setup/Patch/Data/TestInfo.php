<?php


namespace Mageplaza\HelloWorld\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class TestInfo implements DataPatchInterface
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
        
        $data[] = ['name' => 'post-name-1', 'url_key' => 'postname1', 'post_content' => 'post content 1', 'tags' => 'tag1', 'featured_image' => 'featured1'];
        $data[] = ['name' => 'two', 'url_key' => 'post-two', 'post_content' => 'post content 2', 'tags' => 'tag2', 'featured_image' => 'featured2'];
        $data[] = ['name' => 'three', 'url_key' => 'post-three', 'post_content' => 'post content 3', 'tags' => 'tag3', 'featured_image' => 'featured3'];
        $data[] = ['name' => 'four', 'url_key' => 'post-four', 'post_content' => 'post content 4', 'tags' => 'tag4', 'featured_image' => 'featured4'];

         $this->moduleDataSetup->getConnection()->insertArray(
            $this->moduleDataSetup->getTable('mageplaza_helloworld_post'),
            ['name', 'url_key', 'post_content', 'tags', 'featured_image'],
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
