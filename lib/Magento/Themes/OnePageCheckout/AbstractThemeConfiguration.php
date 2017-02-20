<?php

namespace Magium\Magento\Themes\OnePageCheckout;


use Magium\AbstractConfigurableElement;
use Magium\Themes\ThemeConfigurationInterface;

abstract class AbstractThemeConfiguration extends AbstractConfigurableElement implements ThemeConfigurationInterface
{

    /**
     * @var string The continue button when choosing the checkout type
     */

    public $continueButtonXpath;

    /**
     * @var string The checkbox (typically) that sets the guest checkout
     */

    public $guestCheckoutButtonXpath;

    /**
     * @var string The checkbox (typically) that sets the new customer checkout
     */

    public $registerNewCustomerCheckoutButtonXpath;

    public $billingAddressDropdownXpath;

    public $customerEmailInputXpath;
    public $customerPasswordInputXpath;
    public $customerButtonXpath;

    public $billingFirstNameXpath;
    public $billingLastNameXpath;
    public $billingCompanyXpath;
    public $billingEmailAddressXpath;
    public $billingAddressXpath;
    public $billingAddress2Xpath;
    public $billingCityXpath;
    /**
     * @var string The Xpath string for the region_id OPTION to click.  Must be sprintf() compatible
     */
    public $billingRegionIdXpath;
    public $billingPostCodeXpath;
    /**
     * @var string The Xpath string for the country OPTION to click.  Must be sprintf() compatible
     */
    public $billingCountryIdXpath;
    public $billingTelephoneXpath;
    public $billingFaxXpath;

    public $useBillingAddressForShipping;
    public $doNotUseBillingAddressForShipping;

    public $billingContinueButtonXpath;
    public $billingContinueCompletedXpath;


    public $shippingFirstNameXpath;
    public $shippingLastNameXpath;
    public $shippingCompanyXpath;
    public $shippingEmailAddressXpath;
    public $shippingAddressXpath;
    public $shippingAddress2Xpath;
    public $shippingCityXpath;
    /**
     * @var string The Xpath string for the region_id OPTION to click.  Must be sprintf() compatible
     */
    public $shippingRegionIdXpath;
    public $shippingPostCodeXpath;
    /**
     * @var string The Xpath string for the country OPTION to click.  Must be sprintf() compatible
     */
    public $shippingCountryIdXpath;
    public $shippingTelephoneXpath;
    public $shippingFaxXpath;
    public $shippingContinueButtonXpath;
    public $shippingContinueCompletedXpath;
    public $shippingMethodContinueCompletedXpath;

    public $shippingMethodContinueButtonXpath;
    public $defaultShippingXpath;

    public $paymentMethodContinueCompleteXpath;

    public $paymentMethodContinueButtonXpath;

    public $placeOrderButtonXpath;

    public $orderReceivedCompleteXpath;

    public $shippingMethodFormXpath;

    public $passwordInputXpath;
    public $confirmPasswordInputXpath;

    /**
     * This is a hard one.  Each of the summary checkout products will be iterated over until they cannot be found. Having
     * this work in a manner that gets all of the products, in all languages, in all themes, is quite difficult and
     * so the Xpath selector needs to be one that can find each individual column with an incrementing iterator.
     *
     * @see Magium\Magento\Actions\Checkout\Extractors\CartSummary for an example on how this is done
     *
     * @var string
     */

    public $cartSummaryCheckoutProductLoopPriceXpath;
    public $cartSummaryCheckoutProductLoopNameXpath;
    public $cartSummaryCheckoutProductLoopQtyXpath;
    public $cartSummaryCheckoutProductLoopSubtotalXpath;

    public $cartSummaryCheckoutSubTotal;
    public $cartSummaryCheckoutTax;
    public $cartSummaryCheckoutGrandTotal;
    public $cartSummaryCheckoutShippingTotal;

    public $billingNewAddressXpath;
    public $shippingNewAddressXpath;

    public $guaranteedPageLoadedElementDisplayedXpath = '//*[contains(concat(" ",normalize-space(@class)," ")," footer ")]';

    public $orderNumberExtractorXpath;

    public $termsAndConditionsSelectorXpath;

    public $shippingByNameXpath;

    /**
     * @return mixed
     */
    public function getShippingByNameXpath($name)
    {
        $xpath = sprintf($this->shippingByNameXpath, $name);
        return $this->translatePlaceholders($xpath);
    }

    /**
     * @return mixed
     */
    public function getTermsAndConditionsSelectorXpath($term)
    {
        $return = sprintf($this->termsAndConditionsSelectorXpath, $term);
        return $this->translatePlaceholders($return);
    }

