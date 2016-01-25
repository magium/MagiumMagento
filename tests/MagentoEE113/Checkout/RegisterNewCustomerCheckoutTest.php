<?php

namespace Tests\Magium\MagentoEE113\Checkout;


use Magium\Magento\Themes\MagentoEE113\ThemeConfiguration;

class RegisterNewCustomerCheckoutTest extends \Tests\Magium\Magento\Checkout\RegisterNewCustomerCheckoutTest
{

    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration(ThemeConfiguration::THEME);
    }
}