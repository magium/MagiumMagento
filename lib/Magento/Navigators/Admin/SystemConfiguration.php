<?php

namespace Magium\Magento\Navigators\Admin;

use Magium\AbstractTestCase;
use Magium\Actions\WaitForPageLoaded;
use Magium\InvalidInstructionException;
use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Themes\Admin\ThemeConfiguration;
use Magium\Navigators\ConfigurableNavigatorInterface;
use Magium\WebDriver\ExpectedCondition;
use Magium\WebDriver\WebDriver;
class SystemConfiguration implements ConfigurableNavigatorInterface
{

    const NAVIGATOR = 'Admin\SystemConfiguration';
    
    protected $webdriver;
    protected $themeConfiguration;
    protected $testCase;
    protected $loaded;

    public function __construct(
        ThemeConfiguration $theme,
        WebDriver $webdriver,
        AbstractMagentoTestCase $testCase,
        WaitForPageLoaded $loaded
    ) {
        $this->themeConfiguration   = $theme;
        $this->webdriver            = $webdriver;
        $this->testCase             = $testCase;
        $this->loaded               = $loaded;
    }
    
    public function navigateTo($path)
    {
        $instructions = explode('/', $path);
        if (count($instructions) !== 2) {
            throw new InvalidInstructionException('System Configuration instructions need to be in the format of "Tab/Section"');
        }
        $tabXpath = $this->themeConfiguration->getSystemConfigTabsXpath($instructions[0]);
        $sectionDisplayXpath = $this->themeConfiguration->getSystemConfigSectionDisplayCheckXpath($instructions[1]);
        $sectionToggleXpath = $this->themeConfiguration->getSystemConfigSectionToggleXpath($instructions[1]);

        $this->testCase->assertElementExists($tabXpath, AbstractTestCase::BY_XPATH);
        if (!$this->webdriver->elementDisplayed($sectionDisplayXpath, WebDriver::BY_XPATH)) {

            $this->webdriver->byXpath($tabXpath)->click();

            $this->webdriver->wait()->until(ExpectedCondition::elementExists($sectionDisplayXpath, AbstractTestCase::BY_XPATH));
        }

        $this->testCase->assertElementExists($sectionToggleXpath, AbstractTestCase::BY_XPATH);
        if (!$this->webdriver->elementDisplayed($sectionDisplayXpath, AbstractTestCase::BY_XPATH)) {
            $element = $this->webdriver->byXpath($sectionToggleXpath);
            $element->click();
        }
    }
    
}