<?php


namespace Mageplaza\HelloWorld\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class TestInfoData implements DataPatchInterface
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
        
        $data[] = ['name' => 'Five', 'url_key' => 'post-five', 'post_content' => 'post content 5', 'tags' => 'tag1', 'featured_image' => 'featured1'];
        $data[] = ['name' => 'six', 'url_key' => 'post-six', 'post_content' => 'post content 6', 'tags' => 'tag2', 'featured_image' => 'featured2'];
        $data[] = ['name' => 'seven', 'url_key' => 'post-tseven', 'post_content' => 'post content 7', 'tags' => 'tag3', 'featured_image' => 'featured3'];
        $data[] = ['name' => 'Eight', 'url_key' => 'post-eight', 'post_content' => 'post content 8', 'tags' => 'tag4', 'featured_image' => 'featured4'];

        $data[] = ['name' => 'Five', 'url_key' => 'post-five', 'post_content' => 'post content 5', 'tags' => 'tag1', 'featured_image' => 'featured1'];
        $data[] = ['name' => 'six', 'url_key' => 'post-six', 'post_content' => 'post content 6', 'tags' => 'tag2', 'featured_image' => 'featured2'];
        $data[] = ['name' => 'seven', 'url_key' => 'post-tseven', 'post_content' => 'post content 7', 'tags' => 'tag3', 'featured_image' => 'featured3'];
        $data[] = ['name' => 'Eight', 'url_key' => 'post-eight', 'post_content' => 'post content 8', 'tags' => 'tag4', 'featured_image' => 'featured4'];

        $data[] = ['name' => 'Five', 'url_key' => 'post-five', 'post_content' => 'post content 5', 'tags' => 'tag1', 'featured_image' => 'featured1'];
        $data[] = ['name' => 'six', 'url_key' => 'post-six', 'post_content' => 'post content 6', 'tags' => 'tag2', 'featured_image' => 'featured2'];
        $data[] = ['name' => 'seven', 'url_key' => 'post-tseven', 'post_content' => 'post content 7', 'tags' => 'tag3', 'featured_image' => 'featured3'];
        $data[] = ['name' => 'Eight', 'url_key' => 'post-eight', 'post_content' => 'post content 8', 'tags' => 'tag4', 'featured_image' => 'featured4'];


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
