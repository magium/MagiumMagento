<?php

namespace Tests\Magento18\Customer;


class RegisterCustomerTest extends \Tests\Magento\Customer\RegisterCustomerTest
{

    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration('Magium\Magento\Themes\Magento18\ThemeConfiguration');
    }

}