<?php

namespace Magium\Magento\Actions\Customer;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Identities\Customer;
use Magium\Magento\Navigators\Customer\Registration;
use Magium\Magento\Themes\AbstractThemeConfiguration;
use Magium\WebDriver\ExpectedCondition;
use Magium\WebDriver\WebDriver;

class Register
{
    const ACTION = 'Customer\Register';

    protected $webdriver;
    protected $theme;
    protected $testCase;
    protected $navigator;
    protected $customerIdentity;


    public function __construct(
        WebDriver               $webdriver,
        AbstractThemeConfiguration      $theme,
        Registration    $navigator,
        Customer                $customerIdentity,
        AbstractMagentoTestCase $testCase

    ) {
        $this->webdriver    = $webdriver;
        $this->theme        = $theme;
        $this->testCase     = $testCase;
        $this->navigator = $navigator;
        $this->customerIdentity = $customerIdentity;
    }

    public function register($registerForNewsletter = false)
    {
        $this->navigator->navigateTo();

        $firstnameElement  = $this->webdriver->byXpath($this->theme->getRegisterFirstNameXpath());
        $lastnameElement   = $this->webdriver->byXpath($this->theme->getRegisterLastNameXpath());
        $emailElement      = $this->webdriver->byXpath($this->theme->getRegisterEmailXpath());
        $passwordElement   = $this->webdriver->byXpath($this->theme->getRegisterPasswordXpath());
        $confirmElement    = $this->webdriver->byXpath($this->theme->getRegisterConfirmPasswordXpath());
        $submitElement     = $this->webdriver->byXpath($this->theme->getRegisterSubmitXpath());
        $registerElement     = $this->webdriver->byXpath($this->theme->getRegisterNewsletterXpath());

        $firstnameElement->sendKeys($this->customerIdentity->getFirstName());
        $lastnameElement->sendKeys($this->customerIdentity->getLastName());
        $emailElement->sendKeys($this->customerIdentity->getEmailAddress());
        $passwordElement->sendKeys($this->customerIdentity->getPassword());
        $confirmElement->sendKeys($this->customerIdentity->getPassword());

        if ($registerForNewsletter) {
            $registerElement->click();
        }

        $submitElement->click();

        $this->webdriver->wait()->until(ExpectedCondition::titleIs($this->theme->getMyAccountTitle()));
    }
}