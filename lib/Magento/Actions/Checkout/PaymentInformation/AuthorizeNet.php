<?php

namespace Magium\Magento\Actions\Checkout\PaymentInformation;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Actions\Checkout\PaymentInformation;

class AuthorizeNet extends PaymentInformation
{
    const ACTION = 'Checkout\PaymentInformation\AuthorizeNet';

    const TYPE_UNKNOWN = 'UNKNOWN';
    const TYPE_VISA = 'VI';
    const TYPE_AMERICAN_EXPRESS = 'AE';
    const TYPE_DISCOVER = 'DI';
    const TYPE_MASTERCARD = 'MC';

    protected $ccNums = [
        self::TYPE_VISA                => '4007000000027',
        self::TYPE_AMERICAN_EXPRESS    => '370000000000002',
        self::TYPE_DISCOVER            => '6011000000000012',
 	    self::TYPE_MASTERCARD          => '5424000000000015',
        self::TYPE_UNKNOWN             => '0000000000000000'
    ];

    protected function setDefaults()
    {
        parent::setDefaults();
        $defaultCC = current($this->ccNums);
        $defaultType = key($this->ccNums);
        $this->setCreditCardNumber($defaultCC);
        $this->setType($defaultType);
    }

    protected function configureType($type)
    {
        if (!isset($this->ccNums[$type])) {
            throw new InvalidPaymentInformationException('Unknown payment type: ' . $type);
        }
        $this->setCreditCardNumber($this->ccNums[$type]);
        $this->setType($type);
    }

    public function configureTest(AbstractMagentoTestCase $testCase)
    {
        $testCase->setPaymentMethod('AuthorizeNet');
        $testCase->setTypePreference('Magium\Magento\Actions\Checkout\PaymentInformation', get_class($this));
    }

    public function setUseVisa()
    {
        $this->configureType(self::TYPE_VISA);
    }

    public function setUseAmericanExpress()
    {
        $this->configureType(self::TYPE_AMERICAN_EXPRESS);
    }

    public function setUseDiscover()
    {
        $this->configureType(self::TYPE_DISCOVER);
    }

    public function setUseMastercard()
    {
        $this->configureType(self::TYPE_MASTERCARD);
    }

}