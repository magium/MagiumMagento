<?php

namespace Tests\Magium\Magento\Action;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Actions\Cart\AddSimpleProductToCart;
use Magium\Magento\Navigators\BaseMenu;
use Magium\Magento\Navigators\Cart\Cart;
use Magium\Magento\Navigators\Catalog\DefaultSimpleProduct;
use Magium\Magento\Navigators\Catalog\DefaultSimpleProductCategory;
use Magium\Magento\Navigators\Catalog\Product;

class AddSimpleProductToCartTest extends AbstractMagentoTestCase
{

    protected $qtySelector = '.qty';

    public function testBasicAddToCart()
    {
        $this->commandOpen($this->getTheme()->getBaseUrl());
        $this->getNavigator(DefaultSimpleProductCategory::NAVIGATOR)->navigateTo();
        $this->getNavigator(DefaultSimpleProduct::NAVIGATOR)->navigateTo();
        $this->getAction(AddSimpleProductToCart::ACTION)->execute();

    }

    public function testBasicAddToCartSucceedsWithQty()
    {
        $this->commandOpen($this->getTheme()->getBaseUrl());
        $this->getNavigator(DefaultSimpleProductCategory::NAVIGATOR)->navigateTo();
        $this->getNavigator(DefaultSimpleProduct::NAVIGATOR)->navigateTo();
        $action = $this->getAction(AddSimpleProductToCart::ACTION);
        /* @var $action AddSimpleProductToCart */
        $action->setQty(2);
        $action->execute();
        $this->getNavigator(Cart::NAVIGATOR)->navigateTo();
        $element = $this->webdriver->byCssSelector($this->qtySelector);
        $count = $element->getAttribute('value');
        self::assertEquals(2, $count);

    }

    public function testBasicAddToCartFailsWithNoQtyElementButQtyExpected()
    {
        $this->setExpectedException(AddSimpleProductToCart::EXCEPTION_NO_ELEMENT);
        $this->commandOpen($this->getTheme()->getBaseUrl());
        $action = $this->getAction(AddSimpleProductToCart::ACTION);
        /* @var $action AddSimpleProductToCart */
        $action->setQty(2);
        $action->execute();


    }


}