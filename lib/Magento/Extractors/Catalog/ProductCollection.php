<?php

namespace Magium\Magento\Extractors\Catalog;

use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverElement;
use Magium\Extractors\AbstractExtractor;
use Magium\Magento\AbstractMagentoTestCase;


use Magium\Magento\Extractors\Catalog\LayeredNavigation\HasLayeredNavigation;
use Magium\Magento\Extractors\Catalog\Products\ProductGrid;
use Magium\Magento\Extractors\Catalog\Products\ProductList;
use Magium\Magento\Themes\AbstractThemeConfiguration;
use Magium\Magento\Themes\Magento19\ThemeConfiguration;
use Magium\WebDriver\ExpectedCondition;
use Magium\WebDriver\WebDriver;

class ProductCollection extends AbstractExtractor
{
    const EXTRACTOR = 'Catalog\ProductCollection';

    const VIEW_MODE_LIST = 'list';
    const VIEW_MODE_GRID = 'grid';

    protected $hasLayeredNavigation;
    protected $productList;
    protected $productGrid;

    protected $statedProductCount;
    protected $viewMode;
    protected $sortBy;
    protected $showCount;
    protected $showCountOptions;

    protected $products;

    protected $elementTest;

    /**
     * @var ThemeConfiguration
     */

    protected $theme;

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
        return $this->statedProductCount;
    }

    public function getStatedProductCountNumber()
    {
        return (int)$this->getStatedProductCount();
    }

    public function getCalculatedProductCount()
    {
        return count($this->getProducts());
    }

    public function getViewMode()
    {
        return $this->viewMode;
    }

    public function getSortBy()
    {
        return $this->sortBy;
    }

    public function getShowCount()
    {
        return $this->showCount;
    }

    public function getShowCountOptions()
    {
        return $this->showCountOptions;
    }

    /**
     * @return array
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
        if ($this->elementTest instanceof WebDriverElement && $this->webDriver->elementAttached($this->elementTest)) {
            return;
        }

        // For some reason Firefox sometimes cannot find the body element, so we'll wait for it to exist instead.
        $this->webDriver->wait()->until(ExpectedCondition::elementExists('//body', WebDriver::BY_XPATH));

        $this->elementTest = $this->webDriver->byXpath('//body');

        $element = $this->webDriver->byXpath($this->theme->getProductCollectionProductCountXpath());
        $this->statedProductCount = trim($element->getText());

        $element = $this->webDriver->byXpath($this->theme->getProductCollectionViewModeXpath());
        $this->viewMode = $element->getAttribute($this->theme->getViewModeAttributeName());

        $element = $this->webDriver->byXpath($this->theme->getProductCollectionSortByXpath());
        $this->sortBy = trim($element->getText());

        $element = $this->webDriver->byXpath($this->theme->getProductCollectionShowCountXpath());
        $this->showCount = trim($element->getText());

        $this->showCountOptions = [];
        $elements = $this->webDriver->findElements(WebDriverBy::xpath($this->theme->getProductCollectionShowCountOptionsXpath()));
        foreach ($elements as $element) {
            $this->showCountOptions[] = trim($element->getText());
        }
    }
}