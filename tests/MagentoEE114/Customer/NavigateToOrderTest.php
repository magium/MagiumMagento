<?php

namespace Tests\Magium\MagentoEE114\Customer;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Actions\Cart\AddItemToCart;
use Magium\Magento\Actions\Checkout\CustomerCheckout;
use Magium\Magento\Extractors\Checkout\OrderId;
use Magium\Magento\Navigators\Customer\AccountHome;
use\Magium\Magento\Navigators\Customer\NavigateToOrder;

class NavigateToOrderTest extends \Tests\Magium\Magento\Customer\NavigateToOrderTest
{
    public function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration('Magium\Magento\Themes\MagentoEE114\ThemeConfiguration');
    }
}