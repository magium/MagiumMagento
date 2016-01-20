<?php

namespace Tests\Magium\MagentoEE114\Action;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Actions\Cart\AddConfigurableProductToCart;
use Magium\Magento\Navigators\BaseMenu;
use Magium\Magento\Navigators\Catalog\Product;
use Magium\WebDriver\WebDriver;

class AddConfigurableProductToCartTest extends \Tests\Magium\Magento\Action\AddConfigurableProductToCartTest
{

    public function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration('Magium\Magento\Themes\MagentoEE114\ThemeConfiguration');
    }

}