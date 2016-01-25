<?php

namespace Tests\Magium\MagentoEE113\Checkout;


class AddItemToCartTest extends \Tests\Magium\Magento\Checkout\AddItemToCartTest
{

    protected $categoryNavigation = 'Electronics/Cell Phones';
    protected $categoryPageAddToCart = '//a[@title="Nokia 2610 Phone"]/../descendant::button';
    protected $productPageAddToCart = '//a[@title="Nokia 2610 Phone"]';

    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration('Magium\Magento\Themes\MagentoEE113\ThemeConfiguration');
    }

}