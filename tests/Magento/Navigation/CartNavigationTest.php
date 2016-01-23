<?php

namespace Tests\Magium\Magento\Navigation;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Actions\Cart\AddItemToCart;
use Magium\Magento\Navigators\Cart\Cart;

class CartNavigationTest extends AbstractMagentoTestCase
{
    public function testNavigateToShoppingCart()
    {
        $this->commandOpen($this->getTheme()->getBaseUrl());

        // Some versions of Magento don't let you click to an empty shopping cart.  Since we want all of the
        // tests to pass for each version we will add a product to the cart.
        // Magium will make a best-effort attempt to get there but might fail in some scenarios
        $this->getAction(AddItemToCart::ACTION)->addSimpleItemToCartFromProductPage();
        $navigator = $this->getNavigator(Cart::NAVIGATOR);
        $navigator->navigateTo();
        $this->assertTitleEquals('Shopping Cart');
    }

}