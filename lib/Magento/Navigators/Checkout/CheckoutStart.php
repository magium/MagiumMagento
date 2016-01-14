<?php

namespace Magium\Magento\Navigators\Checkout;

use Magium\Actions\WaitForPageLoaded;
use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Actions\Checkout\Steps\StepInterface;
use Magium\Magento\Themes\AbstractThemeConfiguration;
use Magium\Navigators\InstructionNavigator;
use Magium\WebDriver\WebDriver;

class CheckoutStart extends InstructionNavigator implements StepInterface
{
    const NAVIGATOR = 'Checkout\CheckoutStart';

    public function __construct(
        AbstractThemeConfiguration $theme,
        AbstractMagentoTestCase $testCase,
        WebDriver $webdriver,
        WaitForPageLoaded $loaded)
    {
        parent::__construct($theme, $testCase, $webdriver, $loaded);
    }

    public function navigateTo(array $instructions = null)
    {
        if ($instructions === null) {
            $instructions = $this->themeConfiguration->getCheckoutNavigationInstructions();
        }
        return parent::navigateTo($instructions);
    }

    public function execute()
    {
        $this->navigateTo();
        return true;
    }

    public function nextAction()
    {
        return true;
    }

}