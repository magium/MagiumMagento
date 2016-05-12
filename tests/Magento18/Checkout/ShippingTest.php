<?php

namespace Tests\Magium\Magento18\Checkout;

class ShippingTest extends \Tests\Magium\Magento\Checkout\ShippingTest
{
    
    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration('Magium\Magento\Themes\Magento18\ThemeConfiguration');
    }

}