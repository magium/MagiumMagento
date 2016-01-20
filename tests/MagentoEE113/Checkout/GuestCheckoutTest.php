<?php

namespace Tests\MagentoEE113\Checkout;

use Magium\Magento\Themes\MagentoEE113\ThemeConfiguration;

class GuestCheckoutTest extends \Tests\Magium\Magento\Checkout\GuestCheckoutTest
{

    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration(ThemeConfiguration::THEME);
    }

}