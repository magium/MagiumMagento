<?php

namespace Tests\Magium\MagentoEE114\Checkout;

use Magium\Magento\Themes\MagentoEE114\ThemeConfiguration;

class SavedCCPaymentTest extends \Tests\Magium\Magento\Checkout\SavedCCPaymentTest
{


    protected function setUp()
    {
        parent::setUp();
        $this->getTheme(
            \Magium\Magento\Themes\Admin\ThemeConfiguration::THEME
        )->set(
            'baseUrl',
            $this->getTheme(ThemeConfiguration::THEME)->getBaseUrl() . 'admin/'
        );
        $this->switchThemeConfiguration(ThemeConfiguration::THEME);
    }
}