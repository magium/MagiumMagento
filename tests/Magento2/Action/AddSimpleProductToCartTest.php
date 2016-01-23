<?php

namespace Tests\Magium\Magento2\Action;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Actions\Cart\AddSimpleProductToCart;
use Magium\Magento\Navigators\BaseMenu;
use Magium\Magento\Navigators\Catalog\Product;
use Magium\Magento\Themes\Magento2\ThemeConfiguration;

class AddSimpleProductToCartTest extends \Tests\Magium\Magento\Action\AddSimpleProductToCartTest
{

    protected $qtySelector = '.qty .input-text';

    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration(ThemeConfiguration::THEME);
    }


}