<?php

namespace Magium\Magento\Actions\Checkout\PaymentMethods;

interface PaymentMethodInterface
{
    public function getId();

    public function pay($requirePayment);
}