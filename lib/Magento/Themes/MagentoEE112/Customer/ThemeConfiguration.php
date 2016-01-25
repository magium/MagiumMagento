<?php

namespace Magium\Magento\Themes\MagentoEE112\Customer;


use Magium\Magento\Themes\Customer\AbstractThemeConfiguration;

class ThemeConfiguration extends AbstractThemeConfiguration
{

    protected $accountNavigationXpath   = '//div[contains(concat(" ",normalize-space(@class)," ")," block-account ")]/descendant::a[.="%s"]';
    protected $accountSectionHeaderXpath = '//div[contains(concat(" ",normalize-space(@class)," ")," col-main ")]/descendant::h1[.="%s"]';

    protected $orderPageName     = '{{My Orders}}';

    protected $viewOrderLinkXpath = '//td[.="%s"]/../td/descendant::a[.="{{View Order}}"]';

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

    protected $orderShippingAddressBaseXpath = '//h2[.="{{Shipping Address}}"]/../../../descendant::address';
    protected $orderBillingAddressBaseXpath = '//h2[.="{{Billing Address}}"]/../../../descendant::address';

    protected $orderShippingMethod = '//h2[.="{{Shipping Method}}"]/../../descendant::div[contains(concat(" ",normalize-space(@class)," ")," box-content ")]';
    protected $orderPaymentMethod = '//h2[.="{{Payment Method}}"]/../../descendant::div[contains(concat(" ",normalize-space(@class)," ")," box-content ")]';

    protected $orderItemNameXpath           = '//table[@id="my-orders-table"]/tbody/tr[%d]/descendant::h3[contains(concat(" ",normalize-space(@class)," ")," product-name ")]';
    protected $orderItemSkuXpath           = '//table[@id="my-orders-table"]/tbody/tr[%d]/descendant::td[2]';
    protected $orderItemPriceXpath           = '//table[@id="my-orders-table"]/tbody/tr[%d]/descendant::td[3]/descendant::span[@class="price"]';
    protected $orderItemQtyXpath           = '//table[@id="my-orders-table"]/tbody/tr[%d]/descendant::td[4]';

    protected $orderItemQtyOrderedRegex = '/{{Ordered}}:\s+(\d+)/';
    protected $orderItemQtyShippedRegex = '/{{Shipped}}:\s+(\d+)/';

    protected $orderItemSubtotalXpath           = '//table[@id="my-orders-table"]/tbody/tr[%d]/descendant::td[5]/descendant::span[@class="price"]';

    protected $orderSubtotalXpath             = '//table[@id="my-orders-table"]/descendant::tr[contains(concat(" ",normalize-space(@class)," ")," subtotal ")]/td[2]/span[@class="price"]';
    protected $orderShippingAndHandlingXpath  = '//table[@id="my-orders-table"]/descendant::tr[contains(concat(" ",normalize-space(@class)," ")," shipping ")]/td[2]/span[@class="price"]';
    protected $orderTaxXpath                 = '//table[@id="my-orders-table"]/descendant::td[concat(" ",normalize-space(.)," ") = " {{Tax}} "]/following-sibling::td[1]/span[@class="price"]';
    protected $orderGrandTotalXpath         = '//table[@id="my-orders-table"]/descendant::tr[contains(concat(" ",normalize-space(@class)," ")," grand_total ")]/td[2]/descendant::span[@class="price"]';

    protected $orderDateXpath               = '//p[@class="order-date"]';


    protected $orderStatusXpath             = '//div[contains(concat(" ",normalize-space(@class)," ")," page-title ")]/h1[contains(., "{{Order}}")]';
    protected $orderStatusRegex             = '/- (\w+)$/';

}