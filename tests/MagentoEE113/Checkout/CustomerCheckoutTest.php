<?php

namespace Tests\Magium\MagentoEE113\Checkout;


use Magium\Magento\Themes\MagentoEE113\ThemeConfiguration;

class CustomerCheckoutTest extends \Tests\Magium\Magento\Checkout\CustomerCheckoutTest
{

    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration(ThemeConfiguration::THEME);
    }

}