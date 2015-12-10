<?php

namespace Magium\Magento\Extractors\Checkout;

use Magium\TestCaseException;

class ProductIterator extends \ArrayObject
{

    public function addProduct(Product $product)
    {
        parent::append($product);
    }

    public function append($value)
    {
        throw new TestCaseException('Use addProduct() instead');
    }

}