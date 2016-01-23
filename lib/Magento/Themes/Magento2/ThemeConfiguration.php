<?php

namespace Magium\Magento\Themes\Magento2;


use Magium\AbstractTestCase;
use Magium\Magento\Actions\Checkout\CustomerCheckout;
use Magium\Magento\Actions\Checkout\GuestCheckout;
use Magium\Magento\Actions\Checkout\Magento2\RegisterNewCustomerCheckout;
use Magium\Magento\Navigators\Customer\AccountHome;
use Magium\Magento\Themes\AbstractThemeConfiguration;
use Magium\WebDriver\WebDriver;

class ThemeConfiguration extends AbstractThemeConfiguration
{

    const THEME = 'Magium\Magento\Themes\Magento2\ThemeConfiguration';

    protected $homeXpath = '//a[@class="logo"]';

    /**
     * @var string The Xpath string that finds the base of the navigation menu
     */
    protected $navigationBaseXPathSelector          = '//nav[@role="navigation"]/ul';

    /**
     * @var string The Xpath string that can be used iteratively to find child navigation nodes
     */

    protected $navigationChildXPathSelector         = 'li[contains(concat(" ",normalize-space(@class)," ")," level%d ")]/a[.="%s"]/..';

    /**
     * @var string A simple, default path to use for categories.
     */

    protected $navigationPathToSimpleProductCategory      = '{{Gear}}/{{Bags}}';
    protected $navigationPathToConfigurableProductCategory      = '{{Men}}/{{Tops}}/{{Jackets}}';

    protected $defaultSimpleProductName = '{{Joust Duffle Bag}}';
    protected $defaultConfigurableProductName = '{{Beaumont Summit Kit}}';

    /**
     * @var string Xpath to add a Simple product to the cart from the product's page
     */

    protected $addToCartXpath          = '//button[contains(concat(" ",normalize-space(@class)," ")," tocart ")]';

    /**
     * @var string Xpath to add a Simple product to the cart from the category page
     */

    protected $categoryAddToCartButtonXPathSelector = '//button[@title="{{Add to Cart}}" and @onclick]';

    /**
     * @var string Xpath to find a product's link on a category page.  Used to navigate to the product from the category
     */

    protected $categoryProductPageXpath             = '//a[@class="product-item-link"]';

    protected $categorySpecificProductPageXpath             = '//a[@class="product-item-link" and concat(" ",normalize-space(.)," ")=" %s "]';


    /**
     * @var string Xpath used after a product has been added to the cart to verify that the product has been added to the cart
     */

    protected $addToCartSuccessXpath        = '//div[@data-ui-id="message-success"]';

    /**
     * @var string The base URL of the installation
     */

    protected $baseUrl                      = 'http://localhost/';

    protected $myAccountTitle               = 'My Account';

    /**
     * @var array Instructions in an Xpath array syntax to get to the login page.
     */
    
    protected $navigateToCustomerPageInstructions            = [
        [\Magium\WebDriver\WebDriver::INSTRUCTION_MOUSE_CLICK, '(//ul[contains(concat(" ",normalize-space(@class)," ")," header ")]/li[contains(concat(" ",normalize-space(@class)," ")," authorization-link ")]/a)[1]']
    ];

    protected $cartNavigationInstructions            = [
        [\Magium\WebDriver\WebDriver::INSTRUCTION_MOUSE_CLICK, '//a[contains(concat(" ",normalize-space(@class)," ")," showcart ")]'],
        [\Magium\WebDriver\WebDriver::INSTRUCTION_MOUSE_CLICK, '//a[contains(concat(" ",normalize-space(@class)," ")," viewcart ")]']
    ];

    protected $navigateToCustomerPageLoggedInInstructions = [
        [WebDriver::INSTRUCTION_MOUSE_CLICK, '(//span[@class="customer-name"])[1]'],
        [WebDriver::INSTRUCTION_MOUSE_CLICK, '(//div[@class="customer-menu"])[1]/descendant::li/a[.="{{My Account}}"]']
    ];

    /**
     * @var array Instructions in an Xpath array syntax to get to the start of the checkout page
     */

    protected $checkoutNavigationInstructions         = [
        [\Magium\WebDriver\WebDriver::INSTRUCTION_MOUSE_CLICK, '//a[contains(concat(" ",normalize-space(@class)," ")," showcart ")]'],
        [\Magium\WebDriver\WebDriver::INSTRUCTION_MOUSE_CLICK, '//button[@id="top-cart-btn-checkout"]'],
    ];

    /**
     * @var array Instructions in an Xpath array syntax to get to the customer registration page
     */

    protected $registrationNavigationInstructions         = [
        [\Magium\WebDriver\WebDriver::INSTRUCTION_MOUSE_CLICK, '//ul[contains(concat(" ",normalize-space(@class)," ")," header ")]/descendant::a[.="{{Create an Account}}"]']
    ];

    /**
     * @var array Instructions in an Xpath array syntax to get to the customer registration page
     */

