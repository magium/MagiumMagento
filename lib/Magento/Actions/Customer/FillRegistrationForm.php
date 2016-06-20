<?php

namespace Magium\Magento\Actions\Customer;

use Magium\Magento\Identities\Customer;
use Magium\Magento\Themes\AbstractThemeConfiguration;
use Magium\WebDriver\WebDriver;

class FillRegistrationForm
{

    const ACTION = 'Customer\FillRegistrationForm';

    protected $webdriver;
    protected $theme;
    protected $testCase;
    protected $navigator;
    protected $customerIdentity;

    public function __construct(
        WebDriver               $webdriver,
        AbstractThemeConfiguration      $theme,
        Customer                $customerIdentity
    ) {
        $this->webdriver    = $webdriver;
        $this->theme        = $theme;
        $this->customerIdentity = $customerIdentity;
    }

    public function execute($registerForNewsletter = false)
    {
        $firstnameElement  = $this->webdriver->byXpath($this->theme->getRegisterFirstNameXpath());
        $lastnameElement   = $this->webdriver->byXpath($this->theme->getRegisterLastNameXpath());
        $emailElement      = $this->webdriver->byXpath($this->theme->getRegisterEmailXpath());
        $passwordElement   = $this->webdriver->byXpath($this->theme->getRegisterPasswordXpath());
        $confirmElement    = $this->webdriver->byXpath($this->theme->getRegisterConfirmPasswordXpath());
        $registerElement     = $this->webdriver->byXpath($this->theme->getRegisterNewsletterXpath());

        $firstnameElement->sendKeys($this->customerIdentity->getFirstName());
        $lastnameElement->sendKeys($this->customerIdentity->getLastName());
        $emailElement->sendKeys($this->customerIdentity->getEmailAddress());
        $passwordElement->sendKeys($this->customerIdentity->getPassword());
        $confirmElement->sendKeys($this->customerIdentity->getPassword());

        if ($registerForNewsletter) {
            $registerElement->click();
        }

    }

}