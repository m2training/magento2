<?php
/**
 * @copyright   © Wellevate, All rights reserved.
 * @namespace   Wellevate
 * @module      App
 * @brief       Common functionalities for sharing the global config settings
 * @author      Dinesh Arumugam
 * @email       dinesh.arumugam3@cognizant.com
 * @date        11/16/19
 * @description Interface for managing global config settings
 * @link        #MU-101
 */

namespace Wellevate\App\Api;

/**
 * Defines the service contract for getting the application global configurations.
 */
interface GlobalConfigRepositoryInterface
{
    /**
     * Return the global configuration in json
     *
     * @param null
     * @return string[] getting global configuration in json.
     * @api
     */
    public function getAppGlobalConfig();
}
