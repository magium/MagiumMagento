<?php

namespace Magium\Magento\Extractors\Catalog\LayeredNavigation;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Themes\AbstractThemeConfiguration;
use Magium\WebDriver\WebDriver;
use Magium\Extractors\AbstractExtractor;
use Magium\Magento\Extractors\Catalog\LayeredNavigation\FilterTypes\AbstractFilterType;

/**
 * This is not part of the category namespace because it can be reused for search
 *
 * Class LayeredNavigation
 * @package Magium\Magento\Extractors\Catalog
 */

class LayeredNavigation extends AbstractExtractor
{
    const EXTRACTOR = 'Catalog\LayeredNavigation\LayeredNavigation';

    const FILTER_TYPE_DEFAULT = 'DefaultFilter';
    const FILTER_TYPE_PRICE = 'PriceFilter';
    const FILTER_TYPE_SWATCH = 'SwatchFilter';

    protected $filterTypes = [];

    protected $baseNamespace = 'Magium\Magento\Extractors\Catalog\LayeredNavigation\FilterTypes';

    protected $filterNames = [];
    protected $filterValues = [];


    public function __construct(
        WebDriver           $webDriver,
        AbstractMagentoTestCase    $testCase,
        AbstractThemeConfiguration $theme
    ) {
        parent::__construct($webDriver, $testCase, $theme);
        $this->addFilterType(self::FILTER_TYPE_DEFAULT);
        $this->addFilterType(self::FILTER_TYPE_PRICE);
        $this->addFilterType(self::FILTER_TYPE_SWATCH);
    }


    /**
     * The purpose of this method is to allow shorthand calls to FilterTypes/* classes.
     *
     * @param $type
     * @return string
     * @throws InvalidFilterException
     */

    protected function filterTypeName($type)
    {
        $returnType = $type;
        if (strpos($type, '\\') === false) {
            $returnType = $this->baseNamespace . '\\' . $type;
            if (!class_exists($returnType)) {
                $returnType = $type;
                if (!class_exists($returnType)) {
                    throw new InvalidFilterException('Filter type must exist: ' . $returnType);
                }
            }
        }
        $this->validateFilterType($returnType);
        return $returnType;
    }

    protected function validateFilterType($returnType)
    {
        if ($returnType == $this->baseNamespace . '\AbstractFilterType') {
            return true;
        }
        $reflection = new \ReflectionClass($returnType);
        if (!$reflection->isSubclassOf($this->baseNamespace . '\AbstractFilterType')) {
            throw new InvalidFilterException('Filter type must extend AbstractFilterType: ' . $returnType);
        }
        return true;
    }


    public function addFilterType($type)
    {
        $type = $this->filterTypeName($type);

        array_unshift($this->filterTypes, $type);
    }


    public function removeFilterType($type)
    {
        $type = $this->filterTypeName($type);
        $key = array_search($type, $this->filterTypes);
        if ($key !== false) {
            unset($this->filterTypes[$key]);
        }
    }

    public function replaceFilterType($replace, $with)
    {
        $replace = $this->filterTypeName($replace);
        $with = $this->filterTypeName($with);
        $key = array_search($replace, $this->filterTypes);
        if ($key !== false) {
            $this->filterTypes[$key] = $with;
        }
    }

    /**
     * For the purposes of this extractor filters refer both to filters and facets
     *
     * @return array
     */

    public function getFilterNames()
    {
        return $this->filterNames;
    }

    /**
     * @param $filter
     * @return AbstractFilterType
     */

    public function getFilter($filter)
    {
        $filterKey = strtolower($filter);
        if (isset($this->filterValues[$filterKey])) {
            return $this->filterValues[$filterKey];
        }

        return null;
    }

    public function extract()
    {

        $filters = $this->webDriver->byXpath($this->theme->getLayeredNavigationBaseXpath());
        /* I cannot find any way that normalizes filter types without requiring XPath 2 or other shenanigans.  For that
         * reason I am pulling just the HTML and doing direct XPath queries on it; so I can normalize the filter types
         */
        $html = $filters->getAttribute('innerHTML');
        $doc = new \DOMDocument();
        $doc->loadHTML($html);

        $xPath = new \DOMXPath($doc);
        $filters = $xPath->query('//dl[@id="narrow-by-list"]/dt');
        /* @var $filters \DOMElement[] */
        foreach ($filters as $filter) {
            $this->filterNames[] = $filter = trim($filter->nodeValue);
            $filterKey = strtolower($filter);
            $this->filterValues[$filterKey] = [];

            foreach ($this->filterTypes as $type) {
                if (is_subclass_of($type, $this->filterTypeName('AbstractFilterType'))) {
                    $type = new $type(
                        $filter,
                        $doc,
                        $this->testCase,
                        $this->theme
                    );
                    if ($type->filterApplies()) {
                        $this->filterValues[$filterKey] = $type;
                        break;
                    }
                } else {
                    throw new InvalidFilterException('Filter type does not extend AbstractFilterType: ' . $type);
                }
            }
        }


    }
}