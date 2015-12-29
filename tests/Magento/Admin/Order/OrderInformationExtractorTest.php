<?php

namespace Tests\Magium\Magento\Admin\Order;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Actions\Admin\Login\Login;
use Magium\Magento\Actions\Cart\AddItemToCart;
use Magium\Magento\Actions\Checkout\GuestCheckout;
use Magium\Magento\Extractors\Admin\Order\AccountInformation;
use Magium\Magento\Extractors\Admin\Order\BillingAddress;
use Magium\Magento\Extractors\Admin\Order\OrderItems;
use Magium\Magento\Extractors\Admin\Order\OrderSummary;
use Magium\Magento\Extractors\Admin\Order\PaymentInformation;
use Magium\Magento\Extractors\Admin\Order\Totals;
use Magium\Magento\Extractors\Admin\OrderInformationExtractor;
use Magium\Magento\Extractors\Checkout\OrderId;
use Magium\Magento\Navigators\Admin\Order;

class OrderInformationExtractorTest extends AbstractMagentoTestCase
{


    public function testOrderExtraction()
    {

        $this->commandOpen($this->getTheme()->getBaseUrl());
        $addToCart = $this->getAction(AddItemToCart::ACTION);
        /* @var $addToCart \Magium\Magento\Actions\Cart\AddItemToCart */

        $addToCart->addSimpleProductToCartFromCategoryPage();
        $this->setPaymentMethod('CashOnDelivery');

        $guestCheckout = $this->getAction(GuestCheckout::ACTION);
        $guestCheckout->execute();

        $orderId = $this->getExtractor(OrderId::EXTRACTOR)->getOrderId();
        $this->getAction(Login::ACTION)->login();
        $this->getNavigator(Order::NAVIGATOR)->navigateTo($orderId);

        $extractor = $this->getExtractor(OrderInformationExtractor::EXTRACTOR);
        $extractor->extract();

        $identity = $this->getIdentity();
        /* @var $identity \Magium\Magento\Identities\Customer */

        $billingAddress = $this->getExtractor(BillingAddress::EXTRACTOR);
        /* @var $billingAddress \Magium\Magento\Extractors\Admin\Order\BillingAddress */

        self::assertEquals($identity->getBillingFirstName() . ' ' . $identity->getBillingLastName(), $billingAddress->getName());
        self::assertEquals($identity->getBillingAddress(),      $billingAddress->getStreet1());
        self::assertEquals($identity->getBillingAddress2(),     $billingAddress->getStreet2());
        self::assertEquals($identity->getBillingCity(),         $billingAddress->getCity());
        self::assertEquals($identity->getBillingRegionId(),     $billingAddress->getRegionId());
        self::assertEquals($identity->getBillingPostCode(),     $billingAddress->getPostCode());
        self::assertEquals('United States',                     $billingAddress->getCountry()); // SELECT in checkout and text in adminUI is different
        self::assertEquals($identity->getBillingTelephone(),    $billingAddress->getPhone());

        $shippingAddress = $this->getExtractor(BillingAddress::EXTRACTOR);
        /* @var $shippingAddress \Magium\Magento\Extractors\Admin\Order\ShippingAddress */

        self::assertEquals($identity->getShippingFirstName() . ' ' . $identity->getShippingLastName(), $shippingAddress->getName());
        self::assertEquals($identity->getShippingAddress(),      $shippingAddress->getStreet1());
        self::assertEquals($identity->getShippingAddress2(),     $shippingAddress->getStreet2());
        self::assertEquals($identity->getShippingCity(),         $shippingAddress->getCity());
        self::assertEquals($identity->getShippingRegionId(),     $shippingAddress->getRegionId());
        self::assertEquals($identity->getShippingPostCode(),     $shippingAddress->getPostCode());
        self::assertEquals(
            $this->getTranslator()->translate('United States'),
            $shippingAddress->getCountry()
        ); // SELECT in checkout and text in adminUI is different

        self::assertEquals($identity->getShippingTelephone(),    $shippingAddress->getPhone());

        $accountInformation = $this->getExtractor(AccountInformation::EXTRACTOR);
        /* @var $accountInformation \Magium\Magento\Extractors\Admin\Order\AccountInformation */

        self::assertEquals($identity->getShippingFirstName() . ' ' . $identity->getShippingLastName(), $accountInformation->getCustomerName());
        self::assertEquals($identity->getEmailAddress(), $accountInformation->getEmail());
        self::assertEquals('NOT LOGGED IN', $accountInformation->getCustomerGroup()); // Presuming "General" here

        $orderSummary = $this->getExtractor(OrderSummary::EXTRACTOR);
        /* @var $orderSummary \Magium\Magento\Extractors\Admin\Order\OrderSummary */

        self::assertEquals('Pending', $orderSummary->getOrderStatus());
        self::assertEquals(3, substr_count($orderSummary->getPlacedFromIP(), '.'));
        self::assertContains('Madison Island', $orderSummary->getPurchasedFrom());
        self::assertNotNull($orderSummary->getOrderDate());

        $paymentInformation = $this->getExtractor(PaymentInformation::EXTRACTOR);
        /* @var $paymentInformation \Magium\Magento\Extractors\Admin\Order\PaymentInformation */

        self::assertEquals($this->getTranslator()->translate('Cash On Delivery'), $paymentInformation->getPaymentMethodInformation());
        self::assertEquals('USD', $paymentInformation->getCurrency());

        $items = $this->getExtractor(OrderItems::EXTRACTOR);
        /* @var $items \Magium\Magento\Extractors\Admin\Order\OrderItems */

        $subTotal = 0;
        $grandTotal = 0;
        $taxTotal = 0;

        self::assertCount(1, $items->getOrderItems());

        foreach ($items->getOrderItems() as $item) {
            self::assertInstanceOf('Magium\Magento\Extractors\Admin\Order\OrderItem', $item);
            /* @var $item \Magium\Magento\Extractors\Admin\Order\OrderItem */
            self::assertNotNull($item->getProductName());
            self::assertNotNull($item->getSku());
            self::assertEquals('Ordered', $item->getStatus());
            self::assertContains('$', $item->getOriginalPrice());
            self::assertEquals($item->getOriginalPrice(), $item->getPrice());
            self::assertEquals($item->getOriginalPrice(), $item->getSubTotal());
            self::assertEquals(1, $item->getQtyOrdered());
            self::assertEquals(0, $item->getQtyInvoiced());
            self::assertEquals(0, $item->getQtyShipped());
            self::assertContains('%', $item->getTaxPercent());
            self::assertContains('$', $item->getTaxAmount());
            self::assertEquals('$0.00', $item->getDiscountAmount());

            $subTotal += str_replace('$', '', $item->getPrice());
            $grandTotal += str_replace('$', '', $item->getRowTotal());
            $taxTotal += str_replace('$', '', $item->getTaxAmount());
        }

        $totals = $this->getExtractor(Totals::EXTRACTOR);
        /* @var $totals \Magium\Magento\Extractors\Admin\Order\Totals */

        $shipping = str_replace('$', '', $totals->getShippingAndHandling());
        $grandTotal += $shipping;

        self::assertEquals(sprintf("\$%01.2f", $subTotal), $totals->getSubTotal());
        self::assertEquals(sprintf("$%01.2f", $grandTotal) , $totals->getGrandTotal());
        self::assertEquals(sprintf("$%01.2f", $taxTotal) , $totals->getTax());
        self::assertContains('$', $totals->getShippingAndHandling());
        self::assertEquals('$0.00', $totals->getTotalPaid());
        self::assertEquals('$0.00', $totals->getTotalRefunded());
        self::assertEquals(sprintf("$%01.2f", $grandTotal) , $totals->getTotalDue());
    }

}