<?php

namespace Tests\Magium\Magento18\Customer;

class CustomerAuthenticationTest extends \Tests\Magium\Magento\Customer\CustomerAuthenticationTest
{
    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration('Magium\Magento\Themes\Magento18\ThemeConfiguration');
    }
}