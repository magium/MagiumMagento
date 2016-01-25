<?php

namespace Tests\Magium\MagentoEE113\Navigation;


class BaseNavigationTest extends \Tests\Magium\Magento\Navigation\BaseNavigationTest
{

    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration('Magium\Magento\Themes\MagentoEE113\ThemeConfiguration');
    }


}