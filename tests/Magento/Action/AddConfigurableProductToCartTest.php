<?php

namespace Tests\Magium\Magento\Action;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Actions\Cart\AddConfigurableProductToCart;
use Magium\Magento\Navigators\BaseMenu;
use Magium\Magento\Navigators\Catalog\DefaultConfigurableProduct;
use Magium\Magento\Navigators\Catalog\DefaultConfigurableProductCategory;
use Magium\Magento\Navigators\Catalog\Product;
use Magium\WebDriver\WebDriver;

class AddConfigurableProductToCartTest extends AbstractMagentoTestCase
{

    public function testBasicAddToCart()
    {
        $this->commandOpen($this->getTheme()->getBaseUrl());
        $this->getNavigator(DefaultConfigurableProductCategory::NAVIGATOR)->navigateTo();
        $this->getNavigator(DefaultConfigurableProduct::NAVIGATOR)->navigateTo();
        $this->getAction(AddConfigurableProductToCart::ACTION)->execute();

    }


    public function testBasicAddToCartWithSwatchesSpecified()
    {
        $this->commandOpen($this->getTheme()->getBaseUrl());
        $this->getNavigator(DefaultConfigurableProductCategory::NAVIGATOR)->navigateTo();
        $this->getNavigator(DefaultConfigurableProduct::NAVIGATOR)->navigateTo();
        $action = $this->getAction(AddConfigurableProductToCart::ACTION);
        /* @var $action AddConfigurableProductToCart */
        $action->setOption('color', 'red');
        $action->setOption('size', 'm');
        $action->execute();
        $this->assertElementExists('//dl[@class="item-options"]/dd[contains(., "Red")]', WebDriver::BY_XPATH);
        $this->assertElementExists('//dl[@class="item-options"]/dd[contains(., "M")]', WebDriver::BY_XPATH);
    }

    public function testBasicAddToCartWithSwatchesSpecifiedOrderReversed()
    {
        $this->commandOpen($this->getTheme()->getBaseUrl());
        $this->getNavigator(DefaultConfigurableProductCategory::NAVIGATOR)->navigateTo();
        $this->getNavigator(DefaultConfigurableProduct::NAVIGATOR)->navigateTo();
        $action = $this->getAction(AddConfigurableProductToCart::ACTION);
        /* @var $action AddConfigurableProductToCart */
        $action->setOption('size', 'm');
        $action->setOption('color', 'red');
        $action->execute();
        $this->assertElementExists('//dl[@class="item-options"]/dd[contains(., "Red")]', WebDriver::BY_XPATH);
        $this->assertElementExists('//dl[@class="item-options"]/dd[contains(., "M")]', WebDriver::BY_XPATH);
    }

    public function testBasicAddToCartSucceedsWithQty()
    {
        $this->commandOpen($this->getTheme()->getBaseUrl());
        $this->getNavigator(DefaultConfigurableProductCategory::NAVIGATOR)->navigateTo();
        $this->getNavigator(DefaultConfigurableProduct::NAVIGATOR)->navigateTo();
        $action = $this->getAction(AddConfigurableProductToCart::ACTION);
        /* @var $action AddConfigurableProductToCart */
        $action->setQty(2);
        $action->execute();

        $element = $this->webdriver->byCssSelector('.qty');
        self::assertEquals(2, $element->getAttribute('value'));

    }

    public function testBasicAddToCartFailsWithNoQtyElementButQtyExpected()
    {
        $this->setExpectedException(AddConfigurableProductToCart::EXCEPTION_NO_ELEMENT);
        $this->commandOpen($this->getTheme()->getBaseUrl());
        $action = $this->getAction(AddConfigurableProductToCart::ACTION);
        /* @var $action AddConfigurableProductToCart */
        $action->setQty(2);
        $action->execute();


    }


}