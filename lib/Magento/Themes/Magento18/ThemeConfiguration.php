<?php

namespace Magium\Magento\Themes\Magento18;


use Magium\Magento\Themes\AbstractThemeConfiguration;

class ThemeConfiguration extends AbstractThemeConfiguration
{

    const THEME = 'Magium\Magento\Themes\Magento18\ThemeConfiguration';

    protected $homeXpath = '//a[@class="logo"]';

    /**
     * @var string The Xpath string that finds the base of the navigation menu
     */
    protected $navigationBaseXPathSelector          = '//ul[@id="nav"]';

    /**
     * @var string The Xpath string that can be used iteratively to find child navigation nodes
     */

    protected $navigationChildXPathSelector         = 'li[contains(concat(" ",normalize-space(@class)," ")," level%d ")]/a[.="%s"]/..';

    /**
     * @var string A simple, default path to use for categories.
     */

    protected $navigationPathToSimpleProductCategory      = '{{Electronics}}/{{Cell Phones}}';

    protected $defaultSimpleProductName = '{{Nokia 2610 Phone}}';

    protected $navigationPathToConfigurableProductCategory      = '{{Apparel}}/{{Shirts}}';

    protected $defaultConfigurableProductName = '{{Zolof The Rock And Roll Destroyer: LOL Cat T-shirt}}';

    /**
     * @var string Xpath to add a Simple product to the cart from the product's page
     */

    protected $addToCartXpath          = '//button[@title="{{Add to Cart}}" and @onclick]';

    /**
     * @var string Xpath to add a Simple product to the cart from the category page
     */

    protected $categoryAddToCartButtonXPathSelector = '//button[@title="{{Add to Cart}}" and @onclick]';

    /**
     * @var string Xpath to find a product's link on a category page.  Used to navigate to the product from the category
     */

    protected $categoryProductPageXpath             = '//h2[@class="product-name"]/descendant::a';

    protected $categorySpecificProductPageXpath             = '//h2[@class="product-name"]/descendant::a[.="%s"]';

    /**
     * @var string Xpath used after a product has been added to the cart to verify that the product has been added to the cart
     */

    protected $addToCartSuccessXpath        = '//li[@class="success-msg" and contains(., "{{was added to your shopping cart}}")]';

    /**
     * @var string The base URL of the installation
     */

    protected $baseUrl                      = 'http://localhost/';

    protected $myAccountTitle               = '{{My Account}}';

    protected $registerFirstNameXpath           = '//input[@id="firstname"]';
    protected $registerLastNameXpath            = '//input[@id="lastname"]';
    protected $registerEmailXpath               = '//input[@id="email_address"]';
    protected $registerPasswordXpath            = '//input[@id="password"]';
    protected $registerConfirmPasswordXpath     = '//input[@id="confirmation"]';
    protected $registerNewsletterXpath          = '//input[@id="is_subscribed"]';
    protected $registerSubmitXpath              = '//button[@type="submit" and @title="{{Submit}}"]';

    protected $logoutSuccessXpath               = '//div[contains(concat(" ",normalize-space(@class)," ")," page-title ")]/descendant::h1[.="{{You are now logged out}}"]';

    protected $layeredNavigationTestXpath       = '//dl[@id="narrow-by-list"]';

    /**
     * @var array Instructions in an Xpath array syntax to get to the customer registration page
     */

    protected $logoutNavigationInstructions         = [
        [\Magium\WebDriver\WebDriver::INSTRUCTION_MOUSE_CLICK, '//ul[@class="links"]/descendant::a[.="{{Log Out}}"]'],
//        [\Magium\WebDriver\WebDriver::INSTRUCTION_MOUSE_CLICK, '//div[@id="header-account"]/descendant::a[@title="{{Log Out}}"]']
    ];

    protected $cartNavigationInstructions            = [
        [\Magium\WebDriver\WebDriver::INSTRUCTION_MOUSE_CLICK, '//a[@class="top-link-cart"]']
    ];

    /**
     * @var array Instructions in an Xpath array syntax to get to the login page.
     */
    
    protected $navigateToCustomerPageInstructions            = [
        [\Magium\WebDriver\WebDriver::INSTRUCTION_MOUSE_CLICK, '//ul[@class="links"]/descendant::a[.="{{My Account}}"]'],
        //[\Magium\WebDriver\WebDriver::INSTRUCTION_MOUSE_CLICK, '//div[@id="header-account"]/descendant::a[@title="My Account"]']
    ];

