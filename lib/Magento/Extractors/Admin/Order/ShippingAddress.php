<?php

namespace Magium\Magento\Extractors\Admin\Order;


use Magium\Extractors\AbstractAddressExtractor;

class ShippingAddress extends AbstractAddressExtractor
{
    const EXTRACTOR = 'Admin\Order\ShippingAddress';

    public function getBaseXpath()
    {
        return '//h4[contains(concat(" ",normalize-space(@class)," ")," head-shipping-address ")]/../../fieldset';
    }

}