<?php
namespace Mageplaza\HelloWorld\Model\PrivateGroup;
 
/**
 * Webkul Software.
 *
 * @category  Webkul
 * @package   Webkul_MultiSelectFilter
 * @author    Webkul
 * @copyright Copyright (c) Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */
 
class GroupList implements \Magento\Framework\Option\ArrayInterface
{
    public function toOptionArray()
    {
        $options = [];
        $options[] = ['label' => 'One', 'value' => 'post-name-1'];
        $options[] = ['label' => 'Two', 'value' => 'two'];
        $options[] = ['label' => 'Three', 'value' => 'three'];
        $options[] = ['label' => 'Four', 'value' => 'four'];
        return $options;
    }
}
