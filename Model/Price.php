<?php

namespace ODigital\Price\Model;

use ODigital\Price\Model\ResourceModel\Price as ResourceModel;

class Price extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Initialize resources
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }
}
