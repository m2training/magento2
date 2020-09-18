<?php
/**
 * @copyright   © Wellevate, All rights reserved.
 * @namespace   Wellevate
 * @module      Logger
 * @brief       Customer Log Event Model
 * @author      Aditya
 * @email       aditya.singh6@cognizant.com
 * @date        01/07/20
 * @description Logger model
 * @link        #MU-476
 */

namespace Wellevate\Logger\Model;

use Magento\Framework\Model\AbstractModel;

class Logevent extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(\Wellevate\Logger\Model\ResourceModel\Logevent::class);
    }
}
