<?php

namespace Tests\Magium\Magento18\Checkout;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Actions\Admin\Configuration\Enabler;
use Magium\Magento\Actions\Admin\Login\Login;
use Magium\Magento\Actions\Cart\AddItemToCart;
use Magium\Magento\Actions\Checkout\GuestCheckout;
use Magium\Magento\Themes\Magento18\ThemeConfiguration;

class SavedCCPaymentTest extends \Tests\Magium\Magento\Checkout\SavedCCPaymentTest
{


    protected function setUp()
    {
        parent::setUp();
        $this->getTheme(
            \Magium\Magento\Themes\Admin\ThemeConfiguration::THEME
        )->set(
            'baseUrl',
            $this->getTheme(ThemeConfiguration::THEME)->getBaseUrl() . 'index.php/admin/'
        );
        $this->switchThemeConfiguration(ThemeConfiguration::THEME);
    }
}
