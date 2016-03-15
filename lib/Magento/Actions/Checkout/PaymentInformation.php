<?php

namespace Magium\Magento\Actions\Checkout;

use Magium\AbstractConfigurableElement;
use Magium\Util\Configuration\ConfigurationCollector\DefaultPropertyCollector;
use Magium\Util\Configuration\StandardConfigurationProvider;

class PaymentInformation extends AbstractConfigurableElement
{
    const ACTION = 'Checkout\PaymentInformation';

    public $creditCardNumber;
    public $expiryYear;
    public $expiryMonth;
    public $cvv;
    public $type;

    public function __construct(StandardConfigurationProvider $configurationProvider, DefaultPropertyCollector $collector)
    {
        /*
         * Note: payment information is placed in this class instead of the payment step because I wanted to make
         * the payment easily configurable which is why this class extends AbstractConfigurableElement.  The payment
         * step class does not extend AbstractConfigurableElement (because it needs the constructor for dependency
         * injection) and so this class is here so payment can be globally configured.
         *
         * This way if you want to handle your own credit card you only have to configure this class
        */

        parent::__construct($configurationProvider, $collector);
        $this->setDefaults();
    }


    protected function setDefaults()
    {
        if (!$this->creditCardNumber) {
            $this->creditCardNumber = '4111111111111111';
        }
        if (!$this->expiryMonth) {
            $this->expiryMonth = '1';
        }
        if (!$this->expiryYear) {
            $this->expiryYear = date('Y', time() + (60 * 60 * 24 * 365 * 5));  // January plus 5 years
        }
        if (!$this->cvv) {
            $this->cvv = '123';
        }
        if (!$this->type) {
            $this->type = 'VI';
        }
    }

    /**
     * @return string
     */
    public function getCreditCardNumber()
    {
        return $this->creditCardNumber;
    }

    /**
     * @param string $creditCardNumber
     */
    public function setCreditCardNumber($creditCardNumber)
    {
        $this->creditCardNumber = $creditCardNumber;
    }

    /**
     * @return string
     */
    public function getExpiryMonth()
    {
        return $this->expiryMonth;
    }

    /**
     * @return bool|string
     */
    public function getExpiryYear()
    {
        return $this->expiryYear;
    }

    /**
     * @param string $expiryDate
     */
    public function setExpiryDate($expiryDate)
    {
        $this->expiryDate = $expiryDate;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getCvv()
    {
        return $this->cvv;
    }

    /**
     * @param string $cvv
     */
    public function setCvv($cvv)
    {
        $this->cvv = $cvv;
    }

    /**
     * @param mixed $expiryMonth
     */
    public function setExpiryMonth($expiryMonth)
    {
        $this->expiryMonth = $expiryMonth;
    }

    /**
     * @param mixed $expiryYear
     */
    public function setExpiryYear($expiryYear)
    {
        $this->expiryYear = $expiryYear;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }



}