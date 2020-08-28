<?php
/**
 * @copyright   © Demo, All rights reserved.
 * @namespace   Demo
 * @module      App
 * @brief       Class to handle the allowed file extensions.
 * @author      Dinesh Arumugam
 * @email       dinesh.arumugam3@cognizant.com
 * @date        11/16/19
 * @description validates the file extensions.
 * @link        #MU-101
 */

namespace Demo\App\Model\Config\Backend;

class HeaderLogo extends \Magento\Config\Model\Config\Backend\File
{
    /**
     * @return string[]
     */
    public function getAllowedExtensions()
    {
        return ['png', 'jpg', 'jpeg', 'svg'];
    }
}
