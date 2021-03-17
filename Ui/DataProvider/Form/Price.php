<?php

namespace ODigital\Price\Ui\DataProvider\Form;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Customer\Api\CustomerRepositoryInterface;
use ODigital\Price\Model\ResourceModel\Collection\Price as Collection;
use ODigital\Price\Model\ResourceModel\Collection\PriceFactory as CollectionFactory;
use Magento\Catalog\Helper\Product as Helper;
use Magento\Ui\DataProvider\AbstractDataProvider;

class Price extends AbstractDataProvider
{
    /**
     * @var Collection
     */
    protected $collection;

    /** @var ProductRepositoryInterface */
    protected $productRepository;

    /** @var CustomerRepositoryInterface */
    protected $customerRepository;

    /** @var Helper */
    protected $helper;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        ProductRepositoryInterface $productRepository,
        CustomerRepositoryInterface $customerRepository,
        Helper $helper,
        array $meta = [],
        array $data = []
    )
    {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $collectionFactory->create();
        $this->productRepository = $productRepository;
        $this->customerRepository = $customerRepository;
        $this->helper = $helper;
    }

    public function getData()
    {

        $data = parent::getData();

        if (isset($data['items'])) {
            $items = [];

            foreach ($data['items'] as $item) {
                $product = $this->productRepository->getById($item['product_id']);
                $customer = $this->customerRepository->getById($item['customer_id']);
                $item['product_name'] = $product->getName();
                $item['product_image'] = $this->helper->getThumbnailUrl($product);
                $item['customer_email'] = $customer->getEmail();
                $items[$item['entity_id']] = $item;
            }

            return $items;
        }

        return $data;
    }
}
