<?php

namespace Tests\Magium\Magento18\Customer;


class NavigateToOrderTest extends \Tests\Magium\Magento\Customer\NavigateToOrderTest
{

    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration('Magium\Magento\Themes\Magento18\ThemeConfiguration');
    }

}