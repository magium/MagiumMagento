<?php

namespace Tests\Magium\MagentoEE113\Assertion;



use Magium\Magento\Themes\MagentoEE113\ThemeConfiguration;

class IsBelowTest extends \Tests\Magium\Magento\Assertion\IsBelowTest
{
    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration(ThemeConfiguration::THEME);
    }

}