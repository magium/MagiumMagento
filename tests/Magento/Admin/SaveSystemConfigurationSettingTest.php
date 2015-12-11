<?php

namespace Tests\Magento\Admin;

use Magium\Magento\AbstractMagentoTestCase;

class SaveSystemConfigurationSettingTest extends AbstractMagentoTestCase
{

    public function testLoginAdmin()
    {
        $adminThemeConfiguration = $this->getTheme('Admin\ThemeConfiguration');

        $this->getAction('Admin\Login\Login')->login();
        $enabler = $this->getAction('Admin\Configuration\Enabler');
        /** @var $enabler \Magium\Magento\Actions\Admin\Configuration\Enabler */

        $enabler->disable('Payment Methods/Saved CC');
        $settingXpath = $adminThemeConfiguration->getSystemConfigToggleEnableXpath('Saved CC', 0); // Note the 0
        $element = $this->webdriver->byXpath($settingXpath);
        self::assertNotNull($element->getAttribute('selected'));

        $enabler->enable('Payment Methods/Saved CC');

        $settingXpath = $adminThemeConfiguration->getSystemConfigToggleEnableXpath('Saved CC', 1); // Note the 1
        $element = $this->webdriver->byXpath($settingXpath);
        self::assertNotNull($element->getAttribute('selected'));


        $enabler->disable('Payment Methods/Saved CC');

        $settingXpath = $adminThemeConfiguration->getSystemConfigToggleEnableXpath('Saved CC', 0); // Note the 0
        $element = $this->webdriver->byXpath($settingXpath);
        self::assertNotNull($element->getAttribute('selected'));

    }


    
}