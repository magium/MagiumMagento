<?php

namespace Tests\Magium\MagentoEE112\Action;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Actions\Cart\AddSimpleProductToCart;
use Magium\Magento\Navigators\BaseMenu;
use Magium\Magento\Navigators\Catalog\Product;
use Magium\Magento\Themes\MagentoEE112\ThemeConfiguration;

class AddSimpleProductToCartTest extends \Tests\Magium\Magento\Action\AddSimpleProductToCartTest
{

    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration(ThemeConfiguration::THEME);
    }


}