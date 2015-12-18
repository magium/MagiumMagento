<?php

namespace Magium\Magento\Actions\Admin\Configuration\PaymentMethods;


class CashOnDelivery extends AbstractPaymentMethod
{
    const NAME = 'Cash On Delivery Payment';
    const ACTION = 'Admin\Configuration\PaymentMethods\CashOnDelivery';

    protected $section = 'Payment Methods/' . self::NAME;

    protected $settings = [
        'payment_cashondelivery_active'             => 0,
        'payment_cashondelivery_title'              => 'Cash On Delivery',
        'payment_cashondelivery_order_status'       => null,
        'payment_cashondelivery_allowspecific'      => null,
        'payment_cashondelivery_specificcountry'    => null,
        'payment_cashondelivery_instructions'       => null,
        'payment_cashondelivery_min_order_total'    => null,
        'payment_cashondelivery_max_order_total'    => null,
        'payment_cashondelivery_sort_order'         => null
    ];

    /**
     * @param string $active
     */
    public function setEnabled($enabled)
    {
        $this->settings['payment_cashondelivery_active'] = $enabled;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->settings['payment_cashondelivery_title'] = $title;
    }

    /**
     * @param string $order_status
     */
    public function setNewOrderStatus($order_status)
    {
        $this->settings['payment_cashondelivery_order_status'] = $order_status;
    }

    /**
     * @param string $allowspecific
     */
    public function setPaymentFromApplicableCountries($allowspecific)
    {
        $this->settings['payment_cashondelivery_allowspecific'] = $allowspecific;
    }

    /**
     * @param string|array $specificcountry
     */
    public function setSpecificCountry($specificcountry)
    {
        $this->settings['payment_cashondelivery_specificcountry'] = $specificcountry;
    }

    /**
     * @param string $instructions
     */
    public function setInstructions($instructions)
    {
        $this->settings['payment_cashondelivery_instructions'] = $instructions;
    }

    /**
     * @param string $min_order_total
     */
    public function setMinOrderTotal($min_order_total)
    {
        $this->settings['payment_cashondelivery_min_order_total'] = $min_order_total;
    }

    /**
     * @param string $max_order_total
     */
    public function setMaxOrderTotal($max_order_total)
    {
        $this->settings['payment_cashondelivery_max_order_total'] = $max_order_total;
    }

    /**
     * @param string $sort_order
     */
    public function setSortOrder($sort_order)
    {
        $this->settings['payment_cashondelivery_sort_order'] = $sort_order;
    }


}