<?php

namespace Tests\Magium\Magento\Extractors;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Extractors\Catalog\Product\ConfigurableProductOptions;
use Magium\Magento\Navigators\Catalog\DefaultConfigurableProduct;
use Magium\Magento\Navigators\Catalog\DefaultConfigurableProductCategory;

class ProductSwatchExtractorTest extends AbstractMagentoTestCase
{

    public function testProductSwatchExtractor()
    {
        $this->commandOpen($this->getTheme()->getBaseUrl());
        $this->getNavigator(DefaultConfigurableProductCategory::NAVIGATOR)->navigateTo();
        $this->getNavigator(DefaultConfigurableProduct::NAVIGATOR)->navigateTo();

        $extractor = $this->getExtractor(ConfigurableProductOptions::EXTRACTOR);
        /* @var $extractor ConfigurableProductOptions */

        $extractor->extract();

        $names = $extractor->getOptionNames();
        self::assertCount(2, $names);
        self::assertContains('Color', $names);
        self::assertContains('Size', $names);

        $item = $extractor->getOption('Color');
        $options = $item->getValues();

        self::assertCount(4, $options);
        self::assertInstanceOf('Facebook\WebDriver\WebDriverELement', $options[0]->getClickElement());
        self::assertNotNull($options[0]->getUrl());
        self::assertNotNull($options[0]->getText());
        self::assertTrue($options[0]->getAvailable());

    }


    public function testProductSwatchExtractorNotAvailable()
    {
        $this->commandOpen($this->getTheme()->getBaseUrl());
        $this->getNavigator(DefaultConfigurableProductCategory::NAVIGATOR)->navigateTo();
        $this->getNavigator(DefaultConfigurableProduct::NAVIGATOR)->navigateTo();

        $extractor = $this->getExtractor(ConfigurableProductOptions::EXTRACTOR);
        /* @var $extractor ConfigurableProductOptions */

        $extractor->extract();

        $item = $extractor->getOption('Color');
        $option = $item->getValue('red');
        self::assertInstanceOf('Magium\Magento\Extractors\Catalog\Product\SwatchValue', $option);
        self::assertTrue($option->getAvailable());
        $option->getClickElement()->click();

        // Re-extract
        $extractor->extract();

        $item = $extractor->getOption('Size');
        $option = $item->getValue('xl');
        self::assertInstanceOf('Magium\Magento\Extractors\Catalog\Product\SwatchValue', $option);
        self::assertFalse($option->getAvailable());
    }


}