<?php

namespace Magium\Magento\Actions\Checkout\Steps;

use Facebook\WebDriver\WebDriverExpectedCondition;
use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Actions\Checkout\ShippingMethods\ShippingMethodInterface;
use Magium\Magento\Themes\OnePageCheckout\AbstractThemeConfiguration;
use Magium\WebDriver\WebDriver;

class ShippingMethod implements StepInterface
{
    const ACTION = 'Checkout\Steps\ShippingMethod';
    protected $webdriver;
    protected $theme;
    protected $testCase;
    protected $shipping;

    protected $requireShipping = false;

    public function __construct(
        WebDriver                   $webdriver,
        AbstractThemeConfiguration          $theme,
        AbstractMagentoTestCase     $testCase,
        ShippingMethodInterface     $shippingMethod
    ) {
        $this->webdriver        = $webdriver;
        $this->theme            = $theme;
        $this->testCase         = $testCase;
        $this->shipping         = $shippingMethod;

    }

    public function requireShipping($require = true)
    {
        $this->requireShipping = $require;
    }
    
    public function execute()
    {
        $this->shipping->choose($this->requireShipping);
        $this->webdriver->byXpath($this->theme->getShippingMethodContinueButtonXpath())->click();
        $this->webdriver->wait()->until(
            WebDriverExpectedCondition::not(
                WebDriverExpectedCondition::visibilityOf(
                    $this->webdriver->byXpath(
                        $this->theme->getShippingMethodContinueCompletedXpath()
                    )
                )
            )
        );
        return true; // continue to next step
    }
}