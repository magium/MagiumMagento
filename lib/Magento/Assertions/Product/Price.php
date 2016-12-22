<?php

namespace Magium\Magento\Assertions\Product;

use Magium\AbstractTestCase;
use Magium\Assertions\SelectorAssertionInterface;
use Magium\Magento\Themes\AbstractThemeConfiguration;
use Magium\WebDriver\WebDriver;

class Price implements SelectorAssertionInterface
{

    const ASSERTION = 'Product\Price';

    protected $webDriver;
    protected $theme;

    public function __construct(
        WebDriver $webDriver,
        AbstractThemeConfiguration $theme
    )
    {
        $this->webDriver = $webDriver;
        $this->theme = $theme;
    }

    public function assertPrice($price, $includeCurrency = false)
    {
        return $this->assertSelector($price, $includeCurrency);
    }

    public function assertSelector($selector, $includeCurrency = false)
    {
        $element = $this->webDriver->byXpath($this->theme->getProductPagePriceXpath());
        $price = trim($element->getText());
        if (!$includeCurrency) {
            $price = preg_replace('/^\D+/', '', $price);
        }
        AbstractTestCase::assertEquals($selector, $price);
    }

}
