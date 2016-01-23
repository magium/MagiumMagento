<?php

namespace Tests\Magium\Magento2;

use Magium\Magento\Themes\Magento2\ThemeConfiguration;

class TestHomePageTitle extends \Tests\Magium\Magento\TestHomePageTitle
{

    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration(ThemeConfiguration::THEME);
    }


}