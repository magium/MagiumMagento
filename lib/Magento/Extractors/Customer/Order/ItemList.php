<?php

namespace Magium\Magento\Extractors\Customer\Order;


use Facebook\WebDriver\WebDriverElement;
use Magium\WebDriver\WebDriver;

class ItemList extends AbstractOrderExtractor
{

    const EXTRACTOR = 'Customer\Order\ItemList';

    protected $element;
    protected $items;

    /**
     * @return Item[]
     */

    public function getItems()
    {
        return $this->items;
    }

    public function extract()
    {
        if ($this->element instanceof WebDriverElement && $this->webDriver->elementAttached($this->element)) {
            return;
        }
        $this->element = $this->webDriver->byXpath('//body'); // Just need any element on the page
        $count = 0;

        $this->items = [];

        while ($this->webDriver->elementExists($this->theme->getOrderItemNameXpath(++$count), WebDriver::BY_XPATH)) {
            $productName = trim($this->webDriver->byXpath($this->theme->getOrderItemNameXpath($count))->getText());
            $productSku = trim($this->webDriver->byXpath($this->theme->getOrderItemSkuXpath($count))->getText());
            $productPrice = trim($this->webDriver->byXpath($this->theme->getOrderItemPriceXpath($count))->getText());
            $qty = trim($this->webDriver->byXpath($this->theme->getOrderItemQtyXpath($count))->getText());
            $qtyShipped = $qtyOrdered = 0;
            $matched = null;
            if (preg_match($this->theme->getOrderItemQtyOrderedRegex(), $qty, $matched)) {
                $qtyOrdered = $matched[1];
            }
            if (preg_match($this->theme->getOrderItemQtyShippedRegex(), $qty, $matched)) {
                $qtyShipped = $matched[1];
            }
            $orderSubtotal = trim($this->webDriver->byXpath($this->theme->getOrderItemSubtotalXpath($count))->getText());
            $item = new Item($productPrice, $productName, $qtyOrdered, $qtyShipped, $productSku, $orderSubtotal);
            $this->items[] = $item;
        }
    }

}