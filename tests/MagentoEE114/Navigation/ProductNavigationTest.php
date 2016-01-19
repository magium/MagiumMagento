<?php

namespace Tests\Magium\MagentoEE114\Navigation;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Navigators\Catalog\Product;

class ProductNavigationTest extends \Tests\Magium\Magento\Navigation\ProductNavigationTest
{
    public function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration('Magium\Magento\Themes\MagentoEE114\ThemeConfiguration');
    }
}