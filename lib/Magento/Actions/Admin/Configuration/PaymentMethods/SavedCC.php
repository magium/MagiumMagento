<?php

namespace Magium\Magento\Actions\Admin\Configuration\PaymentMethods;


class SavedCC extends AbstractPaymentMethod
{
    const NAME = 'Saved CC';
    const ACTION = 'Admin\Configuration\PaymentMethods\SavedCC';

    protected $section = 'Payment Methods/' . self::NAME;

    protected $settings = [
        'payment_ccsave_active'             => 0,
        'payment_ccsave_title'              => 'Credit Card (saved)',
        'payment_ccsave_order_status'       => null,
        'payment_ccsave_cctypes'      => null,
        'payment_ccsave_useccv'    => null,
        'payment_ccsave_centinel'       => null,
        'payment_ccsave_allowspecific'    => null,
        'payment_ccsave_specificcountry'    => null,
        'payment_ccsave_min_order_total'         => null,
        'payment_ccsave_max_order_total'         => null,
        'payment_ccsave_sort_order'         => null
    ];

    /**
     * @param string $enabled
     */
    public function setEnabled($enabled)
    {
        $this->settings['payment_ccsave_active'] = $enabled;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->settings['payment_ccsave_title'] = $title;
    }

    /**
     * @param string $order_status
     */
    public function setOrderStatus($order_status)
    {
        $this->settings['payment_ccsave_order_status'] = $order_status;
    }

    public function setCreditCardTypes($types) {
        $this->settings['payment_ccsave_cctypes'] = $types;
    }

    public function setRequestCardSecurityCode($request)
    {
        $this->settings['payment_ccsave_useccv'] = $request;
    }

    public function set3DSecureCardValidation($use)
    {
        $this->settings['payment_ccsave_centinel'] = $use;
    }

    public function setPaymentfromApplicableCountries($countriesSetting)
    {
        $this->settings['payment_ccsave_allowspecific'] = $countriesSetting;
    }

    public function setSpecificCountry($countries)
    {
        $this->settings['payment_ccsave_specificcountry'] = $countries;
    }

    public function setMinOrderTotal($total)
    {
        $this->settings['payment_ccsave_min_order_total'] = $total;
    }

    public function setMaxOrderTotal($total)
    {
        $this->settings['payment_ccsave_max_order_total'] = $total;
    }

    public function setSortOrder($sortOrder)
    {
        $this->settings['payment_ccsave_sort_order'] = $sortOrder;
    }


}