<?php

namespace Tests\Magium\Magento\Checkout;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Actions\Cart\AddItemToCart;

class AddItemToCartTest extends AbstractMagentoTestCase
{

    protected $categoryNavigation = 'Accessories/Eyewear';
    protected $categoryPageAddToCart = '//a[@title="Aviator Sunglasses"]/../descendant::button';
    protected $productPageAddToCart = '//a[@title="Aviator Sunglasses"]';

    public function testSimpleAddToCartWithDefaults()
    {
        $theme = $this->getTheme();
        $this->commandOpen($theme->getBaseUrl());
        $this->getLogger()->info('Opening page ' . $theme->getBaseUrl());
        $addToCart = $this->getAction(AddItemToCart::ACTION);
        /* @var $addToCart \Magium\Magento\Actions\Cart\AddItemToCart */

        $addToCart->addSimpleProductToCartFromCategoryPage();
    }

    public function testSimpleAddToCartWithSpecifiedCategoryAndProduct()
    {
        $theme = $this->getTheme();
        $this->commandOpen($theme->getBaseUrl());

        $addToCart = $this->getAction(AddItemToCart::ACTION);
        /* @var $addToCart \Magium\Magento\Actions\Cart\AddItemToCart */

        $addToCart->addSimpleProductToCartFromCategoryPage($this->categoryNavigation, $this->categoryPageAddToCart);
    }

    public function testAddSimpleItemToCartFromProductPageWithDefaults()
    {
        $theme = $this->getTheme();
        $this->commandOpen($theme->getBaseUrl());
        $this->getLogger()->info('Opening page ' . $theme->getBaseUrl());
        $addToCart = $this->getAction(AddItemToCart::ACTION);
        /* @var $addToCart \Magium\Magento\Actions\Cart\AddItemToCart */

        $addToCart->addSimpleItemToCartFromProductPage();

    }


    public function testAddSimpleItemToCartFromProductPageWithSpecifiedCategoryAndProduct()
    {
        $theme = $this->getTheme();
        $this->commandOpen($theme->getBaseUrl());
        $this->getLogger()->info('Opening page ' . $theme->getBaseUrl());
        $addToCart = $this->getAction(AddItemToCart::ACTION);
        /* @var $addToCart \Magium\Magento\Actions\Cart\AddItemToCart */

        $addToCart->addSimpleItemToCartFromProductPage($this->productPageAddToCart, $this->categoryNavigation);

    }

}