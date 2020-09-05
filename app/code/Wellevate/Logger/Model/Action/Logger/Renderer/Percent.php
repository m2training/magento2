<?php
/**
 * @copyright   © Wellevate, All rights reserved.
 * @namespace   Wellevate
 * @module      Logger
 * @brief       Customer Logger Render
 * @author      Aditya
 * @email       aditya.singh6@cognizant.com
 * @date        01/07/20
 * @description Logger render Percent
 * @link        #MU-476
 */

namespace Wellevate\Logger\Model\Action\Logger\Renderer;

class Percent implements \Wellevate\Logger\Model\Action\Logger\Renderer\LoggerInterface
{

    /**
     * @param $value
     * @return string
     */
    public function render($value)
    {
        return sprintf('%d%%', (int)($value * 100));
    }
}
