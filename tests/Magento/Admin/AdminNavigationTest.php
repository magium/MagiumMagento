<?php

namespace Tests\Magento\Admin;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Actions\Admin\Login\Login;
use Magium\Magento\Navigators\Admin\AdminMenu;

class AdminNavigationTest extends AbstractMagentoTestCase
{

    public function testNavigateToSystemConfiguration()
    {

        $this->getAction(Login::ACTION)->login();
        $this->getNavigator(AdminMenu::NAVIGATOR)->navigateTo('System/Configuration');
        self::assertEquals('Configuration / System / Magento Admin', $this->webdriver->getTitle());
    }
}