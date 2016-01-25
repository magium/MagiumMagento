<?php

namespace Tests\Magium\MagentoEE113\Customer;

class ToCustomerLoginTest extends \Tests\Magium\Magento\Customer\ToCustomerLoginTest
{

    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration('Magium\Magento\Themes\MagentoEE113\ThemeConfiguration');
    }
}