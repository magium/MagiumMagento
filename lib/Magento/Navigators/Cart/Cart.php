<?php

namespace Magium\Magento\Navigators\Cart;

use Magium\Magento\Themes\AbstractThemeConfiguration;
use Magium\Navigators\InstructionNavigator;

class Cart
{

    const NAVIGATOR = 'Cart\Cart';

    protected $instructionNavigator;
    protected $theme;

    public function __construct(
        InstructionNavigator $instructionNavigator,
        AbstractThemeConfiguration $themeConfiguration
    )
    {
        $this->instructionNavigator = $instructionNavigator;
        $this->theme = $themeConfiguration;
    }

    public function navigateTo()
    {
        $instructions = $this->theme->getCartNavigationInstructions();
        $this->instructionNavigator->navigateTo($instructions);
    }

}