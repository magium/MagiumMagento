<?php

namespace Tests\Magium\MagentoEE112;

use Magium\Magento\Themes\MagentoEE112\ThemeConfiguration;

class TestHomePageTitle extends \Tests\Magium\Magento\TestHomePageTitle
{

    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration(ThemeConfiguration::THEME);
    }


}