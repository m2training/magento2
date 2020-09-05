<?php
/**
 * @copyright   © Wellevate, All rights reserved.
 * @namespace   Wellevate
 * @module      Logger
 * @brief       System Log/Report files viewer
 * @author      Elamurugan Nallathambi
 * @email       Elamurugan.Nallathambi@cognizant.com
 * @date        12/15/19
 * @description Log/report Helper functions
 * @link        #MU-310
 */

namespace Wellevate\Logger\Helper;

use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;

class Data extends AbstractHelper
{
    /**
     * @var DirectoryList
     */
    protected $directoryList;

    /**
     * @var string : To define magento root directory
     */
    protected $magentoRoot = '';

    public function __construct(
        Context $context,
        DirectoryList $directoryList
    )
    {
        $this->directoryList = $directoryList;
        $this->magentoRoot = $this->directoryList->getRoot();
        parent::__construct(
            $context
        );
    }

    /**
     * @return string
     */
    public function getPath($dir)
    {
        $path = $this->magentoRoot . DIRECTORY_SEPARATOR . 'var' . DIRECTORY_SEPARATOR . $dir . DIRECTORY_SEPARATOR;
        return $path;
    }

    /**
     * @return array
     */
    protected function getLogReportFiles($dirPath)
    {
        $scannedFiles = [];
        $path = $this->getPath($dirPath);
        if (is_dir($path)) {
            $scannedFiles = scandir($path);
        }
        return $scannedFiles;
    }

    /**
     * @param $bytes
     * @param int $precision
     * @return string
     */
    protected function filesizeToReadableString($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        $bytes /= pow(1024, $pow);

        return round($bytes, $precision) . ' ' . $units[$pow];
    }

    /**
     * @return array
     */
    public function buildLogReportDataFilesList($dirPath)
    {
        $maxNumOfFiles = 50;
        $logFileData = [];
        $path = $this->getPath($dirPath);
        $files = $this->getLogReportFiles($dirPath);

        if ($files && count($files)) {
            //remove rubbish from array
            array_splice($files, 0, 2);
            //build log data into array
            foreach ($files as $file) {
                if (is_file($path . $file)) {
                    $logFileData[$file]['name'] = $file;
                    $logFileData[$file]['filesize'] = $this->filesizeToReadableString((filesize($path . $file)));
                    $logFileData[$file]['modTime'] = filemtime($path . $file);
                    $logFileData[$file]['modTimeLong'] = date("F d Y H:i:s.", filemtime($path . $file));
                }
            }

            //sort array by modified time
            usort($logFileData, function ($item1, $item2) {
                return $item2['modTime'] <=> $item1['modTime'];
            });

            //limit the amount of log data $maxNumOfFiles
            $logFileData = array_slice($logFileData, 0, $maxNumOfFiles);
        }
        return $logFileData;
    }

    public function getLastLinesOfFile($fileName, $dirPath, $numOfLines)
    {
        $path = $this->getPath($dirPath);
        $fullPath = $path . $fileName;
        exec('tail -' . $numOfLines . ' ' . $fullPath, $output);
        return implode("\n",$output);
    }
}
