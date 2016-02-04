<?php

namespace Tests\Magium\Magento\Admin;

use Magium\Actions\WaitForPageLoaded;
use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Actions\Admin\Login\Login;
use Magium\Magento\Actions\Admin\Widget\ClickActionButton;
use Magium\Magento\Extractors\Admin\Widget\Attribute;
use Magium\Magento\Navigators\Admin\AdminMenu;
use Magium\Magento\Navigators\Admin\Widget\Tab;

class GridWidgetTest extends AbstractMagentoTestCase
{
    public function testNavigateToProductPrices()
    {
        $this->getAction(Login::ACTION)->login();
        $this->getNavigator(AdminMenu::NAVIGATOR)->navigateTo('Catalog/Manage Products');
        $this->byText('Edit')->click();
        $this->getNavigator(Tab::NAVIGATOR)->navigateTo('Prices');
        $this->assertElementDisplayed('price');
    }

    public function testAttributeSelectorWithTab()
    {
        $this->getAction(Login::ACTION)->login();
        $this->getNavigator(AdminMenu::NAVIGATOR)->navigateTo('Catalog/Manage Products');
        $this->byText('Edit')->click();
        $extractor = $this->getExtractor(Attribute::EXTRACTOR);
        /* @var $extractor Attribute */
        $element = $extractor->getElementByLabel('Prices::Price');
        $this->assertWebDriverElement($element);
    }

    public function testProductCanBeSaved()
    {
        $this->getAction(Login::ACTION)->login();
        $this->getNavigator(AdminMenu::NAVIGATOR)->navigateTo('Catalog/Manage Products');
        $this->byText('Edit')->click();
        $attribute = $this->getExtractor(Attribute::EXTRACTOR)->getElementByLabel('General::Name');
        $name = $attribute->getAttribute('value');
        $attribute->clear();
        $attribute->sendKeys('Some Test Value');

        $this->getAction(ClickActionButton::ACTION)->click('Save and Continue Edit');
        $this->getAction(WaitForPageLoaded::ACTION)->execute($attribute);

        $attribute = $this->getExtractor(Attribute::EXTRACTOR)->getElementByLabel('General::Name');
        self::assertEquals('Some Test Value', $attribute->getAttribute('value'));
        $attribute->clear();
        $attribute->sendKeys($name);

        $this->getAction(ClickActionButton::ACTION)->click('Save and Continue Edit');
        $this->getAction(WaitForPageLoaded::ACTION)->execute($attribute);
        $attribute = $this->getExtractor(Attribute::EXTRACTOR)->getElementByLabel('General::Name');
        self::assertEquals($name, $attribute->getAttribute('value'));

    }
}
