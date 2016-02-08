<?php

namespace Magium\Magento\Themes\MagentoEE113;


use Magium\Magento\Themes\AbstractThemeConfiguration;

class ThemeConfiguration extends AbstractThemeConfiguration
{

    const THEME = 'Magium\Magento\Themes\MagentoEE113\ThemeConfiguration';

    public $homeXpath = '//a[@class="logo"]';

    /**
     * @var string The Xpath string that finds the base of the navigation menu
     */
    public $navigationBaseXPathSelector          = '//ul[@id="nav"]';

    /**
     * @var string The Xpath string that can be used iteratively to find child navigation nodes
     */

    public $navigationChildXPathSelector         = 'a[concat(" ",normalize-space(.)," ") = " %s "]/..';

    /**
     * @var string A simple, default path to use for categories.
     */

    public $navigationPathToSimpleProductCategory      = '{{Electronics}}/{{Cell Phones}}';

    public $defaultSimpleProductName = '{{Nokia 2610 Phone}}';

    public $navigationPathToConfigurableProductCategory      = '{{Apparel}}/{{Shirts}}';

    public $defaultConfigurableProductName = '{{Zolof The Rock And Roll Destroyer: LOL Cat T-shirt}}';

    /**
     * @var string Xpath to add a Simple product to the cart from the product's page
     */

    public $addToCartXpath          = '//button[@title="{{Add to Cart}}" and contains(concat(" ",normalize-space(@class)," ")," btn-cart ")]';

    /**
     * @var string Xpath to add a Simple product to the cart from the category page
     */

    public $categoryAddToCartButtonXPathSelector = '//button[@title="{{Add to Cart}}" and contains(concat(" ",normalize-space(@class)," ")," btn-cart ")]';

    /**
     * @var string Xpath to find a product's link on a category page.  Used to navigate to the product from the category
     */

    public $categoryProductPageXpath             = '//h2[@class="product-name"]/descendant::a';

    public $categorySpecificProductPageXpath             = '//h2[@class="product-name"]/descendant::a[.="%s"]';

    /**
     * @var string Xpath used after a product has been added to the cart to verify that the product has been added to the cart
     */

    public $addToCartSuccessXpath        = '//li[@class="success-msg" and contains(., "{{was added to your shopping cart}}")]';

    /**
     * @var string The base URL of the installation
     */

    public $baseUrl                      = 'http://localhost/';

    public $myAccountTitle               = '{{My Account}}';

    public $registerFirstNameXpath           = '//input[@id="firstname"]';
    public $registerLastNameXpath            = '//input[@id="lastname"]';
    public $registerEmailXpath               = '//input[@id="email_address"]';
    public $registerPasswordXpath            = '//input[@id="password"]';
    public $registerConfirmPasswordXpath     = '//input[@id="confirmation"]';
    public $registerNewsletterXpath          = '//input[@id="is_subscribed"]';
    public $registerSubmitXpath              = '//button[@type="submit" and @title="{{Submit}}"]';

    public $logoutSuccessXpath               = '//div[contains(concat(" ",normalize-space(@class)," ")," page-title ")]/descendant::h1[.="{{You are now logged out}}"]';

    public $layeredNavigationTestXpath       = '//dl[@id="narrow-by-list"]';

    /**
     * @var array Instructions in an Xpath array syntax to get to the customer registration page
     */

    public $logoutNavigationInstructions         = [
        [\Magium\WebDriver\WebDriver::INSTRUCTION_MOUSE_CLICK, '//ul[@class="links"]/descendant::a[.="{{Log Out}}"]'],
//        [\Magium\WebDriver\WebDriver::INSTRUCTION_MOUSE_CLICK, '//div[@id="header-account"]/descendant::a[@title="{{Log Out}}"]']
    ];

    public $cartNavigationInstructions            = [
        [\Magium\WebDriver\WebDriver::INSTRUCTION_MOUSE_CLICK, '//string[@id="cartHeader"]'],
        [\Magium\WebDriver\WebDriver::INSTRUCTION_MOUSE_CLICK, '//div[@id="topCartContent"]/descendant::a/span[.="{{Go to Shopping Cart}}"]']
    ];

    /**
     * @var array Instructions in an Xpath array syntax to get to the login page.
     */
    
