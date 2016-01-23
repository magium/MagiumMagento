<?php

namespace Tests\Magium\Magento2\Customer;


use Magium\Magento\Themes\Magento2\ThemeConfiguration;

class RegisterCustomerTest extends \Tests\Magium\Magento\Customer\RegisterCustomerTest
{

    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration(ThemeConfiguration::THEME);
    }

}