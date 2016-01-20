<?php

namespace Tests\Magium\MagentoEE114\Extractors;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Extractors\Catalog\Category\Category;
use Magium\Magento\Extractors\Catalog\Products;
use Magium\Magento\Extractors\Catalog\Products\ProductGrid;
use Magium\Magento\Extractors\Catalog\Products\ProductList;
use Magium\Magento\Navigators\BaseMenu;

class CategoryExtractorTest extends \Tests\Magium\Magento\Extractors\CategoryExtractorTest
{

    public function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration('Magium\Magento\Themes\MagentoEE114\ThemeConfiguration');
    }
}