<?php

namespace Magium\Magento\Assertions\Checkout\PaymentMethods;

use Magium\Assertions\AbstractAssertion;

class SavedCC extends AbstractAssertion
{

    public function assert()
    {
        $this->getTestCase()->assertElementExists('ccsave_cc_owner');
        $this->getTestCase()->assertElementExists('ccsave_cc_type');
        $this->getTestCase()->assertEquals('select', strtolower($this->webDriver->byId('ccsave_cc_type')->getTagName()));
        $this->getTestCase()->assertElementExists('ccsave_cc_number');
        $this->getTestCase()->assertElementExists('ccsave_expiration');
        $this->getTestCase()->assertElementExists('ccsave_expiration_yr');
    }

}