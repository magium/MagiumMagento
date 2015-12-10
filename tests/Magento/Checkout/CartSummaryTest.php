<?php

namespace Tests\Magento\Checkout;

use Magium\Magento\AbstractMagentoTestCase;

class CartSummaryTest extends AbstractMagentoTestCase
{

    public function testGuestCheckout()
    {
        $theme = $this->getTheme();
        $this->commandOpen($theme->getBaseUrl());
        $this->getLogger()->info('Opening page ' . $theme->getBaseUrl());
        $addToCart = $this->getAction('Cart\AddItemToCart');
        /* @var $addToCart \Magium\Magento\Actions\Cart\AddItemToCart */

        $addToCart->addSimpleProductToCartFromCategoryPage();
        $this->setPaymentMethod('CashOnDelivery');
        $guestCheckout = $this->getAction('Checkout\GuestCheckout');
        /* @var $guestCheckout \Magium\Magento\Actions\Checkout\GuestCheckout */

        $guestCheckout->execute();

        $cartSummary = $this->getExtractor('Checkout\CartSummary');
        /* @var $cartSummary \Magium\Magento\Extractors\Checkout\CartSummary */
        self::assertNotNull($cartSummary->getGrandTotal());
        self::assertCount(1, $cartSummary->getProducts());
    }


    public function testCustomerCheckout()
    {
        $theme = $this->getTheme();
        $this->commandOpen($theme->getBaseUrl());
        $this->getLogger()->info('Opening page ' . $theme->getBaseUrl());
        $addToCart = $this->getAction('Cart\AddItemToCart');
        /* @var $addToCart \Magium\Magento\Actions\Cart\AddItemToCart */

        $addToCart->addSimpleProductToCartFromCategoryPage();
        $this->setPaymentMethod('CashOnDelivery');
        $customerCheckout= $this->getAction('Checkout\CustomerCheckout');
        /* @var $customerCheckout \Magium\Magento\Actions\Checkout\CustomerCheckout */

        $customerCheckout->execute();


        $cartSummary = $this->getExtractor('Checkout\CartSummary');
        /* @var $cartSummary \Magium\Magento\Extractors\Checkout\CartSummary */
        self::assertNotNull($cartSummary->getGrandTotal());
        self::assertCount(1, $cartSummary->getProducts());
    }


    public function testNewCustomerCheckout()
    {
        $theme = $this->getTheme();
        $this->commandOpen($theme->getBaseUrl());
        $this->getLogger()->info('Opening page ' . $theme->getBaseUrl());
        $addToCart = $this->getAction('Cart\AddItemToCart');
        /* @var $addToCart \Magium\Magento\Actions\Cart\AddItemToCart */

        $addToCart->addSimpleProductToCartFromCategoryPage();
        $this->setPaymentMethod('CashOnDelivery');
        $customerCheckout= $this->getAction('Checkout\RegisterNewCustomerCheckout');
        /* @var $customerCheckout \Magium\Magento\Actions\Checkout\RegisterNewCustomerCheckout */

        $customerCheckout->execute();


        $cartSummary = $this->getExtractor('Checkout\CartSummary');
        /* @var $cartSummary \Magium\Magento\Extractors\Checkout\CartSummary */
        self::assertNotNull($cartSummary->getGrandTotal());
        self::assertCount(1, $cartSummary->getProducts());
    }
}