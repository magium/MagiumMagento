<?php

namespace Tests\Magium\MagentoEE114\Navigation;


use Magium\Magento\Themes\MagentoEE114\ThemeConfiguration;

class HomeNavigationTest extends \Tests\Magium\Magento\Navigation\HomeNavigationTest
{

    public function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration(ThemeConfiguration::THEME);
    }

}