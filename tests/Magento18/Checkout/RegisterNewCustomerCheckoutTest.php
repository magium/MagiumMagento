<?php

namespace Tests\Magento18\Checkout;


class RegisterNewCustomerCheckoutTest extends \Tests\Magento\Checkout\RegisterNewCustomerCheckoutTest
{

    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration('Magium\Magento\Themes\Magento18\ThemeConfiguration');
    }
}