    /**
     * @var array Instructions in an Xpath array syntax to get to the start of the checkout page
     */

    protected $checkoutNavigationInstructions         = [
        [\Magium\WebDriver\WebDriver::INSTRUCTION_MOUSE_CLICK, '//ul[@class="links"]/descendant::a[@title="{{Checkout}}"]'],
//        [\Magium\WebDriver\WebDriver::INSTRUCTION_MOUSE_CLICK, '//div[@class="minicart-actions"]/descendant::a[@title="Checkout"]']
    ];


    /**
     * @var array Instructions in an Xpath array syntax to get to the customer registration page
     */

    protected $registrationNavigationInstructions         = [
        [\Magium\WebDriver\WebDriver::INSTRUCTION_MOUSE_CLICK, '//ul[@class="links"]/descendant::a[.="{{My Account}}"]'],
        [\Magium\WebDriver\WebDriver::INSTRUCTION_MOUSE_CLICK, '//button[@title="{{Create an Account}}"]']
    ];


    /**
     * This is a hard one.  Each of the summary checkout products will be iterated over until they cannot be found. Having
     * this work in a manner that gets all of the products, in all languages, in all themes, is quite difficult and
     * so the Xpath selector needs to be one that can find each individual column with an incrementing iterator.
     *
     * @see Magium\Magento\Actions\Checkout\Extractors\CartSummary for an example on how this is done
     *
     * @var string
     */

    protected $cartSummaryCheckoutProductLoopPriceXpath = '(//table[@id="checkout-review-table"]/tbody/descendant::td[@data-rwd-label="Price"])[%d]';
    protected $cartSummaryCheckoutProductLoopNameXpath = '(//table[@id="checkout-review-table"]/tbody/descendant::td/h3)[%d]';
    protected $cartSummaryCheckoutProductLoopQtyXpath = '(//table[@id="checkout-review-table"]/tbody/descendant::td[@data-rwd-label="Qty"])[%d]';
    protected $cartSummaryCheckoutProductLoopSubtotalXpath = '(//table[@id="checkout-review-table"]/tbody/descendant::td[@data-rwd-label="Subtotal"])[%d]';

    protected $cartSummaryCheckoutSubTotal              = '//table[@id="checkout-review-table"]/tfoot/tr/td[concat(" ",normalize-space(.)," ") = " Subtotal "]/../td[2]';
    protected $cartSummaryCheckoutTax              = '//table[@id="checkout-review-table"]/tfoot/tr/td[concat(" ",normalize-space(.)," ") = " Tax "]/../td[2]';
    protected $cartSummaryCheckoutGrandTotal              = '//table[@id="checkout-review-table"]/tfoot/tr/td[concat(" ",normalize-space(.)," ") = " Grand Total "]/../td[2]';
    protected $cartSummaryCheckoutShippingTotal              = '//table[@id="checkout-review-table"]/tfoot/tr/td[contains(concat(" ",normalize-space(.)," "), " Shipping & Handling (")]/../td[2]';

    protected $breadCrumbXpath                  = '//div[@class="breadcrumbs"]';

    protected $productListBaseXpath             = '//ol[contains(concat(" ",normalize-space(@class)," ")," products-list ")]/li[%d]';
    protected $productListDescriptionXpath      = '/descendant::div[contains(concat(" ",normalize-space(@class)," ")," desc ")]';
    protected $productListTitleXpath            = '/descendant::h2[@class="product-name"]/a';
    protected $productListCompareLinkXpath      = '/descendant::ul[@class="add-to-links"]/descendant::a[@class="link-compare"]';
    protected $productListImageXpath            = '/descendant::a[@class="product-image"]/img';
    protected $productListLinkXpath             = '/descendant::a[@class="product-image"]';
    protected $productListOriginalPriceXpath    = '/descendant::div[@class="price-box"]/descendant::p[@class="old-price"]/descendant::*[@class="price"]';
    protected $productListPriceXpath            = '/descendant::div[@class="price-box"]/descendant::*[@class="regular-price" or @class="special-price"]/descendant::span[@class="price"]';
    protected $productListWishlistLinkXpath     = '/descendant::ul[@class="add-to-links"]/descendant::a[@class="link-wishlist"]';
    protected $productListAddToCartLinkXpath     = '/descendant::div[@class="product-shop"]/descendant::button[contains(concat(" ",normalize-space(@class)," ")," btn-cart ")]';

