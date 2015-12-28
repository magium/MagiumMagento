<?php

namespace Tests\Magento18\Extractors;


class CategoryExtractorTest extends \Tests\Magento\Extractors\CategoryExtractorTest
{
    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration('Magium\Magento\Themes\Magento18\ThemeConfiguration');
    }

    public function testLayeredNavTestWorks()
    {
        $this->getTheme()->set('navigationPathToProductCategory', 'Apparel/Shirts');
        parent::testLayeredNavTestWorks();
    }

    public function testProductGridExtraction()
    {
        $this->getTheme()->set('navigationPathToProductCategory', 'Apparel/Shirts');
        parent::testProductGridExtraction();
    }

    public function testProductListExtraction()
    {
        $this->getTheme()->set('navigationPathToProductCategory', 'Apparel/Shirts');
        parent::testProductListExtraction();
    }


}