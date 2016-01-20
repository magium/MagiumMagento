<?php

namespace Tests\Magium\MagentoEE112\Checkout;

use Magium\Magento\Themes\MagentoEE112\ThemeConfiguration;

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