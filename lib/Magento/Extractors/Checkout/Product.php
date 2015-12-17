<?php

namespace Magium\Magento\Extractors\Checkout;

class Product
{

    const EXTRACTOR = 'Checkout\Product';
    protected $name;
    protected $qty;
    protected $price;
    protected $subTotal;

    /**
     * Product constructor.
     * @param $name
     * @param $qty
     * @param $price
     * @param $subTotal
     */
    public function __construct($name, $qty, $price, $subTotal)
    {
        $this->name = $name;
        $this->qty = $qty;
        $this->price = $price;
        $this->subTotal = $subTotal;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getQty()
    {
        return $this->qty;
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
    public function getSubTotal()
    {
        return $this->subTotal;
    }


}