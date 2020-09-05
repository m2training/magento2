<?php
/**
 * @copyright   © Wellevate, All rights reserved.
 * @namespace   Wellevate
 * @module      Logger
 * @brief       Customer Log Event
 * @author      Aditya
 * @email       aditya.singh6@cognizant.com
 * @date        01/07/20
 * @description Logger model
 * @link        #MU-476
 */

namespace Wellevate\Logger\Model\Action;

use Magento\Customer\Model\CustomerFactory;
use Magento\Authorization\Model\UserContextInterface;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\InputException;
use Magento\Framework\Phrase;

class Logger
{

    protected $customerFactory;
    protected $logeventFactory;
    protected $userContext;
    protected $date;
    protected $_objectDataBefore = [];
    protected $_isActive;
    protected $_renderers;
    protected $_logger;
    protected $_noScopeFields = [];
    protected $loggdata;
    protected $authSession;
    protected $defaultcase;
    protected $opted;
    protected $password;
    protected $percent;
    protected $profession;
    protected $region;
    protected $regionCode;

    const COLUMN_FILE = 'file';
    const COLUMN_FIELD = 'field';
    const OPERATION_CREATE = 'Created Entry';
    const OPERATION_UPDATE = 'Updated Entry';
    const OPERATION_REMOVE = 'Removed Entry';
    const CHANGED_BY_ADMIN = 'CSA';
    const CHANGED_BY_CUSTOMER = 'Customer';

    /**
     *
     * @param CustomerFactory $customerFactory
     * @param \Wellevate\Logger\Model\LogeventFactory $logeventFactory
     * @param UserContextInterface $userContext
     * @param \Magento\Backend\Model\Auth\Session $authSession
     * @param \Magento\Framework\Stdlib\DateTime\DateTime $date
     * @param \Psr\Log\LoggerInterface $loggdata
     * @param \Wellevate\Logger\Model\Action\Logger\Renderer\Defaultcase $defaultcase
     * @param \Wellevate\Logger\Model\Action\Logger\Renderer\Opted $opted
     * @param \Wellevate\Logger\Model\Action\Logger\Renderer\Password $password
     * @param \Wellevate\Logger\Model\Action\Logger\Renderer\Percent $percent
     * @param \Wellevate\Logger\Model\Action\Logger\Renderer\Profession $profession
     * @param \Wellevate\Logger\Model\Action\Logger\Renderer\Region $region
     * @param \Wellevate\Logger\Model\Action\Logger\Renderer\RegionCode $regionCode
     */
    public function __construct(
        CustomerFactory $customerFactory,
        \Wellevate\Logger\Model\LogeventFactory $logeventFactory,
        UserContextInterface $userContext,
        \Magento\Backend\Model\Auth\Session $authSession,
        \Magento\Framework\Stdlib\DateTime\DateTime $date,
        \Psr\Log\LoggerInterface $loggdata,
        \Wellevate\Logger\Model\Action\Logger\Renderer\Defaultcase $defaultcase,
        \Wellevate\Logger\Model\Action\Logger\Renderer\Opted $opted,
        \Wellevate\Logger\Model\Action\Logger\Renderer\Password $password,
        \Wellevate\Logger\Model\Action\Logger\Renderer\Percent $percent,
        \Wellevate\Logger\Model\Action\Logger\Renderer\Profession $profession,
        \Wellevate\Logger\Model\Action\Logger\Renderer\Region $region,
        \Wellevate\Logger\Model\Action\Logger\Renderer\RegionCode $regionCode
    )
    {
        $this->customerFactory = $customerFactory;
        $this->logeventFactory = $logeventFactory;
        $this->userContext = $userContext;
        $this->authSession = $authSession;
        $this->date = $date;
        $this->defaultcase = $defaultcase;
        $this->opted = $opted;
        $this->password = $password;
        $this->percent = $percent;
        $this->profession = $profession;
        $this->region = $region;
        $this->regionCode = $regionCode;
        $this->loggdata = $loggdata;
    }

