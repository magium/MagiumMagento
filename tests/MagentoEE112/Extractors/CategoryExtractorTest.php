<?php

namespace Tests\Magium\MagentoEE112\Extractors;


use Magium\Magento\Themes\MagentoEE112\ThemeConfiguration;

class CategoryExtractorTest extends \Tests\Magium\Magento\Extractors\CategoryExtractorTest
{
    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration(ThemeConfiguration::THEME);
    }

    public function testLayeredNavTestWorks()
    {
        $this->getTheme()->set('navigationPathToSimpleProductCategory', 'Apparel/Shirts');
        parent::testLayeredNavTestWorks();
    }

    public function testProductGridExtraction()
    {
        $this->getTheme()->set('navigationPathToSimpleProductCategory', 'Apparel/Shirts');
        parent::testProductGridExtraction();
    }

    public function testProductListExtraction()
    {
        $this->getTheme()->set('navigationPathToSimpleProductCategory', 'Apparel/Shirts');
        parent::testProductListExtraction();
    }


}