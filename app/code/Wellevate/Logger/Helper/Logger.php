<?php
/**
 * @copyright   © Wellevate, All rights reserved.
 * @namespace   Wellevate
 * @module      Logger
 * @brief       System Log/Report files viewer
 * @author      Elamurugan Nallathambi
 * @email       Elamurugan.Nallathambi@cognizant.com
 * @date        12/15/19
 * @description General Logger Class to use across other modules
 * @link        #MU-310
 */

namespace Wellevate\Logger\Helper;

class Logger
{
    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * @var \Magento\Framework\App\Filesystem\DirectoryList
     */
    protected $dir;

    /**
     * @var string
     */
    public $logFileName = 'wellevate.log';

    /**
     * @var bool
     */
    public $logEnabled = true;

    /**
     * @param \Psr\Log\LoggerInterface $logger
     * @param \Magento\Framework\App\Filesystem\DirectoryList $dir
     */
    public function __construct(
        \Psr\Log\LoggerInterface $logger,
        \Magento\Framework\App\Filesystem\DirectoryList $dir
    ) {
        $this->logger = $logger;
        $this->dir = $dir;
        $this->logFileName($this->logFileName);
    }

    /**
     * @param string $fileName
     *
     * @return null
     */
    public function logFileName($fileName = 'wellevate.log')
    {
        $this->logFileName = $fileName;
        $this->logger->pushHandler(
            new \Monolog\Handler\StreamHandler($this->dir->getRoot() . '/var/log/' . $this->logFileName)
        );
    }

    /**
     * @param mixed $data
     * @param string $logMethod [info, emergency, alert, critical, error, warning, notice, log]
     * @param bool $force
     * @return void
     */
    public function log($data, $logMethod = 'info', $force = false)
    {
        if ($this->logEnabled || $force) {
            $this->logger->info($data);
        }
    }
}
