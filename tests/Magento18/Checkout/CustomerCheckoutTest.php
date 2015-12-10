<?php

namespace Tests\Magento18\Checkout;


class CustomerCheckoutTest extends \Tests\Magento\Checkout\CustomerCheckoutTest
{

    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration('Magium\Magento\Themes\Magento18\ThemeConfiguration');
    }

}