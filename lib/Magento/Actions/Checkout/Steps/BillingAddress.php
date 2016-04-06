<?php

namespace Magium\Magento\Actions\Checkout\Steps;

use Facebook\WebDriver\WebDriverExpectedCondition;
use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Identities\Customer;
use Magium\Magento\Themes\OnePageCheckout\AbstractThemeConfiguration;
use Magium\WebDriver\WebDriver;

class BillingAddress implements StepInterface
{
    const ACTION = 'Checkout\Steps\BillingAddress';

    protected $webdriver;
    protected $theme;
    protected $customerIdentity;
    protected $testCase;
    protected $shipToDifferentAddress;

    protected $enterNewAddress;
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

    /**
     * Allows you to bypass arbitrary element assertions and entry.  Currently only supports email address.
     *
     * @see Magium\Magento\Actions\Checkout\Steps\CustomerBillingAddress
     *
     * @param $element The name of the element
     */

    public function bypassElement($element)
    {
        $this->bypass[] = $element;
    }

    public function shipToDifferentAddress($ship = true)
    {
        $this->shipToDifferentAddress = $ship;
    }

    public function enterNewAddress($newAddress = true)
    {
        $this->enterNewAddress = $newAddress;
    }

    protected function preExecute()
    {
        if ($this->enterNewAddress & $this->webdriver->elementDisplayed($this->theme->getBillingNewAddressXpath(), WebDriver::BY_XPATH)) {
            $this->webdriver->byXpath($this->theme->getBillingNewAddressXpath())->click();
        }

        if ($this->shipToDifferentAddress) {
            if ($this->webdriver->elementExists($this->theme->getDoNotUseBillingAddressForShipping(), WebDriver::BY_XPATH)) {
                $this->webdriver->byXpath($this->theme->getDoNotUseBillingAddressForShipping())->click();
            }
        } else {
            if ($this->webdriver->elementExists($this->theme->getUseBillingAddressForShipping(), WebDriver::BY_XPATH)) {
                $this->webdriver->byXpath($this->theme->getUseBillingAddressForShipping())->click();
            }
        }

        if (!$this->enterNewAddress && $this->webdriver->elementDisplayed($this->theme->getBillingAddressDropdownXpath(), WebDriver::BY_XPATH)) {
            // We're logged in and we have an address.

            return true;
        }
        return false;
    }

    public function execute()
    {
        if ($this->preExecute()) {
            return true;
        }

        if ($this->theme->getBillingEmailAddressXpath()) {
            $this->testCase->byXpath($this->theme->getBillingEmailAddressXpath())->clear();
            $this->testCase->byXpath($this->theme->getBillingEmailAddressXpath())->sendKeys($this->customerIdentity->getEmailAddress());
        }
        if ($this->theme->getBillingFirstNameXpath()) {
            $this->testCase->byXpath($this->theme->getBillingFirstNameXpath())->clear();
            $this->testCase->byXpath($this->theme->getBillingFirstNameXpath())->sendKeys($this->customerIdentity->getBillingFirstName());
        }

        if ($this->theme->getBillingLastNameXpath()) {
            $this->testCase->byXpath($this->theme->getBillingLastNameXpath())->clear();
            $this->testCase->byXpath($this->theme->getBillingLastNameXpath())->sendKeys($this->customerIdentity->getBillingLastName());
        }

        if ($this->theme->getBillingCompanyXpath()) {
            $this->testCase->byXpath($this->theme->getBillingCompanyXpath())->clear();
            $this->testCase->byXpath($this->theme->getBillingCompanyXpath())->sendKeys($this->customerIdentity->getBillingCompany());
        }

        if ($this->theme->getBillingAddressXpath()) {
            $this->testCase->byXpath($this->theme->getBillingAddressXpath())->clear();
            $this->testCase->byXpath($this->theme->getBillingAddressXpath())->sendKeys($this->customerIdentity->getBillingAddress());
        }

        if ($this->theme->getBillingAddress2Xpath()) {
            $this->testCase->byXpath($this->theme->getBillingAddress2Xpath())->clear();
            $this->testCase->byXpath($this->theme->getBillingAddress2Xpath())->sendKeys($this->customerIdentity->getBillingAddress2());
        }

        if ($this->theme->getBillingCityXpath()) {
            $this->testCase->byXpath($this->theme->getBillingCityXpath())->clear();
            $this->testCase->byXpath($this->theme->getBillingCityXpath())->sendKeys($this->customerIdentity->getBillingCity());
        }

        $regionXpath = $this->theme->getBillingRegionIdXpath($this->customerIdentity->getBillingRegionId());
        if ($regionXpath) {
            $this->testCase->byXpath($regionXpath)->click();
        }

        if ($this->theme->getBillingPostCodeXpath()) {
            $this->testCase->byXpath($this->theme->getBillingPostCodeXpath())->clear();
            $this->testCase->byXpath($this->theme->getBillingPostCodeXpath())->sendKeys($this->customerIdentity->getBillingPostCode());
        }

        $countryXpath = $this->theme->getBillingCountryIdXpath($this->customerIdentity->getBillingCountryId());
        if ($countryXpath) {
            $this->testCase->byXpath($countryXpath)->click();
        }

        if ($this->theme->getBillingTelephoneXpath()) {
            $this->testCase->byXpath($this->theme->getBillingTelephoneXpath())->clear();
            $this->testCase->byXpath($this->theme->getBillingTelephoneXpath())->sendKeys($this->customerIdentity->getBillingTelephone());
        }

        if ($this->theme->getBillingFaxXpath()) {
            $this->testCase->byXpath($this->theme->getBillingFaxXpath())->clear();
            $this->testCase->byXpath($this->theme->getBillingFaxXpath())->sendKeys($this->customerIdentity->getBillingFax());
        }

        return true;
    }


    public function nextAction()
    {
        $this->testCase->byXpath($this->theme->getBillingContinueButtonXpath())->click();

        $this->webdriver->wait()->until(WebDriverExpectedCondition::not(WebDriverExpectedCondition::visibilityOf($this->webdriver->byXpath($this->theme->getBillingContinueCompletedXpath()))));
        return true;
    }
}