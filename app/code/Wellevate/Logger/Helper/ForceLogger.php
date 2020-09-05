<?php
/**
 * @copyright   © Wellevate, All rights reserved.
 * @namespace   Wellevate
 * @module      Logger
 * @brief       System Log/Report files viewer
 * @author      Elamurugan Nallathambi
 * @email       Elamurugan.Nallathambi@cognizant.com
 * @date        12/15/19
 * @description General Logger Class to use across other modules, this works even if logging is disabled in system level
 * @link        #MU-310
 */

namespace Wellevate\Logger\Helper;

class ForceLogger extends \Wellevate\Logger\Helper\Logger
{
    /**
     * @var \Zend\Log\Logger
     */
    protected $logger;

    /**
     * @param \Psr\Log\LoggerInterface $logger
     * @param \Magento\Framework\App\Filesystem\DirectoryList $dir
     */
    public function __construct(
        \Psr\Log\LoggerInterface $logger,
        \Magento\Framework\App\Filesystem\DirectoryList $dir
    )
    {
        parent::__construct($logger, $dir);
        $this->initLogger();
    }

    /**
     * @param string $fileName
     *
     * @return null
     */
    public function initLogger($fileName = '')
    {
        if (!$fileName) {
            $fileName = $this->logFileName;
        }
        $writer = new \Zend\Log\Writer\Stream($this->dir->getRoot() . '/var/log/' . $fileName);
        $this->logger = new \Zend\Log\Logger();
        $this->logger->addWriter($writer);
    }

    /**
     * @param string $fileName
     *
     * @return null
     */
    public function logFileName($fileName = 'wellevate.log')
    {
        if ($this->logFileName !== $fileName) {
            $this->logFileName = $fileName;
            $this->initLogger();
        }
        return $this;
    }
}
