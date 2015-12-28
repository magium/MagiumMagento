<?php

namespace Magium\Magento\Extractors\Catalog\LayeredNavigation\FilterTypes;

use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverElement;
use Magium\Magento\Extractors\Catalog\LayeredNavigation\FilterValue;
use Magium\Magento\Extractors\Catalog\LayeredNavigation\UnparseableValueException;
use Zend\Uri\Uri;


class PriceFilter extends AbstractFilterType
{


    public function filterApplies()
    {
        return strtolower($this->testCase->getTranslator()->translate('Price')) == strtolower($this->title);
    }

    /**
     * @param $price
     * @return FilterValue|null
     * @throws UnparseableValueException
     */

    public function getValueForPrice($price)
    {
        $values = $this->getFilterValues();
        foreach ($values as $value) {
            $url = $value->getLink();
            $uri = new Uri($url);
            $parts = $uri->getQueryAsArray();
            if (isset($parts['price'])) {
                $priceParts = explode('-', $parts['price']);
                if (!$priceParts[0]) {
                    $priceParts[0] = -1;
                }
                if (!$priceParts[1]) {
                    $priceParts[1] = PHP_INT_MAX;
                }
                // term 0, price filters seem to use less than
                if ($price >= $priceParts[0] & $price < $priceParts[1]) {
                    return $value;
                }
            }
        }
        return null;
    }

}