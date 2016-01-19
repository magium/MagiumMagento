<?php

namespace Magium\Magento\Navigators;


use Facebook\WebDriver\WebDriverElement;
use Magium\Actions\WaitForPageLoaded;
use Magium\Magento\Themes\AbstractThemeConfiguration;
use Magium\Magento\Themes\NavigableThemeInterface;
use Magium\Themes\ThemeConfigurationInterface;
use Magium\WebDriver\WebDriver;
class BaseMenu
{
    const NAVIGATOR = 'BaseMenu';
    protected $webdriver;
    protected $themeConfiguration;
    protected $loaded;
    
    public function __construct(NavigableThemeInterface $theme, WebDriver $webdriver, WaitForPageLoaded $loaded)
    {
        $this->themeConfiguration = $theme;
        $this->webdriver = $webdriver;
        $this->loaded = $loaded;
    }

    
    public function navigateTo($path)
    {
        $paths = explode('/', $path);
        $baseXpath = $this->themeConfiguration->getNavigationBaseXPathSelector();
        
        $level = 0;

        $element = null;
        
        foreach ($paths as $p) {
            $xpath = $baseXpath . '/descendant::' . $this->themeConfiguration->getNavigationChildXPathSelector($level++, $p);

            $element = $this->webdriver->byXpath($xpath . '/a');
            $this->webdriver->getMouse()->mouseMove($element->getCoordinates());
            usleep(500000); // Give the UI some time to update
        }

        if ($element instanceof WebDriverElement) {
            $element->click();
        }
        $this->loaded->execute($element);
    }
    
}