    /**
     * @param  $field
     * @param  $renderer
     * @param AbstractModel $object
     */
    public function observeField($field, $renderer, AbstractModel $object)
    {
        foreach ($field as $key => $label) {
            $props = [
                'label' => $label,
                'column' => self::COLUMN_FIELD
            ];

            if (isset($renderer[$key])) {
                $props['renderer'] = $renderer[$key];
            }
            $this->_setObjectDataBefore($object, $key, $props);
        }
    }

    /**
     * @param  $field
     * @param AbstractModel $object
     */
    public function ignoreField($field, AbstractModel $object)
    {
        foreach ($field as $key) {
            $hash = $this->_ensureObjectDataBeforeExists($object);
            if (isset($this->_objectDataBefore[$hash][$key])) {
                unset($this->_objectDataBefore[$hash][$key]);
            }
        }
    }

    /**
     * @param $field
     * @param $label
     * @param $object
     */
    public function observeFile($field, $label, AbstractModel $object)
    {
        foreach ($field as $key => $label) {
            $props = [
                'label' => $label,
                'column' => self::COLUMN_FILE
            ];

            if (isset($renderer[$key])) {
                $props['renderer'] = $renderer[$key];
            }

            $this->_setObjectDataBefore($object, $key, $props);
        }
    }

    /**
     * @param AbstractModel $object
     * @param null $scope
     */
    public function logChanges(AbstractModel $object, $scope = null)
    {
        if ($object->getData('is_logged')) {
            return;
        }

        $objects = $object->getData();
        foreach ($this->_getObjectDataBefore($object) as $field => &$data) {

            $operation = self::OPERATION_CREATE;
            if (!$object->isObjectNew()) {
                $operation = self::OPERATION_UPDATE;
                $newValue = $object->getData($field);

                if (!isset($newValue)) {
                    $operation = self::OPERATION_REMOVE;
                }
            }
            if (!$object->hasData('magento_customer_id')) {
                throw new NoSuchEntityException(__('customer id does not exist.'));
            }
            $additionalInformation = [
                'magento_customer_id' => $object->getData('magento_customer_id'),
                'scope' => (!in_array($field, $this->_noScopeFields)) ? $scope : null
            ];

            $this->_logOperation($operation, $field, $data, $object, $additionalInformation);
        }

        $object->setData('is_logged', true);
    }

    /**
     * @param AbstractModel $object
     */
    public function logDeletion(AbstractModel $object)
    {
        foreach ($this->_getObjectDataBefore($object) as $field => &$data) {
            $this->_logOperation(self::OPERATION_REMOVE, $field, $data, null);
        }
    }

    /**
     * @param  $operation
     * @param  $field
     * @param  $data
     * @param AbstractModel $object
     * @param array $additionalInformation
     */
    protected function _logOperation(
        $operation,
        $field,
        &$data,
        $object,
        $additionalInformation = []
    )
    {
        $origValue = $object->getOrigData($field);
        $newValue = $object->getData($field);

        if ($origValue == $newValue) { // if old value = new value, nothing to log
            return;
        }

        // TODO can be converted to log object - log goes from parent and we don't use references
        $entry = [
            'operation' => $operation,
            'created_at' => $this->date->gmtDate('Y-m-d H:i:s'),
            'field_name' => $field,
            'field_type' => 'field'
        ];

        if (!empty($additionalInformation['magento_customer_id'])) {
            $entry['magento_customer_id'] = $additionalInformation['magento_customer_id'];
        }

        if (!empty($additionalInformation['scope'])) {
            $entry['scope'] = $additionalInformation['scope'];
        }

        $this->_appendChangedByToEntry($entry);

        $this->_appendChangedDataToEntry($data, $origValue, $newValue, $entry);

        if (!$origValue && $newValue == "0") {
            return;
        }

        try {
            $logresult = $this->logeventFactory->create()->setData($entry)->save();
        } catch (\Magento\Framework\Exception\CouldNotSaveException $e) {
            $this->loggdata->critical($e->getMessage());
        } catch (\RuntimeException $e) {
            $this->loggdata->critical($e->getMessage());
        } catch (\Exception $e) {
            $this->loggdata->critical($e->getMessage());
        }
    }

