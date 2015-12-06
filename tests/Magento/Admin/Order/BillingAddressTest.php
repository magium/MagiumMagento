<?php


namespace Tests\Magento\Admin\Order;

use Magium\Magento\Extractors\Admin\Order\BillingAddress;


class BillingAddressTest extends \PHPUnit_Framework_TestCase
{

    public function testExtractAddress()
    {

        $extractor = $this->getMockedExtractor('Kevin Schroeder
Magento
10441 Jefferson Blvd
st2
Culver City, California, 90232
United States
T: 123-123-1234
F: 123-123-1235');

        $extractor->extract();
        self::assertEquals('Kevin Schroeder', $extractor->getName());
        self::assertEquals('Magento', $extractor->getBusiness());
        self::assertEquals('10441 Jefferson Blvd', $extractor->getStreet1());
        self::assertEquals('st2', $extractor->getStreet2());
        self::assertEquals('Culver City', $extractor->getCity());
        self::assertEquals('California', $extractor->getRegionId());
        self::assertEquals('90232', $extractor->getPostCode());
        self::assertEquals('United States', $extractor->getCountry());
        self::assertEquals('123-123-1234', $extractor->getPhone());
        self::assertEquals('123-123-1235', $extractor->getFax());

    }

    public function testExtractAddressVariation1()
    {

        $extractor = $this->getMockedExtractor('Kevin Schroeder
Magento
10441 Jefferson Blvd
Culver City, 90232
Tanzania
T: 123-123-1234');

        $extractor->extract();
        self::assertEquals('Kevin Schroeder', $extractor->getName());
        self::assertEquals('Magento', $extractor->getBusiness());
        self::assertEquals('10441 Jefferson Blvd', $extractor->getStreet1());
        self::assertNull($extractor->getStreet2());
        self::assertEquals('Culver City', $extractor->getCity());
        self::assertNull($extractor->getRegionId());
        self::assertEquals('90232', $extractor->getPostCode());
        self::assertEquals('Tanzania', $extractor->getCountry());
        self::assertEquals('123-123-1234', $extractor->getPhone());

    }

    public function testExtractAddressVariation2()
    {

        $extractor = $this->getMockedExtractor('Kevin Schroeder
10451 Jefferson Blvd
Bld 2
Culver City, California, 90232
United States
T: 123-123-1234');
        $extractor->extract();
        self::assertEquals('Kevin Schroeder', $extractor->getName());
        self::assertNull($extractor->getBusiness());
        self::assertEquals('10451 Jefferson Blvd', $extractor->getStreet1());
        self::assertEquals('Bld 2', $extractor->getStreet2());
        self::assertEquals('Culver City', $extractor->getCity());
        self::assertEquals('California', $extractor->getRegionId());
        self::assertEquals('90232', $extractor->getPostCode());
        self::assertEquals('United States', $extractor->getCountry());
        self::assertEquals('123-123-1234', $extractor->getPhone());
        self::assertNull($extractor->getFax());

    }

    public function getMockedExtractor($text)
    {
        $mockElement = $this->getMockBuilder('Facebook\WebDriver\Remote\RemoteWebElement')
            ->disableOriginalConstructor()
            ->setMethods(['getText'])
            ->getMock();
        $mockElement->method('getText')->willReturn($text);

        $builder = $this->getMockBuilder('Magium\WebDriver\WebDriver')->disableOriginalConstructor();
        $builder->setMethods(['byXpath', 'close']);
        $mockWebDriver = $builder->getMock();
        $mockWebDriver->method('close')->willReturn(true);
        $mockWebDriver->method('byXpath')->willReturn($mockElement);

        $extractor = new BillingAddress(
            $mockWebDriver,
            $this->getMock('Magium\Magento\AbstractMagentoTestCase'),
            $this->getMock('Magium\Themes\ThemeConfigurationInterface')
        );
        return $extractor;
    }


}