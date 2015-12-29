<?php

namespace Tests\Magium\Magento18\Customer;


class RegisterCustomerTest extends \Tests\Magium\Magento\Customer\RegisterCustomerTest
{

    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration('Magium\Magento\Themes\Magento18\ThemeConfiguration');
    }

}