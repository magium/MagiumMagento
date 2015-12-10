<?php

namespace Tests\Magento18\Assertion;



class IsBelowTest extends \Tests\Magento\Assertion\IsBelowTest
{
    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration('Magium\Magento\Themes\Magento18\ThemeConfiguration');
    }

}