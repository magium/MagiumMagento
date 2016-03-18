<?php

namespace Magium\Magento\Identities;

use Magium\Identities\AddressInterface;
use Magium\Identities\EmailInterface;
use Magium\Identities\NameInterface;
use Magium\Util\EmailGenerator\Generator;
use Magium\Util\EmailGenerator\GeneratorAware;

class Customer extends AbstractEntity implements GeneratorAware, NameInterface, EmailInterface, AddressInterface
{
    const IDENTITY = 'Customer';

    public $emailAddress          = 'test@example.com';

    public $billingFirstName        = 'Kevin';
    public $billingLastName         = 'Schroeder';
    public $billingCompany          = '';
    public $billingAddress          = '10451 Jefferson Blvd';
    public $billingAddress2         = '';
    public $billingCity             = 'Culver City';
    public $billingRegionId         = 'California';
    public $billingPostCode         = '90232';
    public $billingCountryId        = 'US';
    public $billingTelephone        = '123-123-1234';
    public $billingFax              = '';

    public $shippingFirstName        = 'Kevin';
    public $shippingLastName         = 'Schroeder';
    public $shippingCompany          = '';
    public $shippingAddress          = '10451 Jefferson Blvd';
    public $shippingAddress2         = '';
    public $shippingCity             = 'Culver City';
    public $shippingRegionId         = 'California';
    public $shippingPostCode         = '90232';
    public $shippingCountryId        = 'US';
    public $shippingTelephone        = '123-123-1234';
    public $shippingFax              = '';

    protected $uniqueEmailAddressGenerated = false;
    protected $generator;

    public function setGenerator(Generator $generator)
    {
        $this->generator = $generator;
    }

    public function getCompany()
    {
        return $this->getBillingCompany();
    }

    public function getAddress()
    {
        return $this->getBillingAddress();
    }

    public function getAddress2()
    {
        return $this->getBillingAddress2();
    }

    public function getCity()
    {
        return $this->getBillingCity();
    }

    public function getRegionId()
    {
        return $this->getBillingRegionId();
    }

    public function getPostCode()
    {
        return $this->getBillingPostCode();
    }

    public function getCountryId()
    {
        return $this->getBillingCountryId();
    }

    public function setCompany($value)
    {
        $this->setBillingCompany($value);
    }

    public function setAddress($value)
    {
        $this->setBillingAddress($value);
    }

    public function setAddress2($value)
    {
        $this->setBillingAddress2($value);
    }

    public function setCity($value)
    {
        $this->setBillingCity($value);
    }

    public function setRegionId($value)
    {
        $this->setBillingRegionId($value);
    }

    public function setPostCode($value)
    {
        $this->setBillingPostCode($value);
    }

    public function setCountryId($value)
    {
        $this->setBillingCountryId($value);
    }

    public function getFirstName()
    {
        return $this->getBillingFirstName();
    }

    public function getLastName()
    {
        return $this->getBillingLastName();
    }

    public function setFirstName($value)
    {
        $this->setBillingFirstName($value);
    }

    public function setLastName($value)
    {
        $this->setBillingLastName($value);
    }


    public function generateUniqueEmailAddress($domain = 'example.com')
    {
        if ($this->generator instanceof NameInterface) {
            $this->generator->setFirstName($this->getFirstName());
            $this->generator->setLastName($this->getLastName());
        }
        if ($this->generator instanceof EmailInterface) {
            $this->generator->setEmailAddress($this->getEmailAddress());
        }
        $this->uniqueEmailAddressGenerated = true;
        $this->emailAddress = $this->generator->generate($domain);
        return $this->emailAddress;
    }

    /**
     * @return boolean
     */
    public function isUniqueEmailAddressGenerated()
    {
        return $this->uniqueEmailAddressGenerated;
    }

    /**
     * @param boolean $uniqueEmailAddressGenerated
     */
    public function setUniqueEmailAddressGenerated($uniqueEmailAddressGenerated)
    {
        $this->uniqueEmailAddressGenerated = $uniqueEmailAddressGenerated;
    }

    /**
     * @return string
     */
    public function getBillingFirstName()
    {
        return $this->billingFirstName;
    }

    /**
     * @param string $billingFirstName
     */
    public function setBillingFirstName($billingFirstName)
    {
        $this->billingFirstName = $billingFirstName;
    }

    /**
     * @return string
     */
    public function getBillingLastName()
    {
        return $this->billingLastName;
    }

    /**
     * @param string $billingLastName
     */
    public function setBillingLastName($billingLastName)
    {
        $this->billingLastName = $billingLastName;
    }

    /**
     * @return string
     */
    public function getBillingCompany()
    {
        return $this->billingCompany;
    }

    /**
     * @param string $billingCompany
     */
    public function setBillingCompany($billingCompany)
    {
        $this->billingCompany = $billingCompany;
    }

    /**
     * @return string
     */
    public function getEmailAddress()
    {
        return $this->emailAddress;
    }

    /**
     * @param string $emailAddress
     */
    public function setEmailAddress($emailAddress)
    {
        $this->emailAddress = $emailAddress;
    }



    /**
     * @return string
     */
    public function getBillingAddress()
    {
        return $this->billingAddress;
    }

