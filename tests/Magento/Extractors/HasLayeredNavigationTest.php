<?php

namespace Tests\Magento\Extractors;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Extractors\Catalog\Category\HasLayeredNavigation;
use Magium\Magento\Navigators\BaseMenu;

class HasLayeredNavigationTest extends AbstractMagentoTestCase
{

    public function testPageHasLayeredNav()
    {
        $this->commandOpen($this->getTheme()->getBaseUrl());
        $this->getNavigator(BaseMenu::NAVIGATOR)->navigateTo('Men/Shirts');
        self::assertTrue($this->getExtractor(HasLayeredNavigation::EXTRACTOR)->hasLayeredNavigation());
    }


    public function testPageHasNoLayeredNav()
    {
        $this->commandOpen($this->getTheme()->getBaseUrl());
        $this->getNavigator(BaseMenu::NAVIGATOR)->navigateTo('Home & Decor/Books & Music');
        self::assertFalse($this->getExtractor(HasLayeredNavigation::EXTRACTOR)->hasLayeredNavigation());
    }
}