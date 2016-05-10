<?php

namespace Magium\Magento\Navigators\Store;

use Magium\AbstractTestCase;
use Magium\Actions\WaitForPageLoaded;
use Magium\Magento\Themes\AbstractThemeConfiguration;
use Magium\Navigators\InstructionNavigator;
use Magium\WebDriver\WebDriver;

class Switcher extends InstructionNavigator
{

    const NAVIGATOR = 'Store\Switcher';

    protected $themeConfiguration;

    public function __construct(AbstractTestCase $testCase, WebDriver $webdriver, WaitForPageLoaded $loaded, AbstractThemeConfiguration $themeConfiguration)
    {
        parent::__construct($testCase, $webdriver, $loaded);
        $this->themeConfiguration = $themeConfiguration;
    }


    public function switchTo($store)
    {
        $this->navigateTo($this->themeConfiguration->getStoreSwitcherInstructionsXpath($store));
        $this->loaded->execute();
    }
}