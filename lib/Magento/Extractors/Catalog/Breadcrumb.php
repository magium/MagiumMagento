<?php

namespace Magium\Magento\Extractors\Catalog;

use Facebook\WebDriver\WebDriverElement;
use Magium\Extractors\AbstractExtractor;
use Magium\Magento\Themes\AbstractThemeConfiguration;
use Magium\WebDriver\WebDriver;

class Breadcrumb extends AbstractExtractor
{

    const EXTRACTOR = 'Catalog\Breadcrumb';
    /**
     * @var WebDriverElement
     */

    protected $element;

    /**
     * @var AbstractThemeConfiguration
     */

    protected $theme;

    public function getBreadCrumbsParts()
    {
        $this->extract();
        $count = 0;
        $parts = [];
        while ($this->webDriver->elementDisplayed($this->theme->getBreadCrumbSelectorXpath(++$count), WebDriver::BY_XPATH)) {
            $parts[] = trim($this->webDriver->byXpath($this->theme->getBreadCrumbSelectorXpath($count))->getText());
        }
        return $parts;
    }

    public function getBreadCrumbLink($name)
    {

        $xpath = $this->theme->getBreadCrumbMemberXpath($name);
        if ($this->webDriver->elementDisplayed($xpath, WebDriver::BY_XPATH));

        return $this->webDriver->byXpath($xpath)->getAttribute('href');
    }

    public function getElement()
    {
        $this->extract();
        return $this->element;
    }


    public function getBreadCrumbText()
    {
        $this->extract();
        $text = preg_replace('/\s+/', ' ', $this->element->getText());
        return $text;
    }

    public function extract()
    {
        if (!$this->element instanceof WebDriverElement || !$this->webDriver->elementAttached($this->element)) {
            $this->element = $this->webDriver->byXpath($this->theme->getBreadCrumbXpath());
        }
    }

}