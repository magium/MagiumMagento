<?php

namespace Tests\Magium\Magento\Checkout;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Actions\Cart\AddItemToCart;
use Magium\Magento\Actions\Checkout\CustomerCheckout;
use Magium\Magento\Actions\Checkout\GuestCheckout;
use Magium\Magento\Actions\Checkout\PaymentInformation\AuthorizeNet;
use Magium\Magento\Extractors\Checkout\OrderId;
use Magium\Magento\Navigators\Customer\AccountHome;
use Magium\Magento\Navigators\Customer\NavigateToOrder;

class AuthorizeNetPaymentTest extends AbstractMagentoTestCase
{

    public function testAuthorizeNet()
    {
        $this->commandOpen($this->getTheme()->getBaseUrl());
        $this->getAction(AddItemToCart::ACTION)->addSimpleProductToCartFromCategoryPage();
        $this->setPaymentMethod('AuthorizeNet');
        $this->getPaymentInformation()->setCreditCardNumber('4007000000027');
        $this->getAction(GuestCheckout::ACTION)->execute();
    }

    public function testAuthorizeNetPaymentInformation()
    {
        $this->commandOpen($this->getTheme()->getBaseUrl());
        $this->getAction(AddItemToCart::ACTION)->addSimpleProductToCartFromCategoryPage();
        $payment = $this->getAction(AuthorizeNet::ACTION);
        /* @var $payment \Magium\Magento\Actions\Checkout\PaymentInformation\AuthorizeNet */
        $payment->configureTest($this);
        $this->getAction(GuestCheckout::ACTION)->execute();
    }

    public function testAuthorizeNetPaymentInformationChangeType()
    {
        $this->commandOpen($this->getTheme()->getBaseUrl());
        $this->getAction(AddItemToCart::ACTION)->addSimpleProductToCartFromCategoryPage();
        $this->setPaymentMethod('AuthorizeNet');
        $payment = $this->getAction(AuthorizeNet::ACTION);
        /* @var $payment \Magium\Magento\Actions\Checkout\PaymentInformation\AuthorizeNet */
        $payment->configureTest($this);
        $payment->setUseMastercard();
        $this->getAction(CustomerCheckout::ACTION)->execute();
        $orderId = $this->getExtractor(OrderId::EXTRACTOR)->getOrderId();

        $this->getNavigator(AccountHome::NAVIGATOR)->navigateTo();
        $this->getNavigator(NavigateToOrder::NAVIGATOR)->navigateTo($orderId);
        $this->byXpath('//td[.="MasterCard"]');
    }

}