<?php

namespace Tests\Magium\Magento\Checkout;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Actions\Cart\AddItemToCart;
use Magium\Magento\Actions\Checkout\GuestCheckout;
use Magium\Magento\Actions\Checkout\Steps\BillingAddress;
use Magium\Magento\Extractors\Checkout\OrderId;
use Magium\Magento\Identities\Customer;
use Magium\Magento\Navigators\Customer\NavigateToOrder;

class GuestCheckoutTest extends AbstractMagentoTestCase
{

    public function testBasicCheckout()
    {
        $theme = $this->getTheme();
        $this->commandOpen($theme->getBaseUrl());
        $addToCart = $this->getAction(AddItemToCart::ACTION);
        /* @var $addToCart \Magium\Magento\Actions\Cart\AddItemToCart */

        $addToCart->addSimpleProductToCartFromCategoryPage();
        $this->setPaymentMethod('CashOnDelivery');
        $guestCheckout = $this->getAction(GuestCheckout::ACTION);
        /* @var $guestCheckout \Magium\Magento\Actions\Checkout\GuestCheckout */

        $guestCheckout->execute();

        $orderId = $this->getExtractor(OrderId::EXTRACTOR);
        /** @var $orderId OrderId */
        self::assertNotNull($orderId->getOrderId());
        self::assertGreaterThan(0, $orderId->getOrderId());
    }

    public function testCheckoutWithDifferentAddress()
    {
        // Setting up the test
        $this->setPaymentMethod('CashOnDelivery');
        $billingAddress = $this->getAction(BillingAddress::ACTION);
        /* @var $billingAddress \Magium\Magento\Actions\Checkout\Steps\BillingAddress */
        $billingAddress->shipToDifferentAddress();
        $customer = $this->getIdentity(Customer::IDENTITY);
        /* @var $customer \Magium\Magento\Identities\Customer */
        $customer->setShippingFirstName('Bob');
        $guestCheckout = $this->getAction(GuestCheckout::ACTION);

        // executing the test

        $theme = $this->getTheme();
        $this->commandOpen($theme->getBaseUrl());
        $addToCart = $this->getAction(AddItemToCart::ACTION);
        /* @var $addToCart \Magium\Magento\Actions\Cart\AddItemToCart */

        $addToCart->addSimpleProductToCartFromCategoryPage();
        /* @var $guestCheckout \Magium\Magento\Actions\Checkout\GuestCheckout */

        $guestCheckout->execute();

        $orderId = $this->getExtractor(OrderId::EXTRACTOR);
        /** @var $orderId OrderId */
        self::assertNotNull($orderId->getOrderId());
        self::assertGreaterThan(0, $orderId->getOrderId());

        $this->getNavigator(NavigateToOrder::NAVIGATOR)->navigateTo($orderId->getOrderId());
        $shippingAddress = $this->getExtractor(Ord)
    }

}