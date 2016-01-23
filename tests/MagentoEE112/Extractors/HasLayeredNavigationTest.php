<?php

namespace Tests\Magium\MagentoEE112\Extractors;


use Magium\Magento\Themes\MagentoEE112\ThemeConfiguration;

class HasLayeredNavigationTest extends \Tests\Magium\Magento\Extractors\HasLayeredNavigationTest
{

    protected $catalogHasNavigation = 'Apparel/Shirts';
    protected $catalogNoNavigation = 'Electronics/Cell Phones';

    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration(ThemeConfiguration::THEME);
    }
}