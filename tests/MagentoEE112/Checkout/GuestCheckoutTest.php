<?php

namespace Tests\MagentoEE112\Checkout;

use Magium\Magento\Themes\MagentoEE112\ThemeConfiguration;

class GuestCheckoutTest extends \Tests\Magium\Magento\Checkout\GuestCheckoutTest
{

    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration(ThemeConfiguration::THEME);
    }

}