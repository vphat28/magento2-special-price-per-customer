<?php

namespace ODigital\Price\Provider;

use ODigital\Price\Model\ResourceModel\Price as ResourceModel;
use ODigital\Price\Model\PriceFactory;
use ODigital\Price\Model\ResourceModel\Collection\PriceFactory as CollectionFactory;

class SpecialPrice
{
    /** @var array */
    protected $priceList;

    public function __construct(
        PriceFactory $priceFactory,
        ResourceModel $resourceModel,
        \Magento\Customer\Model\SessionFactory $customerSession,
        CollectionFactory $collectionFactory
    ) {
        $this->priceFactory      = $priceFactory;
        $this->resourceModel     = $resourceModel;
        $this->collectionFactory = $collectionFactory;
        $this->customerSession   = $customerSession;
    }

    public function getSpecialPrice($productId, $customerId = null) {
        $priceList = &$this->priceList;
        $customer = $this->customerSession->create();

        if (empty($customerId)) {
            $customerId = $customer->getId();
        }

        if (empty($customerId)) {
            return null;
        }

        if (isset($priceList[$customerId]) && isset($priceList[$customerId][$productId])) {
            return $priceList[$customerId][$productId];
        }
        /** @var \ODigital\Price\Model\ResourceModel\Collection\Price $collection */
        $collection = $this->collectionFactory->create();
        $collection->addFieldToFilter('customer_id', $customerId);
        $collection->addFieldToFilter('product_id', $productId);

        foreach ($collection as $item) {
            $specialPrice = $item->getData('value');
        }

        if (isset($specialPrice)) {
            if (!isset($priceList[$customerId])) {
                $priceList[$customerId] = [];
            }
            $priceList[$customerId][$productId] = $specialPrice;
            return $specialPrice;
        }

        return null;
    }
}
