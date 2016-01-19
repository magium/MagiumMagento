<?php

namespace Tests\Magium\MagentoEE114\Customer;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Actions\Customer\Login;
use Magium\Magento\Actions\Customer\NavigateAndLogin;
use Magium\Magento\Navigators\Customer\AccountHome;

class ToCustomerLoginTest extends \Tests\Magium\Magento\Customer\ToCustomerLoginTest
{

    public function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration('Magium\Magento\Themes\MagentoEE114\ThemeConfiguration');
    }
}