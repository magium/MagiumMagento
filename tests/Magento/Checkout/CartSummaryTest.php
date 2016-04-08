<?php

namespace Tests\Magium\Magento\Checkout;

use Magium\Assertions\AbstractAssertion;
use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Actions\Cart\AddItemToCart;
use Magium\Magento\Actions\Checkout\CustomerCheckout;
use Magium\Magento\Actions\Checkout\GuestCheckout;
use Magium\Magento\Actions\Checkout\RegisterNewCustomerCheckout;
use Magium\Magento\Actions\Checkout\Steps\BillingAddress;
use Magium\Magento\Actions\Checkout\Steps\StepInterface;
use Magium\Magento\Extractors\Checkout\CartSummary;
use Magium\Magento\Extractors\Checkout\Product;
use Magium\WebDriver\WebDriver;

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
        foreach ($cartSummary->getProducts() as $product) {
            /* @var $product Product */
            self::assertNotNull($product->getName());
            self::assertNotNull($product->getPrice());
            self::assertContains('$', $product->getPrice());
            self::assertEquals(1, $product->getQty());
        }
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


    public function testZimbabweNotAvailable()
    {
        $theme = $this->getTheme();
        $this->commandOpen($theme->getBaseUrl());
        $this->getLogger()->info('Opening page ' . $theme->getBaseUrl());
        $addToCart = $this->getAction(AddItemToCart::ACTION);
        /* @var $addToCart \Magium\Magento\Actions\Cart\AddItemToCart */

        $addToCart->addSimpleProductToCartFromCategoryPage();
        $this->setPaymentMethod('CashOnDelivery');
        $customerCheckout= $this->getAction(GuestCheckout::ACTION);
        /* @var $customerCheckout \Magium\Magento\Actions\Checkout\GuestCheckout */
        $customerCheckout->addStep(
            $this->get('Tests\Magium\Magento\Checkout\ZimbabweNotAvailableAssertion'),
            $this->getAction(BillingAddress::ACTION)
        );
        $customerCheckout->execute();
        
    }
}

class ZimbabweNotAvailableAssertion extends AbstractAssertion implements StepInterface
{
    public function assert()
    {
        if ($this->testCase instanceof AbstractMagentoTestCase) {
            $this->testCase->assertElementNotExists('//option[.="Zimbabwe"]', WebDriver::BY_XPATH);
        }
    }

    public function execute()
    {
        $this->assert();
    }

    public function nextAction()
    {
        return false;
    }

}