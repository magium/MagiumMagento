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

    protected $categorySpecificProductPageXpath;


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

    protected $layeredNavigationTestXpath;

    protected $breadCrumbXpath;

    protected $productListBaseXpath;
    protected $productListDescriptionXpath;
    protected $productListTitleXpath;
    protected $productListCompareLinkXpath;
    protected $productListImageXpath;
    protected $productListLinkXpath;
    protected $productListOriginalPriceXpath;
    protected $productListPriceXpath;
    protected $productListWishlistLinkXpath;
    protected $productListAddToCartLinkXpath;

    protected $productGridBaseXpath;
    protected $productGridDescriptionXpath;
    protected $productGridTitleXpath;
    protected $productGridCompareLinkXpath;
    protected $productGridImageXpath;
    protected $productGridLinkXpath;
    protected $productGridOriginalPriceXpath;
    protected $productGridPriceXpath;
    protected $productGridWishlistLinkXpath;
    protected $productGridAddToCartLinkXpath;

    protected $productCollectionViewModeXpath;
    protected $productCollectionSortByXpath;
    protected $productCollectionShowCountXpath;
    protected $productCollectionShowCountOptionsXpath;
    protected $productCollectionProductCountXpath;

    protected $layeredNavigationBaseXpath;


    abstract public function getCustomerThemeClass();
    abstract public function getOnePageCheckoutThemeClass();

    /**
     * @return mixed
     */
    public function getCategorySpecificProductPageXpath($productName)
    {
        $xpath = sprintf($this->categorySpecificProductPageXpath, $productName);
        return $this->translate($xpath);
    }



    /**
     * @return mixed
     */
    public function getLayeredNavigationBaseXpath()
    {
        return $this->layeredNavigationBaseXpath;
    }

    public function set($name, $value)
    {
        $this->$name = $value;
    }

    /**
     * @return mixed
     */
    public function getProductCollectionViewModeXpath()
    {
        return $this->productCollectionViewModeXpath;
    }

    /**
     * @return mixed
     */
    public function getProductCollectionSortByXpath()
    {
        return $this->productCollectionSortByXpath;
    }

    /**
     * @return mixed
     */
    public function getProductCollectionShowCountXpath()
    {
        return $this->productCollectionShowCountXpath;
    }

    /**
     * @return mixed
     */
    public function getProductCollectionShowCountOptionsXpath()
    {
        return $this->productCollectionShowCountOptionsXpath;
    }

    /**
     * @return mixed
     */
    public function getProductCollectionProductCountXpath()
    {
        return $this->productCollectionProductCountXpath;
    }



    /**
     * @return mixed
     */
    public function getProductListAddToCartLinkXpath($count)
    {
        return sprintf($this->productListBaseXpath . $this->productListAddToCartLinkXpath, $count);
    }

    /**
     * @return mixed
     */
    public function getProductGridAddToCartLinkXpath($count)
    {
        return sprintf($this->productGridBaseXpath . $this->productGridAddToCartLinkXpath, $count);
    }

    /**
     * @return mixed
     */
    public function getProductListDescriptionXpath($count)
    {
        return sprintf($this->productListBaseXpath . $this->productListDescriptionXpath, $count);
    }

    /**
     * @return mixed
     */
    public function getProductListTitleXpath($count)
    {
        return sprintf($this->productListBaseXpath . $this->productListTitleXpath, $count);
    }

    /**
     * @return mixed
     */
    public function getProductListCompareLinkXpath($count)
    {
        return sprintf($this->productListBaseXpath . $this->productListCompareLinkXpath, $count);
    }

    /**
     * @return mixed
     */
    public function getProductListImageXpath($count)
    {
        return sprintf($this->productListBaseXpath . $this->productListImageXpath, $count);
    }

    /**
     * @return mixed
     */
    public function getProductListLinkXpath($count)
    {
        return sprintf($this->productListBaseXpath . $this->productListLinkXpath, $count);
    }

    /**
     * @return mixed
     */
    public function getProductListOriginalPriceXpath($count)
    {
        return sprintf($this->productListBaseXpath . $this->productListOriginalPriceXpath, $count);
    }

    /**
     * @return mixed
     */
    public function getProductListPriceXpath($count)
    {
        return sprintf($this->productListBaseXpath . $this->productListPriceXpath, $count);
    }

    /**
     * @return mixed
     */
    public function getProductListWishlistLinkXpath($count)
    {
        return sprintf($this->productListBaseXpath . $this->productListWishlistLinkXpath, $count);
    }

    /**
     * @return mixed
     */
    public function getProductGridDescriptionXpath($count)
    {
        return sprintf($this->productGridBaseXpath . $this->productGridDescriptionXpath, $count);
    }

    /**
     * @return mixed
     */
    public function getProductGridTitleXpath($count)
    {
        return sprintf($this->productGridBaseXpath . $this->productGridTitleXpath, $count);
    }

    /**
     * @return mixed
     */
    public function getProductGridCompareLinkXpath($count)
    {
        return sprintf($this->productGridBaseXpath . $this->productGridCompareLinkXpath, $count);
    }

    /**
     * @return mixed
     */
    public function getProductGridImageXpath($count)
    {
        return sprintf($this->productGridBaseXpath . $this->productGridImageXpath, $count);
    }

    /**
     * @return mixed
     */
    public function getProductGridLinkXpath($count)
    {
        return sprintf($this->productGridBaseXpath . $this->productGridLinkXpath, $count);
    }

    /**
     * @return mixed
     */
    public function getProductGridOriginalPriceXpath($count)
    {
        return sprintf($this->productGridBaseXpath . $this->productGridOriginalPriceXpath, $count);
    }

    /**
     * @return mixed
     */
    public function getProductGridPriceXpath($count)
    {
        return sprintf($this->productGridBaseXpath . $this->productGridPriceXpath, $count);
    }

    /**
     * @return mixed
     */
    public function getProductGridWishlistLinkXpath($count)
    {
        return sprintf($this->productGridBaseXpath . $this->productGridWishlistLinkXpath, $count);
    }

    /**
     * @return mixed
     */
    public function getBreadCrumbXpath()
    {
        return $this->breadCrumbXpath;
    }

    /**
     * @return mixed
     */
    public function getLayeredNavigationTestXpath()
    {
        return $this->layeredNavigationTestXpath;
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
    
    public function getNavigationChildXPathSelector($level, $text)
    {
        $return = sprintf($this->navigationChildXPathSelector, $level, $text);
        return $this->translate($return);
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