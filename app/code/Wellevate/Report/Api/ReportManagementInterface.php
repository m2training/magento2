<?php
/**
 * @copyright   © Wellevate, All rights reserved.
 * @namespace   Wellevate
 * @module      Report
 * @brief       Report management
 * @author      Balakrishnan S
 * @email       balakrishnan.s4@cognizant.com
 * @date        01/17/19
 * @description Interface for getting available Reports
 * @link        #MU-605
 */

namespace Wellevate\Report\Api;

/**
 * Interface ReportManagementInterface
 * @package Wellevate\Report\Api
 */
interface ReportManagementInterface
{

    /**
     * @return mixed
     */
    public function getAvailableReports();

}
