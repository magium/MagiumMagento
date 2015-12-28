<?php

namespace Tests\Magento\Extractors;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Extractors\Catalog\LayeredNavigation\FilterTypes\PriceFilter;
use Magium\Magento\Extractors\Catalog\LayeredNavigation\FilterValue;
use Magium\Magento\Extractors\Catalog\LayeredNavigation\LayeredNavigation;
use Magium\Magento\Navigators\BaseMenu;

class LayeredNavigationExtractorTest extends AbstractMagentoTestCase
{

    protected $category = 'Men/Shirts';
    protected $filter = 'Fit';
    protected $expectedFilter = [
        'Sharp',
        1
    ];

    public function testDefaultValues()
    {
        $this->commandOpen($this->getTheme()->getBaseUrl());
        $this->getNavigator(BaseMenu::NAVIGATOR)->navigateTo($this->category);
        $url = $this->webdriver->getCurrentURL();
        $extractor = $this->getExtractor(LayeredNavigation::EXTRACTOR);
        /* @var $extractor \Magium\Magento\Extractors\Catalog\LayeredNavigation\LayeredNavigation */
        $extractor->extract();
        $types = $extractor->getFilterNames();
        self::assertNotFalse(array_search($this->filter, $types));
        $value = $extractor->getFilter($this->filter)->getValueForText($this->expectedFilter[0]);

        self::assertEquals($this->expectedFilter[1], $value->getCount());
        self::assertGreaterThan(strlen($url), strlen($value->getLink()));
        self::assertTrue(strpos($value->getLink(), $url) === 0);

    }

    public function testRequestingMissingFilterThrowsException()
    {
        $this->setExpectedException('Magium\Magento\Extractors\Catalog\LayeredNavigation\MissingFilterException');
        $this->commandOpen($this->getTheme()->getBaseUrl());
        $this->getNavigator(BaseMenu::NAVIGATOR)->navigateTo($this->category);
        $extractor = $this->getExtractor(LayeredNavigation::EXTRACTOR);
        /* @var $extractor \Magium\Magento\Extractors\Catalog\LayeredNavigation\LayeredNavigation */
        $extractor->extract();
        $extractor->getFilter('boogers');
    }


    public function testRequestingMissingValueThrowsException()
    {
        $this->setExpectedException('Magium\Magento\Extractors\Catalog\LayeredNavigation\MissingValueException');
        $this->commandOpen($this->getTheme()->getBaseUrl());
        $this->getNavigator(BaseMenu::NAVIGATOR)->navigateTo($this->category);
        $extractor = $this->getExtractor(LayeredNavigation::EXTRACTOR);
        /* @var $extractor \Magium\Magento\Extractors\Catalog\LayeredNavigation\LayeredNavigation */
        $extractor->extract();
        $extractor->getFilter($this->filter)->getValueForText('boogers');
    }
    public function testPriceValues()
    {
        $this->commandOpen($this->getTheme()->getBaseUrl());
        $this->getNavigator(BaseMenu::NAVIGATOR)->navigateTo($this->category);
        $url = $this->webdriver->getCurrentURL();
        $extractor = $this->getExtractor(LayeredNavigation::EXTRACTOR);
        /* @var $extractor \Magium\Magento\Extractors\Catalog\LayeredNavigation\LayeredNavigation */
        $extractor->extract();

        $price = $extractor->getFilter('price');
        self::assertInstanceOf('Magium\Magento\Extractors\Catalog\LayeredNavigation\FilterTypes\PriceFilter', $price);
        $price = $price->getValueForPrice(161);
        /* @var $price FilterValue */
        self::assertInstanceOf('Magium\Magento\Extractors\Catalog\LayeredNavigation\FilterValue', $price);
        self::assertTrue(strpos($price->getLink(), $url) === 0);

        $bigPrice = $extractor->getFilter('price');
        self::assertInstanceOf('Magium\Magento\Extractors\Catalog\LayeredNavigation\FilterTypes\PriceFilter', $bigPrice);
        $bigPrice = $bigPrice->getValueForPrice(1500);
        self::assertInstanceOf('Magium\Magento\Extractors\Catalog\LayeredNavigation\FilterValue', $bigPrice);
        self::assertTrue(strpos($bigPrice->getLink(), $url) === 0);

        // Different objects should be returned.  $price should be $160-$169.99 and $bigPrice $190 and above
        self::assertNotSame($price, $bigPrice);
    }

