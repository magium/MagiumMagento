<?php

namespace Tests\Magium\MagentoEE113\Customer;


class RegisterCustomerTest extends \Tests\Magium\Magento\Customer\RegisterCustomerTest
{

    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration('Magium\Magento\Themes\MagentoEE113\ThemeConfiguration');
    }

}