<?php

namespace Magium\Magento\Extractors\Catalog\Category;

use Magium\Extractors\AbstractExtractor;
use Magium\Magento\AbstractMagentoTestCase;

use Magium\Magento\Extractors\Catalog\Product\AbstractProductCollection;
use Magium\Magento\Extractors\Catalog\Product\ProductGrid;
use Magium\Magento\Extractors\Catalog\Product\ProductList;
use Magium\Magento\Themes\AbstractThemeConfiguration;
use Magium\WebDriver\WebDriver;

class Category extends AbstractExtractor
{
    const EXTRACTOR = 'Catalog\Category\Category';

    const VIEW_MODE_LIST = 'list';
    const VIEW_MODE_GRID = 'grid';

    protected $hasLayeredNavigation;
    protected $productList;
    protected $productGrid;

    protected $products;

    public function __construct(
        WebDriver $webDriver,
        AbstractMagentoTestCase $testCase,
        AbstractThemeConfiguration $theme,
        HasLayeredNavigation $hasLayeredNavigation,
        ProductList $productList,
        ProductGrid $productGrid
    )
    {
        parent::__construct($webDriver, $testCase, $theme);
        $this->hasLayeredNavigation = $hasLayeredNavigation;
        $this->productList = $productList;
        $this->productGrid = $productGrid;
    }

    public function getStatedProductCount()
    {

    }

    public function getCalculatedProductCount()
    {

    }

    public function getViewMode()
    {

    }

    public function getSortBy()
    {

    }

    public function getShowCount()
    {

    }

    /**
     * @return AbstractProductCollection
     */

    public function getProducts()
    {

    }

    public function hasLayeredNavigation()
    {
        return $this->hasLayeredNavigation->hasLayeredNavigation();
    }

    public function extract()
    {
        // TODO: Implement extract() method.
    }
}