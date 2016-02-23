<?php

namespace Magium\Magento\Navigators\Admin\Customer;

class ByName extends AbstractCustomerNavigation
{

    public function getSelectorID()
    {
        return 'customerGrid_filter_name';
    }

}