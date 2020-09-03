<?php
/**
 * @copyright   © Wellevate, All rights reserved.
 * @namespace   Wellevate
 * @module      Report
 * @brief       to fetch Available report details
 * @author      Balakrishnan S
 * @email       balakrishnan.s4@cognizant.com
 * @date        01/17/2019
 * @description  Availability Collection
 * @link        #MU-605
 */

namespace Wellevate\Report\Model\ResourceModel\Availability;
/**
 * Class Collection
 * @package Wellevate\Report\Model\ResourceModel\Availability
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'file_id';

    /**
     * Constructor
     */
    protected function _construct()
    {
        $this->_init(
            'Wellevate\Report\Model\Availability',
            'Wellevate\Report\Model\ResourceModel\Availability'
        );
    }
}
