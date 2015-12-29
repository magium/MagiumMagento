<?php

namespace Tests\Magium\Magento18\Customer;

class ToCustomerLoginTest extends \Tests\Magium\Magento\Customer\ToCustomerLoginTest
{

    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration('Magium\Magento\Themes\Magento18\ThemeConfiguration');
    }
}