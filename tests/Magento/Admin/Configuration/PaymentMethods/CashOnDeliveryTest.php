<?php

namespace Tests\Magento\Admin\Configuration\PaymentMethods;

use Magium\Magento\Actions\Admin\Configuration\PaymentMethods\CashOnDelivery;

class CashOnDeliveryTest extends AbstractPaymentMethodTest
{

    public function testEnablePaymentMethod()
    {
        parent::enablePaymentMethod(CashOnDelivery::ACTION, 'payment_cashondelivery_active');
    }

    public function testChangeTitle()
    {
        parent::changeTitle(CashOnDelivery::ACTION, 'payment_cashondelivery_title', 'Cash On Delivery');
    }

}