<?php

namespace Tests\Magium\MagentoEE113;

class TestHomePageTitle extends \Tests\Magium\Magento\TestHomePageTitle
{

    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration('Magium\Magento\Themes\MagentoEE113\ThemeConfiguration');
    }


}