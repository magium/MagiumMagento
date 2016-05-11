<?php

namespace Tests\Magium\Magento\Checkout;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Actions\Admin\Configuration\SettingModifier;
use Magium\Magento\Actions\Admin\Login\Login;
use Magium\Magento\Actions\Admin\Tables\RemoveTermsAndConditions;
use Magium\Magento\Actions\Admin\Widget\AddTermsAndConditions;
use Magium\Magento\Actions\Admin\Widget\TermsAndConditions;
use Magium\Magento\Actions\Cart\AddSimpleProductToCart;
use Magium\Magento\Actions\Checkout\GuestCheckout;
use Magium\Magento\Navigators\Admin\AdminMenu;
use Magium\Magento\Navigators\Catalog\DefaultSimpleProduct;
use Magium\Magento\Navigators\Catalog\DefaultSimpleProductCategory;

class TermsTest extends AbstractMagentoTestCase
{

    public function testTermsAndConditions()
    {
        $this->setPaymentMethod('CashOnDelivery');
        $this->getAction(Login::ACTION)->login();
        $this->getNavigator(AdminMenu::NAVIGATOR)->navigateTo('System/Configuration');
        $modifier = $this->getAction(SettingModifier::ACTION);
        /* @var $modifier \Magium\Magento\Actions\Admin\Configuration\SettingModifier */

        $modifier->set('Checkout/Checkout Options::label=Enable Terms and Conditions', SettingModifier::SETTING_OPTION_YES, true); // True saves it

        $this->getAction(RemoveTermsAndConditions::ACTION)->removeAll(true);
        $terms = $this->getAction(TermsAndConditions::ACTION);
        /* @var $terms TermsAndConditions */
        $terms->setName('test');
        $terms->setCheckboxText('Terms');
        $terms->setStatus('Enabled');
        $terms->setStoreView('All Store Views');
        $terms->setContent('Conditions');
        $terms->execute();

        $this->commandOpen($this->getTheme()->getBaseUrl());
        $this->getNavigator(DefaultSimpleProductCategory::NAVIGATOR)->navigateTo();
        $this->getNavigator(DefaultSimpleProduct::NAVIGATOR)->navigateTo();
        $this->getAction(AddSimpleProductToCart::ACTION)->execute();
        $guestCheckout = $this->getAction(GuestCheckout::ACTION);
        /* @var $guestCheckout GuestCheckout */
        $terms = $this->getAction(\Magium\Magento\Actions\Checkout\Steps\TermsAndConditions::ACTION);
        /* @var $terms \Magium\Magento\Actions\Checkout\Steps\TermsAndConditions */
        $terms->setCheckboxText('Terms');
        $terms->configureCheckout($guestCheckout);

        $guestCheckout->execute();

        $this->getAction(Login::ACTION)->login();
        $this->getNavigator(AdminMenu::NAVIGATOR)->navigateTo('System/Configuration');
        $modifier = $this->getAction(SettingModifier::ACTION);
        /* @var $modifier \Magium\Magento\Actions\Admin\Configuration\SettingModifier */

        $modifier->set('Checkout/Checkout Options::label=Enable Terms and Conditions', SettingModifier::SETTING_OPTION_NO, true); // True saves it
    }

}