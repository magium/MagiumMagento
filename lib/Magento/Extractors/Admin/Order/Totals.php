<?php

namespace Magium\Magento\Extractors\Admin\Order;

use Magium\Extractors\AbstractExtractor;
use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Themes\AdminThemeConfiguration;
use Magium\WebDriver\WebDriver;

class Totals extends AbstractExtractor
{
    const VALUE_SUBTOTAL                = 'subtotal';
    const VALUE_SHIPPING_AND_HANDLING   = 'shipping-and-handling';
    const VALUE_TAX                     = 'tax';
    const VALUE_GRAND_TOTAL             = 'grand-total';
    const VALUE_TOTAL_PAID              = 'total-paid';
    const VALUE_TOTAL_REFUNDED          = 'total-refunded';
    const VALUE_TOTAL_DUE               = 'total-due';

    public function __construct(WebDriver $webDriver, AbstractMagentoTestCase $testCase, AdminThemeConfiguration $theme)
    {
        parent::__construct($webDriver, $testCase, $theme);
    }


    public function getSubTotal()
    {
        return $this->getValue(self::VALUE_SUBTOTAL);
    }

    public function getShippingAndHandling()
    {
        return $this->getValue(self::VALUE_SHIPPING_AND_HANDLING);
    }

    public function getTax()
    {
        return $this->getValue(self::VALUE_TAX);
    }

    public function getGrandTotal()
    {
        return $this->getValue(self::VALUE_GRAND_TOTAL);
    }

    public function getTotalPaid()
    {
        return $this->getValue(self::VALUE_TOTAL_PAID);
    }

    public function getTotalRefunded()
    {
        return $this->getValue(self::VALUE_TOTAL_REFUNDED);
    }

    public function getTotalDue()
    {
        return $this->getValue(self::VALUE_TOTAL_DUE);
    }


    public function extract()
    {
        $translator = $this->testCase->getTranslator();
        $baseXpath = '//div[contains(concat(" ",normalize-space(@class)," ")," order-totals ")]/descendant::td[contains(., "%s")]/../td/descendant::span[@class="price"]';

        $this->values[self::VALUE_SUBTOTAL]
            = $this->webDriver->byXpath(sprintf($baseXpath, $translator->translate('Subtotal')))->getText();

        $this->values[self::VALUE_SHIPPING_AND_HANDLING]
            = $this->webDriver->byXpath(sprintf($baseXpath, $translator->translate('Shipping & Handling')))->getText();

        $this->values[self::VALUE_TAX]
            = $this->webDriver->byXpath(sprintf($baseXpath, $translator->translate('Tax')))->getText();

        $this->values[self::VALUE_GRAND_TOTAL]
            = $this->webDriver->byXpath(sprintf($baseXpath, $translator->translate('Grand Total')))->getText();

        $this->values[self::VALUE_TOTAL_PAID]
            = $this->webDriver->byXpath(sprintf($baseXpath, $translator->translate('Total Paid')))->getText();

        $this->values[self::VALUE_TOTAL_REFUNDED]
            = $this->webDriver->byXpath(sprintf($baseXpath, $translator->translate('Total Refunded')))->getText();

        $this->values[self::VALUE_TOTAL_DUE]
            = $this->webDriver->byXpath(sprintf($baseXpath, $translator->translate('Total Due')))->getText();
    }

}