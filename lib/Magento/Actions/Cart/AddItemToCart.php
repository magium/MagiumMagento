<?php

namespace Magium\Magento\Actions\Cart;

use Magium\Actions\WaitForPageLoaded;
use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Navigators\BaseMenu;
use Magium\Magento\Navigators\Catalog\Product;
use Magium\Magento\Themes\AbstractThemeConfiguration;
use Magium\WebDriver\WebDriver;

class AddItemToCart
{
    const ACTION = 'Cart\AddItemToCart';

    protected $webdriver;
    protected $theme;
    protected $navigator;
    protected $testCase;
    protected $loaded;
    protected $addSimpleProductToCart;
    protected $addConfigurableProductToCart;
    protected $productNavigator;
    
    public function __construct(
        WebDriver $webdriver,
        AbstractThemeConfiguration $theme,
        BaseMenu $navigator,
        AbstractMagentoTestCase $testCase,
        WaitForPageLoaded $loaded,
        AddSimpleProductToCart $addSimpleProductToCart,
        AddConfigurableProductToCart $addConfigurableProductToCart,
        Product $product
    ) {
        $this->webdriver = $webdriver;
        $this->theme = $theme;
        $this->navigator = $navigator;
        $this->testCase = $testCase;
        $this->loaded = $loaded;
        $this->addSimpleProductToCart = $addSimpleProductToCart;
        $this->addConfigurableProductToCart = $addConfigurableProductToCart;
        $this->productNavigator = $product;
    }
    
    /**
     * Adds an item to the cart from its product page by navigating to the default
     * test category and adding the default test product to the cart.
     * 
     * @throws \Magium\NotFoundException
     */
    
    public function addSimpleProductToCartFromCategoryPage($categoryNavigationPath = null, $addToCartXpath = null)
    {
        if ($categoryNavigationPath === null) {
            $categoryNavigationPath = $this->theme->getNavigationPathToSimpleProductCategory();
        }

        $this->navigator->navigateTo($categoryNavigationPath);

        if ($addToCartXpath !== null) {
            $this->webdriver->byXpath($addToCartXpath)->click();
            return;
        }

        $this->addSimpleProductToCart->execute();
    }
    
    /**
     * Finds a product on a category page and attempts to add it to the cart after navigating to the product page
     * @todo
     *
     * @param string $categoryNavigationPath The category path to go to
     */
    
    public function addSimpleItemToCartFromProductPage($categoryNavigationPath = null, $productPageXpath = null)
    {
        if ($categoryNavigationPath === null) {
            $categoryNavigationPath = $this->theme->getNavigationPathToSimpleProductCategory();
        }

        $this->navigator->navigateTo($categoryNavigationPath);

        if ($productPageXpath) {
            $element = $this->webdriver->byXpath($productPageXpath);
            $element->click();
            $this->loaded->execute($element);
        } else {
            $this->productNavigator->navigateTo($this->theme->getDefaultSimpleProductName());
        }

        $this->addSimpleProductToCart->execute();

        $this->testCase->assertElementExists($this->theme->getAddToCartSuccessXpath(), 'byXpath');
    }
    
    /**
     * Adds as configurable product to the cart from the product page.
     * 
     * @param string $categoryNavigationPath The name of the category to navigate to.  e.g. Accessories/Jewelry
     */
    
    public function addConfigurableItemToCartFromProductPage($categoryNavigationPath = null)
    {
        if ($categoryNavigationPath === null) {
            $categoryNavigationPath = $this->theme->getNavigationPathToConfigurableProductCategory();
        }

        $this->navigator->navigateTo($categoryNavigationPath);

        $this->productNavigator->navigateTo($this->theme->getDefaultConfigurableProductName());

        $this->addConfigurableProductToCart->execute();

        $this->testCase->assertElementExists($this->theme->getAddToCartSuccessXpath(), 'byXpath');
    }

    public function execute()
    {
        throw new \Exception('The execute() method is not used in this class.  Please consider one of the other methods.');
    }

}