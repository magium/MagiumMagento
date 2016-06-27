<?php

namespace Magium\Magento\Navigators;


use Facebook\WebDriver\WebDriverElement;
use Magium\Actions\WaitForPageLoaded;
use Magium\Magento\Themes\NavigableThemeInterface;
use Magium\Util\Log\Logger;
use Magium\WebDriver\ExpectedCondition;
use Magium\WebDriver\WebDriver;

class BaseMenu
{
    const NAVIGATOR = 'BaseMenu';
    protected $webdriver;
    protected $themeConfiguration;
    protected $loaded;
    protected $logger;
    
    public function __construct(
        NavigableThemeInterface $theme,
        WebDriver $webdriver,
        WaitForPageLoaded $loaded,
        Logger $logger
    )
    {
        $this->themeConfiguration = $theme;
        $this->webdriver = $webdriver;
        $this->loaded = $loaded;
        $this->logger = $logger;
    }

    protected function pathAction($path, &$xpath)
    {

        usleep(500000); // Give the UI some time to update
        $xpath .= '/descendant::' . $this->themeConfiguration->getNavigationChildXPathSelector($path);

        $element = $this->webdriver->byXpath($xpath . '/a');

        $this->execute($element);

        return $element;
    }

    protected function execute(WebDriverElement $element)
    {
        $this->webdriver->getMouse()->mouseMove($element->getCoordinates());
        if ($this->themeConfiguration->getUseClicksToNavigate()) {
            $this->webdriver->getMouse()->click();
        }
    }
    
    public function navigateTo($path)
    {
        $paths = explode('/', $path);
        $xpath = $this->themeConfiguration->getNavigationBaseXPathSelector();

        $this->webdriver->wait()->until(ExpectedCondition::visibilityOf($this->webdriver->byXpath($xpath)));

        $element = null;
        
        foreach ($paths as $p) {
            $element = $this->pathAction($p, $xpath);
        }

        if (!$this->themeConfiguration->getUseClicksToNavigate() && $element instanceof WebDriverElement) {
            $element->click();
            $this->loaded->execute($element);
        
        }

    }
    
}