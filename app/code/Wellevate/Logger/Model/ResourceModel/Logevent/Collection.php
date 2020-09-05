<?php
/**
 * @copyright   © Wellevate, All rights reserved.
 * @namespace   Wellevate
 * @module      Logger
 * @brief       Customer Logger ResourceModel collection
 * @author      Aditya
 * @email       aditya.singh6@cognizant.com
 * @date        01/07/20
 * @description Logger resource model collection
 * @link        #MU-476
 */

namespace Wellevate\Logger\Model\ResourceModel\Logevent;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'id';

    protected function _construct()
    {
        $this->_init(
            \Wellevate\Logger\Model\Logevent::class,
            \Wellevate\Logger\Model\ResourceModel\Logevent::class
        );
    }
}
