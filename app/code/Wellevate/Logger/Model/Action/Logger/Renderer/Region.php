<?php
/**
 * @copyright   © Wellevate, All rights reserved.
 * @namespace   Wellevate
 * @module      Logger
 * @brief       Customer Logger Render
 * @author      Aditya
 * @email       aditya.singh6@cognizant.com
 * @date        01/07/20
 * @description Logger render Region
 * @link        #MU-476
 */

namespace Wellevate\Logger\Model\Action\Logger\Renderer;

use Magento\Directory\Model\RegionFactory;

class Region implements \Wellevate\Logger\Model\Action\Logger\Renderer\LoggerInterface
{
    protected $_regions;
    protected $regionFactory;

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
        if (empty($this->_regions)) {
            $this->_regions = $this->regionFactory->create();
            $this->_regions->loadByName($value, 'US');
        }

        if ($this->_regions->getId()) {
            return $this->_regions->getName();
        } else {
            return 'n/a';
        }
    }
}
