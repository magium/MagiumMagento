<?php

namespace Magium\Magento\Extractors\Admin\Order;

use Magium\Extractors\AbstractExtractor;
use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Themes\AdminThemeConfiguration;
use Magium\WebDriver\WebDriver;

class PaymentInformation extends AbstractExtractor
{

    protected $paymentMethodInformation;
    protected $currency;

    public function __construct(WebDriver $webDriver, AbstractMagentoTestCase $testCase, AdminThemeConfiguration $theme)
    {
        parent::__construct($webDriver, $testCase, $theme);
    }

    /**
     * @return mixed
     */
    public function getPaymentMethodInformation()
    {
        return $this->paymentMethodInformation;
    }

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }


    public function extract()
    {
        $xpath = '//h4[contains(concat(" ",normalize-space(@class)," ")," head-payment-method ")]/../../descendant::fieldset';

        $currencyXpath = $xpath . '/div';

        $currencyElement = $this->webDriver->byXpath($currencyXpath);
        $currencyText = trim($currencyElement->getText());
        $currencyMessage = $this->testCase->getTranslator()->translate('Order was placed using');
        $this->currency = trim(str_replace($currencyMessage, '', $currencyText));

        $fullText = $this->webDriver->byXpath($xpath)->getText();
        $fullText = str_replace($currencyText, '', $fullText);
        $this->paymentMethodInformation = trim($fullText);

    }
}