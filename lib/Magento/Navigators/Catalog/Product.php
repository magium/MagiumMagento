<?php

namespace Magium\Magento\Navigators\Catalog;

use Magium\Magento\Themes\AbstractThemeConfiguration;
use Magium\WebDriver\WebDriver;

class Product
{

    const NAVIGATOR = 'Catalog\Product';

    protected $webDriver;
    protected $theme;

    /**
     * Product constructor.
     * @param $theme
     * @param $webDriver
     */
    public function __construct(AbstractThemeConfiguration $theme, WebDriver $webDriver)
    {
        $this->theme = $theme;
        $this->webDriver = $webDriver;
    }

    public function navigateTo($productName)
    {
        $xpath = $this->theme->getCategorySpecificProductPageXpath($productName);
        $this->webDriver->byXpath($xpath)->click();
    }

}