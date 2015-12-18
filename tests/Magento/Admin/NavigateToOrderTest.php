<?php

namespace Tests\Magento\Admin;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Actions\Admin\Login\Login;
use Magium\Magento\Actions\Cart\AddItemToCart;
use Magium\Magento\Actions\Checkout\GuestCheckout;
use Magium\Magento\Extractors\Checkout\OrderId;
use Magium\Magento\Navigators\Admin\Order;

class NavigateToOrderTest extends AbstractMagentoTestCase
{

    public function testAdminNavigationToOrderSucceeds()
    {
        $theme = $this->getTheme();
        $this->commandOpen($theme->getBaseUrl());
        $this->getLogger()->info('Opening page ' . $theme->getBaseUrl());
        $addToCart = $this->getAction(AddItemToCart::ACTION);
        /* @var $addToCart \Magium\Magento\Actions\Cart\AddItemToCart */

        $addToCart->addSimpleProductToCartFromCategoryPage();
        $this->setPaymentMethod('CashOnDelivery');
        $guestCheckout = $this->getAction(GuestCheckout::ACTION);
        /* @var $guestCheckout \Magium\Magento\Actions\Checkout\GuestCheckout */

        $guestCheckout->execute();

        $orderId = $this->getExtractor(OrderId::EXTRACTOR)->getOrderId();


        $this->getAction(Login::ACTION)->login();
        $this->getNavigator(Order::NAVIGATOR)->navigateTo($orderId);

        $this->assertPageHasText($orderId);

    }

}