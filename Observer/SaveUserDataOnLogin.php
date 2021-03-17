<?php

namespace ODigital\Price\Observer;

use Magento\Customer\Model\Logger;
use Magento\Framework\Session\StorageInterface;
use Magento\Framework\Stdlib\DateTime;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class SaveUserDataOnLogin implements ObserverInterface
{
    /** @var \Magento\Customer\Model\Session */
    protected $storage;

    public function __construct(\Magento\Customer\Model\Session\Storage  $storage)
    {
        $this->storage = $storage;
    }

    public function execute(Observer $observer)
    {
        $customer = $observer->getData('customer');
        $storage = $this->storage;
        $storage->setData('front_user_id', $customer->getId());
    }
}
