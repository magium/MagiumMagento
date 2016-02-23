<?php

namespace Magium\Magento\Navigators\Admin;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Actions\Admin\Tables\ClearTableFilters;
use Magium\Magento\Actions\Admin\Tables\ClickButton;
use Magium\Magento\Actions\Admin\WaitForLoadingMask;
use Magium\Magento\Navigators\Admin\Customer\AbstractCustomerNavigation;
use Magium\Magento\Themes\Admin\ThemeConfiguration;
use Magium\WebDriver\ExpectedCondition;
use Magium\WebDriver\WebDriver;

class Customer
{
    const NAVIGATOR = 'Admin\Customer';

    protected $webDriver;
    protected $themeConfiguration;
    protected $adminLogin;
    protected $adminMenuNavigator;
    protected $clearTableFilters;
    protected $clickButton;
    protected $waitForLoadingMask;
    protected $testCase;

    public function __construct(
        WebDriver                   $webDriver,
        ThemeConfiguration     $themeConfiguration,
        AdminMenu          $adminMenuNavigator,
        ClearTableFilters           $clearTableFilters,
        ClickButton                 $clickButton,
        WaitForLoadingMask          $waitForLoadingMask,
        AbstractMagentoTestCase     $testCase
    )
    {
        $this->webDriver                = $webDriver;
        $this->themeConfiguration       = $themeConfiguration;
        $this->adminMenuNavigator       = $adminMenuNavigator;
        $this->clearTableFilters        = $clearTableFilters;
        $this->clickButton              = $clickButton;
        $this->waitForLoadingMask       = $waitForLoadingMask;
        $this->testCase                 = $testCase;
    }

    public function navigateTo(AbstractCustomerNavigation $navigation)
    {

        $this->adminMenuNavigator->navigateTo('Customers/Manage Customers');

        $this->clearTableFilters->clear();

        $parts = explode('-', $navigation->getSelectorID());
        foreach ($parts as $part) {
            $element = $this->webDriver->byId($part);
            $element->sendKeys($navigation->getSearch());
        }

        $this->clickButton->click($this->themeConfiguration->getSearchButtonText());
        $this->testCase->sleep('100ms');
        $this->waitForLoadingMask->wait();

        $selectXpath = $this->themeConfiguration->getSelectCustomerXpath($navigation->getSearch());

        $this->testCase->assertElementDisplayed($selectXpath, WebDriver::BY_XPATH);
        $element = $this->webDriver->byXpath($selectXpath);

        $element->click();
        $elementExists = $this->testCase->getTranslator()->translatePlaceholders('//h4[.="{{Personal Information}}"]');
        $this->webDriver->wait()->until(ExpectedCondition::elementExists($elementExists, WebDriver::BY_XPATH));

        $element = $this->webDriver->byXpath($elementExists);

        $this->webDriver->wait()->until(ExpectedCondition::visibilityOf($element));

    }

}