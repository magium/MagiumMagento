<?php

namespace Tests\Magium\Magento18\Navigation;

use Magium\Magento\Themes\Magento18\ThemeConfiguration;

class CartNavigationTest extends \Tests\Magium\Magento\Navigation\CartNavigationTest
{

    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration(ThemeConfiguration::THEME);
    }

}