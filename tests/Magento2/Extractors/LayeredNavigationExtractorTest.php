<?php

namespace Tests\Magium\Magento2\Extractors;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Extractors\Catalog\LayeredNavigation\LayeredNavigation;
use Magium\Magento\Navigators\BaseMenu;
use Magium\Magento\Themes\Magento2\ThemeConfiguration;

class LayeredNavigationExtractorTest extends \Tests\Magium\Magento\Extractors\LayeredNavigationExtractorTest
{

    protected $category = 'Men/Tops/Jackets';
    protected $filter = 'Style';

    protected $expectedFilter = [
        'Insulated',
        3
    ];
    protected $hasSwatchImage = false;
    protected $hasSwatchShowsCount = false;


    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration(ThemeConfiguration::THEME);
    }

}