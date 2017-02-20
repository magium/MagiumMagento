<?php

namespace Magium\Magento\Actions\Admin\Widget;

use Magium\Actions\ConfigurableActionInterface;
use Magium\InvalidInstructionException;
use Magium\Magento\Themes\Admin\ThemeConfiguration;
use Magium\WebDriver\ExpectedCondition;
use Magium\WebDriver\WebDriver;

class ClickActionButton implements ConfigurableActionInterface
{

    const ACTION = 'Admin\Widget\ClickActionButton';

    protected $webDriver;
    protected $themeConfiguration;

    /**
     * ClickActionButton constructor.
     * @param $themeConfiguration
     * @param $webDriver
     */
    public function __construct(
        ThemeConfiguration $themeConfiguration,
        WebDriver $webDriver)
    {
        $this->themeConfiguration = $themeConfiguration;
        $this->webDriver = $webDriver;
    }


    public function click($label)
    {
        $this->webDriver->action()->moveToElement($this->webDriver->byXpath('//body'));
        $xpath = $this->themeConfiguration->getWidgetActionButtonXpath($label);
        $this->webDriver->wait(10)->until(ExpectedCondition::elementExists($xpath, WebDriver::BY_XPATH));
        $element = $this->webDriver->byXpath($xpath);
        $this->webDriver->wait(10)->until(ExpectedCondition::visibilityOf($element));
        $element->click();
    }

    public function execute($label)
    {
        $this->click($label);
    }

}
