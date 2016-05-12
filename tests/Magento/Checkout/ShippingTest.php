<?php

namespace Tests\Magium\Magento\Checkout;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Actions\Cart\AddSimpleProductToCart;
use Magium\Magento\Actions\Checkout\GuestCheckout;
use Magium\Magento\Navigators\Catalog\DefaultSimpleProduct;
use Magium\Magento\Navigators\Catalog\DefaultSimpleProductCategory;

class ShippingTest extends AbstractMagentoTestCase
{

    public function testSelectShipping()
    {
        $this->setPaymentMethod('CashOnDelivery');
        $this->setShippingMethod('ByName');
        $this->assertInstanceOf('Magium\Magento\Actions\Checkout\ShippingMethods\ByName', $this->getShippingMethod());
        $this->getShippingMethod()->setName('Fixed');
        $this->commandOpen($this->getTheme()->getBaseUrl());
        $this->getNavigator(DefaultSimpleProductCategory::NAVIGATOR)->navigateTo();
        $this->getNavigator(DefaultSimpleProduct::NAVIGATOR)->navigateTo();
        $this->getAction(AddSimpleProductToCart::ACTION)->execute();
        $this->getAction(GuestCheckout::ACTION)->execute();
    }

    public function testShippingThrowsExceptionWhenNameNotSpecified()
    {
        $this->setExpectedException('Magium\Magento\MissingInformationException');
        $this->setPaymentMethod('CashOnDelivery');
        $this->setShippingMethod('ByName');
        $this->commandOpen($this->getTheme()->getBaseUrl());
        $this->getNavigator(DefaultSimpleProductCategory::NAVIGATOR)->navigateTo();
        $this->getNavigator(DefaultSimpleProduct::NAVIGATOR)->navigateTo();
        $this->getAction(AddSimpleProductToCart::ACTION)->execute();
        $this->getAction(GuestCheckout::ACTION)->execute();
    }

    public function testShippingThrowsExceptionWhenElementNotFound()
    {
        $this->setExpectedException('Magium\Magento\Actions\Checkout\ShippingMethods\NoSuchShippingMethodException');
        $this->setPaymentMethod('CashOnDelivery');
        $this->setShippingMethod('ByName');
        $this->getShippingMethod()->setName('boogers');
        $this->commandOpen($this->getTheme()->getBaseUrl());
        $this->getNavigator(DefaultSimpleProductCategory::NAVIGATOR)->navigateTo();
        $this->getNavigator(DefaultSimpleProduct::NAVIGATOR)->navigateTo();
        $this->getAction(AddSimpleProductToCart::ACTION)->execute();
        $this->getAction(GuestCheckout::ACTION)->execute();
    }

}