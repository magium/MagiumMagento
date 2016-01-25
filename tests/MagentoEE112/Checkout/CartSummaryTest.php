<?php

namespace Tests\Magium\MagentoEE112\Checkout;

use Magium\Magento\Themes\MagentoEE112\ThemeConfiguration;

class CartSummaryTest extends \Tests\Magium\Magento\Checkout\CartSummaryTest
{
    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration(ThemeConfiguration::THEME);
    }

}