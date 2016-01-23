<?php

namespace Magium\Magento\Actions\Checkout\Magento2;

use Magium\Magento\Actions\Checkout\AbstractCheckout;
use Magium\Magento\Actions\Checkout\Steps\BillingAddress;
use Magium\Magento\Actions\Checkout\Steps\PaymentMethod;
use Magium\Magento\Actions\Checkout\Steps\PlaceOrder;
use Magium\Magento\Actions\Checkout\Steps\ShippingAddress;
use Magium\Magento\Actions\Checkout\Steps\ShippingMethod;
use Magium\Magento\Extractors\Checkout\CartSummary;
use Magium\Magento\Extractors\Checkout\OrderId;
use Magium\Magento\Navigators\Checkout\CheckoutStart;

class GuestCheckout extends AbstractCheckout
{
    const ACTION = 'Checkout\Magento2\GuestCheckout';

    public function __construct(
        CheckoutStart             $navigator,
        BillingAddress          $billingAddress,
        ShippingAddress         $shippingAddress,
        ShippingMethod          $shippingMethod,
        PaymentMethod           $paymentMethod,
        CartSummary             $cartSummary,
        PlaceOrder              $placeOrder,
        OrderId                 $orderIdExtractor
    )
    {
        $this->addStep($navigator);
        $this->addStep($shippingAddress);
        $this->addStep($shippingMethod);
        $this->addStep($billingAddress);
        $this->addStep($paymentMethod);
        $this->addStep($cartSummary);
        $this->addStep($placeOrder);
        $this->addStep($orderIdExtractor);

    }

}