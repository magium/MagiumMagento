<?php

namespace Tests\Magium\MagentoEE114\Extractors;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Extractors\Catalog\LayeredNavigation\FilterTypes\PriceFilter;
use Magium\Magento\Extractors\Catalog\LayeredNavigation\FilterValue;
use Magium\Magento\Extractors\Catalog\LayeredNavigation\LayeredNavigation;
use Magium\Magento\Navigators\BaseMenu;

class LayeredNavigationExtractorTest extends \Tests\Magium\Magento\Extractors\LayeredNavigationExtractorTest
{


    public function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration('Magium\Magento\Themes\MagentoEE114\ThemeConfiguration');
    }
}

