<?php

namespace Magium\Magento\Themes\Magento19\Customer;

use Magium\Magento\Themes\Customer\AbstractThemeConfiguration;

class ThemeConfiguration extends AbstractThemeConfiguration
{

    protected $accountNavigationXpath   = '//div[contains(concat(" ",normalize-space(@class)," ")," block-account ")]/descendant::a[.="%s"]';
    protected $accountSectionHeaderXpath = '//div[contains(concat(" ",normalize-space(@class)," ")," col-main ")]/descendant::h1[.="%s"]';

    protected $orderPageName     = '{{My Orders}}';

    protected $viewOrderLinkXpath = '//td[@class="number" and .="%s"]/../td/descendant::a[.="{{View Order}}"]';

    protected $orderPageTitleContainsText    = '{{Order}} #';

    /**
     * @var string Xpath for the customer email form element
     */

    protected $loginUsernameField           = '//input[@type="email" and @id="email"]';

    /**
     * @var string Xpath for the customer password form element
     */

    protected $loginPasswordField           = '//input[@type="password" and @id="pass"]';


    /**
     * @var string Xpath for the customer login "submit" button
     */

    protected $loginSubmitButton            = '//button[@id="send2"]';


}