<?php

namespace Tests\Magium\MagentoEE113\Navigation;


use Magium\Magento\Themes\MagentoEE113\ThemeConfiguration;

class ProductNavigationTest extends \Tests\Magium\Magento\Navigation\ProductNavigationTest
{

    protected $productName = 'HTC Touch Diamond';


    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration(ThemeConfiguration::THEME);
    }

}