<?php

namespace Magium\Magento\Actions\Admin\Widget;

use Magium\InvalidInstructionException;
use Magium\Magento\Themes\Admin\ThemeConfiguration;
use Magium\WebDriver\WebDriver;

class ClickActionButton
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
        $this->webDriver->byXpath($xpath)->click();
    }

    public function execute()
    {
        throw new InvalidInstructionException('Use click() instead');
    }

}