<?php

namespace Magium\Magento\Navigators\Admin\Customer;

class ByEmail extends AbstractCustomerNavigation
{

    public function getSelectorID()
    {
        return 'customerGrid_filter_email';
    }

}