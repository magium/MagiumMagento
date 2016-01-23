<?php

namespace Magium\Magento\Navigators\Customer\Magento2;

use Magium\Actions\WaitForPageLoaded;
use Magium\Magento\Themes\Magento2\ThemeConfiguration;
use Magium\Navigators\InstructionNavigator;
use Magium\WebDriver\WebDriver;

class AccountHome extends \Magium\Magento\Navigators\Customer\AccountHome
{

    const NAVIGATOR = 'Customer\Magento2\AccountHome';

    /**
     * @var ThemeConfiguration
     */

    protected $theme;

    protected $webDriver;

    public function __construct(
        ThemeConfiguration $theme,
        InstructionNavigator $instructionsNavigator,
        WaitForPageLoaded $loaded,
        WebDriver $webDriver
    )
    {
        parent::__construct($theme, $instructionsNavigator, $loaded);
        $this->webDriver = $webDriver;
    }

    public function navigateTo()
    {
        // Magento 2 has a different process for navigating to the customer page if you are logged in
        $instructions = $this->theme->getNavigateToCustomerPageInstructions();
        if (!$this->webDriver->elementDisplayed($instructions[0][1], WebDriver::BY_XPATH)) {
            $this->navigatorInstructions = 'getNavigateToCustomerPageLoggedInInstructions';
        }
        parent::navigateTo();
    }

}