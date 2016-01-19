<?php

namespace Tests\Magium\MagentoEE114\Customer;


class CustomerAuthenticationTest extends \Tests\Magium\Magento\Customer\CustomerAuthenticationTest
{

    public function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration('Magium\Magento\Themes\MagentoEE114\ThemeConfiguration');
    }
}