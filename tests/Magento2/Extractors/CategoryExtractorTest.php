<?php

namespace Tests\Magium\Magento2\Extractors;


use Magium\Magento\Themes\Magento2\ThemeConfiguration;

class CategoryExtractorTest extends \Tests\Magium\Magento\Extractors\CategoryExtractorTest
{
    protected $modeSelectorXpath = '//div[@class="modes"]//a[@data-value="list"]';

    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration(ThemeConfiguration::THEME);
    }

    public function testLayeredNavTestWorks()
    {
        $this->getTheme()->set('navigationPathToSimpleProductCategory', 'Gear/Bags');
        parent::testLayeredNavTestWorks();
    }

    public function testProductGridExtraction()
    {
        $this->getTheme()->set('navigationPathToSimpleProductCategory', 'Gear/Bags');
        parent::testProductGridExtraction();
    }

    public function testProductListExtraction()
    {
        $this->getTheme()->set('navigationPathToSimpleProductCategory', 'Gear/Bags');
        parent::testProductListExtraction();
    }


}