<?php

namespace Tests\Magium\MagentoEE113\Extractors;


class CategoryExtractorTest extends \Tests\Magium\Magento\Extractors\CategoryExtractorTest
{
    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration('Magium\Magento\Themes\MagentoEE113\ThemeConfiguration');
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