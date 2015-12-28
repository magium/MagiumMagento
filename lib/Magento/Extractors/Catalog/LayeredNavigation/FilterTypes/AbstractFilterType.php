<?php

namespace Magium\Magento\Extractors\Catalog\LayeredNavigation\FilterTypes;


use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Extractors\Catalog\LayeredNavigation\FilterValue;
use Magium\Magento\Extractors\Catalog\LayeredNavigation\UnparseableValueException;
use Magium\Magento\Themes\AbstractThemeConfiguration;

abstract class AbstractFilterType
{
    protected $title;
    protected $document;
    protected $testCase;
    protected $theme;

    protected $filterTypesXpath = '//dt[.="%s"]/following-sibling::dd[1]/descendant::li';
    protected $filterLinkXpath = '//dt[.="%s"]/following-sibling::dd[1]/descendant::li/descendant::a';

    public function __construct(
        $type,
        \DOMDocument $document,
        AbstractMagentoTestCase $testCase,
        AbstractThemeConfiguration $theme
    )
    {
        $this->title = $type;
        $this->document = $document;
        $this->testCase = $testCase;
        $this->theme = $theme;
    }

    abstract public function filterApplies();

    /**
     * @return FilterValue[]
     */

    public function getFilterValues()
    {

        $xpath = new \DOMXPath($this->document);
        $elements = $xpath->query(sprintf($this->filterTypesXpath, $this->title));
        /* @var $elements \DOMElement[] */
        $returnElements = [];
        foreach ($elements as $element) {

            $text = trim($element->nodeValue);
            $matches = null;
            if (!preg_match('/(\(\d+\))/', $text, $matches)) {
                throw new UnparseableValueException('Unable to parse navigation filter with default filter.');
            }
            $count = preg_replace('/\D/', '', $matches[1]);
            $text = trim(substr($text, 0, -strlen($matches[1])));
            /*
             * It is very difficult to build a link matcher that is functionally similar across different versions
             * of Magento.  The HTML rendering is different between 1.8 and 1.9.  This could be addressed via several different
             * theme configuration changes but that seems unnecessary given that things should be mostly close.  So we
             * find all the matched links and then find the most accurate match and go with that.
             */
            $links = $xpath->query(sprintf($this->filterLinkXpath, $this->title));
            /* @var $links \DOMElement[] */
            $linkUrl = null;
            foreach ($links as $link) {
                if (trim($link->nodeValue) == $text) {
                    // No contest, if it matches we're good (probably ce 1.8)
                    $linkUrl = $link->getAttribute('href');
                    break;
                } else if (strpos(trim($link->nodeValue), $text) === 0) {
                    // If it is found at the beginning of the string then we'll presume this is the match, probably ce 1.9
                    $linkUrl = $link->getAttribute('href');
                    break;
                }
            }
            if ($linkUrl === null) {
                throw new UnparseableValueException('Unable to determine the link');
            }
            $value = new FilterValue($text, $linkUrl, $count);
            $returnElements[] = $value;
        }
        return $returnElements;
    }

}