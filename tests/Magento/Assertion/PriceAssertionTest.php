<?php

namespace Test\Magium\Magento\Assertion;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Assertions\Product\Price;
use Magium\Magento\Navigators\Catalog\DefaultSimpleProduct;
use Magium\Magento\Navigators\Catalog\DefaultSimpleProductCategory;

class PriceAssertionTest extends AbstractMagentoTestCase
{
    protected $price = '55.00';

    public function testPriceAssertionPasses()
    {
        $this->doIt($this->price);
    }

    public function testPriceAssertionFails()
    {
        $this->setExpectedException(\PHPUnit_Framework_AssertionFailedError::class);
        $this->doIt($this->price + 1);
    }

    protected function doIt($price)
    {
        $this->commandOpen($this->getTheme()->getBaseUrl());
        $this->getNavigator(DefaultSimpleProductCategory::NAVIGATOR)->navigateTo();
        $this->getNavigator(DefaultSimpleProduct::NAVIGATOR)->navigateTo();
        $assertion = $this->getAssertion(Price::ASSERTION);
        /* @var $assertion \Magium\Magento\Assertions\Product\Price */
        $assertion->assertPrice($price);
    }


}
