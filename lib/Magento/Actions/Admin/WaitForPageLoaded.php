<?php

namespace Magium\Magento\Actions\Admin;

use Magium\Magento\Themes\Admin\ThemeConfiguration;
use Magium\WebDriver\WebDriver;

class WaitForPageLoaded extends \Magium\Actions\WaitForPageLoaded
{
    public function __construct(WebDriver $webDriver, ThemeConfiguration $themeConfiguration)
    {
        parent::__construct($webDriver, $themeConfiguration);
    }


}