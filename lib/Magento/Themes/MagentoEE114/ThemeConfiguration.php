<?php

namespace Magium\Magento\Themes\MagentoEE114;


use Magium\Magento\Themes\AbstractThemeConfiguration;

class ThemeConfiguration extends AbstractThemeConfiguration
{

    const THEME = 'Magium\Magento\Themes\MagentoEE114\ThemeConfiguration';

    public $homeXpath = '//a[@class="logo"]';

    /**
     * @var string The Xpath string that finds the base of the navigation menu
     */
    public $navigationBaseXPathSelector          = '//nav[@id="nav"]/ol';

    /**
     * @var string The Xpath string that can be used iteratively to find child navigation nodes
     */

    public $navigationChildXPathSelector         = 'a[concat(" ",normalize-space(.)," ") = " %s "]/..';

    /**
     * @var string A simple, default path to use for categories.
     */

    public $navigationPathToSimpleProductCategory      = '{{Accessories}}/{{Jewelry}}';
    public $navigationPathToConfigurableProductCategory      = '{{Men}}/{{Shirts}}';

    public $productPagePriceXpath = '(//form[@id="product_addtocart_form"]/descendant::span[contains(concat(" ",normalize-space(@class)," ")," regular-price ")]/span[contains(concat(" ",normalize-space(@class)," ")," price ")])[1]';

    public $defaultSimpleProductName = '{{Blue Horizons Bracelets}}';
    public $defaultConfigurableProductName = '{{Plaid Cotton Shirt}}';

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

    public $myAccountTitle               = 'My Account';

    /**
     * @var array Instructions in an Xpath array syntax to get to the login page.
     */
    
    public $navigateToCustomerPageInstructions            = [
        [\Magium\WebDriver\WebDriver::INSTRUCTION_MOUSE_CLICK, '//div[@class="account-cart-wrapper"]/descendant::span[.="{{Account}}"]'],
        [\Magium\WebDriver\WebDriver::INSTRUCTION_MOUSE_CLICK, '//div[@id="header-account"]/descendant::a[@title="{{My Account}}"]']
    ];

    public $cartNavigationInstructions            = [
        [\Magium\WebDriver\WebDriver::INSTRUCTION_MOUSE_CLICK, '//div[@class="account-cart-wrapper"]/descendant::span[.="{{Account}}"]'],
        [\Magium\WebDriver\WebDriver::INSTRUCTION_MOUSE_CLICK, '//div[@id="header-account"]/descendant::a[contains(concat(" ",normalize-space(@class)," ")," top-link-cart ")]']
    ];

    /**
     * @var array Instructions in an Xpath array syntax to get to the start of the checkout page
     */

    public $checkoutNavigationInstructions         = [
        [\Magium\WebDriver\WebDriver::INSTRUCTION_MOUSE_CLICK, '//div[@class="header-minicart"]/descendant::span[.="{{Cart}}"]'],
        [\Magium\WebDriver\WebDriver::INSTRUCTION_MOUSE_CLICK, '//div[@class="minicart-actions"]/descendant::a[@title="{{Checkout}}"]']
    ];

    /**
     * @var array Instructions in an Xpath array syntax to get to the customer registration page
     */

    public $registrationNavigationInstructions         = [
        [\Magium\WebDriver\WebDriver::INSTRUCTION_MOUSE_CLICK, '//div[@class="account-cart-wrapper"]/descendant::span[.="{{Account}}"]'],
        [\Magium\WebDriver\WebDriver::INSTRUCTION_MOUSE_CLICK, '//div[@id="header-account"]/descendant::a[@title="{{Register}}"]']
    ];

    /**
     * @var array Instructions in an Xpath array syntax to get to the customer registration page
     */

    public $logoutNavigationInstructions         = [
        [\Magium\WebDriver\WebDriver::INSTRUCTION_MOUSE_CLICK, '//div[@class="account-cart-wrapper"]/descendant::span[.="{{Account}}"]'],
        [\Magium\WebDriver\WebDriver::INSTRUCTION_MOUSE_CLICK, '//div[@id="header-account"]/descendant::a[@title="{{Log Out}}"]']
    ];

