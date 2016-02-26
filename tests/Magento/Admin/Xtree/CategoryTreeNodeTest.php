<?php

namespace Tests\Magium\Magento\Admin\Xtree;

use Facebook\WebDriver\WebDriverSelect;
use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Actions\Admin\Login\Login;
use Magium\Magento\Extractors\Admin\Widget\Attribute;
use Magium\Magento\Extractors\Admin\Xtree\CategoryTreeNode;
use Magium\Magento\Navigators\Admin\AdminMenu;
use Magium\Magento\Navigators\Admin\Widget\Tab;

class CategoryTreeNodeTest extends AbstractMagentoTestCase
{
    public function testCategoryTreeExtractor()
    {
        $this->getAction(Login::ACTION)->execute();
        $this->getNavigator(AdminMenu::NAVIGATOR)->navigateTo('Catalog/Manage Categories');
        $extractor = $this->getExtractor(CategoryTreeNode::EXTRACTOR);
        /* @var $extractor CategoryTreeNode */
        $element = $extractor->getNode('Men/Shirts');
        $this->assertWebDriverElement($element);
    }

    public function testCategoryTreeExtractorWithDefinedRootCategory()
    {
        $this->getAction(Login::ACTION)->execute();
        $this->getNavigator(AdminMenu::NAVIGATOR)->navigateTo('Catalog/Manage Categories');
        $extractor = $this->getExtractor(CategoryTreeNode::EXTRACTOR);
        /* @var $extractor CategoryTreeNode */
        $extractor->setRootCategory('Default Category');
        $element = $extractor->getNode('Men/Shirts');
        $this->assertWebDriverElement($element);
    }

    public function testCategoryTreeExtractorWithNewProductCategories()
    {
        $this->getAction(Login::ACTION)->execute();
        $this->getNavigator(AdminMenu::NAVIGATOR)->navigateTo('Catalog/Manage Products');
        $this->byText('Add Product')->click();
        $extractor = $this->getExtractor(Attribute::EXTRACTOR);
        /* @var $extractor Attribute */
        $attributeSet = new WebDriverSelect($extractor->getElementByLabel('Attribute Set'));
        $attributeSet->selectByVisibleText('Default');

        $attributeSet = new WebDriverSelect($extractor->getElementByLabel('Product Type'));
        $attributeSet->selectByVisibleText('Simple Product');

        $this->byText('Continue')->click();


        // Add it to a category
        $this->getNavigator(Tab::NAVIGATOR)->navigateTo('Categories::Product Categories');

        $extractor = $this->getExtractor(CategoryTreeNode::EXTRACTOR);
        /* @var $extractor CategoryTreeNode */

        $element = $extractor->getNode('Men/Shirts');
        $this->assertWebDriverElement($element);
    }

    public function testCategoryTreeExtractorWithExistingProductCategories()
    {
        $this->getAction(Login::ACTION)->execute();
        $this->getNavigator(AdminMenu::NAVIGATOR)->navigateTo('Catalog/Manage Products');
        $this->byText('Edit')->click();


        // Add it to a category
        $this->getNavigator(Tab::NAVIGATOR)->navigateTo('Categories::Product Categories');

        $extractor = $this->getExtractor(CategoryTreeNode::EXTRACTOR);
        /* @var $extractor CategoryTreeNode */

        $element = $extractor->getNode('Men/Shirts');
        $this->assertWebDriverElement($element);
        $element->click();
    }
}