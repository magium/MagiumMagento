<?php

namespace Tests\Magium\Magento\Action;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Actions\Cart\AddSimpleProductToCart;
use Magium\Magento\Navigators\BaseMenu;
use Magium\Magento\Navigators\Catalog\Product;

class AddSimpleProductToCartTest extends AbstractMagentoTestCase
{

    public function testBasicAddToCart()
    {
        $this->commandOpen($this->getTheme()->getBaseUrl());
        $this->getNavigator(BaseMenu::NAVIGATOR)->navigateTo($this->getTheme()->getNavigationPathToProductCategory());
        $this->getNavigator(Product::NAVIGATOR)->navigateTo($this->getTheme()->getDefaultProductName());
        $this->getAction(AddSimpleProductToCart::ACTION)->execute();

    }

    public function testBasicAddToCartSucceedsWithQty()
    {
        $this->commandOpen($this->getTheme()->getBaseUrl());
        $this->getNavigator(BaseMenu::NAVIGATOR)->navigateTo($this->getTheme()->getNavigationPathToProductCategory());
        $this->getNavigator(Product::NAVIGATOR)->navigateTo($this->getTheme()->getDefaultProductName());
        $action = $this->getAction(AddSimpleProductToCart::ACTION);
        /* @var $action AddSimpleProductToCart */
        $action->addQty(2);
        $action->execute();

        $element = $this->webdriver->byCssSelector('.qty');
        self::assertEquals(2, $element->getAttribute('value'));

    }

    public function testBasicAddToCartFailsWithNoQtyElementButQtyExpected()
    {
        $this->setExpectedException(AddSimpleProductToCart::EXCEPTION_NO_ELEMENT);
        $this->commandOpen($this->getTheme()->getBaseUrl());
        $action = $this->getAction(AddSimpleProductToCart::ACTION);
        /* @var $action AddSimpleProductToCart */
        $action->addQty(2);
        $action->execute();


    }


}