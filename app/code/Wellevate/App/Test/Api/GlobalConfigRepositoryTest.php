<?php
/**
 * @copyright   © Wellevate, All rights reserved.
 * @namespace   Wellevate
 * @module      App
 * @brief       functional test class for global configurations
 * @author      Dinesh Arumugam
 * @email       dinesh.arumugam3@cognizant.com
 * @date        11/16/19
 * @description Test class to validate the mock values for global configurations
 * @link        #MU-101
 */

namespace Wellevate\App\Test\Api;

use Magento\Framework\Webapi\Rest\Request;
use Magento\TestFramework\TestCase\WebapiAbstract;

class GlobalConfigRepositoryTest extends WebapiAbstract
{
    const RESOURCE_PATH = '/V1/app/ui/config';
    const SERVICE_NAME = 'globalConfigDataV1';

    public function testGlobalConfigAPI()
    {
        $serviceInfo = [
            'rest' => [
                'resourcePath' => self::RESOURCE_PATH,
                'httpMethod' => Request::HTTP_METHOD_GET,
            ],
            'soap' => [
                'service' => self::SERVICE_NAME,
                'operation' => self::SERVICE_NAME . 'Execute',
            ],
        ];

        $response = json_decode($this->_webApiCall($serviceInfo), true);
        $this->assertNotNull($response['settings']['title']);
        $this->assertNotNull($response['icon']['favicon']);
        $this->assertNotNull($response['header']['logo']);
        $this->assertNotNull($response['footer']['logo']);
    }
}
