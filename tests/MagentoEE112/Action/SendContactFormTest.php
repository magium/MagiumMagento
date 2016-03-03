<?php

namespace Tests\Magium\MagentoEE112\Action;

use Magium\Magento\Themes\MagentoEE112\ThemeConfiguration;

class SendContactFormTest extends \Tests\Magium\Magento\Action\SendContactFormTest
{

    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration(ThemeConfiguration::THEME);
    }

}