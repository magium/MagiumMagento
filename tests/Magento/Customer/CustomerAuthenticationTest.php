<?php

namespace Tests\Magium\Magento\Customer;

use Magium\Magento\AbstractMagentoTestCase;

class CustomerAuthenticationTest extends AbstractMagentoTestCase
{
    public function testGeneratedEmailAddressUsesWordCharsOnly()
    {
        $customer = $this->getIdentity();
        $emailAddress = $customer->generateUniqueEmailAddress();
        $parts = explode('@', $emailAddress);
        self::assertEquals(0, preg_match('/\W/', $parts[0]));
        self::assertEquals($emailAddress, $customer->getEmailAddress());
    }

    public function testGeneratedEmailAddressUsesSpecifiedDomain()
    {
        $customer = $this->getIdentity();
        $emailAddress = $customer->generateUniqueEmailAddress('eschrade.com');
        $parts = explode('@', $emailAddress);
        self::assertEquals('eschrade.com', $parts[1]);
        self::assertEquals($emailAddress, $customer->getEmailAddress());
    }
}