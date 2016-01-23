<?php

namespace Tests\Magium\Magento2\Extractors;


use Magium\Magento\Themes\Magento2\ThemeConfiguration;

class HasLayeredNavigationTest extends \Tests\Magium\Magento\Extractors\HasLayeredNavigationTest
{

    protected $catalogHasNavigation = 'Men/Tops/Jackets';
    protected $catalogNoNavigation = 'Sale';

    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration(ThemeConfiguration::THEME);
    }
}