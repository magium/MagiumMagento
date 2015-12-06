<?php

namespace Tests\Magento\Admin;

use Magium\Magento\AbstractMagentoTestCase;

class AdminNavigationTest extends AbstractMagentoTestCase
{

    public function testNavigateToSystemConfiguration()
    {

        $this->getAction('Admin\Login\Login')->login();
        $this->getNavigator('Admin\AdminMenuNavigator')->navigateTo('System/Configuration');
        self::assertEquals('Configuration / System / Magento Admin', $this->webdriver->getTitle());
    }
}