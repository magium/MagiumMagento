<?php

namespace Magium\Magento\Cli\Command\Test;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Extractors\Catalog\Products\ProductGrid;
use Magium\Magento\Extractors\Catalog\Products\ProductList;

class ListProductsInCategoryTest extends AbstractMagentoTestCase
{

    protected $baseUrl;

    protected $categoryPath;

    protected $productNames = [];

    protected $theme;

    public function setTheme($theme)
    {
        $this->theme = $theme;
    }

    public function setBaseUrl($url)
    {
        $this->baseUrl = $url;
    }

    public function setCategoryPath($path)
    {
        $this->categoryPath = $path;
    }

    public function getProductNames()
    {
        return $this->productNames;
    }

    public function testExecute()
    {
        if ($this->theme) {
            $this->switchThemeConfiguration($this->theme);
        }
        $this->productNames = [];
        if ($this->baseUrl) {
            $this->commandOpen($this->baseUrl);
        } else {
            $this->commandOpen($this->getTheme()->getBaseUrl());
        }

        $this->getNavigator()->navigateTo($this->categoryPath);

        $extractor = $this->getExtractor(ProductGrid::EXTRACTOR);
        /* @var $extractor ProductGrid */
        $productList = $extractor->getProductList();
        if (count($productList)) {
            $this->extractProducts($productList);
        } else {
            $extractor = $this->getExtractor(ProductList::EXTRACTOR);
            /* @var $extractor ProductList */
            $productList = $extractor->getProductList();
            if (count($productList)) {
                $this->extractProducts($productList);
            }
        }
    }

    protected function extractProducts(array $products)
    {
        foreach ($products as $product) {
            /* @var $product \Magium\Magento\Extractors\Catalog\Products\ProductSummary */
            $this->productNames[] = $product->getTitle();
        }
    }

}