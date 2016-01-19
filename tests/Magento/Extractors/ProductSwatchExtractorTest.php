<?php

namespace Tests\Magium\Magento\Extractors;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Extractors\Catalog\Product\Swatch;
use Magium\Magento\Navigators\Catalog\Product;

class ProductSwatchExtractorTest extends AbstractMagentoTestCase
{

    public function testProductSwatchExtractor()
    {
        $this->commandOpen($this->getTheme()->getBaseUrl());
        $this->getNavigator()->navigateTo($this->getTheme()->getNavigationPathToConfigurableProductCategory());
        $this->getNavigator(Product::NAVIGATOR)->navigateTo($this->getTheme()->getDefaultConfigurableProductName());

        $extractor = $this->getExtractor(Swatch::EXTRACTOR);
        /* @var $extractor Swatch */

        $extractor->extract();

        $names = $extractor->getSwatchItemNames();
        self::assertCount(2, $names);
        self::assertContains('Color', $names);
        self::assertContains('Size', $names);

        $item = $extractor->getSwatchItem('Color');
        $options = $item->getOptions();

        self::assertCount(4, $options);
        self::assertInstanceOf('Facebook\WebDriver\WebDriverELement', $options[0]->getClickElement());
        self::assertNotNull($options[0]->getUrl());
        self::assertNotNull($options[0]->getText());
        self::assertTrue($options[0]->getAvailable());

    }


    public function testProductSwatchExtractorNotAvailable()
    {
        $this->commandOpen($this->getTheme()->getBaseUrl());
        $this->getNavigator()->navigateTo($this->getTheme()->getNavigationPathToConfigurableProductCategory());
        $this->getNavigator(Product::NAVIGATOR)->navigateTo($this->getTheme()->getDefaultConfigurableProductName());

        $extractor = $this->getExtractor(Swatch::EXTRACTOR);
        /* @var $extractor Swatch */

        $extractor->extract();

        $item = $extractor->getSwatchItem('Color');
        $option = $item->getOption('red');
        self::assertTrue($option->getAvailable());
        $option->getClickElement()->click();

        // Re-extract
        $extractor->extract();

        $item = $extractor->getSwatchItem('Size');
        $option = $item->getOption('xl');
        self::assertFalse($option->getAvailable());
    }

    public function testThemeConfigurationWithoutConfigurationThrowsException()
    {
        $this->switchThemeConfiguration('Magium\Magento\Themes\Magento18\ThemeConfiguration');
        $this->setExpectedException(Swatch::EXCEPTION_MISSING_CONFIGURATION);
        $this->commandOpen($this->getTheme()->getBaseUrl());
        $this->getNavigator()->navigateTo($this->getTheme()->getNavigationPathToConfigurableProductCategory());
        $this->getNavigator(Product::NAVIGATOR)->navigateTo($this->getTheme()->getDefaultConfigurableProductName());

        $extractor = $this->getExtractor(Swatch::EXTRACTOR);
        /* @var $extractor Swatch */

        $extractor->extract();

    }

}