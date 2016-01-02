<?php

namespace Magium\Magento\Navigators\Cart;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Navigators\BaseMenu;
use Magium\Magento\Themes\AbstractThemeConfiguration;
use Magium\WebDriver\WebDriver;

class DefaultProductCategory
{
    const NAVIGATOR = 'Cart\DefaultProductCategory';

    protected $webdriver;
    protected $theme;
    protected $navigator;
    protected $testCase;

    public function __construct(
        WebDriver $webdriver,
        AbstractThemeConfiguration $theme,
        BaseMenu $navigator,
        AbstractMagentoTestCase $testCase
    ) {
        $this->webdriver = $webdriver;
        $this->theme = $theme;
        $this->navigator = $navigator;
        $this->testCase = $testCase;
    }

    public function navigateTo()
    {
        $this->navigator->navigateTo($this->theme->getNavigationPathToProductCategory());
    }

}