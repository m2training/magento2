<?php
/**
 * @copyright   © Wellevate, All rights reserved.
 * @namespace   Wellevate
 * @module      Logger
 * @brief       System Log/Report files viewer
 * @author      Elamurugan Nallathambi
 * @email       Elamurugan.Nallathambi@cognizant.com
 * @date        12/15/19
 * @description Log/report files List Block
 * @link        #MU-310
 */

namespace Wellevate\Logger\Block;

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

    public function getSystemFiles($path = 'log')
    {
        return $this->logDataHelper->buildLogReportDataFilesList($path);
    }

    public function downloadSystemFile($fileName, $dirPath)
    {
        return $this->getUrl('logger/download/getfile', [$fileName, $dirPath]);
    }

    public function previewSystemFile($fileName, $dirPath)
    {
        return $this->getUrl('logger/view/index', [$fileName, $dirPath]);
    }
}
