<?php

namespace Magium\Magento\Navigators\Catalog;

use Magium\Actions\WaitForPageLoaded;
use Magium\Magento\Themes\AbstractThemeConfiguration;
use Magium\WebDriver\WebDriver;

class Product
{

    const NAVIGATOR = 'Catalog\Product';

    protected $webDriver;
    protected $theme;
    protected $loaded;

    /**
     * Product constructor.
     * @param $theme
     * @param $webDriver
     */
    public function __construct(
        AbstractThemeConfiguration $theme,
        WebDriver $webDriver,
        WaitForPageLoaded $loaded
    )
    {
        $this->theme = $theme;
        $this->webDriver = $webDriver;
        $this->loaded = $loaded;
    }

    public function navigateTo($productName)
    {
        $xpath = $this->theme->getCategorySpecificProductPageXpath($productName);
        $element = $this->webDriver->byXpath($xpath);
        $element->click();
        $this->loaded->execute($element);
    }

}