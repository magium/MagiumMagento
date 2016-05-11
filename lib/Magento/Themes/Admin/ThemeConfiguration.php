<?php

namespace Magium\Magento\Themes\Admin;

use Magium\AbstractConfigurableElement;
use Magium\AbstractTestCase;
use Magium\Magento\Themes\NavigableThemeInterface;

class ThemeConfiguration extends AbstractConfigurableElement implements  NavigableThemeInterface
{

    const THEME = 'Magium\Magento\Themes\Admin\ThemeConfiguration';

    public $baseUrl = 'http://localhost/admin';

    public $homeXpath = '//img[@class="logo"]';

    public $loginUsernameField           = '//input[@type="text" and @id="username"]';
    public $loginPasswordField           = '//input[@type="password" and @id="login"]';
    public $loginSubmitButton            = '//input[@type="submit" and @value="{{Login}}"]';
    
    public $navigationBaseXPathSelector          = '//ul[@id="nav"]';
//    public $navigationChildXPathSelector1         = 'li/descendant::span[.="{{%s}}"]';
    public $navigationChildXPathSelector         = 'a[concat(" ",normalize-space(.)," ") = " {{%s}} "]/..';

    public $adminPopupMessageContainerXpath         = '//*[@id="message-popup-window"]';
    public $adminPopupMessageCloseButtonXpath        = '//*[@id="message-popup-window"]/descendant::*[@title="close"]';

    public $systemConfigTabsXpath                = '//ul[@id="system_config_tabs"]/descendant::a[concat(" ",normalize-space(.)," ") = " {{%s}} "]';
    public $systemConfigSectionToggleXpath             = '//form[@id="config_edit_form"]/descendant::div[contains(concat(" ",normalize-space(@class)," ")," section-config ")]/descendant::a[.="{{%s}}"]';
    public $systemConfigSectionDisplayCheckXpath            = '//legend[.="{{%s}}"]/ancestor::fieldset';
    public $systemConfigToggleEnableXpath            = '//legend[.="{{%s}}"]/../descendant::td[concat(" ",normalize-space(.)," ") = " {{Enabled}} "]/../td/descendant::select/option[@value="%d"]';

    public $xTreeRootXpath                          = '//ul[contains(concat(" ",normalize-space(@class)," ")," x-tree-root-ct ")]/div/li[contains(concat(" ",normalize-space(@class)," ")," x-tree-node ")]/div/a';
    public $xTreeNamedRootXpath                          = '//ul[contains(concat(" ",normalize-space(@class)," ")," x-tree-root-ct ")]/div/li[contains(concat(" ",normalize-space(@class)," ")," x-tree-node ")]/div/a[contains(concat("---",normalize-space(.)), "---{{%s}} (")]';
    public $xTreeChildXpath                          = 'ul/li[contains(concat(" ",normalize-space(@class)," ")," x-tree-node ")]/div/a/span[contains(concat("---",normalize-space(.)), "---{{%s}} (")]/..';
    public $xTreeChildNodePrefixXpath                = '/../..';
    public $xTreeChildNodeExpandPrefixXpath          = '/../img[contains(concat(" ",normalize-space(@class)," ")," x-tree-ec-icon ")]';

    public $systemConfigurationSaveButtonXpath       = '//div[@class="main-col-inner"]/div[@class="content-header"]/descendant::button[@title="{{Save Config}}"]';

    public $systemConfigSaveSuccessfulXpath          = '//li[@class="success-msg"]/descendant::span[.="{{The configuration has been saved}}."]';

    public $testLoggedInAtBaseUrl                     = '//a[@class="active"]/span[.="{{Dashboard}}"]';

    public $tableButtonXpath                         = '//table[@class="actions"]/descendant::span[.="{{%s}}"]';

    public $selectOrderXpath                         = '//table[@id="sales_order_grid_table"]/descendant::td[concat(" ",normalize-space(.)," ") = " %s "]/../td/a[.="{{View}}"]';
    public $selectCustomerXpath                         = '//table[@id="customerGrid_table"]/descendant::td[concat(" ",normalize-space(.)," ") = " %s "]/../td/a[.="{{Edit}}"]';

    public $systemConfigSettingLabelXpath            = '//td[@class="label"]/label[.=" {{%s}}"]';

    public $widgetTabXpath                           = '//a[contains(@class, "tab-item-link")]/span[.="{{%s}}"]';
    public $widgetTabHeaderXpath                     = '//div[@class="entry-edit-head"]/h4[.="{{%s}}"]';
    public $widgetAttributeByLabelXpath              = '//table[@class="form-list"]/descendant::td[@class="label"]/label[.="{{%s}} *" or .="{{%s}}*" or .="{{%s}} " or .="{{%s}}"]/ancestor::tr/td[@class="value"]/*[@name]';
    public $widgetActionButtonXpath                  = '//div[@class="content-header"]/descendant::button/descendant::span[.="{{%s}}"]';

    public $guaranteedPageLoadedElementDisplayedXpath = '//div[@class="footer"]';

    public $successfulActionXpath                    = '//li[@class="success-msg"]';
    public $errorActionXpath                    = '//li[@class="error-msg"]';

    public $shippingCarrierXpath                = '//select[@name="tracking[%d][carrier_code]"]';
    public $shippingTitleXpath                = '//input[@name="tracking[%d][title]"]';
    public $shippingTrackingNumberXpath                = '//input[@name="tracking[%d][number]"]';

    public $formButtonXpath = '//div[@class="content-header"]/p[@class="form-buttons"]/descendant::span[.="{{%s}}"]';