    protected $logoutNavigationInstructions         = [
        [\Magium\WebDriver\WebDriver::INSTRUCTION_MOUSE_CLICK, '(//ul[contains(concat(" ",normalize-space(@class)," ")," header ")])[1]/descendant::span[@class="customer-name"]'],
        [\Magium\WebDriver\WebDriver::INSTRUCTION_MOUSE_CLICK, '(//ul[contains(concat(" ",normalize-space(@class)," ")," header ")])[1]/descendant::a[concat(" ",normalize-space(.)," ") = " Sign Out "]']
    ];

    protected $registerFirstNameXpath           = '//input[@id="firstname"]';
    protected $registerLastNameXpath            = '//input[@id="lastname"]';
    protected $registerEmailXpath               = '//input[@id="email_address"]';
    protected $registerPasswordXpath            = '//input[@id="password"]';
    protected $registerConfirmPasswordXpath     = '//input[@id="password-confirmation"]';
    protected $registerNewsletterXpath          = '//input[@id="is_subscribed"]';
    protected $registerSubmitXpath              = '//button[@type="submit" and @title="{{Create an Account}}"]';

    protected $logoutSuccessXpath               = '//h1[contains(concat(" ",normalize-space(@class)," ")," page-title ")]/descendant::span[.="{{You are signed out}}"]';

    protected $layeredNavigationTestXpath       = '//div[@id="layered-filter-block"]';

    protected $breadCrumbXpath                  = '//div[@class="breadcrumbs"]';

    protected $productListBaseXpath             = '//div[contains(concat(" ",normalize-space(@class)," ")," products-list ")]/descendant::li[%d]';
    protected $productListDescriptionXpath      = '/descendant::div[contains(concat(" ",normalize-space(@class)," ")," description ")]';
    protected $productListTitleXpath            = '/descendant::a[@class="product-item-link"]';
    protected $productListCompareLinkXpath      = '/descendant::div[@data-role="add-to-links"]/descendant::a[contains(concat(" ",normalize-space(@class)," ")," tocompare ")]';
    protected $productListImageXpath            = '/descendant::img[@class="product-image-photo"]';
    protected $productListLinkXpath             = '/descendant::a[@class="product-item-link"]';
    protected $productListOriginalPriceXpath    = '/descendant::span[@class="old-price"]/descendant::*[@class="price"]';
    protected $productListPriceXpath            = '/descendant::span[contains(concat(" ",normalize-space(@class)," ")," price-final_price ")]/descendant::*[@class="price"]';
    protected $productListWishlistLinkXpath     = '/descendant::div[@data-role="add-to-links"]/descendant::a[contains(concat(" ",normalize-space(@class)," ")," towishlist ")]';
    protected $productListAddToCartLinkXpath    = '/descendant::button[contains(concat(" ",normalize-space(@class)," ")," tocart ")]';

    protected $productGridBaseXpath             = '//div[contains(concat(" ",normalize-space(@class)," ")," products-grid ")]/descendant::li[%d]';
    protected $productGridDescriptionXpath      = '/*[.="no description in the grid view"]';
    protected $productGridTitleXpath            = '/descendant::a[@class="product-item-link"]';
    protected $productGridCompareLinkXpath      = '/descendant::div[@data-role="add-to-links"]/descendant::a[contains(concat(" ",normalize-space(@class)," ")," tocompare ")]';
    protected $productGridImageXpath            = '/descendant::img[@class="product-image-photo"]';
    protected $productGridLinkXpath             = '/descendant::a[@class="product-item-link"]';
    protected $productGridOriginalPriceXpath    = '/descendant::span[@class="old-price"]/descendant::*[@class="price"]';
    protected $productGridPriceXpath            = '/descendant::span[contains(concat(" ",normalize-space(@class)," ")," price-final_price ")]/descendant::*[@class="price"]';
    protected $productGridWishlistLinkXpath     = '/descendant::div[@data-role="add-to-links"]/descendant::a[contains(concat(" ",normalize-space(@class)," ")," towishlist ")]';
    protected $productGridAddToCartLinkXpath     = '/descendant::button[contains(concat(" ",normalize-space(@class)," ")," tocart ")]';

    protected $productCollectionViewModeXpath   = '(//div[@class="modes"]/strong[contains(concat(" ",normalize-space(@class)," ")," modes-mode ")])[1]';
    protected $productCollectionSortByXpath     = '(//select[@id="sorter"]/descendant::option[@selected])[1]';
    protected $productCollectionShowCountXpath  = '(//select[@id="limiter"]/descendant::option[@selected])[2]'; // dittos
    protected $productCollectionShowCountOptionsXpath  = '//select[@id="limiter"]/descendant::option';
    protected $productCollectionProductCountXpath = '//p[@id="toolbar-amount"]/span[@class="toolbar-number"]';

    protected $layeredNavigationBaseXpath        = '//div[@id="layered-filter-block"]';
    protected $layeredNavigationFilterNameXpath =  '//div[@class="filter-options-title"]';
    protected $layeredNavigationFilterNameElementXpath =  '//div[@class="filter-options-title" and normalize-space(.) = "%s"]';
    protected $layeredNavigationSwatchAppliesXpath = '//div[@class="filter-options-title" and normalize-space(.) = "%s"]/../div[@class="filter-options-content"]/div[contains(concat(" ",normalize-space(@class)," ")," swatch-attribute ")]';

