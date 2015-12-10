<?php

namespace Tests\Magento18\Navigation;


class CustomerNavigationTest extends \Tests\Magento\Navigation\CustomerNavigationTest
{

    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration('Magium\Magento\Themes\Magento18\ThemeConfiguration');
    }


}