    public function getOrderNumberExtractorXpath()
    {
        return $this->translatePlaceholders($this->orderNumberExtractorXpath);
    }

    public function getGuaranteedPageLoadedElementDisplayedXpath()
    {
        return $this->translatePlaceholders($this->guaranteedPageLoadedElementDisplayedXpath);
    }

    /**
     * @param mixed $guaranteedPageLoadedElementDisplayedXpath
     */
    public function setGuaranteedPageLoadedElementDisplayedXpath($guaranteedPageLoadedElementDisplayedXpath)
    {
        $this->guaranteedPageLoadedElementDisplayedXpath = $guaranteedPageLoadedElementDisplayedXpath;
    }

    /**
     * @return string
     */
    public function getBillingNewAddressXpath()
    {
        return $this->translatePlaceholders($this->billingNewAddressXpath);
    }

    /**
     * @return string
     */
    public function getShippingNewAddressXpath()
    {
        return $this->translatePlaceholders($this->shippingNewAddressXpath);
    }

    /**
     * @return mixed
     */
    public function getDoNotUseBillingAddressForShipping()
    {
        return $this->doNotUseBillingAddressForShipping;
    }

    /**
     * @return mixed
     */
    public function getUseBillingAddressForShipping()
    {
        return $this->useBillingAddressForShipping;
    }

    /**
     * @return string
     */
    public function getBillingAddressDropdownXpath()
    {
        return $this->translatePlaceholders($this->billingAddressDropdownXpath);
    }

    /**
     * @return string
     */
    public function getPasswordInputXpath()
    {
        return $this->translatePlaceholders($this->passwordInputXpath);
    }

    /**
     * @return string
     */
    public function getConfirmPasswordInputXpath()
    {
        return $this->translatePlaceholders($this->confirmPasswordInputXpath);
    }



    /**
     * @return string
     */
    public function getRegisterNewCustomerCheckoutButtonXpath()
    {
        return $this->translatePlaceholders($this->registerNewCustomerCheckoutButtonXpath);
    }

    /**
     * @return string
     */
    public function getCustomerEmailInputXpath()
    {
        return $this->translatePlaceholders($this->customerEmailInputXpath);
    }

    /**
     * @return string
     */
    public function getCustomerPasswordInputXpath()
    {
        return $this->translatePlaceholders($this->customerPasswordInputXpath);
    }

    /**
     * @return string
     */
    public function getCustomerButtonXpath()
    {
        return $this->translatePlaceholders($this->customerButtonXpath);
    }



    /**
     * @return string
     */
    public function getShippingMethodFormXpath()
    {
        return $this->translatePlaceholders($this->shippingMethodFormXpath);
    }

    /**
     * @return string
     */
    public function getOrderReceivedCompleteXpath()
    {
        return $this->translatePlaceholders($this->orderReceivedCompleteXpath);
    }


    /**
     * @return string
     */
    public function getPaymentMethodContinueButtonXpath()
    {
        return $this->translatePlaceholders($this->paymentMethodContinueButtonXpath);
    }

    /**
     * @return string
     */
    public function getShippingMethodContinueButtonXpath()
    {
        return $this->translatePlaceholders($this->shippingMethodContinueButtonXpath);
    }

     /**
      * @return string
     */
    public function getPlaceOrderButtonXpath()
    {
        return $this->translatePlaceholders($this->placeOrderButtonXpath);
    }


    /**
     * @return string
     */
    public function getPaymentMethodContinueCompleteXpath()
    {
        return $this->translatePlaceholders($this->paymentMethodContinueCompleteXpath);
    }


    public function getDefaultShippingXpath()
    {
        return $this->translatePlaceholders($this->defaultShippingXpath);
    }

    /**
     * @return string
     */
    public function getShippingMethodContinueCompletedXpath()
    {
        return $this->translatePlaceholders($this->shippingMethodContinueCompletedXpath);
    }

    /**
     * @return string
     */
    public function getShippingFirstNameXpath()
    {
        return $this->translatePlaceholders($this->shippingFirstNameXpath);
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
        return $this->translatePlaceholders($this->shippingLastNameXpath);
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
        return $this->translatePlaceholders($this->shippingCompanyXpath);
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
        return $this->translatePlaceholders($this->shippingEmailAddressXpath);
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
        return $this->translatePlaceholders($this->shippingAddressXpath);
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
        return $this->translatePlaceholders($this->shippingAddress2Xpath);
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
        return $this->translatePlaceholders($this->shippingCityXpath);
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
        return $this->translatePlaceholders($return);
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
        return $this->translatePlaceholders($this->shippingPostCodeXpath);
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
        return $this->translatePlaceholders($return);
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
        return $this->translatePlaceholders($this->shippingTelephoneXpath);
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
        return $this->translatePlaceholders($this->shippingFaxXpath);
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
        return $this->translatePlaceholders($this->shippingContinueButtonXpath);
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
        return $this->translatePlaceholders($this->shippingContinueCompletedXpath);
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
        return $this->translatePlaceholders($this->billingContinueCompletedXpath);
    }

