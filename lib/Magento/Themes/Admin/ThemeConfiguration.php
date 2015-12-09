<?php

namespace Magium\Magento\Themes\Admin;

use Magium\AbstractConfigurableElement;
use Magium\Magento\Themes\NavigableThemeInterface;

class ThemeConfiguration extends AbstractConfigurableElement implements  NavigableThemeInterface
{

    protected $baseUrl;

    protected $loginUsernameField           = '//input[@type="text" and @id="username"]';
    protected $loginPasswordField           = '//input[@type="password" and @id="login"]';
    protected $loginSubmitButton            = '//input[@type="submit" and @value="{{Login}}"]';
    
    protected $navigationBaseXPathSelector          = '//ul[@id="nav"]';
    protected $navigationChildXPathSelector1         = 'li/descendant::span[.="%s"]';
    protected $navigationChildXPathSelector         = 'li[contains(concat(" ",normalize-space(@class)," ")," level%d ")]/a[.="%s"]/..';

    protected $adminPopupMessageContainerXpath         = '//*[@id="message-popup-window"]';
    protected $adminPopupMessageCloseButtonXpath        = '//*[@id="message-popup-window"]/descendant::*[@title="close"]';

    protected $systemConfigTabsXpath                = '//ul[@id="system_config_tabs"]/descendant::a[contains(concat(" ",normalize-space(.)," ")," %s ")]';
    protected $systemConfigSectionToggleXpath             = '//form[@id="config_edit_form"]/descendant::div[contains(concat(" ",normalize-space(@class)," ")," section-config ")]/descendant::a[.="%s"]';
    protected $systemConfigSectionDisplayCheckXpath            = '//legend[.="%s"]/ancestor::fieldset';
    protected $systemConfigToggleEnableXpath            = '//legend[.="%s"]/../descendant::td[concat(" ",normalize-space(.)," ") = " {{Enabled}} "]/../td/descendant::select/option[@value="%d"]';

    protected $systemConfigurationSaveButtonXpath       = '//div[@class="main-col-inner"]/div[@class="content-header"]/descendant::button[@title="{{Save Config}}"]';

    protected $systemConfigSaveSuccessfulXpath          = '//li[@class="success-msg"]/descendant::span[.="{{The configuration has been saved}}."]';

    protected $testLoggedInAtBaseUrl                     = '//a[@class="active"]/span[.="{{Dashboard}}"]';

    protected $tableButtonXpath                         = '//table[@class="actions"]/descendant::span[.="%s"]';

    protected $selectOrderXpath                         = '//td[concat(" ",normalize-space(.)," ") = " %s "]/../td/a[.="{{View}}"]';

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
        return $this->translate($this->loginUsernameField);
    }

    /**
     * @return string
     */
    public function getLoginPasswordField()
    {
        return $this->translate($this->loginPasswordField);
    }

    /**
     * @return string
     */
    public function getLoginSubmitButton()
    {
        return $this->translate($this->loginSubmitButton);
    }

    /**
     * @return string
     */
    public function getNavigationBaseXPathSelector()
    {
        return $this->translate($this->navigationBaseXPathSelector);
    }

    /**
     * @return string
     */
    public function getNavigationChildXPathSelector()
    {
        return $this->translate($this->navigationChildXPathSelector);
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
        return $this->translate($this->searchButtonText);
    }



    /**
     * @return string
     */
    public function getSelectOrderXpath()
    {
        return $this->translate($this->selectOrderXpath);
    }

    /**
     * @return string
     */
    public function getTableButtonXpath()
    {
        return $this->translate($this->tableButtonXpath);
    }



    /**
     * @return string
     */
    public function getTestLoggedInAtBaseUrl()
    {
        return $this->translate($this->testLoggedInAtBaseUrl);
    }



    /**
     * @return string
     */
    public function getSystemConfigSaveSuccessfulXpath()
    {
        return $this->translate($this->systemConfigSaveSuccessfulXpath);
    }

    /**
     * @return string
     */
    public function getSystemConfigurationSaveButtonXpath()
    {
        return $this->translate($this->systemConfigurationSaveButtonXpath);
    }

    /**
     * @return string
     */
    public function getSystemConfigSectionToggleXpath()
    {
        return $this->translate($this->systemConfigSectionToggleXpath);
    }

    /**
     * @return string
     */
    public function getSystemConfigSectionDisplayCheckXpath()
    {
        return $this->translate($this->systemConfigSectionDisplayCheckXpath);
    }

    /**
     * @return string
     */
    public function getSystemConfigToggleEnableXpath()
    {
        return $this->translate($this->systemConfigToggleEnableXpath);
    }

    /**
     * @return string
     */
    public function getSystemConfigTabsXpath()
    {
        return $this->translate($this->systemConfigTabsXpath);
    }

    /**
     * @return string
     */
    public function getSystemConfigSectionXpath()
    {
        return $this->translate($this->systemConfigSectionXpath);
    }

    public function getAdminPopupMessageContainerXpath()
    {
        return $this->translate($this->adminPopupMessageContainerXpath);
    }

    public function getAdminPopupMessageCloseButtonXpath()
    {
        return $this->translate($this->adminPopupMessageCloseButtonXpath);
    }

}