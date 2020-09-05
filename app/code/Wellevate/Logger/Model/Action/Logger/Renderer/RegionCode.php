<?php
/**
 * @copyright   © Wellevate, All rights reserved.
 * @namespace   Wellevate
 * @module      Logger
 * @brief       Customer Logger Render
 * @author      Aditya
 * @email       aditya.singh6@cognizant.com
 * @date        01/07/20
 * @description Logger render RegionCode
 * @link        #MU-476
 */

namespace Wellevate\Logger\Model\Action\Logger\Renderer;

use Magento\Directory\Model\RegionFactory;

class RegionCode implements \Wellevate\Logger\Model\Action\Logger\Renderer\LoggerInterface
{
    protected $regionFactory;
    protected $regions;

    /**
     * @param RegionFactory $regionFactory
     */
    public function __construct(
        RegionFactory $regionFactory
    )
    {
        $this->regionFactory = $regionFactory;
    }

    /**
     * @param $value
     * @return string
     */
    public function render($value)
    {
        if (empty($this->regions)) {
            $this->regions = $this->regionFactory->create();
            $this->regions->loadByCode($value, 'US');
        }
        if ($this->regions->getId()) {
            return $this->regions->getCode;
        } else {
            return 'n/a';
        }
    }
}
