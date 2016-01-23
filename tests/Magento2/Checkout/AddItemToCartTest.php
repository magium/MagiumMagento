<?php

namespace Tests\Magium\Magento2\Checkout;


use Magium\Magento\Themes\Magento2\ThemeConfiguration;

class AddItemToCartTest extends \Tests\Magium\Magento\Checkout\AddItemToCartTest
{

    protected $categoryNavigation = 'Gear/Bags';
    protected $categoryPageAddToCart = '//button[@title="Add to Cart"]';
    protected $productPageAddToCart = '//button[@title="Add to Cart"]';

    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration(ThemeConfiguration::THEME);
    }

    public function testAddSimpleItemToCartFromProductPageWithSpecifiedCategoryAndProduct()
    {
        self::markTestSkipped('For Magento 2 there are too many additional actions needed to make this fairly esoteric functionality work');
    }


    public function testSimpleAddToCartWithSpecifiedCategoryAndProduct()
    {
        self::markTestSkipped('For Magento 2 there are too many additional actions needed to make this fairly esoteric functionality work');
    }
}