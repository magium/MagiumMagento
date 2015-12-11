<?php

namespace Magium\Magento\Actions\Admin\Configuration;

use Facebook\WebDriver\WebDriverElement;
use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Navigators\Admin\AdminMenuNavigator;
use Magium\Magento\Navigators\Admin\SystemConfigurationNavigator;
use Magium\WebDriver\WebDriver;

class SettingModifier
{

    protected $webDriver;
    protected $testCase;
    protected $systemConfigurationNavigator;

    /**
     * SettingModifier constructor.
     * @param $webDriver
     * @param $testCase
     * @param $systemConfigurationNavigator
     */
    public function __construct(
        WebDriver                       $webDriver,
        AbstractMagentoTestCase         $testCase,
        SystemConfigurationNavigator    $systemConfigurationNavigator
    )
    {
        $this->webDriver = $webDriver;
        $this->testCase = $testCase;
        $this->systemConfigurationNavigator = $systemConfigurationNavigator;
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

    public function set($identifier, $value)
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
        if (preg_match('/^name=(.+)$', $setting, $matches)) {

        } else {
            $element = $this->webDriver->byId($setting);
        }
        $this->handleElementSetting($element, $value);
    }

    protected function handleElementSetting(WebDriverElement $element, $value)
    {

    }

}