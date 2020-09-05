<?php
/**
 * @copyright   © Wellevate, All rights reserved.
 * @namespace   Wellevate
 * @module      Logger
 * @brief       Customer Log Event ResourceModel
 * @author      Aditya
 * @email       aditya.singh6@cognizant.com
 * @date        01/07/20
 * @description Logger model
 * @link        #MU-476
 */

namespace Wellevate\Logger\Model\ResourceModel;

class Logevent extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('wellevate_log_event', 'id');
    }
}
