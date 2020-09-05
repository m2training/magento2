<?php
/**
 * @copyright   © Wellevate, All rights reserved.
 * @namespace   Wellevate
 * @module      Logger
 * @brief       Customer log event Grid
 * @author      Aditya
 * @email       aditya.singh6@cognizant.com
 * @date        01/014/20
 * @description Customer MassDelete from Grid
 * @link        #MU-476
 */

namespace Wellevate\Logger\Controller\Adminhtml\Logevent;

use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\ResponseInterface;
use Wellevate\Logger\Model\ResourceModel\Logevent\CollectionFactory;

class MassDelete extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Ui\Component\MassAction\Filter
     */
    protected $filter;

    /**
     * @var \Wellevate\Logger\Model\ResourceModel\Logevent\CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @param Context $context
     * @param Filter $filter
     * @param \Wellevate\Logger\Model\ResourceModel\Logevent\CollectionFactory $collectionFactory
     */
    public function __construct(Context $context, Filter $filter, CollectionFactory $collectionFactory)
    {
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context);
    }

    /**
     * Dispatch request
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
        $collection = $this->filter->getCollection($this->collectionFactory->create());
        $collectionSize = $collection->getSize();

        foreach ($collection as $item) {
            $item->delete();
        }

        $this->messageManager->addSuccess(__('A total of %1 logs have been deleted.', $collectionSize));

        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/');
    }
}
