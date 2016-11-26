<?php

namespace Magium\Magento\Navigators\Customer;

use Magium\Actions\WaitForPageLoaded;
use Magium\Magento\Themes\Customer\AbstractThemeConfiguration;
use Magium\Navigators\ConfigurableNavigatorInterface;
use Magium\WebDriver\ExpectedCondition;
use Magium\WebDriver\WebDriver;

class NavigateToOrder implements ConfigurableNavigatorInterface
{
    const NAVIGATOR = 'Customer\NavigateToOrder';
    protected $webDriver;
    protected $accountNavigator;
    protected $themeConfiguration;
    protected $loaded;

    public function __construct(
        WebDriver               $webDriver,
        Account                 $accountNavigator,
        AbstractThemeConfiguration      $themeConfiguration,
        WaitForPageLoaded $loaded
    )
    {
        $this->webDriver            = $webDriver;
        $this->accountNavigator     = $accountNavigator;
        $this->themeConfiguration   = $themeConfiguration;
        $this->loaded               = $loaded;
    }

    public function navigateTo($orderId)
    {
        $xpath = $this->themeConfiguration->getAccountNavigationXpath($this->themeConfiguration->getOrderPageName());
        $element = $this->webDriver->byXpath($xpath);
        $element->click();
        $this->loaded->execute($element);

        $xpath = $this->themeConfiguration->getViewOrderLinkXpath($orderId);
        $element = $this->webDriver->byXpath($xpath);
        $element->click();
        $this->loaded->execute($element);

        $this->webDriver->wait()->until(ExpectedCondition::titleContains($this->themeConfiguration->getOrderPageTitleContainsText()));

    }

}