<?php

namespace Tests\Magium\MagentoEE112\Checkout;


use Magium\Magento\Themes\MagentoEE112\ThemeConfiguration;

class CustomerCheckoutTest extends \Tests\Magium\Magento\Checkout\CustomerCheckoutTest
{

    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration(ThemeConfiguration::THEME);
    }

}