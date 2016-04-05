<?php

namespace Magium\Magento\Extractors\Catalog\Product;

use Magium\Magento\Themes\AbstractThemeConfiguration;
use Magium\WebDriver\WebDriver;

class SwatchProcessor
{

    protected $webDriver;
    protected $theme;

    public function __construct(
        WebDriver $webDriver,
        AbstractThemeConfiguration $themeConfiguration
    )
    {
        $this->webDriver = $webDriver;
        $this->theme = $themeConfiguration;
    }

    public function isConfigurableSwatch($count)
    {
        return $this->webDriver->elementExists($this->theme->getConfigurableSwatchSelectorXpath($count, 1), WebDriver::BY_XPATH);
    }

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
                trim($itemOptionElement->getAttribute($this->theme->getConfigurableSwatchOptionLabelAttributeName())),
                $itemOptionElement,
                $available,
                $img
            ));
        }
        return $swatch;
    }
}