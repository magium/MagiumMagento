<?php

namespace Tests\Magium\MagentoEE114\Action;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Actions\Cart\AddSimpleProductToCart;
use Magium\Magento\Navigators\BaseMenu;
use Magium\Magento\Navigators\Catalog\Product;

class AddSimpleProductToCartTest extends \Tests\Magium\Magento\Action\AddSimpleProductToCartTest
{


    public function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration('Magium\Magento\Themes\MagentoEE114\ThemeConfiguration');
    }


}