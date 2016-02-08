<?php

namespace Magium\Magento\Actions\Cart;

use Magium\Magento\Extractors\Catalog\Cart\AddToCart;
use Magium\Magento\Themes\AbstractThemeConfiguration;
use Magium\WebDriver\ExpectedCondition;
use Magium\WebDriver\WebDriver;

class AddSimpleProductToCart
{

    const ACTION = 'Cart\AddSimpleProductToCart';

    const EXCEPTION_NO_ELEMENT = 'Magium\Magento\Actions\Cart\NoSuchElementException';
    const EXCEPTION_ADD_TO_CART_FAILED = 'Magium\Magento\Actions\Cart\AddToCartFailedException';

    protected $webDriver;
    protected $theme;
    protected $addToCart;

    protected $requireQty;
    protected $addQty;

    public function __construct(
        WebDriver $webDriver,
        AbstractThemeConfiguration $themeConfiguration,
        AddToCart $addToCart
    )
    {
        $this->webDriver = $webDriver;
        $this->theme = $themeConfiguration;
        $this->addToCart = $addToCart;
    }

    public function requireQty($require = true)
    {
        $this->requireQty = $require;
    }

    public function setQty($number)
    {
        $this->requireQty();
        $this->addQty = $number;
    }

    public function execute()
    {
        if ($this->requireQty || $this->addQty > 1) {
            if (!$this->webDriver->elementExists($this->theme->getSimpleProductQtyXpath(), WebDriver::BY_XPATH)) {
                throw new NoSuchElementException('Could not find the simple add to cart element with the Xpath: ' . $this->theme->getAddToCartXpath());
            }
            $element = $this->webDriver->byXpath($this->theme->getSimpleProductQtyXpath());
            $element->clear();
            $element->sendKeys($this->addQty);
        }
        $this->clickAddToCart();
    }

    protected function clickAddToCart()
    {
        $element = $this->addToCart->getElement();
        // Because, for some reason, the M2 design HIDES the add-to-cart button as part of the default theme.   Why
        // would you want to hide the second most important button on the site?

        try {
            $element->click();
        } catch (\Exception $e) {
            $e2 = $this->webDriver->byXpath($this->theme->getAddToCartXpath() . '/ancestor::li');
            $this->webDriver->getMouse()->mouseMove($e2->getCoordinates());
            $element->click();
        }
        $this->webDriver->wait()->until(ExpectedCondition::elementExists($this->theme->getAddToCartSuccessXpath(), WebDriver::BY_XPATH));
        $element = $this->webDriver->byXpath($this->theme->getAddToCartSuccessXpath());
        $this->webDriver->wait()->until(ExpectedCondition::visibilityOf($element));

    }

}