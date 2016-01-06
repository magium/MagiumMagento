<?php

namespace Tests\Magium\Magento\Navigation;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Navigators\Store\Switcher;

class StoreSwitcherNavigationTest extends AbstractMagentoTestCase
{

    public function testStoreSwitcherNavigation()
    {
        $this->commandOpen($this->getTheme()->getBaseUrl());
        $element = $this->webdriver->byXpath('//body');
        $this->getNavigator(Switcher::NAVIGATOR)->switchTo('german');

        self::assertFalse($this->webdriver->elementAttached($element));
    }

}