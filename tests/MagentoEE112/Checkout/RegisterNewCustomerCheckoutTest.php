<?php

namespace Tests\Magium\MagentoEE112\Checkout;


use Magium\Magento\Themes\MagentoEE112\ThemeConfiguration;

class RegisterNewCustomerCheckoutTest extends \Tests\Magium\Magento\Checkout\RegisterNewCustomerCheckoutTest
{

    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration(ThemeConfiguration::THEME);
    }
}