<?php

namespace Tests\Magium\Magento18\Navigation;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Navigators\Catalog\Product;

class ProductNavigationTest extends \Tests\Magium\Magento\Navigation\ProductNavigationTest
{

    protected $productName = 'HTC Touch Diamond';


    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration('Magium\Magento\Themes\Magento18\ThemeConfiguration');
    }

}