<?php

namespace ODigital\Price\Plugin;

use Magento\Authorization\Model\UserContextInterface;
use Magento\Catalog\Model\Product;
use Magento\Framework\App\ObjectManager;
use ODigital\Price\Provider\SpecialPrice;

class EditFinalPrice
{
    /** @var SpecialPrice */
    protected $specialPriceProvider;

    /** @var UserContextInterface */
    protected $userContext;

    public function __construct(
        SpecialPrice $specialPriceProvider,
        UserContextInterface $userContext
    )
    {
        $this->specialPriceProvider = $specialPriceProvider;
        $this->userContext = $userContext;
    }

    /**
     * @param Product $product
     * @param $price
     * @return float
     */
    public function afterGetFinalPrice($product, $price)
    {
        if (empty($this->userContext->getUserId())) {
            return $price;
        }

        $specialPrice = $this->specialPriceProvider->getSpecialPrice($product->getId(), $this->userContext->getUserId());

        if ($specialPrice !== null) {
            return $specialPrice;
        }

        return $price;
    }
}
