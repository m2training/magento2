<?php
/**
 * @copyright   © Wellevate, All rights reserved.
 * @namespace   Wellevate
 * @module      Logger
 * @brief       Customer Logger Interface
 * @author      Aditya
 * @email       aditya.singh6@cognizant.com
 * @date        01/07/20
 * @description Logger render Interface
 * @link        #MU-476
 */

namespace Wellevate\Logger\Model\Action\Logger\Renderer;

interface LoggerInterface
{
    public function render($value);
}
