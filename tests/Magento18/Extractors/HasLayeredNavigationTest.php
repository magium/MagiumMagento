<?php

namespace Tests\Magento18\Extractors;


class HasLayeredNavigationTest extends \Tests\Magento\Extractors\HasLayeredNavigationTest
{

    protected $catalogHasNavigation = 'Apparel/Shirts';
    protected $catalogNoNavigation = 'Electronics/Cell Phones';

    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration('Magium\Magento\Themes\Magento18\ThemeConfiguration');
    }
}