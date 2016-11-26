<?php

namespace Magium\Magento\Navigators\Checkout;

use Magium\Actions\WaitForPageLoaded;
use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Actions\Checkout\Steps\StepInterface;
use Magium\Magento\Themes\AbstractThemeConfiguration;
use Magium\Navigators\InstructionNavigator;
use Magium\Navigators\StaticNavigatorInterface;
use Magium\WebDriver\WebDriver;

class CheckoutStart implements StepInterface, StaticNavigatorInterface
{
    const NAVIGATOR = 'Checkout\CheckoutStart';

    protected $theme;
    protected $instructionNavigator;

    public function __construct(
        AbstractThemeConfiguration $theme,
        InstructionNavigator $instructionNavigator
    )
    {
        $this->instructionNavigator = $instructionNavigator;
        $this->theme = $theme;
    }

    public function navigateTo()
    {

        $instructions = $this->theme->getCheckoutNavigationInstructions();
        $this->instructionNavigator->navigateTo($instructions);
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