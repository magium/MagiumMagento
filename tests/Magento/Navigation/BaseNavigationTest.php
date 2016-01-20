<?php

namespace Tests\Magium\Magento\Navigation;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Navigators\Catalog\DefaultSimpleProductCategory;

class BaseNavigationTest extends AbstractMagentoTestCase
{


    public function testNavigateToJewelry()
    {
        $theme = $this->getTheme();
        $this->commandOpen($theme->getBaseUrl());
        $this->getNavigator(DefaultSimpleProductCategory::NAVIGATOR)->navigateTo();
        $this->assertPageHasText($this->getTheme()->getDefaultSimpleProductName());
    }
}