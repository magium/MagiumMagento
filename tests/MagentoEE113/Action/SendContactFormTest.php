<?php

namespace Tests\Magium\MagentoEE113\Action;

use Magium\Magento\Themes\MagentoEE113\ThemeConfiguration;

class SendContactFormTest extends \Tests\Magium\Magento\Action\SendContactFormTest
{

    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration(ThemeConfiguration::THEME);
    }

}