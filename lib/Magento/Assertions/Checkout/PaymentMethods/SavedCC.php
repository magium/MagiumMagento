<?php

namespace Magium\Magento\Assertions\Checkout\PaymentMethods;

use Magium\Assertions\AbstractAssertion;

class SavedCC extends AbstractAssertion
{

    public function assert()
    {
        $this->testCase->assertElementExists('ccsave_cc_owner');
        $this->testCase->assertElementExists('ccsave_cc_type');
        $this->testCase->assertEquals('select', strtolower($this->webDriver->byId('ccsave_cc_type')->getTagName()));
        $this->testCase->assertElementExists('ccsave_cc_number');
        $this->testCase->assertElementExists('ccsave_expiration');
        $this->testCase->assertElementExists('ccsave_expiration_yr');
    }

}