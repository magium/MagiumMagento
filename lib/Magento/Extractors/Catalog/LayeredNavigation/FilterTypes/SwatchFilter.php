<?php

namespace Magium\Magento\Extractors\Catalog\LayeredNavigation\FilterTypes;

use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverElement;
use Magium\Magento\Extractors\Catalog\LayeredNavigation\FilterValue;
use Magium\Magento\Extractors\Catalog\LayeredNavigation\UnparseableValueException;


class SwatchFilter extends AbstractFilterType
{
    protected $swatchAppliesXpath = '//dt[.="%s"]/following-sibling::dd[1]/descendant::ol[contains(concat(" ",normalize-space(@class)," ")," configurable-swatch-list ")]';

    public function filterApplies()
    {
        $xpath = new \DOMXPath($this->document);
        $elements = $xpath->query(sprintf($this->swatchAppliesXpath, $this->title));
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
        $elements = $xpath->query(sprintf($this->filterTypesXpath, $this->title));
        /* @var $elements \DOMElement[] */
        $returnElements = [];
        foreach ($elements as $element) {
            $elementDocument  = new \DOMDocument();
            $html  =$element->C14N();
            $elementDocument->loadXML($html);
            $elementXpath = new \DOMXPath($elementDocument);
            $titleElements = $elementXpath->query('//*[@title]');
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
            $swatchText = trim($titleElements->item(0)->getAttribute('title'));
            $text = trim($element->nodeValue);
            $matches = null;
            if (!preg_match('/(\(\d+\))/', $text, $matches)) {
                throw new UnparseableValueException('Unable to parse navigation filter with default filter.');
            }
            $count = preg_replace('/\D/', '', $matches[1]);

            if ($linkUrl === null) {
                throw new UnparseableValueException('Unable to determine the link');
            }
            $value = new SwatchFilterValue($swatchText, $linkUrl, $count, $image);
            $returnElements[] = $value;
        }
        return $returnElements;
    }

}