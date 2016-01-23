<?php

namespace Tests\Magium\Magento2\Navigation;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Navigators\Catalog\Product;
use Magium\Magento\Themes\Magento2\ThemeConfiguration;

class ProductNavigationTest extends \Tests\Magium\Magento\Navigation\ProductNavigationTest
{

    protected $productName = 'Joust Duffle Bag';


    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration(ThemeConfiguration::THEME);
    }

}