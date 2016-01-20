<?php

namespace Tests\Magium\MagentoEE114\Navigation;


class BaseNavigationTest extends \Tests\Magium\Magento\Navigation\BaseNavigationTest
{

    public function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration('Magium\Magento\Themes\MagentoEE114\ThemeConfiguration');
    }

}