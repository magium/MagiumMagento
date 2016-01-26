<?php

namespace Magium\Magento\Assertions\Cart;

use Magium\Assertions\AbstractAssertion;
use Magium\Magento\Themes\AbstractThemeConfiguration;
use Magium\WebDriver\WebDriver;

class AddToCartFailed extends AbstractAssertion
{
    const ASSERTION = 'Cart\AddToCartFailed';

    protected $testCase;
    protected $themeConfiguration;

    public function __construct(
        AbstractThemeConfiguration $themeConfiguration
    )
    {
        $this->themeConfiguration   = $themeConfiguration;
    }

    public function assert()
    {
        $this->testCase->assertElementNotExists($this->themeConfiguration->getAddToCartSuccessXpath(), WebDriver::BY_XPATH);
    }

}