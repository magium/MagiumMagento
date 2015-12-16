<?php

namespace Tests\Magento\Admin;

use Facebook\WebDriver\WebDriverSelect;
use Magium\Magento\AbstractMagentoTestCase;
use Magium\WebDriver\FastSelectElement;

class SettingModifierTest extends AbstractMagentoTestCase
{

    public function testTextSettingModifierWithoutNavigation()
    {
        $modifier = $this->getAction('Admin\Configuration\SettingModifier');
        /** @var $modifier \Magium\Magento\Actions\Admin\Configuration\SettingModifier */

        $this->getAction('Admin\Login\Login')->login();
        $this->getNavigator('Admin\AdminMenu')->navigateTo('System/Configuration');
        $this->getNavigator('Admin\SystemConfiguration')->navigateTo('General/Store Information');

        $modifier->set('general_store_information_name', 'Test');

        self::assertEquals('Test', $this->webdriver->byId('general_store_information_name')->getAttribute('value'));

        // Testing to make sure that the value is cleared

        $modifier->set('general_store_information_name', 'Test 2');

        self::assertEquals('Test 2', $this->webdriver->byId('general_store_information_name')->getAttribute('value'));

    }

    public function testTextSettingModifierSavedWithoutNavigation()
    {
        $modifier = $this->getAction('Admin\Configuration\SettingModifier');
        /** @var $modifier \Magium\Magento\Actions\Admin\Configuration\SettingModifier */

        $this->getAction('Admin\Login\Login')->login();
        $this->getNavigator('Admin\AdminMenu')->navigateTo('System/Configuration');
        $this->getNavigator('Admin\SystemConfiguration')->navigateTo('General/Store Information');

        $modifier->set('general_store_information_name', 'Test', true); // True saves it

        $this->getNavigator('Admin\SystemConfiguration')->navigateTo('Design/Header');
        $this->getNavigator('Admin\SystemConfiguration')->navigateTo('General/Store Information');

        self::assertEquals('Test', $this->webdriver->byId('general_store_information_name')->getAttribute('value'));

        $modifier->set('general_store_information_name', '', true); // True saves it
        self::assertEquals('', $this->webdriver->byId('general_store_information_name')->getAttribute('value'));
    }

    public function testSetSettingUsingNameInsteadOfId()
    {
        $modifier = $this->getAction('Admin\Configuration\SettingModifier');
        /** @var $modifier \Magium\Magento\Actions\Admin\Configuration\SettingModifier */

        $this->getAction('Admin\Login\Login')->login();
        $this->getNavigator('Admin\AdminMenu')->navigateTo('System/Configuration');
        $this->getNavigator('Admin\SystemConfiguration')->navigateTo('General/Store Information');

        $modifier->set('label=Store Name', 'Test');

        self::assertEquals('Test', $this->webdriver->byId('general_store_information_name')->getAttribute('value'));

        // Testing to make sure that the value is cleared

        $modifier->set('label=Store Name', 'Test 2');

        self::assertEquals('Test 2', $this->webdriver->byId('general_store_information_name')->getAttribute('value'));
    }

    public function testTextSettingModifierWithNavigation()
    {
        $modifier = $this->getAction('Admin\Configuration\SettingModifier');
        /** @var $modifier \Magium\Magento\Actions\Admin\Configuration\SettingModifier */

        $this->getAction('Admin\Login\Login')->login();
        $this->getNavigator('Admin\AdminMenu')->navigateTo('System/Configuration');

        $modifier->set('General/Store Information::general_store_information_name', 'Test');

        self::assertEquals('Test', $this->webdriver->byId('general_store_information_name')->getAttribute('value'));

        // Testing to make sure that the value is cleared

        $modifier->set('General/Store Information::general_store_information_name', 'Test 2');

        self::assertEquals('Test 2', $this->webdriver->byId('general_store_information_name')->getAttribute('value'));

    }