    public function getContinueButtonXpath()
    {
        return $this->translatePlaceholders($this->continueButtonXpath);
    }

    public function getGuestCheckoutButtonXpath()
    {
        return $this->translatePlaceholders($this->guestCheckoutButtonXpath);
    }

    /**
     * @return string
     */
    public function getBillingFirstNameXpath()
    {
        return $this->translatePlaceholders($this->billingFirstNameXpath);
    }

    /**
     * @return string
     */
    public function getBillingLastNameXpath()
    {
        return $this->translatePlaceholders($this->billingLastNameXpath);
    }

    /**
     * @return string
     */
    public function getBillingCompanyXpath()
    {
        return $this->translatePlaceholders($this->billingCompanyXpath);
    }

    /**
     * @return string
     */
    public function getBillingEmailAddressXpath()
    {
        return $this->translatePlaceholders($this->billingEmailAddressXpath);
    }

    /**
     * @return string
     */
    public function getBillingAddressXpath()
    {
        return$this->translatePlaceholders( $this->billingAddressXpath);
    }

    /**
     * @return string
     */
    public function getBillingAddress2Xpath()
    {
        return $this->translatePlaceholders($this->billingAddress2Xpath);
    }

    /**
     * @return string
     */
    public function getBillingCityXpath()
    {
        return $this->translatePlaceholders($this->billingCityXpath);
    }

    /**
     * @return string
     */
    public function getBillingRegionIdXpath($region)
    {
        $return = sprintf($this->billingRegionIdXpath, $region);
        return $this->translatePlaceholders($return);
    }

    /**
     * @return string
     */
    public function getBillingPostCodeXpath()
    {
        return $this->translatePlaceholders($this->billingPostCodeXpath);
    }

    /**
     * @return string
     */
    public function getBillingCountryIdXpath($country)
    {
        $return = sprintf($this->billingCountryIdXpath, $country);
        return $this->translatePlaceholders($return);
    }

    /**
     * @return string
     */
    public function getBillingTelephoneXpath()
    {
        return $this->translatePlaceholders($this->billingTelephoneXpath);
    }

    /**
     * @return string
     */
    public function getBillingFaxXpath()
    {
        return $this->translatePlaceholders($this->billingFaxXpath);
    }

    /**
     * @return string
     */
    public function getBillingContinueButtonXpath()
    {
        return $this->translatePlaceholders($this->billingContinueButtonXpath);
    }

    /**
     * @return string
     */
    public function getCartSummaryCheckoutSubTotal()
    {
        return $this->translatePlaceholders($this->cartSummaryCheckoutSubTotal);
    }

    /**
     * @return string
     */
    public function getCartSummaryCheckoutTax()
    {
        return $this->translatePlaceholders($this->cartSummaryCheckoutTax);
    }

    /**
     * @return string
     */
    public function getCartSummaryCheckoutGrandTotal()
    {
        return $this->translatePlaceholders($this->cartSummaryCheckoutGrandTotal);
    }

    /**
     * @return string
     */
    public function getCartSummaryCheckoutShippingTotal()
    {
        return $this->translatePlaceholders($this->cartSummaryCheckoutShippingTotal);
    }



    /**
     * @return string
     */
    public function getCartSummaryCheckoutProductLoopPriceXpath($itemCount)
    {
        $return = sprintf($this->cartSummaryCheckoutProductLoopPriceXpath , $itemCount);
        return $this->translatePlaceholders($return);
    }

    /**
     * @return string
     */
    public function getCartSummaryCheckoutProductLoopNameXpath($itemCount)
    {
        $return = sprintf($this->cartSummaryCheckoutProductLoopNameXpath , $itemCount);
        return $this->translatePlaceholders($return);
    }

    /**
     * @return string
     */
    public function getCartSummaryCheckoutProductLoopQtyXpath($itemCount)
    {
        $return = sprintf($this->cartSummaryCheckoutProductLoopQtyXpath , $itemCount);
        return $this->translatePlaceholders($return);
    }

    /**
     * @return string
     */
    public function getCartSummaryCheckoutProductLoopSubtotalXpath($itemCount)
    {
        $return = sprintf($this->cartSummaryCheckoutProductLoopSubtotalXpath , $itemCount);
        return $this->translatePlaceholders($return);
    }

}
