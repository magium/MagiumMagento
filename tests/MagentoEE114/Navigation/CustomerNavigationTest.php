<?php

namespace Tests\Magium\MagentoEE114\Navigation;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Actions\Customer\NavigateAndLogin;
use Magium\Magento\Navigators\Customer\Account;
use Magium\WebDriver\WebDriver;

class CustomerNavigationTest extends \Tests\Magium\Magento\Navigation\CustomerNavigationTest
{
    public function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration('Magium\Magento\Themes\MagentoEE114\ThemeConfiguration');
    }

}