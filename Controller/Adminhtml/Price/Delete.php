<?php

namespace ODigital\Price\Controller\Adminhtml\Price;

use Magento\Framework\Controller\ResultFactory;
use ODigital\Price\Model\Price;
use ODigital\Price\Model\ResourceModel\Price as ResourceModel;
use ODigital\Price\Model\PriceFactory;

class Delete extends \Magento\Backend\App\Action
{
    protected $resultFactory = false;

    /** @var PriceFactory */
    protected $priceFactory;

    /** @var ResourceModel */
    protected $resourceModel;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        ResultFactory $resultFactory,
        PriceFactory $priceFactory,
        ResourceModel $resourceModel
    )
    {
        parent::__construct($context);
        $this->resultFactory = $resultFactory;
        $this->priceFactory = $priceFactory;
        $this->resourceModel = $resourceModel;
    }

    public function execute()
    {
        $selected = $this->_request->getParam('selected');

        foreach ($selected as $id) {
            /** @var Price $price */
            $price = $this->priceFactory->create();
            $this->resourceModel->load($price, $id);
            $this->resourceModel->delete($price);
        }

        $result = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

        return $result->setPath('*/price/');
    }


}
