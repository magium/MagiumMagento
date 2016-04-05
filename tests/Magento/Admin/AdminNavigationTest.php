<?php

namespace Tests\Magium\Magento\Admin;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Actions\Admin\Login\Login;
use Magium\Magento\Navigators\Admin\AdminMenu;

class AdminNavigationTest extends AbstractMagentoTestCase
{

    protected $navigateTo = 'System/Configuration';
    protected $expectedTitle = 'Configuration / System / Magento Admin';

    public function testNavigateToSystemConfiguration()
    {

        $this->getAction(Login::ACTION)->login();
        $this->getNavigator(AdminMenu::NAVIGATOR)->navigateTo($this->navigateTo);
        self::assertEquals($this->expectedTitle, $this->webdriver->getTitle());
    }
}