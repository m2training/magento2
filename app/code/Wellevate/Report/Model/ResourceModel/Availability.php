<?php
/**
 * @copyright   © Wellevate, All rights reserved.
 * @namespace   Wellevate
 * @module      Report
 * @brief       Report management
 * @author      Balakrishnan S
 * @email       balakrishnan.s4@cognizant.com
 * @date        01/17/19
 * @description  Availability ResourceModel
 * @link        #MU-605
 */

namespace Wellevate\Report\Model\ResourceModel;
/**
 * Class Availability
 * @package Wellevate\Report\Model\ResourceModel
 */
class Availability extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Constructor method
     */
    protected function _construct()
    {
        $this->_init('wellevate_report_availability', 'file_id');
    }
}
