<?php

namespace Tests\Magium\MagentoEE114\Checkout;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Actions\Cart\AddItemToCart;
use Magium\Magento\Actions\Checkout\RegisterNewCustomerCheckout;
use Magium\Magento\Extractors\Checkout\OrderId;

class RegisterNewCustomerCheckoutTest extends \Tests\Magium\Magento\Checkout\RegisterNewCustomerCheckoutTest
{

    public function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration('Magium\Magento\Themes\MagentoEE114\ThemeConfiguration');
    }

}