    protected $productGridBaseXpath             = '//ul[contains(concat(" ",normalize-space(@class)," ")," products-grid ")]/li[%d]';
    protected $productGridDescriptionXpath      = '/*[.="no description in the grid view"]';
    protected $productGridTitleXpath            = '/descendant::h2[@class="product-name"]/a';
    protected $productGridCompareLinkXpath      = '/descendant::ul[@class="add-to-links"]/descendant::a[@class="link-compare"]';
    protected $productGridImageXpath            = '/descendant::a[@class="product-image"]/img';
    protected $productGridLinkXpath             = '/descendant::a[@class="product-image"]';
    protected $productGridOriginalPriceXpath    = '/descendant::div[@class="price-box"]/descendant::p[@class="old-price"]/descendant::*[@class="price"]';
    protected $productGridPriceXpath            = '/descendant::div[@class="price-box"]/descendant::*[@class="regular-price" or @class="special-price"]/descendant::span[@class="price"]';
    protected $productGridWishlistLinkXpath     = '/descendant::ul[@class="add-to-links"]/descendant::a[@class="link-wishlist"]';
    protected $productGridAddToCartLinkXpath     = '/descendant::div[@class="actions"]/descendant::button[contains(concat(" ",normalize-space(@class)," ")," btn-cart ")]';

    protected $productCollectionViewModeXpath   = '//p[@class="view-mode"]/strong';
    protected $productCollectionSortByXpath     = '//div[@class="sort-by"]/descendant::option[@selected]'; // We select using the div, not the title because the title may be translated
    protected $productCollectionShowCountXpath  = '//div[@class="limiter"]/descendant::option[@selected]'; // dittos
    protected $productCollectionShowCountOptionsXpath  = '//div[@class="limiter"]/descendant::option';
    protected $productCollectionProductCountXpath = '//div[contains(concat(" ",normalize-space(@class)," ")," pager ")]/descendant::p[contains(concat(" ",normalize-space(@class)," ")," amount ")]';

    protected $layeredNavigationBaseXpath        = '//div[contains(concat(" ",normalize-space(@class)," ")," block-layered-nav ")]';

    protected $searchInputXpath                 = '//input[@id="search"]';
    protected $searchSubmitXpath                = '//form[@id="search_mini_form"]/descendant::button[@title="Search"]';

    protected $searchSuggestionTextXpath        = '//div[@id="search_autocomplete"]/descendant::li[@title][%d]';
    protected $searchSuggestionCountXpath       = '//div[@id="search_autocomplete"]/descendant::li[@title][%d]/span[@class="amount"]';

    protected $simpleProductQtyXpath = '//input[@id="qty"]';

    protected $configurableProductLabelXpath = '//div[@id="product-options-wrapper"]/descendant::label';

    protected $configurableProductOptionXpath = '(%s)[%d]/ancestor::dt/following-sibling::dd[1]/descendant::option[starts-with(., "%s")]';

    protected $viewModeAttributeName = 'class';

    protected $breadCrumbMemberXpath = '/descendant::a[concat(" ",normalize-space(.)," ")=" {{%s}} "]';
    protected $breadCrumbSelectorXpath = '/descendant::a[%d]';

    protected $layeredNavigationFilterNameXpath =  '//dl[@id="narrow-by-list"]/dt';

    protected $layeredNavigationFilterTypesXpath = '//dt[.="%s"]/following-sibling::dd[1]/descendant::li';
    protected $layeredNavigationFilterLinkXpath = '//dt[.="%s"]/following-sibling::dd[1]/descendant::li/descendant::a';
    protected $layeredNavigationFilterNameElementXpath =  '//dl[@id="narrow-by-list"]/dt[normalize-space(.) = "%s"]';

    protected $storeSwitcherInstructionsXpath   = [
        [\Magium\WebDriver\WebDriver::INSTRUCTION_MOUSE_CLICK, '//select[@id="select-language"]/descendant::option[contains(@href,"___store=%s"]'],
    ];

    public function getCustomerThemeClass()
    {
        return 'Magium\Magento\Themes\Magento18\Customer\ThemeConfiguration';
    }

    public function getCheckoutThemeClass()
    {
        return 'Magium\Magento\Themes\Magento18\OnePageCheckout\ThemeConfiguration';
    }
    
}