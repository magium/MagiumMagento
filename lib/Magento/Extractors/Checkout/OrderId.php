<?php

namespace Magium\Magento\Extractors\Checkout;

use Magium\AbstractTestCase;
use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Actions\Checkout\Steps\StepInterface;
use Magium\Extractors\AbstractExtractor;
use Magium\WebDriver\WebDriver;

class OrderId extends AbstractExtractor implements StepInterface
{

    const EXTRACTOR = 'Checkout\OrderId';

    public function getOrderId()
    {
        return $this->getValue('order-id');
    }

    public function extract()
    {
        $this->testCase->assertElementDisplayed('//p[contains(., "Your order # is:")]', AbstractTestCase::BY_XPATH);
        $element = $this->webDriver->byXpath('//p[contains(., "Your order # is:")]');
        $text = $element->getText();
        $orderId = preg_replace('/\D/', '', $text);
        $this->values['order-id'] = $orderId;
        return true;
    }

    public function execute()
    {
        $this->extract();
        return true;
    }

    public function nextAction()
    {
        return true;
    }

}