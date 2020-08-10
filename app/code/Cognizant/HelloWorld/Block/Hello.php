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
    public function getText() {
        return "Hello World";
    }
}