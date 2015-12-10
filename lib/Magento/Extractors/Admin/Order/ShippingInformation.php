<?php

namespace Magium\Magento\Extractors\Admin\Order;

use Magium\Extractors\AbstractExtractor;
use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Themes\Admin\ThemeConfiguration;
use Magium\WebDriver\WebDriver;

class ShippingInformation extends AbstractExtractor
{

    protected $type;
    protected $cost;

    public function __construct(WebDriver $webDriver, AbstractMagentoTestCase $testCase, ThemeConfiguration $theme)
    {
        parent::__construct($webDriver, $testCase, $theme);
    }

    /**
     * @return mixed
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    public function extract()
    {
        $baseXpath = '//h4[contains(concat(" ",normalize-space(@class)," ")," head-shipping-method ")]/../../descendant::fieldset/';

        $this->type = $this->webDriver->byXpath($baseXpath.'strong')->getText();
        $this->cost = $this->webDriver->byXpath($baseXpath.'span')->getText();

    }

}