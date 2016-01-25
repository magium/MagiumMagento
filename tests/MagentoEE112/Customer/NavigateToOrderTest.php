<?php

namespace Tests\Magium\MagentoEE112\Customer;


use Magium\Magento\Themes\MagentoEE112\ThemeConfiguration;

class NavigateToOrderTest extends \Tests\Magium\Magento\Customer\NavigateToOrderTest
{

    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration(ThemeConfiguration::THEME);
    }

}