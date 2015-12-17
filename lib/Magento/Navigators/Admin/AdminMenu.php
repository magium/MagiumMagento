<?php

namespace Magium\Magento\Navigators\Admin;

use Magium\Magento\Navigators\BaseMenu;
use Magium\Magento\Themes\Admin\ThemeConfiguration;
use Magium\WebDriver\WebDriver;

class AdminMenu extends BaseMenu
{
    const NAVIGATOR = 'Admin\AdminMenu';

    public function __construct(ThemeConfiguration $theme, WebDriver $webdriver)
    {
        parent::__construct($theme, $webdriver);
    }
    
    
    
}