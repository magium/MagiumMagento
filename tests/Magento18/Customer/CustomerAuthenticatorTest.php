<?php

namespace Tests\Magento18\Customer;

class CustomerAuthenticationTest extends \Tests\Magento\Customer\CustomerAuthenticationTest
{
    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration('Magium\Magento\Themes\Magento18\ThemeConfiguration');
    }
}