<?php

namespace Magium\Magento\Actions\Cart;

use Magium\Actions\WaitForPageLoaded;
use Magium\Magento\Extractors\Catalog\Product\ConfigurableProductOptions;
use Magium\Magento\Extractors\Catalog\Product\Swatch;
use Magium\Magento\Extractors\Catalog\Product\Option;
use Magium\Magento\Extractors\Catalog\Product\SwatchValue;
use Magium\Magento\Extractors\Catalog\Product\Value;
use Magium\Magento\Themes\AbstractThemeConfiguration;
use Magium\WebDriver\WebDriver;

class AddConfigurableProductToCart extends AddSimpleProductToCart
{

    const ACTION = 'Cart\AddConfigurableProductToCart';

    const EXCEPTION_INVALID_CONFIGURABLE_OPTION = 'Magium\Magento\Actions\Cart\InvalidConfigurableOptionException';

    protected $option;
    protected $options = [];

    public function __construct(
        WebDriver $webDriver,
        AbstractThemeConfiguration $themeConfiguration,
        WaitForPageLoaded $loaded,
        ConfigurableProductOptions $option
    )
    {
        parent::__construct($webDriver, $themeConfiguration, $loaded);
        $this->option = $option;
    }

    public function setOption($attribute, $option)
    {
        $this->options[strtolower($attribute)] = $option;
    }

    public function getOption($attribute)
    {
        $attribute = strtolower($attribute);
        foreach ($this->options as $name => $option) {
            if ($name == $attribute) {
                return $option;
            }
        }

    }


    public function execute()
    {
        $this->option->extract();
        if (count($this->options)) {
            $attributes = $this->option->getOptionNames();
            foreach ($attributes as $attributeName) {
                $elementOption = $this->option->getOption($attributeName);
                if (!$elementOption) continue;
                // The options are sorted by  their entry into the setOption() method.  Need to have it ordered by the page order

                if (!$elementOption instanceof Option) {
                    throw new InvalidConfigurableOptionException('Missing the attribute: ' . $attribute);
                }
                $element = $elementOption->getOption($this->getOption($attributeName));
                if (!$element instanceof Value) {
                    throw new InvalidConfigurableOptionException(sprintf('Missing the option %s for the attribute %s ', $option, $attribute));
                }
                $element->getClickElement()->click();
            }
        } else {
            $names = $this->option->getOptionNames();
            foreach ($names as $name) {
                $option = $this->option->getOption($name);
                $items = $option->getOptions();
                foreach ($items as $item) {
                    if ($item->getAvailable()) {
                        $item->getClickElement()->click();
                        break;
                    }
                }
            }
        }
        return parent::execute();
    }

}