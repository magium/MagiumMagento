<?php

namespace Tests\Magium\Magento\Customer;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Actions\Customer\Logout;
use Magium\Magento\Actions\Customer\Register;

class RegisterCustomerTest extends AbstractMagentoTestCase
{

    public function testNavigateToLogin()
    {
        $this->commandOpen($this->getTheme()->getBaseUrl());

        $this->getIdentity()->generateUniqueEmailAddress();

        // Yes, yes.   I know I'm technically testing two bits of functionality here.
        $this->getAction(Register::ACTION)->register();
        $this->getAction(Logout::ACTION)->logout();
    }
    

}