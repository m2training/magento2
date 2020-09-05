<?php
/**
 * @copyright   © Wellevate, All rights reserved.
 * @namespace   Wellevate
 * @module      Logger
 * @brief       System Log/Report files viewer
 * @author      Elamurugan Nallathambi
 * @email       Elamurugan.Nallathambi@cognizant.com
 * @date        12/15/19
 * @description Log/report files List Controller
 * @link        #MU-310
 */

namespace Wellevate\Logger\Controller\Adminhtml\Grid;

class Index extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var \Wellevate\Logger\Helper\Logger
     */
    protected $logger;

    /**
     * @var \Wellevate\Logger\Helper\ForceLogger
     */
    protected $forceLogger;

    /**
     * Constructor
     *
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Wellevate\Logger\Helper\Logger $logger
     * @param \Wellevate\Logger\Helper\ForceLogger $forceLogger
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Wellevate\Logger\Helper\ForceLogger $forceLogger
    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->forceLogger = $forceLogger;
    }

    /**
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        /** Example of how logger classes can be used
         */
//        $this->forceLogger->initLogger('custom.log');
//        $this->forceLogger->initLogger('Log testing');
//        $this->forceLogger->initLogger('Log testing', 'error');

        $this->_view->loadLayout();
        $this->_setActiveMenu('Wellevate_App::wellevate');
        $this->_view->getPage()->getConfig()->getTitle()->prepend(__('System Log/Report Manager'));
        $this->_view->renderLayout();
    }
}
