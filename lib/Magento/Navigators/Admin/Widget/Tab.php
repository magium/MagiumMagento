<?php

namespace Magium\Magento\Navigators\Admin\Widget;

use Magium\Magento\Actions\Admin\WaitForLoadingMask;
use Magium\Magento\Themes\Admin\ThemeConfiguration;
use Magium\Navigators\ConfigurableNavigatorInterface;
use Magium\WebDriver\ExpectedCondition;
use Magium\WebDriver\WebDriver;

class Tab implements ConfigurableNavigatorInterface
{

    const NAVIGATOR = 'Admin\Widget\Tab';

    protected $webDriver;
    protected $themeConfiguration;
    protected $loadingMask;

    public function __construct(
        WebDriver $webDriver,
        ThemeConfiguration $themeConfiguration,
        WaitForLoadingMask $loadingMask
    )
    {
        $this->themeConfiguration = $themeConfiguration;
        $this->webDriver          = $webDriver;
        $this->loadingMask        = $loadingMask;
    }

    public function navigateTo($tab)
    {
        $tabs = explode('::', $tab);
        $tab = $header = array_shift($tabs);
        if (count($tabs)) {
            $header = array_shift($tabs);
        }
        $element = $this->webDriver->byXpath($this->themeConfiguration->getWidgetTabXpath($tab));
        $element->click();
        if ($header) {
            $this->webDriver->wait()->until(ExpectedCondition::elementExists($this->themeConfiguration->getWidgetTabHeaderXpath($header), WebDriver::BY_XPATH));
            $element = $this->webDriver->byXpath($this->themeConfiguration->getWidgetTabHeaderXpath($header));
        } else {
            $this->loadingMask->wait();
        }
        $this->webDriver->wait()->until(ExpectedCondition::visibilityOf($element));

    }


}