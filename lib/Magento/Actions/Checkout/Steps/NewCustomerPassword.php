<?php

namespace Magium\Magento\Actions\Checkout\Steps;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Identities\Customer;
use Magium\Magento\Themes\OnePageCheckout\AbstractThemeConfiguration;
use Magium\WebDriver\WebDriver;

class NewCustomerPassword implements StepInterface
{

    const ACTION = 'Checkout\Steps\NewCustomerPassword';

    protected $webdriver;
    protected $theme;
    protected $customerIdentity;
    protected $testCase;

    protected $bypass = [];

    public function __construct(
        WebDriver                   $webdriver,
        AbstractThemeConfiguration          $theme,
        Customer            $customerIdentity,
        AbstractMagentoTestCase     $testCase
    ) {
        $this->webdriver        = $webdriver;
        $this->theme            = $theme;
        $this->customerIdentity = $customerIdentity;
        $this->testCase         = $testCase;
    }

    public function execute()
    {
        $this->testCase->assertElementDisplayed($this->theme->getPasswordInputXpath(), WebDriver::BY_XPATH);
        $this->testCase->assertElementDisplayed($this->theme->getConfirmPasswordInputXpath(), WebDriver::BY_XPATH);
        $this->webdriver->byXpath($this->theme->getPasswordInputXpath())->sendKeys($this->customerIdentity->getPassword());
        $this->webdriver->byXpath($this->theme->getConfirmPasswordInputXpath())->sendKeys($this->customerIdentity->getPassword());
        return true;
    }

}