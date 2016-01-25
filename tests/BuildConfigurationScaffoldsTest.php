<?php

class BuildConfigurationScaffoldsTest extends \Magium\Magento\AbstractMagentoTestCase
{
    public function testExecute()
    {
        $tabs = [];
        $theme = $this->getTheme('Admin\ThemeConfiguration');
        /* @var $theme Magium\Magento\Themes\Admin\ThemeConfiguration */
        $this->getAction('Admin\Login\Login')->login();
        $this->getNavigator('Admin\AdminMenu')->navigateTo('System/Configuration');

        $tabElements = $this->webdriver->findElements(\Facebook\WebDriver\WebDriverBy::xpath('//ul[@id="system_config_tabs"]/descendant::dl/dd'));
        foreach ($tabElements as $tabElement) {
            $tab = trim($tabElement->getText());
            $sections = $this->webdriver->findElements(\Facebook\WebDriver\WebDriverBy::xpath('//form[@id="config_edit_form"]/descendant::div[contains(concat(" ",normalize-space(@class)," ")," section-config ")]/div[contains(concat(" ",normalize-space(@class)," ")," entry-edit-head ")]/'));
            foreach ($sections as $sectionElement) {
                $section = trim($sectionElement->getText());
            }
        }

        $a = 1;
    }
}