    /**
     * @param $entry
     * @return $this
     */
    protected function _appendChangedByToEntry(&$entry)
    {
        // first try to get logged as later admin
        $changedBy = self::CHANGED_BY_ADMIN;
        $username = $this->_getAdminUsername();

        if (!$username) {
            $changedBy = self::CHANGED_BY_CUSTOMER;
            $username = $this->getCustomer()->getEmail();
        }

        $entry['changed_by'] = $changedBy;
        $entry['user'] = $username;

        return $this;
    }

    /**
     * @param $data
     * @param $newValue
     * @param $entry
     * @return $this
     */
    protected function _appendChangedDataToEntry(
        &$data,
        $oldValue,
        &$newValue,
        &$entry
    )
    {
        $entry['field_name'] = $data['label'];

        if (!isset($data['renderer'])) {
            $data['renderer'] = 'defaultcase';
        }

        $renderer = $this->_getRenderer($data['renderer']);
        $columnBefore = 'value_before';
        $columnAfter = 'value_after';
        $entry[$columnBefore] = $renderer->render($oldValue);
        $entry[$columnAfter] = $renderer->render($newValue);
        return $this;
    }

    /**
     * Customer Session Object
     * @return \Magento\Customer\Model\Customer
     */
    protected function getCustomer()
    {
        $customer = $this->customerFactory->create()->load($this->userContext->getUserId());
        return $customer;
    }

    /**
     * @return mixed
     */
    protected function _getAdminUsername()
    {
        $username = '';
        if ($this->authSession->getUser()) {
            $username = $this->authSession->getUser()->getUsername();
        }

        if (!$username && $this->_getAdminSession() && $this->_getAdminSession()->getUser()) {
            $username = $this->_getAdminSession()->getUser()->getEmail();
        }

        return $username;
    }

    /**
     * @param $object
     *
     * @return mixed
     */
    protected function _getObjectDataBefore($object)
    {
        $hash = $this->_ensureObjectDataBeforeExists($object);

        return $this->_objectDataBefore[$hash];
    }

    /**
     * @param $object
     * @param $field
     * @param $value
     */
    protected function _setObjectDataBefore($object, $field, $value)
    {
        $hash = $this->_ensureObjectDataBeforeExists($object);
        $this->_objectDataBefore[$hash][$field] = $value;
    }

    /**
     * @param $object
     *
     * @return string
     */
    protected function _ensureObjectDataBeforeExists($object)
    {

        $hash = spl_object_hash($object);
        if (!array_key_exists($hash, $this->_objectDataBefore)) {
            $this->_objectDataBefore[$hash] = [];
        }
        return $hash;
    }

    /**
     * @return AbstractModel
     */
    protected function _getAdminSession()
    {
        return $this->authSession;
    }

    /**
     * @param string $rendererType *
     * @return mixed
     */
    protected function _getRenderer($rendererType = 'defaultcase')
    {
        if (!isset($renderer[$rendererType])) {
            switch ($rendererType) {
                case "opted":
                    $renderer = $this->opted;
                    break;
                case "password":
                    $renderer = $this->password;
                    break;
                case "percent":
                    $renderer = $this->percent;
                    break;
                case "profession":
                    $renderer = $this->profession;
                    break;
                case "region":
                    $renderer = $this->region;
                    break;
                case "regionCode":
                    $renderer = $this->regionCode;
                    break;
                default:
                    $renderer = $this->defaultcase;
            }

            if (!$renderer) {
                throw new InputException(new Phrase('Invalid renderer.'));
            }

            $this->_renderers[$rendererType] = $renderer;
        }

        return $this->_renderers[$rendererType];
    }

    public function setNoScopeFields($fields)
    {
        $this->_noScopeFields = $fields;
    }

    
    
}
