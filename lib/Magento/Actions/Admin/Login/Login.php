<?php

namespace Magium\Magento\Actions\Admin\Login;

use Magium\Commands\Open;
use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Extractors\Admin\Login\Messages;
use Magium\Magento\Identities\Admin;
use Magium\Magento\Themes\Admin\ThemeConfiguration;
use Magium\Navigators\InstructionNavigator;
use Magium\WebDriver\ExpectedCondition;
use Magium\WebDriver\WebDriver;

class Login
{

    const ACTION = 'Admin\Login\Login';
    
    protected $theme;
    protected $adminIdentity;
    protected $webdriver;
    protected $testCase;
    protected $openCommand;
    protected $messages;
    
    public function __construct(
        ThemeConfiguration $theme,
        Admin      $adminIdentity,
        InstructionNavigator    $instructionsNavigator,
        WebDriver               $webdriver,
        AbstractMagentoTestCase        $testCase,
        Open                    $open,
        Messages                $messages
    ) {
        $this->theme         = $theme;
        $this->adminIdentity = $adminIdentity;
        $this->webdriver     = $webdriver;
        $this->testCase      = $testCase;
        $this->openCommand   = $open;
        $this->messages      = $messages;
    }
    
    public function login($username = null, $password = null)
    {
        // We break SOLID here there might be scenarios where multiple logins are required.  So for expediency's sake
        // We're having the login action take responsibility for figuring out how to get to the login screen.

        $url = $this->webdriver->getCurrentURL();
        if (strpos($url, 'http') === false) {
            $this->openCommand->open($this->theme->getBaseUrl());
        } else {
            $this->webdriver->navigate()->to($this->theme->getBaseUrl());
            $title = $this->webdriver->getTitle();
            if (strpos($title, $this->testCase->getTranslator()->translate('Dashboard')) !== false) {
                return;
            }
        }

        $usernameElement = $this->webdriver->byXpath($this->theme->getLoginUsernameField());
        $passwordElement = $this->webdriver->byXpath($this->theme->getLoginPasswordField());
        $submitElement   = $this->webdriver->byXpath($this->theme->getLoginSubmitButton());

        $this->testCase->assertWebDriverElement($usernameElement);
        $this->testCase->assertWebDriverElement($passwordElement);
        $this->testCase->assertWebDriverElement($submitElement);

        if ($username === null) {
            $username = $this->adminIdentity->getAccount();
        }
        
        if ($password === null) {
            $password = $this->adminIdentity->getPassword();
        }

        $usernameElement->clear();
        $passwordElement->clear();

        $usernameElement->sendKeys($username);
        $passwordElement->sendKeys($password);
        
        $submitElement->click();
        $this->webdriver->wait(10)->until(ExpectedCondition::titleContains($this->testCase->getTranslator()->translate('Dashboard')));

        $this->messages->extract();

    }

}