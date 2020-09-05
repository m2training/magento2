<?php
/**
 * @copyright   © Wellevate, All rights reserved.
 * @namespace   Wellevate
 * @module      Logger
 * @brief       Customer Logger Render
 * @author      Aditya
 * @email       aditya.singh6@cognizant.com
 * @date        01/07/20
 * @description Logger render default case
 * @link        #MU-476
 */

namespace Wellevate\Logger\Model\Action\Logger\Renderer;

class Defaultcase implements \Wellevate\Logger\Model\Action\Logger\Renderer\LoggerInterface
{
    /**
     * @param $value
     * @return mixed
     */
    public function render($value)
    {
        return $value;
    }
}
