<?php

namespace Magium\Magento\Themes\MagentoEE112\Customer;


use Magium\Magento\Themes\Customer\AbstractThemeConfiguration;

class ThemeConfiguration extends AbstractThemeConfiguration
{

    public $accountNavigationXpath   = '//div[contains(concat(" ",normalize-space(@class)," ")," block-account ")]/descendant::a[.="%s"]';
    public $accountSectionHeaderXpath = '//div[contains(concat(" ",normalize-space(@class)," ")," col-main ")]/descendant::h1[.="%s"]';

    public $orderPageName     = '{{My Orders}}';

    public $viewOrderLinkXpath = '//td[.="%s"]/../td/descendant::a[.="{{View Order}}"]';

    public $orderPageTitleContainsText    = '{{Order}} #';

    /**
     * @var array Instructions in an Xpath array syntax to get to the customer registration page
     */

    public $registrationNavigationInstructions         = [
        [\Magium\WebDriver\WebDriver::INSTRUCTION_MOUSE_CLICK, '//div[@class="account-cart-wrapper"]/descendant::span[.="Account"]'],
        [\Magium\WebDriver\WebDriver::INSTRUCTION_MOUSE_CLICK, '//div[@id="header-account"]/descendant::a[@title="Register"]']
    ];

    /**
     * @var array Instructions in an Xpath array syntax to get to the customer registration page
     */

    public $logoutNavigationInstructions         = [
        [\Magium\WebDriver\WebDriver::INSTRUCTION_MOUSE_CLICK, '//div[@class="account-cart-wrapper"]/descendant::span[.="Account"]'],
        [\Magium\WebDriver\WebDriver::INSTRUCTION_MOUSE_CLICK, '//div[@id="header-account"]/descendant::a[@title="Log Out"]']
    ];

    public $registerFirstNameXpath           = '//input[@id="firstname"]';
    public $registerLastNameXpath            = '//input[@id="lastname"]';
    public $registerEmailXpath               = '//input[@id="email_address"]';
    public $registerPasswordXpath            = '//input[@id="password"]';
    public $registerConfirmPasswordXpath     = '//input[@id="confirmation"]';
    public $registerNewsletterXpath          = '//input[@id="is_subscribed"]';
    public $registerSubmitXpath              = '//button[@type="submit" and @title="Register"]';

    public $logoutSuccessXpath               = '//div[contains(concat(" ",normalize-space(@class)," ")," page-title ")]/descendant::h1[.="You are now logged out"]';

    /**
     * @var string Xpath for the customer email form element
     */

    public $loginUsernameField           = '//input[@type="text" and @id="email"]';

    /**
     * @var string Xpath for the customer password form element
     */

    public $loginPasswordField           = '//input[@type="password" and @id="pass"]';


    /**
     * @var string Xpath for the customer login "submit" button
     */

    public $loginSubmitButton            = '//button[@id="send2"]';

    public $orderShippingAddressBaseXpath = '//h2[.="{{Shipping Address}}"]/../../../descendant::address';
    public $orderBillingAddressBaseXpath = '//h2[.="{{Billing Address}}"]/../../../descendant::address';

    public $orderShippingMethod = '//h2[.="{{Shipping Method}}"]/../../descendant::div[contains(concat(" ",normalize-space(@class)," ")," box-content ")]';
    public $orderPaymentMethod = '//h2[.="{{Payment Method}}"]/../../descendant::div[contains(concat(" ",normalize-space(@class)," ")," box-content ")]';

    public $orderItemNameXpath           = '//table[@id="my-orders-table"]/tbody/tr[%d]/descendant::h3[contains(concat(" ",normalize-space(@class)," ")," product-name ")]';
    public $orderItemSkuXpath           = '//table[@id="my-orders-table"]/tbody/tr[%d]/descendant::td[2]';
    public $orderItemPriceXpath           = '//table[@id="my-orders-table"]/tbody/tr[%d]/descendant::td[3]/descendant::span[@class="price"]';
    public $orderItemQtyXpath           = '//table[@id="my-orders-table"]/tbody/tr[%d]/descendant::td[4]';

    public $orderItemQtyOrderedRegex = '/{{Ordered}}:\s+(\d+)/';
    public $orderItemQtyShippedRegex = '/{{Shipped}}:\s+(\d+)/';

    public $orderItemSubtotalXpath           = '//table[@id="my-orders-table"]/tbody/tr[%d]/descendant::td[5]/descendant::span[@class="price"]';

    public $orderSubtotalXpath             = '//table[@id="my-orders-table"]/descendant::tr[contains(concat(" ",normalize-space(@class)," ")," subtotal ")]/td[2]/span[@class="price"]';
    public $orderShippingAndHandlingXpath  = '//table[@id="my-orders-table"]/descendant::tr[contains(concat(" ",normalize-space(@class)," ")," shipping ")]/td[2]/span[@class="price"]';
    public $orderTaxXpath                 = '//table[@id="my-orders-table"]/descendant::td[concat(" ",normalize-space(.)," ") = " {{Tax}} "]/following-sibling::td[1]/span[@class="price"]';
    public $orderGrandTotalXpath         = '//table[@id="my-orders-table"]/descendant::tr[contains(concat(" ",normalize-space(@class)," ")," grand_total ")]/td[2]/descendant::span[@class="price"]';

    public $orderDateXpath               = '//p[@class="order-date"]';


    public $orderStatusXpath             = '//div[contains(concat(" ",normalize-space(@class)," ")," page-title ")]/h1[contains(., "{{Order}}")]';
    public $orderStatusRegex             = '/- (\w+)$/';

}