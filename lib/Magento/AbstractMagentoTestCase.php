<?php

namespace Magium\Magento;

use Magium\AbstractTestCase;
use Magium\InvalidConfigurationException;

abstract class AbstractMagentoTestCase extends AbstractTestCase
{

    protected function setUp()
    {
        self::addBaseNamespace('Magium\Magento');
        parent::setUp();

        $this->setTypePreference(
            'Magium\Magento\Actions\Checkout\PaymentMethods\PaymentMethodInterface',
            'Magium\Magento\Actions\Checkout\PaymentMethods\NoPaymentMethod'
        );

        $this->setTypePreference(
            'Magium\Magento\Actions\Checkout\ShippingMethods\ShippingMethodInterface',
            'Magium\Magento\Actions\Checkout\ShippingMethods\FirstAvailable'
        );

        $this->setTypePreference(
            'Magium\Themes\ThemeConfigurationInterface',
            'Magium\Magento\Themes\AbstractThemeConfiguration'
        );

        $this->switchThemeConfiguration('Magium\Magento\Themes\Magento19\ThemeConfiguration');

    }

    /**
     * @param $method
     * @return \Magium\Magento\Actions\Checkout\PaymentMethods\PaymentMethodInterface
     */

    public function setPaymentMethod($method)
    {

        // If we are passed just the class name we will prepend it with Magium\Magento\Actions\Checkout\PaymentMethods
        if (strpos($method, '\\') === false) {
            $method = 'Magium\Magento\Actions\Checkout\PaymentMethods\\' . $method;
        }

        if (is_subclass_of($method, 'Magium\Magento\Actions\Checkout\PaymentMethods\PaymentMethodInterface')) {

            $this->setTypePreference('Magium\Magento\Actions\Checkout\PaymentMethods\PaymentMethodInterface', $method);
        } else {
            throw new InvalidConfigurationException('The payment method must implement Magium\Magento\Actions\Checkout\PaymentMethods\PaymentMethodInterface');
        }
    }

    /**
     * @param $method
     * @return \Magium\Magento\Actions\Checkout\ShippingMethods\ShippingMethodInterface
     */

    public function setShippingMethod($method)
    {

        // If we are passed just the class name we will prepend it with Magium\Magento\Actions\Checkout\PaymentMethods
        if (strpos($method, '\\') === false) {
            $method = 'Magium\Magento\Actions\Checkout\ShippingMethods\\' . $method;
        }

        if (is_subclass_of($method, 'Magium\Magento\Actions\Checkout\ShippingMethods\ShippingMethodInterface')) {

            $this->setTypePreference('Magium\Magento\Actions\Checkout\PaymentMethods\ShippingMethodInterface', [$method]);
        } else {
            throw new InvalidConfigurationException('The payment method must implement Magium\Magento\Actions\Checkout\ShippingMethods\ShippingMethodInterface');
        }
    }

    public function switchThemeConfiguration($fullyQualifiedClassName)
    {
        $reflection = new \ReflectionClass($fullyQualifiedClassName);
        if ($reflection->isSubclassOf('Magium\Magento\Themes\NavigableThemeInterface')) {
            // Not entirely sure of hardcoding the various interface types.  May make this configurable
            parent::switchThemeConfiguration($fullyQualifiedClassName);
            $this->setTypePreference('Magium\Magento\Themes\AbstractThemeConfiguration',$fullyQualifiedClassName);
            $this->setTypePreference('Magium\Magento\Themes\NavigableThemeInterface',$fullyQualifiedClassName);
            $this->setTypePreference('Magium\Themes\BaseThemeInterface',$fullyQualifiedClassName);

            $this->setTypePreference('Magium\Magento\Themes\Customer\AbstractThemeConfiguration',$this->getTheme()->getCustomerThemeClass());
            $this->setTypePreference('Magium\Magento\Themes\OnePageCheckout\AbstractThemeConfiguration',$this->getTheme()->getOnePageCheckoutThemeClass());


        } else {
            throw new InvalidConfigurationException('The theme configuration extend Magium\Magento\Themes\NavigableThemeInterface');
        }

    }

}
