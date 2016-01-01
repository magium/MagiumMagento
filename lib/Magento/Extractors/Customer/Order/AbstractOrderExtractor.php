<?php

namespace Magium\Magento\Extractors\Customer\Order;

use Magium\Extractors\AbstractExtractor;
use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Themes\Customer\AbstractThemeConfiguration;
use Magium\WebDriver\WebDriver;

abstract class AbstractOrderExtractor extends AbstractExtractor
{

    /**
     * @var AbstractThemeConfiguration
     */

    protected $theme;

    public function __construct(WebDriver $webDriver, AbstractMagentoTestCase $testCase, AbstractThemeConfiguration $theme)
    {
        parent::__construct($webDriver, $testCase, $theme);
    }
}