<?php

namespace Tests\Magium\MagentoEE113\Checkout;

class ShippingTest extends \Tests\Magium\Magento\Checkout\ShippingTest
{
    
    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration('Magium\Magento\Themes\MagentoEE113\ThemeConfiguration');
    }

}