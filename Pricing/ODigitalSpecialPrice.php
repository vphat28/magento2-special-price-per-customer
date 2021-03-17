<?php

namespace ODigital\Price\Pricing;

use Magento\Framework\Pricing\Adjustment\CalculatorInterface;
use Magento\Framework\Pricing\SaleableInterface;

class ODigitalSpecialPrice extends \Magento\Catalog\Pricing\Price\RegularPrice
{
    public function __construct(
        SaleableInterface $saleableItem,
        $quantity,
        CalculatorInterface $calculator,
        \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency,
        \Magento\Customer\Model\SessionFactory $customerSession,
        \ODigital\Price\Provider\SpecialPrice $specialPriceProvider

    ) {
        parent::__construct($saleableItem, $quantity, $calculator, $priceCurrency);
        $this->specialPriceProvider = $specialPriceProvider;
        $this->customerSession = $customerSession;
    }

    /**
     * Price type
     */
    const PRICE_CODE = 'odigital_special_price';

    /**
     * Get price value
     *
     * @return float
     */
    public function getValue()
    {
        $customer = $this->customerSession->create();
        $userId = $customer->getCustomer()->getId();
        $productId = $this->getProduct()->getId();

        if (empty($userId)) {
            return parent::getValue();
        }

        $specialPrice = $this->specialPriceProvider->getSpecialPrice($productId, $userId);

        if ($specialPrice !== null) {
            return $specialPrice;
        }

        return parent::getValue();
    }
}
