<?php

namespace Magium\Magento\Assertions\Cart;

use Magium\Assertions\AssertionInterface;
use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Themes\AbstractThemeConfiguration;
use Magium\WebDriver\WebDriver;

class AddToCartFailed implements AssertionInterface
{
    const ASSERTION = 'Cart\AddToCartFailed';

    protected $testCase;
    protected $themeConfiguration;

    public function __construct(
        AbstractMagentoTestCase $testCase,
        AbstractThemeConfiguration $themeConfiguration
    )
    {
        $this->testCase             = $testCase;
        $this->themeConfiguration   = $themeConfiguration;
    }

    public function assert()
    {
        $this->testCase->assertElementNotExists($this->themeConfiguration->getAddToCartSuccessXpath(), WebDriver::BY_XPATH);
    }

}