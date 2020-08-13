<?php
/**
 *
 * @package     magento2
 * @author      Cognizant Technologies
 * @license     https://opensource.org/licenses/OSL-3.0 Open Software License v. 3.0 (OSL-3.0)
 * @link        https://www.Cognizant.com/
 */

namespace Mageplaza\HelloWorld\Block;


use Magento\Framework\View\Element\Template;

class ChangeText extends Cognizant\HelloWorld\Block\Hello
{
    public function getText() {
        return "Changed Text -  Preference Override";
    }
}