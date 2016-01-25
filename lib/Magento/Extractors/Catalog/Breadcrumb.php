<?php

namespace Magium\Magento\Extractors\Catalog;

use Facebook\WebDriver\WebDriverElement;
use Magium\Extractors\AbstractExtractor;
use Magium\WebDriver\WebDriver;

class Breadcrumb extends AbstractExtractor
{

    const EXTRACTOR = 'Catalog\Breadcrumb';
    /**
     * @var WebDriverElement
     */

    protected $element;

    public function getBreadCrumbsParts($separator = '/')
    {
        $this->extract();
        $text = $this->getBreadCrumbText();
        $parts = explode($separator, $text);
        foreach ($parts as &$part) {
            $part = trim($part);
        }
        return $parts;
    }

    public function getBreadCrumbLink($name)
    {
        $xpath = $this->theme->getBreadCrumbXpath();
        $xpath .= sprintf('/descendant::a[.="%s"]', $name);
        // We don't fail outright because the last element name often does not have a link
        if ($this->webDriver->elementExists($xpath, WebDriver::BY_XPATH)) {
            return $this->webDriver->byXpath($xpath)->getAttribute('href');
        }
        return null;
    }

    public function getElement()
    {
        $this->extract();
        return $this->element;
    }


    public function getBreadCrumbText()
    {
        $this->extract();
        $text = preg_replace('/\s/', ' ', $this->element->getText());
        return $text;
    }

    public function extract()
    {
        if (!$this->element instanceof WebDriverElement || !$this->webDriver->elementAttached($this->element)) {
            $this->element = $this->webDriver->byXpath($this->theme->getBreadCrumbXpath());
        }
    }

}