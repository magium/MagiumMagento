<?php

namespace Magium\Magento\Themes\OnePageCheckout;


use Magium\AbstractConfigurableElement;
use Magium\Themes\ThemeConfigurationInterface;

abstract class AbstractThemeConfiguration extends AbstractConfigurableElement implements ThemeConfigurationInterface // ThemeConfigurationInterface is here simply for compatibility for extractors
{

    /**
     * @var string The continue button when choosing the checkout type
     */

    protected $continueButtonXpath;

    /**
     * @var string The checkbox (typically) that sets the guest checkout
     */

    protected $guestCheckoutButtonXpath;

    /**
     * @var string The checkbox (typically) that sets the new customer checkout
     */

    protected $registerNewCustomerCheckoutButtonXpath;

    protected $billingAddressDropdownXpath;

    protected $customerEmailInputXpath;
    protected $customerPasswordInputXpath;
    protected $customerButtonXpath;

    protected $billingFirstNameXpath;
    protected $billingLastNameXpath;
    protected $billingCompanyXpath;
    protected $billingEmailAddressXpath;
    protected $billingAddressXpath;
    protected $billingAddress2Xpath;
    protected $billingCityXpath;
    /**
     * @var string The Xpath string for the region_id OPTION to click.  Must be sprintf() compatible
     */
    protected $billingRegionIdXpath;
    protected $billingPostCodeXpath;
    /**
     * @var string The Xpath string for the country OPTION to click.  Must be sprintf() compatible
     */
    protected $billingCountryIdXpath;
    protected $billingTelephoneXpath;
    protected $billingFaxXpath;
    protected $billingContinueButtonXpath;
    protected $billingContinueCompletedXpath;


    protected $shippingFirstNameXpath;
    protected $shippingLastNameXpath;
    protected $shippingCompanyXpath;
    protected $shippingEmailAddressXpath;
    protected $shippingAddressXpath;
    protected $shippingAddress2Xpath;
    protected $shippingCityXpath;
    /**
     * @var string The Xpath string for the region_id OPTION to click.  Must be sprintf() compatible
     */
    protected $shippingRegionIdXpath;
    protected $shippingPostCodeXpath;
    /**
     * @var string The Xpath string for the country OPTION to click.  Must be sprintf() compatible
     */
    protected $shippingCountryIdXpath;
    protected $shippingTelephoneXpath;
    protected $shippingFaxXpath;
    protected $shippingContinueButtonXpath;
    protected $shippingContinueCompletedXpath;
    protected $shippingMethodContinueCompletedXpath;

    protected $shippingMethodContinueButtonXpath;
    protected $defaultShippingXpath;

    protected $paymentMethodContinueCompleteXpath;

    protected $paymentMethodContinueButtonXpath;

    protected $placeOrderButtonXpath;

    protected $orderReceivedCompleteXpath;

    protected $shippingMethodFormXpath;

    protected $passwordInputXpath;
    protected $confirmPasswordInputXpath;

    /**
     * This is a hard one.  Each of the summary checkout products will be iterated over until they cannot be found. Having
     * this work in a manner that gets all of the products, in all languages, in all themes, is quite difficult and
     * so the Xpath selector needs to be one that can find each individual column with an incrementing iterator.
     *
     * @see Magium\Magento\Actions\Checkout\Extractors\CartSummary for an example on how this is done
     *
     * @var string
     */

    protected $cartSummaryCheckoutProductLoopPriceXpath;
    protected $cartSummaryCheckoutProductLoopNameXpath;
    protected $cartSummaryCheckoutProductLoopQtyXpath;
    protected $cartSummaryCheckoutProductLoopSubtotalXpath;

    protected $cartSummaryCheckoutSubTotal;
    protected $cartSummaryCheckoutTax;
    protected $cartSummaryCheckoutGrandTotal;
    protected $cartSummaryCheckoutShippingTotal;


