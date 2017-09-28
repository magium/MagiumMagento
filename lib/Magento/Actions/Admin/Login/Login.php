<?php

namespace Magium\Magento\Actions\Admin\Login;

use Magium\Actions\StaticActionInterface;
use Magium\Commands\Open;
use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Extractors\Admin\Login\Messages;
use Magium\Magento\Identities\Admin;
use Magium\Magento\Themes\Admin\ThemeConfiguration;
use Magium\Navigators\InstructionNavigator;
use Magium\WebDriver\ExpectedCondition;
use Magium\WebDriver\WebDriver;

class Login implements StaticActionInterface 
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
        // we're having the login action take responsibility for figuring out how to get to the login screen.

        $url = $this->webdriver->getCurrentURL();
        $adminUrl = $this->theme->getBaseUrl();

        $defaultAdminTitle = $this->theme->getDefaultAdminTitle();
        if (strpos($adminUrl, $url) === 0) {
            $this->webdriver->navigate()->to($this->theme->getBaseUrl());
            $title = $this->webdriver->getTitle();
            if (strpos($title, $defaultAdminTitle) !== false) {
                return;
            }
        } else {
            $this->openCommand->open($adminUrl);
            $title = $this->webdriver->getTitle();
            if (strpos($title, $defaultAdminTitle) !== false) {
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
        $this->webdriver->wait()->until(ExpectedCondition::titleContains($defaultAdminTitle));

        $this->messages->extract();

    }

    public function execute()
    {
        return $this->login();
    }

}
