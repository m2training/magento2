<?php

namespace Custom\Demo\Plugin;

use \Wellevate\Logger\Helper\ForceLogger;
use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;

class ExamplePlugin{

     /**
     * @var \Wellevate\Logger\Helper\ForceLogger
     */
    protected $logger;

    /*
     * @param \Wellevate\Logger\Helper\ForceLogger $logger
     */
    public function __construct(
		\Wellevate\Logger\Helper\ForceLogger $logger
	)
	{
        $this->logger = $logger;
        $this->logger->logFileName('EA.log');
    }


    public function afterGet(ProductRepositoryInterface $subject, ProductInterface $productResult){
            $this->addProductMessageExtensionAttributes($productResult);
            return $productResult;
    }
    
    public function addProductMessageExtensionAttributes(ProductInterface $productResult){

       $productExtensionAttributes =  $productResult->getExtensionAttributes();

        $this->logger->log("Before");
        $this->logger->log($productExtensionAttributes->getProductMessage());
        if(null === $productExtensionAttributes->getProductMessage()){

            $productExtensionAttributes->setProductMessage('Product set message');
            $this->logger->log("After");
            $this->logger->log($productExtensionAttributes->getProductMessage());

        }

    }

}
