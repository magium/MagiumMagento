<?php

namespace Magium\Magento;

use Magium\AbstractTestCase;

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
            ['Magium\\Magento\\Themes\\ThemeConfiguration']
        );

    }


    /**
     * @param $method
     * @return \Magium\Magento\Actions\Checkout\PaymentMethods\PaymentMethodInterface
     */

    public function setPaymentMethod($method)
    {
        // If we are passed just the class name we will prepend it with Magium\Magento\Actions\Checkout\PaymentMethods
        if (strpos($method, '\\') === false) {
            $method = 'Magium\\Magento\\Actions\\Checkout\\PaymentMethods\\' . $method;
        }
        $methodInstance = $this->get($method);
        self::assertInstanceOf('Magium\\Magento\\Actions\\Checkout\\PaymentMethods\\PaymentMethodInterface', $methodInstance);
        $this->di->instanceManager()->unsetTypePreferences('Magium\\Magento\\Actions\\Checkout\\PaymentMethods\\PaymentMethodInterface');
        $this->di->instanceManager()->setTypePreference('Magium\\Magento\\Actions\\Checkout\\PaymentMethods\\PaymentMethodInterface', [$method]);

    }


    public function switchThemeConfiguration($fullyQualifiedClassName)
    {
        $this->di->instanceManager()->setTypePreference('Magium\Magento\Navigators\BaseNavigator', [$fullyQualifiedClassName]);
    }

}
