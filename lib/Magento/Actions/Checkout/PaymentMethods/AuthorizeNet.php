<?php

namespace Magium\Magento\Actions\Checkout\PaymentMethods;

use Facebook\WebDriver\WebDriverSelect;
use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Actions\Checkout\PaymentInformation;
use Magium\WebDriver\WebDriver;

class AuthorizeNet implements PaymentMethodInterface
{

    const ACTION = 'Checkout\PaymentMethods\AuthorizeNet';

    protected $webDriver;
    protected $testCase;
    protected $paymentInformation;

    public function __construct(
        WebDriver                   $webDriver,
        AbstractMagentoTestCase     $testCase,
        PaymentInformation          $paymentInformation
    ) {
        $this->webDriver            = $webDriver;
        $this->testCase             = $testCase;
        $this->paymentInformation   = $paymentInformation;
    }

    public function getId()
    {
        return 'p_method_authorizenet';
    }

    public function pay($requirePayment)
    {
        if ($requirePayment) {
            $this->testCase->assertElementExists($this->getId());
        }

        if ($this->webDriver->elementDisplayed($this->getId())) {
            $this->webDriver->byId($this->getId())->click();
        }
        $this->webDriver->byId('authorizenet_cc_number')
                        ->clear()
                        ->sendKeys($this->paymentInformation->getCreditCardNumber());
        $expirationMonthSelect = new WebDriverSelect($this->webDriver->byId('authorizenet_expiration'));
        $expirationMonthSelect->selectByValue($this->paymentInformation->getExpiryMonth());

        $expirationYearSelect = new WebDriverSelect($this->webDriver->byId('authorizenet_expiration_yr'));
        $expirationYearSelect->selectByValue($this->paymentInformation->getExpiryYear());

        $typeSelect = new WebDriverSelect($this->webDriver->byId('authorizenet_cc_type'));
        $typeSelect->selectByValue($this->paymentInformation->getType());

    }
}