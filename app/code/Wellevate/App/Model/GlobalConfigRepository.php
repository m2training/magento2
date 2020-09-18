<?php
/**
 * @copyright   © Wellevate, All rights reserved.
 * @namespace   Wellevate
 * @module      App
 * @brief       model implementation for global config interface.
 * @author      Dinesh Arumugam, Elamurugan Nallathambi
 * @email       dinesh.arumugam3@cognizant.com, Elamurugan.Nallathambi@cognizant.com
 * @date        11/16/19
 * @description Fetch the backend global/store configurations and values.
 * @link        #MU-101
 */

namespace Wellevate\App\Model;

use Wellevate\App\Api\GlobalConfigRepositoryInterface;
use Wellevate\App\Helper\Data;

/**
 * Defines the implementation class of the GlobalConfigRepository service contract.
 */
class GlobalConfigRepository implements GlobalConfigRepositoryInterface
{
    /*
     * UI Settings config group prefix
     */
    const SETTINGS_GROUP = 'wellevate_ui';

    /*
     * LOGOS BASE PATH
     */
    const LOGO_BASE_PATH = 'ui/';

    /**
     * @var HelperData
     */
    protected $wellevateHelper;

    /**
     * @var \Magento\Framework\Json\Helper\Data
     */
    protected $jsonHelper;

    /**
     * @param \Wellevate\App\Helper\Data $dataHelper
     * @param \Magento\Framework\Json\Helper\Data $jsonHelper
     */
    public function __construct(Data $dataHelper, \Magento\Framework\Json\Helper\Data $jsonHelper)
    {
        $this->wellevateHelper = $dataHelper;
        $this->jsonHelper = $jsonHelper;
    }

    /**
     * Return the global configuration
     *
     * @return string[] getting global configuration in json.
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @api
     */
    public function getAppGlobalConfig()
    {
        $response = $this->wellevateHelper->getConfig(self::SETTINGS_GROUP);
        if (!isset($response['settings']['media_url']) || !$response['settings']['media_url']) {
            $response['settings']['media_url'] = $this->wellevateHelper->getMediaURL();
        }
        if (!isset($response['settings']['assets_url']) || !$response['settings']['assets_url']) {
            $response['settings']['assets_url'] = $this->wellevateHelper->getAssetURL();
        }

        /*
         * Since Navigation not being used from settings
         */
        /*
        if (isset($response['header']['navigation']) || $response['header']['navigation']) {
            try {
                $response['header']['navigation'] = $this->jsonHelper->jsonDecode($response['header']['navigation']);
            } catch (\Exception $e) {

            }
        }
        */

        if (isset($response['icon'])) {
            $icons = $response['icon'];
            $iconsList = [];
            foreach ($icons as $key => $value) {
                if ($value) {
                    $iconsList[$key] = self::LOGO_BASE_PATH . $value;
                }
            }
            $response['icon'] = $iconsList;
        }
        $response['header']['logo'] = self::LOGO_BASE_PATH . $response['header']['logo'];
        $response['header']['right_logo'] = self::LOGO_BASE_PATH . $response['header']['right_logo'];
        $response['footer']['logo'] = self::LOGO_BASE_PATH . $response['footer']['logo'];
        $apiResponse = [];
        $apiResponse['response'] = $response;
        return $apiResponse;
    }
}
