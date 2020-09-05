<?php
/**
 * @copyright   © Wellevate, All rights reserved.
 * @namespace   Wellevate
 * @module      Logger
 * @brief       System Log/Report files viewer
 * @author      Elamurugan Nallathambi
 * @email       Elamurugan.Nallathambi@cognizant.com
 * @date        12/15/19
 * @description Log/report file View Block
 * @link        #MU-310
 */

namespace Wellevate\Logger\Block\View;

class Index extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Wellevate\Logger\Helper\Data
     */
    protected $logDataHelper;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Wellevate\Logger\Helper\Data $logDataHelper
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Wellevate\Logger\Helper\Data $logDataHelper,
        array $data = []
    )
    {
        $this->logDataHelper = $logDataHelper;
        parent::__construct($context, $data);
    }

    public function getContentFromSystemFile()
    {
        $params = $this->_request->getParams();
        return $this->logDataHelper->getLastLinesOfFile($params[0], $params[1], 1000);
    }

    public function getFileName()
    {
        $params = $this->_request->getParams();
        return $params[0];
    }

    public function downloadFile()
    {
        $params = $this->_request->getParams();
        return $this->getUrl('logger/download/getfile', [$params[0], $params[1]]);
    }
}
