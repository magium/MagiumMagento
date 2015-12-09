<?php

namespace Magium\Magento\Actions\Checkout\Steps;

use Magium\Magento\Themes\OnePageCheckout\AbstractThemeConfiguration;
use Magium\WebDriver\WebDriver;

class NavigateToCheckout implements StepInterface
{
    
    protected $webdriver;
    protected $theme;
    
    public function __construct(
        WebDriver $webdriver,
        AbstractThemeConfiguration $theme
    ) {
        $this->webdriver    = $webdriver;
        $this->theme        = $theme;
    }
    
    public function execute()
    {
        
    }
}