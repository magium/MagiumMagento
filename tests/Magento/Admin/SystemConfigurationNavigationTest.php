<?php

namespace Tests\Magento\Admin;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Actions\Admin\Login\Login;
use Magium\Magento\Navigators\Admin\AdminMenu;
use Magium\Magento\Navigators\Admin\SystemConfiguration;

class SystemConfigurationNavigationTest extends AbstractMagentoTestCase
{

    public function testConfigPanelOpened()
    {
        $this->getAction(Login::ACTION)->login();
        $adminMenuNavigator = $this->getNavigator(AdminMenu::NAVIGATOR);
        $adminMenuNavigator->navigateTo('System/Configuration');

        $navigator = $this->getNavigator(SystemConfiguration::NAVIGATOR);
        /** @var $navigator \Magium\Magento\Navigators\Admin\SystemConfiguration */
        $navigator->navigateTo('Payment Methods/Saved CC');
        $this->assertElementDisplayed('payment_ccsave_active');

        $navigator->navigateTo('Shipping Methods/Free Shipping');
        $this->assertElementDisplayed('carriers_freeshipping_active');

    }

    public function testConfigPanelNotOpenedForExistingOpenPanel()
    {
        $this->getAction(Login::ACTION)->login();
        $adminMenuNavigator = $this->getNavigator(AdminMenu::NAVIGATOR);
        $adminMenuNavigator->navigateTo('System/Configuration');

        $navigator = $this->getNavigator(SystemConfiguration::NAVIGATOR);
        /** @var $navigator \Magium\Magento\Navigators\Admin\SystemConfiguration */
        $navigator->navigateTo('Payment Methods/Saved CC');
        $this->assertElementDisplayed('payment_ccsave_active');
        $testElement = $this->byId('payment_ccsave_active');

        $navigator->navigateTo('Payment Methods/Saved CC');
        $this->assertElementDisplayed('payment_ccsave_active');

        /*
         * What this is doing is getting an instance of the element from WebDriver and then re-doing the navigation.
         * The navigation should only be executed if it is NOT already on the page.  In other words, if the right
         * tab/section combination is already open, nothing should happen.  But if it is not then WebDriver should click
         * through to that section.  If it does that the reference stored in $testElement will be invalid and will
         * throw an Exception, failing the test.
         */

        $testElement->click();

    }


    public function testConfigPanelReOpenedAfterNavigation()
    {
        /**
         * This test is the same as above, but opposite.  It is ensuring that an exception IS thrown, verifiying
         * that the navigation DID occur.
         */
        $this->setExpectedException('Facebook\WebDriver\Exception\StaleElementReferenceException');
        $this->getAction(Login::ACTION)->login();
        $adminMenuNavigator = $this->getNavigator(AdminMenu::NAVIGATOR);
        $adminMenuNavigator->navigateTo('System/Configuration');

        $navigator = $this->getNavigator(SystemConfiguration::NAVIGATOR);
        /** @var $navigator \Magium\Magento\Navigators\Admin\SystemConfiguration */
        $navigator->navigateTo('Payment Methods/Saved CC');
        $this->assertElementDisplayed('payment_ccsave_active');
        $testElement = $this->byId('payment_ccsave_active');

        $navigator->navigateTo('Shipping Methods/Free Shipping'); // Key part of the test where we naviate away

        $navigator->navigateTo('Payment Methods/Saved CC');
        $this->assertElementDisplayed('payment_ccsave_active');

        $testElement->click();

    }

}