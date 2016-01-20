<?php

namespace Tests\Magium\MagentoEE112\Customer;


use Magium\Magento\Themes\MagentoEE112\ThemeConfiguration;

class RegisterCustomerTest extends \Tests\Magium\Magento\Customer\RegisterCustomerTest
{

    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration(ThemeConfiguration::THEME);
    }

}