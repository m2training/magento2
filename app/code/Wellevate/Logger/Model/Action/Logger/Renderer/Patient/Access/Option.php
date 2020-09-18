<?php
/**
 * @copyright   © Wellevate, All rights reserved.
 * @namespace   Wellevate
 * @module      Logger
 * @brief       Customer Logger Render
 * @author      Aditya
 * @email       aditya.singh6@cognizant.com
 * @date        01/07/20
 * @description Logger render patient access Option
 * @link        #MU-476
 */

namespace Wellevate\Logger\Model\Action\Logger\Renderer\Patient\Access;

class Option implements \Wellevate\Logger\Model\Action\Logger\Renderer\LoggerInterface
{

    const INVITATION_ONLY = 1;
    const OPEN_ACCESS = 0;

    /**
     * @param $value
     *
     * @return string
     */
    public function render($value)
    {

        $options = self::toArray();

        if (isset($options[$value])) {
            return $options[$value];
        } else {
            return 'Unknown value';
        }
    }

    public function toArray()
    {
        return [
            self::INVITATION_ONLY => 'Practitioner Invite Only',
            self::OPEN_ACCESS => 'Open Access'
        ];
    }
}
