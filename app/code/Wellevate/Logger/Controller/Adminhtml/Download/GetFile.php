<?php
/**
 * @copyright   © Wellevate, All rights reserved.
 * @namespace   Wellevate
 * @module      Logger
 * @brief       System Log/Report files viewer
 * @author      Elamurugan Nallathambi
 * @email       Elamurugan.Nallathambi@cognizant.com
 * @date        12/15/19
 * @description Log/report file Download Controller
 * @link        #MU-310
 */

namespace Wellevate\Logger\Controller\Adminhtml\Download;

use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Response\Http\FileFactory;
use Magento\Framework\Exception\NotFoundException;
use Zend_Filter_BaseName;

class GetFile extends \Magento\Backend\App\Action
{
    /**
     * @var FileFactory
     */
    protected $fileFactory;

    public function __construct(Context $context, FileFactory $fileFactory)
    {
        $this->fileFactory = $fileFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $param = $this->getRequest()->getParams();
        $filePath = $this->getFilePathWithFile($param[0], $param[1]);

        $filter = new Zend_Filter_BaseName();
        $fileName = $filter->filter($filePath);
        try {
            return $this->fileFactory->create(
                $fileName,
                [
                    'type' => 'filename',
                    'value' => $filePath
                ]
            );
        } catch (\Exception $e) {
            throw new NotFoundException(__($e->getMessage()));
        }
    }

    /**
     * @param $filename
     * @return string
     */
    protected function getFilePathWithFile($fileName, $dirPath = 'log')
    {
        $path = DIRECTORY_SEPARATOR . 'var' . DIRECTORY_SEPARATOR . $dirPath . DIRECTORY_SEPARATOR;
        return $path . $fileName;
    }
}
