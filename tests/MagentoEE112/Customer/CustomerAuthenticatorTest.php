<?php

namespace Tests\Magium\MagentoEE112\Customer;

use Magium\Magento\Themes\MagentoEE112\ThemeConfiguration;

class CustomerAuthenticationTest extends \Tests\Magium\Magento\Customer\CustomerAuthenticationTest
{
    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration(ThemeConfiguration::THEME);
    }
}