    /**
     * @return string
     */
    public function getBillingAddressDropdownXpath()
    {
        return $this->translate($this->billingAddressDropdownXpath);
    }

    /**
     * @return string
     */
    public function getPasswordInputXpath()
    {
        return $this->translate($this->passwordInputXpath);
    }

    /**
     * @return string
     */
    public function getConfirmPasswordInputXpath()
    {
        return $this->translate($this->confirmPasswordInputXpath);
    }



    /**
     * @return string
     */
    public function getRegisterNewCustomerCheckoutButtonXpath()
    {
        return $this->translate($this->registerNewCustomerCheckoutButtonXpath);
    }

    /**
     * @return string
     */
    public function getCustomerEmailInputXpath()
    {
        return $this->translate($this->customerEmailInputXpath);
    }

    /**
     * @return string
     */
    public function getCustomerPasswordInputXpath()
    {
        return $this->translate($this->customerPasswordInputXpath);
    }

    /**
     * @return string
     */
    public function getCustomerButtonXpath()
    {
        return $this->translate($this->customerButtonXpath);
    }



    /**
     * @return string
     */
    public function getShippingMethodFormXpath()
    {
        return $this->translate($this->shippingMethodFormXpath);
    }

    /**
     * @return string
     */
    public function getOrderReceivedCompleteXpath()
    {
        return $this->translate($this->orderReceivedCompleteXpath);
    }


    /**
     * @return string
     */
    public function getPaymentMethodContinueButtonXpath()
    {
        return $this->translate($this->paymentMethodContinueButtonXpath);
    }

    /**
     * @return string
     */
    public function getShippingMethodContinueButtonXpath()
    {
        return $this->translate($this->shippingMethodContinueButtonXpath);
    }

     /**
      * @return string
     */
    public function getPlaceOrderButtonXpath()
    {
        return $this->translate($this->placeOrderButtonXpath);
    }


    /**
     * @return string
     */
    public function getPaymentMethodContinueCompleteXpath()
    {
        return $this->translate($this->paymentMethodContinueCompleteXpath);
    }


    public function getDefaultShippingXpath()
    {
        return $this->translate($this->defaultShippingXpath);
    }

    /**
     * @return string
     */
    public function getShippingMethodContinueCompletedXpath()
    {
        return $this->translate($this->shippingMethodContinueCompletedXpath);
    }

    /**
     * @return string
     */
    public function getShippingFirstNameXpath()
    {
        return $this->translate($this->shippingFirstNameXpath);
    }

    /**
     * @param string $shippinFirstNameXpath
     */
    public function setShippingFirstNameXpath($shippingFirstNameXpath)
    {
        $this->shippingFirstNameXpath = $shippingFirstNameXpath;
    }

    /**
     * @return string
     */
    public function getShippingLastNameXpath()
    {
        return $this->translate($this->shippingLastNameXpath);
    }

    /**
     * @param string $shippingLastNameXpath
     */
    public function setShippingLastNameXpath($shippingLastNameXpath)
    {
        $this->shippingLastNameXpath = $shippingLastNameXpath;
    }

    /**
     * @return string
     */
    public function getShippingCompanyXpath()
    {
        return $this->translate($this->shippingCompanyXpath);
    }

    /**
     * @param string $shippingCompanyXpath
     */
    public function setShippingCompanyXpath($shippingCompanyXpath)
    {
        $this->shippingCompanyXpath = $shippingCompanyXpath;
    }

    /**
     * @return string
     */
    public function getShippingEmailAddressXpath()
    {
        return $this->translate($this->shippingEmailAddressXpath);
    }

    /**
     * @param string $shippingEmailAddressXpath
     */
    public function setShippingEmailAddressXpath($shippingEmailAddressXpath)
    {
        $this->shippingEmailAddressXpath = $shippingEmailAddressXpath;
    }