    public $navigateToCustomerPageInstructions            = [
        [\Magium\WebDriver\WebDriver::INSTRUCTION_MOUSE_CLICK, '//ul[@class="links"]/descendant::a[.="{{My Account}}"]'],
        //[\Magium\WebDriver\WebDriver::INSTRUCTION_MOUSE_CLICK, '//div[@id="header-account"]/descendant::a[@title="My Account"]']
    ];

    /**
     * @var array Instructions in an Xpath array syntax to get to the start of the checkout page
     */

    public $checkoutNavigationInstructions         = [
        [\Magium\WebDriver\WebDriver::INSTRUCTION_MOUSE_CLICK, '//ul[@class="links"]/descendant::a[@title="{{Checkout}}"]'],
//        [\Magium\WebDriver\WebDriver::INSTRUCTION_MOUSE_CLICK, '//div[@class="minicart-actions"]/descendant::a[@title="Checkout"]']
    ];


    /**
     * @var array Instructions in an Xpath array syntax to get to the customer registration page
     */

    public $registrationNavigationInstructions         = [
        [\Magium\WebDriver\WebDriver::INSTRUCTION_MOUSE_CLICK, '//ul[@class="links"]/descendant::a[.="{{My Account}}"]'],
        [\Magium\WebDriver\WebDriver::INSTRUCTION_MOUSE_CLICK, '//button/span/span[.="{{Register}}"]/../..']
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

    public $cartSummaryCheckoutProductLoopPriceXpath = '(//table[@id="checkout-review-table"]/tbody/descendant::td[@data-rwd-label="Price"])[%d]';
    public $cartSummaryCheckoutProductLoopNameXpath = '(//table[@id="checkout-review-table"]/tbody/descendant::td/h3)[%d]';
    public $cartSummaryCheckoutProductLoopQtyXpath = '(//table[@id="checkout-review-table"]/tbody/descendant::td[@data-rwd-label="Qty"])[%d]';
    public $cartSummaryCheckoutProductLoopSubtotalXpath = '(//table[@id="checkout-review-table"]/tbody/descendant::td[@data-rwd-label="Subtotal"])[%d]';

    public $cartSummaryCheckoutSubTotal              = '//table[@id="checkout-review-table"]/tfoot/tr/td[concat(" ",normalize-space(.)," ") = " Subtotal "]/../td[2]';
    public $cartSummaryCheckoutTax              = '//table[@id="checkout-review-table"]/tfoot/tr/td[concat(" ",normalize-space(.)," ") = " Tax "]/../td[2]';
    public $cartSummaryCheckoutGrandTotal              = '//table[@id="checkout-review-table"]/tfoot/tr/td[concat(" ",normalize-space(.)," ") = " Grand Total "]/../td[2]';
    public $cartSummaryCheckoutShippingTotal              = '//table[@id="checkout-review-table"]/tfoot/tr/td[contains(concat(" ",normalize-space(.)," "), " Shipping & Handling (")]/../td[2]';

    public $breadCrumbXpath                  = '//div[@class="breadcrumbs"]';

    public $productListBaseXpath             = '//ol[contains(concat(" ",normalize-space(@class)," ")," products-list ")]/li[%d]';
    public $productListDescriptionXpath      = '/descendant::div[contains(concat(" ",normalize-space(@class)," ")," desc ")]';
    public $productListTitleXpath            = '/descendant::h2[@class="product-name"]/a';
    public $productListCompareLinkXpath      = '/descendant::ul[@class="add-to-links"]/descendant::a[@class="link-compare"]';
    public $productListImageXpath            = '/descendant::a[@class="product-image"]/img';
    public $productListLinkXpath             = '/descendant::a[@class="product-image"]';
    public $productListOriginalPriceXpath    = '/descendant::div[@class="price-box"]/descendant::p[@class="old-price"]/descendant::*[@class="price"]';
    public $productListPriceXpath            = '/descendant::div[@class="price-box"]/descendant::*[@class="regular-price" or @class="special-price"]/descendant::span[@class="price"]';
    public $productListWishlistLinkXpath     = '/descendant::ul[@class="add-to-links"]/descendant::a[@class="link-wishlist"]';
    public $productListAddToCartLinkXpath     = '/descendant::div[@class="product-shop"]/descendant::button[contains(concat(" ",normalize-space(@class)," ")," btn-cart ")]';

    public $productGridBaseXpath             = '//ul[contains(concat(" ",normalize-space(@class)," ")," products-grid ")]/li[%d]';
    public $productGridDescriptionXpath      = '/*[.="no description in the grid view"]';
    public $productGridTitleXpath            = '/descendant::h2[@class="product-name"]/a';
    public $productGridCompareLinkXpath      = '/descendant::ul[@class="add-to-links"]/descendant::a[@class="link-compare"]';
    public $productGridImageXpath            = '/descendant::a[@class="product-image"]/img';
    public $productGridLinkXpath             = '/descendant::a[@class="product-image"]';
    public $productGridOriginalPriceXpath    = '/descendant::div[@class="price-box"]/descendant::p[@class="old-price"]/descendant::*[@class="price"]';
    public $productGridPriceXpath            = '/descendant::div[@class="price-box"]/descendant::*[@class="regular-price" or @class="special-price"]/descendant::span[@class="price"]';
    public $productGridWishlistLinkXpath     = '/descendant::ul[@class="add-to-links"]/descendant::a[@class="link-wishlist"]';
    public $productGridAddToCartLinkXpath     = '/descendant::div[@class="actions"]/descendant::button[contains(concat(" ",normalize-space(@class)," ")," btn-cart ")]';

    public $productCollectionViewModeXpath   = '//p[@class="view-mode"]/strong';
    public $productCollectionSortByXpath     = '//div[@class="sort-by"]/descendant::option[@selected]'; // We select using the div, not the title because the title may be translated
    public $productCollectionShowCountXpath  = '//div[@class="limiter"]/descendant::option[@selected]'; // dittos
    public $productCollectionShowCountOptionsXpath  = '//div[@class="limiter"]/descendant::option';
    public $productCollectionProductCountXpath = '//div[contains(concat(" ",normalize-space(@class)," ")," pager ")]/descendant::p[contains(concat(" ",normalize-space(@class)," ")," amount ")]';

    public $layeredNavigationBaseXpath        = '//div[contains(concat(" ",normalize-space(@class)," ")," block-layered-nav ")]';

    public $searchInputXpath                 = '//input[@id="search"]';
    public $searchSubmitXpath                = '//form[@id="search_mini_form"]/descendant::button[@type="submit"]';

    public $searchSuggestionTextXpath        = '//div[@id="search_autocomplete"]/descendant::li[@title][%d]';
    public $searchSuggestionCountXpath       = '//div[@id="search_autocomplete"]/descendant::li[@title][%d]/span[@class="amount"]';

    public $simpleProductQtyXpath = '//input[@id="qty"]';

    public $configurableProductLabelXpath = '//fieldset[@id="product-options-wrapper"]/descendant::label';

    public $configurableProductOptionXpath = '(%s)[%d]/ancestor::dt/following-sibling::dd[1]/descendant::option[starts-with(., "%s")]';

    public $viewModeAttributeName = 'class';

    public $breadCrumbMemberXpath = '/descendant::a[concat(" ",normalize-space(.)," ")=" {{%s}} "]';
    public $breadCrumbSelectorXpath = '/descendant::a[%d]';

    public $layeredNavigationFilterNameXpath =  '//dl[@id="narrow-by-list"]/dt';

    public $layeredNavigationFilterTypesXpath = '//dt[.="%s"]/following-sibling::dd[1]/descendant::li';
    public $layeredNavigationFilterLinkXpath = '//dt[.="%s"]/following-sibling::dd[1]/descendant::li/descendant::a';
    public $layeredNavigationFilterNameElementXpath =  '//dl[@id="narrow-by-list"]/dt[normalize-space(.) = "%s"]';

    public $storeSwitcherInstructionsXpath   = [
        [\Magium\WebDriver\WebDriver::INSTRUCTION_MOUSE_CLICK, '//select[@id="select-language"]/descendant::option[contains(@href,"___store=%s"]'],
    ];

    public function getCustomerThemeClass()
    {
        return 'Magium\Magento\Themes\MagentoEE113\Customer\ThemeConfiguration';
    }

    public function getCheckoutThemeClass()
    {
        return 'Magium\Magento\Themes\MagentoEE113\OnePageCheckout\ThemeConfiguration';
    }
    
}