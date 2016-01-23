<?php

namespace Tests\Magium\Magento2\Customer;


use Magium\Magento\Themes\Magento2\ThemeConfiguration;

class NavigateToOrderTest extends \Tests\Magium\Magento\Customer\NavigateToOrderTest
{

    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration(ThemeConfiguration::THEME);
    }

}