<?php

namespace Magium\Magento\Extractors\Admin\Order;


use Magium\Extractors\AbstractAddressExtractor;

class BillingAddress extends AbstractAddressExtractor
{
    const EXTRACTOR = 'Admin\Order\BillingAddress';
    public function getBaseXpath()
    {
        return '//h4[contains(concat(" ",normalize-space(@class)," ")," head-billing-address ")]/../../fieldset';
    }

}