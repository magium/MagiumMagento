<?php

namespace Tests\Magium\MagentoEE112\Customer;

use Magium\Magento\Themes\MagentoEE112\ThemeConfiguration;

class ToCustomerLoginTest extends \Tests\Magium\Magento\Customer\ToCustomerLoginTest
{

    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration(ThemeConfiguration::THEME);
    }
}