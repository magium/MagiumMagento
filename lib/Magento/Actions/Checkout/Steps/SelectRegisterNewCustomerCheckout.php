<?php

namespace Magium\Magento\Actions\Checkout\Steps;

use Magium\AbstractTestCase;
use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Identities\Customer;
use Magium\Magento\Themes\OnePageCheckout\AbstractThemeConfiguration;
use Magium\WebDriver\ExpectedCondition;
use Magium\WebDriver\WebDriver;

class SelectRegisterNewCustomerCheckout implements StepInterface
{
    const ACTION = 'Checkout\Steps\SelectRegisterNewCustomerCheckout';
    protected $webdriver;
    protected $theme;
    protected $testCase;
    protected $customer;
    
    public function __construct(
        WebDriver               $webdriver,
        AbstractThemeConfiguration      $theme,
        AbstractMagentoTestCase $testCase,
        Customer                $customer
    ) {
        $this->webdriver    = $webdriver;
        $this->theme        = $theme;
        $this->testCase     = $testCase;
        $this->customer     = $customer;
    }
    
    public function execute()
    {

        if (!$this->customer->isUniqueEmailAddressGenerated()) {
            $this->customer->generateUniqueEmailAddress();
        }


        $this->webdriver->wait()->until(ExpectedCondition::elementExists($this->theme->getRegisterNewCustomerCheckoutButtonXpath(), AbstractTestCase::BY_XPATH));
        $element = $this->webdriver->byXpath($this->theme->getRegisterNewCustomerCheckoutButtonXpath());
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