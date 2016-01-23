<?php

namespace Tests\Magium\Magento\Admin;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Actions\Admin\Configuration\SettingModifier;
use Magium\Magento\Actions\Admin\Login\Login;
use Magium\Magento\Navigators\Admin\AdminMenu;
use Magium\Magento\Navigators\Admin\SystemConfiguration;
use Magium\WebDriver\FastSelectElement;

class SettingModifierTest extends AbstractMagentoTestCase
{

    public function testTextSettingModifierWithoutNavigation()
    {
        $modifier = $this->getAction(SettingModifier::ACTION);
        /** @var $modifier \Magium\Magento\Actions\Admin\Configuration\SettingModifier */

        $this->getAction(Login::ACTION)->login();
        $this->getNavigator(AdminMenu::NAVIGATOR)->navigateTo('System/Configuration');
        $this->getNavigator('Admin\SystemConfiguration')->navigateTo('General/Store Information');

        $modifier->set('general_store_information_name', 'Test');

        self::assertEquals('Test', $this->webdriver->byId('general_store_information_name')->getAttribute('value'));

        // Testing to make sure that the value is cleared

        $modifier->set('general_store_information_name', 'Test 2');

        self::assertEquals('Test 2', $this->webdriver->byId('general_store_information_name')->getAttribute('value'));

    }

    public function testTextSettingModifierSavedWithoutNavigation()
    {
        $modifier = $this->getAction(SettingModifier::ACTION);
        /** @var $modifier \Magium\Magento\Actions\Admin\Configuration\SettingModifier */

        $this->getAction(Login::ACTION)->login();
        $this->getNavigator(AdminMenu::NAVIGATOR)->navigateTo('System/Configuration');
        $this->getNavigator(SystemConfiguration::NAVIGATOR)->navigateTo('General/Store Information');

        $modifier->set('general_store_information_name', 'Test', true); // True saves it

        $this->getNavigator(SystemConfiguration::NAVIGATOR)->navigateTo('Design/Header');
        $this->getNavigator(SystemConfiguration::NAVIGATOR)->navigateTo('General/Store Information');

        self::assertEquals('Test', $this->webdriver->byId('general_store_information_name')->getAttribute('value'));

        $modifier->set('general_store_information_name', '', true); // True saves it
        self::assertEquals('', $this->webdriver->byId('general_store_information_name')->getAttribute('value'));
    }

    public function testSetSettingUsingNameInsteadOfId()
    {
        $modifier = $this->getAction(SettingModifier::ACTION);
        /** @var $modifier \Magium\Magento\Actions\Admin\Configuration\SettingModifier */

        $this->getAction(Login::ACTION)->login();
        $this->getNavigator(AdminMenu::NAVIGATOR)->navigateTo('System/Configuration');
        $this->getNavigator(SystemConfiguration::NAVIGATOR)->navigateTo('General/Store Information');

        $modifier->set('label=Store Name', 'Test');

        self::assertEquals('Test', $this->webdriver->byId('general_store_information_name')->getAttribute('value'));

        // Testing to make sure that the value is cleared

        $modifier->set('label=Store Name', 'Test 2');

        self::assertEquals('Test 2', $this->webdriver->byId('general_store_information_name')->getAttribute('value'));
    }

    public function testTextSettingModifierWithNavigation()
    {
        $modifier = $this->getAction(SettingModifier::ACTION);
        /** @var $modifier \Magium\Magento\Actions\Admin\Configuration\SettingModifier */

        $this->getAction(Login::ACTION)->login();
        $this->getNavigator(AdminMenu::NAVIGATOR)->navigateTo('System/Configuration');

        $modifier->set('General/Store Information::general_store_information_name', 'Test');

        self::assertEquals('Test', $this->webdriver->byId('general_store_information_name')->getAttribute('value'));

        // Testing to make sure that the value is cleared

        $modifier->set('General/Store Information::general_store_information_name', 'Test 2');

        self::assertEquals('Test 2', $this->webdriver->byId('general_store_information_name')->getAttribute('value'));

    }

