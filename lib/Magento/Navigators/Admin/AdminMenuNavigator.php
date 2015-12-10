<?php

namespace Magium\Magento\Navigators\Admin;

use Magium\Magento\Navigators\BaseMenuNavigator;
use Magium\Magento\Themes\Admin\ThemeConfiguration;
use Magium\WebDriver\WebDriver;

class AdminMenuNavigator extends BaseMenuNavigator
{


    public function __construct(ThemeConfiguration $theme, WebDriver $webdriver)
    {
        parent::__construct($theme, $webdriver);
    }
    
    
    
}