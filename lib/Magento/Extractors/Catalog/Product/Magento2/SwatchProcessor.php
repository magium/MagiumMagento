<?php

namespace Magium\Magento\Extractors\Catalog\Product\Magento2;

use Magium\Magento\Extractors\Catalog\Product\Option;
use Magium\Magento\Extractors\Catalog\Product\SwatchValue;
use Magium\WebDriver\WebDriver;

class SwatchProcessor extends \Magium\Magento\Extractors\Catalog\Product\SwatchProcessor
{


    /**
     * @param $name
     * @param $count
     * @return Option
     */

    public function process($name, $count)
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
            $swatch->addValue(new SwatchValue(
                trim($itemOptionElement->getAttribute('option-label')),
                $itemOptionElement,
                $available,
                $img
            ));
        }
        return $swatch;
    }
}