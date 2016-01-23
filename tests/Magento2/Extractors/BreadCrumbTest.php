<?php

namespace Tests\Magium\Magento2\Extractors;


use Magium\Magento\Extractors\Catalog\Breadcrumb;
use Magium\Magento\Navigators\BaseMenu;
use Magium\Magento\Themes\Magento2\ThemeConfiguration;

class BreadCrumbTest extends \Tests\Magium\Magento\Extractors\BreadCrumbTest
{
    protected $category = 'Men/Tops/Jackets';
    protected $baseFile = 'men.html';
    protected $crumbs = [
        'Home', 'Men', 'Tops', 'Jackets'
    ];
    protected $crumbsText = 'Home Men Tops Jackets';

    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration(ThemeConfiguration::THEME);
    }
    public function testBreadCrumbParts()
    {
        $this->commandOpen($this->getTheme()->getBaseUrl());
        $this->getNavigator(BaseMenu::NAVIGATOR)->navigateTo($this->category);
        $breadCrumb = $this->getExtractor(Breadcrumb::EXTRACTOR);
        /* @var $breadCrumb \Magium\Magento\Extractors\Catalog\Breadcrumb */
        $parts = $breadCrumb->getBreadCrumbsParts();
        self::assertCount(4, $parts);
        $crumbParts = explode(' ', $this->crumbsText);
        self::assertEquals(trim($crumbParts[0]), $parts[0]);
        self::assertEquals(trim($crumbParts[1]), $parts[1]);
        self::assertEquals(trim($crumbParts[2]), $parts[2]);

    }
}