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

    protected $orderShippingAddressBaseXpath = '//h2[.="{{Shipping Address}}"]/../../../descendant::address';
    protected $orderBillingAddressBaseXpath = '//h2[.="{{Billing Address}}"]/../../../descendant::address';

    protected $orderShippingMethod = '//h2[.="{{Shipping Method}}"]/../../descendant::div[contains(concat(" ",normalize-space(@class)," ")," box-content ")]';
    protected $orderPaymentMethod = '//h2[.="{{Payment Method}}"]/../../descendant::div[contains(concat(" ",normalize-space(@class)," ")," box-content ")]';

    protected $orderItemNameXpath           = '//table[@id="my-orders-table"]/tbody/tr[%d]/descendant::h3[contains(concat(" ",normalize-space(@class)," ")," product-name ")]';
    protected $orderItemSkuXpath           = '//table[@id="my-orders-table"]/tbody/tr[%d]/descendant::td[@data-rwd-label="SKU"]';
    protected $orderItemPriceXpath           = '//table[@id="my-orders-table"]/tbody/tr[%d]/descendant::td[@data-rwd-label="Price"]/descendant::span[@class="price"]';
    protected $orderItemQtyXpath           = '//table[@id="my-orders-table"]/tbody/tr[%d]/descendant::td[@data-rwd-label="Qty"]';

    protected $orderItemQtyOrderedRegex = '/{{Ordered}}:\s+(\d+)/';
    protected $orderItemQtyShippedRegex = '/{{Shipped}}:\s+(\d+)/';

    protected $orderItemSubtotalXpath           = '//table[@id="my-orders-table"]/tbody/tr[%d]/descendant::td[@data-rwd-label="Subtotal"]/descendant::span[@class="price"]';

    protected $orderSubtotalXpath             = '//table[@id="my-orders-table"]/descendant::tr[contains(concat(" ",normalize-space(@class)," ")," subtotal ")]/td[2]/span[@class="price"]';
    protected $orderShippingAndHandlingXpath  = '//table[@id="my-orders-table"]/descendant::tr[contains(concat(" ",normalize-space(@class)," ")," shipping ")]/td[2]/span[@class="price"]';
    protected $orderTaxXpath                 = '//table[@id="my-orders-table"]/descendant::td[concat(" ",normalize-space(.)," ") = " {{Tax}} "]/following-sibling::td[1]/span[@class="price"]';
    protected $orderGrandTotalXpath         = '//table[@id="my-orders-table"]/descendant::tr[contains(concat(" ",normalize-space(@class)," ")," grand_total ")]/td[2]/descendant::span[@class="price"]';

    protected $orderDateXpath               = '//p[@class="order-date"]';


    protected $orderStatusXpath             = '//div[contains(concat(" ",normalize-space(@class)," ")," page-title ")]/h1[contains(., "{{Order}}")]';
    protected $orderStatusRegex             = '/- (\w+)$/';



}