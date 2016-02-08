<?php

namespace Magium\Magento\Themes\MagentoEE114\Customer;

use Magium\Magento\Themes\Customer\AbstractThemeConfiguration;

class ThemeConfiguration extends AbstractThemeConfiguration
{

    public $accountNavigationXpath   = '//div[contains(concat(" ",normalize-space(@class)," ")," block-account ")]/descendant::a[.="%s"]';
    public $accountSectionHeaderXpath = '//div[contains(concat(" ",normalize-space(@class)," ")," col-main ")]/descendant::h1[.="%s"]';

    public $orderPageName     = '{{My Orders}}';

    public $viewOrderLinkXpath = '//td[@class="number" and .="%s"]/../td/descendant::a[.="{{View Order}}"]';

    public $orderPageTitleContainsText    = '{{Order}} #';

    /**
     * @var string Xpath for the customer email form element
     */

    public $loginUsernameField           = '//input[@type="email" and @id="email"]';

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
    public $orderItemSkuXpath           = '//table[@id="my-orders-table"]/tbody/tr[%d]/descendant::td[@data-rwd-label="SKU"]';
    public $orderItemPriceXpath           = '//table[@id="my-orders-table"]/tbody/tr[%d]/descendant::td[@data-rwd-label="Price"]/descendant::span[@class="price"]';
    public $orderItemQtyXpath           = '//table[@id="my-orders-table"]/tbody/tr[%d]/descendant::td[@data-rwd-label="Qty"]';

    public $orderItemQtyOrderedRegex = '/{{Ordered}}:\s+(\d+)/';
    public $orderItemQtyShippedRegex = '/{{Shipped}}:\s+(\d+)/';

    public $orderItemSubtotalXpath           = '//table[@id="my-orders-table"]/tbody/tr[%d]/descendant::td[@data-rwd-label="Subtotal"]/descendant::span[@class="price"]';

    public $orderSubtotalXpath             = '//table[@id="my-orders-table"]/descendant::tr[contains(concat(" ",normalize-space(@class)," ")," subtotal ")]/td[2]/span[@class="price"]';
    public $orderShippingAndHandlingXpath  = '//table[@id="my-orders-table"]/descendant::tr[contains(concat(" ",normalize-space(@class)," ")," shipping ")]/td[2]/span[@class="price"]';
    public $orderTaxXpath                 = '//table[@id="my-orders-table"]/descendant::td[concat(" ",normalize-space(.)," ") = " {{Tax}} "]/following-sibling::td[1]/span[@class="price"]';
    public $orderGrandTotalXpath         = '//table[@id="my-orders-table"]/descendant::tr[contains(concat(" ",normalize-space(@class)," ")," grand_total ")]/td[2]/descendant::span[@class="price"]';

    public $orderDateXpath               = '//p[@class="order-date"]';


    public $orderStatusXpath             = '//div[contains(concat(" ",normalize-space(@class)," ")," page-title ")]/h1[contains(., "{{Order}}")]';
    public $orderStatusRegex             = '/- (\w+)$/';



}