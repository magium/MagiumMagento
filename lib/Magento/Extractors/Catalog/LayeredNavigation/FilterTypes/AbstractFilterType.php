<?php

namespace Magium\Magento\Extractors\Catalog\LayeredNavigation\FilterTypes;


use Facebook\WebDriver\WebDriverElement;
use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Extractors\Catalog\LayeredNavigation\FilterValue;
use Magium\Magento\Extractors\Catalog\LayeredNavigation\MissingValueException;
use Magium\Magento\Extractors\Catalog\LayeredNavigation\UnparseableValueException;
use Magium\Magento\Themes\AbstractThemeConfiguration;
use Magium\WebDriver\WebDriver;

abstract class AbstractFilterType
{
    protected $title;
    protected $document;
    protected $testCase;
    protected $theme;
    protected $webDriver;


    public function __construct(
        $type,
        \DOMDocument $document,
        AbstractMagentoTestCase $testCase,
        AbstractThemeConfiguration $theme,
        WebDriver $webDriver
    )
    {
        $this->title = $type;
        $this->document = $document;
        $this->testCase = $testCase;
        $this->theme = $theme;
        $this->webDriver = $webDriver;
    }

    abstract public function filterApplies();

    /**
     * @param $text
     * @return FilterValue
     * @throws MissingValueException
     * @throws UnparseableValueException
     */

    public function getValueForText($text)
    {
        foreach ($this->getFilterValues() as $value) {
            if (strtolower($value->getText()) == strtolower($text)) {
                return $value;
            }
        }
        throw new MissingValueException('Could not find the value for option: ' . $text);
    }

    /**
     * @return WebDriverElement
     */

    public function getElement()
    {
        return $this->webDriver->byXpath($this->theme->getLayeredNavigationFilterNameElementXpath($this->title));
    }

    /**
     * @return FilterValue[]
     */

    public function getFilterValues()
    {

        $xpath = new \DOMXPath($this->document);
        $elements = $xpath->query($this->theme->getLayeredNavigationFilterTypesXpath($this->title));
        /* @var $elements \DOMElement[] */
        $returnElements = [];
        foreach ($elements as $element) {

            $text = trim($element->nodeValue);
            $matches = null;
            $text = $startCountText = preg_replace('/\D\d\D*$/', '', $text);
            $text = preg_replace('/\S+$/', '', $text);
            $text = trim($text);

            $count = substr(trim($element->nodeValue), strlen($startCountText));
            $count = preg_replace('/^\D*(\d+)\D*$/', '$1', $count);

            /*
             * It is very difficult to build a link matcher that is functionally similar across different versions
             * of Magento.  The HTML rendering is different between 1.8 and 1.9.  This could be addressed via several different
             * theme configuration changes but that seems unnecessary given that things should be mostly close.  So we
             * find all the matched links and then find the most accurate match and go with that.
             */
            $links = $xpath->query($this->theme->getLayeredNavigationFilterLinkXpath($this->title));
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

            $linkElementXpath = $this->theme->getLayeredNavigationFilterLinkXpath($this->title) . sprintf('[@href="%s"]', $linkUrl);
            $linkElement = $this->webDriver->byXpath($linkElementXpath);

            $value = new FilterValue($linkElement, $text, $linkUrl, $count);
            $returnElements[] = $value;
        }
        return $returnElements;
    }

}