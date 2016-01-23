<?php

namespace Tests\Magium\Magento\Navigation;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Navigators\Catalog\DefaultSimpleProductCategory;
use Magium\Magento\Navigators\Catalog\Product;

class ProductNavigationTest extends AbstractMagentoTestCase
{

    protected $productName = 'Pearl Stud Earrings';

    public function testNavigateToJewelry()
    {
        $theme = $this->getTheme();
        $this->commandOpen($theme->getBaseUrl());
        $this->getNavigator(DefaultSimpleProductCategory::NAVIGATOR)->navigateTo();
        $this->getNavigator(Product::NAVIGATOR)->navigateTo($this->productName);
        $this->assertTitleContains($this->productName);
    }
}