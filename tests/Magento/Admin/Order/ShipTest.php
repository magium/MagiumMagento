<?php

namespace Tests\Magium\Magento\Admin\Order;

use Facebook\WebDriver\WebDriverBy;
use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Actions\Admin\Login\Login;
use Magium\Magento\Actions\Admin\Orders\Ship;
use Magium\Magento\Actions\Cart\AddItemToCart;
use Magium\Magento\Actions\Checkout\GuestCheckout;
use Magium\Magento\Extractors\Checkout\OrderId;
use Magium\Magento\Navigators\Admin\Order;
use Magium\Magento\Navigators\Admin\Widget\Tab;

class ShipTest extends AbstractMagentoTestCase
{


    public function testShipOrder()
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
        $this->getAction(Ship::ACTION)->execute();

        $this->assertShipmentCreated();

    }
    public function testShipOrderWithCarrier()
    {
        $this->commandOpen($this->getTheme()->getBaseUrl());
        $addToCart = $this->getAction(AddItemToCart::ACTION);
        /* @var $addToCart \Magium\Magento\Actions\Cart\AddItemToCart */

        $addToCart->addSimpleProductToCartFromCategoryPage();
        $this->setPaymentMethod('CashOnDelivery');

        $guestCheckout = $this->getAction(GuestCheckout::ACTION);
        $guestCheckout->execute();

        $orderId = $this->getExtractor(OrderId::EXTRACTOR)->getOrderId();


        $addTrackingNumber = $this->getAction(Ship\AddTrackingNumber::ACTION);
        /* @var $addTrackingNumber \Magium\Magento\Actions\Admin\Orders\Ship\AddTrackingNumber */
        $addTrackingNumber->setCarrier(Ship\AddTrackingNumber::CARRIER_UPS);
        $addTrackingNumber->setTitle('UPS');
        $addTrackingNumber->setNumber('abcdefg12345678');

        $this->getAction(Login::ACTION)->login();
        $this->getNavigator(Order::NAVIGATOR)->navigateTo($orderId);
        $action = $this->getAction(Ship::ACTION);
        /* @var $action \Magium\Magento\Actions\Admin\Orders\Ship */
        $action->addSubAction($addTrackingNumber);
        $action->execute();

        $this->assertShipmentCreated();

        $this->webdriver->byXpath('//table[@id="order_shipments_table"]/descendant::tr[@title]')->click();
        $this->byText('abcdefg12345678');

    }
    public function testShipOrderWithCarrierLabel()
    {
        $this->commandOpen($this->getTheme()->getBaseUrl());
        $addToCart = $this->getAction(AddItemToCart::ACTION);
        /* @var $addToCart \Magium\Magento\Actions\Cart\AddItemToCart */

        $addToCart->addSimpleProductToCartFromCategoryPage();
        $this->setPaymentMethod('CashOnDelivery');

        $guestCheckout = $this->getAction(GuestCheckout::ACTION);
        $guestCheckout->execute();

        $orderId = $this->getExtractor(OrderId::EXTRACTOR)->getOrderId();


        $addTrackingNumber = $this->getAction(Ship\AddTrackingNumber::ACTION);
        /* @var $addTrackingNumber \Magium\Magento\Actions\Admin\Orders\Ship\AddTrackingNumber */
        $addTrackingNumber->setCarrier('label=Federal Express');
        $addTrackingNumber->setTitle('Fedex');
        $addTrackingNumber->setNumber('abcdefg12345678');

        $this->getAction(Login::ACTION)->login();
        $this->getNavigator(Order::NAVIGATOR)->navigateTo($orderId);
        $action = $this->getAction(Ship::ACTION);
        /* @var $action \Magium\Magento\Actions\Admin\Orders\Ship */
        $action->addSubAction($addTrackingNumber);
        $action->execute();

        $this->assertShipmentCreated();

        $this->webdriver->byXpath('//table[@id="order_shipments_table"]/descendant::tr[@title]')->click();
        $this->byText('abcdefg12345678');

    }

    protected function assertShipmentCreated()
    {
        $this->getNavigator(Tab::NAVIGATOR)->navigateTo('Shipments::');
        $elements = $this->webdriver->findElements(WebDriverBy::xpath('//table[@id="order_shipments_table"]/descendant::tr[@title]'));
        self::assertCount(1, $elements);
    }

}