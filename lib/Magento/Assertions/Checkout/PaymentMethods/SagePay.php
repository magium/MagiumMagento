<?php

namespace Magium\Magento\Assertions\Checkout\PaymentMethods;

use Magium\Assertions\AbstractAssertion;

class SagePay extends AbstractAssertion
{

    public function assert()
    {
        $this->getTestCase()->assertElementExists('sagepaydirectpro_cc_owner');
        $this->getTestCase()->assertElementExists('sagepaydirectpro_cc_type');
        $this->getTestCase()->assertEquals('select', strtolower($this->webDriver->byId('sagepaydirectpro_cc_type')->getTagName()));
        $this->getTestCase()->assertElementExists('sagepaydirectpro_cc_number');
        $this->getTestCase()->assertElementExists('sagepaydirectpro_expiration');
        $this->getTestCase()->assertElementExists('sagepaydirectpro_expiration_yr');
        $this->getTestCase()->assertElementExists('sagepaydirectpro_cc_cid');
    }

}