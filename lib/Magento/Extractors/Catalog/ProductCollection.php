<?php

namespace Magium\Magento\Extractors\Catalog;

use Magium\Extractors\AbstractExtractor;
use Magium\Magento\AbstractMagentoTestCase;

use Magium\Magento\Extractors\Catalog\Products\AbstractProductCollection;
use Magium\Magento\Extractors\Catalog\Products\ProductGrid;
use Magium\Magento\Extractors\Catalog\Products\ProductList;
use Magium\Magento\Themes\AbstractThemeConfiguration;
use Magium\WebDriver\WebDriver;

class ProductCollection extends AbstractExtractor
{
    const EXTRACTOR = 'Catalog\ProductCollection';

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
        return count($this->getProducts());
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
        if ($this->getViewMode() == self::VIEW_MODE_GRID) {
            return $this->productGrid->getProductList();
        } else if ($this->getViewMode() == self::VIEW_MODE_LIST) {
            return $this->productList->getProductList();
        }
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