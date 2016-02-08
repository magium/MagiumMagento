<?php

namespace Tests\Magium\Magento18\Extractors;


class CategoryExtractorTest extends \Tests\Magium\Magento\Extractors\CategoryExtractorTest
{
    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration('Magium\Magento\Themes\Magento18\ThemeConfiguration');
    }

    public function testLayeredNavTestWorks()
    {
        $this->getTheme()->navigationPathToSimpleProductCategory = 'Apparel/Shirts';
        parent::testLayeredNavTestWorks();
    }

    public function testProductGridExtraction()
    {
        $this->getTheme()->navigationPathToSimpleProductCategory = 'Apparel/Shirts';
        parent::testProductGridExtraction();
    }

    public function testProductListExtraction()
    {
        $this->getTheme()->navigationPathToSimpleProductCategory = 'Apparel/Shirts';
        parent::testProductListExtraction();
    }


}