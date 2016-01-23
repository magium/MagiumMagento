<?php

namespace Tests\Magium\MagentoEE112\Navigation;


use Magium\Magento\Themes\MagentoEE112\ThemeConfiguration;

class BaseNavigationTest extends \Tests\Magium\Magento\Navigation\BaseNavigationTest
{

    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration(ThemeConfiguration::THEME);
    }


}