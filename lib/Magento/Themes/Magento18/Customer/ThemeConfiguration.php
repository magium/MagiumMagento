<?php

namespace Magium\Magento\Themes\Magento18\Customer;


use Magium\Magento\Themes\Customer\AbstractThemeConfiguration;

class ThemeConfiguration extends AbstractThemeConfiguration
{

    protected $accountNavigationXpath   = '//div[contains(concat(" ",normalize-space(@class)," ")," block-account ")]/descendant::a[.="%s"]';
    protected $accountSectionHeaderXpath = '//div[contains(concat(" ",normalize-space(@class)," ")," col-main ")]/descendant::h1[.="%s"]';

    protected $orderPageName     = '{{My Orders}}';

    protected $viewOrderLinkXpath = '//td[@class="number" and .="%s"]/../td/descendant::a[.="{{View Order}}"]';

    protected $orderPageTitleContainsText    = '{{Order}} #';

    /**
     * @var array Instructions in an Xpath array syntax to get to the customer registration page
     */

    protected $registrationNavigationInstructions         = [
        [\Magium\WebDriver\WebDriver::INSTRUCTION_MOUSE_CLICK, '//div[@class="account-cart-wrapper"]/descendant::span[.="Account"]'],
        [\Magium\WebDriver\WebDriver::INSTRUCTION_MOUSE_CLICK, '//div[@id="header-account"]/descendant::a[@title="Register"]']
    ];

    /**
     * @var array Instructions in an Xpath array syntax to get to the customer registration page
     */

    protected $logoutNavigationInstructions         = [
        [\Magium\WebDriver\WebDriver::INSTRUCTION_MOUSE_CLICK, '//div[@class="account-cart-wrapper"]/descendant::span[.="Account"]'],
        [\Magium\WebDriver\WebDriver::INSTRUCTION_MOUSE_CLICK, '//div[@id="header-account"]/descendant::a[@title="Log Out"]']
    ];

    protected $registerFirstNameXpath           = '//input[@id="firstname"]';
    protected $registerLastNameXpath            = '//input[@id="lastname"]';
    protected $registerEmailXpath               = '//input[@id="email_address"]';
    protected $registerPasswordXpath            = '//input[@id="password"]';
    protected $registerConfirmPasswordXpath     = '//input[@id="confirmation"]';
    protected $registerNewsletterXpath          = '//input[@id="is_subscribed"]';
    protected $registerSubmitXpath              = '//button[@type="submit" and @title="Register"]';

    protected $logoutSuccessXpath               = '//div[contains(concat(" ",normalize-space(@class)," ")," page-title ")]/descendant::h1[.="You are now logged out"]';

    /**
     * @var string Xpath for the customer email form element
     */

    protected $loginUsernameField           = '//input[@type="text" and @id="email"]';

    /**
     * @var string Xpath for the customer password form element
     */

    protected $loginPasswordField           = '//input[@type="password" and @id="pass"]';


    /**
     * @var string Xpath for the customer login "submit" button
     */

    protected $loginSubmitButton            = '//button[@id="send2"]';


}