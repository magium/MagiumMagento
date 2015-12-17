<?php

namespace Tests\Magento\Admin\Configuration\PaymentMethods;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Actions\Admin\Configuration\PaymentMethods\AbstractPaymentMethod;
use Magium\Magento\Actions\Admin\Configuration\PaymentMethods\CashOnDelivery;
use Magium\Magento\Actions\Admin\Login\Login;
use Magium\Magento\Navigators\Admin\AdminMenu;
use Magium\Magento\Navigators\Admin\SystemConfiguration;
use Magium\WebDriver\FastSelectElement;

class CashOnDeliveryTest extends AbstractMagentoTestCase
{

    public function testEnablePaymentMethod()
    {
        $this->getAction(Login::ACTION)->login();
        $this->getNavigator(AdminMenu::NAVIGATOR)->navigateTo('System/Configuration');

        $paymentMethod = $this->getAction(CashOnDelivery::ACTION);
        /* @var $paymentMethod \Magium\Magento\Actions\Admin\Configuration\PaymentMethods\CashOnDelivery */
        $paymentMethod->setEnabled(AbstractPaymentMethod::SETTING_OPTION_YES);
        $paymentMethod->execute();
        $this->getNavigator(SystemConfiguration::ACTION)->navigateTo('General/Merchant Location');

        $this->getNavigator(SystemConfiguration::ACTION)->navigateTo('Payment Methods/' . CashOnDelivery::NAME);
        $select = new FastSelectElement($this->webdriver, '//select[@id="payment_cashondelivery_active"]');
        $options = $select->getSelectedOptions();
        self::assertCount(1, $options);
        self::assertEquals(1, $options[0]['value']);
    }


    public function testChangeTitle()
    {
        $this->getAction(Login::ACTION)->login();
        $this->getNavigator(AdminMenu::NAVIGATOR)->navigateTo('System/Configuration');

        $paymentMethod = $this->getAction(CashOnDelivery::ACTION);
        /* @var $paymentMethod \Magium\Magento\Actions\Admin\Configuration\PaymentMethods\CashOnDelivery */
        $paymentMethod->setTitle('This is a title');
        $paymentMethod->execute();
        $this->getNavigator(SystemConfiguration::ACTION)->navigateTo('General/Merchant Location');

        $this->getNavigator(SystemConfiguration::ACTION)->navigateTo('Payment Methods/' . CashOnDelivery::NAME);
        $title = $this->byId('payment_cashondelivery_title')->getAttribute('value');

        self::assertEquals('This is a title', $title);
        $paymentMethod->setTitle('Cash On Delivery');
        $paymentMethod->execute();
    }
}