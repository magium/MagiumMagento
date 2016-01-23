<?php

namespace Magium\Magento\Extractors\Catalog\Products;


use Facebook\WebDriver\WebDriverElement;
use Magium\Extractors\AbstractExtractor;
use Magium\WebDriver\WebDriver;

abstract class AbstractProductCollection extends AbstractExtractor
{

    protected $products = [];
    protected $testElement;

    abstract function getElementXpath($type, $count);

    /**
     * @return array
     */

    public function getProductList()
    {
        $this->extract();
        return $this->products;
    }

    protected function getByXpath($type, $count, $attribute = null, $getElement = false)
    {
        $xpath = $this->getElementXpath($type, $count);
        if ($this->webDriver->elementExists($xpath, WebDriver::BY_XPATH)) {
            $element = $this->webDriver->byXpath($xpath);
            if ($getElement) {
                return $element;
            } else if ($attribute) {
                return $element->getAttribute($attribute);
            } else {
                return trim($element->getText());
            }
        }
        return null;
    }

    public function extract()
    {
        if ($this->testElement instanceof WebDriverElement && $this->webDriver->elementAttached($this->testElement)) {
            return;
        }
        $this->testElement = $this->webDriver->byXpath('//body');
        $this->products = [];
        $count = 0;
        while ($this->webDriver->elementExists($this->getElementXpath(ProductSummary::TITLE, ++$count), WebDriver::BY_XPATH)) {
            $title = $this->getByXpath(ProductSummary::TITLE, $count);
            $price = $this->getByXpath(ProductSummary::PRICE, $count);
            $link = $this->getByXpath(ProductSummary::LINK, $count, 'href');
            $image = $this->getByXpath(ProductSummary::IMAGE, $count, 'src');
            $originalPrice = $this->getByXpath(ProductSummary::ORIGINAL_PRICE, $count);
            if ($originalPrice === null) {
                $originalPrice = $price;
            }
            $wishlistLink = $this->getByXpath(ProductSummary::WISHLIST_LINK, $count, null, true);
            $compareLink = $this->getByXpath(ProductSummary::COMPARE_LINK, $count, null, true);
            $description = $this->getByXpath(ProductSummary::DESCRIPTION, $count);
            $addToCartLink = $this->getByXpath(ProductSummary::ADD_TO_CART_LINK, $count, null, true);

            $product = new ProductSummary(
                $title,
                $price,
                $link,
                $image,
                $originalPrice,
                $wishlistLink,
                $compareLink,
                $description,
                $addToCartLink
            );

            $this->products[] = $product;
        }
    }

}