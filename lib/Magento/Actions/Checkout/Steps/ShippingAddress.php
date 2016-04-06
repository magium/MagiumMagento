<?php

namespace Magium\Magento\Actions\Checkout\Steps;

use Facebook\WebDriver\WebDriverExpectedCondition;
use Magium\AbstractTestCase;
use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Identities\Customer;
use Magium\Magento\Themes\OnePageCheckout\AbstractThemeConfiguration;
use Magium\WebDriver\ExpectedCondition;
use Magium\WebDriver\WebDriver;

class ShippingAddress implements StepInterface
{
    const ACTION = 'Checkout\Steps\ShippingAddress';

    protected $webdriver;
    protected $theme;
    protected $customerIdentity;
    protected $testCase;
    protected $bypassNextStep = false;

    protected $enterNewAddress = false;

    public function __construct(
        WebDriver                   $webdriver,
        AbstractThemeConfiguration          $theme,
        Customer                    $customerIdentity,
        AbstractMagentoTestCase     $testCase
    ) {
        $this->webdriver        = $webdriver;
        $this->theme            = $theme;
        $this->customerIdentity = $customerIdentity;
        $this->testCase         = $testCase;
    }

    public function enterNewAddress($newAddress = true)
    {
        $this->enterNewAddress = $newAddress;
    }

    protected function preExecute()
    {
        if ($this->enterNewAddress) {
            $this->webdriver->wait()->until(
                ExpectedCondition::visibilityOf(
                    $this->webdriver->byXpath($this->theme->getShippingNewAddressXpath())
                )
            );
            $this->webdriver->byXpath($this->theme->getShippingNewAddressXpath())->click();
            $this->webdriver->wait()->until(
                ExpectedCondition::visibilityOf(
                    $this->webdriver->byXpath($this->theme->getShippingFirstNameXpath())
                )
            );
        }
        // We will bypass ourself if the billing address is the same as the shipping address.
        if (!$this->webdriver->elementDisplayed($this->theme->getShippingFirstNameXpath(), AbstractTestCase::BY_XPATH)) {
            $this->bypassNextStep = true;
            return true;
        }
        return false;
    }

    public function execute()
    {
        if ($this->preExecute()) {
            return true;
        }

        if ($this->theme->getShippingFirstNameXpath()) {
            $this->testCase->byXpath($this->theme->getShippingFirstNameXpath())->clear();
            $this->testCase->byXpath($this->theme->getShippingFirstNameXpath())->sendKeys($this->customerIdentity->getShippingFirstName());
        }

        if ($this->theme->getShippingLastNameXpath()) {
            $this->testCase->byXpath($this->theme->getShippingLastNameXpath())->clear();
            $this->testCase->byXpath($this->theme->getShippingLastNameXpath())->sendKeys($this->customerIdentity->getShippingLastName());
        }

        if ($this->theme->getShippingCompanyXpath()) {
            $this->testCase->byXpath($this->theme->getShippingCompanyXpath())->clear();
            $this->testCase->byXpath($this->theme->getShippingCompanyXpath())->sendKeys($this->customerIdentity->getShippingCompany());
        }

        if ($this->theme->getShippingAddressXpath()) {
            $this->testCase->byXpath($this->theme->getShippingAddressXpath())->clear();
            $this->testCase->byXpath($this->theme->getShippingAddressXpath())->sendKeys($this->customerIdentity->getShippingAddress());
        }

        if ($this->theme->getShippingAddress2Xpath()) {
            $this->testCase->byXpath($this->theme->getShippingAddress2Xpath())->clear();
            $this->testCase->byXpath($this->theme->getShippingAddress2Xpath())->sendKeys($this->customerIdentity->getShippingAddress2());
        }

        if ($this->theme->getShippingCityXpath()) {
            $this->testCase->byXpath($this->theme->getShippingCityXpath())->clear();
            $this->testCase->byXpath($this->theme->getShippingCityXpath())->sendKeys($this->customerIdentity->getShippingCity());
        }

        $regionXpath = $this->theme->getShippingRegionIdXpath($this->customerIdentity->getShippingRegionId());
        if ($regionXpath) {
            $this->testCase->byXpath($regionXpath)->click();
        }

        if ($this->theme->getShippingPostCodeXpath()) {
            $this->testCase->byXpath($this->theme->getShippingPostCodeXpath())->clear();
            $this->testCase->byXpath($this->theme->getShippingPostCodeXpath())->sendKeys($this->customerIdentity->getShippingPostCode());
        }

        $countryXpath = $this->theme->getShippingCountryIdXpath($this->customerIdentity->getShippingCountryId());
        if ($countryXpath) {
            $this->testCase->byXpath($countryXpath)->click();
        }

        if ($this->theme->getShippingTelephoneXpath()) {
            $this->testCase->byXpath($this->theme->getShippingTelephoneXpath())->clear();
            $this->testCase->byXpath($this->theme->getShippingTelephoneXpath())->sendKeys($this->customerIdentity->getShippingTelephone());
        }

        if ($this->theme->getShippingFaxXpath()) {
            $this->testCase->byXpath($this->theme->getShippingFaxXpath())->clear();
            $this->testCase->byXpath($this->theme->getShippingFaxXpath())->sendKeys($this->customerIdentity->getShippingFax());
        }
        return true;
    }

    public function nextAction()
    {
        if ($this->bypassNextStep) {
            return true;
        }
        $this->testCase->byXpath($this->theme->getShippingContinueButtonXpath())->click();

        $this->webdriver->wait()->until(WebDriverExpectedCondition::not(WebDriverExpectedCondition::visibilityOf($this->webdriver->byXpath($this->theme->getShippingContinueCompletedXpath()))));
        return true;
    }
}