<?php

namespace Magium\Magento\Themes\Admin;

use Magium\AbstractConfigurableElement;
use Magium\Magento\Themes\NavigableThemeInterface;

class ThemeConfiguration extends AbstractConfigurableElement implements  NavigableThemeInterface
{

    const THEME = 'Admin\ThemeConfiguration';

    protected $baseUrl = 'http://localhost/admin';

    protected $homeXpath = '//img[@class="logo"]';

    protected $loginUsernameField           = '//input[@type="text" and @id="username"]';
    protected $loginPasswordField           = '//input[@type="password" and @id="login"]';
    protected $loginSubmitButton            = '//input[@type="submit" and @value="{{Login}}"]';
    
    protected $navigationBaseXPathSelector          = '//ul[@id="nav"]';
//    protected $navigationChildXPathSelector1         = 'li/descendant::span[.="{{%s}}"]';
    protected $navigationChildXPathSelector         = 'li[contains(concat(" ",normalize-space(@class)," ")," level%d ")]/a[.="{{%s}}"]/..';

    protected $adminPopupMessageContainerXpath         = '//*[@id="message-popup-window"]';
    protected $adminPopupMessageCloseButtonXpath        = '//*[@id="message-popup-window"]/descendant::*[@title="close"]';

    protected $systemConfigTabsXpath                = '//ul[@id="system_config_tabs"]/descendant::a[concat(" ",normalize-space(.)," ") = " {{%s}} "]';
    protected $systemConfigSectionToggleXpath             = '//form[@id="config_edit_form"]/descendant::div[contains(concat(" ",normalize-space(@class)," ")," section-config ")]/descendant::a[.="{{%s}}"]';
    protected $systemConfigSectionDisplayCheckXpath            = '//legend[.="{{%s}}"]/ancestor::fieldset';
    protected $systemConfigToggleEnableXpath            = '//legend[.="{{%s}}"]/../descendant::td[concat(" ",normalize-space(.)," ") = " {{Enabled}} "]/../td/descendant::select/option[@value="%d"]';


    protected $systemConfigurationSaveButtonXpath       = '//div[@class="main-col-inner"]/div[@class="content-header"]/descendant::button[@title="{{Save Config}}"]';

    protected $systemConfigSaveSuccessfulXpath          = '//li[@class="success-msg"]/descendant::span[.="{{The configuration has been saved}}."]';

    protected $testLoggedInAtBaseUrl                     = '//a[@class="active"]/span[.="{{Dashboard}}"]';

    protected $tableButtonXpath                         = '//table[@class="actions"]/descendant::span[.="{{%s}}"]';

    protected $selectOrderXpath                         = '//td[concat(" ",normalize-space(.)," ") = " %s "]/../td/a[.="{{View}}"]';

    protected $systemConfigSettingLabelXpath            = '//td[@class="label"]/label[.=" {{%s}}"]';

    /**
     * @return string
     */
    public function getHomeXpath()
    {
        return $this->homeXpath;
    }

    /**
     * @return string
     */
    public function getSystemConfigSettingLabelXpath($label)
    {
        $return = sprintf($this->systemConfigSettingLabelXpath, $label);
        return $this->translatePlaceholders($return);
    }

    /**
     * Why is this an option?  So you can have a different theme setup for different languages and still use the same code.
     *
     * @var string
     */

    protected $searchButtonText                         = '{{Search}}';

    /**
     * @return Translator
     */
    public function getTranslator()
    {
        return $this->translator;
    }

    /**
     * @return string
     */
    public function getLoginUsernameField()
    {
        return $this->translatePlaceholders($this->loginUsernameField);
    }

    /**
     * @return string
     */
    public function getLoginPasswordField()
    {
        return $this->translatePlaceholders($this->loginPasswordField);
    }

    /**
     * @return string
     */
    public function getLoginSubmitButton()
    {
        return $this->translatePlaceholders($this->loginSubmitButton);
    }

    /**
     * @return string
     */
    public function getNavigationBaseXPathSelector()
    {
        return $this->translatePlaceholders($this->navigationBaseXPathSelector);
    }

    /**
     * @return string
     */
    public function getNavigationChildXPathSelector($level, $text)
    {
        $return = sprintf($this->navigationChildXPathSelector, $level, $text);
        return $this->translatePlaceholders($return);
    }

    /**
     * @return mixed
     */
    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    /**
     * @return string
     */
    public function getSearchButtonText()
    {
        return $this->translatePlaceholders($this->searchButtonText);
    }



    /**
     * @return string
     */
    public function getSelectOrderXpath($order)
    {
        $return = sprintf($this->selectOrderXpath, $order);
        return $this->translatePlaceholders($return);
    }

    /**
     * @return string
     */
    public function getTableButtonXpath($buttonValue)
    {
        $return = sprintf($this->tableButtonXpath, $buttonValue);
        return $this->translatePlaceholders($return);
    }



    /**
     * @return string
     */
    public function getTestLoggedInAtBaseUrl()
    {
        return $this->translatePlaceholders($this->testLoggedInAtBaseUrl);
    }



    /**
     * @return string
     */
    public function getSystemConfigSaveSuccessfulXpath()
    {
        return $this->translatePlaceholders($this->systemConfigSaveSuccessfulXpath);
    }

    /**
     * @return string
     */
    public function getSystemConfigurationSaveButtonXpath()
    {
        return $this->translatePlaceholders($this->systemConfigurationSaveButtonXpath);
    }

    /**
     * @return string
     */
    public function getSystemConfigSectionToggleXpath($section)
    {
        $return = sprintf($this->systemConfigSectionToggleXpath, $section);
        return $this->translatePlaceholders($return);
    }

    /**
     * @return string
     */
    public function getSystemConfigSectionDisplayCheckXpath($section)
    {
        $return = sprintf($this->systemConfigSectionDisplayCheckXpath, $section);
        return $this->translatePlaceholders($return);
    }

    /**
     * @return string
     */
    public function getSystemConfigToggleEnableXpath($section, $option)
    {
        $return = sprintf($this->systemConfigToggleEnableXpath, $section, $option);
        return $this->translatePlaceholders($return);
    }

    /**
     * @return string
     */
    public function getSystemConfigTabsXpath($tabName)
    {
        $return = sprintf($this->systemConfigTabsXpath, $tabName);
        return $this->translatePlaceholders($return);
    }


    public function getAdminPopupMessageContainerXpath()
    {
        return $this->translatePlaceholders($this->adminPopupMessageContainerXpath);
    }

    public function getAdminPopupMessageCloseButtonXpath()
    {
        return $this->translatePlaceholders($this->adminPopupMessageCloseButtonXpath);
    }

}