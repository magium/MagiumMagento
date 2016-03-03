<?php

namespace Tests\Magium\MagentoEE114\Action;

use Magium\Magento\Themes\MagentoEE114\ThemeConfiguration;

class SendContactFormTest extends \Tests\Magium\Magento\Action\SendContactFormTest
{

    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration(ThemeConfiguration::THEME);
    }

}