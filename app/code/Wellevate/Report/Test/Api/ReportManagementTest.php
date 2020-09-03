<?php
/**
 * @copyright   © Wellevate, All rights reserved.
 * @namespace   Wellevate
 * @module      Report
 * @brief       Report Management
 * @author      Balakrishnan S
 * @email       balakrishnan.s4@cognizant.com
 * @date        01/09/2020
 * @description Test case for Report Managment
 * @link        #MU-605
 */

namespace Wellevate\Report\Test\Api;

use Magento\TestFramework\TestCase\WebapiAbstract;

/**
 * Test class to list patient details from practitioner dashboard
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class ReportManagementTest extends WebapiAbstract
{

    const RESOURCE_PATH = '/V1/reports/availabilities';

    /**
     * Test practitioner patient list
     */
    public function testGetAvailableReports()
    {
        $serviceInfo = [
            'rest' => [
                'resourcePath' => self::RESOURCE_PATH,
                'httpMethod' => \Magento\Framework\Webapi\Rest\Request::HTTP_METHOD_GET,
                'token' => $this->getAccessToken()
            ]
        ];

        try {
            $response = $this->_webApiCall($serviceInfo);
            $this->assertEquals('profitloss', $response[0]['category'], "Practitioner has no available reports");
        } catch (\Exception $e) {
            $this->fail($e);
        }
    }

    /**
     * Get user access token
     * @return $token
     */
    public function getAccessToken()
    {
        $userName = 'daiva1ff3d@example.com';
        $password = 'customer1234';
        $serviceInfo = [
            'rest' => [
                'resourcePath' => "/V1/integration/customer/token",
                'httpMethod' => \Magento\Framework\Webapi\Rest\Request::HTTP_METHOD_POST,
            ],
        ];
        $requestData = ['username' => $userName, 'password' => $password];
        $accessToken = $this->_webApiCall($serviceInfo, $requestData);
        return $accessToken;
    }

}