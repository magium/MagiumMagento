<?php

namespace Tests\Magento\Extractors;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Extractors\Catalog\Breadcrumb;
use Magium\Magento\Navigators\BaseMenu;

class BreadCrumbTest extends AbstractMagentoTestCase
{
    public function testBreadCrumbText()
    {
        $this->commandOpen($this->getTheme()->getBaseUrl());
        $this->getNavigator(BaseMenu::NAVIGATOR)->navigateTo('Men/Shirts');
        $breadCrumb = $this->getExtractor(Breadcrumb::EXTRACTOR);
        /* @var $breadCrumb \Magium\Magento\Extractors\Catalog\Breadcrumb */
        self::assertEquals('HOME / MEN / SHIRTS', $breadCrumb->getBreadCrumbText());
    }

    public function testBreadCrumbParts()
    {
        $this->commandOpen($this->getTheme()->getBaseUrl());
        $this->getNavigator(BaseMenu::NAVIGATOR)->navigateTo('Men/Shirts');
        $breadCrumb = $this->getExtractor(Breadcrumb::EXTRACTOR);
        /* @var $breadCrumb \Magium\Magento\Extractors\Catalog\Breadcrumb */
        $parts = $breadCrumb->getBreadCrumbsParts();
        self::assertCount(3, $parts);
        self::assertEquals('HOME', $parts[0]);
        self::assertEquals('MEN', $parts[1]);
        self::assertEquals('SHIRTS', $parts[2]);

    }


    public function testBreadCrumbLinks()
    {
        $this->commandOpen($this->getTheme()->getBaseUrl());
        $this->getNavigator(BaseMenu::NAVIGATOR)->navigateTo('Men/Shirts');
        $breadCrumb = $this->getExtractor(Breadcrumb::EXTRACTOR);
        /* @var $breadCrumb \Magium\Magento\Extractors\Catalog\Breadcrumb */

        $url = $this->getTheme()->getBaseUrl();

        // We have to change the case sensitivity here because getText() returns the CSS-derived version, but the
        // selector is based off of the actual text

        self::assertEquals($url, $breadCrumb->getBreadCrumbLink('Home'));
        $url = $this->getTheme()->getBaseUrl() . 'men.html';
        self::assertEquals($url, $breadCrumb->getBreadCrumbLink('Men'));

    }
}