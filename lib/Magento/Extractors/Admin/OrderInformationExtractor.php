<?php

namespace Magium\Magento\Extractors\Admin;

use Magium\Magento\Extractors\AbstractExtractor;
use Magium\Magento\Extractors\Admin\Order\AccountInformation;
use Magium\Magento\Extractors\Admin\Order\BillingAddress;
use Magium\Magento\Extractors\Admin\Order\OrderItems;
use Magium\Magento\Extractors\Admin\Order\OrderSummary;
use Magium\Magento\Extractors\Admin\Order\PaymentInformation;
use Magium\Magento\Extractors\Admin\Order\ShippingAddress;
use Magium\Magento\Extractors\Admin\Order\ShippingInformation;
use Magium\Magento\Extractors\Admin\Order\Totals;

class OrderInformationExtractor extends AbstractExtractor
{

    protected $accountInformation;
    protected $billingAddress;
    protected $orderItems;
    protected $orderSummary;
    protected $paymentInformation;
    protected $shippingAddress;
    protected $shippingInformation;
    protected $totals;

    public function __construct(
        AccountInformation      $accountInformation,
        BillingAddress          $billingAddress,
        OrderItems              $orderItems,
        OrderSummary            $orderSummary,
        PaymentInformation      $paymentInformation,
        ShippingAddress         $shippingAddress,
        ShippingInformation     $shippingInformation,
        Totals                  $totals
    )
    {
        $this->accountInformation       = $accountInformation;
        $this->billingAddress           = $billingAddress;
        $this->orderItems               = $orderItems;
        $this->orderSummary             = $orderSummary;
        $this->paymentInformation       = $paymentInformation;
        $this->shippingAddress          = $shippingAddress;
        $this->shippingInformation      = $shippingInformation;
        $this->totals                   = $totals;
    }

    public function extract()
    {

    }

}