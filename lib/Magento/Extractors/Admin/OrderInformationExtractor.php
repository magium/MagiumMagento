<?php

namespace Magium\Magento\Extractors\Admin;

use Magium\Extractors\AbstractExtractor;
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

    protected $extractors = [];

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
        $this->extractors[] = $accountInformation;
        $this->extractors[] = $billingAddress;
        $this->extractors[] = $orderItems;
        $this->extractors[] = $orderSummary;
        $this->extractors[] = $paymentInformation;
        $this->extractors[] = $shippingAddress;
        $this->extractors[] = $shippingInformation;
        $this->extractors[] = $totals;
    }

    public function extract()
    {
        foreach ($this->extractors as $extractor) {
            if ($extractor instanceof AbstractExtractor) {
                $extractor->extract();
            }
        }
    }

}