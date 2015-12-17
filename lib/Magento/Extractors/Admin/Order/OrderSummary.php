<?php

namespace Magium\Magento\Extractors\Admin\Order;

use Magium\Extractors\AbstractExtractor;
use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Themes\Admin\ThemeConfiguration;
use Magium\WebDriver\WebDriver;

class OrderSummary extends AbstractExtractor
{
    const EXTRACTOR = 'Admin\Order\OrderSummary';
    protected $orderDate;
    protected $orderStatus;
    protected $purchasedFrom;
    protected $placedFromIP;

    public function __construct(WebDriver $webDriver, AbstractMagentoTestCase $testCase, ThemeConfiguration $theme)
    {
        parent::__construct($webDriver, $testCase, $theme);
    }

    /**
     * @return mixed
     */
    public function getOrderDate()
    {
        return $this->orderDate;
    }

    /**
     * @return mixed
     */
    public function getOrderStatus()
    {
        return $this->orderStatus;
    }

    /**
     * @return mixed
     */
    public function getPurchasedFrom()
    {
        return $this->purchasedFrom;
    }

    /**
     * @return mixed
     */
    public function getPlacedFromIP()
    {
        return $this->placedFromIP;
    }

    public function extract()
    {
        $baseXpath = '//h4[contains(concat(" ",normalize-space(@class)," ")," head-account ")]/../../descendant::td/label[.="%s"]/../../td/strong';

        $element = $this->webDriver->byXpath(sprintf($baseXpath, $this->testCase->getTranslator()->translate('Order Date')));
        $this->orderDate = trim($element->getText());

        $element = $this->webDriver->byXpath(sprintf($baseXpath, $this->testCase->getTranslator()->translate('Order Status')));
        $this->orderStatus = trim($element->getText());

        $element = $this->webDriver->byXpath(sprintf($baseXpath, $this->testCase->getTranslator()->translate('Purchased From')));
        $this->purchasedFrom = trim($element->getText());

        $element = $this->webDriver->byXpath(sprintf($baseXpath, $this->testCase->getTranslator()->translate('Placed from IP')));
        $this->placedFromIP = trim($element->getText());
    }

}