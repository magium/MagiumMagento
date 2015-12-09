<?php

namespace Magium\Magento;

use Magium\AbstractTestCase;
use Magium\InvalidConfigurationException;

abstract class AbstractMagentoTestCase extends AbstractTestCase
{

    protected $baseNamespace = 'Magium\Magento';

    protected function setUp()
    {
        parent::setUp();

        $this->di->instanceManager()->setTypePreference(
            'Magium\\Magento\\Actions\\Checkout\\PaymentMethods\\PaymentMethodInterface',
            ['Magium\\Magento\\Actions\\Checkout\\PaymentMethods\\NoPaymentMethod']
        );

        $this->di->instanceManager()->setTypePreference(
            'Magium\\Magento\\Actions\\Checkout\\ShippingMethods\\ShippingMethodInterface',
            ['Magium\\Magento\\Actions\\Checkout\\ShippingMethods\\FirstAvailable']
        );

        $this->di->instanceManager()->setTypePreference(
            'Magium\\Themes\\ThemeConfigurationInterface',
            ['Magium\\Magento\\Themes\\AbstractThemeConfiguration']
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
            $method = $this->baseNamespace . '\\Actions\\Checkout\\PaymentMethods\\' . $method;
        }

        $reflection = new \ReflectionClass($method);
        if ($reflection->isSubclassOf('Magium\Magento\Actions\Checkout\PaymentMethods\PaymentMethodInterface')) {

            $this->di->instanceManager()->unsetTypePreferences('Magium\\Magento\\Actions\\Checkout\\PaymentMethods\\PaymentMethodInterface');
            $this->di->instanceManager()->setTypePreference('Magium\\Magento\\Actions\\Checkout\\PaymentMethods\\PaymentMethodInterface', [$method]);
        } else {
            throw new InvalidConfigurationException('The payment method must implement Magium\Magento\Actions\Checkout\PaymentMethods\PaymentMethodInterface');
        }
    }

    public function switchThemeConfiguration($fullyQualifiedClassName)
    {
        $reflection = new \ReflectionClass($fullyQualifiedClassName);
        if ($reflection->isSubclassOf('Magium\Magento\Themes\NavigableThemeInterface')) {
            // Not entirely sure of hardcoding the various interface types.  May make this configurable
            parent::switchThemeConfiguration($fullyQualifiedClassName);
            $this->di->instanceManager()->unsetTypePreferences('Magium\Magento\Themes\AbstractThemeConfiguration');
            $this->di->instanceManager()->setTypePreference(
                'Magium\Magento\Themes\AbstractThemeConfiguration',
                [$fullyQualifiedClassName]
            );
            $this->di->instanceManager()->unsetTypePreferences('Magium\Magento\Themes\NavigableThemeInterface');
            $this->di->instanceManager()->setTypePreference(
                'Magium\Magento\Themes\NavigableThemeInterface',
                [$fullyQualifiedClassName]
            );
            $this->di->instanceManager()->unsetTypePreferences('Magium\Magento\Themes\Customer\AbstractThemeConfiguration');
            $this->di->instanceManager()->setTypePreference(
                'Magium\Magento\Themes\Customer\AbstractThemeConfiguration',
                [$this->getTheme()->getCustomerThemeClass()]
            );
        } else {
            throw new InvalidConfigurationException('The theme configuration extend Magium\Magento\Themes\NavigableThemeInterface');
        }

    }

}
