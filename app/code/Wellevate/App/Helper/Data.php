<?php
/**
 * @copyright   © Wellevate, All rights reserved.
 * @namespace   Wellevate
 * @module      App
 * @brief       Class to retrieve backend configurations
 * @author      Dinesh Arumugam
 * @email       dinesh.arumugam3@cognizant.com
 * @date        11/16/19
 * @description Helper class to fetch the backend global/store configurations
 * @link        #MU-101
 */

namespace Wellevate\App\Helper;

use Magento\Framework\App\Helper\Context;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Store\Model\StoreManagerInterface;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{

    /* @var StoreManagerInterface */
    protected $_storeManager;

    protected $_scopeConfig;

    /**
     * @param Context $context
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        Context $context,
        StoreManagerInterface $storeManager
    )
    {
        $this->_scopeConfig = $context->getScopeConfig();
        $this->_storeManager = $storeManager;
        parent::__construct($context);
    }

    /**
     * To Get System config per store
     * @param string $field
     * @param integer $storeId
     * @return string
     * @throws NoSuchEntityException
     */
    public function getConfig($field, $storeId = null)
    {
        return $this->_scopeConfig->getValue(
            $field,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $this->_storeManager->getStore($storeId)
        );
    }

    /**
     * Method to get the Media URL
     */
    public function getMediaURL()
    {
        return $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
    }

    /**
     * Method to get the Media URL
     */
    public function getAssetURL()
    {
        return $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_STATIC);
    }
}
