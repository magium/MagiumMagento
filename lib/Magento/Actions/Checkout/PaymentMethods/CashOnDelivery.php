<?php

namespace Magium\Magento\Actions\Checkout\PaymentMethods;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\WebDriver\WebDriver;

class CashOnDelivery implements PaymentMethodInterface
{

    const ACTION = 'Checkout\PaymentMethods\CashOnDelivery';

    protected $webDriver;
    protected $testCase;

    public function __construct(
        WebDriver                   $webDriver,
        AbstractMagentoTestCase     $testCase
    ) {
        $this->webDriver    = $webDriver;
        $this->testCase     = $testCase;
    }

    public function getId()
    {
        return 'p_method_cashondelivery';
    }

    /**
     * Fills in the payment form, selecting it, if necessary
     *
     * @param $requirePayment
     */

    public function pay($requirePayment)
    {
        if ($requirePayment) {
            $this->testCase->assertElementExists($this->getId());
        }

        if ($this->webDriver->elementDisplayed($this->getId())) {
            $element = $this->webDriver->byId($this->getId());
            $this->webDriver->getMouse()->click($element->getCoordinates());
        }
    }
}