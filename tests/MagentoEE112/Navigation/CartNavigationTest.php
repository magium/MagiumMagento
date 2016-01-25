<?php

namespace Tests\Magium\MagentoEE112\Navigation;

use Magium\Magento\Themes\MagentoEE112\ThemeConfiguration;

class CartNavigationTest extends \Tests\Magium\Magento\Navigation\CartNavigationTest
{

    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration(ThemeConfiguration::THEME);
    }

}