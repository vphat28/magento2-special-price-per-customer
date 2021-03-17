<?php

namespace ODigital\Price\Pricing\Render;

use Magento\Catalog\Model\Product\Pricing\Renderer\SalableResolverInterface;
use Magento\Catalog\Pricing\Price\MinimalPriceCalculatorInterface;
use Magento\Framework\Pricing\Price\PriceInterface;
use Magento\Framework\Pricing\Render\RendererPool;
use Magento\Framework\Pricing\SaleableInterface;
use Magento\Framework\View\Element\Template\Context;

class FinalPrice extends \Magento\Catalog\Pricing\Render\FinalPriceBox
{
    public function __construct(
        Context $context,
        SaleableInterface $saleableItem,
        PriceInterface $price,
        RendererPool $rendererPool,
        array $data = [],
        \ODigital\Price\Provider\SpecialPrice $specialPrice,
        SalableResolverInterface $salableResolver = null,
        MinimalPriceCalculatorInterface $minimalPriceCalculator = null
    ) {
        parent::__construct($context, $saleableItem, $price, $rendererPool, $data, $salableResolver,
            $minimalPriceCalculator);
        $this->specialPrice = $specialPrice;
    }

    public function hasODigitalPrice()
    {
        if (!empty($this->specialPrice->getSpecialPrice(
            $this->saleableItem->getId()
        ))) {
            return true;
        }

        return false;
    }
}
