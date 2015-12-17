<?php

namespace Tests\Magento\Customer;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Actions\Customer\Login;
use Magium\Magento\Actions\Customer\NavigateAndLogin;
use Magium\Magento\Navigators\Customer\AccountHome;

class ToCustomerLoginTest extends AbstractMagentoTestCase
{

    public function testNavigateToLogin()
    {
        $this->commandOpen($this->getTheme()->getBaseUrl());
        $this->getNavigator(AccountHome::NAVIGATOR)->navigateTo();
        $this->assertElementHasText('h1', 'Login or Create an Account');
    }
    
    public function testLoginCustomer()
    {
        $this->commandOpen($this->getTheme()->getBaseUrl());
        $this->getNavigator(AccountHome::NAVIGATOR)->navigateTo();
        $this->getAction(Login::ACTION)->login();
        self::assertEquals('My Account', $this->webdriver->getTitle());
    }
    
    public function testLoginCustomerSucceedsWhenRequireLoginIsNotSetAndAccountIsAlreadyLoggedIn()
    {
        $this->commandOpen($this->getTheme()->getBaseUrl());
        $this->getNavigator(AccountHome::NAVIGATOR)->navigateTo();
        $this->getAction(Login::ACTION)->login();

        $this->getNavigator(AccountHome::NAVIGATOR)->navigateTo();
        $this->getAction(Login::ACTION)->login();
    }

    public function testLoginCustomerFailsWhenRequireLoginIsSetAndAccountIsAlreadyLoggedIn()
    {
        $this->setExpectedException('Facebook\WebDriver\Exception\NoSuchElementException');
        $this->commandOpen($this->getTheme()->getBaseUrl());
        $this->getNavigator(AccountHome::NAVIGATOR)->navigateTo();
        $this->getAction(Login::ACTION)->login();

        $this->getNavigator(AccountHome::NAVIGATOR)->navigateTo();
        $this->getAction(Login::ACTION)->login(null, null, true);

    }

    public function testNavigateAndLogin()
    {
        $this->commandOpen($this->getTheme()->getBaseUrl());
        $this->getAction(NavigateAndLogin::ACTION)->login();

    }
}