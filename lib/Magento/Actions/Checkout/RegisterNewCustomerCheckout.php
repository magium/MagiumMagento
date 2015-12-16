<?php

namespace Magium\Magento\Actions\Checkout;

use Magium\Magento\Actions\Checkout\Steps\BillingAddress;
use Magium\Magento\Actions\Checkout\Steps\NewCustomerPassword;
use Magium\Magento\Actions\Checkout\Steps\PaymentMethod;
use Magium\Magento\Actions\Checkout\Steps\PlaceOrder;
use Magium\Magento\Actions\Checkout\Steps\ReviewOrder;
use Magium\Magento\Actions\Checkout\Steps\SelectCustomerCheckout;
use Magium\Magento\Actions\Checkout\Steps\SelectRegisterNewCustomerCheckout;
use Magium\Magento\Actions\Checkout\Steps\ShippingAddress;
use Magium\Magento\Actions\Checkout\Steps\ShippingMethod;
use Magium\Magento\Extractors\Checkout\CartSummary;
use Magium\Magento\Extractors\Checkout\OrderId;
use Magium\Magento\Navigators\Checkout\Checkout;
use Magium\Magento\Navigators\Checkout\CheckoutStart;
use Magium\Magento\Themes\OnePageCheckout\AbstractThemeConfiguration;
use Magium\Magento\Themes\OnePageCheckout\ThemeConfiguration as OnePageCheckoutTheme;

class RegisterNewCustomerCheckout extends AbstractCheckout
{

    public function __construct(
        CheckoutStart             $navigator,
        AbstractThemeConfiguration    $theme,
        SelectRegisterNewCustomerCheckout           $registerNewCustomerCheckout,
        BillingAddress  $billingAddress,
        ShippingAddress         $shippingAddress,
        ShippingMethod          $shippingMethod,
        PaymentMethod           $paymentMethod,
        CartSummary             $cartSummary,
        PlaceOrder              $placeOrder,
        OrderId                 $orderIdExtractor,
        NewCustomerPassword     $newCustomerPassword
    )
    {
        $this->addStep($navigator);
        $this->addStep($registerNewCustomerCheckout);
        $this->addStep($newCustomerPassword);
        $this->addStep($billingAddress);
        $this->addStep($shippingAddress);
        $this->addStep($shippingMethod);
        $this->addStep($paymentMethod);
        $this->addStep($cartSummary);
        $this->addStep($placeOrder);
        $this->addStep($orderIdExtractor);

    }

}