    /**
     * @return string
     */
    public function getShippingAddressXpath()
    {
        return $this->translate($this->shippingAddressXpath);
    }

    /**
     * @param string $shippingAddressXpath
     */
    public function setShippingAddressXpath($shippingAddressXpath)
    {
        $this->shippingAddressXpath = $shippingAddressXpath;
    }

    /**
     * @return string
     */
    public function getShippingAddress2Xpath()
    {
        return $this->translate($this->shippingAddress2Xpath);
    }

    /**
     * @param string $shippingAddress2Xpath
     */
    public function setShippingAddress2Xpath($shippingAddress2Xpath)
    {
        $this->shippingAddress2Xpath = $shippingAddress2Xpath;
    }

    /**
     * @return string
     */
    public function getShippingCityXpath()
    {
        return $this->translate($this->shippingCityXpath);
    }

    /**
     * @param string $shippingCityXpath
     */
    public function setShippingCityXpath($shippingCityXpath)
    {
        $this->shippingCityXpath = $shippingCityXpath;
    }

    /**
     * @return string
     */
    public function getShippingRegionIdXpath($region)
    {
        $return = sprintf($this->shippingRegionIdXpath, $region);
        return $this->translate($return);
    }

    /**
     * @param string $shippingRegionIdXpath
     */
    public function setShippingRegionIdXpath($shippingRegionIdXpath)
    {
        $this->shippingRegionIdXpath = $shippingRegionIdXpath;
    }

    /**
     * @return string
     */
    public function getShippingPostCodeXpath()
    {
        return $this->translate($this->shippingPostCodeXpath);
    }

    /**
     * @param string $shippingPostCodeXpath
     */
    public function setShippingPostCodeXpath($shippingPostCodeXpath)
    {
        $this->shippingPostCodeXpath = $shippingPostCodeXpath;
    }

    /**
     * @return string
     */
    public function getShippingCountryIdXpath($country)
    {
        $return = sprintf($this->shippingCountryIdXpath, $country);
        return $this->translate($return);
    }

    /**
     * @param string $shippingCountryIdXpath
     */
    public function setShippingCountryIdXpath($shippingCountryIdXpath)
    {
        $this->shippingCountryIdXpath = $shippingCountryIdXpath;
    }

    /**
     * @return string
     */
    public function getShippingTelephoneXpath()
    {
        return $this->translate($this->shippingTelephoneXpath);
    }

    /**
     * @param string $shippingTelephoneXpath
     */
    public function setShippingTelephoneXpath($shippingTelephoneXpath)
    {
        $this->shippingTelephoneXpath = $shippingTelephoneXpath;
    }

    /**
     * @return string
     */
    public function getShippingFaxXpath()
    {
        return $this->translate($this->shippingFaxXpath);
    }

    /**
     * @param string $shippingFaxXpath
     */
    public function setShippingFaxXpath($shippingFaxXpath)
    {
        $this->shippingFaxXpath = $shippingFaxXpath;
    }

    /**
     * @return string
     */
    public function getShippingContinueButtonXpath()
    {
        return $this->translate($this->shippingContinueButtonXpath);
    }

    /**
     * @param string $shippingContinueButtonXpath
     */
    public function setShippingContinueButtonXpath($shippingContinueButtonXpath)
    {
        $this->shippingContinueButtonXpath = $shippingContinueButtonXpath;
    }

    /**
     * @return string
     */
    public function getShippingContinueCompletedXpath()
    {
        return $this->translate($this->shippingContinueCompletedXpath);
    }

    /**
     * @param string $shippingContinueCompletedXpath
     */
    public function setShippingContinueCompletedXpath($shippingContinueCompletedXpath)
    {
        $this->shippingContinueCompletedXpath = $shippingContinueCompletedXpath;
    }

    public function getBillingContinueCompletedXpath()
    {
        return $this->translate($this->billingContinueCompletedXpath);
    }