    public function testSetSettingUsingNameInsteadOfIdWithNavigation()
    {
        $modifier = $this->getAction(SettingModifier::ACTION);
        /** @var $modifier \Magium\Magento\Actions\Admin\Configuration\SettingModifier */

        $this->getAction(Login::ACTION)->login();
        $this->getNavigator(AdminMenu::NAVIGATOR)->navigateTo('System/Configuration');

        $modifier->set('General/Store Information::label=Store Name', 'Test');

        self::assertEquals('Test', $this->webdriver->byId('general_store_information_name')->getAttribute('value'));

        // Testing to make sure that the value is cleared

        $modifier->set('General/Store Information::label=Store Name', 'Test 2');

        self::assertEquals('Test 2', $this->webdriver->byId('general_store_information_name')->getAttribute('value'));
    }


    public function testSetSelectSettingUsingValue()
    {
        $modifier = $this->getAction(SettingModifier::ACTION);
        /** @var $modifier \Magium\Magento\Actions\Admin\Configuration\SettingModifier */

        $this->getAction(Login::ACTION)->login();
        $this->getNavigator(AdminMenu::NAVIGATOR)->navigateTo('System/Configuration');

        $modifier->set('general_store_information_merchant_country', 'AR');

        $selectedOptions = (new FastSelectElement($this->webdriver, '//*[@id="general_store_information_merchant_country"]'))->getSelectedOptions();

        self::assertCount(1, $selectedOptions);
        self::assertCount(2, $selectedOptions[0]);
        self::assertEquals('AR', $selectedOptions[0]['value']);

    }


    public function testSetSelectMultipleSettingUsingValueOnSingleReturnsLast()
    {
        $modifier = $this->getAction(SettingModifier::ACTION);
        /** @var $modifier \Magium\Magento\Actions\Admin\Configuration\SettingModifier */

        $this->getAction(Login::ACTION)->login();
        $this->getNavigator(AdminMenu::NAVIGATOR)->navigateTo('System/Configuration');

        $modifier->set('general_store_information_merchant_country', ['CA', 'US']);

        $selectedOptions = (new FastSelectElement($this->webdriver, '//*[@id="general_store_information_merchant_country"]'))->getSelectedOptions();

        self::assertCount(1, $selectedOptions);
        self::assertEquals('US', $selectedOptions[0]['value']);

    }

    public function testSetSelectMultipleSettingUsingValue()
    {
        $modifier = $this->getAction(SettingModifier::ACTION);
        /** @var $modifier \Magium\Magento\Actions\Admin\Configuration\SettingModifier */

        $this->getAction(Login::ACTION)->login();
        $this->getNavigator(AdminMenu::NAVIGATOR)->navigateTo('System/Configuration');

        $modifier->set('General/Countries Options::label=Allow Countries', ['CA', 'US']);

        $selectedOptions = (new FastSelectElement($this->webdriver, '//*[@id="general_country_allow"]'))->getSelectedOptions();

        self::assertCount(2, $selectedOptions);
        self::assertEquals('CA', $selectedOptions[0]['value']);
        self::assertEquals('US', $selectedOptions[1]['value']);

    }

    public function testSetSelectSettingUsingLabel()
    {
        $modifier = $this->getAction(SettingModifier::ACTION);
        /** @var $modifier \Magium\Magento\Actions\Admin\Configuration\SettingModifier */

        $this->getAction(Login::ACTION)->login();
        $this->getNavigator(AdminMenu::NAVIGATOR)->navigateTo('System/Configuration');

        $modifier->set('general_store_information_merchant_country', 'label=Argentina');

        $selectedOptions = (new FastSelectElement($this->webdriver, '//*[@id="general_store_information_merchant_country"]'))->getSelectedOptions();

        self::assertCount(1, $selectedOptions);
        self::assertCount(2, $selectedOptions[0]);
        self::assertEquals('AR', $selectedOptions[0]['value']);

    }

}