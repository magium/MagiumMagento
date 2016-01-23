<?php

namespace Tests\Magium\MagentoEE113\Navigation;

use Magium\Magento\Themes\MagentoEE113\ThemeConfiguration;

class CartNavigationTest extends \Tests\Magium\Magento\Navigation\CartNavigationTest
{

    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration(ThemeConfiguration::THEME);
    }

}