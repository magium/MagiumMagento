<?php

namespace Tests\Magium\MagentoEE113\Extractors;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Extractors\Catalog\LayeredNavigation\LayeredNavigation;
use Magium\Magento\Navigators\BaseMenu;

class LayeredNavigationExtractorTest extends \Tests\Magium\Magento\Extractors\LayeredNavigationExtractorTest
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
        $this->switchThemeConfiguration('Magium\Magento\Themes\MagentoEE113\ThemeConfiguration');
    }

    public function testSwatchValues()
    {
        self::markTestSkipped('Configurable Swatches not available in EE 1.13');
    }

    public function testPriceValuesForNoValueReturnNull()
    {
        self::markTestSkipped('This test would actually work in EE 1.13 except that it requires changes to the sample data.  Therefore we will skip');
    }
}