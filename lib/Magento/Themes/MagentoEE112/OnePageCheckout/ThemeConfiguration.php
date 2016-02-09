<?php

namespace Magium\Magento\Themes\MagentoEE112\OnePageCheckout;


use Magium\Magento\Themes\OnePageCheckout\AbstractThemeConfiguration;

class ThemeConfiguration extends AbstractThemeConfiguration
{

    /**
     * @var string The continue button when choosing the checkout type
     */

    public $continueButtonXpath = '//button[@id="onepage-guest-register-button"]';

    /**
     * @var string The checkbox (typically) that sets the guest checkout
     */

    public $guestCheckoutButtonXpath = '//input[@id="login:guest"]';

    /**
     * @var string The checkbox (typically) that sets the new customer checkout
     */

    public $registerNewCustomerCheckoutButtonXpath = '//input[@id="login:register"]';

    public $billingAddressDropdownXpath = '//select[@id="billing-address-select"]';

    public $customerEmailInputXpath      = '//input[@id="login-email"]';
    public $customerPasswordInputXpath   = '//input[@id="login-password"]';
    public $customerButtonXpath          = '//form[@id="login-form"]/descendant::button[@onclick="loginForm.submit()"]';

    public $billingFirstNameXpath      = '//input[@id="billing:firstname"]';
    public $billingLastNameXpath       = '//input[@id="billing:lastname"]';
    public $billingCompanyXpath        = '//input[@id="billing:company"]';
    public $billingEmailAddressXpath   = '//input[@id="billing:email"]';
    public $billingAddressXpath        = '//input[@id="billing:street1"]';
    public $billingAddress2Xpath       = '//input[@id="billing:street2"]';
    public $billingCityXpath           = '//input[@id="billing:city"]';
    /**
     * @var string The Xpath string for the region_id OPTION to click.  Must be sprintf() compatible
     */
//    public $billingRegionIdXpath       = null; // Apparently this is not needed for 1.8
    public $billingRegionIdXpath       = '//select[@id="billing:region_id"]/descendant::option[.="%s"]';
    public $billingPostCodeXpath       = '//input[@id="billing:postcode"]';
    /**
     * @var string The Xpath string for the country OPTION to click.  Must be sprintf() compatible
     */
    public $billingCountryIdXpath      = '//select[@id="billing:country_id"]/descendant::option[@value="%s"]';
    public $billingTelephoneXpath      = '//input[@id="billing:telephone"]';
    public $billingFaxXpath            = '//input[@id="billing:fax"]';

    public $useBillingAddressForShipping = '//input[@id="billing:use_for_shipping_yes"]';
    public $doNotUseBillingAddressForShipping = '//input[@id="billing:use_for_shipping_no"]';

    public $billingContinueButtonXpath = '//div[@id="billing-buttons-container"]/descendant::button[@onclick="billing.save()"]';

    public $billingContinueCompletedXpath   = '//span[@id="billing-please-wait"]';

    public $billingNewAddressXpath = '//select[@id="billing-address-select"]/option[.="{{New Address}}"]';
    public $shippingNewAddressXpath = '//select[@id="shipping-address-select"]/option[.="{{New Address}}"]';

    public $shippingFirstNameXpath      = '//input[@id="shipping:firstname"]';
    public $shippingLastNameXpath       = '//input[@id="shipping:lastname"]';
    public $shippingCompanyXpath        = '//input[@id="shipping:company"]';
    public $shippingEmailAddressXpath   = '//input[@id="shipping:email"]';
    public $shippingAddressXpath        = '//input[@id="shipping:street1"]';
    public $shippingAddress2Xpath       = '//input[@id="shipping:street2"]';
    public $shippingCityXpath           = '//input[@id="shipping:city"]';
    /**
     * @var string The Xpath string for the region_id OPTION to click.  Must be sprintf() compatible
     */
//    public $shippingRegionIdXpath       = null; // Magento 1.8's checkout apparently does not have this
    public $shippingRegionIdXpath       = '//select[@id="shipping:region_id"]/descendant::option[.="%s"]';
    public $shippingPostCodeXpath       = '//input[@id="shipping:postcode"]';
    /**
     * @var string The Xpath string for the country OPTION to click.  Must be sprintf() compatible
     */
    public $shippingCountryIdXpath      = '//select[@id="shipping:country_id"]/descendant::option[@value="%s"]';
    public $shippingTelephoneXpath      = '//input[@id="shipping:telephone"]';
    public $shippingFaxXpath            = '//input[@id="shipping:fax"]';
    public $shippingContinueButtonXpath = '//div[@id="shipping-buttons-container"]/descendant::button[@onclick="shipping.save()"]';
    public $shippingContinueCompletedXpath   = '//span[@id="shipping-please-wait"]';
    public $shippingMethodContinueCompletedXpath   = '//span[@id="shipping-method-please-wait"]';

    public $shippingMethodContinueButtonXpath = '//div[@id="shipping-method-buttons-container"]/descendant::button';
    public $defaultShippingXpath             = '//input[@name="shipping_method"]';

    public $paymentMethodContinueCompleteXpath = '//span[@id="payment-please-wait"]';

    public $paymentMethodContinueButtonXpath = '//div[@id="payment-buttons-container"]/descendant::button';

    public $placeOrderButtonXpath        = '//div[@id="review-buttons-container"]/descendant::button[@title="Place Order"]';

    public $orderReceivedCompleteXpath = '//h1[.="Your order has been received."]';

    public $shippingMethodFormXpath      = '//form[@id="co-shipping-method-form"]';

    public $passwordInputXpath           = '//input[@id="billing:customer_password"]';
    public $confirmPasswordInputXpath           = '//input[@id="billing:confirm_password"]';

    /**
     * This is a hard one.  Each of the summary checkout products will be iterated over until they cannot be found. Having
     * this work in a manner that gets all of the products, in all languages, in all themes, is quite difficult and
     * so the Xpath selector needs to be one that can find each individual column with an incrementing iterator.
     *
     * @see Magium\Magento\Actions\Checkout\Extractors\CartSummary for an example on how this is done
     *
     * @var string
     */

    public $cartSummaryCheckoutProductLoopPriceXpath = '(//table[@id="checkout-review-table"]/tbody//td[2]/descendant::span[@class="cart-price"])[%d]';
    public $cartSummaryCheckoutProductLoopNameXpath = '(//table[@id="checkout-review-table"]/tbody/descendant::td/h3)[%d]';
    public $cartSummaryCheckoutProductLoopQtyXpath = '(//table[@id="checkout-review-table"]/tbody//td[3])[%d]';
    public $cartSummaryCheckoutProductLoopSubtotalXpath = '(//table[@id="checkout-review-table"]/tbody//td[4]/descendant::span[@class="cart-price"])[%d]';

    public $cartSummaryCheckoutSubTotal              = '//table[@id="checkout-review-table"]/tfoot/tr/td[concat(" ",normalize-space(.)," ") = " {{Subtotal}} "]/../td[2]';
    public $cartSummaryCheckoutTax              = '//table[@id="checkout-review-table"]/tfoot/tr/td[concat(" ",normalize-space(.)," ") = " {{Tax}} "]/../td[2]';
    public $cartSummaryCheckoutGrandTotal              = '//table[@id="checkout-review-table"]/tfoot/tr/td[concat(" ",normalize-space(.)," ") = " {{Grand Total}} "]/../td[2]';
    public $cartSummaryCheckoutShippingTotal              = '//table[@id="checkout-review-table"]/tfoot/tr/td[contains(concat(" ",normalize-space(.)," "), " {{Shipping & Handling}} (")]/../td[2]';

}