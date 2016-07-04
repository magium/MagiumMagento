<?php

namespace Magium\Magento\Extractors\Checkout;

use Magium\AbstractTestCase;
use Magium\Extractors\AbstractExtractor;
use Magium\Magento\Actions\Checkout\Steps\StepInterface;
use Magium\Magento\Themes\OnePageCheckout\AbstractThemeConfiguration;
use Magium\WebDriver\ExpectedCondition;
use Magium\WebDriver\WebDriver;

class CartSummary extends AbstractExtractor implements StepInterface
{
    const EXTRACTOR = 'Checkout\CartSummary';
    /**
     * Redefined here has a code completion helper
     *
     * @var \Magium\Magento\Themes\OnePageCheckout\AbstractThemeConfiguration
     */

    protected $theme;

    const VALUE_PRODUCTS    = 'products';
    const VALUE_SUBTOTAL    = 'subtotal';
    const VALUE_SnH         = 'ship-handle';
    const VALUE_TAX         = 'tax';
    const VALUE_GRAND_TOTAL = 'grand-total';

    public function __construct(
        WebDriver           $webDriver,
        AbstractTestCase    $testCase,
        AbstractThemeConfiguration $theme
    )
    {
        parent::__construct($webDriver, $testCase, $theme);
    }

    /**
     * @return ProductIterator
     */

    public function getProducts()
    {
        return $this->getValue(self::VALUE_PRODUCTS);
    }

    public function getSubTotal()
    {
        return $this->getValue(self::VALUE_SUBTOTAL);
    }

    public function getShippingAndHandling()
    {
        return $this->getValue(self::VALUE_SnH);
    }

    public function getTax()
    {
        return $this->getValue(self::VALUE_TAX);
    }

    public function getGrandTotal()
    {
        return $this->getValue(self::VALUE_GRAND_TOTAL);
    }

    public function extract()
    {
        $productIterator = new ProductIterator();
        $this->values[self::VALUE_PRODUCTS] = $productIterator;
        $count = 1;

        $testProductXpath = $this->theme->getCartSummaryCheckoutProductLoopNameXpath($count);
        $this->webDriver->wait()->until(ExpectedCondition::elementExists($testProductXpath, WebDriver::BY_XPATH));

        while ($this->webDriver->elementExists($testProductXpath, WebDriver::BY_XPATH)) {

            $xpath = $this->theme->getCartSummaryCheckoutProductLoopNameXpath($count);
            $nameElement = $this->webDriver->byXpath($xpath);
            $name = trim($nameElement->getText());

            $xpath = $this->theme->getCartSummaryCheckoutProductLoopPriceXpath($count);
            if ($this->webDriver->elementExists($xpath, WebDriver::BY_XPATH)) {
                $priceElement = $this->webDriver->byXpath($xpath);
                $price = trim($priceElement->getText()); // We do not extract the number value so currency checks can be done
            } else {
                $price = 0;
            }

            $xpath = $this->theme->getCartSummaryCheckoutProductLoopQtyXpath($count);
            if ($this->webDriver->elementExists($xpath, WebDriver::BY_XPATH)) {
                $qtyElement = $this->webDriver->byXpath($xpath);
                $qty = trim($qtyElement->getText());
            } else {
                $qty = 0;
            }

            $xpath = $this->theme->getCartSummaryCheckoutProductLoopSubtotalXpath($count);
            if ($this->webDriver->elementExists($xpath, WebDriver::BY_XPATH)) {
                $subtotalElement = $this->webDriver->byXpath($xpath);
                $subtotal = trim($subtotalElement->getText());
            } else {
                $subtotal = 0;
            }

            $product = new Product($name, $qty, $price, $subtotal);
            $productIterator->addProduct($product);
            $testProductXpath = $this->theme->getCartSummaryCheckoutProductLoopNameXpath(++$count);
        }

        // Tax and shipping may not be displayed

        if ($this->webDriver->elementDisplayed($this->theme->getCartSummaryCheckoutTax(), WebDriver::BY_XPATH)) {
            $this->values[self::VALUE_TAX]
                = trim($this->webDriver->byXpath($this->theme->getCartSummaryCheckoutTax())->getText());
        }
        if ($this->webDriver->elementDisplayed($this->theme->getCartSummaryCheckoutShippingTotal(), WebDriver::BY_XPATH)) {
            $this->values[self::VALUE_SnH]
                = trim($this->webDriver->byXpath($this->theme->getCartSummaryCheckoutShippingTotal())->getText());
        }



        $this->values[self::VALUE_GRAND_TOTAL]
            = trim($this->webDriver->byXpath($this->theme->getCartSummaryCheckoutGrandTotal())->getText());
        $this->values[self::VALUE_SUBTOTAL]
            = trim($this->webDriver->byXpath($this->theme->getCartSummaryCheckoutSubTotal())->getText());

    }

    public function execute()
    {
        $this->extract();
        return true;
    }

    public function nextAction()
    {
        return true;
    }
}