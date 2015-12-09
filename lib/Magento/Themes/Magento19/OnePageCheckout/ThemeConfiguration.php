<?php

namespace Magium\Magento\Themes\Magento19\OnePageCheckout;

use Magium\Magento\Themes\OnePageCheckout\AbstractThemeConfiguration;

class ThemeConfiguration extends AbstractThemeConfiguration
{

    /**
     * @var string The continue button when choosing the checkout type
     */

    protected $continueButtonXpath = '//button[@id="onepage-guest-register-button"]';

    /**
     * @var string The checkbox (typically) that sets the guest checkout
     */

    protected $guestCheckoutButtonXpath = '//input[@id="login:guest"]';

    /**
     * @var string The checkbox (typically) that sets the new customer checkout
     */

    protected $registerNewCustomerCheckoutButtonXpath = '//input[@id="login:register"]';

    protected $billingAddressDropdownXpath = '//select[@id="billing-address-select"]';

    protected $customerEmailInputXpath      = '//input[@id="login-email"]';
    protected $customerPasswordInputXpath   = '//input[@id="login-password"]';
    protected $customerButtonXpath          = '//button[@type="submit"]/descendant::span[.="Login"]';

    protected $billingFirstNameXpath      = '//input[@id="billing:firstname"]';
    protected $billingLastNameXpath       = '//input[@id="billing:lastname"]';
    protected $billingCompanyXpath        = '//input[@id="billing:company"]';
    protected $billingEmailAddressXpath   = '//input[@id="billing:email"]';
    protected $billingAddressXpath        = '//input[@id="billing:street1"]';
    protected $billingAddress2Xpath       = '//input[@id="billing:street2"]';
    protected $billingCityXpath           = '//input[@id="billing:city"]';
    /**
     * @var string The Xpath string for the region_id OPTION to click.  Must be sprintf() compatible
     */
    protected $billingRegionIdXpath       = '//select[@id="billing:region_id"]/descendant::option[@title="%s"]';
    protected $billingPostCodeXpath       = '//input[@id="billing:postcode"]';
    /**
     * @var string The Xpath string for the country OPTION to click.  Must be sprintf() compatible
     */
    protected $billingCountryIdXpath      = '//select[@id="billing:country_id"]/descendant::option[@value="%s"]';
    protected $billingTelephoneXpath      = '//input[@id="billing:telephone"]';
    protected $billingFaxXpath            = '//input[@id="billing:fax"]';
    protected $billingContinueButtonXpath = '//div[@id="billing-buttons-container"]/descendant::button[@title="Continue"]';
    protected $billingContinueCompletedXpath   = '//span[@id="billing-please-wait"]';


    protected $shippingFirstNameXpath      = '//input[@id="shipping:firstname"]';
    protected $shippingLastNameXpath       = '//input[@id="shipping:lastname"]';
    protected $shippingCompanyXpath        = '//input[@id="shipping:company"]';
    protected $shippingEmailAddressXpath   = '//input[@id="shipping:email"]';
    protected $shippingAddressXpath        = '//input[@id="shipping:street1"]';
    protected $shippingAddress2Xpath       = '//input[@id="shipping:street2"]';
    protected $shippingCityXpath           = '//input[@id="shipping:city"]';
    /**
     * @var string The Xpath string for the region_id OPTION to click.  Must be sprintf() compatible
     */
    protected $shippingRegionIdXpath       = '//select[@id="shipping:region_id"]/descendant::option[@title="%s"]';
    protected $shippingPostCodeXpath       = '//input[@id="shipping:postcode"]';
    /**
     * @var string The Xpath string for the country OPTION to click.  Must be sprintf() compatible
     */
    protected $shippingCountryIdXpath      = '//select[@id="shipping:country_id"]/descendant::option[@value="%s"]';
    protected $shippingTelephoneXpath      = '//input[@id="shipping:telephone"]';
    protected $shippingFaxXpath            = '//input[@id="shipping:fax"]';
    protected $shippingContinueButtonXpath = '//div[@id="shipping-buttons-container"]/descendant::button[@title="Continue"]';
    protected $shippingContinueCompletedXpath   = '//span[@id="shipping-please-wait"]';
    protected $shippingMethodContinueCompletedXpath   = '//span[@id="shipping-method-please-wait"]';

    protected $shippingMethodContinueButtonXpath = '//div[@id="shipping-method-buttons-container"]/descendant::button';
    protected $defaultShippingXpath             = '//input[@name="shipping_method"]';

    protected $paymentMethodContinueCompleteXpath = '//span[@id="payment-please-wait"]';

    protected $paymentMethodContinueButtonXpath = '//div[@id="payment-buttons-container"]/descendant::button';

    protected $placeOrderButtonXpath        = '//div[@id="review-buttons-container"]/descendant::button[@title="Place Order"]';

    protected $orderReceivedCompleteXpath = '//h1[.="Your order has been received."]';

    protected $shippingMethodFormXpath      = '//form[@id="co-shipping-method-form"]';

    protected $passwordInputXpath           = '//input[@id="billing:customer_password"]';
    protected $confirmPasswordInputXpath           = '//input[@id="billing:confirm_password"]';


}