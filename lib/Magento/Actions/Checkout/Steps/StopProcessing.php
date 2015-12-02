<?php

namespace Magium\Magento\Actions\Checkout\Steps;

use Magium\AbstractTestCase;
use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Themes\OnePageCheckout\ThemeConfiguration;
use Magium\WebDriver\ExpectedCondition;
use Magium\WebDriver\WebDriver;

class StopProcessing implements StepInterface
{

    public function execute()
    {
        return false;
    }
}