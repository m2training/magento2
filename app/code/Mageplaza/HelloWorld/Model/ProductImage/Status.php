<?php
namespace Mageplaza\HelloWorld\Model\ProductImage;
 
class Status implements \Magento\Framework\Option\ArrayInterface
{
    public function toOptionArray()
    {
        $options = [];
        $options[] = ['label' => 'One', 'value' => 'post name -1'];
        $options[] = ['label' => 'Two', 'value' => 'two'];
        $options[] = ['label' => 'Three', 'value' => 'three'];
        $options[] = ['label' => 'Four', 'value' => 'four'];
        return $options;
    }
}