<?php

/**
 * Copyright 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace AlanKent\CalculatorWebService\Api;

use AlanKent\CalculatorWebService\Api\Data\PointInterface;

/**
 * Defines the service contract for some simple maths functions. The purpose is
 * to demonstrate the definition of a simple web service, not that these
 * functions are really useful in practice. The function prototypes were therefore
 * selected to demonstrate different parameter and return values, not as a good
 * calculator design.
 */
interface CalculatorInterface
{
    /**
     * Return the sum of the two numbers.
     *
     * @api
     * @param int $num1 Left hand operand.
     * @param int $num2 Right hand operand.
     * @return int The sum of the numbers.
     */
    public function add($num1, $num2);

     /**
     * Sum an array of numbers.
     *
     * @api
     * @param float[] $nums The array of numbers to sum.
     * @return float The sum of the numbers.
     */
    public function sum($nums);

     /**
     * Compute mid-point between two points.
     *
     * @api
     * @param AlanKent\CalculatorWebService\Api\Data\PointInterface $point1 The first point.
     * @param AlanKent\CalculatorWebService\Api\Data\PointInterface $point2 The second point.
     * @return AlanKent\CalculatorWebService\Api\Data\PointInterface The mid-point.
     */
    public function midPoint($point1, $point2);
}