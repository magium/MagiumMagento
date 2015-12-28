<?php

namespace Magium\Magento\Actions\Admin\Configuration\PaymentMethods;

use Magium\InvalidConfigurationException;
use Magium\Magento\Actions\Admin\Configuration\AbstractSettingGroup;
use Magium\Magento\Actions\Admin\Configuration\SettingModifier;

abstract class AbstractPaymentMethod extends AbstractSettingGroup
{

    const SETTING_OPTION_NEW_ORDER_STATUS_PENDING = 'pending';
    const SETTING_OPTION_NEW_ORDER_STATUS_PROCESSING = 'pending';
    const SETTING_OPTION_NEW_ORDER_STATUS_PROCESSED_OGONE = 'processed_ogone';

    const SETTING_OPTION_PAYMENT_ACTION_AUTHORIZE = 'authorize';
    const SETTING_OPTION_PAYMENT_ACTION_AUTHORIZE_AND_CAPTURE = 'authorize_capture';


    const SETTING_OPTION_PAYMENT_FROM_APPLICABLE_COUNTRIES_ALL_ALLOWED = 0;
    const SETTING_OPTION_PAYMENT_FROM_APPLICABLE_COUNTRIES_SPECIFIC = 1;



}