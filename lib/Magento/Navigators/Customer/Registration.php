<?php

namespace Magium\Magento\Navigators\Customer;

use Magium\Magento\Themes\AbstractThemeConfiguration;
use Magium\Navigators\InstructionNavigator;

class Registration
{

    const NAVIGATOR = 'Customer\Registration';

    protected $instructionNavigator;
    protected $theme;

    public function __construct(
        InstructionNavigator $instructionNavigator,
        AbstractThemeConfiguration $abstractThemeConfiguration
    )
    {
        $this->instructionNavigator = $instructionNavigator;
        $this->theme = $abstractThemeConfiguration;
    }


    public function navigateTo()
    {
        $this->instructionNavigator->navigateTo(
            $this->theme->getRegistrationNavigationInstructions()
        );
    }

}