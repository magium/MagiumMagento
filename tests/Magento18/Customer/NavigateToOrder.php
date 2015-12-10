<?php

namespace Tests\Magento18\Customer;


class NavigateToOrder extends \Tests\Magento\Customer\NavigateToOrder
{

    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration('Magium\Magento\Themes\Magento18\ThemeConfiguration');
    }

}