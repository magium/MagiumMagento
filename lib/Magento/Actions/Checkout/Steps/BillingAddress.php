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

    protected function shouldProcess($xpath)
    {
        if (!$xpath) {
            return false;
        }
        return array_search($xpath, $this->bypass) === false;
    }

    protected function sendData($xpath, $data)
    {
        if ($this->shouldProcess($xpath)) {
            $this->testCase->byXpath($xpath)->clear();
            $this->testCase->byXpath($xpath)->sendKeys($data);
        }
    }

    public function execute()
    {
        if ($this->preExecute()) {
            return true;
        }
        $this->sendData($this->theme->getBillingEmailAddressXpath(), $this->customerIdentity->getEmailAddress());
        $this->sendData($this->theme->getBillingFirstNameXpath(), $this->customerIdentity->getBillingFirstName());
        $this->sendData($this->theme->getBillingLastNameXpath(), $this->customerIdentity->getBillingLastName());
        $this->sendData($this->theme->getBillingCompanyXpath(), $this->customerIdentity->getBillingCompany());
        $this->sendData($this->theme->getBillingAddressXpath(), $this->customerIdentity->getBillingAddress());
        $this->sendData($this->theme->getBillingAddress2Xpath(), $this->customerIdentity->getBillingAddress2());
        $this->sendData($this->theme->getBillingCityXpath(), $this->customerIdentity->getBillingCity());

        $regionXpath = $this->theme->getBillingRegionIdXpath($this->customerIdentity->getBillingRegionId());
        if ($this->shouldProcess($regionXpath)) {
            $this->testCase->byXpath($regionXpath)->click();
        }

        $this->sendData($this->theme->getBillingPostCodeXpath(), $this->customerIdentity->getBillingPostCode());

        $countryXpath = $this->theme->getBillingCountryIdXpath($this->customerIdentity->getBillingCountryId());
        if ($this->shouldProcess($countryXpath)) {
            $this->testCase->byXpath($countryXpath)->click();
        }

        $this->sendData($this->theme->getBillingTelephoneXpath(), $this->customerIdentity->getBillingTelephone());
        $this->sendData($this->theme->getBillingFaxXpath(), $this->customerIdentity->getBillingFax());

        return true;
    }


    public function nextAction()
    {
        $this->testCase->byXpath($this->theme->getBillingContinueButtonXpath())->click();

        $this->webdriver->wait()->until(WebDriverExpectedCondition::not(WebDriverExpectedCondition::visibilityOf($this->webdriver->byXpath($this->theme->getBillingContinueCompletedXpath()))));
        return true;
    }
}