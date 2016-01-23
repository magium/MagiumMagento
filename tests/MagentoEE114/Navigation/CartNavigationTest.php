<?php

namespace Tests\Magium\MagentoEE114\Navigation;

use Magium\Magento\Themes\MagentoEE114\ThemeConfiguration;

class CartNavigationTest extends \Tests\Magium\Magento\Navigation\CartNavigationTest
{

    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration(ThemeConfiguration::THEME);
    }

}