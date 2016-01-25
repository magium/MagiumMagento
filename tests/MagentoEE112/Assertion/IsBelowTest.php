<?php

namespace Tests\Magium\MagentoEE12\Assertion;



use Magium\Magento\Themes\MagentoEE112\ThemeConfiguration;

class IsBelowTest extends \Tests\Magium\Magento\Assertion\IsBelowTest
{
    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration(ThemeConfiguration::THEME);
    }

}