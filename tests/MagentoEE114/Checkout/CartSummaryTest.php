<?php

namespace Tests\Magium\MagentoEE114\Checkout;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Actions\Cart\AddItemToCart;
use Magium\Magento\Actions\Checkout\CustomerCheckout;
use Magium\Magento\Actions\Checkout\GuestCheckout;
use Magium\Magento\Actions\Checkout\RegisterNewCustomerCheckout;
use Magium\Magento\Extractors\Checkout\CartSummary;

class CartSummaryTest extends \Tests\Magium\Magento\Checkout\CartSummaryTest
{


    public function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration('Magium\Magento\Themes\MagentoEE114\ThemeConfiguration');
    }

}