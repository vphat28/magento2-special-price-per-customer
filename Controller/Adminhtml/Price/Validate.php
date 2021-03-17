<?php

namespace ODigital\Price\Controller\Adminhtml\Price;

use Magento\Framework\Controller\ResultFactory;
use ODigital\Price\Model\Price;
use ODigital\Price\Model\PriceFactory;
use Magento\Framework\DataObject;

class Validate extends \Magento\Backend\App\Action
{
    protected $resultPageFactory = false;

    /** @var PriceFactory */
    protected $priceFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        PriceFactory $priceFactory
    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->priceFactory = $priceFactory;
    }

    public function execute()
    {
        $response = new DataObject();
        $response->setData('error', false);
        $request = $this->_request->getParams();

        if (!empty($request['start_date']) && !empty($request['end_date'])) {
            if (strtotime($request['start_date']) > strtotime($request['end_date'])) {
                $response->setData('message', (string)__('Start date must be lower than End date'));
                $response->setData('error', true);
            }
        }

        return $this->resultFactory->create(ResultFactory::TYPE_JSON)->setData($response);
    }
}
