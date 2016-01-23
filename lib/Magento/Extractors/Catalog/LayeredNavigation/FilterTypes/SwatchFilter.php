<?php

namespace Magium\Magento\Extractors\Catalog\LayeredNavigation\FilterTypes;

use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverElement;
use Magium\Magento\Extractors\Catalog\LayeredNavigation\FilterValue;
use Magium\Magento\Extractors\Catalog\LayeredNavigation\UnparseableValueException;


class SwatchFilter extends AbstractFilterType
{

    public function filterApplies()
    {
        $xpath = new \DOMXPath($this->document);
        $xpathQuery = $this->theme->getLayeredNavigationSwatchAppliesXpath($this->title);
        $elements = $xpath->query($xpathQuery);
        return $elements->length > 0;
    }

    /**
     * @param $swatch
     * @return FilterValue|null
     */

    public function getValueForSwatch($swatch)
    {
        $values = $this->getFilterValues();
        foreach ($values as $value) {
            if (strtolower($swatch) == strtolower($value->getText())) {
                return $value;
            }
        }
        return null;
    }

    public function getFilterValues()
    {

        $xpath = new \DOMXPath($this->document);
        $elements = $xpath->query($this->theme->getLayeredNavigationSwatchFilterTypesXpath($this->title));
        /* @var $elements \DOMElement[] */
        $returnElements = [];
        foreach ($elements as $element) {
            $elementDocument  = new \DOMDocument();
            $html  =$element->C14N();
            $elementDocument->loadXML($html);
            $elementXpath = new \DOMXPath($elementDocument);
            $titleElements = $elementXpath->query(sprintf('//*[@%s]', $this->theme->getLayeredNavigationSwatchTitleAttribute()));
            $imageElements = $elementXpath->query('//img');
            $linkElements = $elementXpath->query('//a');
            if ($titleElements->length != 1) {
                throw new UnparseableValueException('Expected only one title element for the swatch');
            }
            if ($linkElements->length != 1) {
                throw new UnparseableValueException('Expected only one link element for the swatch');
            }
            $image = null;
            $linkUrl = $linkElements->item(0)->getAttribute('href');

            if ($imageElements->length > 0) {
                $image = $imageElements->item(0)->getAttribute('src');
            }
            $swatchText = trim($titleElements->item(0)->getAttribute($this->theme->getLayeredNavigationSwatchTitleAttribute()));
            $text = trim($element->nodeValue);
            $matches = null;
            $count = null;
            if (preg_match('/(\(\d+\))/', $text, $matches)) {
                $count = preg_replace('/\D/', '', $matches[1]);
            }


            if ($linkUrl === null) {
                throw new UnparseableValueException('Unable to determine the link');
            }

            // This hack may make me vomit.  Rather than having yet-another-option-to-code-for I'm basically saying
            // I don't care what the Xpath says, we're searching for an A tag here.

            $linkElementXpath = $this->theme->getLayeredNavigationSwatchFilterTypesXpath($this->title);
            $linkElementXpath = preg_replace('/\:\:\w+$/', '::', $linkElementXpath);
            $linkElementXpath .= sprintf('a[@href="%s"]', $linkUrl);
            $linkElement = $this->webDriver->byXpath($linkElementXpath);

            $value = new SwatchFilterValue($linkElement, $swatchText, $linkUrl, $count, $image);
            $returnElements[] = $value;
        }
        return $returnElements;
    }

}