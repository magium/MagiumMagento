<?php

namespace Tests\Magium\Magento\Action;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Actions\Cart\AddConfigurableProductToCart;
use Magium\Magento\Navigators\Cart\Cart;
use Magium\Magento\Navigators\Catalog\DefaultConfigurableProduct;
use Magium\Magento\Navigators\Catalog\DefaultConfigurableProductCategory;
use Magium\WebDriver\WebDriver;

class AddConfigurableProductToCartTest extends AbstractMagentoTestCase
{

    protected $redElementTestXpath = '//dl[@class="item-options"]/dd[contains(., "Red")]';
    protected $mediumElementTestXpath = '//dl[@class="item-options"]/dd[contains(., "M")]';
    protected $qtySelector = '.qty';

    protected $option1Name = 'color';
    protected $option1Value = 'red';

    protected $option2Name = 'size';
    protected $option2Value = 'm';

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
        $action->setOption($this->option1Name, $this->option1Value);
        $action->setOption($this->option2Name, $this->option2Value);
        $action->execute();
        $this->getNavigator(Cart::NAVIGATOR)->navigateTo();
        $this->assertElementExists($this->redElementTestXpath, WebDriver::BY_XPATH);
        $this->assertElementExists($this->mediumElementTestXpath, WebDriver::BY_XPATH);
    }

    public function testBasicAddToCartWithSwatchesSpecifiedOrderReversed()
    {
        $this->commandOpen($this->getTheme()->getBaseUrl());
        $this->getNavigator(DefaultConfigurableProductCategory::NAVIGATOR)->navigateTo();
        $this->getNavigator(DefaultConfigurableProduct::NAVIGATOR)->navigateTo();
        $action = $this->getAction(AddConfigurableProductToCart::ACTION);
        /* @var $action AddConfigurableProductToCart */
        $action->setOption($this->option1Name, $this->option1Value);
        $action->setOption($this->option2Name, $this->option2Value);
        $action->execute();
        $this->getNavigator(Cart::NAVIGATOR)->navigateTo();
        $this->assertElementExists($this->redElementTestXpath, WebDriver::BY_XPATH);
        $this->assertElementExists($this->mediumElementTestXpath, WebDriver::BY_XPATH);
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
        $this->getNavigator(Cart::NAVIGATOR)->navigateTo();
        $element = $this->webdriver->byCssSelector($this->qtySelector);
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