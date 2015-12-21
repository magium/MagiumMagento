<?php

namespace Tests\Magento\Extractors;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Extractors\Catalog\Breadcrumb;
use Magium\Magento\Navigators\BaseMenu;

class BreadCrumbTest extends AbstractMagentoTestCase
{
    protected $category = 'Men/Shirts';
    protected $baseFile = 'men.html';
    protected $crumbs = [
        'Home', 'Men'
    ];
    protected $crumbsText = 'HOME / MEN / SHIRTS';

    public function testBreadCrumbText()
    {
        $this->commandOpen($this->getTheme()->getBaseUrl());
        $this->getNavigator(BaseMenu::NAVIGATOR)->navigateTo($this->category);
        $breadCrumb = $this->getExtractor(Breadcrumb::EXTRACTOR);
        /* @var $breadCrumb \Magium\Magento\Extractors\Catalog\Breadcrumb */
        self::assertEquals($this->crumbsText, $breadCrumb->getBreadCrumbText());
    }

    public function testBreadCrumbParts()
    {
        $this->commandOpen($this->getTheme()->getBaseUrl());
        $this->getNavigator(BaseMenu::NAVIGATOR)->navigateTo($this->category);
        $breadCrumb = $this->getExtractor(Breadcrumb::EXTRACTOR);
        /* @var $breadCrumb \Magium\Magento\Extractors\Catalog\Breadcrumb */
        $parts = $breadCrumb->getBreadCrumbsParts();
        self::assertCount(3, $parts);
        $crumbParts = explode('/', $this->crumbsText);
        self::assertEquals(trim($crumbParts[0]), $parts[0]);
        self::assertEquals(trim($crumbParts[1]), $parts[1]);
        self::assertEquals(trim($crumbParts[2]), $parts[2]);

    }


    public function testBreadCrumbLinks()
    {
        $this->commandOpen($this->getTheme()->getBaseUrl());
        $this->getNavigator(BaseMenu::NAVIGATOR)->navigateTo($this->category);
        $breadCrumb = $this->getExtractor(Breadcrumb::EXTRACTOR);
        /* @var $breadCrumb \Magium\Magento\Extractors\Catalog\Breadcrumb */

        $url = $this->getTheme()->getBaseUrl();

        // We have to change the case sensitivity here because getText() returns the CSS-derived version, but the
        // selector is based off of the actual text

        self::assertEquals($url, $breadCrumb->getBreadCrumbLink($this->crumbs[0]));
        $url = $this->getTheme()->getBaseUrl() . $this->baseFile;
        self::assertEquals($url, $breadCrumb->getBreadCrumbLink($this->crumbs[1]));

    }
}