<?php

namespace Magium\Magento\Actions\Checkout\Steps;

use Magium\Magento\Themes\OnePageCheckout\AbstractThemeConfiguration;
use Magium\WebDriver\WebDriver;

class NavigateToCheckout implements StepInterface
{
    const ACTION = 'Checkout\Steps\NavigateToCheckout';
    
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
        // This class may not actually be used
        return true;
    }

    public function nextAction()
    {
        return true;
    }
}