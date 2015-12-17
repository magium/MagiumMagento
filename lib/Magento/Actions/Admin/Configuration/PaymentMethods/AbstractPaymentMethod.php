<?php

namespace Magium\Magento\Actions\Admin\Configuration\PaymentMethods;

use Magium\InvalidConfigurationException;
use Magium\Magento\Actions\Admin\Configuration\SettingModifier;

abstract class AbstractPaymentMethod extends SettingModifier
{

    const SETTING_OPTION_NEW_ORDER_STATUS_PENDING = 'pending';
    const SETTING_OPTION_NEW_ORDER_STATUS_PROCESSING = 'pending';
    const SETTING_OPTION_NEW_ORDER_STATUS_PROCESSED_OGONE = 'processed_ogone';

    const SETTING_OPTION_PAYMENT_ACTION_AUTHORIZE = 'authorize';
    const SETTING_OPTION_PAYMENT_ACTION_AUTHORIZE_AND_CAPTURE = 'authorize_capture';

    const SETTING_OPTION_YES = 1;
    const SETTING_OPTION_NO = 0;

    const SETTING_OPTION_PAYMENT_FROM_APPLICABLE_COUNTRIES_ALL_ALLOWED = 0;
    const SETTING_OPTION_PAYMENT_FROM_APPLICABLE_COUNTRIES_SPECIFIC = 1;

    protected $section;
    protected $settings = [];
    protected $disableSave = false;

    public function disableSave($disableSave = true)
    {
        $this->disableSave = (bool)$disableSave;
    }

    public function execute()
    {
        if (!$this->section) {
            throw new InvalidConfigurationException('The AbstractPaymentMethod needs the protected $section property defined in any child class in the format of "Tab/Section"');
        }

        if (!$this->settings) {
            throw new InvalidConfigurationException('The AbstractPaymentMethod needs the protected $settings property defined in any child class in the format of ["id" => "value"] ala SettingModifier');
        }

        foreach ($this->settings as $setting => $value) {
            if ($value !== null) { // Skip items that are null.  May help with test performance
                $this->set($this->section . '::' . $setting, $value);
            }
        }

        if (!$this->disableSave) {
            $this->save->save();
        }
    }

}