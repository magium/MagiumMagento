<?php

namespace Magium\Magento\Extractors\Catalog\Product;

use Facebook\WebDriver\WebDriverBy;
use Magium\Extractors\AbstractExtractor;
use Magium\Magento\Themes\AbstractThemeConfiguration;
use Magium\WebDriver\WebDriver;
use Magium\WebDriver\WebDriverElementProxy;

class ConfigurableProductOptions extends AbstractExtractor
{

    /**
     * @var AbstractThemeConfiguration
     */

    protected $theme;

    const EXTRACTOR = 'Catalog\Product\ConfigurableProductOptions';

    const EXCEPTION_MISSING_CONFIGURATION = 'Magium\Magento\Extractors\Catalog\Product\MissingConfigurableSwatchConfigurationException';
    const EXCEPTION_MISSING_SWATCH_NAME = 'Magium\Magento\Extractors\Catalog\Product\MissingSwatchNameException';

    /**
     * @var Option[]
     */

    protected $items = [];


    public function getOptionNames()
    {
        $names = [];
        foreach ($this->items as  $item) {
            $names[] = $item->getName();
        }
        return $names;
    }

    /**
     * @param $name
     * @return Option|null
     */

    public function getOption($name)
    {
        $name = strtolower($name);
        foreach ($this->items as  $item) {
            if (strtolower($item->getName()) == $name) {
                return $item;
            }
        }

        return null;
    }


    public function extract()
    {
        $this->items = [];
        $labelXpath = $this->theme->getConfigurableLabelXpath();

        $elements = $this->webDriver->findElements(WebDriverBy::xpath($labelXpath));
        foreach ($elements as $count => $element) {
            // Gotta do this because the text is an unencapsulated DOMText node
            $doc = new \DOMDocument();
            $doc->loadHTML($element->getAttribute('innerHTML'));
            $xpath = new \DOMXPath($doc);
            $elements = $xpath->query('//text()');
            $name = null;
            foreach ($elements as $e) {
                /* @var $e \DOMText */

                // text nodes that are not encapsulated by a tag have a nodeName of "body"
                if ($e->parentNode->nodeName == 'body') {
                    $testName = $this->theme->filterConfigurableProductOptionName(trim($e->nodeValue));
                    if ($testName) {
                        $name = $testName;
                    }
                }
            }

            if ($name === null) {
                throw new MissingSwatchNameException('Unable to extract the swatch name from HTML: ' . $element->getAttribute('innerHTML'));
            }

            $isSwatch = $this->isConfigurableSwatch($count+1);
            if ($isSwatch) {
                $this->items[] = $this->processSwatch($name, $count+1);
            } else {
                // gotta find some way to do this recursively, the options are populated based off of previous option selections
                $this->items[] = $this->processStandard($name, $count+1);
            }

        }
    }

    protected function processStandard($name, $count)
    {
        /* I really do not like this approach.  I don't like depending on JS for this data.  But my only other option
         * is to do a recursive iteration over all of the OPTION elements to extract all of the possible options and
         * that is just craziness.
        */

        $productOption = new Option($name);
        $jsVals = $this->webDriver->executeScript('return spConfig');
        foreach ($jsVals['config']['attributes'] as $attribute) {
            if ($attribute['label'] == $name) {
                foreach ($attribute['options'] as $option) {
                    $productOption->addOption(new Value(
                        $option['label'],
                        new WebDriverElementProxy(
                            $this->webDriver,
                            $this->theme->getConfigurableProductOptionXpath($count, $option['label']),
                            WebDriver::BY_XPATH
                        )
                    ));
                }
            }
        }


        return $productOption;
    }

    /**
     * @param $name
     * @param $count
     * @return Option
     */

    protected function processSwatch($name, $count)
    {
        $swatch = new Option($name);
        $optionCount = 0;
        while ($this->webDriver->elementExists($this->theme->getConfigurableSwatchSelectorXpath($count, ++$optionCount), WebDriver::BY_XPATH)) {

            $itemOptionElement = $this->webDriver->byXpath($this->theme->getConfigurableSwatchSelectorXpath($count, $optionCount));
            $img = null;
            $available = !$this->webDriver->elementExists($this->theme->getConfigurableSwatchNotAvailableXpath($count, $optionCount), WebDriver::BY_XPATH);
            if ($this->webDriver->elementExists($this->theme->getConfigurableSwatchImgXpath($count, $optionCount), WebDriver::BY_XPATH)) {
                $img = $this->webDriver->byXpath($this->theme->getConfigurableSwatchImgXpath($count, $optionCount))->getAttribute('src');
            }
            $swatch->addOption(new SwatchValue(
                trim($itemOptionElement->getAttribute('title')),
                $itemOptionElement,
                $available,
                $img
            ));
        }
        return $swatch;
    }

    protected function isConfigurableSwatch($count)
    {
        return $this->webDriver->elementExists($this->theme->getConfigurableSwatchSelectorXpath($count, 1), WebDriver::BY_XPATH);
    }

}