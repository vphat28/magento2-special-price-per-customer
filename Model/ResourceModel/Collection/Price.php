<?php

namespace ODigital\Price\Model\ResourceModel\Collection;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use ODigital\Price\Model\Price as EntityModel;
use ODigital\Price\Model\ResourceModel\Price as ResourceModel;

class Price extends AbstractCollection
{
    /**
     * Resource initializations
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(EntityModel::class, ResourceModel::class);
    }

}
