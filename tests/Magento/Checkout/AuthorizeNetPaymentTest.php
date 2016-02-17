<?php

namespace Tests\Magium\Magento\Checkout;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Actions\Cart\AddItemToCart;
use Magium\Magento\Actions\Checkout\GuestCheckout;

class AuthorizeNetPaymentTest extends AbstractMagentoTestCase
{

    public function testSavedCC()
    {

        $this->commandOpen($this->getTheme()->getBaseUrl());
        $this->getAction(AddItemToCart::ACTION)->addSimpleProductToCartFromCategoryPage();
        $this->setPaymentMethod('AuthorizeNet');
        $this->getPaymentInformation()->setCreditCardNumber('4007000000027');
        $this->getAction(GuestCheckout::ACTION)->execute();
    }

}