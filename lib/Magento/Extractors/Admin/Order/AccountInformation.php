<?php

namespace Magium\Magento\Extractors\Admin\Order;

use Magium\Extractors\AbstractExtractor;
use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Themes\Admin\ThemeConfiguration;
use Magium\WebDriver\WebDriver;

class AccountInformation extends AbstractExtractor
{
    const EXTRACTOR = 'Admin\Order\AccountInformation';

    const VALUE_CUSTOMER_NAME       = 'customer-name';
    const VALUE_EMAIL               = 'email';
    const VALUE_CUSTOMER_GROUP      = 'customer-group';

    public function __construct(WebDriver $webDriver, AbstractMagentoTestCase $testCase, ThemeConfiguration $theme)
    {
        parent::__construct($webDriver, $testCase, $theme);
    }

    public function getCustomerName()
    {
        return $this->getValue(self::VALUE_CUSTOMER_NAME);
    }

    public function getEmail()
    {
        return $this->getValue(self::VALUE_EMAIL);
    }

    public function getCustomerGroup()
    {
        return $this->getValue(self::VALUE_CUSTOMER_GROUP);
    }

    public function extract()
    {
        $translator = $this->testCase->getTranslator();

        $xpath = sprintf(
            '//h4[.="%s"]/../../descendant::label[.="%s"]/../../td[@class="value"]',
            $translator->translate('Account Information'),
            $translator->translate('Customer Name')
        );

        $customerNameElement = $this->webDriver->byXpath($xpath);

        $xpath = sprintf(
            '//h4[.="%s"]/../../descendant::label[.="%s"]/../../td[@class="value"]',
            $translator->translate('Account Information'),
            $translator->translate('Email')
        );

        $customerEmailElement = $this->webDriver->byXpath($xpath);

        $xpath = sprintf(
            '//h4[.="%s"]/../../descendant::label[.="%s"]/../../td[@class="value"]',
            $translator->translate('Account Information'),
            $translator->translate('Customer Group')
        );

        $customerCustomerGroupElement = $this->webDriver->byXpath($xpath);

        $this->values[self::VALUE_CUSTOMER_NAME] = trim($customerNameElement->getText());
        $this->values[self::VALUE_EMAIL] = trim($customerEmailElement->getText());
        $this->values[self::VALUE_CUSTOMER_GROUP] = trim($customerCustomerGroupElement->getText());
    }

}