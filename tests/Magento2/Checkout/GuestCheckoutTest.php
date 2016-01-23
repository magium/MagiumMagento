<?php

namespace Tests\Magento2\Checkout;

use Magium\Magento\Themes\Magento2\ThemeConfiguration;

class GuestCheckoutTest extends \Tests\Magium\Magento\Checkout\GuestCheckoutTest
{

    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration(ThemeConfiguration::THEME);
    }

}