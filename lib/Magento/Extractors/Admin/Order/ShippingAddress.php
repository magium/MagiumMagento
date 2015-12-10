<?php

namespace Magium\Magento\Extractors\Admin\Order;

use Magium\Magento\Extractors\Admin\AddressExtractor;

class ShippingAddress extends AddressExtractor
{

    public function getBaseXpath()
    {
        return '//h4[contains(concat(" ",normalize-space(@class)," ")," head-shipping-address ")]/../../fieldset';
    }

}