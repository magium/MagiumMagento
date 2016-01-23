<?php

namespace Magium\Magento\Extractors\Catalog\Cart;

use Facebook\WebDriver\WebDriverElement;
use Magium\Extractors\AbstractExtractor;
use Magium\Magento\Actions\Cart\NoSuchElementException;
use Magium\Magento\Themes\AbstractThemeConfiguration;

class AddToCart extends AbstractExtractor
{

    /**
     * @var AbstractThemeConfiguration
     */

    protected $theme;

    protected $element;

    /**
     * @return WebDriverElement
     */

    public function getElement()
    {
        $this->extract();
        return $this->element;
    }

    public function extract()
    {
        if (!$this->webDriver->elementExists($this->theme->getAddToCartXpath(), 'byXpath')) {
            throw new NoSuchElementException('Could not find the simple add to cart element with the Xpath: ' . $this->theme->getAddToCartXpath());
        };


        $this->element = $this->webDriver->byXpath($this->theme->getAddToCartXpath());

    }

}