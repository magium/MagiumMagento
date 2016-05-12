<?php

namespace Tests\Magium\MagentoEE114\Checkout;

class ShippingTest extends \Tests\Magium\Magento\Checkout\ShippingTest
{
    
    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration('Magium\Magento\Themes\MagentoEE114\ThemeConfiguration');
    }

}