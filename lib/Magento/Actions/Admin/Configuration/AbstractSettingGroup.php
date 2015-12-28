<?php

namespace Magium\Magento\Actions\Admin\Configuration;

use Magium\InvalidConfigurationException;

abstract class AbstractSettingGroup extends SettingModifier
{

    const SETTING_OPTION_YES = 1;
    const SETTING_OPTION_NO = 0;

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
            throw new InvalidConfigurationException('The AbstractSettingGroup needs the protected $section property defined in any child class in the format of "Tab/Section"');
        }

        if (!$this->settings) {
            throw new InvalidConfigurationException('The AbstractSettingGroup needs the protected $settings property defined in any child class in the format of ["id" => "value"] ala SettingModifier');
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