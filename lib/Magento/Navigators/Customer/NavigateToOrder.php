<?php

namespace Magium\Magento\Navigators\Customer;

use Magium\Magento\Themes\Customer\AbstractThemeConfiguration;
use Magium\WebDriver\ExpectedCondition;
use Magium\WebDriver\WebDriver;

class NavigateToOrder
{
    const NAVIGATOR = 'Customer\NavigateToOrder';
    protected $webDriver;
    protected $accountNavigator;
    protected $themeConfiguration;

    public function __construct(
        WebDriver               $webDriver,
        Account                 $accountNavigator,
        AbstractThemeConfiguration      $themeConfiguration
    )
    {
        $this->webDriver            = $webDriver;
        $this->accountNavigator     = $accountNavigator;
        $this->themeConfiguration   = $themeConfiguration;
    }

    public function navigateTo($orderId)
    {
        $xpath = $this->themeConfiguration->getAccountNavigationXpath($this->themeConfiguration->getOrderPageName());
        $this->webDriver->byXpath($xpath)->click();

        $xpath = $this->themeConfiguration->getViewOrderLinkXpath($orderId);
        $this->webDriver->byXpath($xpath)->click();

        $this->webDriver->wait()->until(ExpectedCondition::titleContains($this->themeConfiguration->getOrderPageTitleContainsText()));

    }

}