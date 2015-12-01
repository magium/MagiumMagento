<?php

namespace Magium\Magento\Extractors\Checkout;

use Magium\Magento\Actions\Checkout\Steps\StepInterface;
use Magium\Extractors\AbstractExtractor;
use Magium\WebDriver\WebDriver;

class CartSummary extends AbstractExtractor implements StepInterface
{

    /**
     * Redefined here has a code completion helper
     *
     * @var \Magium\Magento\Themes\ThemeConfiguration
     */

    protected $theme;

    const VALUE_PRODUCTS    = 'products';
    const VALUE_SUBTOTAL    = 'subtotal';
    const VALUE_SnH         = 'ship-handle';
    const VALUE_TAX         = 'tax';
    const VALUE_GRAND_TOTAL = 'grand-total';

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
        $count = 0;

        $testProductXpath = $this->theme->getCartSummaryCheckoutProductLoopNameXpath();

        while ($this->webDriver->elementExists(sprintf($testProductXpath, ++$count), WebDriver::BY_XPATH)) {
            $nameElement = $this->webDriver->byXpath(sprintf($this->theme->getCartSummaryCheckoutProductLoopNameXpath(), $count));
            $priceElement = $this->webDriver->byXpath(sprintf($this->theme->getCartSummaryCheckoutProductLoopPriceXpath(), $count));
            $qtyElement = $this->webDriver->byXpath(sprintf($this->theme->getCartSummaryCheckoutProductLoopQtyXpath(), $count));
            $subtotalElement = $this->webDriver->byXpath(sprintf($this->theme->getCartSummaryCheckoutProductLoopSubtotalXpath(), $count));

            $name = trim($nameElement->getText());
            $price = trim($priceElement->getText()); // We do not extract the number value so currency checks can be done
            $qty = trim($qtyElement->getText());
            $subtotal = trim($subtotalElement->getText());

            $product = new Product($name, $qty, $price, $subtotal);
            $productIterator->addProduct($product);
        }

        $this->values[self::VALUE_GRAND_TOTAL]
            = trim($this->webDriver->byXpath($this->theme->getCartSummaryCheckoutGrandTotal())->getText());
        $this->values[self::VALUE_TAX]
            = trim($this->webDriver->byXpath($this->theme->getCartSummaryCheckoutTax())->getText());
        $this->values[self::VALUE_SnH]
            = trim($this->webDriver->byXpath($this->theme->getCartSummaryCheckoutShippingTotal())->getText());
        $this->values[self::VALUE_SUBTOTAL]
            = trim($this->webDriver->byXpath($this->theme->getCartSummaryCheckoutSubTotal())->getText());

    }

    public function execute()
    {
        $this->extract();
        return true;
    }

}