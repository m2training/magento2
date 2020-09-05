<?php
/**
 * @copyright   © Wellevate, All rights reserved.
 * @namespace   Wellevate
 * @module      Logger
 * @brief       System Log/Report files viewer
 * @author      Elamurugan Nallathambi
 * @email       Elamurugan.Nallathambi@cognizant.com
 * @date        12/15/19
 * @description Log/report file View Controller
 * @link        #MU-310
 */

namespace Wellevate\Logger\Controller\Adminhtml\View;

class Index extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * Constructor
     *
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $this->_view->loadLayout();
        $this->_setActiveMenu('Wellevate_App::wellevate');
        $this->_view->getPage()->getConfig()->getTitle()->prepend(__('View Log/Report'));
        $this->_view->renderLayout();
    }
}
