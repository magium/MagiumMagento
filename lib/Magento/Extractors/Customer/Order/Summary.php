<?php

namespace Magium\Magento\Extractors\Customer\Order;


use Facebook\WebDriver\WebDriverElement;
use Magium\Extractors\DateTime;
use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Themes\Customer\AbstractThemeConfiguration;
use Magium\WebDriver\WebDriver;

class Summary extends AbstractOrderExtractor
{
    const EXTRACTOR = 'Customer\Order\Summary';

    protected $element;
    protected $dateTime;

    protected $orderDate;
    protected $subTotal;
    protected $shippingAndHandling;
    protected $tax;
    protected $grandTotal;
    protected $status;

    public function __construct(WebDriver $webDriver, AbstractMagentoTestCase $testCase, AbstractThemeConfiguration $theme, DateTime $dateTime)
    {
        parent::__construct($webDriver, $testCase, $theme);
        $this->dateTime = $dateTime;
    }


    public function getOrderDate()
    {
        return $this->orderDate;
    }

    public function getSubTotal()
    {
        return $this->subTotal;
    }

    public function getShippingAndHandling()
    {
        return $this->shippingAndHandling;
    }

    public function getTax()
    {
        return $this->tax;
    }

    public function getGrandTotal()
    {
        return $this->grandTotal;
    }

    public function getStatus()
    {
        return $this->status;
    }
    
    public function extract()
    {
        if ($this->element instanceof WebDriverElement && $this->webDriver->elementAttached($this->element)) {
            return;
        }
        $this->element = $this->webDriver->byXpath('//body'); // Just need any element on the page
        $this->grandTotal = trim($this->webDriver->byXpath($this->theme->getOrderGrandTotalXpath())->getText());
        $this->subTotal = trim($this->webDriver->byXpath($this->theme->getOrderSubtotalXpath())->getText());
        $this->tax = trim($this->webDriver->byXpath($this->theme->getOrderTaxXpath())->getText());
        $this->shippingAndHandling = trim($this->webDriver->byXpath($this->theme->getOrderShippingAndHandlingXpath())->getText());
        $dateText = trim($this->webDriver->byXpath($this->theme->getOrderDateXpath())->getText());
        $this->dateTime->setText($dateText);
        $this->dateTime->extract();
        $this->orderDate = $this->dateTime->getDateString();

        $statusText = $this->webDriver->byXpath($this->theme->getOrderStatusXpath())->getText();
        $matches = null;
        if (preg_match($this->theme->getOrderStatusRegex(), $statusText, $matches)) {
            $this->status = $matches[1];
        }
    }

}