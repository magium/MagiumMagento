<?php

namespace Tests\Magium\Magento2\Admin;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Actions\Admin\Login\Login;
use Magium\Magento\Extractors\Admin\Login\Messages;
use Magium\Magento\Themes\Magento2\ThemeConfiguration;

class ToAdminLoginTest extends \Tests\Magium\Magento\Admin\ToAdminLoginTest
{

    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration(ThemeConfiguration::THEME);
    }


}