<?php

namespace Tests\Magium\MagentoEE112\Checkout;

class ShippingTest extends \Tests\Magium\Magento\Checkout\ShippingTest
{
    
    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration('Magium\Magento\Themes\MagentoEE112\ThemeConfiguration');
    }

}