    public function getContinueButtonXpath()
    {
        return $this->translate($this->continueButtonXpath);
    }

    public function getGuestCheckoutButtonXpath()
    {
        return $this->translate($this->guestCheckoutButtonXpath);
    }

    /**
     * @return string
     */
    public function getBillingFirstNameXpath()
    {
        return $this->translate($this->billingFirstNameXpath);
    }

    /**
     * @return string
     */
    public function getBillingLastNameXpath()
    {
        return $this->translate($this->billingLastNameXpath);
    }

    /**
     * @return string
     */
    public function getBillingCompanyXpath()
    {
        return $this->translate($this->billingCompanyXpath);
    }

    /**
     * @return string
     */
    public function getBillingEmailAddressXpath()
    {
        return $this->translate($this->billingEmailAddressXpath);
    }

    /**
     * @return string
     */
    public function getBillingAddressXpath()
    {
        return$this->translate( $this->billingAddressXpath);
    }

    /**
     * @return string
     */
    public function getBillingAddress2Xpath()
    {
        return $this->translate($this->billingAddress2Xpath);
    }

    /**
     * @return string
     */
    public function getBillingCityXpath()
    {
        return $this->translate($this->billingCityXpath);
    }

    /**
     * @return string
     */
    public function getBillingRegionIdXpath($region)
    {
        $return = sprintf($this->billingRegionIdXpath, $region);
        return $this->translate($return);
    }

    /**
     * @return string
     */
    public function getBillingPostCodeXpath()
    {
        return $this->translate($this->billingPostCodeXpath);
    }

    /**
     * @return string
     */
    public function getBillingCountryIdXpath($country)
    {
        $return = sprintf($this->billingCountryIdXpath, $country);
        return $this->translate($return);
    }

    /**
     * @return string
     */
    public function getBillingTelephoneXpath()
    {
        return $this->translate($this->billingTelephoneXpath);
    }

    /**
     * @return string
     */
    public function getBillingFaxXpath()
    {
        return $this->translate($this->billingFaxXpath);
    }

    /**
     * @return string
     */
    public function getBillingContinueButtonXpath()
    {
        return $this->translate($this->billingContinueButtonXpath);
    }

    /**
     * @return string
     */
    public function getCartSummaryCheckoutSubTotal()
    {
        return $this->translate($this->cartSummaryCheckoutSubTotal);
    }

    /**
     * @return string
     */
    public function getCartSummaryCheckoutTax()
    {
        return $this->translate($this->cartSummaryCheckoutTax);
    }

    /**
     * @return string
     */
    public function getCartSummaryCheckoutGrandTotal()
    {
        return $this->translate($this->cartSummaryCheckoutGrandTotal);
    }

    /**
     * @return string
     */
    public function getCartSummaryCheckoutShippingTotal()
    {
        return $this->translate($this->cartSummaryCheckoutShippingTotal);
    }



    /**
     * @return string
     */
    public function getCartSummaryCheckoutProductLoopPriceXpath($itemCount)
    {
        $return = sprintf($this->cartSummaryCheckoutProductLoopPriceXpath , $itemCount);
        return $this->translate($return);
    }

    /**
     * @return string
     */
    public function getCartSummaryCheckoutProductLoopNameXpath($itemCount)
    {
        $return = sprintf($this->cartSummaryCheckoutProductLoopNameXpath , $itemCount);
        return $this->translate($return);
    }

    /**
     * @return string
     */
    public function getCartSummaryCheckoutProductLoopQtyXpath($itemCount)
    {
        $return = sprintf($this->cartSummaryCheckoutProductLoopQtyXpath , $itemCount);
        return $this->translate($return);
    }

    /**
     * @return string
     */
    public function getCartSummaryCheckoutProductLoopSubtotalXpath($itemCount)
    {
        $return = sprintf($this->cartSummaryCheckoutProductLoopSubtotalXpath , $itemCount);
        return $this->translate($return);
    }

}