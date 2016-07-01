<?php

namespace Magium\Magento\Actions\Checkout\PaymentMethods;

use Facebook\WebDriver\WebDriverSelect;
use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Actions\Checkout\PaymentInformation;
use Magium\Magento\Identities\Customer;
use Magium\WebDriver\WebDriver;

class SavedCC implements PaymentMethodInterface
{

    const ACTION = 'Checkout\PaymentMethods\SavedCC';

    protected $webDriver;
    protected $testCase;
    protected $paymentInformation;
    protected $customer;
    protected $assertion;

    public function __construct(
        WebDriver                   $webDriver,
        AbstractMagentoTestCase     $testCase,
        PaymentInformation          $paymentInformation,
        Customer                    $customer,
        \Magium\Magento\Assertions\Checkout\PaymentMethods\SavedCC $assertion
    ) {
        $this->webDriver    = $webDriver;
        $this->testCase     = $testCase;
        $this->paymentInformation = $paymentInformation;
        $this->customer = $customer;
        $this->assertion = $assertion;
    }

    public function getId()
    {
        return 'p_method_ccsave';
    }

    public function pay($requirePayment)
    {
        if ($requirePayment) {
            $this->testCase->assertElementExists($this->getId());
        }

        if (!$this->webDriver->elementDisplayed('ccsave_cc_owner')) {
            $element = $this->webDriver->byId($this->getId());
            $this->webDriver->getMouse()->click($element->getCoordinates());
        }
        $this->assertion->assert();

        $this->webDriver->byId('ccsave_cc_owner')->clear();
        $this->webDriver->byId('ccsave_cc_owner')->sendKeys(
            $this->customer->getBillingFirstName() . ' ' . $this->customer->getBillingLastName()
        );

        $select = new WebDriverSelect($this->webDriver->byId('ccsave_cc_type'));
        $select->selectByValue($this->paymentInformation->getType());

        $this->webDriver->byId('ccsave_cc_number')->clear();
        $this->webDriver->byId('ccsave_cc_number')->sendKeys($this->paymentInformation->getCreditCardNumber());

        $select = new WebDriverSelect($this->webDriver->byId('ccsave_expiration'));
        $select->selectByValue($this->paymentInformation->getExpiryMonth());

        $select = new WebDriverSelect($this->webDriver->byId('ccsave_expiration_yr'));
        $select->selectByValue($this->paymentInformation->getExpiryYear());

    }
}