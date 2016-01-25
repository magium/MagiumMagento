<?php

namespace Tests\Magium\Magento\Extractors;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Extractors\Catalog\Category\Category;
use Magium\Magento\Extractors\Catalog\Products;
use Magium\Magento\Extractors\Catalog\Products\ProductGrid;
use Magium\Magento\Extractors\Catalog\Products\ProductList;
use Magium\Magento\Navigators\BaseMenu;
use Magium\Magento\Navigators\Catalog\DefaultSimpleProductCategory;

class CategoryExtractorTest extends AbstractMagentoTestCase
{
    protected $modeSelectorXpath = '//p[@class="view-mode"]//a[@class="list"]';

    public function testLayeredNavTestWorks()
    {
        // This is different because it goes through the category extractor.  Perhaps this is useless
        $this->commandOpen($this->getTheme()->getBaseUrl());
        $this->getNavigator(DefaultSimpleProductCategory::NAVIGATOR)->navigateTo();
        $extractor = $this->getExtractor(Category::EXTRACTOR);
        self::assertTrue($extractor->hasLayeredNavigation());
    }

    public function testProductGridExtraction()
    {
        $this->commandOpen($this->getTheme()->getBaseUrl());
        $this->getNavigator(DefaultSimpleProductCategory::NAVIGATOR)->navigateTo();
        $productGridExtractor = $this->getExtractor(ProductGrid::EXTRACTOR);
        $productGridExtractor->extract();
        $products = $productGridExtractor->getProductList();
        self::assertNotCount(0, $products);
        // This could fail if some details are missing.  So this is intended for a local test with sample data
        self::assertNotNull($products[0]->getTitle());
        self::assertInstanceOf('Facebook\WebDriver\WebDriverElement', $products[0]->getAddToCartElement());
        self::assertNull($products[0]->getDescription()); // Product grid does not have description
        self::assertNotNull($products[0]->getLink());
        self::assertNotNull($products[0]->getImage());
        self::assertContains('$', $products[0]->getPrice());

    }


    public function testProductListExtraction()
    {
        $this->commandOpen($this->getTheme()->getBaseUrl());
        $this->getNavigator(DefaultSimpleProductCategory::NAVIGATOR)->navigateTo();
        $this->webdriver->byXpath($this->modeSelectorXpath)->click();
        $productListExtractor = $this->getExtractor(ProductList::EXTRACTOR);
        $productListExtractor->extract();
        $products = $productListExtractor->getProductList();
        self::assertNotCount(0, $products);
        // This could fail if some details are missing.  So this is intended for a local test
        self::assertNotNull($products[0]->getTitle());
        self::assertNotNull($products[0]->getAddToCartElement());
        self::assertNotNull($products[0]->getDescription()); // Product list has a description
        self::assertNotNull($products[0]->getLink());
        self::assertNotNull($products[0]->getImage());
        self::assertContains('$', $products[0]->getPrice());

    }
}