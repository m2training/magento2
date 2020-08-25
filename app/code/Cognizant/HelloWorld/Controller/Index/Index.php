<?php
/**
 *
 * @package     magento2
 * @author      Cognizant Technologies
 * @license     https://opensource.org/licenses/OSL-3.0 Open Software License v. 3.0 (OSL-3.0)
 * @link        https://www.Cognizant.com/
 */

namespace Cognizant\HelloWorld\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action {
    /**
     * @var PageFactory
     */
    private $pageFactory;

    protected $_cdFactory;

    /**
     * Index constructor.
     * @param Context $context
     * @param PageFactory $pageFactory
     */
    public function __construct(
        Context $context,
        \Cognizant\HelloWorld\Model\Contactdetails $cdFactory,
        PageFactory $pageFactory
    )
    {
        parent::__construct($context);
        $this->_cdFactory = $cdFactory;
        $this->pageFactory = $pageFactory;
    }


    /**
     * Execute action based on request and return result
     *
     * Note: Request will be added as operation argument in future
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
        $page = $this->pageFactory->create();

        $model = $this->_cdFactory->create();
		$model->addData([
			"customer_Name" => 'Title 01',
			"customer_email" => 'Content 01',
			"contact_no" => '9999999991'			
            ]);
            
        $saveData = $model->save();
        if($saveData){
            $this->messageManager->addSuccess( __('Insert Record Successfully !') );
        }
        return $page;
    }
}


















