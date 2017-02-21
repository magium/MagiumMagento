<?php

namespace Magium\Magento\Actions\Admin;

use Magium\Actions\StaticActionInterface;
use Magium\Magento\Themes\Admin\ThemeConfiguration;
use Magium\WebDriver\ExpectedCondition;
use Magium\WebDriver\WebDriver;

class WaitForLoadingMask implements StaticActionInterface
{
    const ACTION = 'Admin\WaitForLoadingMask';

    protected $webDriver;
    protected $theme;

    public function __construct(
        WebDriver          $webDriver,
        ThemeConfiguration $themeConfiguration
    )
    {
        $this->webDriver    = $webDriver;
        $this->theme        = $themeConfiguration;
    }

    public function wait()
    {
        $this->webDriver->wait()->until(
            ExpectedCondition::not(
                ExpectedCondition::visibilityOf(
                    $this->webDriver->byXpath($this->theme->getLoadMaskXpath()
                    )
                )
            )
        );
    }

    public function execute()
    {
        $this->wait();
    }

}
