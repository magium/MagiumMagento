<?php

namespace Magium\Magento\Themes\Magento18;


use Magium\Magento\Themes\AbstractThemeConfiguration;

class ThemeConfiguration extends AbstractThemeConfiguration
{

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

    protected $navigationPathToProductCategory      = '{{Electronics}}/{{Cell Phones}}';

    /**
     * @var string Xpath to add a Simple product to the cart from the product's page
     */

    protected $simpleProductAddToCartXpath          = '//button[@title="{{Add to Cart}}" and @onclick]';

    /**
     * @var string Xpath to add a Simple product to the cart from the category page
     */

    protected $categoryAddToCartButtonXPathSelector = '//button[@title="{{Add to Cart}}" and @onclick]';

    /**
     * @var string Xpath to find a product's link on a category page.  Used to navigate to the product from the category
     */

    protected $categoryProductPageXpath             = '//h2[@class="product-name"]/descendant::a';

    /**
     * @var string Xpath used after a product has been added to the cart to verify that the product has been added to the cart
     */

    protected $addToCartSuccessXpath        = '//li[@class="success-msg" and contains(., "{{was added to your shopping cart}}")]';

    /**
     * @var string The base URL of the installation
     */

    protected $baseUrl                      = 'http://localhost/';

    protected $myAccountTitle               = '{{My Account}}';

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
        [\Magium\WebDriver\WebDriver::INSTRUCTION_MOUSE_CLICK, '//div[@class="header-minicart"]'],
        [\Magium\WebDriver\WebDriver::INSTRUCTION_MOUSE_CLICK, '//div[@class="minicart-actions"]/descendant::a[@title="Checkout"]']
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

    public function getCustomerThemeClass()
    {
        return 'Magium\Magento\Themes\Magento18\Customer\ThemeConfiguration';
    }
    
}