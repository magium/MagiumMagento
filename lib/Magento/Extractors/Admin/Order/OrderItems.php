<?php

namespace Magium\Magento\Extractors\Admin\Order;

use Magium\Extractors\AbstractExtractor;
use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Themes\Admin\ThemeConfiguration;
use Magium\WebDriver\WebDriver;

class OrderItems extends AbstractExtractor
{

    protected $orderItems = [];

    public function __construct(WebDriver $webDriver, AbstractMagentoTestCase $testCase, ThemeConfiguration $theme)
    {
        parent::__construct($webDriver, $testCase, $theme);
    }

    public function getOrderItems()
    {
        return $this->orderItems;
    }

    public function extract()
    {
        $translator = $this->testCase->getTranslator();
        $baseXpath              = '//h4[contains(concat(" ",normalize-space(@class)," ")," head-products ")]/../../following-sibling::div[1]/descendant::tr[%d]';
        $titleXpath             = $baseXpath . '/descendant::div[contains(concat(" ",normalize-space(@class)," ")," item-text ")]/h5';
        $skuXpath               = $baseXpath . '/descendant::div[contains(concat(" ",normalize-space(@class)," ")," item-text ")]/div';
        $itemStatusXpath        = $baseXpath . '/td[2]';
        $originalPriceXpath     = $baseXpath . '/td[3]/span';
        $priceXpath             = $baseXpath . '/td[4]/descendant::span[contains(concat(" ",normalize-space(@class)," ")," price ")]';
        $orderedQtyXpath        = $baseXpath . sprintf('/td[5]/descendant::td[.="%s"]/../td/strong', $translator->translate('Ordered'));
        $invoicedQtyXpath       = $baseXpath . sprintf('/td[5]/descendant::td[.="%s"]/../td/strong', $translator->translate('Invoiced'));
        $shippedQtyXpath        = $baseXpath . sprintf('/td[5]/descendant::td[.="%s"]/../td/strong', $translator->translate('Shipped'));
        $subtotalXpath          = $baseXpath . '/td[6]/descendant::span[contains(concat(" ",normalize-space(@class)," ")," price ")]';
        $taxXpath               = $baseXpath . '/td[7]/descendant::span[contains(concat(" ",normalize-space(@class)," ")," price ")]';
        $taxPercentXpath        = $baseXpath . '/td[8]';
        $discountAmountXpath    = $baseXpath . '/td[9]/descendant::span[contains(concat(" ",normalize-space(@class)," ")," price ")]';
        $rowTotalXpath          = $baseXpath . '/td[10]/descendant::span[contains(concat(" ",normalize-space(@class)," ")," price ")]';

        $count = 2; // To take into account the order items header
        while ($this->webDriver->elementExists(sprintf($skuXpath, $count), WebDriver::BY_XPATH)) {
            $productName = trim($this->webDriver->byXpath(sprintf($titleXpath, $count))->getText());
            $sku = $this->webDriver->byXpath(sprintf($skuXpath, $count))->getText();
            $sku = trim(str_replace($translator->translate('SKU').':', '', $sku));
            $status = trim($this->webDriver->byXpath(sprintf($itemStatusXpath, $count))->getText());
            $originalPrice = trim($this->webDriver->byXpath(sprintf($originalPriceXpath, $count))->getText());
            $price = trim($this->webDriver->byXpath(sprintf($priceXpath, $count))->getText());
            $qtyOrdered = 0;
            if ($this->webDriver->elementExists(sprintf($orderedQtyXpath, $count), WebDriver::BY_XPATH)) {
                $qtyOrdered = trim($this->webDriver->byXpath(sprintf($orderedQtyXpath, $count))->getText());
            }
            $qtyInvoiced = 0;
            if ($this->webDriver->elementExists(sprintf($invoicedQtyXpath, $count), WebDriver::BY_XPATH)) {
                $qtyInvoiced = trim($this->webDriver->byXpath(sprintf($invoicedQtyXpath, $count))->getText());
            }
            $qtyShipped = 0;
            if ($this->webDriver->elementExists(sprintf($shippedQtyXpath, $count), WebDriver::BY_XPATH)) {
                $qtyShipped = trim($this->webDriver->byXpath(sprintf($shippedQtyXpath, $count))->getText());
            }
            $subTotal = trim($this->webDriver->byXpath(sprintf($subtotalXpath, $count))->getText());
            $taxAmount = trim($this->webDriver->byXpath(sprintf($taxXpath, $count))->getText());
            $taxPercent = trim($this->webDriver->byXpath(sprintf($taxPercentXpath, $count))->getText());
            $discountAmount = trim($this->webDriver->byXpath(sprintf($discountAmountXpath, $count))->getText());
            $rowTotal = trim($this->webDriver->byXpath(sprintf($rowTotalXpath, $count))->getText());
            $this->orderItems[] = new OrderItem(
                $productName,
                $sku,
                $status,
                $originalPrice,
                $price,
                $qtyOrdered,
                $qtyInvoiced,
                $qtyShipped,
                $subTotal,
                $taxAmount,
                $taxPercent,
                $discountAmount,
                $rowTotal
            );
            $count++;
        }
    }

}