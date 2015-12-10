<?php

namespace Tests\Magento18\Customer;

class ToCustomerLoginTest extends \Tests\Magento\Customer\ToCustomerLoginTest
{

    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration('Magium\Magento\Themes\Magento18\ThemeConfiguration');
    }
}