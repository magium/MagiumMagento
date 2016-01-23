<?php

namespace Magium\Magento\Extractors\Catalog\Product;

use Facebook\WebDriver\WebDriverBy;
use Magium\AbstractTestCase;
use Magium\Extractors\AbstractExtractor;
use Magium\Magento\Themes\AbstractThemeConfiguration;
use Magium\Themes\ThemeConfigurationInterface;
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

    protected $swatchProcessor;
    protected $standardProcessor;

    public function __construct(
        WebDriver $webDriver,
        AbstractTestCase $testCase,
        ThemeConfigurationInterface $theme,
        SwatchProcessor $swatchProcessor,
        StandardProcessor $standardProcessor
    )
    {
        parent::__construct($webDriver, $testCase, $theme);
        $this->swatchProcessor = $swatchProcessor;
        $this->standardProcessor = $standardProcessor;
    }


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
            // Gotta do this because the text is an unencapsulated DOMText node in Magento 1 (properly done in M2)
            $doc = new \DOMDocument();
            $html = trim($element->getAttribute('innerHTML'));
            if ($html != htmlspecialchars($html)) {
                $doc->loadHTML($html);
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
            } else {
                $name = $html;
            }

            if ($name === null) {
                throw new MissingSwatchNameException('Unable to extract the swatch name from HTML: ' . $element->getAttribute('innerHTML'));
            }

            $isSwatch = $this->swatchProcessor->isConfigurableSwatch($count+1);
            if ($isSwatch) {
                $this->items[] = $this->swatchProcessor->process($name, $count+1);
            } else {
                // gotta find some way to do this recursively, the options are populated based off of previous option selections
                $this->items[] = $this->standardProcessor->process($name, $count+1);
            }

        }
    }




}