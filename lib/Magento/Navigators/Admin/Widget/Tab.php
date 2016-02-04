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
        $element = $this->webDriver->byXpath($this->themeConfiguration->getWidgetTabXpath($tab));
        $element->click();

        $this->webDriver->wait()->until(ExpectedCondition::elementExists($this->themeConfiguration->getWidgetTabHeaderXpath($tab), WebDriver::BY_XPATH));
        $element = $this->webDriver->byXpath($this->themeConfiguration->getWidgetTabHeaderXpath($tab));
        $this->webDriver->wait()->until(ExpectedCondition::visibilityOf($element));

    }


}