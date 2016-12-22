<?php

namespace Magium\Magento\Themes;

use Magium\AbstractConfigurableElement;
use Magium\AbstractTestCase;


abstract class AbstractThemeConfiguration extends AbstractConfigurableElement implements NavigableThemeInterface
{

    public $homeXpath;

    /**
     * @var string The Xpath string that finds the base of the navigation menu
     */
    public $navigationBaseXPathSelector;

    /**
     * @var string The Xpath string that can be used iteratively to find child navigation nodes
     */

    public $navigationChildXPathSelector;

    /**
     * @var string A simple, default path to use for categories.
     */

    public $navigationPathToSimpleProductCategory;

    public $navigationPathToConfigurableProductCategory;

    /**
     * @var string Xpath to add a Simple product to the cart from the product's page
     */

    public $addToCartXpath;

    public $defaultSimpleProductName;
    public $defaultConfigurableProductName;

    /**
     * @var string Xpath to add a Simple product to the cart from the category page
     */

    public $categoryAddToCartButtonXPathSelector;

    /**
     * @var string Xpath to find a product's link on a category page.  Used to navigate to the product from the category
     */

    public $categoryProductPageXpath;

    public $categorySpecificProductPageXpath;


    /**
     * @var string Xpath used after a product has been added to the cart to verify that the product has been added to the cart
     */

    public $addToCartSuccessXpath;

    /**
     * @var string The base URL of the installation
     */

    public $baseUrl;

    /**
     * @var string The Xpath for extracting the price from a page
     */

    public $productPagePriceXpath;

    public $myAccountTitle;

    /**
     * @var array Instructions in an Xpath array syntax to get to the login page.
     */

    public $navigateToCustomerPageInstructions            = [];

    /**
     * @var array Instructions in an Xpath array syntax to get to the shopping cart
     */

    public $cartNavigationInstructions         = [];

    /**
     * @var array Instructions in an Xpath array syntax to get to the start of the checkout page
     */

    public $checkoutNavigationInstructions         = [];

    /**
     * @var array Instructions in an Xpath array syntax to get to the customer registration page
     */

    public $registrationNavigationInstructions         = [];

    /**
     * @var array Instructions in an Xpath array syntax to get to the customer registration page
     */

    public $logoutNavigationInstructions         = [];

    public $registerFirstNameXpath;
    public $registerLastNameXpath;
    public $registerEmailXpath;
    public $registerPasswordXpath;
    public $registerConfirmPasswordXpath;
    public $registerNewsletterXpath;
    public $registerSubmitXpath;

    public $logoutSuccessXpath;

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

    public $layeredNavigationTestXpath;

    public $breadCrumbXpath;

    public $productListBaseXpath;
    public $productListDescriptionXpath;
    public $productListTitleXpath;
    public $productListCompareLinkXpath;
    public $productListImageXpath;
    public $productListLinkXpath;
    public $productListOriginalPriceXpath;
    public $productListPriceXpath;
    public $productListWishlistLinkXpath;
    public $productListAddToCartLinkXpath;

    public $productGridBaseXpath;
    public $productGridDescriptionXpath;
    public $productGridTitleXpath;
    public $productGridCompareLinkXpath;
    public $productGridImageXpath;
    public $productGridLinkXpath;
    public $productGridOriginalPriceXpath;
    public $productGridPriceXpath;
    public $productGridWishlistLinkXpath;
    public $productGridAddToCartLinkXpath;

    public $productCollectionViewModeXpath;
    public $productCollectionSortByXpath;
    public $productCollectionShowCountXpath;
    public $productCollectionShowCountOptionsXpath;
    public $productCollectionProductCountXpath;

    public $simpleProductQtyXpath;

    public $layeredNavigationBaseXpath;

    public $searchInputXpath;
    public $searchSubmitXpath;

    public $searchSuggestionTextXpath;
    public $searchSuggestionCountXpath;

    public $storeSwitcherInstructionsXpath;

