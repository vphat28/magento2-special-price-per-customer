<?php

namespace ODigital\Price\Controller\Adminhtml\Price;

use Magento\Framework\Controller\ResultFactory;
use ODigital\Price\Model\Price;
use ODigital\Price\Model\ResourceModel\Price as ResourceModel;
use ODigital\Price\Model\PriceFactory;

class Save extends \Magento\Backend\App\Action
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
        $request = $this->_request->getParams();
        $result = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

        try {
            /** @var Price $price */
            $price = $this->priceFactory->create();
            $price->setData($request);
            $this->resourceModel->save($price);
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        }

        if (empty($this->_request->getParam('id'))) {
            return $result->setPath('*/price/');
        } else {
            return $result->setPath('*/price/edit/', ['id' => $price->getId()]);
        }
    }


}
