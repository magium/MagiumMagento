<?php

namespace Tests\Magium\Magento18\Action;

use Magium\Magento\Themes\Magento18\ThemeConfiguration;

class SendContactFormTest extends \Tests\Magium\Magento\Action\SendContactFormTest
{

    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration(ThemeConfiguration::THEME);
    }

}