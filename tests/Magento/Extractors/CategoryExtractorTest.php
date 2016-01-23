<?php

namespace Tests\Magium\Magento\Extractors;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Extractors\Catalog\Category\Category;
use Magium\Magento\Extractors\Catalog\Products;
use Magium\Magento\Extractors\Catalog\Products\ProductGrid;
use Magium\Magento\Extractors\Catalog\Products\ProductList;
use Magium\Magento\Navigators\BaseMenu;

class CategoryExtractorTest extends AbstractMagentoTestCase
{
    public function testLayeredNavTestWorks()
    {
        // This is different because it goes through the category extractor.  Perhaps this is useless
        $this->commandOpen($this->getTheme()->getBaseUrl());
        $this->getNavigator(BaseMenu::NAVIGATOR)->navigateTo($this->getTheme()->getNavigationPathToSimpleProductCategory());
        $extractor = $this->getExtractor(Category::EXTRACTOR);
        self::assertTrue($extractor->hasLayeredNavigation());
    }

    public function testProductGridExtraction()
    {
        $this->commandOpen($this->getTheme()->getBaseUrl());
        $this->getNavigator(BaseMenu::NAVIGATOR)->navigateTo($this->getTheme()->getNavigationPathToSimpleProductCategory());
        $productGridExtractor = $this->getExtractor(ProductGrid::EXTRACTOR);
        $productGridExtractor->extract();
        $products = $productGridExtractor->getProductList();
        self::assertNotCount(0, $products);
        // This could fail if some details are missing.  So this is intended for a local test with sample data
        self::assertNotNull($products[0]->getTitle());
        self::assertNotNull($products[0]->getAddToCartLink());
        self::assertNull($products[0]->getDescription()); // Product grid does not have description
        self::assertNotNull($products[0]->getLink());
        self::assertNotNull($products[0]->getImage());
        self::assertContains('$', $products[0]->getPrice());

    }


    public function testProductListExtraction()
    {
        $this->commandOpen($this->getTheme()->getBaseUrl());
        $this->getNavigator(BaseMenu::NAVIGATOR)->navigateTo($this->getTheme()->getNavigationPathToSimpleProductCategory());
        $this->webdriver->byXpath('//p[@class="view-mode"]//a[@class="list"]')->click();
        $productListExtractor = $this->getExtractor(ProductList::EXTRACTOR);
        $productListExtractor->extract();
        $products = $productListExtractor->getProductList();
        self::assertNotCount(0, $products);
        // This could fail if some details are missing.  So this is intended for a local test
        self::assertNotNull($products[0]->getTitle());
        self::assertNotNull($products[0]->getAddToCartLink());
        self::assertNotNull($products[0]->getDescription()); // Product list has a description
        self::assertNotNull($products[0]->getLink());
        self::assertNotNull($products[0]->getImage());
        self::assertContains('$', $products[0]->getPrice());

    }
}