    /**
     * @param string $billingAddress
     */
    public function setBillingAddress($billingAddress)
    {
        $this->billingAddress = $billingAddress;
    }

    /**
     * @return string
     */
    public function getBillingAddress2()
    {
        return $this->billingAddress2;
    }

    /**
     * @param string $billingAddress2
     */
    public function setBillingAddress2($billingAddress2)
    {
        $this->billingAddress2 = $billingAddress2;
    }

    /**
     * @return string
     */
    public function getBillingCity()
    {
        return $this->billingCity;
    }

    /**
     * @param string $billingCity
     */
    public function setBillingCity($billingCity)
    {
        $this->billingCity = $billingCity;
    }

    /**
     * @return string
     */
    public function getBillingRegionId()
    {
        return $this->billingRegionId;
    }

    /**
     * @param string $billingRegionId
     */
    public function setBillingRegionId($billingRegionId)
    {
        $this->billingRegionId = $billingRegionId;
    }

    /**
     * @return string
     */
    public function getBillingPostCode()
    {
        return $this->billingPostCode;
    }

    /**
     * @param string $billingPostCode
     */
    public function setBillingPostCode($billingPostCode)
    {
        $this->billingPostCode = $billingPostCode;
    }

    /**
     * @return string
     */
    public function getBillingCountryId()
    {
        return $this->billingCountryId;
    }

    /**
     * @param string $billingCountryId
     */
    public function setBillingCountryId($billingCountryId)
    {
        $this->billingCountryId = $billingCountryId;
    }

    /**
     * @return string
     */
    public function getBillingTelephone()
    {
        return $this->billingTelephone;
    }

    /**
     * @param string $billingTelephone
     */
    public function setBillingTelephone($billingTelephone)
    {
        $this->billingTelephone = $billingTelephone;
    }

    /**
     * @return string
     */
    public function getBillingFax()
    {
        return $this->billingFax;
    }

    /**
     * @param string $billingFax
     */
    public function setBillingFax($billingFax)
    {
        $this->billingFax = $billingFax;
    }

    /**
     * @return string
     */
    public function getShippingFirstName()
    {
        return $this->shippingFirstName;
    }

    /**
     * @param string $shippingFirstName
     */
    public function setShippingFirstName($shippingFirstName)
    {
        $this->shippingFirstName = $shippingFirstName;
    }

    /**
     * @return string
     */
    public function getShippingLastName()
    {
        return $this->shippingLastName;
    }

    /**
     * @param string $shippingLastName
     */
    public function setShippingLastName($shippingLastName)
    {
        $this->shippingLastName = $shippingLastName;
    }

    /**
     * @return string
     */
    public function getShippingCompany()
    {
        return $this->shippingCompany;
    }

    /**
     * @param string $shippingCompany
     */
    public function setShippingCompany($shippingCompany)
    {
        $this->shippingCompany = $shippingCompany;
    }


    /**
     * @return string
     */
    public function getShippingAddress()
    {
        return $this->shippingAddress;
    }

    /**
     * @param string $shippingAddress
     */
    public function setShippingAddress($shippingAddress)
    {
        $this->shippingAddress = $shippingAddress;
    }

    /**
     * @return string
     */
    public function getShippingAddress2()
    {
        return $this->shippingAddress2;
    }

    /**
     * @param string $shippingAddress2
     */
    public function setShippingAddress2($shippingAddress2)
    {
        $this->shippingAddress2 = $shippingAddress2;
    }

    /**
     * @return string
     */
    public function getShippingCity()
    {
        return $this->shippingCity;
    }

    /**
     * @param string $shippingCity
     */
    public function setShippingCity($shippingCity)
    {
        $this->shippingCity = $shippingCity;
    }

    /**
     * @return string
     */
    public function getShippingRegionId()
    {
        return $this->shippingRegionId;
    }

    /**
     * @param string $shippingRegionId
     */
    public function setShippingRegionId($shippingRegionId)
    {
        $this->shippingRegionId = $shippingRegionId;
    }

    /**
     * @return string
     */
    public function getShippingPostCode()
    {
        return $this->shippingPostCode;
    }

    /**
     * @param string $shippingPostCode
     */
    public function setShippingPostCode($shippingPostCode)
    {
        $this->shippingPostCode = $shippingPostCode;
    }

    /**
     * @return string
     */
    public function getShippingCountryId()
    {
        return $this->shippingCountryId;
    }

    /**
     * @param string $shippingCountryId
     */
    public function setShippingCountryId($shippingCountryId)
    {
        $this->shippingCountryId = $shippingCountryId;
    }

    /**
     * @return string
     */
    public function getShippingTelephone()
    {
        return $this->shippingTelephone;
    }

    /**
     * @param string $shippingTelephone
     */
    public function setShippingTelephone($shippingTelephone)
    {
        $this->shippingTelephone = $shippingTelephone;
    }

    /**
     * @return string
     */
    public function getShippingFax()
    {
        return $this->shippingFax;
    }

    /**
     * @param string $shippingFax
     */
    public function setShippingFax($shippingFax)
    {
        $this->shippingFax = $shippingFax;
    }



}