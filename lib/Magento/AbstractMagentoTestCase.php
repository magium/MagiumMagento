<?php

namespace Magium\Magento;

use Magium\AbstractTestCase;
use Magium\InvalidConfigurationException;
use Magium\Magento\Actions\Checkout\PaymentMethods\PaymentMethodInterface;
use Magium\Magento\Actions\Checkout\ShippingMethods\ShippingMethodInterface;
use Magium\Magento\Themes\AbstractThemeConfiguration;
use Magium\Util\TestCase\RegistrationListener;

abstract class AbstractMagentoTestCase extends AbstractTestCase
{

    protected function setUp()
    {
        self::addBaseNamespace('Magium\Magento');
        RegistrationListener::addCallback(new Registration(), 100);
        parent::setUp();
    }

    /**
     * @param $method
     * @return PaymentMethodInterface
     */

    public function setPaymentMethod($method)
    {

        // If we are passed just the class name we will prepend it with Magium\Magento\Actions\Checkout\PaymentMethods
        if (strpos($method, '\\') === false) {
            $method = 'Checkout\PaymentMethods\\' . $method;
            $method = self::resolveClass($method, 'Actions');
        }
        $reflection = new \ReflectionClass($method);
        if ($reflection->implementsInterface('Magium\Magento\Actions\Checkout\PaymentMethods\PaymentMethodInterface')) {

            $this->setTypePreference('Magium\Magento\Actions\Checkout\PaymentMethods\PaymentMethodInterface', $method);
        } else {
            throw new InvalidConfigurationException('The payment method must implement Magium\Magento\Actions\Checkout\PaymentMethods\PaymentMethodInterface');
        }
    }

    /**
     * @return PaymentMethodInterface
     */

    public function getPaymentMethod()
    {
        return $this->get('Magium\Magento\Actions\Checkout\PaymentMethods\PaymentMethodInterface');
    }

    /**
     * @return \Magium\Magento\Actions\Checkout\PaymentInformation
     */

    public function getPaymentInformation()
    {
        return $this->get('Magium\Magento\Actions\Checkout\PaymentInformation');
    }

    /**
     * This is more of a helper for code completion
     *
     * @param null $theme
     * @return AbstractThemeConfiguration
     */

    public function getTheme($theme = null)
    {
        return parent::getTheme($theme);
    }

    /**
     * @param $method
     * @return \Magium\Magento\Actions\Checkout\ShippingMethods\ShippingMethodInterface
     */

    public function setShippingMethod($method)
    {

        // When just the class name is passed we will prepend it with Magium\Magento\Actions\Checkout\PaymentMethods
        if (strpos($method, '\\') === false) {
            $method = 'Magium\Magento\Actions\Checkout\ShippingMethods\\' . $method;
        }
        $reflection = new \ReflectionClass($method);
        if ($reflection->implementsInterface('Magium\Magento\Actions\Checkout\ShippingMethods\ShippingMethodInterface')) {
            $this->setTypePreference('Magium\Magento\Actions\Checkout\ShippingMethods\ShippingMethodInterface', $method);
        } else {
            throw new InvalidConfigurationException('The payment method must implement Magium\Magento\Actions\Checkout\ShippingMethods\ShippingMethodInterface');
        }
    }

    /**
     * @return ShippingMethodInterface
     */

    public function getShippingMethod()
    {
        return $this->get('Magium\Magento\Actions\Checkout\ShippingMethods\ShippingMethodInterface');
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
            $this->setTypePreference('Magium\Magento\Themes\OnePageCheckout\AbstractThemeConfiguration',$this->getTheme()->getCheckoutThemeClass());
        } else {
            throw new InvalidConfigurationException('The theme configuration extend Magium\Magento\Themes\NavigableThemeInterface');
        }

    }

}
