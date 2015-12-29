<?php

namespace Magium\Magento\Actions\Checkout\Steps;

use Magium\AbstractTestCase;
use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Themes\OnePageCheckout\AbstractThemeConfiguration;
use Magium\WebDriver\WebDriver;

class SelectGuestCheckout implements StepInterface
{
    const ACTION = 'Checkout\Steps\SelectGuestCheckout';
    protected $webdriver;
    protected $theme;
    protected $testCase;
    
    public function __construct(
        WebDriver $webdriver,
        AbstractThemeConfiguration $theme,
        AbstractMagentoTestCase $testCase
    ) {
        $this->webdriver    = $webdriver;
        $this->theme        = $theme;
        $this->testCase     = $testCase;
    }
    
    public function execute()
    {
        $this->testCase->assertElementExists($this->theme->getGuestCheckoutButtonXpath(), AbstractTestCase::BY_XPATH);
        $element = $this->webdriver->byXpath($this->theme->getGuestCheckoutButtonXpath());
        $this->testCase->assertWebDriverElement($element);
        $element->click();

        return true;
    }

    public function nextAction()
    {
        $this->testCase->assertElementExists($this->theme->getContinueButtonXpath(), AbstractTestCase::BY_XPATH);
        $element = $this->webdriver->byXpath($this->theme->getContinueButtonXpath());
        $this->testCase->assertWebDriverElement($element);
        $element->click();
        return true;
    }
}