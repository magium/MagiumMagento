<?php

namespace Magium\Magento\Actions\Checkout\PaymentMethods;

use Facebook\WebDriver\WebDriverSelect;
use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Actions\Checkout\PaymentInformation;
use Magium\Magento\Identities\Customer;
use Magium\WebDriver\WebDriver;

class SagePay implements PaymentMethodInterface
{

    const ACTION = 'Checkout\PaymentMethods\SagePay';

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
        \Magium\Magento\Assertions\Checkout\PaymentMethods\SagePay                     $assertion
    ) {
        $this->webDriver    = $webDriver;
        $this->testCase     = $testCase;
        $this->paymentInformation = $paymentInformation;
        $this->customer = $customer;
        $this->assertion = $assertion;
    }

    public function getId()
    {
        return 'p_method_sagepaydirectpro';
    }

    public function pay($requirePayment)
    {
        if ($requirePayment) {
            $this->testCase->assertElementExists($this->getId());
        }

        if (!$this->webDriver->elementDisplayed('sagepaydirectpro_cc_owner')) {
            $this->webDriver->getMouse()->click($this->webDriver->byId($this->getId())->getCoordinates());
        }
        $this->assertion->assert();

        $select = new WebDriverSelect($this->webDriver->byId('sagepaydirectpro_cc_type'));
        $select->selectByValue($this->paymentInformation->getType());

        $this->webDriver->byId('sagepaydirectpro_cc_number')->clear();
        $this->webDriver->byId('sagepaydirectpro_cc_number')->sendKeys($this->paymentInformation->getCreditCardNumber());

        $select = new WebDriverSelect($this->webDriver->byId('sagepaydirectpro_expiration'));
        $select->selectByValue($this->paymentInformation->getExpiryMonth());

        $select = new WebDriverSelect($this->webDriver->byId('sagepaydirectpro_expiration_yr'));
        $select->selectByValue($this->paymentInformation->getExpiryYear());

        $this->webDriver->byId('sagepaydirectpro_cc_cid')->clear();
        $this->webDriver->byId('sagepaydirectpro_cc_cid')->sendKeys($this->paymentInformation->getCvv());

        $this->webDriver->byId('sagepaydirectpro_cc_owner')->clear();
        $this->webDriver->byId('sagepaydirectpro_cc_owner')->sendKeys(
            $this->customer->getBillingFirstName() . ' ' . $this->customer->getBillingLastName()
        );

    }
}