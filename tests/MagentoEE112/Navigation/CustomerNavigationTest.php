<?php

namespace Tests\Magium\MagentoEE112\Navigation;


use Magium\Magento\Themes\MagentoEE112\ThemeConfiguration;

class CustomerNavigationTest extends \Tests\Magium\Magento\Navigation\CustomerNavigationTest
{

    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration(ThemeConfiguration::THEME);
    }


}