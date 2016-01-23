<?php

namespace Tests\Magium\Magento\Admin\Configuration\PaymentMethods;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Actions\Admin\Configuration\AbstractSettingGroup;
use Magium\Magento\Actions\Admin\Configuration\PaymentMethods\AbstractPaymentMethod;
use Magium\Magento\Actions\Admin\Configuration\SettingModifier;
use Magium\Magento\Actions\Admin\Login\Login;
use Magium\Magento\Navigators\Admin\AdminMenu;
use Magium\Magento\Navigators\Admin\SystemConfiguration;
use Magium\WebDriver\FastSelectElement;

abstract class AbstractPaymentMethodTest extends AbstractMagentoTestCase
{
    protected function enablePaymentMethod($action, $id)
    {
        $this->getAction(Login::ACTION)->login();
        $this->getNavigator(AdminMenu::NAVIGATOR)->navigateTo('System/Configuration');

        $paymentMethod = $this->getAction($action);
        /* @var $paymentMethod \Magium\Magento\Actions\Admin\Configuration\PaymentMethods\CashOnDelivery */
        $paymentMethod->setEnabled(SettingModifier::SETTING_OPTION_YES);
        $paymentMethod->execute();
        $this->getNavigator(SystemConfiguration::NAVIGATOR)->navigateTo('General/Merchant Location');

        $this->getNavigator(SystemConfiguration::NAVIGATOR)->navigateTo('Payment Methods/' . $paymentMethod::NAME);
        $select = new FastSelectElement($this->webdriver, sprintf('//select[@id="%s"]', $id));
        $options = $select->getSelectedOptions();
        self::assertCount(1, $options);
        self::assertEquals(1, $options[0]['value']);
    }


    protected function changeTitle($action, $id, $originalTitle)
    {
        $this->getAction(Login::ACTION)->login();
        $this->getNavigator(AdminMenu::NAVIGATOR)->navigateTo('System/Configuration');

        $paymentMethod = $this->getAction($action);
        /* @var $paymentMethod \Magium\Magento\Actions\Admin\Configuration\PaymentMethods\CashOnDelivery */
        $paymentMethod->setEnabled(SettingModifier::SETTING_OPTION_YES);
        $paymentMethod->setTitle('This is a title');
        $paymentMethod->execute();
        $this->getNavigator(SystemConfiguration::NAVIGATOR)->navigateTo('General/Merchant Location');

        $this->getNavigator(SystemConfiguration::NAVIGATOR)->navigateTo('Payment Methods/' . $paymentMethod::NAME);
        $title = $this->byId($id)->getAttribute('value');

        self::assertEquals('This is a title', $title);
        $paymentMethod->setTitle($originalTitle);
        $paymentMethod->execute();
    }
}