<?php

namespace Tests\Magium\MagentoEE114\Customer;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Actions\Customer\Logout;
use Magium\Magento\Actions\Customer\Register;

class RegisterCustomerTest extends \Tests\Magium\Magento\Customer\RegisterCustomerTest
{


    public function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration('Magium\Magento\Themes\MagentoEE114\ThemeConfiguration');
    }
    

}