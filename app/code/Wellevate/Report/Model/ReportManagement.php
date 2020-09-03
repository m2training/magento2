<?php
/**
 * @copyright   © Wellevate, All rights reserved.
 * @namespace   Wellevate
 * @module      Report
 * @brief       Report management
 * @author      Balakrishnan S
 * @email       balakrishnan.s4@cognizant.com
 * @date        17/01/19
 * @description Getting available reports
 * @link        #MU-605
 */

namespace Wellevate\Report\Model;

use Wellevate\Report\Api\ReportManagementInterface;

/**
 * Class ReportManagement
 * @package Wellevate\Report\Model
 */
class ReportManagement implements ReportManagementInterface
{
    /**
     * INACTIVE
     */
    CONST INACTIVE = 0;

    /**
     * ACTIVE
     */
    CONST ACTIVE = 1;

    /**
     * @var AvailabilityFactory
     */
    protected $availabilityFactory;

    /**
     * @var \Wellevate\Customer\Helper\Data
     */
    protected $customerHelper;

    /**
     * ReportManagement constructor.
     * @param AvailabilityFactory $availabilityFactory
     * @param \Wellevate\Customer\Helper\Data $customerHelper
     */
    public function __construct(
        \Wellevate\Report\Model\AvailabilityFactory $availabilityFactory,
        \Wellevate\Customer\Helper\Data $customerHelper
    )
    {
        $this->availabilityFactory = $availabilityFactory;
        $this->customerHelper = $customerHelper;
    }

    /**
     * @return array
     */
    public function getAvailableReports()
    {
        $customer = $this->customerHelper->getCurrentCustomer();

        $collection = $this->availabilityFactory->create()
            ->getCollection()
            ->addFieldToFilter('customer_id', $customer->getId())
            ->addFieldToFilter('status', SELF::ACTIVE)
            ->addFieldToFilter('is_listed', true);

        $availabilities = $collection->getItems();

        $results = [];
        foreach ($availabilities as $availability) {
            $record = $availability->toPublicArray();
            $results[] = $record;
        }

        return $results;
    }

}
