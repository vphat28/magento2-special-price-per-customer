<?php

namespace ODigital\Price\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Price extends AbstractDb
{
    /**
     * @var array
     */
    protected $_uniqueFields = array();

    /**
     * Define main table
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('odigital_special_price', 'entity_id');
    }
}
