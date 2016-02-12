<?php

namespace Magium\Magento;

use Magium\AbstractTestCase;
use Magium\Util\TestCase\RegistrationCallbackInterface;

class Registration implements RegistrationCallbackInterface
{

    public function register(AbstractTestCase $testCase)
    {
        $testCase->setTypePreference(
            'Magium\Magento\Actions\Checkout\PaymentMethods\PaymentMethodInterface',
            'Magium\Magento\Actions\Checkout\PaymentMethods\NoPaymentMethod'
        );

        $testCase->setTypePreference(
            'Magium\Magento\Actions\Checkout\ShippingMethods\ShippingMethodInterface',
            'Magium\Magento\Actions\Checkout\ShippingMethods\FirstAvailable'
        );

        $testCase->setTypePreference(
            'Magium\Themes\ThemeConfigurationInterface',
            'Magium\Magento\Themes\AbstractThemeConfiguration'
        );

        $testCase->switchThemeConfiguration('Magium\Magento\Themes\Magento19\ThemeConfiguration');
    }

}