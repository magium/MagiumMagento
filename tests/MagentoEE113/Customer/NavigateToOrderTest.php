<?php

namespace Tests\Magium\MagentoEE113\Customer;


class NavigateToOrderTest extends \Tests\Magium\Magento\Customer\NavigateToOrderTest
{

    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration('Magium\Magento\Themes\MagentoEE113\ThemeConfiguration');
    }

}