<?php

namespace Magium\Magento\Actions\Checkout\Magento2;

use Magium\Magento\Actions\Checkout\AbstractCheckout;
use Magium\Magento\Actions\Checkout\Steps\CustomerBillingAddress;
use Magium\Magento\Actions\Checkout\Steps\LogInCustomer;
use Magium\Magento\Actions\Checkout\Steps\PaymentMethod;
use Magium\Magento\Actions\Checkout\Steps\PlaceOrder;
use Magium\Magento\Actions\Checkout\Steps\ReviewOrder;
use Magium\Magento\Actions\Checkout\Steps\SelectCustomerCheckout;
use Magium\Magento\Actions\Checkout\Steps\ShippingAddress;
use Magium\Magento\Actions\Checkout\Steps\ShippingMethod;
use Magium\Magento\Extractors\Checkout\CartSummary;
use Magium\Magento\Extractors\Checkout\OrderId;
use Magium\Magento\Navigators\Checkout\Checkout;
use Magium\Magento\Navigators\Checkout\CheckoutStart;
use Magium\Magento\Themes\OnePageCheckout\AbstractThemeConfiguration;

class CustomerCheckout extends AbstractCheckout
{
    const ACTION = 'Checkout\Magento2\CustomerCheckout';

    public function __construct(
        CheckoutStart             $navigator,
        AbstractThemeConfiguration    $theme,
        LogInCustomer           $logInCustomer,
        CustomerBillingAddress  $billingAddress,
        ShippingAddress         $shippingAddress,
        ShippingMethod          $shippingMethod,
        PaymentMethod           $paymentMethod,
        CartSummary             $cartSummary,
        PlaceOrder              $placeOrder,
        OrderId                 $orderIdExtractor
    )
    {
        $this->addStep($navigator);
        $this->addStep($logInCustomer);
        $this->addStep($billingAddress);
        $this->addStep($shippingAddress);
        $this->addStep($shippingMethod);
        $this->addStep($paymentMethod);
        $this->addStep($cartSummary);
        $this->addStep($placeOrder);
        $this->addStep($orderIdExtractor);

    }

}