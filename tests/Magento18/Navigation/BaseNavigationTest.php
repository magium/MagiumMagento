<?php

namespace Tests\Magium\Magento18\Navigation;


class BaseNavigationTest extends \Tests\Magium\Magento\Navigation\BaseNavigationTest
{

    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration('Magium\Magento\Themes\Magento18\ThemeConfiguration');
    }


}