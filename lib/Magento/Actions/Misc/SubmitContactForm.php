<?php

namespace Magium\Magento\Actions\Misc;

use Magium\Actions\WaitForPageLoaded;
use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Identities\Customer;
use Magium\Magento\Themes\AbstractThemeConfiguration;
use Magium\WebDriver\WebDriver;

class SubmitContactForm
{
    const ACTION = 'Misc\SubmitContactForm';

    protected $webDriver;
    protected $testCase;
    protected $customer;
    protected $theme;
    protected $loaded;

    protected $comment;

    public function __construct(
        WebDriver $webDriver,
        AbstractMagentoTestCase $testCase,
        Customer $customer,
        AbstractThemeConfiguration $themeConfiguration,
        WaitForPageLoaded $loaded
    )
    {
        $this->webDriver    = $webDriver;
        $this->testCase     = $testCase;
        $this->customer     = $customer;
        $this->theme        = $themeConfiguration;
        $this->loaded       = $loaded;
    }

    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    public function execute()
    {
        $this->testCase->assertElementDisplayed($this->theme->getContactUsNameXpath(), WebDriver::BY_XPATH);
        $this->testCase->assertElementDisplayed($this->theme->getContactUsEmailXpath(), WebDriver::BY_XPATH);
        $this->testCase->assertElementDisplayed($this->theme->getContactUsTelephoneXpath(), WebDriver::BY_XPATH);
        $this->testCase->assertElementDisplayed($this->theme->getContactUsCommentXpath(), WebDriver::BY_XPATH);
        $this->testCase->assertElementDisplayed($this->theme->getContactUsSubmitXpath(), WebDriver::BY_XPATH);

        $this->webDriver->byXpath($this->theme->getContactUsNameXpath())->clear()->sendKeys(
            $this->customer->getFirstName() . ' ' . $this->customer->getLastName()
        );

        $this->webDriver->byXpath($this->theme->getContactUsEmailXpath())->clear()->sendKeys(
            $this->customer->getEmailAddress()
        );

        $this->webDriver->byXpath($this->theme->getContactUsTelephoneXpath())->clear()->sendKeys(
            $this->customer->getBillingTelephone()
        );

        $this->webDriver->byXpath($this->theme->getContactUsCommentXpath())->clear()->sendKeys(
            $this->comment
        );

        $this->webDriver->byXpath($this->theme->getContactUsSubmitXpath())->click();

    }


}