<?php

namespace Tests\Magium\Magento18;

class TestHomePageTitle extends \Tests\Magium\Magento\TestHomePageTitle
{

    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration('Magium\Magento\Themes\Magento18\ThemeConfiguration');
    }


}