    public $configurableProductLabelXpath;
    public $configurableSwatchSelectorXpath;
    public $configurableSwatchImgXpath;
    public $configurableSwatchNotAvailableXpath;
    public $configurableSwatchOptionLabelAttributeName;

    public $configurableProductOptionXpath;

    public $viewModeAttributeName;

    public $breadCrumbMemberXpath;
    public $breadCrumbSelectorXpath;

    public $layeredNavigationFilterNameXpath;

    public $layeredNavigationFilterTypesXpath;
    public $layeredNavigationFilterLinkXpath;
    public $layeredNavigationFilterNameElementXpath;
    public $layeredNavigationSwatchAppliesXpath;
    public $layeredNavigationSwatchFilterTypesXpath;
    public $layeredNavigationSwatchTitleAttribute;

    abstract public function getCustomerThemeClass();
    abstract public function getCheckoutThemeClass();

    public $guaranteedPageLoadedElementDisplayedXpath = '//div[contains(concat(" ",normalize-space(@class)," ")," footer ")]';

    public $contactUsNameXpath = '//form[@id="contactForm"]/descendant::input[@id="name"]';
    public $contactUsEmailXpath = '//form[@id="contactForm"]/descendant::input[@id="email"]';
    public $contactUsTelephoneXpath = '//form[@id="contactForm"]/descendant::input[@id="telephone"]';
    public $contactUsCommentXpath = '//form[@id="contactForm"]/descendant::textarea[@id="comment"]';
    public $contactUsSubmitXpath = '//form[@id="contactForm"]/descendant::button';

    public $useClicksToNavigate = false;

    public function getUseClicksToNavigate()
    {
        return $this->useClicksToNavigate;
    }

    public function configure(AbstractTestCase $testCase)
    {

    }

    /**
     * @return mixed
     */
    public function getConfigurableSwatchOptionLabelAttributeName()
    {
        return $this->configurableSwatchOptionLabelAttributeName;
    }

    /**
     * @return string
     */
    public function getContactUsSubmitXpath()
    {
        return $this->translatePlaceholders($this->contactUsSubmitXpath);
    }

    /**
     * @return string
     */
    public function getContactUsNameXpath()
    {
        return $this->translatePlaceholders($this->contactUsNameXpath);
    }

    /**
     * @return string
     */
    public function getContactUsEmailXpath()
    {
        return $this->translatePlaceholders($this->contactUsEmailXpath);
    }

    /**
     * @return string
     */
    public function getContactUsCommentXpath()
    {
        return $this->translatePlaceholders($this->contactUsCommentXpath);
    }

    /**
     * @return string
     */
    public function getContactUsTelephoneXpath()
    {
        return $this->translatePlaceholders($this->contactUsTelephoneXpath);
    }



    /**
     * @return array
     */
    public function getCartNavigationInstructions()
    {
        return $this->translatePlaceholders($this->cartNavigationInstructions);
    }

    /**
     * @return string
     */
    public function getLayeredNavigationSwatchTitleAttribute()
    {
        return $this->layeredNavigationSwatchTitleAttribute;
    }

    /**
     * @return mixed
     */
    public function getLayeredNavigationSwatchAppliesXpath($name)
    {
        if ($this->layeredNavigationSwatchAppliesXpath) {
            return $this->translatePlaceholders(sprintf($this->layeredNavigationSwatchAppliesXpath, $name));
        }
    }

    /**
     * @return mixed
     */
    public function getLayeredNavigationSwatchFilterTypesXpath($name)
    {
        return $this->translatePlaceholders(sprintf($this->layeredNavigationSwatchFilterTypesXpath, $name));
    }

    /**
     * @return mixed
     */
    public function getLayeredNavigationFilterNameElementXpath($name)
    {
        return $this->translatePlaceholders(sprintf($this->layeredNavigationFilterNameElementXpath, $name));
    }

    /**
     * @return string
     */
    public function getLayeredNavigationFilterTypesXpath($type)
    {
        return $this->translatePlaceholders(sprintf($this->layeredNavigationFilterTypesXpath, $type));
    }

