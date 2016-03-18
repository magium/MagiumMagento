<?php

namespace Magium\Magento\Assertions\Cart;

use Magium\Assertions\AbstractAssertion;
use Magium\Magento\Themes\AbstractThemeConfiguration;
use Magium\WebDriver\WebDriver;

class AddToCartSucceeded extends AbstractAssertion
{

    protected $themeConfiguration;

    public function __construct(
        AbstractThemeConfiguration  $themeConfiguration
    )
    {
        $this->themeConfiguration             = $themeConfiguration;
    }

    public function assert()
    {
        $this->getTestCase()->assertElementDisplayed($this->themeConfiguration->getAddToCartSuccessXpath(), WebDriver::BY_XPATH);
    }

}