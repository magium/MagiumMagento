<?php

namespace Magium\Magento\Themes;

use Magium\AbstractConfigurableElement;

abstract class AbstractThemeConfiguration extends AbstractConfigurableElement implements NavigableThemeInterface
{

    /**
     * @var string The Xpath string that finds the base of the navigation menu
     */
    protected $navigationBaseXPathSelector;

    /**
     * @var string The Xpath string that can be used iteratively to find child navigation nodes
     */

    protected $navigationChildXPathSelector;

    /**
     * @var string A simple, default path to use for categories.
     */

    protected $navigationPathToProductCategory;

    /**
     * @var string Xpath to add a Simple product to the cart from the product's page
     */

    protected $simpleProductAddToCartXpath;

    /**
     * @var string Xpath to add a Simple product to the cart from the category page
     */

    protected $categoryAddToCartButtonXPathSelector;

    /**
     * @var string Xpath to find a product's link on a category page.  Used to navigate to the product from the category
     */

    protected $categoryProductPageXpath;




    /**
     * @var string Xpath used after a product has been added to the cart to verify that the product has been added to the cart
     */

    protected $addToCartSuccessXpath;

    /**
     * @var string The base URL of the installation
     */

    protected $baseUrl;

    protected $myAccountTitle;

    /**
     * @var array Instructions in an Xpath array syntax to get to the login page.
     */
    
    protected $navigateToCustomerPageInstructions            = [];

    /**
     * @var array Instructions in an Xpath array syntax to get to the start of the checkout page
     */

    protected $checkoutNavigationInstructions         = [];

    /**
     * @var array Instructions in an Xpath array syntax to get to the customer registration page
     */

    protected $registrationNavigationInstructions         = [];

    /**
     * @var array Instructions in an Xpath array syntax to get to the customer registration page
     */

    protected $logoutNavigationInstructions         = [];

    protected $registerFirstNameXpath;
    protected $registerLastNameXpath;
    protected $registerEmailXpath;
    protected $registerPasswordXpath;
    protected $registerConfirmPasswordXpath;
    protected $registerNewsletterXpath;
    protected $registerSubmitXpath;

    protected $logoutSuccessXpath;

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

    abstract public function getCustomerThemeClass();
    abstract public function getOnePageCheckoutThemeClass();

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
    public function getCartSummaryCheckoutProductLoopPriceXpath()
    {
        return $this->translate($this->cartSummaryCheckoutProductLoopPriceXpath);
    }

    /**
     * @return string
     */
    public function getCartSummaryCheckoutProductLoopNameXpath()
    {
        return $this->translate($this->cartSummaryCheckoutProductLoopNameXpath);
    }

    /**
     * @return string
     */
    public function getCartSummaryCheckoutProductLoopQtyXpath()
    {
        return $this->translate($this->cartSummaryCheckoutProductLoopQtyXpath);
    }

    /**
     * @return string
     */
    public function getCartSummaryCheckoutProductLoopSubtotalXpath()
    {
        return $this->translate($this->cartSummaryCheckoutProductLoopSubtotalXpath);
    }



    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    /**
     * @return string
     */
    public function getLogoutSuccessXpath()
    {
        return$this->translate( $this->logoutSuccessXpath);
    }

    /**
     * @return array
     */
    public function getLogoutNavigationInstructions()
    {
        return $this->translate($this->logoutNavigationInstructions);
    }


    /**
     * @return string
     */
    public function getMyAccountTitle()
    {
        return $this->translate($this->myAccountTitle);
    }



    /**
     * @return string
     */
    public function getRegisterFirstNameXpath()
    {
        return $this->translate($this->registerFirstNameXpath);
    }

    /**
     * @return string
     */
    public function getRegisterLastNameXpath()
    {
        return $this->translate($this->registerLastNameXpath);
    }

    /**
     * @return string
     */
    public function getRegisterEmailXpath()
    {
        return$this->translate($this->registerEmailXpath);
    }

    /**
     * @return string
     */
    public function getRegisterPasswordXpath()
    {
        return $this->translate($this->registerPasswordXpath);
    }

    /**
     * @return string
     */
    public function getRegisterConfirmPasswordXpath()
    {
        return $this->translate($this->registerConfirmPasswordXpath);
    }

    /**
     * @return string
     */
    public function getRegisterNewsletterXpath()
    {
        return $this->translate($this->registerNewsletterXpath);
    }

    /**
     * @return string
     */
    public function getRegisterSubmitXpath()
    {
        return $this->translate($this->registerSubmitXpath);
    }



    /**
     * @return array
     */
    public function getRegistrationNavigationInstructions()
    {
        return $this->translate($this->registrationNavigationInstructions);
    }



    public function getCheckoutNavigationInstructions()
    {
        return $this->translate($this->checkoutNavigationInstructions);
    }

    public function getProductPageForCategory()
    {
        return $this->translate($this->categoryProductPageXpath);
    }

    public function getAddToCartSuccessXpath()
    {
        return $this->translate($this->addToCartSuccessXpath);
    }
    
    public function getNavigateToCustomerPageInstructions()
    {
        return $this->translate($this->navigateToCustomerPageInstructions);
    }
    
    public function getNavigationBaseXPathSelector()
    {
        return $this->translate($this->navigationBaseXPathSelector);
    }
    
    public function getNavigationChildXPathSelector()
    {
        return $this->translate($this->navigationChildXPathSelector);
    }
    
    public function getNavigationPathToProductCategory()
    {
        return $this->translate($this->navigationPathToProductCategory);
    }
    
    public function getCategoryAddToCartButtonXPathSelector()
    {
        return $this->translate($this->categoryAddToCartButtonXPathSelector);
    }


    public function getSimpleProductAddToCartXpath()
    {
        return $this->translate($this->simpleProductAddToCartXpath);
    }


    
}