    /**
     * @return string
     */
    public function getLayeredNavigationFilterLinkXpath($type)
    {
        return $this->translatePlaceholders(sprintf($this->layeredNavigationFilterLinkXpath, $type));
    }



    /**
     * @return mixed
     */
    public function getLayeredNavigationFilterNameXpath()
    {
        return $this->layeredNavigationFilterNameXpath;
    }

    public function getBreadCrumbMemberXpath($name)
    {
        return $this->getBreadCrumbXpath() . $this->translatePlaceholders(sprintf($this->breadCrumbMemberXpath, $name));
    }

    /**
     * @return mixed
     */
    public function getBreadCrumbSelectorXpath($test)
    {
        return $this->getBreadCrumbXpath() . sprintf($this->breadCrumbSelectorXpath, $test);
    }

    /**
     * @return string
     */
    public function getProductPagePriceXpath()
    {
        return $this->productPagePriceXpath;
    }

    /**
     * @return mixed
     */
    public function getConfigurableProductOptionXpath($swatchCount, $label)
    {

        return $this->translatePlaceholders(
            sprintf(
                $this->configurableProductOptionXpath,
                $this->getConfigurableLabelXpath(),
                $swatchCount,
                $label
            )
        );
    }

    public function getConfigurableSwatchImgXpath($swatchCount, $optionCount)
    {
        return $this->translatePlaceholders(
            sprintf(
                $this->configurableSwatchImgXpath,
                $this->getConfigurableLabelXpath(),
                $swatchCount,
                $optionCount
            )
        );
    }

    /**
     * @return string
     */
    public function getConfigurableLabelXpath()
    {
        return $this->configurableProductLabelXpath;
    }

    public function filterConfigurableProductOptionName($swatch)
    {
        return preg_replace('/^(.+)\:$/', '$1', $swatch);
    }

    /**
     * @return string
     */
    public function getConfigurableSwatchNotAvailableXpath($swatchCount, $optionCount)
    {
        return $this->translatePlaceholders(
            sprintf(
                $this->configurableSwatchNotAvailableXpath,
                $this->getConfigurableLabelXpath(),
                $swatchCount,
                $optionCount
            )
        );
    }

    /**
     * @return string
     */
    public function getConfigurableSwatchSelectorXpath($swatchCount, $optionCount)
    {
        return $this->translatePlaceholders(
            sprintf(
                $this->configurableSwatchSelectorXpath,
                $this->getConfigurableLabelXpath(),
                $swatchCount,
                $optionCount
            )
        );
    }



    /**
     * @return mixed
     */
    public function getDefaultSimpleProductName()
    {
        return $this->translatePlaceholders($this->defaultSimpleProductName);
    }

    /**
     * @return mixed
     */
    public function getDefaultConfigurableProductName()
    {
        return $this->translatePlaceholders($this->defaultConfigurableProductName);
    }

