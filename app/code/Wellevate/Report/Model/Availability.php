<?php

/**
 * @copyright   © Wellevate, All rights reserved.
 * @namespace   Wellevate
 * @module      Report
 * @brief       to fetch Available report details
 * @author      Balakrishnan S
 * @email       balakrishnan.s4@cognizant.com
 * @date        01/17/2019
 * @description  Availability Model
 * @link        #MU-605
 */

namespace Wellevate\Report\Model;
/**
 * Class Availability
 * @package Wellevate\Report\Model
 */
class Availability extends \Magento\Framework\Model\AbstractModel
{
    /**
     * @var array
     */
    private $reportNameFormat = [
        'profitloss' => [
            'invoice_crossyear' => '{{year}} Invoices Cash Collected In {{next_year}}'
        ]
    ];

    /**
     * Availability constructor.
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Model\ResourceModel\AbstractResource|null $resource
     * @param \Magento\Framework\Data\Collection\AbstractDb|null $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = []
    )
    {
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);

        $this->_init('Wellevate\Report\Model\ResourceModel\Availability');
    }


    /**
     * @return mixed
     */
    public function getReportName()
    {
        $category = $this->getCategory();
        $type = $this->getType();

        $format = (isset($this->reportNameFormat[$category][$type]))
            ? $this->reportNameFormat[$category][$type]
            : '{{year}} {{month}} ' . $category . '-' . $type;

        list($year, $month, $day) = explode('-', $this->getDate());

        switch ((int)$month) {
            case 1:
                $quarter = 'Q1';
                break;
            case 4:
                $quarter = 'Q2';
                break;
            case 7:
                $quarter = 'Q3';
                break;
            case 11:
                $quarter = 'Q4';
                break;
        }

        $data = [
            'year' => $year,
            'month' => $month,
            'next_year' => $year + 1,
            'quarter' => $quarter,
            'day' => $day
        ];

        return $this->substitutePlaceholders($format, $data);
    }

    /**
     * @param $template
     * @param $data
     * @return mixed
     */
    public function substitutePlaceholders($template, $data)
    {
        $placeholders = array_keys($data);
        foreach ($placeholders as &$placeholder) {
            $placeholder = '{{' . $placeholder . '}}';
        }

        return str_replace($placeholders, array_values($data), $template);
    }

    /**
     * @return array
     */
    public function toPublicArray()
    {
        $record = [
            'category' => $this->getCategory(),
            'type' => $this->getType(),
            'iteration' => $this->getIteration(),
            'date' => $this->getDate(),
            'file_id' => $this->getFileId(),
            'file_path' => $this->getFilePath(),
            'report_name' => $this->getReportName()
        ];

        return $record;
    }

}
