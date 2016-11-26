<?php

namespace Magium\Magento\Actions\Admin\Configuration;

use Magium\AbstractTestCase;
use Magium\Actions\StaticActionInterface;
use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Themes\Admin\ThemeConfiguration;
use Magium\WebDriver\ExpectedCondition;
use Magium\WebDriver\WebDriver;

class Save implements StaticActionInterface
{
    const ACTION = 'Admin\Configuration\Save';

    protected $webDriver;
    protected $adminThemeConfiguration;
    protected $testCase;

    public function __construct(
        WebDriver                   $webDriver,
        ThemeConfiguration     $adminThemeConfiguration,
        AbstractMagentoTestCase     $testCase
    ) {
        $this->webDriver                = $webDriver;
        $this->adminThemeConfiguration  = $adminThemeConfiguration;
        $this->testCase                 = $testCase;
    }

    public function save()
    {

        $this->webDriver->executeScript('window.scrollTo(0, 0);');

        $this->webDriver->wait()->until(ExpectedCondition::elementExists($this->adminThemeConfiguration->getSystemConfigurationSaveButtonXpath(), AbstractTestCase::BY_XPATH));
        $this->testCase->assertElementDisplayed($this->adminThemeConfiguration->getSystemConfigurationSaveButtonXpath(), AbstractTestCase::BY_XPATH);
        $element = $this->webDriver->byXpath($this->adminThemeConfiguration->getSystemConfigurationSaveButtonXpath());
        $element->click();
        $this->webDriver->wait()->until(ExpectedCondition::elementRemoved($element));
        $this->testCase->assertElementDisplayed($this->adminThemeConfiguration->getSystemConfigSaveSuccessfulXpath(), WebDriver::BY_XPATH);
    }

    public function execute()
    {
        $this->save();
    }

}