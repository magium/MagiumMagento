<?php

namespace Magium\Magento\Navigators\Admin\Customer;

class ByPrimaryKey extends AbstractCustomerNavigation
{

    public function getSelectorID()
    {
        return 'customerGrid_filter_entity_id_from-customerGrid_filter_entity_id_to';
    }

}