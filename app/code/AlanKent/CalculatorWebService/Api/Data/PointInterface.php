<?php

/**
 * Copyright 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace AlanKent\CalculatorWebService\Api\Data;

/**
 * Defines a data structure representing a point, to demonstrating passing
 * more complex types in and out of a function call.
 */
interface PointInterface
{
    /**
     * Get the x coordinate.
     *
     * @api
     * @return float The x coordinate.
     */
    public function getX();

    /**
     * Set the x coordinate.
     *
     * @api
     * @param $value float The new x coordinate.
     * @return null
     */
    public function setX($value);

    /**
     * Get the y coordinate.
     *
     * @api
     * @return float The y coordinate.
     */
    public function getY();

    /**
     * Set the y coordinate.
     *
     * @api
     * @param $value float The new y coordinate.
     * @return null
     */
    public function setY($value);
}