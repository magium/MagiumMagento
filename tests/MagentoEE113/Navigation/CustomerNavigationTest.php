<?php

namespace Tests\Magium\MagentoEE113\Navigation;


class CustomerNavigationTest extends \Tests\Magium\Magento\Navigation\CustomerNavigationTest
{

    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration('Magium\Magento\Themes\MagentoEE113\ThemeConfiguration');
    }


}