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
    protected $form;

    public function __construct(
        WebDriver               $webdriver,
        AbstractThemeConfiguration      $theme,
        Registration    $navigator,
        Customer                $customerIdentity,
        AbstractMagentoTestCase $testCase,
        FillRegistrationForm    $form
    ) {
        $this->webdriver    = $webdriver;
        $this->theme        = $theme;
        $this->testCase     = $testCase;
        $this->navigator = $navigator;
        $this->customerIdentity = $customerIdentity;
        $this->form = $form;
    }

    public function register($registerForNewsletter = false)
    {
        $this->navigator->navigateTo();

        $this->form->execute($registerForNewsletter);

        $submitElement     = $this->webdriver->byXpath($this->theme->getRegisterSubmitXpath());

        $submitElement->click();

        $this->webdriver->wait()->until(ExpectedCondition::titleIs($this->theme->getMyAccountTitle()));
    }
}