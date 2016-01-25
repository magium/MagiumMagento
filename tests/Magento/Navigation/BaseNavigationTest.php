<?php

namespace Tests\Magium\Magento\Navigation;

use Magium\Magento\AbstractMagentoTestCase;

class BaseNavigationTest extends AbstractMagentoTestCase
{


    public function testNavigateToJewelry()
    {
        $theme = $this->getTheme();
        $this->commandOpen($theme->getBaseUrl());
        $this->getNavigator()->navigateTo($theme->getNavigationPathToSimpleProductCategory());
        $this->assertPageHasText($this->getTheme()->getDefaultSimpleProductName());
    }
}