    protected $layeredNavigationFilterTypesXpath = '//div[@class="filter-options-title" and normalize-space(.) = "%s"]/../div[@data-role="content"]/descendant::li';
    protected $layeredNavigationSwatchFilterTypesXpath = '//div[@class="filter-options-title" and normalize-space(.) = "%s"]/../div[@data-role="content"]/descendant::a';
    protected $layeredNavigationFilterLinkXpath = '//div[@class="filter-options-title" and normalize-space(.) = "%s"]/../div[@data-role="content"]/descendant::li/descendant::a';

    protected $searchInputXpath                 = '//input[@id="search"]';
    protected $searchSubmitXpath                = '//form[@id="search_mini_form"]/descendant::button[@title="Search"]';

    protected $searchSuggestionTextXpath        = '//div[@id="search_autocomplete"]/descendant::li[@role="option"][%d]';
    protected $searchSuggestionCountXpath       = '//div[@id="search_autocomplete"]/descendant::li[@role="option"][%d]/span[@class="amount"]';

    protected $simpleProductQtyXpath = '//input[@id="qty"]';

    protected $configurableProductLabelXpath = '//div[@id="product-options-wrapper"]/descendant::span[@class="swatch-attribute-label"]';
    protected $configurableSwatchSelectorXpath = '(%s)[%d]/../descendant::div[contains(concat(" ",normalize-space(@class)," ")," swatch-option ")][%d]';
    protected $configurableSwatchImgXpath = '(%s)[%d]/ancestor::dt/following-sibling::dd[1]/descendant::a[%d]/descendant::img';
    protected $configurableSwatchNotAvailableXpath =  '(%s)[%d]/ancestor::dt/following-sibling::dd[1]/descendant::a[%d]/ancestor::li[contains(concat(" ",normalize-space(@class)," ")," not-available ")]';

    protected $configurableProductOptionXpath = '(%s)[%d]/ancestor::dt/following-sibling::dd[1]/descendant::option[starts-with(., "%s")]';

    protected $viewModeAttributeName = 'data-value';

    protected $breadCrumbMemberXpath = '/descendant::a[concat(" ",normalize-space(.)," ")=" {{%s}} "]';
    protected $breadCrumbSelectorXpath = '/descendant::li[%d]';
    protected $layeredNavigationSwatchTitleAttribute = 'option-label';

    protected $storeSwitcherInstructionsXpath   = [
        [\Magium\WebDriver\WebDriver::INSTRUCTION_MOUSE_CLICK, '//select[@id="select-language"]/descendant::option[contains(@value,"___store=%s")]'],
    ];

    /**
     * @return array
     */
    public function getNavigateToCustomerPageLoggedInInstructions()
    {
        return $this->translatePlaceholders($this->navigateToCustomerPageLoggedInInstructions);
    }

    public function configure(AbstractTestCase $testCase)
    {
        parent::configure($testCase);
        $testCase->setTypePreference(
            $testCase->resolveClass(AccountHome::NAVIGATOR, 'Navigators'),
            $testCase->resolveClass(\Magium\Magento\Navigators\Customer\Magento2\AccountHome::NAVIGATOR, 'Navigators')
        );
        $testCase->setTypePreference(
            'Magium\Magento\Extractors\Catalog\Product\SwatchProcessor',
            'Magium\Magento\Extractors\Catalog\Product\Magento2\SwatchProcessor'
        );
        $testCase->setTypePreference(
            'Magium\Magento\Extractors\Catalog\Product\StandardProcessor',
            'Magium\Magento\Extractors\Catalog\Product\Magento2\StandardProcessor'
        );
        $testCase->setTypePreference(
            $testCase->resolveClass(\Magium\Magento\Themes\Admin\ThemeConfiguration::THEME, 'Themes'),
            $testCase->resolveClass(\Magium\Magento\Themes\Magento2\Admin\ThemeConfiguration::THEME, 'Themes')
        );
        $testCase->setTypePreference(
            $testCase->resolveClass(GuestCheckout::ACTION, 'Actions'),
            $testCase->resolveClass(\Magium\Magento\Actions\Checkout\Magento2\GuestCheckout::ACTION, 'Actions')
        );
        $testCase->setTypePreference(
            $testCase->resolveClass(CustomerCheckout::ACTION, 'Actions'),
            $testCase->resolveClass(\Magium\Magento\Actions\Checkout\Magento2\CustomerCheckout::ACTION, 'Actions')
        );
        $testCase->setTypePreference(
            $testCase->resolveClass(RegisterNewCustomerCheckout::ACTION, 'Actions'),
            $testCase->resolveClass(RegisterNewCustomerCheckout::ACTION, 'Actions')
        );
    }

    public function getCustomerThemeClass()
    {
        return 'Magium\Magento\Themes\Magento2\Customer\ThemeConfiguration';
    }

    public function getCheckoutThemeClass()
    {
        return 'Magium\Magento\Themes\Magento2\Checkout\ThemeConfiguration';
    }


}