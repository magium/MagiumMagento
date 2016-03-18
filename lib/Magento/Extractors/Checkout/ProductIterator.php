<?php

namespace Magium\Magento\Extractors\Checkout;

class ProductIterator extends \ArrayObject
{
    const EXTRACTOR = 'Checkout\ProductIterator';

    public function addProduct(Product $product)
    {
        parent::append($product);
    }

    public function append($value)
    {
        $this->addProduct($value);
    }

}