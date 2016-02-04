<?php

namespace Magium\Magento\Navigators\Admin\Widget;

use Magium\Magento\Themes\Admin\ThemeConfiguration;
use Magium\WebDriver\ExpectedCondition;
use Magium\WebDriver\WebDriver;

class Tab
{

    const NAVIGATOR = 'Admin\Widget\Tab';

    protected $webDriver;
    protected $themeConfiguration;

    public function __construct(
        WebDriver $webDriver,
        ThemeConfiguration $themeConfiguration
    )
    {
        $this->themeConfiguration = $themeConfiguration;
        $this->webDriver          = $webDriver;
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

        $this->webDriver->wait()->until(ExpectedCondition::elementExists($this->themeConfiguration->getWidgetTabHeaderXpath($header), WebDriver::BY_XPATH));
        $element = $this->webDriver->byXpath($this->themeConfiguration->getWidgetTabHeaderXpath($header));
        $this->webDriver->wait()->until(ExpectedCondition::visibilityOf($element));

    }


}