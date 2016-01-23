<?php

namespace Tests\Magium\Magento2\Navigation;


use Magium\Magento\Themes\Magento2\ThemeConfiguration;

class CustomerNavigationTest extends \Tests\Magium\Magento\Navigation\CustomerNavigationTest
{

    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration(ThemeConfiguration::THEME);
    }


}