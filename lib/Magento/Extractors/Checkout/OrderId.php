<?php

namespace Magium\Magento\Extractors\Checkout;

use Magium\AbstractTestCase;
use Magium\Extractors\AbstractExtractor;
use Magium\Magento\Actions\Checkout\Steps\StepInterface;
use Magium\Magento\Themes\OnePageCheckout\AbstractThemeConfiguration;
use Magium\WebDriver\WebDriver;

class OrderId extends AbstractExtractor implements StepInterface
{

    const EXTRACTOR = 'Checkout\OrderId';

    public function __construct(WebDriver $webDriver, AbstractTestCase $testCase, AbstractThemeConfiguration $theme)
    {
        parent::__construct($webDriver, $testCase, $theme);
    }


    public function getOrderId()
    {
        return $this->getValue('order-id');
    }

    public function extract()
    {
        $theme = $this->theme;
        if ($theme instanceof AbstractThemeConfiguration) {
            $this->testCase->assertElementDisplayed($theme->getOrderNumberExtractorXpath(), AbstractTestCase::BY_XPATH);
            $element = $this->webDriver->byXpath($theme->getOrderNumberExtractorXpath());
            $text = $element->getText();
            $orderId = preg_replace('/\D/', '', $text);
            $this->values['order-id'] = $orderId;
            return true;
        } else {
            return false;
        }
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