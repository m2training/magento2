<?php
/**
 * @copyright   © Wellevate, All rights reserved.
 * @namespace   Wellevate
 * @module      Logger
 * @brief       Customer Logger Render
 * @author      Aditya
 * @email       aditya.singh6@cognizant.com
 * @date        01/07/20
 * @description Logger render opted In / Out
 * @link        #MU-476
 */

namespace Wellevate\Logger\Model\Action\Logger\Renderer;

class Opted implements \Wellevate\Logger\Model\Action\Logger\Renderer\LoggerInterface
{

    /**
     * @param $value
     * @return string
     */
    const OPT_OUT = 0;
    const OPT_IN = 1;

    public function render($value)
    {
        if (self::OPT_IN == $value) {
            return 'In';
        } elseif (self::OPT_OUT == $value) {
            return 'Out';
        }
    }
}
