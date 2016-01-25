<?php

namespace Tests\Magium\MagentoEE112\Checkout;


use Magium\Magento\Themes\MagentoEE112\ThemeConfiguration;

class AddItemToCartTest extends \Tests\Magium\Magento\Checkout\AddItemToCartTest
{

    protected $categoryNavigation = 'Electronics/Cell Phones';
    protected $categoryPageAddToCart = '//a[@title="Nokia 2610 Phone"]/../descendant::button';
    protected $productPageAddToCart = '//a[@title="Nokia 2610 Phone"]';

    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration(ThemeConfiguration::THEME);
    }

}