<?php

namespace Magium\Magento\Actions\Checkout\ShippingMethods;

use Magium\AbstractTestCase;
use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\MissingInformationException;
use Magium\Magento\Themes\OnePageCheckout\AbstractThemeConfiguration;
use Magium\WebDriver\ExpectedCondition;
use Magium\WebDriver\WebDriver;

class ByName implements ShippingMethodInterface
{
    const ACTION = 'Checkout\ShippingMethods\ByName';
    protected $webDriver;
    protected $theme;
    protected $testCase;

    protected $name;

    public function __construct(
        WebDriver               $webDriver,
        AbstractThemeConfiguration  $themeConfiguration,
        AbstractMagentoTestCase $testCase
    ) {
        $this->webDriver        = $webDriver;
        $this->testCase         = $testCase;
        $this->theme            = $themeConfiguration;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function choose($required)
    {
        if (!$this->name) {
            throw new MissingInformationException('Missing the names');
        }
        $xpath = $this->theme->getShippingByNameXpath($this->name);
        try {
            $this->webDriver->wait()->until(
                ExpectedCondition::elementExists(
                    $xpath, AbstractTestCase::BY_XPATH
                )
            );
        } catch (\Exception $e) {
            throw new NoSuchShippingMethodException('Unable to find the shipping method: ' . $this->name);
        }

        // Some products, such as virtual products, do not get shipped
        if ($required) {
            $this->testCase->assertElementExists($xpath, AbstractTestCase::BY_XPATH);
            $this->testCase->assertElementDisplayed($xpath, AbstractTestCase::BY_XPATH);
        }

        if ($this->webDriver->elementDisplayed($xpath, AbstractTestCase::BY_XPATH)) {
            $this->webDriver->byXpath($xpath)->click();
        }
    }

}