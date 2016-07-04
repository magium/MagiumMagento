<?php

namespace Magium\Magento\Actions\Checkout\Steps;

use Facebook\WebDriver\Exception\StaleElementReferenceException;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Actions\Checkout\PaymentMethods\PaymentMethodInterface;
use Magium\Magento\Themes\OnePageCheckout\AbstractThemeConfiguration;
use Magium\WebDriver\ExpectedCondition;
use Magium\WebDriver\WebDriver;

class PaymentMethod implements StepInterface
{
    const ACTION = 'Checkout\Steps\PaymentMethod';

    protected $webdriver;
    protected $theme;
    protected $testCase;
    protected $paymentMethod;

    protected $requirePayment = false;

    public function __construct(
        WebDriver                   $webdriver,
        AbstractThemeConfiguration          $theme,
        AbstractMagentoTestCase     $testCase,
        PaymentMethodInterface      $paymentMethod
    ) {
        $this->webdriver        = $webdriver;
        $this->theme            = $theme;
        $this->testCase         = $testCase;
        $this->paymentMethod    = $paymentMethod;
    }

    public function requirePayment($require = true)
    {
        $this->requirePayment = $require;
    }
    
    public function execute()
    {
        $this->webdriver->wait(10)->until(ExpectedCondition::elementExists($this->theme->getPaymentMethodContinueButtonXpath(), WebDriver::BY_XPATH));
        $element = $this->webdriver->byXpath($this->theme->getPaymentMethodContinueButtonXpath());
        $this->webdriver->wait(5)->until(ExpectedCondition::visibilityOf($element));

        /* Given that there is the possibility of either a) products with $0, and b) payment methods that do not use
         * the standard form we do not fail if we cannot find payment elements
         */

        $this->paymentMethod->pay($this->requirePayment);
        return true;
    }

    public function nextAction()
    {
        $this->webdriver->byXpath($this->theme->getPaymentMethodContinueButtonXpath())->click();

        try {
            $this->webdriver->wait()->until(
                WebDriverExpectedCondition::not(
                    WebDriverExpectedCondition::visibilityOf(
                        $this->webdriver->byXpath(
                            $this->theme->getPaymentMethodContinueCompleteXpath()
                        )
                    )
                )
            );
        } catch (StaleElementReferenceException $e) {
            // it is possible that the page rendered with unexpected timing which may lead to a harmless StaleElementReferenceException
        }
        return true;
    }
}