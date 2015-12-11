<?php

namespace Magium\Magento\Navigators;


use Magium\Magento\Themes\AbstractThemeConfiguration;
use Magium\Magento\Themes\NavigableThemeInterface;
use Magium\Themes\ThemeConfigurationInterface;
use Magium\WebDriver\WebDriver;
class BaseMenuNavigator
{
    
    protected $webdriver;
    protected $themeConfiguration;
    
    public function __construct(NavigableThemeInterface $theme, WebDriver $webdriver)
    {
        $this->themeConfiguration = $theme;
        $this->webdriver = $webdriver;
    }

    
    public function navigateTo($path)
    {
        $paths = explode('/', $path);
        $xpath = $this->themeConfiguration->getNavigationBaseXPathSelector();
        
        $level = 0;
        
        foreach ($paths as $p) {
            $xpath = '/descendant::' . $this->themeConfiguration->getNavigationChildXPathSelector($level++, $p);

            $element = $this->webdriver->byXpath($xpath . '/a');
            $this->webdriver->getMouse()->mouseMove($element->getCoordinates());
            usleep(500000); // Give the UI some time to update
        }
        
        $this->webdriver->getMouse()->click();
        
    }
    
}