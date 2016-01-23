<?php

namespace Tests\Magium\Magento2\Navigation;


use Magium\Magento\Themes\Magento2\ThemeConfiguration;

class BaseNavigationTest extends \Tests\Magium\Magento\Navigation\BaseNavigationTest
{

    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration(ThemeConfiguration::THEME);
    }


}