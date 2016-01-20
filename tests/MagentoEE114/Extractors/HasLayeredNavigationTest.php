<?php

namespace Tests\Magium\MagentoEE114\Extractors;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Extractors\Catalog\LayeredNavigation\HasLayeredNavigation;
use Magium\Magento\Navigators\BaseMenu;

class HasLayeredNavigationTest extends \Tests\Magium\Magento\Extractors\HasLayeredNavigationTest
{

    public function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration('Magium\Magento\Themes\MagentoEE114\ThemeConfiguration');
    }
}