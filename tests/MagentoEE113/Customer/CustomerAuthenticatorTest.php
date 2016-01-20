<?php

namespace Tests\Magium\MagentoEE113\Customer;

class CustomerAuthenticationTest extends \Tests\Magium\Magento\Customer\CustomerAuthenticationTest
{
    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration('Magium\Magento\Themes\MagentoEE113\ThemeConfiguration');
    }
}