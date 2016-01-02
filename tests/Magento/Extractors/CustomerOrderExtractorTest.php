<?php

namespace Tests\Magium\Magento\Extractors;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Actions\Cart\AddItemToCart;
use Magium\Magento\Actions\Checkout\CustomerCheckout;
use Magium\Magento\Extractors\Customer\Order\BillingAddress;
use Magium\Magento\Extractors\Customer\Order\ItemList;
use Magium\Magento\Extractors\Customer\Order\ShippingAddress;
use Magium\Magento\Extractors\Customer\Order\Summary;
use Magium\Magento\Extractors\Checkout\OrderId;
use Magium\Magento\Navigators\Customer\AccountHome;
use Magium\Magento\Navigators\Customer\NavigateToOrder;

class CustomerOrderExtractorTest extends AbstractMagentoTestCase
{
    protected $status = 'PENDING';

    public function testOrderExtractor()
    {
        $this->commandOpen($this->getTheme()->getBaseUrl());
        $this->setPaymentMethod('CashOnDelivery');
        $this->getAction(AddItemToCart::ACTION)->addSimpleProductToCartFromCategoryPage();
        $this->getAction(CustomerCheckout::ACTION)->execute();
        $orderId = $this->getExtractor(OrderId::EXTRACTOR)->getOrderId();
        $this->getNavigator(AccountHome::NAVIGATOR)->navigateTo();
        $this->getNavigator(NavigateToOrder::NAVIGATOR)->navigateTo($orderId);

        $orderSummary = $this->getExtractor(Summary::EXTRACTOR);
        /* @var $orderSummary \Magium\Magento\Extractors\Customer\Order\Summary */
        $orderSummary->extract();

        $billingAddress = $this->getExtractor(BillingAddress::EXTRACTOR);
        /* @var $billingAddress \Magium\Magento\Extractors\Customer\Order\BillingAddress */
        $billingAddress->extract();

        $shippingAddress = $this->getExtractor(ShippingAddress::EXTRACTOR);
        /* @var $shippingAddress \Magium\Magento\Extractors\Customer\Order\ShippingAddress */
        $shippingAddress->extract();

        $itemList = $this->getExtractor(ItemList::EXTRACTOR);
        /* @var $itemList \Magium\Magento\Extractors\Customer\Order\ItemList */
        $itemList->extract();

        self::assertEquals($this->status, $orderSummary->getStatus());
        self::assertContains('$', $orderSummary->getGrandTotal());
        self::assertNotNull($orderSummary->getOrderDate());
        self::assertContains('$', $orderSummary->getShippingAndHandling());
        self::assertContains('$', $orderSummary->getSubTotal());
        self::assertContains('$', $orderSummary->getTax());

        $identity = $this->getIdentity();
        /* @var $identity \Magium\Magento\Identities\Customer */

        self::assertEquals($identity->getBillingFirstName() . ' ' . $identity->getBillingLastName(), $billingAddress->getName());
        self::assertEquals($identity->getBillingAddress(), $billingAddress->getStreet1());
        self::assertEquals($identity->getBillingAddress2(), $billingAddress->getStreet2());
        self::assertEquals($identity->getBillingCity(), $billingAddress->getCity());
        self::assertEquals($identity->getBillingRegionId(), $billingAddress->getRegion());
        self::assertEquals('United States', $billingAddress->getCountry());

        // Using the same address for billing and shipping here.
        self::assertEquals($identity->getBillingFirstName() . ' ' . $identity->getBillingLastName(), $shippingAddress->getName());
        self::assertEquals($identity->getBillingAddress(), $shippingAddress->getStreet1());
        self::assertEquals($identity->getBillingAddress2(), $shippingAddress->getStreet2());
        self::assertEquals($identity->getBillingCity(), $shippingAddress->getCity());
        self::assertEquals($identity->getBillingRegionId(), $shippingAddress->getRegion());
        self::assertEquals('United States', $shippingAddress->getCountry());

        $products = $itemList->getItems();
        self::assertCount(1, $products);
        self::assertNotNull($products[0]->getProductName());
        self::assertNotNull($products[0]->getSku());
        self::assertEquals(1, $products[0]->getQtyOrdered());
        self::assertEquals(0, $products[0]->getQtyShipped());
        self::assertContains('$', $products[0]->getSubTotal());
        self::assertContains('$', $products[0]->getPrice());

        // breathe!  breathe!
    }

}