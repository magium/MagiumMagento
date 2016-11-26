<?php

namespace Magium\Magento\Navigators\Customer;

use Magium\Actions\WaitForPageLoaded;
use Magium\Magento\Themes\Customer\AbstractThemeConfiguration;
use Magium\Navigators\NavigatorInterface;
use Magium\WebDriver\ExpectedCondition;
use Magium\WebDriver\WebDriver;

class Account implements NavigatorInterface
{
    const NAVIGATOR = 'Customer\Account';
    protected $webDriver;
    protected $themeConfiguration;
    protected $loader;

    public function __construct(
        WebDriver               $webDriver,
        AbstractThemeConfiguration    $themeConfiguration,
        WaitForPageLoaded $loaded)
    {
        $this->webDriver            = $webDriver;
        $this->themeConfiguration   = $themeConfiguration;
        $this->loader = $loaded;
    }

    /**
     * Navigates to the section of the account management based off the section provided.  IF the header value is provided
     * it will issue a wait() command until the proper page header exists before returning.  This takes into account
     * the possibility of a section being loaded by Ajax while also retaining compatibility with templates based off
     * of the core template
     *
     * @param $section
     * @param null $header The title of the page
     */

    public function navigateTo($section, $header = null)
    {
        $xpath = $this->themeConfiguration->getAccountNavigationXpath($section);
        $element = $this->webDriver->byXpath($xpath);
        $element->click();
        $this->loader->execute($element);
        if ($header !== null) {
            $xpath = $this->themeConfiguration->getAccountSectionHeaderXpath($header);
            $this->webDriver->wait()->until(ExpectedCondition::elementExists($xpath, WebDriver::BY_XPATH));
        }
    }

}