    public function testSetSettingUsingNameInsteadOfIdWithNavigation()
    {
        $modifier = $this->getAction('Admin\Configuration\SettingModifier');
        /** @var $modifier \Magium\Magento\Actions\Admin\Configuration\SettingModifier */

        $this->getAction('Admin\Login\Login')->login();
        $this->getNavigator('Admin\AdminMenu')->navigateTo('System/Configuration');

        $modifier->set('General/Store Information::label=Store Name', 'Test');

        self::assertEquals('Test', $this->webdriver->byId('general_store_information_name')->getAttribute('value'));

        // Testing to make sure that the value is cleared

        $modifier->set('General/Store Information::label=Store Name', 'Test 2');

        self::assertEquals('Test 2', $this->webdriver->byId('general_store_information_name')->getAttribute('value'));
    }


    public function testSetSelectSettingUsingValue()
    {
        $modifier = $this->getAction('Admin\Configuration\SettingModifier');
        /** @var $modifier \Magium\Magento\Actions\Admin\Configuration\SettingModifier */

        $this->getAction('Admin\Login\Login')->login();
        $this->getNavigator('Admin\AdminMenu')->navigateTo('System/Configuration');

        $modifier->set('general_store_information_merchant_country', 'AR');

        $selectedOptions = (new FastSelectElement($this->webdriver, '//*[@id="general_store_information_merchant_country"]'))->getSelectedOptions();

        self::assertCount(1, $selectedOptions);
        self::assertCount(2, $selectedOptions[0]);
        self::assertEquals('AR', $selectedOptions[0]['value']);

    }


    public function testSetSelectMultipleSettingUsingValueOnSingleReturnsLast()
    {
        $modifier = $this->getAction('Admin\Configuration\SettingModifier');
        /** @var $modifier \Magium\Magento\Actions\Admin\Configuration\SettingModifier */

        $this->getAction('Admin\Login\Login')->login();
        $this->getNavigator('Admin\AdminMenu')->navigateTo('System/Configuration');

        $modifier->set('general_store_information_merchant_country', ['CA', 'US']);

        $selectedOptions = (new FastSelectElement($this->webdriver, '//*[@id="general_store_information_merchant_country"]'))->getSelectedOptions();

        self::assertCount(1, $selectedOptions);
        self::assertEquals('US', $selectedOptions[1]['value']);

    }

    public function testSetSelectMultipleSettingUsingValue()
    {
        $modifier = $this->getAction('Admin\Configuration\SettingModifier');
        /** @var $modifier \Magium\Magento\Actions\Admin\Configuration\SettingModifier */

        $this->getAction('Admin\Login\Login')->login();
        $this->getNavigator('Admin\AdminMenu')->navigateTo('System/Configuration');

        $modifier->set('General/Countries Options::label=Allow Countries', ['CA', 'US']);

        $selectedOptions = (new FastSelectElement($this->webdriver, '//*[@id="general_country_allow"]'))->getSelectedOptions();

        self::assertCount(2, $selectedOptions);
        self::assertEquals('CA', $selectedOptions[0]['value']);
        self::assertEquals('US', $selectedOptions[1]['value']);

    }

    public function testSetSelectSettingUsingLabel()
    {
        $modifier = $this->getAction('Admin\Configuration\SettingModifier');
        /** @var $modifier \Magium\Magento\Actions\Admin\Configuration\SettingModifier */

        $this->getAction('Admin\Login\Login')->login();
        $this->getNavigator('Admin\AdminMenu')->navigateTo('System/Configuration');

        $modifier->set('general_store_information_merchant_country', 'label=Argentina');

        $selectedOptions = (new FastSelectElement($this->webdriver, '//*[@id="general_store_information_merchant_country"]'))->getSelectedOptions();

        self::assertCount(1, $selectedOptions);
        self::assertCount(2, $selectedOptions[0]);
        self::assertEquals('AR', $selectedOptions[0]['value']);

    }

}