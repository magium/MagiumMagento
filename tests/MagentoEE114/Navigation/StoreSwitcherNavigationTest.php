<?php

namespace Tests\Magium\MagentoEE114\Navigation;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Navigators\Store\Switcher;

class StoreSwitcherNavigationTest extends \Tests\Magium\Magento\Navigation\StoreSwitcherNavigationTest
{

    public function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration('Magium\Magento\Themes\MagentoEE114\ThemeConfiguration');
    }
}