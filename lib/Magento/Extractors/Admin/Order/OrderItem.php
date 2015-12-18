<?php

namespace Magium\Magento\Extractors\Admin\Order;

class OrderItem
{
    const EXTRACTOR = 'Admin\Order\OrderItem';
    protected $productName;
    protected $sku;
    protected $status;
    protected $originalPrice;
    protected $price;
    protected $qtyOrdered;
    protected $qtyInvoiced;
    protected $qtyShipped;
    protected $subTotal;
    protected $taxAmount;
    protected $taxPercent;
    protected $discountAmount;
    protected $rowTotal;

    /**
     * OrderItem constructor.
     * @param $productName
     * @param $sku
     * @param $status
     * @param $originalPrice
     * @param $price
     * @param $qtyOrdered
     * @param $qtyInvoiced
     * @param $qtyShipped
     * @param $subTotal
     * @param $taxAmount
     * @param $taxPercent
     * @param $discountAmount
     * @param $rowTotal
     */
    public function __construct($productName, $sku, $status, $originalPrice, $price, $qtyOrdered, $qtyInvoiced, $qtyShipped, $subTotal, $taxAmount, $taxPercent, $discountAmount, $rowTotal)
    {
        $this->productName = $productName;
        $this->sku = $sku;
        $this->status = $status;
        $this->originalPrice = $originalPrice;
        $this->price = $price;
        $this->qtyOrdered = $qtyOrdered;
        $this->qtyInvoiced = $qtyInvoiced;
        $this->qtyShipped = $qtyShipped;
        $this->subTotal = $subTotal;
        $this->taxAmount = $taxAmount;
        $this->taxPercent = $taxPercent;
        $this->discountAmount = $discountAmount;
        $this->rowTotal = $rowTotal;
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
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function getOriginalPrice()
    {
        return $this->originalPrice;
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
    public function getQtyOrdered()
    {
        return $this->qtyOrdered;
    }

    /**
     * @return mixed
     */
    public function getQtyInvoiced()
    {
        return $this->qtyInvoiced;
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
    public function getSubTotal()
    {
        return $this->subTotal;
    }

    /**
     * @return mixed
     */
    public function getTaxAmount()
    {
        return $this->taxAmount;
    }

    /**
     * @return mixed
     */
    public function getTaxPercent()
    {
        return $this->taxPercent;
    }

    /**
     * @return mixed
     */
    public function getDiscountAmount()
    {
        return $this->discountAmount;
    }

    /**
     * @return mixed
     */
    public function getRowTotal()
    {
        return $this->rowTotal;
    }


}