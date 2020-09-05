<?php
/**
 * @copyright   © Wellevate, All rights reserved.
 * @namespace   Wellevate
 * @module      Logger
 * @brief       Customer Logger Render
 * @author      Aditya
 * @email       aditya.singh6@cognizant.com
 * @date        01/07/20
 * @description Logger render Profession
 * @link        #MU-476
 */

namespace Wellevate\Logger\Model\Action\Logger\Renderer;

use Wellevate\Practitioner\Model\ResourceModel\PractitionerType\CollectionFactory;

class Profession implements \Wellevate\Logger\Model\Action\Logger\Renderer\LoggerInterface
{

    protected $practitionerTypeCollectionFactory;
    protected $professions;

    /**
     * @param CollectionFactory $practitionerTypeCollectionFactory
     */
    public function __construct(CollectionFactory $practitionerTypeCollectionFactory)
    {
        $this->practitionerTypeCollectionFactory = $practitionerTypeCollectionFactory;
    }

    /**
     * @param $value
     * @return string
     */
    public function render($value)
    {
        if (empty($this->professions)) {
            $this->professions = $this->practitionerTypeCollectionFactory->create();
        }

        $profession = $this->professions->getItemByColumnValue('type', $value);
        if (!$profession) {
            return 'n/a';
        }
        return $profession->getName();
    }
}
