<?php

namespace Magium\Magento\Extractors\Customer\Order;

class Item
{
    const EXTRACTOR = 'Customer\Order\Item';
    protected $productName;
    protected $sku;
    protected $price;
    protected $qtyOrdered;
    protected $qtyShipped;
    protected $subTotal;

    /**
     * OrderItem constructor.
     * @param $price
     * @param $productName
     * @param $qtyOrdered
     * @param $qtyShipped
     * @param $sku
     * @param $subTotal
     */
    public function __construct($price, $productName, $qtyOrdered, $qtyShipped, $sku, $subTotal)
    {
        $this->price = $price;
        $this->productName = $productName;
        $this->qtyOrdered = $qtyOrdered;
        $this->qtyShipped = $qtyShipped;
        $this->sku = $sku;
        $this->subTotal = $subTotal;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return mixed
     */
    public function getProductName()
    {
        return $this->productName;
    }

    /**
     * @return mixed
     */
    public function getQtyOrdered()
    {
        return $this->qtyOrdered;
    }

    /**
     * @return mixed
     */
    public function getQtyShipped()
    {
        return $this->qtyShipped;
    }

    /**
     * @return mixed
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * @return mixed
     */
    public function getSubTotal()
    {
        return $this->subTotal;
    }


}