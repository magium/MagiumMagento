<?php

namespace Tests\Magento18\Extractors;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Extractors\Catalog\LayeredNavigation\LayeredNavigation;
use Magium\Magento\Navigators\BaseMenu;

class LayeredNavigationExtractorTest extends \Tests\Magento\Extractors\LayeredNavigationExtractorTest
{

    protected $category = 'Apparel/Shirts';
    protected $filter = 'Color';

    protected $expectedFilter = [
        'Green',
        2
    ];


    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration('Magium\Magento\Themes\Magento18\ThemeConfiguration');
    }

    public function testSwatchValues()
    {
        self::markTestSkipped('Configurable Swatches not available in CE 1.8');
    }

    public function testPriceValuesForNoValueReturnNull()
    {
        self::markTestSkipped('This test would actually work in CE 1.8 except that it requires changes to the sample data.  Therefore we will skip');
    }
}