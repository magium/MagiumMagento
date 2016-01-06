<?php

namespace Tests\Magium\Magento\Checkout;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Actions\Cart\AddItemToCart;
use Magium\Magento\Actions\Checkout\CustomerCheckout;
use Magium\Magento\Actions\Checkout\Steps\CustomerBillingAddress;
use Magium\Magento\Actions\Checkout\Steps\ShippingAddress;
use Magium\Magento\Extractors\Checkout\OrderId;
use Magium\Magento\Navigators\Customer\AccountHome;
use Magium\Magento\Navigators\Customer\NavigateToOrder;

class CustomerCheckoutTest extends AbstractMagentoTestCase
{

    public function testBasicCheckout()
    {
        $theme = $this->getTheme();
        $this->commandOpen($theme->getBaseUrl());
        $this->getLogger()->info('Opening page ' . $theme->getBaseUrl());
        $addToCart = $this->getAction(AddItemToCart::ACTION);
        /* @var $addToCart \Magium\Magento\Actions\Cart\AddItemToCart */

        $addToCart->addSimpleProductToCartFromCategoryPage();
        $this->setPaymentMethod('CashOnDelivery');
         $customerCheckout= $this->getAction(CustomerCheckout::ACTION);
        /* @var $customerCheckout \Magium\Magento\Actions\Checkout\CustomerCheckout */

        $customerCheckout->execute();

        $orderId = $this->getExtractor(OrderId::EXTRACTOR);
        /** @var $orderId OrderId */
        self::assertNotNull($orderId->getOrderId());
        self::assertGreaterThan(0, $orderId->getOrderId());
    }

    public function testCheckoutwithDifferentBillingAddress()
    {
        $theme = $this->getTheme();
        $this->commandOpen($theme->getBaseUrl());
        $this->getLogger()->info('Opening page ' . $theme->getBaseUrl());
        $addToCart = $this->getAction(AddItemToCart::ACTION);
        /* @var $addToCart \Magium\Magento\Actions\Cart\AddItemToCart */

        $addToCart->addSimpleProductToCartFromCategoryPage();
        $this->setPaymentMethod('CashOnDelivery');
        $customerCheckout= $this->getAction(CustomerCheckout::ACTION);
        /* @var $customerCheckout \Magium\Magento\Actions\Checkout\CustomerCheckout */

        $customerBilling = $this->getAction(CustomerBillingAddress::ACTION);
        /* @var $customerBilling \Magium\Magento\Actions\Checkout\Steps\CustomerBillingAddress */
        $customerBilling->enterNewAddress();
        $this->getIdentity()->setBillingFirstName('Bob');

        $customerCheckout->execute();

        $orderId = $this->getExtractor(OrderId::EXTRACTOR);
        /** @var $orderId OrderId */
        self::assertNotNull($orderId->getOrderId());
        self::assertGreaterThan(0, $orderId->getOrderId());

        $this->getNavigator(AccountHome::NAVIGATOR)->navigateTo();
        $this->getNavigator(NavigateToOrder::NAVIGATOR)->navigateTo($orderId->getOrderId());
        $billingAddress = $this->getExtractor(\Magium\Magento\Extractors\Customer\Order\BillingAddress::EXTRACTOR);
        $billingAddress->extract();
        self::assertEquals('Bob Schroeder', $billingAddress->getName());
    }

    public function testDifferentShippingAddressCheckout()
    {
        // setup
        $this->setPaymentMethod('CashOnDelivery');
        $customerCheckout= $this->getAction(CustomerCheckout::ACTION);
        /* @var $customerCheckout \Magium\Magento\Actions\Checkout\CustomerCheckout */
        $customerBilling = $this->getAction(CustomerBillingAddress::ACTION);
        /* @var $customerBilling \Magium\Magento\Actions\Checkout\Steps\CustomerBillingAddress */
        $customerBilling->shipToDifferentAddress();

        $customerShipping = $this->getAction(ShippingAddress::ACTION);
        /* @var $customerShipping \Magium\Magento\Actions\Checkout\Steps\ShippingAddress */
        $customerShipping->enterNewAddress();

        $this->getIdentity()->setShippingFirstName('Bob');

        // run
        $theme = $this->getTheme();
        $this->commandOpen($theme->getBaseUrl());
        $this->getLogger()->info('Opening page ' . $theme->getBaseUrl());
        $addToCart = $this->getAction(AddItemToCart::ACTION);
        /* @var $addToCart \Magium\Magento\Actions\Cart\AddItemToCart */

        $addToCart->addSimpleProductToCartFromCategoryPage();
        $customerCheckout->execute();

        $orderId = $this->getExtractor(OrderId::EXTRACTOR);
        /** @var $orderId OrderId */
        self::assertNotNull($orderId->getOrderId());
        self::assertGreaterThan(0, $orderId->getOrderId());

        $this->getNavigator(AccountHome::NAVIGATOR)->navigateTo();
        $this->getNavigator(NavigateToOrder::NAVIGATOR)->navigateTo($orderId->getOrderId());
        $shippingAddress = $this->getExtractor(\Magium\Magento\Extractors\Customer\Order\ShippingAddress::EXTRACTOR);
        $shippingAddress->extract();
        self::assertEquals('Bob Schroeder', $shippingAddress->getName());
    }

}