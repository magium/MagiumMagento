<?php

namespace Tests\Magium\MagentoEE114\Navigation;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Navigators\Cart\DefaultProductCategory;
use Magium\Navigators\Home;

class HomeNavigationTest extends \Tests\Magium\Magento\Navigation\HomeNavigationTest
{

    public function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration('Magium\Magento\Themes\MagentoEE114\ThemeConfiguration');
    }

}