<?php

namespace Tests\Magium\MagentoEE113\Checkout;

use Magium\Magento\Themes\MagentoEE113\ThemeConfiguration;

class CartSummaryTest extends \Tests\Magium\Magento\Checkout\CartSummaryTest
{
    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration(ThemeConfiguration::THEME);
    }

}