    public function testWebDriverElementIsClickable()
    {
        $this->commandOpen($this->getTheme()->getBaseUrl());
        $this->getNavigator(BaseMenu::NAVIGATOR)->navigateTo($this->category);

        $extractor = $this->getExtractor(LayeredNavigation::EXTRACTOR);
        /* @var $extractor \Magium\Magento\Extractors\Catalog\LayeredNavigation\LayeredNavigation */
        $extractor->extract();

        $price = $extractor->getFilter('price');
        self::assertInstanceOf('Magium\Magento\Extractors\Catalog\LayeredNavigation\FilterTypes\PriceFilter', $price);
        $price = $price->getValueForPrice(161);
        /* @var $price FilterValue */
        self::assertInstanceOf('Magium\Magento\Extractors\Catalog\LayeredNavigation\FilterValue', $price);
        self::assertInstanceOf('Facebook\WebDriver\WebDriverElement', $price->getElement());
        $price->getElement()->click();
        self::assertEquals($this->webdriver->getCurrentURL(), $price->getLink());

    }

    public function testPriceValuesForNoValueReturnNull()
    {
        $this->commandOpen($this->getTheme()->getBaseUrl());
        $this->getNavigator(BaseMenu::NAVIGATOR)->navigateTo($this->category);
        $url = $this->webdriver->getCurrentURL();
        $extractor = $this->getExtractor(LayeredNavigation::EXTRACTOR);
        /* @var $extractor \Magium\Magento\Extractors\Catalog\LayeredNavigation\LayeredNavigation */
        $extractor->extract();

        $price = $extractor->getFilter('price')->getValueForPrice(100);
        // This test depends on the sample data; nothing below $140
        self::assertNull($price);

    }

    public function testSwatchValues()
    {
        $this->commandOpen($this->getTheme()->getBaseUrl());
        $this->getNavigator(BaseMenu::NAVIGATOR)->navigateTo($this->category);
        $url = $this->webdriver->getCurrentURL();
        $extractor = $this->getExtractor(LayeredNavigation::EXTRACTOR);
        /* @var $extractor \Magium\Magento\Extractors\Catalog\LayeredNavigation\LayeredNavigation */
        $extractor->extract();

        $filter = $extractor->getFilter('color');
        /* @var $filter \Magium\Magento\Extractors\Catalog\LayeredNavigation\FilterTypes\SwatchFilter */
        self::assertInstanceOf('Magium\Magento\Extractors\Catalog\LayeredNavigation\FilterTypes\SwatchFilter', $filter);

        $value = $filter->getValueForSwatch('blue');
        /* @var $value \Magium\Magento\Extractors\Catalog\LayeredNavigation\FilterTypes\SwatchFilterValue */
        self::assertInstanceOf('Magium\Magento\Extractors\Catalog\LayeredNavigation\FilterTypes\SwatchFilterValue', $value);

        self::assertEquals('Blue', $value->getText());
        $imageLink = $value->getImageLink();
        self::assertContains('blue', $imageLink);
        self::assertEquals(1, $value->getCount());
        self::assertTrue(strpos($value->getLink(), $url) === 0);
    }

    public function testRemovePriceValues()
    {
        $this->commandOpen($this->getTheme()->getBaseUrl());
        $this->getNavigator(BaseMenu::NAVIGATOR)->navigateTo($this->category);
        $extractor = $this->getExtractor(LayeredNavigation::EXTRACTOR);
        /* @var $extractor \Magium\Magento\Extractors\Catalog\LayeredNavigation\LayeredNavigation */
        $extractor->removeFilterType(LayeredNavigation::FILTER_TYPE_PRICE);
        $extractor->extract();

        $price = $extractor->getFilter('price');

        self::assertInstanceOf('Magium\Magento\Extractors\Catalog\LayeredNavigation\FilterTypes\DefaultFilter', $price);
    }

    public function testReplacePriceValuesWithIncorrectClassThrowsException()
    {
        $this->setExpectedException('Magium\Magento\Extractors\Catalog\LayeredNavigation\InvalidFilterException');
        $extractor = $this->getExtractor(LayeredNavigation::EXTRACTOR);
        /* @var $extractor \Magium\Magento\Extractors\Catalog\LayeredNavigation\LayeredNavigation */
        $extractor->replaceFilterType(LayeredNavigation::FILTER_TYPE_PRICE, 'Boogers');
    }

    public function testReplacePriceValues()
    {
        $this->commandOpen($this->getTheme()->getBaseUrl());
        $this->getNavigator(BaseMenu::NAVIGATOR)->navigateTo($this->category);
        $url = $this->webdriver->getCurrentURL();
        $extractor = $this->getExtractor(LayeredNavigation::EXTRACTOR);
        /* @var $extractor \Magium\Magento\Extractors\Catalog\LayeredNavigation\LayeredNavigation */
        $extractor->replaceFilterType(LayeredNavigation::FILTER_TYPE_PRICE, 'Tests\Magento\Extractors\TemporaryPriceValueForLayeredNavigation');
        $extractor->extract();

        $price = $extractor->getFilter('price');

        self::assertInstanceOf('Tests\Magento\Extractors\TemporaryPriceValueForLayeredNavigation', $price);
    }
}

class TemporaryPriceValueForLayeredNavigation extends PriceFilter {};