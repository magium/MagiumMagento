<?php

namespace Magium\Magento\Navigators\Customer;

use Magium\Magento\Themes\AbstractThemeConfiguration;
use Magium\Navigators\InstructionNavigator;

class AccountHome
{

    protected $theme;
    protected $instructionsNavigator;

    public function __construct(
        AbstractThemeConfiguration $theme,
        InstructionNavigator $instructionsNavigator

    )
    {
        $this->theme = $theme;
        $this->instructionsNavigator = $instructionsNavigator;
    }

    public function navigateTo()
    {

        $instructions = $this->theme->getNavigateToCustomerPageInstructions();
        $this->instructionsNavigator->navigateTo($instructions);

    }
}