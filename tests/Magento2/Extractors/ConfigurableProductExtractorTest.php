<?php

namespace Tests\Magium\Magento2\Extractors;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Extractors\Catalog\Product\ConfigurableProductOptions;
use Magium\Magento\Navigators\Catalog\DefaultConfigurableProduct;
use Magium\Magento\Navigators\Catalog\DefaultConfigurableProductCategory;
use Magium\Magento\Themes\Magento2\ThemeConfiguration;

class ConfigurableProductExtractorTest extends AbstractMagentoTestCase
{

    protected function setUp()
    {
        parent::setUp();
        $this->switchThemeConfiguration(ThemeConfiguration::THEME);
    }

    public function testExtractConfigurableProducts()
    {
        $this->commandOpen($this->getTheme()->getBaseUrl());
        $this->getNavigator(DefaultConfigurableProductCategory::NAVIGATOR)->navigateTo();
        $this->getNavigator(DefaultConfigurableProduct::NAVIGATOR)->navigateTo();

        $extractor = $this->getExtractor(ConfigurableProductOptions::EXTRACTOR);
        /* @var $extractor ConfigurableProductOptions */

        $extractor->extract();

        self::assertNotNull($extractor->getOption('size'));
        self::assertNotNull($extractor->getOption('color'));

        $optionValue = $extractor->getOption('color')->getValue('red');
        self::assertInstanceOf('Magium\Magento\Extractors\Catalog\Product\SwatchValue', $optionValue);

    }

}