    public $cacheNavigationPath = '{{System}}/{{Cache Management}}';

    public $cacheTargetXpath = '//input[@name="types" and @value="{{%s}}"]';

    public $cacheAllTargetsXpath = '//input[@name="types"]';

    public $cacheMassActionOptionXpath = '//select[@id="cache_grid_massaction-select"]/option[@value="{{%s}}"]';

    public $cacheSubmitXpath = '//button[@title="{{Submit}}"]';

    public $firstTermsRowXpath = '//table[@id="agreementGrid_table"]/tbody/tr/td[not(contains(concat(" ",normalize-space(@class)," ")," empty-text "))]';

    /**
     * @return string
     */
    public function getFirstTermsRowXpath()
    {
        return $this->firstTermsRowXpath;
    }

    /**
     * @return string
     */
    public function getCacheSubmitXpath()
    {
        return $this->translatePlaceholders($this->cacheSubmitXpath);
    }



    /**
     * @return string
     */
    public function getCacheMassActionOptionXpath($option)
    {
        $xpath = sprintf($this->cacheMassActionOptionXpath, $option);
        return $this->translatePlaceholders($xpath);
    }



    /**
     * @return string
     */
    public function getCacheAllTargetsXpath()
    {
        return $this->translatePlaceholders($this->cacheAllTargetsXpath);
    }



    /**
     * @return string
     */
    public function getCacheTargetXpath($type)
    {
        $xpath = sprintf($this->cacheTargetXpath, $type);
        return $this->translatePlaceholders($xpath);
    }



    /**
     * @return string
     */
    public function getCacheNavigationPath()
    {
        return $this->translatePlaceholders($this->cacheNavigationPath);
    }


    public function getFormButtonXpath($button)
    {
        $xpath = sprintf($this->formButtonXpath, $button);
        return $this->translatePlaceholders($xpath);
    }

    /**
     * @return string
     */
    public function getShippingCarrierXpath($count)
    {
        $xpath = sprintf($this->shippingCarrierXpath, $count);
        return $xpath;
    }

    /**
     * @return string
     */
    public function getShippingTitleXpath($count)
    {
        $xpath = sprintf($this->shippingTitleXpath, $count);
        return $xpath;
    }

    /**
     * @return string
     */
    public function getShippingTrackingNumberXpath($count)
    {
        $xpath = sprintf($this->shippingTrackingNumberXpath, $count);
        return $xpath;
    }



    /**
     * @return string
     */
    public function getXTreeChildNodeExpandPrefixXpath()
    {
        return $this->translatePlaceholders($this->xTreeChildNodeExpandPrefixXpath);
    }

    /**
     * @return string
     */
    public function getXTreeNamedRootXpath($category)
    {
        $xpath = sprintf($this->xTreeNamedRootXpath, $category);
        return $this->translatePlaceholders($xpath);
    }




    /**
     * @return string
     */
    public function getXTreeChildNodePrefixXpath()
    {
        return $this->translatePlaceholders($this->xTreeChildNodePrefixXpath);
    }

    /**
     * @return string
     */
    public function getXTreeChildXpath($name)
    {
        $xpath = sprintf($this->xTreeChildXpath, $name);
        return $this->translatePlaceholders($xpath);
    }

    /**
     * @return string
     */
    public function getXTreeRootXpath()
    {
        return $this->translatePlaceholders($this->xTreeRootXpath);
    }



    public function set($name, $value)
    {
        $this->$name = $value;
    }

    /**
     * @return string
     */
    public function getSuccessfulActionXpath()
    {
        return $this->successfulActionXpath;
    }

    /**
     * @return string
     */
    public function getErrorActionXpath()
    {
        return $this->errorActionXpath;
    }



    /**
     * @return string
     */
    public function getWidgetActionButtonXpath($label)
    {
        return $this->translatePlaceholders(sprintf($this->widgetActionButtonXpath, $label));
    }

    /**
     * @return string
     */
    public function getWidgetAttributeByLabelXpath($attribute)
    {
        return $this->translatePlaceholders(sprintf($this->widgetAttributeByLabelXpath, $attribute, $attribute, $attribute, $attribute));
    }



    /**
     * @return string
     */
    public function getWidgetTabHeaderXpath($name)
    {
        return $this->translatePlaceholders(sprintf($this->widgetTabHeaderXpath, $name));
    }

    /**
     * @return string
     */
    public function getWidgetTabXpath($name)
    {
        return $this->translatePlaceholders(sprintf($this->widgetTabXpath, $name));
    }



    public function getGuaranteedPageLoadedElementDisplayedXpath()
    {
        return $this->translatePlaceholders($this->guaranteedPageLoadedElementDisplayedXpath);
    }

    /**
     * @param mixed $guaranteedPageLoadedElementDisplayedXpath
     */
    public function setGuaranteedPageLoadedElementDisplayedXpath($guaranteedPageLoadedElementDisplayedXpath)
    {
        $this->guaranteedPageLoadedElementDisplayedXpath = $guaranteedPageLoadedElementDisplayedXpath;
    }

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

    public $searchButtonText                         = '{{Search}}';

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
    public function getNavigationChildXPathSelector($text)
    {
        $return = sprintf($this->navigationChildXPathSelector, $text);
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
    public function getSelectCustomerXpath($value)
    {
        $xpath = sprintf($this->selectCustomerXpath, $value);
        return $this->translatePlaceholders($xpath);
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

    public function configure(AbstractTestCase $testCase)
    {

    }

}