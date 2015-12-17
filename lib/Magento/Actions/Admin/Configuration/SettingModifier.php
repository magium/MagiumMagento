<?php

namespace Magium\Magento\Actions\Admin\Configuration;

use Facebook\WebDriver\WebDriverElement;
use Facebook\WebDriver\WebDriverSelect;
use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Navigators\Admin\SystemConfiguration;
use Magium\Magento\Themes\Admin\ThemeConfiguration;
use Magium\WebDriver\FastSelectElement;
use Magium\WebDriver\WebDriver;

class SettingModifier
{

    const SETTING_OPTION_YES = 1;
    const SETTING_OPTION_NO = 0;

    protected $webDriver;
    protected $testCase;
    protected $systemConfigurationNavigator;
    protected $themeConfiguration;
    protected $save;

    protected $dataChanged = false;

    /**
     * SettingModifier constructor.
     * @param $webDriver
     * @param $testCase
     * @param $systemConfigurationNavigator
     * @param $themeConfiguration
     */
    public function __construct(
        WebDriver                       $webDriver,
        AbstractMagentoTestCase         $testCase,
        SystemConfiguration             $systemConfigurationNavigator,
        ThemeConfiguration              $themeConfiguration,
        Save                            $save
    )
    {
        $this->webDriver = $webDriver;
        $this->testCase = $testCase;
        $this->systemConfigurationNavigator = $systemConfigurationNavigator;
        $this->themeConfiguration = $themeConfiguration;
        $this->save = $save;
    }

    /**
     * Changes a system configuration setting based off of the identifier.  The identifier can be specified in 4
     * possible ways.
     *
     * * Tab/Section::setting_id (will ensure that the correct section is navigated to)
     * * setting_id (will not navigate (no section information)
     * * Tab/Section::name=Text Of Setting (will ensure that the correct section is navigated to, uses setting name (exact), not ID)
     * * name=Text Of Setting (will not navigate, uses setting name (exact) not ID)
     *
     * @param $identifier
     * @param $value
     * @throws \Magium\InvalidInstructionException
     */

    public function set($identifier, $value, $save = false)
    {
        $parts = explode('::', $identifier);
        $setting = null;
        if (count($parts) === 2) {
            $this->systemConfigurationNavigator->navigateTo($parts[0]);
            $setting = $parts[1];
        } else {
            $setting = $parts[0];
        }
        $matches = null;
        if (preg_match('/^label=(.+)$/', $setting, $matches)) {
            $xpath = '';
            if (count($xpath) === 2) {
                $nav = explode('/', $parts[0]);
                $xpath = $this->themeConfiguration->getSystemConfigSectionDisplayCheckXpath($nav[1]) . '/descendant::';
            }
            $xpath .= $this->themeConfiguration->getSystemConfigSettingLabelXpath($matches[1]);
            $labelElement = $this->webDriver->byXpath($xpath);
            $setting = $labelElement->getAttribute('for');
        }

        $this->handleElementSetting($setting, $value);
        if ($save) {
            $this->save->save();
        }
    }

    protected function handleElementSetting($elementId, $value)
    {
        $element = $this->webDriver->byId($elementId);

        if (strtolower($element->getTagName()) === 'select') {
            if (!is_array($value)) {
                $value = [$value];
            }
            $xpath = sprintf('//select[@id="%s"]', $elementId);
            $select = new FastSelectElement($this->webDriver, $xpath);
//            $options = $select->getAllSelectedOptions();
            $select->clearSelectedOptions();
            foreach ($value as $v) {
                $xpath = sprintf('//select[@id="%s"]', $elementId);
                $matches = null;
                if (preg_match('/^label=(.+)$/', $v, $matches)) {
                    $xpath .= sprintf('/descendant::option[.="%s"]', str_replace('"', '\"', $matches[1]));
                    $this->webDriver->byXpath($xpath)->click();
                } else {
                    $xpath .= sprintf('/descendant::option[@value="%s"]', str_replace('"', '\"', $v));
                    $this->webDriver->byXpath($xpath)->click();
                }
            }

        } else if (strtolower($element->getTagName()) === 'input') {
            if ($element->getAttribute('value') != $value) {
                $element->clear();
                $element->sendKeys($value);
                $this->dataChanged = true;
            }
        }
    }
}