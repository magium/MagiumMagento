<?php

namespace Tests\Magium\Magento2\Customer;

use Magium\Magento\Themes\Magento2\ThemeConfiguration;

class CustomerAuthenticationTest extends \Tests\Magium\Magento\Customer\CustomerAuthenticationTest
{
    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration(ThemeConfiguration::THEME);
    }
}