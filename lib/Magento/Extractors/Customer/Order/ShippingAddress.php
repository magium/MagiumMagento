<?php

namespace Magium\Magento\Extractors\Customer\Order;


use Magium\Extractors\AbstractAddressExtractor;
use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Themes\Customer\AbstractThemeConfiguration;
use Magium\WebDriver\WebDriver;

class ShippingAddress extends AbstractAddressExtractor
{

    const EXTRACTOR = 'Customer\Order\ShippingAddress';

    /**
     * @var AbstractThemeConfiguration
     */

    protected $theme;

    public function __construct(WebDriver $webDriver, AbstractMagentoTestCase $testCase, AbstractThemeConfiguration $theme)
    {
        parent::__construct($webDriver, $testCase, $theme);
    }

    public function getBaseXpath()
    {
        return $this->theme->getOrderShippingAddressBaseXpath();
    }

}