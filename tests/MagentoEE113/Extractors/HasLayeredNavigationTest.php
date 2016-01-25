<?php

namespace Tests\Magium\MagentoEE113\Extractors;


class HasLayeredNavigationTest extends \Tests\Magium\Magento\Extractors\HasLayeredNavigationTest
{

    protected $catalogHasNavigation = 'Apparel/Shirts';
    protected $catalogNoNavigation = 'Electronics/Cell Phones';

    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration('Magium\Magento\Themes\MagentoEE113\ThemeConfiguration');
    }
}