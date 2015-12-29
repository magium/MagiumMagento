<?php

namespace Tests\Magium\Magento\Checkout;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Actions\Cart\AddItemToCart;
use Magium\Magento\Actions\Checkout\CustomerCheckout;
use Magium\Magento\Actions\Checkout\GuestCheckout;
use Magium\Magento\Actions\Checkout\RegisterNewCustomerCheckout;
use Magium\Magento\Extractors\Checkout\CartSummary;

class CartSummaryTest extends AbstractMagentoTestCase
{

    public function testGuestCheckout()
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

        $cartSummary = $this->getExtractor(CartSummary::EXTRACTOR);
        /* @var $cartSummary \Magium\Magento\Extractors\Checkout\CartSummary */
        self::assertNotNull($cartSummary->getGrandTotal());
        self::assertCount(1, $cartSummary->getProducts());
    }


    public function testCustomerCheckout()
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


        $cartSummary = $this->getExtractor(CartSummary::EXTRACTOR);
        /* @var $cartSummary \Magium\Magento\Extractors\Checkout\CartSummary */
        self::assertNotNull($cartSummary->getGrandTotal());
        self::assertCount(1, $cartSummary->getProducts());
    }


    public function testNewCustomerCheckout()
    {
        $theme = $this->getTheme();
        $this->commandOpen($theme->getBaseUrl());
        $this->getLogger()->info('Opening page ' . $theme->getBaseUrl());
        $addToCart = $this->getAction(AddItemToCart::ACTION);
        /* @var $addToCart \Magium\Magento\Actions\Cart\AddItemToCart */

        $addToCart->addSimpleProductToCartFromCategoryPage();
        $this->setPaymentMethod('CashOnDelivery');
        $customerCheckout= $this->getAction(RegisterNewCustomerCheckout::ACTION);
        /* @var $customerCheckout \Magium\Magento\Actions\Checkout\RegisterNewCustomerCheckout */

        $customerCheckout->execute();


        $cartSummary = $this->getExtractor(CartSummary::EXTRACTOR);
        /* @var $cartSummary \Magium\Magento\Extractors\Checkout\CartSummary */
        self::assertNotNull($cartSummary->getGrandTotal());
        self::assertCount(1, $cartSummary->getProducts());
    }
}