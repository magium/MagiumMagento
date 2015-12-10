<?php

namespace Tests\Magento18;

class TestHomePageTitle extends \Tests\Magento\TestHomePageTitle
{

    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration('Magium\Magento\Themes\Magento18\ThemeConfiguration');
    }


}