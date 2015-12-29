<?php

namespace Tests\Magium\Magento\Navigation;

use Magium\Magento\AbstractMagentoTestCase;

class BaseNavigationTest extends AbstractMagentoTestCase
{

    protected $pageTextAssertionValue = 'Blue Horizons Bracelets';

    public function testNavigateToJewelry()
    {
        $theme = $this->getTheme();
        $this->commandOpen($theme->getBaseUrl());
        $this->getNavigator()->navigateTo($theme->getNavigationPathToProductCategory());
        $this->assertPageHasText($this->pageTextAssertionValue);
    }
}