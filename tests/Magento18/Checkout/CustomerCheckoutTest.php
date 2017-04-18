<?php

namespace Tests\Magium\Magento18\Checkout;


class CustomerCheckoutTest extends \Tests\Magium\Magento\Checkout\CustomerCheckoutTest
{

    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration('Magium\Magento\Themes\Magento18\ThemeConfiguration');
    }

    public function testCheckoutwithDifferentBillingAddress()
    {
        return parent::testCheckoutwithDifferentBillingAddress();
    }

}