    public $registerFirstNameXpath           = '//input[@id="firstname"]';
    public $registerLastNameXpath            = '//input[@id="lastname"]';
    public $registerEmailXpath               = '//input[@id="email_address"]';
    public $registerPasswordXpath            = '//input[@id="password"]';
    public $registerConfirmPasswordXpath     = '//input[@id="confirmation"]';
    public $registerNewsletterXpath          = '//input[@id="is_subscribed"]';
    public $registerSubmitXpath              = '//button[@type="submit" and @title="{{Register}}"]';

    public $logoutSuccessXpath               = '//div[contains(concat(" ",normalize-space(@class)," ")," page-title ")]/descendant::h1[.="{{You are now logged out}}"]';

    public $layeredNavigationTestXpath       = '//dl[@id="narrow-by-list"]';

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
    public $productListAddToCartLinkXpath     = '/descendant::p[@class="action"]/descendant::button[contains(concat(" ",normalize-space(@class)," ")," btn-cart ")]';

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
    public $searchSubmitXpath                = '//form[@id="search_mini_form"]/descendant::button[@title="Search"]';

    public $searchSuggestionTextXpath        = '//div[@id="search_autocomplete"]/descendant::li[@title][%d]';
    public $searchSuggestionCountXpath       = '//div[@id="search_autocomplete"]/descendant::li[@title][%d]/span[@class="amount"]';

    public $simpleProductQtyXpath = '//input[@id="qty"]';

    public $configurableProductLabelXpath = '//div[@id="product-options-wrapper"]/descendant::label';
    public $configurableSwatchSelectorXpath = '(%s)[%d]/ancestor::dt/following-sibling::dd[1]/descendant::a[%d]';
    public $configurableSwatchImgXpath = '(%s)[%d]/ancestor::dt/following-sibling::dd[1]/descendant::a[%d]/descendant::img';
    public $configurableSwatchNotAvailableXpath =  '(%s)[%d]/ancestor::dt/following-sibling::dd[1]/descendant::a[%d]/ancestor::li[contains(concat(" ",normalize-space(@class)," ")," not-available ")]';

    public $configurableProductOptionXpath = '(%s)[%d]/ancestor::dt/following-sibling::dd[1]/descendant::option[starts-with(., "%s")]';
    public $configurableSwatchOptionLabelAttributeName = 'title';

    public $viewModeAttributeName = 'class';

    public $breadCrumbMemberXpath = '/descendant::a[concat(" ",normalize-space(.)," ")=" {{%s}} "]';
    public $breadCrumbSelectorXpath = '/descendant::a[%d]';

    public $layeredNavigationFilterNameXpath =  '//dl[@id="narrow-by-list"]/dt';

    public $layeredNavigationFilterTypesXpath = '//dt[.="%s"]/following-sibling::dd[1]/descendant::li';
    public $layeredNavigationSwatchFilterTypesXpath = '//dt[.="%s"]/following-sibling::dd[1]/descendant::li';
    public $layeredNavigationFilterLinkXpath = '//dt[.="%s"]/following-sibling::dd[1]/descendant::li/descendant::a';
    public $layeredNavigationFilterNameElementXpath =  '//dl[@id="narrow-by-list"]/dt[normalize-space(.) = "%s"]';

    public $layeredNavigationSwatchAppliesXpath = '//dt[.="%s"]/following-sibling::dd[1]/descendant::ol[contains(concat(" ",normalize-space(@class)," ")," configurable-swatch-list ")]';
    public $layeredNavigationSwatchTitleAttribute = 'title';

    public $storeSwitcherInstructionsXpath   = [
        [\Magium\WebDriver\WebDriver::INSTRUCTION_MOUSE_CLICK, '//select[@id="select-language"]/descendant::option[contains(@value,"___store=%s")]'],
    ];

    public function getCustomerThemeClass()
    {
        return 'Magium\Magento\Themes\MagentoEE114\Customer\ThemeConfiguration';
    }

    public function getCheckoutThemeClass()
    {
        return 'Magium\Magento\Themes\MagentoEE114\OnePageCheckout\ThemeConfiguration';
    }

}
