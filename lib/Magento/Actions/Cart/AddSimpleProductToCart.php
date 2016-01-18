<?php

namespace Magium\Magento\Actions\Cart;

use Magium\Actions\WaitForPageLoaded;
use Magium\Magento\Themes\AbstractThemeConfiguration;
use Magium\WebDriver\WebDriver;

class AddSimpleProductToCart
{

    const ACTION = 'Cart\AddSimpleProductToCart';

    const EXCEPTION_NO_ELEMENT = 'Magium\Magento\Actions\Cart\NoSuchElementException';
    const EXCEPTION_ADD_TO_CART_FAILED = 'Magium\Magento\Actions\Cart\AddToCartFailedException';

    protected $webDriver;
    protected $theme;
    protected $loaded;

    protected $requireQty;
    protected $addQty;

    public function __construct(
        WebDriver $webDriver,
        AbstractThemeConfiguration $themeConfiguration,
        WaitForPageLoaded $loaded
    )
    {
        $this->webDriver = $webDriver;
        $this->theme = $themeConfiguration;
        $this->loaded = $loaded;
    }

    public function requireQty($require = true)
    {
        $this->requireQty = $require;
    }

    public function addQty($number)
    {
        $this->requireQty();
        $this->addQty = $number;
    }

    public function execute()
    {
        if (!$this->webDriver->elementExists($this->theme->getSimpleProductAddToCartXpath(), 'byXpath')) {
            throw new NoSuchElementException('Could not find the simple add to cart element with the Xpath: ' . $this->theme->getSimpleProductAddToCartXpath());
        };

        if ($this->requireQty || $this->addQty > 1) {
            if (!$this->webDriver->elementExists($this->theme->getSimpleProductQtyXpath(), WebDriver::BY_XPATH)) {
                throw new NoSuchElementException('Could not find the simple add to cart element with the Xpath: ' . $this->theme->getSimpleProductAddToCartXpath());
            }
            $element = $this->webDriver->byXpath($this->theme->getSimpleProductQtyXpath());
            $element->clear();
            $element->sendKeys($this->addQty);
        }

        $element = $this->webDriver->byXpath($this->theme->getSimpleProductAddToCartXpath());

        $element->click();
        $this->loaded->execute($element);

        if (!$this->webDriver->elementExists($this->theme->getAddToCartSuccessXpath(), WebDriver::BY_XPATH)) {
            throw new AddToCartFailedException('Add to cart verification failed finding element with Xpath: ' . $this->theme->getAddToCartSuccessXpath());
        }

    }

}