<?php

namespace Magium\Magento\Actions\Checkout\PaymentMethods;

class NoPaymentMethod implements PaymentMethodInterface
{
    const ACTION = 'Checkout\PaymentMethods\NoPaymentMethod';

    public function getId()
    {
        return 'zipzeronada';
    }

    public function pay($requirePayment)
    {
        throw new PaymentException('Payment method was not set.  In your test case, make sure to call $this->setPaymentMethod(\'type\').');
    }
}