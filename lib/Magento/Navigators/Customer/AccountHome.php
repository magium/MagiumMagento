<?php

namespace Magium\Magento\Navigators\Customer;

use Magium\Actions\WaitForPageLoaded;
use Magium\Magento\Themes\AbstractThemeConfiguration;
use Magium\Navigators\InstructionNavigator;

class AccountHome
{
    const NAVIGATOR = 'Customer\AccountHome';
    protected $theme;
    protected $instructionsNavigator;
    protected $loaded;

    public function __construct(
        AbstractThemeConfiguration $theme,
        InstructionNavigator $instructionsNavigator,
        WaitForPageLoaded $loaded
    )
    {
        $this->theme = $theme;
        $this->instructionsNavigator = $instructionsNavigator;
        $this->loaded = $loaded;
    }

    public function navigateTo()
    {

        $instructions = $this->theme->getNavigateToCustomerPageInstructions();
        $this->instructionsNavigator->navigateTo($instructions);
        $this->loaded->execute();
    }
}