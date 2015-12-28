<?php

namespace Tests\Magento\Extractors;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Extractors\Catalog\LayeredNavigation\HasLayeredNavigation;
use Magium\Magento\Navigators\BaseMenu;

class HasLayeredNavigationTest extends AbstractMagentoTestCase
{

    protected $catalogHasNavigation = 'Men/Shirts';
    protected $catalogNoNavigation = 'Home & Decor/Books & Music';

    public function testPageHasLayeredNav()
    {
        $this->commandOpen($this->getTheme()->getBaseUrl());
        $this->getNavigator(BaseMenu::NAVIGATOR)->navigateTo($this->catalogHasNavigation);
        self::assertTrue($this->getExtractor(HasLayeredNavigation::EXTRACTOR)->hasLayeredNavigation());
    }


    public function testPageHasNoLayeredNav()
    {
        $this->commandOpen($this->getTheme()->getBaseUrl());
        $this->getNavigator(BaseMenu::NAVIGATOR)->navigateTo($this->catalogNoNavigation);
        self::assertFalse($this->getExtractor(HasLayeredNavigation::EXTRACTOR)->hasLayeredNavigation());
    }
}