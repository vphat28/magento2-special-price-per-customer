<?php

namespace ODigital\Price\Ui\DataProvider;

use ODigital\Price\Model\ResourceModel\Collection\Price as Collection;
use ODigital\Price\Model\ResourceModel\Collection\PriceFactory as CollectionFactory;
use Magento\Ui\DataProvider\AbstractDataProvider;

class Price extends AbstractDataProvider
{
    /**
     * @var Collection
     */
    protected $collection;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    )
    {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $collectionFactory->create();
    }
}