    /**
     * @return mixed
     */
    public function getSimpleProductQtyXpath()
    {
        return $this->simpleProductQtyXpath;
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
     * @return mixed
     */
    public function getStoreSwitcherInstructionsXpath($store)
    {
        $xpaths = $this->storeSwitcherInstructionsXpath;
        foreach ($xpaths as &$path) {
            if (strpos($path[1], '%s') !== false) {
                $path[1] = sprintf($path[1], $store);
            }
        }
        return $xpaths;
    }

    /**
     * @return mixed
     */
    public function getSearchSuggestionTextXpath($count)
    {
        $xpath = sprintf($this->searchSuggestionTextXpath, $count);
        return $this->translatePlaceholders($xpath);
    }

    /**
     * @return mixed
     */
    public function getSearchSuggestionCountXpath($count)
    {
        $xpath = sprintf($this->searchSuggestionCountXpath, $count);
        return $this->translatePlaceholders($xpath);
    }

    /**
     * @return mixed
     */
    public function getSearchSubmitXpath()
    {
        return $this->translatePlaceholders($this->searchSubmitXpath);
    }

    /**
     * @return mixed
     */
    public function getSearchInputXpath()
    {
        return $this->translatePlaceholders($this->searchInputXpath);
    }

    /**
     * @return mixed
     */
    public function getCategorySpecificProductPageXpath($productName)
    {
        $xpath = sprintf($this->categorySpecificProductPageXpath, $productName);
        return $this->translatePlaceholders($xpath);
    }

    /**
     * @return mixed
     */
    public function getHomeXpath()
    {
        return $this->translatePlaceholders($this->homeXpath);
    }

    /**
     * @return mixed
     */
    public function getLayeredNavigationBaseXpath()
    {
        return $this->layeredNavigationBaseXpath;
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

    public function getViewModeAttributeName()
    {
        return $this->viewModeAttributeName;
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
        return$this->translatePlaceholders( $this->logoutSuccessXpath);
    }

    /**
     * @return array
     */
    public function getLogoutNavigationInstructions()
    {
        return $this->translatePlaceholders($this->logoutNavigationInstructions);
    }


    /**
     * @return string
     */
    public function getMyAccountTitle()
    {
        return $this->translatePlaceholders($this->myAccountTitle);
    }

    /**
     * @return string
     */
    public function getRegisterFirstNameXpath()
    {
        return $this->translatePlaceholders($this->registerFirstNameXpath);
    }

    /**
     * @return string
     */
    public function getRegisterLastNameXpath()
    {
        return $this->translatePlaceholders($this->registerLastNameXpath);
    }

    /**
     * @return string
     */
    public function getRegisterEmailXpath()
    {
        return$this->translatePlaceholders($this->registerEmailXpath);
    }

    /**
     * @return string
     */
    public function getRegisterPasswordXpath()
    {
        return $this->translatePlaceholders($this->registerPasswordXpath);
    }

    /**
     * @return string
     */
    public function getRegisterConfirmPasswordXpath()
    {
        return $this->translatePlaceholders($this->registerConfirmPasswordXpath);
    }

    /**
     * @return string
     */
    public function getRegisterNewsletterXpath()
    {
        return $this->translatePlaceholders($this->registerNewsletterXpath);
    }

    /**
     * @return string
     */
    public function getRegisterSubmitXpath()
    {
        return $this->translatePlaceholders($this->registerSubmitXpath);
    }

    /**
     * @return array
     */
    public function getRegistrationNavigationInstructions()
    {
        return $this->translatePlaceholders($this->registrationNavigationInstructions);
    }

    public function getCheckoutNavigationInstructions()
    {
        return $this->translatePlaceholders($this->checkoutNavigationInstructions);
    }

    public function getProductPageForCategory()
    {
        return $this->translatePlaceholders($this->categoryProductPageXpath);
    }

    public function getAddToCartSuccessXpath()
    {
        return $this->translatePlaceholders($this->addToCartSuccessXpath);
    }

    public function getNavigateToCustomerPageInstructions()
    {
        return $this->translatePlaceholders($this->navigateToCustomerPageInstructions);
    }

    public function getNavigationBaseXPathSelector()
    {
        return $this->translatePlaceholders($this->navigationBaseXPathSelector);
    }

    public function getNavigationChildXPathSelector($text)
    {
        $return = sprintf($this->navigationChildXPathSelector, $text);
        return $this->translatePlaceholders($return);
    }

    public function getNavigationPathToSimpleProductCategory()
    {
        return $this->translatePlaceholders($this->navigationPathToSimpleProductCategory);
    }

    public function getNavigationPathToConfigurableProductCategory()
    {
        return $this->translatePlaceholders($this->navigationPathToConfigurableProductCategory);
    }

    public function getCategoryAddToCartButtonXPathSelector()
    {
        return $this->translatePlaceholders($this->categoryAddToCartButtonXPathSelector);
    }


    public function getAddToCartXpath()
    {
        return $this->translatePlaceholders($this->addToCartXpath);
    }



}
