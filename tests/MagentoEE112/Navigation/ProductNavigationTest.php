<?php

namespace Tests\Magium\MagentoEE112\Navigation;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Navigators\Catalog\Product;
use Magium\Magento\Themes\MagentoEE112\ThemeConfiguration;

class ProductNavigationTest extends \Tests\Magium\Magento\Navigation\ProductNavigationTest
{

    protected $productName = 'HTC Touch Diamond';


    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration(ThemeConfiguration::THEME);
    }

}