<?php

namespace Magium\Magento\Navigators\Store;

use Magium\Navigators\InstructionNavigator;

class Switcher extends InstructionNavigator
{

    const NAVIGATOR = 'Store\Switcher';

    public function switchTo($store)
    {
        $this->navigateTo($this->themeConfiguration->getStoreSwitcherInstructionsXpath($store));
    }
}