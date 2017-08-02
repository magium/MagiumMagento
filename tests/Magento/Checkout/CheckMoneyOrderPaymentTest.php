<?php

namespace Tests\Magium\Magento\Checkout;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Actions\Admin\Configuration\Enabler;
use Magium\Magento\Actions\Admin\Login\Login;
use Magium\Magento\Actions\Cart\AddItemToCart;
use Magium\Magento\Actions\Checkout\GuestCheckout;

class CheckMoneyOrderPaymentTest extends AbstractMagentoTestCase
{

    public function testCheckMoneyOrder()
    {
        $this->getAction(Login::ACTION)->login();
        $this->getAction(Enabler::ACTION)->enable('Payment Methods/Check / Money Order');

        $this->commandOpen($this->getTheme()->getBaseUrl());
        $this->getAction(AddItemToCart::ACTION)->addSimpleProductToCartFromCategoryPage();
        $this->setPaymentMethod('CheckMoneyOrder');
        $this->getAction(GuestCheckout::ACTION)->execute();
    }

    protected function tearDown()
    {
        $this->getAction(Login::ACTION)->login();
        $this->getAction(Enabler::ACTION)->disable('Payment Methods/Check / Money Order');
        parent::tearDown();
    }

}
