<?php

namespace Tests\Magium\Magento\Navigation;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Navigators\Catalog\DefaultSimpleProductCategory;
use Magium\Navigators\Home;

class HomeNavigationTest extends AbstractMagentoTestCase
{

    public function testHomeNavigation()
    {
        $this->commandOpen($this->getTheme()->getBaseUrl());
        $this->getNavigator(DefaultSimpleProductCategory::NAVIGATOR)->navigateTo();
        $this->getNavigator(Home::NAVIGATOR)->navigateTo();
    }

}